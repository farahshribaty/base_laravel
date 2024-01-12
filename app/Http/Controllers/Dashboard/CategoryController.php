<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Enums\ResponseEnum;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Catgeory\CreateCatgeoryRequest;
use App\Http\Requests\Dashboard\Catgeory\DeleteCatgeoryRequest;
use App\Http\Requests\Dashboard\Catgeory\GetOneCatgeoryRequest;
use App\Http\Requests\Dashboard\Catgeory\UpdateCatgeoryRequest;
use App\Http\Requests\Dashboard\Catgeory\GetAllCatgeoryRequest;

use App\Http\Resources\Dashboard\Catgeory\DeleteCatgeoryResource;
use App\Http\Resources\Dashboard\Catgeory\GetAllCatgeoryResource;
use App\Http\Resources\Dashboard\Catgeory\GetOneCatgeoryResource;
use App\Http\Resources\Dashboard\Catgeory\UpdateCatgeoryResource;
use App\Http\Resources\Dashboard\Catgeory\CreateCatgeoryResource;
use App\Http\Resources\Dashboard\Catgeory\GetAllCatgeoryCollection;
use App\Interfaces\CategoryInterface;

class CategoryController extends Controller
{
    
    public function __construct(private CategoryInterface $repository  ) {
       
    }
    public  function  getOne(GetOneCatgeoryRequest $request){
        $data = $this->repository->getOneWithRelations($request->category_id);
        $response = new GetOneCatgeoryResource($data);
        return $this->sendResponse(ResponseEnum::GET ,$response );
    }
    public  function  getAll(GetAllCatgeoryRequest $request){

        $data = $this->repository->getAllCategoryForDashboard($request->per_page ?? 8 , $request->search );
        $response =  new GetAllCatgeoryCollection($data);

        return $this->sendResponse(ResponseEnum::GET ,$response );

    }
    public  function  create(CreateCatgeoryRequest $request){

        $data = $this->repository->create($request);
        $response = new CreateCatgeoryResource($data);

        return $this->sendResponse(ResponseEnum::ADD ,$response );
        
    }
    public  function  update(UpdateCatgeoryRequest $request){

        $data = $this->repository->edit($request->catgeory_id , $request->validated());
        $response = new UpdateCatgeoryResource($data);

        return $this->sendResponse(ResponseEnum::UPDATE ,$response );
        
    }
    public  function  delete(DeleteCatgeoryRequest $request){

        $data = $this->repository->delete($request->id);
        $response = new DeleteCatgeoryResource($data);

        return $this->sendResponse(ResponseEnum::DELETE ,$response );
        
    }
   
}
