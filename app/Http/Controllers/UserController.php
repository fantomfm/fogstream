<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function users() {

        $users = User::paginate(20);

        return view('users', [
            'users' => $users,
        ]);
    }

    public function search(Request $request) {
        
        $validateFields = $request->validate([
            'search' => ['string'],
        ]);

        dd($validateFields);

        $users = User::where('name', 'LIKE', "%{$validateFields['search']}%")->paginate(1);

        return view('users', [
            'users' => $users,
        ]);

    }

    public function show($id) {
        
        $user = User::findOrFail($id);

        return view('show', [
            'user' => $user,
        ]);
    }
}
