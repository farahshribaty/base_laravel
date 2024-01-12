<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Enums\ResponseEnum;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Product\CreateProductRequest;
use App\Http\Requests\Dashboard\Product\DeleteProductRequest;
use App\Http\Requests\Dashboard\Product\GetOneProductRequest;
use App\Http\Requests\Dashboard\Product\UpdateProductRequest;
use App\Http\Requests\Dashboard\Product\GetAllProductRequest;

use App\Http\Resources\Dashboard\Product\DeleteProductResource;
use App\Http\Resources\Dashboard\Product\GetAllProductResource;
use App\Http\Resources\Dashboard\Product\GetOneProductResource;
use App\Http\Resources\Dashboard\Product\UpdateProductResource;
use App\Http\Resources\Dashboard\Product\CreateProductResource;
use App\Http\Resources\Dashboard\Product\GetAllProductCollection;
use App\Interfaces\ProductInterface;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    
    public function __construct(private ProductInterface $repository  ) {
       
    }
    public  function  getOne(GetOneProductRequest $request){

        $data = $this->repository->getOneForDashboard($request->product_id);
        $response = new GetOneProductResource($data);
        return $this->sendResponse(ResponseEnum::GET ,$response );
    }
    public  function  getAll(GetAllProductRequest $request){

        $data = $this->repository->getAllProductForDashboard($request->per_page ?? 8 , $request->search );
        $response = new GetAllProductCollection($data);

        return $this->sendResponse(ResponseEnum::GET ,$response );

    }
    public  function  create(CreateProductRequest $request){

        $data = $this->repository->create($request);
        $response = new CreateProductResource($data);

        return $this->sendResponse(ResponseEnum::ADD ,$response );
        
    }
    public  function  update(UpdateProductRequest $request){

        $data = $this->repository->edit($request->product_id , $request->validated());
        $response = new UpdateProductResource($data);

        return $this->sendResponse(ResponseEnum::UPDATE ,$response );
        
    }
    public  function  delete(DeleteProductRequest $request){

        $data = $this->repository->delete($request->id);
        $response = new DeleteProductResource($data);

        return $this->sendResponse(ResponseEnum::DELETE ,$response );
        
    }
   
}
