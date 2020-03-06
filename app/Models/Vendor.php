<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    public function products()
    {
        $this->hasMany(Product::class);
    }
}
