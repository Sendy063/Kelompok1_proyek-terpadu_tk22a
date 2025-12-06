<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer',
        'email',
        'alamat',
        'telepon',
        'order_date',
        'total',
        'items',
        'payment_method',
        'status',
    ];
}
