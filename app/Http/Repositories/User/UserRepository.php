<?php

namespace App\Http\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserRepository
{
    public function create(array $data)
    {
        if (isset($data['photo']) && $data['photo']) {
            $data['photo'] = Storage::disk('public')->put('users', $data['photo']);
        }

        return User::create($data);
    }

    public function findById($id)
    {
        return User::find($id);
    }

    public function update($id, array $data)
    {
        $user = User::find($id);

        if (!$user) {
            return null;
        }

        if (isset($data['photo']) && $data['photo']) {
            // Eliminar foto anterior si existe
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $data['photo'] = Storage::disk('public')->put('users', $data['photo']);
        }

        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return false;
        }

        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        return $user->delete();
    }

    public function getAll()
    {
        return User::all();
    }
}
