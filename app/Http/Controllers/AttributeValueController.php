<?php

namespace App\Http\Controllers;

use App\Models\Attributes;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    public function index($id)
    {
        $attribute = Attributes::where('id',$id)->first();
        return view('attribute-values',[
            'attribute' => $attribute,
        ]);
    }

    public function get_attribute($id)
    {
        $attributevalues = AttributeValue::where('attribute_id', $id)->get();
        return $attributevalues;
    }

    public function get_attribute_value($id)
    {
        $attributevalues = AttributeValue::where('id', $id)->first();
        return $attributevalues;
    }

    public function store(Request $request)
    {
        
        $values = $request->all();
        unset($values['id']);
        $value = AttributeValue::create($values);
        return json_encode($values);

    }

    public function update(Request $request)
    {
        
        $values = $request->all();
        $values = AttributeValue::updateOrCreate(['id' => $request->id], $values);
        return json_encode($values);

    }

    public function delete($id)
    {
        
        $values = AttributeValue::where('id', $id)->delete();
        return json_encode($values);

    }
}
