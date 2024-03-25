<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(4);

        return view('items.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 4);


        //if api, return response()->json(['data' => $products],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'details' => 'required',
        //     'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        //     'category' => 'required|in:SD,EG,HG,RG,MG,PG,HI-RES,1/100',
        //     'price' => 'required',
        // ]);

        $input = $request->all();

        if ($image = $request->file('product_image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['product_image'] = "$profileImage";
        }

        Product::create($input);

        return redirect()->route('items.index')
                        ->with('success', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
       return view('items.show' ,compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('items.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $input = $request->all();
        if ($image = $request->file('product_image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['product_image'] = "$profileImage";


            //delete old file in db after moving new file

        }else{
            unset($input['product_image']);
        }

        $product->update($input);

        return redirect()->route('items.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->trashed()){
            $product->forceDelete();
            return redirect()->route('items.index');
        }

        $product->delete(); // Soft delete

        return redirect()->route('items.index')
            ->with('success', 'Product removed');
    }

    public function restore(Product $product, Request $request)
    {
        $product->restore();

        return redirect()->route('items.index');
    }

    public function retrieveSoftDeleted()
    {
        $products = Product::onlyTrashed()->get(); // Retrieve only soft-deleted products

        return view('items.archive', compact('products'));
    }

    /**
     * Restore the specified soft-deleted resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreSoftDeleted($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore(); // Restore the soft-deleted product

        return redirect()->route('items.index')
            ->with('success', 'Product restored successfully');
    }
}
