<?php

namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Product;
use App\Services\ImageService;
use App\Repositories\Base\CrudBaseRepository;

class ProductRepository extends CrudBaseRepository implements ProductInterface {

    public function __construct() {
        parent::__construct(new Product());
        
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
    
    public function create($data){
        $image = ImageService::upload_image($data['product_main_image'] , 'product');
        $product = parent::create([
            'category_id' => $data['category_id'],
            'product_price' => $data['product_price'],
            'product_quantity' => $data['product_quantity'],
            'product_status' => $data['product_status'],
            'product_main_image' => $image,
            'product_purchasing_count' => $data['product_purchasing_count']
        ]);

        $product->productTranslations()->create([
            'locale' => '1',
            'description'=>$data->description,
            'name'=>$data->en_name
        ]);
        $product->productTranslations()->create([
            'locale' => '2',
            'description'=>$data->description,
            'name'=>$data->ar_name

        ]);
        return true ;

    }

    public function edit(int $id, $data){

        $product = parent::edit($id,$data);
        $product->productTranslations()->update([
            'locale' => '1',
            'description'=>$data->description,
            'name'=>$data->en_name
        ]);
        $product->productTranslations()->update([
            'locale' => '2',
            'description'=>$data->description,
            'name'=>$data->ar_name
        ]);

    }

    public function delete(int $id){

        $product = parent::findByID($id);

        $product->productTranslations()->delete();

        ImageService::delete_image($product->category_image);

        parent::delete($id);
    }
    public function update(int $id, bool $newStatus, $status_column_name){

    }

    public function getAllProductForDashboard(int $perPage = 8, $search = null){
        
        $data = Product::query();
        
        if($search){
            $data->whereHas('productTranslations' , function($query) use ($search){
                $query->where('name' ,"LIKE" ,  "%". $search . "%");    
            });
        }
        $data =  $data->with('productTranslations');
        return  $data->paginate($perPage); 
    }

    public function getOneForDashboard($product_id){
        $product = Product::where('id',$product_id)
        ->with('productTranslations')
        ->first(); 
        return $product; 
    }

    public function getAllProduct($perPage ){
        $data =  Product::byLocale()->active();
        
        return $data->paginate($perPage);
    }

    public function getOne(int $product_id){
        $data = Product::byLocale()->
        where('id', $product_id)->first();

        return $data;
    }

    public function searchProduct($search_keyword)
    {
        // $products = Product::byLocale()
        // ->whereHas('productTranslations', function ($query) use ($search_keyword) {
        //     $query->where('name', 'LIKE', '%' . $search_keyword . '%')
        //     ->orWhereHas('categories.categoryTranslations', function ($categoryTranslationQuery) use ($search_keyword) {
        //         $categoryTranslationQuery->where('name', 'LIKE', '%' . $search_keyword . '%');
        //     });
        // })
        $products = Product::byLocale()
        ->where(function ($query) use ($search_keyword) {
            $query->whereHas('productTranslations', function ($translationQuery) use ($search_keyword) {
                $translationQuery->where('name', 'LIKE', '%' . $search_keyword . '%');
            });
            // ->orWhereHas('category.categoryTranslations', function ($q) use ($search_keyword) {
            //     $q->where('name', 'LIKE', '%' . $search_keyword . '%');
            // });
        })->with('category.categoryTranslations')
        ->get();
        
        return $products;
    }
    public static function substractQuantityIncreasePurchaseCount($product_id, $purchased_quantity){
        $product = Product::where('id', $product_id)->first();

        $product->product_quantity = $product->product_quantity - $purchased_quantity;
        $product->product_purchasing_count = $product->product_purchasing_count + 1;
        
        $product->save();
    }

    



   
}