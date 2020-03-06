<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client_email',
        'partner_id',
        'status',
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function getSum()
    {
        return $this->orderProducts()->get()->sum(function ($product) {
            return $product->price * $product->quantity;
        });
    }
}
