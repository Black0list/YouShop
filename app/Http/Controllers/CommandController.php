<?php

namespace App\Http\Controllers;

use App\Models\Command;
use App\Models\CommandProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommandController extends Controller
{
    public function commandsPage(Request $request)
    {
        $Products = json_decode($request['data']);
        $total_price = intval($request['balance']);

        $command = Command::create([
            'user_id' => Auth::user()->id,
            'total_price' => $total_price,
            'status' => 'En Cour',
        ]);

        foreach ($Products as $product){
            $prod = Product::find($product->product);

            CommandProduct::create([
                'command_id' => $command->id,
                'product_id' => $prod->id,
                'price' => intval($product->price * $product->quantity),
                'quantity' => $product->quantity,
            ]);
        }

        $Products = CommandProduct::where('command_id', $command->id)->get();

        echo "<script>localStorage.clear();</script>";

        return view('client.commands', compact('Products', 'command', 'total_price'));
    }
}
