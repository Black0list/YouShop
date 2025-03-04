<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'command_id',
        'price',
        'quantity',
    ];


    public function command()
    {
        return $this->hasOne(Command::class, 'command_id');
    }

    public function product()
    {
        return $this->BelongsTo(Product::class, 'product_id');
    }
}
