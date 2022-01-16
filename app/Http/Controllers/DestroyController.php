<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestroyController extends Controller
{
    public function delete($id) {
        $user = User::findOrFail($id);

        if (count($user->pictures->toArray()) > 0) {
            foreach ($user->pictures as $picture) {
                Storage::disk('public')->delete('img/' . $picture->path);
            }
        }

        if ($user->pictures()->delete()) {
            if ($user->delete())
                return redirect(route('user.users'));
        }
    }
}
