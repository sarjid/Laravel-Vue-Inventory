<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderdetails extends Model
{


    protected $fillable = [
        'order_id', 'product_id', 'pro_quantity','product_price','sub_total',
    ];

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');;
    }
}
