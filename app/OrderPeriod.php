<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPeriod extends Model
{
    //
    protected $table = 'order_period';

    public function order_period(){
    	return $this->belongsTo(PurchaseOrder::class);
    }
}
