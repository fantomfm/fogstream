<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function users() {
        DB::enableQueryLog();
        $users = User::with('role', 'positions', 'departments')->paginate(20);
        // dd(DB::getQueryLog());
        
        //dd($users);

        return view('users', [
            'users' => $users,
        ]);
    }

    public function show($id) {
        $user = User::findOrFail($id);

        $positions = $user->positions;
        $departments = $user->departments;
        $role = $user->role;
        $pictures = $user->pictures;

        return view('show', [
            'user' => $user,
            'positions' => $positions,
            'departments' => $departments,
            'role' => $role,
            'pictures' => $pictures,
        ]);
    }
}
