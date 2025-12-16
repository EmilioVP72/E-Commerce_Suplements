<?php

namespace App\Http\Controllers\Residence;

use App\Http\Controllers\Controller;
use App\Models\Residence;

class ResidencePageController extends Controller
{
    public function index()
    {
        $residences = Residence::all();
        return view('residences.index', compact('residences'));
    }

    public function create()
    {
        return view('residences.create_form');
    }

    public function edit(Residence $residence)
    {
        return view('residences.update_form', ['id' => $residence->id_residence]);
    }
}
