<?php

namespace App\Http\Controllers\Rol;

use App\Http\Controllers\Controller;
use App\Models\Rol;

class RolPageController extends Controller
{
    public function index()
    {
        $roles = Rol::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create_form');
    }

    public function edit(Rol $rol)
    {
        return view('roles.update_form', ['id' => $rol->id_rol]);
    }
}
