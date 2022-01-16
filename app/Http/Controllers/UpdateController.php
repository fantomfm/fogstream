<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
use App\Models\Role;
use App\Models\Department;
use App\Models\DepartmentUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function form($id) {
        $user = User::findOrFail($id);

        $rolesAll = Role::get();
        $positionsAll = Position::get();
        $departmentsAll = Department::get();

        return view('update', [
            'user' => $user,
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
            'image' => ['image', 'mimetypes:image/jpeg,image/png'],
        ]);

        $user = User::findOrFail($id);

        $newDepartment = new DepartmentUser;

        $pictures = $user->pictures();

        if ($user->name != $request->name)
            $user->update(['name' => $request->name]);
        
        if ($user->role_id != $request->role)
            $user->update(['role_id' => $request->role]);

        foreach ($user->positionUser as $item) {
            if ($item->position_id != $request->position) {
                $item->update(['status' => 0]);
                $item->create([
                    'user_id' => $user->id,
                    'position_id' => $request->position,
                ]);
            }
        }
        
        $arrDep = $request->departments;

        foreach ($user->departmentUser as $item) {
            $key = array_search($item->department_id, $arrDep);
            if ($key === false) {
                $item->update(['status' => 0]);
            } else {
                unset($arrDep[$key]);
            }
        }

        foreach ($arrDep as $key => $department) {
            $newDepartment->create([
                'user_id' => $user->id,
                'department_id' => $department,
            ]);
        }

        if ($request->has('image')) {

            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $folder = 'public/img';         
            
            if(in_array($filename, array_column($user->pictures->toArray(),'path'))) {
                return redirect(route('user.update', $user->id))->withErrors([
                    'image' => 'Изображение с таким именем уже существует'
                ]);
            }
            
            if (Storage::putFileAs($folder, $file, $filename)) {
                $pictures->create([
                    'path' => $filename,
                ]);
            }
        }

        return redirect(route('user.users'));
    }
}
