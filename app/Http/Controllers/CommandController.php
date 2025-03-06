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

    public function index()
    {
        $commands = Command::paginate(7);
        return view('admin.commands', compact('commands'));
    }

    public function history(Request $request)
    {
        $commands = Command::where('user_id', Auth::id())->paginate(3);
        return view('client.history', compact('commands'));
    }

    public function commandsPage(Request $request)
    {
        $Products = json_decode($request['data']);
        if(is_null($Products)){
            return view('client.failed');
        }

        $total_price = intval($request['balance']);


        $command = Command::create([
            'user_id' => Auth::user()->id,
            'total_price' => $total_price,
            'status' => 'pending',
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

        return view('client.commands', compact('Products', 'command', 'total_price'));
    }

    public function update(Request $request)
    {
        $command = Command::find($request['command']);
        $command->status = $request['status'];
        $command->save();

        return redirect('/admin/commands');
    }

    public function delete(Request $request)
    {
        Command::destroy($request['command']);
        return redirect('/products');
    }


}
