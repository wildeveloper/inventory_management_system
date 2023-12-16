<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function get_all_categories()
    {
        $categories = Category::all();
        return $categories;
    }
    public function get_category($id)
    {
        $category = Category::where('id', $id)->first();
        return $category;
    }

    public function store(Request $request)
    {
        
        $categories = $request->all();
        unset($categories['id']);
        $categories = Category::create($categories);
        return json_encode($categories);

    }

    public function update(Request $request)
    {
        
        $categories = $request->all();
        $categories = Category::updateOrCreate(['id' => $request->id], $categories);
        return json_encode($categories);

    }

    public function delete($id)
    {
        
        $categories = Category::where('id', $id)->delete();
        return json_encode($categories);

    }
}
