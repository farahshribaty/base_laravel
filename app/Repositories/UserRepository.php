<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use App\Repositories\Base\CrudBaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository extends CrudBaseRepository implements UserInterface{
    public function __construct() {
        parent::__construct(new User());

        $this->relations = [];
        $this->filterable = [
        
        ];

    }
    
    public function register(array $data){
        $data = User::create($data);
        $data->password= Hash::make($data['password']);
        $data['token'] = $data->createToken('MyApp', ['user'])->plainTextToken;
        $data->save();
        return $data;
    }
    public function login($credentials){
       
        $user = User::where('email', $credentials['email'])->first();
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return null;
        }
        $user['token'] = $user->createToken('MyApp', ['user'])->plainTextToken;
        return $user;
    }
    public function logout(){
        auth()->user()->tokens()->delete();
        return true;
    }
    public function updateUserAddressByUser($user_id,$address_request, $order_id){
        $user = User::where('id', $user_id)->first();
        $user_address = $user->address()->create($address_request);

        $user_address->order_id = $order_id;
        $user_address->save();
        
        return [];
    }
}