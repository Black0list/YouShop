<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    public function commandproducts()
    {
        return $this->hasMany(CommandProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
