<?php

namespace App\Repositories;

use App\Interfaces\WishListInterface;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use App\Repositories\Base\CrudBaseRepository;
use Illuminate\Cache\Repository;

class WishListRepository extends CrudBaseRepository implements WishListInterface  {

    public function __construct() {
        parent::__construct(new Wishlist());

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

    public function getWishlistDetailed($userId){

        if (!$userId) {
            // Handle the case where the user is not found
            return response()->json(['error' => 'User not found'], 404);
        }

        $userWishlist = Wishlist::where('user_id', $userId)
        ->select('id', 'user_id', 'product_id')
        ->with('product:id,product_price,product_main_image') // Eager load product information with selected fields
        ->get();

        return $userWishlist;

    }
    public function addProductToWishlist($userId, $productId){
        $user = User::find($userId);

        // Check if the product is already in the wishlist
        if ($user->wishlist()->where('product_id', $productId)->exists()) {
            return false;
        }

        $wishlist = $this->create([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        // $wishlist = Wishlist::create([
        //     'user_id' => $userId,
        //     'product_id' => $productId,
        // ]);

        return $wishlist;
    }
    public function removeProductFromWishlist($userId, $productId){
        $user = User::find($userId);
        $wishlistItem = $user->wishlist()->where('product_id', $productId)->first();

        if (!$wishlistItem) {
            return false;
        }
        $this->delete($wishlistItem->id);
        // $wishlistItem->delete();
        return true;
    }

}
