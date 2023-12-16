<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function get_all_brands()
    {
        $brands = Brands::all();
        return $brands;
    }
    public function get_brand($id)
    {
        $brand = Brands::where('id', $id)->first();
        return $brand;
    }

    public function store(Request $request)
    {
        
        $brands = $request->all();
        unset($brands['id']);
        $brands = Brands::create($brands);
        return json_encode($brands);

    }

    public function update(Request $request)
    {
        
        $brands = $request->all();
        $brands = Brands::updateOrCreate(['id' => $request->id], $brands);
        return json_encode($brands);

    }

    public function delete($id)
    {
        
        $brands = Brands::where('id', $id)->delete();
        return json_encode($brands);

    }
}
