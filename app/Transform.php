<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transform extends Model
{
    //
    public function collections($orders){
        return array_map([$this, 'transformAll'], $orders->toArray());
    }
    private function transformAll($order){

        $item = PurchaseOrderItems::find($order['id']);
        
        return [
            'id' => $order['id'],
            'customer_id' => $order['customer_id'],
            // Customer::find($order['customer_id']),
            'address_id' => $order['address_id'],
            'order_period_id' => $order['order_period_id'],
            // OrderPeriod::find($order['order_period_id']),
            'order_date' => $order['order_date'],
            'total_price' => $order['total_price'],
            'delivery_status' => $order['delivery_status'],
            'items' => $order->item['id']
            // 'items' => [
            //     'id' => $item['id'],
            //     'purchase_order_id' => $item['purchase_order_id'],
            //     'product_id' => Products::find($item['product_id']),
            //     'unit' => $item['unit'],
            //     'quantity' => $item['quantity']
            // ]

        ];
    }

    public function transformz($order){

         $items = PurchaseOrderItems::find($order['id']);
        return [
            'id' => [
                PurchaseOrderItems::find($order['id'])
                // 'id' => $items['id'],
                // 'purchase_order_id' => $items['purchase_order_id'],
                // 'product_id' => Products::find($items['product_id']),
                // 'unit' => $items['unit'],
                // 'quantity' => $items['quantity']
            ],
            'customer_id' => Customer::find($order['customer_id']),
            'address_id' => $order['address_id'],
            'order_period_id' => OrderPeriod::find($order['order_period_id']),
            'order_date' => $order['order_date'],
            'total_price' => $order['total_price'],
            'delivery_status' => $order['delivery_status']

        ];
    }

    
    // public function collections($orders){
    //     return array_map(function($order){
    //         return [
    //             'id' => PurchaseOrderItems::find($order['id']),
    //             'customer_id' => Customer::find($order['customer_id']),
    //             'address_id' => $order['address_id'],
    //             'order_period_id' => OrderPeriod::find($order['order_period_id']),
    //             'order_date' => $order['order_date'],
    //             'total_price' => $order['total_price'],
    //             'delivery_status' => $order['delivery_status']

    //         ];
    //     }, $orders->toArray());
    // }
}
