<?php

namespace App\Http\Controllers\RolPrivilege;

use App\Http\Controllers\Controller;
use App\Models\Rol_Privilege;
use App\Models\Rol;

class RolPrivilegePageController extends Controller
{
    public function index()
    {
        $rolPrivileges = Rol_Privilege::with('rol', 'privilege')->get();
        return view('rol_privileges.index', compact('rolPrivileges'));
    }

    public function create()
    {
        $roles = Rol::all();
        return view('rol_privileges.create_form', compact('roles'));
    }

    public function edit(Rol_Privilege $rolPrivilege)
    {
        $roles = Rol::all();
        return view('rol_privileges.update_form', ['id' => $rolPrivilege->id, 'roles' => $roles]);
    }
}
