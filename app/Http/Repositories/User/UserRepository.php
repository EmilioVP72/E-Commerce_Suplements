<?php

namespace App\Http\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserRepository
{
    /**
     * Crear un nuevo usuario
     */
    public function create(array $data)
    {
        // Procesar la foto si existe
        if (isset($data['photo']) && $data['photo']) {
            $data['photo'] = Storage::disk('public')->put('users', $data['photo']);
        }

        return User::create($data);
    }

    /**
     * Obtener usuario por ID
     */
    public function findById($id)
    {
        return User::find($id);
    }

    /**
     * Actualizar un usuario
     */
    public function update($id, array $data)
    {
        $user = User::find($id);

        if (!$user) {
            return null;
        }

        // Procesar la foto si existe
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

    /**
     * Eliminar un usuario
     */
    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return false;
        }

        // Eliminar foto si existe
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        return $user->delete();
    }

    /**
     * Obtener todos los usuarios
     */
    public function getAll()
    {
        return User::all();
    }
}
