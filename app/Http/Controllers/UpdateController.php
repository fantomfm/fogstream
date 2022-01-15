<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
use App\Models\Role;
use App\Models\Department;
use App\Models\DepartmentUser;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function form($id) {
        $user = User::findOrFail($id);

        $positionUser = $user->positionUser;
        $departmentUser = $user->departmentUser;
        $role = $user->role;
        $pictures = $user->pictures;

        $rolesAll = Role::get();
        $positionsAll = Position::get();
        $departmentsAll = Department::get();

        return view('update', [
            'user' => $user,
            'positionUser' => $positionUser,
            'departmentUser' => $departmentUser,
            'role' => $role,
            'pictures' => $pictures,
            'rolesAll' => $rolesAll,
            'positionsAll' => $positionsAll,
            'departmentsAll' => $departmentsAll,
        ]);
    }

    function update($id, Request $request) {

        $validateFields = $request->validate([
            'name' => ['required', 'string'],
            'role' => ['required'],
            'position' => ['required'],
            'departments' => ['required'],
        ]);

        $user = User::findOrFail($id);

        $newDepartment = new DepartmentUser;

        $positions = $user->positions;
        $positionUser = $user->positionUser;
        $departmentUser = $user->departmentUser;
        $departments = $user->departments;
        $role = $user->role;
        $pictures = $user->pictures;

        if ($user->name != $request->name)
            $user->update(['name' => $request->name]);
        
        if ($user->role_id != $request->role)
            $user->update(['role_id' => $request->role]);

        foreach ($positionUser as $item) {
            if ($item->position_id != $request->position) {
                $item->update(['status' => 0]);
                $item->create([
                    'user_id' => $user->id,
                    'position_id' => $request->position,
                ]);
            }
        }

        $array_dep = array_column($departmentUser->toArray(),'department_id');
        
        $arrDep = $request->departments;

        $arrNew = [];

        foreach ($departmentUser as $item) {
            $key = array_search($item->department_id, $arrDep);
            if ($key === false) {
                $item->update(['status' => 0]);
            } else {
                $arrNew[] = $key;
            }
        }

        foreach ($arrDep as $key => $department) {
            if (!in_array($key, $arrNew)) {
                $newDepartment->create([
                    'user_id' => $user->id,
                    'department_id' => $department,
                ]);
            }
        }

        return redirect(route('user.users'));
    }
}
