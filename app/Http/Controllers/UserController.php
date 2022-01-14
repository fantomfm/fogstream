<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users() {
        $users = User::with('role')->paginate(50);

        return view('users', [
            'users' => $users,
        ]);
    }
}
