<?php

namespace App\Http\Controllers\UserRol;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRol\UserRolRequest;
use App\Models\User;
use App\Models\Rol;
use App\Traits\UtilResponse;
use App\Http\Resources\Rol\RolResource;

class UserRolController extends Controller
{
    protected $utilResponse;

    public function __construct()
    {
        $this->utilResponse = new UtilResponse();
    }

    public function getRolesByUser($id_user)
    {
        $user = User::with('roles')->find($id_user);

        if (!$user) {
            return $this->utilResponse->errorResponse('El usuario no existe', 404);
        }

        return $this->utilResponse->succesResponse(RolResource::collection($user->roles), 'Roles del usuario obtenidos correctamente');
    }

    public function assignRol(UserRolRequest $request)
    {
        $data = $request->validated();
        $user = User::find($data['id_user']);
        $user->roles()->syncWithoutDetaching($data['id_rol']);

        return $this->utilResponse->succesResponse(null, 'Rol asignado correctamente', 201);
    }

    public function revokeRol(UserRolRequest $request)
    {
        $data = $request->validated();
        $user = User::find($data['id_user']);

        $user->roles()->detach($data['id_rol']);

        return $this->utilResponse->succesResponse(null, 'Rol revocado correctamente');
    }
}
