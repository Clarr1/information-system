<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $products = Product::paginate(5);
        return view('product.product_table', compact('products'));
        
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
    public function store()
    {
        //
        request()->validate([
            'product_name' => 'required',
            'product_category' => 'required',
            'product_price' => 'required|numeric',
            'product_quantity' => 'required|integer'
        ]);

        Product::create([
            'product_name' => request('product_name'),
            'category' => request('product_category'),
            'price' => request('product_price'),
            'quantity' => request('product_quantity')
        ]);

        // return redirect()->route('product-table');
        return redirect()->route('add-product')->with('success', 'Product added successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        return view('product.edit_product', compact('product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        request()->validate([
            'product_name' => 'required',
            'product_category' => 'required',
            'product_price' => 'required|numeric',
            'product_quantity' => 'required|integer'
        ]);

        $product->update([
            'product_name' => request('product_name'),
            'product_category' => request('product_category'),
            'product_price' => request('product_price'),
            'product_quantity' => request('product_quantity')
        ]);

            return response()->json([
                'message' => 'Update successfully!'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
        public function destroy(Product $product)
        {
            $product->delete();

            return response()->json([
                'message' => 'Product deleted successfully!'
            ]);
        }
}
