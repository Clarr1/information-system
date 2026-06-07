<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    //
public function store(Request $request)
{
    $request->validate([
        'cash' => 'required|numeric|min:0',
    ]);

    $cart = session()->get('cart', []);

    $totalItems = 0;
    $totalAmount = 0;

    // Calculate total amount first
    foreach ($cart as $item) {
        $totalAmount += $item['subtotal'];
    }

    $cash = $request->cash;

    if ($cash < $totalAmount) {
        return back()->with('error', 'Insufficient cash provided.');
    }

    $change = $cash - $totalAmount;

    foreach ($cart as $id => $item) {

        $product = Product::where('product_id', $id)->first();

        if (!$product) {
            continue;
        }

        if ($product->quantity < $item['qty']) {
            return back()->with(
                'error',
                'Insufficient stock for ' . $item['name']
            );
        }

        // Deduct stock
        $product->quantity -= $item['qty'];
        $product->save();

        // Save purchase
        Purchase::create([
            'product_id'     => $product->product_id,
            'product_name'   => $product->product_name,
            'quantity'       => $item['qty'],
            'total_price'    => $item['subtotal'],
            'cash_received'  => $cash,
            'change_amount'  => $change,
        ]);

        $totalItems += $item['qty'];
    }

ActivityLog::create([
    'user_id' => auth()->id(),
    'action' => 'Purchase Completed',
    'description' => $totalItems . ' item(s) purchased. Total: ₱' . number_format($totalAmount, 2),
    'module' => 'POS',
]);

    session()->forget('cart');

    return back()->with(
        'success',
        'Purchase completed. Change: ₱' . number_format($change, 2)
    );
}

    public function increaseQty($id)
{
    $cart = session('cart', []);

    if (isset($cart[$id])) {

        $product = Product::where('product_id', $id)->first();

        if ($cart[$id]['qty'] < $product->quantity) {
            $cart[$id]['qty']++;
        }

        $cart[$id]['subtotal'] = $cart[$id]['qty'] * $cart[$id]['price'];
    }

    session(['cart' => $cart]);

    return response()->json([
        'status' => 'success',
        'qty' => $cart[$id]['qty'],
        'subtotal' => number_format($cart[$id]['subtotal'], 2),
        'total' => number_format(array_sum(array_column($cart, 'subtotal')), 2),
        'cart_count' => count($cart),
    ]);
}

public function decreaseQty($id)
{
    $cart = session('cart', []);

    if (isset($cart[$id])) {

        $product = Product::where('product_id', $id)->first();

        // decrease qty
            if ($cart[$id]['qty'] > 1) {
                $cart[$id]['qty']--;
            } else {
                unset($cart[$id]);
            }

        // remove if 0
        if ($cart[$id]['qty'] <= 0) {
            unset($cart[$id]);
        } else {
            $cart[$id]['subtotal'] = $cart[$id]['qty'] * $cart[$id]['price'];
        }

        session(['cart' => $cart]);
    }

    return response()->json([
        'status' => 'success',
        'qty' => $cart[$id]['qty'] ?? 0,
        'subtotal' => isset($cart[$id])
            ? number_format($cart[$id]['subtotal'], 2)
            : 0,
        'total' => number_format(array_sum(array_column($cart, 'subtotal')), 2),
        'cart_count' => count($cart),
         ]);

        
    }

 public function history()
{
    $purchases = Purchase::with('product')
        ->latest()
        ->get();

    return view('product.purchase_history', compact('purchases'));
}
}
