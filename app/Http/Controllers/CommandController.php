<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommandController extends Controller
{
    public function commandsPage(Request $request)
    {
        $products = json_decode($request['data']);

        $OrderedProducts = [];
        $TotalPrice = 0;
        foreach ($products as $product){
            $prod = Product::find($product->product);
            array_push($OrderedProducts, [$prod, $product->quantity]);
            $TotalPrice += $product->price * $product->quantity;
        }

        return view('client.commands', compact('OrderedProducts', 'TotalPrice'));
    }
}
