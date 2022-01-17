<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class DestroyController extends Controller
{
    public function delete($id) {
        
        Gate::authorize( ability: 'isAdmin');

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

    public function deleteImage($id) {
        
        $user = User::findOrFail($id);

        Gate::authorize('update', $user);

        if (count($user->getLastPicture->toArray()) > 0) {
            foreach ($user->getLastPicture as $picture) {
                Storage::disk('public')->delete('img/' . $picture->path);
                $delete = $picture->delete();
            }
        }

        if ($delete)
            return redirect(route('user.update', $user->id));
    }
}
