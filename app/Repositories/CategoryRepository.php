<?php

namespace App\Repositories;

use App\Interfaces\CategoryInterface;
use App\Models\Category;
use App\Models\User;
use App\Repositories\Base\CrudBaseRepository;
use App\Services\ImageService;

class CategoryRepository extends CrudBaseRepository implements CategoryInterface{

    public function __construct() {
        parent::__construct(new Category);
        
        $this->relations = ['categoryTranslations:id,category_id,name'];
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
    public function create($data){
        $image = ImageService::upload_image($data->category_image , 'category');
        $category = parent::create([
            'is_active'=>$data->is_active,
            'category_image'=>$image
        ]);

        $category->categoryTranslations()->create([
            'locale' => '1',
            'name'=>$data->en_name
        ]);
        $category->categoryTranslations()->create([
            'locale' => '2',
            'name'=>$data->ar_name

        ]);

        return true ;
    }
    public function edit($id  , $data){
        $category = parent::edit($id , $data);
        $category->categoryTranslations()->update([
            'locale' => 'en',
            'name'=>$data->en_name
        ]);
        $category->categoryTranslations()->update([
            'locale' => 'ar',
            'name'=>$data->ar_name

        ]);


    }
    public function delete($id){

            $category =parent::findByID($id);

            $category->categoryTranslations()->delete();

            ImageService::delete_image($category->category_image);

            parent::delete($id);
    }
    public function getAllCategoryForDashboard(int $perPage = 8, $search = null){
        
        $data = new Category;

        $data =  $data->where('level' ,'=' , 1);

        if($search){
            $data->whereHas('categoryTranslations' , function($query) use ($search){
                $query->where('name' ,"LIKE" ,  "%". $search . "%");    
            });
        }
        $data->with('categoryTranslations');
        return $data->paginate($perPage);
    
    }
    public function getOneForDashboard(int $category_id){
        $category = Category::where('id',$category_id)
        ->with('categoryTranslations')
        ->first(); 
        return $category; 
    }
    
    //user
    public function getAllCategory($perPage){

        $data =  Category::byLocale()->where('level' ,'=' , 1);
        
        return $data->paginate($perPage);
    
    }
    public function getOne(int $category_id){
        $category = Category::byLocale()->where('id',$category_id)
        ->first(); 
        return $category; 
    }
        
}