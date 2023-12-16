<?php

namespace App\Http\Controllers;

use App\Models\Stores;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function get_all_stores()
    {
        $stores = Stores::all();
        return $stores;
    }
    public function get_store($id)
    {
        $store = Stores::where('id', $id)->first();
        return $store;
    }

    public function store(Request $request)
    {
        
        $stores = $request->all();
        unset($stores['id']);
        $stores = Stores::create($stores);
        return json_encode($stores);

    }

    public function update(Request $request)
    {
        
        $stores = $request->all();
        $stores = Stores::updateOrCreate(['id' => $request->id], $stores);
        return json_encode($stores);

    }

    public function delete($id)
    {
        
        $stores = Stores::where('id', $id)->delete();
        return json_encode($stores);

    }
}
