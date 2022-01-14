<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        if(Auth::check()){
            return redirect(route('user.users'));
        }

        $formFields = $request->only(['user', 'password']);

        if(Auth::attempt($formFields)){
            return redirect(route('user.users'));
        }

        return redirect(route('user.login'))->withErrors([
            'formError' => 'Не удалось авторизоваться'
        ]);
    }
}
