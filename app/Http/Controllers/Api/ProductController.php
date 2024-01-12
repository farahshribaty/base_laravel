<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseEnum;
use App\Http\Controllers\Controller;
use App\Interfaces\ProductInterface;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ProductInterface $repository  ) {}
    
    public function getAll(Request $request){

        $data =$this->repository->getAllProduct($request->per_page);
        return $this->sendResponse(ResponseEnum::GET, $data );
    }
    public function getOne(Request $request){

        $data =$this->repository->getOne($request->product_id);
        return $this->sendResponse(ResponseEnum::GET, $data );
    }
    public function searchProduct(Request $request){

        $data = $this->repository->searchProduct($request->search_keyword);
        return $this->sendResponse(ResponseEnum::GET, $data );

    }
   
}
