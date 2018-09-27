<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'customer_id', 
        'address_id', 
        'order_period_id', 
        'order_date',
        'total_price', 
        'delivery_status'
    ];

    public function customers(){
    	return $this->belongsTo(Customer::class, 'id', 'customer_id')->get();
    }

    public function items(){
        return $this->hasMany(PurchaseOrderItems::class/*, 'purchase_order_id', 'id'*/);
    }

    public function addItems($purchase_order_items){

        foreach ($purchase_order_items as $items) {
            // PurchaseOrderItems::create($items);
            $this->items()->create($items);
        }

        
    }




}
