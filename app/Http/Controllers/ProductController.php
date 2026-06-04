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

    public function purchase()
    {
        $products = Product::all();

        $cart = session()->get('cart', []);
        $total = collect($cart)->sum('subtotal');

        return view('product.purchase_product', compact('products', 'cart', 'total'));
    }

public function addToCart(Request $request)
{
    try {
        $product = Product::find($request->input('product_id'));

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $cart = session()->get('cart', []);

        $id = $product->product_id;

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
            $cart[$id]['subtotal'] = $cart[$id]['qty'] * $product->price;
        } else {
            $cart[$id] = [
                'name' => $product->product_name,
                'qty' => 1,
                'price' => $product->price,
                'subtotal' => $product->price,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'total' => collect($cart)->sum('subtotal'),
            'id' => $id
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}

public function removeFromCart(Request $request)
{
    try {
        $cart = session()->get('cart', []);
        $id = $request->input('product_id');
        unset($cart[$id]);
        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'total' => collect($cart)->sum('subtotal')
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}

public function storePurchase()
{
    $cart = session()->get('cart', []);

    // Save purchase to database here

    session()->forget('cart');

    return redirect()
        ->back()
        ->with('purchase_success','Purchase completed');
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
            'category' => request('product_category'),
            'price' => request('product_price'),
            'quantity' => request('product_quantity')
        ]);

        return redirect()->route('product-table')->with('updated', 'Product updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
        public function destroy(Product $product)
        {
            $product->delete();

    return redirect()
        ->route('product-table');
  }
}

