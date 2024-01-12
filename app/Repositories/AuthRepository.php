<?php 

namespace App\Repositories;

use App\Interfaces\AuthInterface;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthInterface{

    public function AdminLogin($email , $password){

        $credentials = [
            'email'    => $email,
            'password' => $password,
        ];
        //  dd(auth()->guard('admin')?->attempt($credentials));
        // if (Auth::guard('admin')->validate($credentials)) {
            $admin = Admin::where('email' , $email)->first();
            $token = $admin->createToken('admin-token')->plainTextToken;

            return $token;
        // }

        return null;
    }

    public function AdminLogout(){
        Auth::guard('admin')->user()->tokens()->delete();
    }

}