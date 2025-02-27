<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Session\Middleware\StartSession;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = SubCategory::all();
        return view('admin.products', compact('products', 'categories'));
    }

    public function home()
    {
        $products = Product::all();
        $categories = SubCategory::all();
        return view('client.products', compact('products', 'categories'));
    }

    public function create(Request $request)
    {
//        dd($request);

        $request->validate([
            'image' => 'required|file|mimes:jpg,png|max:2048',
        ]);

        $extension = $request->file('image')->getClientOriginalExtension();
        $filename = 'product_' . time() .'.'. $extension;
        $path = $request->file('image')->storeAs('uploads', $filename,'public');
        Product::create([
            'image' => $path,
            'title' => $request['title'],
            'price' => $request['price'],
            'stock' => $request['stock'],
            'description' => $request['description'],
            'user_id' => $request['user'],
            'category_id' => $request['category']
        ]);

        return redirect('/admin/products')->with('success', "product added successfully");
    }

    public function delete(Request $request)
    {
        $product = Product::find($request['product']);

        if($product->user->id != Auth::user()->id)
        {
            return view('admin.products')->with('failed', 'You are not authorized to access this product');
        }

        if ($product->image && Storage::exists('public/' . $product->image)) {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();
        return redirect('/admin/products')->with('success', "product deleted successfully");
    }

    public function getOne(Request $request)
    {


        $product  = Product::find($request['product']);

        if($product->user->id != Auth::user()->id)
        {
            return view('admin.products')->with('failed', 'You are not authorized to access this product');
        }

        $categories = SubCategory::all();
        return view('admin.product_edit', compact('product', 'categories'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'image' => 'required|file|mimes:jpg,png|max:2048',
        ]);

        $product = Product::find($request['product']);

        $extension = $request->file('image')->getClientOriginalExtension();
        $filename = 'product_' . time() .'.'. $extension;
        $path = $request->file('image')->storeAs('uploads', $filename,'public');
        $product->update([
            'image' => $path,
            'title' => $request['title'],
            'price' => $request['price'],
            'stock' => $request['stock'],
            'description' => $request['description'],
            'user_id' => $request['user'],
            'category_id' => $request['category']
        ]);

        return redirect('/admin/products')->with('success', "product added successfully");
    }

    public function view(Request $request)
    {
        $product = Product::find($request['product']);

        return view('client.product_view', compact('product'));
    }

    public function getItems(Request $request)
    {
        $products = $request->json()->all();

        if (!$products || !is_array($products)) {
            return response()->json(['error' => 'Invalid data received'], 400);
        }

        Log::info('Received request data:', $products);

        $array = [];
        $i = 0;
        foreach ($products as $product) {
            $prod = Product::find($product['product']);

            if ($prod) {
                $array[$i] = [
                    'id' => $prod->id,
                    'title' => $prod->title,
                    'price' => $prod->price,
                    'image' => $prod->image,
                    'description' => $prod->description,
                    'quantity' => $product['quantity'] ?? 1
                ];
                $i++;
            }
        }

        return response()->json(['products' => $array], 200);
    }

}

