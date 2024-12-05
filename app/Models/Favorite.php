<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use SoftDeletes;
    protected $table = 'favorites';
    
    public function favoriteUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function favoriteProduct()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
