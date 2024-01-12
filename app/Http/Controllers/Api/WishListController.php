<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\WishlistRequest;
use App\Http\Resources\WishlistResource;
use App\Interfaces\WishListInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function __construct(private WishListInterface $repository  ){}
    
    public function getWishlistDetailed(Request $request){
       
        $data =$this->repository->getWishlistDetailed($request->userId);
        $response = WishlistResource::collection($data);
        return $this->sendResponse(ResponseEnum::GET, $response );
    }
    public function addProductToWishlist(WishlistRequest $request){
        // $userId = auth()->user()->id;
        $data =$this->repository->addProductToWishlist($request->user_id, $request->product_id);   
        if(!$data){
            return $this->sendError(__('message.wish_list_exist_error'));
        }
        return $this->sendResponse(ResponseEnum::ADD, $data );
    }
    public function addProductToWishlistForSpecificUser(WishlistRequest $request){
     
        $data =$this->repository->addProductToWishlist($request->user_id, $request->product_id);
        return $this->sendResponse(ResponseEnum::ADD, $data );
    }
    public function removeProductFromWishlist(WishlistRequest $request){

        $data =$this->repository->removeProductFromWishlist($request->user_id, $request->product_id); 
        if(!$data){
            return $this->sendError(__('message.wish_list_not_exist_error'));
        }
        return $this->sendResponse(ResponseEnum::DELETE, $data );
    }
}



















