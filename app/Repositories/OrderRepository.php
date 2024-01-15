<?php

namespace App\Repositories;

use App\Interfaces\OrderInterface;
use App\Models\Order;
use Carbon\Carbon;

class OrderRepository implements OrderInterface{
   
    public function getPaymentClientSecret(){

    }
    public function getUserOrders($user_id , $per_page){
        $data = [];

        $orders = Order::where('customer_id', $user_id)
        ->select(['id', 'order_code', 'customer_id', 'payment_status', 'created_at', 'order_status', 'order_total'])
        ->orderBy('created_at', 'DESC')->get();

        $data['order'] = $orders;
        $data['order_all_total'] = Order::where('customer_id', $user_id)->sum('order_total');
        return $data;
    }
    public function getOrderTrackDetails($order_id){
        $data = [];

        $order = Order::where('id', $order_id)->first();

        $order->totals = json_decode($order->totals);
        $order->items = json_decode($order->items);

        $data = $order;

        return $data;
    }
 
    public function getNewOrderCode(){
        $prefix = 'PO-';
        $now = Carbon::now();
        $current_year = $now->year;
        $last_transaction = Order::orderBy('id', 'desc')->first();
        if ($last_transaction == null) {
            $last_point_transaction_id = 1;
        } else {
            $last_point_transaction_id = 1 + $last_transaction->id;
        }
        $code = $prefix . $current_year . '-' . $last_point_transaction_id;

        return $code;
    }
    public function checkIfUserDidOrder($user_id, $order_id){
        $order = Order::where([['id', $order_id], ['customer_id', $user_id]])->first();
        if (!$order) {
            return false;
        } else {
            return true;
        }
    }

    public static function createOrder($payment_id, $order_payment_status, $payment_method, $user_id, $order_code, $order_total, $items, $totals){
        $order = Order::create([
            'order_code' => $order_code,
            'customer_id' => $user_id,
            'payment_method' => $payment_method,
            'payment_id' => $payment_id,
            'payment_status' => $order_payment_status,
            'order_total' => $order_total,
            'totals' => json_encode($totals),
            'items' => json_encode($items['products']),
            'order_status' => 'pending',
        ]);

        return $order;
    }
}