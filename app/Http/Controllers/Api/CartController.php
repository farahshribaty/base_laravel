<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductToCartRequest;
use App\Http\Resources\CartCollection;
use App\Interfaces\CartInterface;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private CartInterface $repository  ) {}

    public function getCartDetails(Request $request){
        $data =$this->repository->getCartDetails($request->per_page , $request->user_id);
        $data = new CartCollection($data);
        return $this->sendResponse(ResponseEnum::GET, $data );
    }
    public function addProductToCart(AddProductToCartRequest $request){
        // $user= auth()->user()->id;
        $user = 1;
        $data =$this->repository->addProductToCart($user, $request->product_id , $request->quantity);
        
        if(!$data){
            return $this->sendError(__('message.cart_exist_error'));
        }
        return $this->sendResponse(ResponseEnum::ADD, $data );

    }
    public function removeProductFromCart(){
    }
   
}
