<?php

namespace App\Http\Controllers;

use App\User;
use Dotenv\Result\Success;
use Dotenv\Store\File\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(){
        return view('Pages.login');
    }
    
    public function auth(Request $request){
     $Validator = Validator::make($request->all(),
        [
            'email'=>'required',
            'password'=>'required'
        ]);

    }

    public function login(Request $request){
    $email = $request->input('email');
     $password = $request->input('password');

     $user = User::where('email', '=', $email)->firstOrFail();
    if($user){
        if (Hash::check($password, $user->password)) {
            session(['berhasil_login' => true]);
           return redirect('/');
        }
    }
        return redirect('/')->with('messgae','Email atau Password Salah');
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/');
    }
}

