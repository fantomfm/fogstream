<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function save(Request $request){
        if(Auth::check()){
            return redirect(route('user.users'));
        }

        $validateFields = $request->validate([
            'name' => ['required', 'string'],
            'user' => ['required', 'string'],
            'password' => ['required', 'confirmed'],
        ]);

        if(User::where('user', $validateFields['user'])->exists()){
            return redirect(route('user.registration'))->withErrors([
                'user' => 'Такой пользователь уже существует'
            ]);
        }

        $user = User::create($validateFields);

        if($user){
            Auth::login($user);
            return redirect(route('user.users'));
        }

        return redirect(route('user.registration'))->withErrors([
            'formError' => 'Произошла ошибка при регистрации пользователя'
        ]);
    }
}
