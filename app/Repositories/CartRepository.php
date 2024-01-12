<?php

namespace App\Repositories;

use App\Interfaces\CartInterface;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use App\Repositories\Base\CrudBaseRepository;

class CartRepository extends CrudBaseRepository implements CartInterface  {
   
    public function __construct() {
        parent::__construct(new Cart());
        
        $this->relations = [];
        $this->filterable = [
            // "search" =>[
            //     'name'=>'string',
            // ],
            // "sort" => [
            //     'created_at' =>'desc'
            // ],
            // 'custom'=> function($query){
            //     $query->select('id');
            // },  
        ];

    }

    public function getCartDetails($perPage = 8,$user_id){

        $data =  Cart::where('user_id',$user_id )->with('cartItems')->paginate($perPage);
        return $data;
    }
    public function addProductToCart($user,$product_id,$quantity){
        $cart = $user->cart()->first();

        if (isset($cart)) {
            $cart_product = CartItem::where([['cart_id', $cart->id], ['product_id', $product_id]])->first();

            if (isset($cart_product)) {
                $cart_product->quantity = $quantity;
                $cart_product->save();
            } else {
                $cart->cartItems()->create([
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                ]);
            }
            $cart->cart_items_count += 1;
            $cart->save();
        } else {

            $cart = $user->cart()->create([
                'sub_total' => 0,
                'delivery_fees' => 0,
                'overall_total' => 0,
                'cart_items_count' => 1,
            ]);

            $cart->cartItems()->create([
                'product_id' => $product_id,
                'quantity' => $quantity,
            ]);
        }

        // CartService::updateCartPrices($cart->id);

        return [];
    }
    public function removeProductFromCart(){

    }


}
