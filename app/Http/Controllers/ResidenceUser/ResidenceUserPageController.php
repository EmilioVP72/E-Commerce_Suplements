<?php

namespace App\Http\Controllers\ResidenceUser;

use App\Http\Controllers\Controller;
use App\Models\Residence_User;
use App\Models\User;
use App\Models\Residence;
use Illuminate\Http\Request;

class ResidenceUserPageController extends Controller
{
    public function index()
    {
        $residenceUsers = Residence_User::with(['user', 'residence'])->get();
        return view('residence_users.index', compact('residenceUsers'));
    }

    public function create()
    {
        $users = User::all();
        $residences = Residence::all();
        return view('residence_users.create', compact('users', 'residences'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|integer|exists:users,id',
            'id_residence' => 'required|integer|exists:residence,id_residence',
        ]);

        Residence_User::create($request->all());

        return redirect()->route('residence_users.index')->with('success', 'Asignación creada exitosamente.');
    }

    public function edit(Residence_User $residence_user)
    {
        $users = User::all();
        $residences = Residence::all();
        return view('residence_users.edit', compact('residence_user', 'users', 'residences'));
    }

    public function update(Request $request, Residence_User $residence_user)
    {
        $request->validate([
            'id_user' => 'sometimes|required|integer|exists:users,id',
            'id_residence' => 'sometimes|required|integer|exists:residence,id_residence',
        ]);

        $residence_user->update($request->all());

        return redirect()->route('residence_users.index')->with('success', 'Asignación actualizada exitosamente.');
    }

    public function destroy(Residence_User $residence_user)
    {
        $residence_user->delete();
        return redirect()->route('residence_users.index')->with('success', 'Asignación eliminada exitosamente.');
    }
}
