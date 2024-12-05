<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;
    protected $table = 'cart';
    
    public function cartUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function cartProduct()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
