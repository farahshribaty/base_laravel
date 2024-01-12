<?php

namespace App\Interfaces;


interface WishListInterface {
    
    public function getWishlistDetailed($userId);
    public function addProductToWishlist($userId, $productId);
    public function removeProductFromWishlist($userId, $productId);

}