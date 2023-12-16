<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active',true)->get();
        $company = Company::first();
        return view('orders',[
            'products' => $products,
            'company' => $company,
        ]);
    }

    public function get_all_orders()
    {
        $orders = Orders::with('product')->get();
        return $orders;
    }
    public function get_order($id)
    {
        $order = Orders::where('id', $id)->first();
        return $order;
    }

    public function store(Request $request)
    {
        
        $orders = $request->all();
        unset($orders['id']);
        $orders = Orders::create($orders);
        return json_encode($orders);

    }

    public function update(Request $request)
    {
        
        $orders = $request->all();
        $orders = Orders::updateOrCreate(['id' => $request->id], $orders);
        return json_encode($orders);

    }

    public function delete($id)
    {
        
        $orders = Orders::where('id', $id)->delete();
        return json_encode($orders);

    }
}
