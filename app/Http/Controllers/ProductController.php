<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        $posts = $response->json();
        $products = Product::latest()->paginate(4);

        return view('items.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 4);


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
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalName();
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
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalName();
        $image->move($destinationPath, $profileImage);
        $input['product_image'] = $profileImage;

        $this->deleteExistingPhoto($product);
    } else {
        unset($input['product_image']);
    }

    $product->update($input);

    return redirect()->route('items.index')
                     ->with('success', 'Product updated successfully');
}

private function deleteExistingPhoto(Product $product)
{
    if ($product->product_image) {
        $imagePath = public_path('images/') . $product->product_image;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
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
            $this->deleteAssociatedPhoto($product);
            return redirect()->route('items.index');
        }

        $product->delete();

        return redirect()->route('items.index')
            ->with('success', 'Product Archived');
    }

    private function deleteAssociatedPhoto(Product $product)
    {
        if ($product->product_image) {
            $imagePath = public_path('images/') . $product->product_image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }



    public function restore(Product $product, Request $request)
    {
        $product->restore();

        return redirect()->route('items.index');
            -with('success', 'Product Restored');
    }

    public function retrieveSoftDeleted()
    {
        $products = Product::onlyTrashed()->get();

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
        $product->restore();

        return redirect()->route('items.index')
            ->with('success', 'Product restored successfully');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $products = Product::where('name', 'like', '%'.$search.'%')
                            ->orWhere('details', 'like', '%'.$search.'%')
                            ->orWhere('category', 'like', '%'.$search.'%')
                            ->paginate(4);

        return view('items.index', compact('products'));
    }

}
