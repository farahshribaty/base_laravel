<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'customer_id',
        'amount',
        'pg_payment_id',
        'pg_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
