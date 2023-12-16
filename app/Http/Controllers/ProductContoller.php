<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stores;
use Illuminate\Http\Request;

class ProductContoller extends Controller
{
    public function index()
    {
        $brands = Brands::where('is_active',true)->get();
        $categories = Category::where('is_active',true)->get();
        $stores = Stores::where('is_active',true)->get();
        return view('products',[
            'brands' => $brands,
            'categories' => $categories,
            'stores' => $stores,
        ]);
    }

    public function get_all_products()
    {
        $products = Product::with('brand','category', 'store')->get();
        return $products;
    }
    public function get_product($id)
    {
        $product = Product::where('id', $id)->first();
        return $product;
    }

    public function store(Request $request)
    {
        
        $products = $request->all();
        unset($products['id']);
        $products = Product::create($products);
        return json_encode($products);

    }

    public function update(Request $request)
    {
        
        $products = $request->all();
        $products = Product::updateOrCreate(['id' => $request->id], $products);
        return json_encode($products);

    }

    public function delete($id)
    {
        
        $products = Product::where('id', $id)->delete();
        return json_encode($products);

    }

}
