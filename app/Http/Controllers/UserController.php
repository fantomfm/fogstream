<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function users(Request $request) {
        
        $request->flash();

        if ($request->search) {
            $validateFields = $request->validate([
                'search' => ['string', 'min:2'],
            ]);
            $search = $validateFields['search'];
            $users = User::where('name', 'LIKE', '%' . $search . '%')
                // ->orWhere()
                ->paginate(20);
            $users->appends($request->all());
        } else {
            $users = User::paginate(20);
        }

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
