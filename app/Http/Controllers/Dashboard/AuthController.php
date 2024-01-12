<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\LoginRequest;
use App\Interfaces\AuthInterface;

class AuthController extends Controller
{
    public function __construct(private AuthInterface $repository){ }

    public function adminLogin(LoginRequest $request)
    {
        
        $data = $this->repository->AdminLogin($request->email , $request->password);
            
        if(!$data) {
            return $this->sendError(__('auth.wrong_credentials'));
        }

        return $this->sendResponse($data);
    }

    public function logout()
    {  
           
    }
}
