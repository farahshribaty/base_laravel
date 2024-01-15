<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Interfaces\UserInterface;

class UserController extends Controller
{
    public function __construct(private UserInterface $repository){}
    public function register(RegisterRequest $request){
        $user = $this->repository->register($request->validated());
        return $this->sendResponse(ResponseEnum::ADD,$user);
    }

    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        $user = $this->repository->login($credentials);

        if ($user) {
            return $this->sendResponse(ResponseEnum::GET,$user);
        }

        return $this->sendError(__('auth.failed'));
    }

    public function logout(){
        $response=$this->repository->logout();
        if($response)
        return $this->sendResponse(ResponseEnum::DELETE,$response);
    }

}
