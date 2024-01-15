<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $table ='user_addresses';
    public $timestamps = false;

    protected $fillable = [
        'zone_number',
        'city',
        'street',
        'building_number',
        'address_additional_information',
        'lat',
        'long',
        'address_name',
        'floor',
        'apartment',
        'order_id',
    ];
}
