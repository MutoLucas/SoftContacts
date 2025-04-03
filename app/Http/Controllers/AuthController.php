<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin(){
        return view('login');
    }

    public function authUser(Request $request){
        $dados = $request->except('_token');

        if(!Auth::attempt($dados)){
            return redirect()->back()->with('errorLogin','Invalid Credentials');
        }

        $request->session()->regenerate();
        return redirect()->route('index.index');
    }
}
