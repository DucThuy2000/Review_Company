<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        return view("auth.core.login");
    }

    public function authenticate(Request $request){
        try{
            $email = $request -> auth_email;
            $password = $request -> auth_password;

            if( Auth::attempt(['email' => $email, 'password' => $password]) ){
                return response() -> json([
                    'code' => 200,
                    'message' => 'Đăng nhập thành công'
                ],200);
            }
        }
        catch (\Exception $e){
            $e -> getMessage();
        }
    }

    public function logout(){
        Auth::logout();
        return redirect() -> route("auth.login");
    }
}
