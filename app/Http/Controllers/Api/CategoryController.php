<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseEnum;
use App\Http\Controllers\Controller;
use App\Interfaces\CategoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(private CategoryInterface $repository  ) {}
    
    public function getAll(Request $request){

        $data =$this->repository->getAllCategory($request->per_page);
        return $this->sendResponse(ResponseEnum::GET, $data );
    }
    public function getOne(Request $request){

        $data =$this->repository->getOne($request->category_id);
        return $this->sendResponse(ResponseEnum::GET, $data );
    }

}
