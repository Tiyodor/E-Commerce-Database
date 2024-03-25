<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::latest()->paginate(4);

        return view('order.orders', compact('orders'))
            ->with('i', (request()->input('page', 1) - 1) * 4);
    }

    public function create()
    {
        $products = Product::all();
        return view('order.create', compact('products')); // Corrected view name
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'product' => 'required|array',
            'product.*' => 'exists:products,id', // Validate each product ID exists in the products table
            'payment' => 'required|string',
            'mod' => 'required|string',
            'status' => 'required|string',
        ]);

        // Create order record
        $order = new Order();
        $order->name = $validatedData['name'];
        $order->address = $validatedData['address'];
        $order->payment = $validatedData['payment'];
        $order->mod = $validatedData['mod'];
        $order->status = $validatedData['status'];
        $order->save();

        // Attach selected products to the order
        $order->products()->attach($validatedData['product']);

        // Redirect or return a response
        return redirect()->route('order.orders')->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
