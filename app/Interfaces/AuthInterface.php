<?php

namespace App\Interfaces;

interface AuthInterface {
    
    public function AdminLogout();


    public function AdminLogin($email , $password);


}