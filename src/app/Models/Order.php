<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'customer',
        'email',
        'alamat',
        'telepon',
        'order_date',
        'total',
        'items',
        'payment_method',
        'status',
        'payment_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
