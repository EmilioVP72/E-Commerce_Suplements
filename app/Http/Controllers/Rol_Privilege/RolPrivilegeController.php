<?php

namespace App\Http\Controllers\RolPrivilege;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolPrivilege\RolPrivilegeRequest;
use App\Models\Rol;
use App\Models\Privilege;
use App\Traits\UtilResponse;
use App\Http\Resources\Privilege\PrivilegeResource;

class RolPrivilegeController extends Controller
{
    private $utilResponse;

    public function __construct(UtilResponse $utilResponse)
    {
        $this->utilResponse = $utilResponse;
    }

    public function getPrivilegesByRol($id_rol)
    {
        $rol = Rol::with('privilegios')->find($id_rol);

        if (!$rol) {
            return $this->utilResponse->errorResponse('El rol no existe', 404);
        }

        return $this->utilResponse->succesResponse(PrivilegeResource::collection($rol->privilegios), 'Privilegios del rol obtenidos correctamente');
    }

    public function assignPrivilege(RolPrivilegeRequest $request)
    {
        $data = $request->validated();
        $rol = Rol::find($data['id_rol']);
        $rol->privilegios()->syncWithoutDetaching($data['id_privilege']);

        return $this->utilResponse->succesResponse(null, 'Privilegio asignado correctamente', 201);
    }

    public function revokePrivilege(RolPrivilegeRequest $request)
    {
        $data = $request->validated();
        $rol = Rol::find($data['id_rol']);

        $rol->privilegios()->detach($data['id_privilege']);

        return $this->utilResponse->succesResponse(null, 'Privilegio revocado correctamente');
    }
}
