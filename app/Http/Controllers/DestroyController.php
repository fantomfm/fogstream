<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function delete($id) {
        $user = User::findOrFail($id)->delete();

        if ($user)
            return redirect(route('user.users'));
    }
}
