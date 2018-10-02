<?php

namespace App\Http\Controllers;

use App\PurchaseOrderItems;
use App\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(PurchaseOrder $orders)
    {
        //retrieves a list of orders
        return response()->json([
            'Orders' => 
                $orders->with(['items'])->get()
            
        ],200);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orders = PurchaseOrder::with('items')->find($id);
        $items = PurchaseOrderItems::where('purchase_order_id', $id)->get();

        if(!$orders){
            return response()->json([
                'Error' => [
                    'Message' => 'Order does not exist'
                ]
            ],404);
        }

        return response()->json([
            'Orders' => [
                $orders
                ]
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PurchaseOrder $order, OrderPeriod $order_period)
    {
        $orders = Input::get('Orders');
        
        $order_date = Carbon::parse($orders['order_date']);
        $cut_off = Carbon::parse(OrderPeriod::where('id', $orders['order_period_id'])->value('order_cutoff'));
        

        if(!$order_date->isSameDay( $cut_off ) ){
            $order->create($orders);
            $this->addItems(Input::get('Orders.items'));


            return response()->json([
                'Message' => 'The items has been ordered.'
            ]); 
        }
        return response()->json('Cut off day!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, PurchaseOrder $order)
    {        
        $order = PurchaseOrder::find($id);
        $purchase_order_items = Input::get('Orders.items.*');
        
        foreach ($purchase_order_items as $items) {

            $order_item = PurchaseOrderItems::where('purchase_order_id', $id)->update($items);
        }
        $order->update(Input::get('Orders'));
        
        return response()->json([
            'Message' => 'The order is successfully updated'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $order = PurchaseOrder::find($id);

        if(!$order){
            
            return response()->json([
                'Error' => [
                    'Message' => 'Can not be deleted. Order does not exist'
                ]
            ],404);
        }
        $item = PurchaseOrderItems::where('purchase_order_id', $id)->delete();
        $order->delete();

        return response()->json('Order removed successfully',200);
    }

    public function count(){

        return response()->json(['Orders' => count(PurchaseOrder::all())]);
    }    


    public function addItems($purchase_order_items){

        foreach ($purchase_order_items as $items) {
            PurchaseOrderItems::create($items);
        }
    }
    
}


