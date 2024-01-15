<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_code',
        'customer_id',
        'payment_method',
        'payment_id',
        'payment_status',
        'order_total',
        'totals',
        'items',
        'order_status',
    ];

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
