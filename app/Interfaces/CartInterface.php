<?php

namespace App\Interfaces;


interface CartInterface {
    public function getCartDetails(int $perPage , int $user_id);
    public function addProductToCart(int $user,int $cart_id, int $quantity);
    public function removeProductFromCart(int $cart,int $product_id);
    public function updateCartPrices($cart_id);
    public function checkCartIfEmpty(int $user_id);
    public function checkCartProductsQuantities($cart);
    public function getCartProductsForOrder(int $cart_id);
    public function getCartTotalsForOrder(int $cart_id);
    public static function emptyUserCart($user_id);   
}