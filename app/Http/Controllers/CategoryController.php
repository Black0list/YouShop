<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Role;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(7);
        return view('admin.categories', compact('categories'));
    }

    public function create(Request $request)
    {
        Category::create([
            'name' => $request['name'],
            'description' => $request['description'],
        ]);

        return redirect('/admin/categories')->with('success', 'Category created!');
    }

    public function getOne(Request $request)
    {
        $category = Category::find($request['category']);
        return view('admin.category_edit', compact('category'));
    }

    public function delete(Request $request)
    {
        try {
            $category = Category::find($request['category']);
            $category->delete();
        }catch (\Exception $exception){
            return redirect('/admin/categories')->with('failed', 'Category is related to many SubCategories, cant be deleted for the moment');
        }
        return redirect('/admin/categories')->with('success', 'Category Deleted!');
    }

    public function update(Request $request)
    {
        try {
            $category = Category::find($request['category']);
            $category->update([
                'name' => $request['name'],
                'description' => $request['description'],
            ]);
        }catch (\Exception $exception){
            return redirect('/admin/categories')->with('failed', 'Something Went Wrong!');
        }
        return redirect('/admin/categories')->with('success', 'Category Updated!');
    }
}
