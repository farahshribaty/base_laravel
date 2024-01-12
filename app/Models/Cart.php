<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'sub_total',
        'delivery_fees',
        'overall_total',
        'cart_items_count',
    ];

    public function user()
    {
        return $this->belongsToOne(User::class);
    }

    public function cartItems(){
        return $this->hasMany(CartItem::class);
    }
}
