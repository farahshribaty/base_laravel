<?php

namespace App\Interfaces;

interface OrderInterface {
    
    public function getPaymentClientSecret();
    public function getUserOrders($user_id,$per_page);
    public function getOrderTrackDetails($order_id);
    public function getNewOrderCode();
    public function checkIfUserDidOrder($user_id, $order_id);
    public static function createOrder($payment_id, $order_payment_status, $payment_method, $user_id, $order_code, $order_total, $items, $totals);
}