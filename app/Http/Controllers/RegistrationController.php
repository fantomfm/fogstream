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

        $request->flash();

        $validateFields = $request->validate([
            'name' => ['required', 'string'],
            'user' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::create($validateFields);

        $user->positionUser()->create([
            'position_id' => 1,
        ]);

        $user->departmentUser()->create([
            'department_id' => 1,
        ]);

        if($user){
            Auth::login($user);
            return redirect(route('user.users'));
        }

        return redirect(route('user.registration'))->withErrors([
            'formError' => 'Произошла ошибка при регистрации пользователя'
        ]);
    }
}
