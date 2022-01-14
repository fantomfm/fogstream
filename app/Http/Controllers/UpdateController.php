<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function form($id) {
        $user = User::findOrFail($id);

        $positions = $user->positions;
        $departments = $user->departments;
        $role = $user->role;
        $pictures = $user->pictures;

        $positionsAll = Position::get();

        return view('update', [
            'user' => $user,
            'positions' => $positions,
            'departments' => $departments,
            'role' => $role,
            'pictures' => $pictures,
            'positionsAll' => $positionsAll,
        ]);
    }

    function update($id, Request $request) {

        $validateFields = $request->validate([
            'name' => ['required', 'string'],
            'role' => ['required'],
            'position' => ['required'],
            'department' => ['required'],
        ]);

        $user = User::findOrFail($id);

        $positions = $user->positions;
        $departments = $user->departments;
        $role = $user->role;
        $pictures = $user->pictures;

        $positionsAll = Position::get();

        return view('update', [
            'user' => $user,
            'positions' => $positions,
            'departments' => $departments,
            'role' => $role,
            'pictures' => $pictures,
            'positionsAll' => $positionsAll,
        ]);
    }
}
