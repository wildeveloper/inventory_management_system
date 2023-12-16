<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Orders::all();
        $products = Product::where('is_active',true)->get();
        $users = User::all();
        return view('dashboard',[
            'orders' => $orders,
            'products' => $products,
            'users' => $users,
        ]);
    }
}