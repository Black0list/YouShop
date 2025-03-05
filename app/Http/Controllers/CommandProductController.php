<?php

namespace App\Http\Controllers;

use App\Models\Command;
use App\Models\CommandProduct;
use Illuminate\Http\Request;

class CommandProductController extends Controller
{
    public function command_view(Command  $command)
    {
        $items = CommandProduct::where('command_id', $command->id)->get();
        return view('client.command_view', compact('items'));
    }
}
