<?php

namespace App;

use App\PurchaseOrder;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'customers';

    // protected $primaryKey = 'customer_id';

    public function orders(){
    	return $this->hasMany(PurchaseOrder::class);
    }
}
