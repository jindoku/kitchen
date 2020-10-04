<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(AuthRequest $request){
        if($request->isMethod('post')){
            $remember = $request->remember ? true : false;
            if ($this->authService->login($request['username'], $request['password'], $remember)) {
                return redirect()->route('staff.index');
            } else {
                $message = 'Tên đăng nhập hoặc mật khẩu không đúng!';
                return view('component.auth.login', compact('message'));
            }
        }
        return view('component.auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return view('component.auth.login');
    }

}
