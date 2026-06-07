<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();

        
        $totalProducts = $products->count();
        $totalStock = $products->sum('quantity');
        $lowStock = $products->where('quantity', '<=', 10)->count();
        $totalPurchases = Purchase::count();

        
        $productNames = $products->pluck('product_name');
        $productStocks = $products->pluck('quantity');


        $stockLabels = ['Low Stock', 'Normal Stock'];
        $stockValues = [
            $lowStock,
            $totalProducts - $lowStock
        ];

        return view('product.home', compact(
            'totalProducts',
            'totalStock',
            'lowStock',
            'totalPurchases',
            'productNames',
            'productStocks',
            'stockLabels',
            'stockValues'
        ));
    }
}