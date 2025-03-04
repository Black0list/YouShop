<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Stripe\Climate\Order;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'image',
        'title',
        'description',
        'price',
        'stock',
        'user_id',
        'category_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'category_id');
    }

    public function orders()
    {
        return $this->belongsToMany(CommandProduct::class);
    }


}
