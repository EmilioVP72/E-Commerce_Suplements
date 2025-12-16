<?php

namespace App\Http\Controllers\Privilege;

use App\Http\Controllers\Controller;
use App\Models\Privilege;

class PrivilegePageController extends Controller
{
    public function index()
    {
        $privileges = Privilege::all();
        return view('privileges.index', compact('privileges'));
    }

    public function create()
    {
        return view('privileges.create_form');
    }

    public function edit(Privilege $privilege)
    {
        return view('privileges.update_form', ['id' => $privilege->id_privilege]);
    }
}
