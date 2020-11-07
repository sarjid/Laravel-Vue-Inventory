<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id', 'qty', 'sub_total','vat','total','pay','due','payby'
    ];

    public function customer(){
        return $this->hasOne(Customer::class, 'id', 'customer_id');;
    }
}

