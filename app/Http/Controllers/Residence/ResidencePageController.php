<?php

namespace App\Http\Controllers\Residence;

use App\Http\Controllers\Controller;
use App\Models\Residence;
use Illuminate\Http\Request;

class ResidencePageController extends Controller
{
    public function index()
    {
        $residences = Residence::all();
        return view('residences.index', compact('residences'));
    }

    public function create()
    {
        return view('residences.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'country' => 'required|string|max:255',
        ]);

        Residence::create($request->all());

        return redirect()->route('residences.index')->with('success', 'Residencia creada exitosamente.');
    }

    public function edit(Residence $residence)
    {
        return view('residences.edit', compact('residence'));
    }

    public function update(Request $request, Residence $residence)
    {
        $request->validate([
            'address' => 'sometimes|required|string|max:255',
            'city' => 'sometimes|required|string|max:255',
            'state' => 'sometimes|required|string|max:255',
            'zip_code' => 'sometimes|required|string|max:10',
            'country' => 'sometimes|required|string|max:255',
        ]);

        $residence->update($request->all());

        return redirect()->route('residences.index')->with('success', 'Residencia actualizada exitosamente.');
    }

    public function destroy(Residence $residence)
    {
        $residence->delete();
        return redirect()->route('residences.index')->with('success', 'Residencia eliminada exitosamente.');
    }
}
