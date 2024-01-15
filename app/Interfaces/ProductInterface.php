<?php

namespace App\Interfaces;

use App\Interfaces\base\BaseInterface;

interface ProductInterface extends BaseInterface {
    
    public function getAllProductForDashboard(int $perPage = 8, $search = null);
    public function getAllProduct(int $perPage ) ;
    public function getOneForDashboard(int $product_id);
    public function searchProduct($search_keyword);
    public static function substractQuantityIncreasePurchaseCount($product_id, $purchased_quantity);
}