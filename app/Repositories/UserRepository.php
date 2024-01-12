<?php

namespace App\Repositories;

use App\Interfaces\CategoryInterface;
use App\Models\User;
use App\Repositories\Base\CrudBaseRepository;

class UserRepository extends CrudBaseRepository 
 {
   
    public function __construct(private CategoryInterface $categoryInterface) {
        parent::__construct(new User);
         $this->filterable = [

        "search" =>[
            'name'=>'string',
        ],
        "sort" => [
            'created_at' =>'asc'
        ],
        'custom'=> function($query){
            $query->select('*');
        },
        

    ];
    $this->relations = [];
    }

    // public function getUserAndCategoryThatVIstiIt(){
    //     $user_id = auth()->user()->id;
    //     $user =  User::find($user_id);
    //     $catId = $user->categoryId ; 
    //     $this->categoryInterface->getOne($catId);
    // }
}