<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserPageController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create_form');
    }

    public function edit(User $user)
    {
        return view('users.update_form', ['id' => $user->id]);
    }
}
