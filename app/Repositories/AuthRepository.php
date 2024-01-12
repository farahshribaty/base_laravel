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
        $admin = Admin::where('email', $credentials['email'])->first();
    
        if (!$admin ||$admin->password !== $credentials['password']) {
            return response([
                'msg' => 'incorrect username or password'
            ], 401);
        }
        $token = $admin->createToken('admin')->plainTextToken;
        return [
            'admin' => $admin,
            'token' => $token,
        ];
    }

    public function AdminLogout(){
        auth()->user()->tokens()->delete();
        // dd(Auth::guard('admin')->user()->id);
        // Auth::guard('admin')->user()->tokens()->delete();
        // Auth::user()->getRememberToken()->delete();
        // Auth::user()->tokens()->where('id', Auth::user()->currentAccessToken()->id)->delete();
    }

}