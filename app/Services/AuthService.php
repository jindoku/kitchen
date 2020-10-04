<?php


namespace App\Services;


use Illuminate\Support\Facades\Auth;

class AuthService
{

    public function login($username, $password, $remember = false)
    {
        return Auth::attempt(['name' => $username, 'password' => $password], $remember);
    }
}
