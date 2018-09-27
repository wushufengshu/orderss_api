<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItems extends Model
{
    //
    protected $table = 'purchase_order_items';

    protected $fillable = [
        'purchase_order_id',
        'product_id',
        'unit',
        'quantity'
    ];

    public $timestamps = false;

    // protected $primaryKey = 'purchase_order_id';

    //protected $hidden = ['id', 'purchase_order_id'];

    public function purchase_order(){
    	return $this->belongsTo(PurchaseOrder::class);
    }

    public function product(){
    	return $this->belongsTo(Products::class);
    }
}
