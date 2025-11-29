<?php

namespace App\Http\Controllers\UserRol;

use App\Http\Controllers\Controller;
use App\Models\User_Rol;
use App\Models\User;

class UserRolPageController extends Controller
{
    public function index()
    {
        $userRoles = User_Rol::with('user', 'rol')->get();
        return view('user_roles.index', compact('userRoles'));
    }

    public function create()
    {
        $users = User::all();
        return view('user_roles.create_form', compact('users'));
    }

    public function edit(User_Rol $userRol)
    {
        $users = User::all();
        return view('user_roles.update_form', ['id' => $userRol->id, 'users' => $users]);
    }
}
