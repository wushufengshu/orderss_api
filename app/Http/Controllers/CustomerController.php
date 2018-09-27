<?php

namespace App\Http\Controllers;

use \App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index(){
    	//
    	$customers =Customer::all(); 
    	return response()->json([
    		'Customers' => $this->transform($customers)
    	]);
    }

    public function transform(){

    	return array_map(function($customer){
    		return [
    			'first_name' => $customer['first_name'],
    			'middle_name' => $customer['middle_name'],
    			'last_name' => $customer['last_name'],
    			'email_address' => $customer['email_address'],
    			'phone_number' => $customer['phone_number'],
    			'mobile_number' => $customer['mobile_number']

    		];
    	}, Customer::all()->toArray());
    }
}
