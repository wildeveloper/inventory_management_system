<?php

namespace App\Http\Controllers;

use App\Models\Attributes;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function get_all_attributes()
    {
        $attributes = Attributes::with('attribute_values')->get();
        return $attributes;
    }
    public function get_attribute($id)
    {
        $attribute = Attributes::where('id', $id)->first();
        return $attribute;
    }

    public function store(Request $request)
    {
        
        $attributes = $request->all();
        unset($attributes['id']);
        $attributes = Attributes::create($attributes);
        return json_encode($attributes);

    }

    public function update(Request $request)
    {
        
        $attributes = $request->all();
        $attributes = Attributes::updateOrCreate(['id' => $request->id], $attributes);
        return json_encode($attributes);

    }

    public function delete($id)
    {
        
        $attributes = Attributes::where('id', $id)->delete();
        return json_encode($attributes);

    }
}
