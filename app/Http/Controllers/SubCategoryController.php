<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::paginate(7);
        $categories = Category::all();
        return view('admin.subcategories', compact('subcategories', 'categories'));
    }

    public function create(Request $request)
    {
        SubCategory::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'category_id' => $request['category_id'],
        ]);

        return redirect('/admin/subcategories')->with('success', 'SubCategory created!');
    }

    public function getOne(Request $request)
    {
        $category = SubCategory::find($request['category']);
        $categories = Category::all();
        return view('admin.subcategory_edit', compact('category', 'categories'));
    }

    public function delete(Request $request)
    {
        try {
            $category = SubCategory::find($request['category']);
            $category->delete();
        }catch (\Exception $exception){
            return redirect('/admin/subcategories')->with('failed', 'SomeThing Went Wrong');
        }
        return redirect('/admin/subcategories')->with('success', 'SubCategory Deleted!');
    }

    public function update(Request $request)
    {
        try {
            $category = SubCategory::find($request['category']);
            $category->update([
                'name' => $request['name'],
                'description' => $request['description'],
                'category_id' => $request['category_id'],
            ]);
        }catch (\Exception $exception){
            return redirect('/admin/subcategories')->with('failed', 'Something Went Wrong!');
        }
        return redirect('/admin/subcategories')->with('success', 'SubCategory Updated!');
    }
}
