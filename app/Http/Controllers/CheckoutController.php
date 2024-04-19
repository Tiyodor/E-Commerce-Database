<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Checkout;
use App\Models\CheckoutProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;




class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
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
            return response()->json(['message' => 'Order successfully placed','checkout_id' => $checkout->id], 201);
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

    // Return response with checkout and product details
    return response()->json([
        'checkout' => $checkout
    ]);
}





    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
