<?php

namespace App\Interfaces;


interface CartInterface {
    public function getCartDetails(int $perPage , int $user_id);
    public function addProductToCart(int $user,int $cart_id, int $quantity);
    public function removeProductFromCart();
}