<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Checkout;
use App\Models\CheckoutProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Psy\VersionUpdater\Checker;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checkouts = Checkout::latest()->paginate(10);

        return view('checkout.index', compact('checkouts'))
            ->with('i', (request()->input('page', 1) - 1) * 7);
    }


    /**
     * Show the form for creating a new resource.
     */


    public function showCheckout(Checkout $checkout)
    {
        $checkouts = Checkout::latest()->paginate(3);

        return view('checkout.show', compact('checkout', 'checkouts'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'payment' => 'required|string',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'address' => 'required|string',
            'postal' => 'required|regex:/^[0-9]{4}$/',
            'city' => 'required|string',
            'phone' => 'required|regex:/^[0-9]{11}$/',
            'products.*' => 'exists:products,id',
            'total' => 'required',
        ]);

        $validatedData['product'] = $validatedData['products'];
        unset($validatedData['products']);

        try {
            DB::beginTransaction();

            Product::lockForUpdate()->whereIn('id', $validatedData['product'])->get();

            $products = Product::whereIn('id', $validatedData['product'])->where('quantity', '>', 0)->get();

            if ($products->count() !== count($validatedData['product'])) {
                throw new Exception("Some selected products are out of stock.");
            }

            // Create a new checkout record
            $checkout = new Checkout();
            $checkout->fill($validatedData);
            $checkout->save();

            // $checkout->products()->attach($validatedData['product']);

            foreach ($validatedData['product'] as $productId) {
                $product = Product::find($productId);
                $product->quantity -= 1;
                $product->save();

                CheckoutProduct::create([
                    "product_id" => $productId,
                    "checkout_id" => $checkout->id,
                    "quantity" => 1
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Checkout successfully placed','checkout_id' => $checkout->id], 201);
        } catch (Exception $e) {
            DB::rollback();
            Log::debug($e->getMessage());
            return response()->json(['message' => 'failed'], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($checkoutId)
    {
        // Retrieve checkout details
        $checkout = Checkout::with('products')->find($checkoutId);

        if (!$checkout) {
            return response()->json(['message' => 'Checkout not found'], 404);
        }

        // Transform products data to include image
        $productsData = $checkout->products->map(function ($product) {
            return [
                'id' => $product->id,
                'category' => $product->category,
                'name' => $product->name,
                'price' => $product->price,
                'image' => url('/images/' . $product->product_image), // Assuming product_image is the column name for the image
            ];
        });

        // Return response with checkout and transformed product details
        return response()->json([
            'id' => $checkout->id,
            'email' => $checkout->email,
            'payment' => $checkout->payment,
            'fname' => $checkout->fname,
            'lname' => $checkout->lname,
            'address' => $checkout->address,
            'postal' => $checkout->postal,
            'city' => $checkout->city,
            'phone' => $checkout->phone,
            'products' => $productsData, // Use the transformed products data
            'total' => $checkout->total,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Checkout $checkout)
    {
        $products = Product::all();

        return view('checkout.edits' ,compact('checkout', 'checkout'));
    }

    public function update(Request $request, Checkout $checkout)
    {
        $validatedData = $request->validate([
            'payment' => 'required|string',
        ]);

        $checkout->payment = $validatedData['payment'];

        $checkout->save();

        return redirect()->route('checkout.index')->with('success', 'Checkout updated successfully.');
    }
    public function cancelDestroy(Checkout $checkout)
    {
        DB::beginTransaction();

        foreach ($checkout->products as $product) {
            $product->increment('quantity', 1);
        }

        $checkout->forceDelete();

        DB::commit();

        return redirect()->route('checkout.index')->with('success', 'Checkout cancellation successful.');
    }


        public function destroy(Checkout $checkout)
        {
            if($checkout->trashed()){
                $checkout->forceDelete();
                return redirect()->route('checkout.index');
            }

            $checkout->delete(); // Soft delete

            return redirect()->route('checkout.index')
                ->with('success', 'Checkout Complete');
        }

        public function restore(Checkout $checkout, Request $request)
        {
            $checkout->restore();

            return redirect()->route('checkout.index');
        }

        public function retrieveSoftDelete()
        {
            $checkouts = Checkout::onlyTrashed()->get(); // Retrieve only soft-deleted products

            return view('checkout.history', compact('checkouts'));
        }

        /**
         * Restore the specified soft-deleted resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function restoreSoftDeleted($id)
        {
            $checkout = Checkout::onlyTrashed()->findOrFail($id);
            $checkout->restore(); // Restore the soft-deleted product

            return redirect()->route('checkout.index')->with('success', 'Product restored successfully');
        }

        public function IncrementQty(Checkout $checkout)
        {
            $product = $checkout->product;
            $checkout->increment('product_quantity', 1);
            $checkout->update(['product_price'=>$checkout->product_quantity * $product->price]);

            $product->decrement('quantity', 1);

            $this->mount();
        }

}
