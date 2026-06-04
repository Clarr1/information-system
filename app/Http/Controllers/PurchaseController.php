<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    //
    public function store(Request $request)
    {
         $cart = session()->get('cart', []);

    foreach ($cart as $id => $item) {

        $product = Product::where('product_id', $id)->first();

        if (!$product) continue;

        if ($product->quantity < $item['qty']) {
            return back()->with('error', 'Insufficient stock for ' . $item['name']);
        }

        // subtract stock
        $product->quantity -= $item['qty'];
        $product->save();

        // save purchase
        Purchase::create([
            'product_id' => $product->product_id,
            'quantity' => $item['qty'],
            'total_price' => $item['subtotal'],
        ]);
    }

    session()->forget('cart');

    return back()->with('success', 'Purchase completed');
    }
}
