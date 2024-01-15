<?php
namespace App\Interfaces;

interface UserInterface {
    public function register(array $data);
    public function login(array $credentials);
    public function logout();
    public function updateUserAddressByUser($user_id,$address_request, $order_id);
}