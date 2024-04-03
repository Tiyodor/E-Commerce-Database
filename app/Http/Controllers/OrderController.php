<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::latest()->paginate(7);

        return view('order.orders', compact('orders'))
            ->with('i', (request()->input('page', 1) - 1) * 7);
    }

    public function create()
    {
        $products = Product::where('quantity', '>', 0)->get();
        return view('order.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'product' => 'required|array',
            'product.*' => 'exists:products,id',
            'payment' => 'required|string',
            'mod' => 'required|string',
        ]);

        try
        {
            DB::beginTransaction();

            Product::lockForUpdate()->whereIn('id', $validatedData['product'])->get();

            $products = Product::whereIn('id', $validatedData['product'])->where('quantity', '>', 0)->get();

            if ($products->count() !== count($validatedData['product'])) {
                throw new Exception("Some selected products are out of stock.");
            }

            $order = new Order();
            $order->name = $validatedData['name'];
            $order->address = $validatedData['address'];
            $order->payment = $validatedData['payment'];
            $order->mod = $validatedData['mod'];
            $order->status = 'processing';
            $order->save();

            $order->products()->attach($validatedData['product']);

            foreach ($validatedData['product'] as $productId) {
                $product = Product::find($productId);
                $product->quantity -= 1;
                $product->save();
            }

            DB::commit();

            return redirect()->route('order.orders')->with('success', 'Order created successfully.');
        }
        catch(Exception $e)
        {
            DB::rollback();
            return redirect()->route('order.orders')->with('error', $e->getMessage());
        }
    }

    public function show(Order $order)
    {
        $orders = Order::latest()->paginate(3);

        return view('order.show', compact('order', 'orders'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $products = Product::all();
        $orders = Order::latest()->paginate(3);

        return view('order.edits' ,compact('order', 'orders'));
    }

    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'payment' => 'required|string',
            'mod' => 'required|string',
        ]);

        // Assigning values individually
        $order->payment = $validatedData['payment'];
        $order->mod = $validatedData['mod'];

        $order->save();

        return redirect()->route('order.orders')->with('success', 'Order updated successfully.');
    }

 public function statusUpdate(Request $request, $id)
{
    $order = Order::findOrFail($id);
    $order->update(['status' => $request->status]);

    return redirect()->route('order.orders')->with('success', 'Order status updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */

     public function cancelDestroy(Order $order)
{
    DB::beginTransaction();

    foreach ($order->products as $product) {
        $product->increment('quantity', 1);
    }

    $order->forceDelete();

    DB::commit();

    return redirect()->route('order.orders')->with('success', 'Order cancellation successful.');
}


    public function destroy(Order $order)
    {
        if($order->trashed()){
            $order->forceDelete();
            return redirect()->route('order.orders');
        }

        $order->delete(); // Soft delete

        return redirect()->route('order.orders')
            ->with('success', 'Order Complete');
    }

    public function restore(Order $order, Request $request)
    {
        $order->restore();

        return redirect()->route('order.orders');
    }

    public function retrieveSoftDelete()
    {
        $orders = Order::onlyTrashed()->get(); // Retrieve only soft-deleted products

        return view('order.history', compact('orders'));
    }

    /**
     * Restore the specified soft-deleted resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreSoftDeleted($id)
    {
        $order = Order::onlyTrashed()->findOrFail($id);
        $order->restore(); // Restore the soft-deleted product

        return redirect()->route('order.orders')->with('success', 'Product restored successfully');
    }

    public function IncrementQty(Order $order)
    {
        $product = $order->product;
        $order->increment('product_quantity', 1);
        $order->update(['product_price'=>$order->product_quantity * $product->price]);

        $product->decrement('quantity', 1);

        $this->mount();
    }
}
