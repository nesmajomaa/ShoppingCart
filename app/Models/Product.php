<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';

    public function productCategory()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
        //return $this->belongsTo(Category::class);
    }
    public function orderItemsProduct()
    {
        return $this->hasMany(OrderItem::class);
    }
}
