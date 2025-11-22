<?php

namespace App\Http\Controllers\ResidenceUser;

use App\Http\Controllers\Controller;
use App\Models\Residence_User;

class ResidenceUserPageController extends Controller
{
    public function index()
    {
        $residenceUsers = Residence_User::with(['users', 'residence'])->get();
        return view('residence_users.index', compact('residenceUsers'));
    }

    public function create()
    {
        return view('residence_users.create_form');
    }

    public function edit(Residence_User $residence_user)
    {
        return view('residence_users.update_form', ['id' => $residence_user->id_residence_user]);
    }
}
