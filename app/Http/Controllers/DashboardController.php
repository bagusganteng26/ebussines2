<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
        public function index()
    {
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');
        $lowStock = Product::where('stock', '<', 10)->count();
        $totalValue = Product::sum('price');
        $recentProducts = Product::latest()->take(5)->get();
        
        return view('dashboard', compact(
            'totalProducts',
            'totalStock',
            'lowStock',
            'totalValue',
            'recentProducts'
        ));
    }

}
