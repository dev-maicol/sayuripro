<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use App\Models\Cargo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TrabajadorController extends Controller
{
    public function index(Request $request)
    {
        $query = Trabajador::with('cargo', 'user');

        if ($request->filled('nombres')) {
            $query->where('nombres', 'like', '%' . $request->nombres . '%');
        }

        if ($request->filled('paterno')) {
            $query->where('paterno', 'like', '%' . $request->paterno . '%');
        }

        if ($request->filled('materno')) {
            $query->where('materno', 'like', '%' . $request->materno . '%');
        }

        if ($request->filled('fecha_nacimiento')) {
            $query->whereDate('fecha_nacimiento', $request->fecha_nacimiento);
        }
        

        $trabajadores = $query->latest()->paginate(10);

        return view('trabajadores.index', compact('trabajadores'));
    }

    public function create()
    {
        $cargos = Cargo::all();
        return view('trabajadores.create', compact('cargos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'paterno' => 'string|max:255|nullable',
            'materno' => 'string|max:255|nullable',
            'fecha_nacimiento' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'cargo_id' => 'required|exists:cargos,id',
        ]);

        // Crear el usuario
        $user = User::create([
            'name' => $request->nombres,
            'email' => $request->email,
            'password' => Hash::make('123456'),
            'remember_token' => Str::random(10),
        ]);

        // Crear el trabajador
        Trabajador::create([
            'user_id' => $user->id,
            'nombres' => $request->nombres,
            'paterno' => $request->paterno,
            'materno' => $request->materno,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'cargo_id' => $request->cargo_id,
            'activo' => true,
        ]);

        return redirect()->route('trabajadores.index')->with('success', 'Trabajador creado correctamente.');
    }

    public function edit(Trabajador $trabajador)
    {
        $cargos = Cargo::all();
        return view('trabajadores.edit', compact('trabajador', 'cargos'));
    }

    public function update(Request $request, Trabajador $trabajador)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'paterno' => 'string|max:255|nullable',
            'materno' => 'string|max:255|nullable',
            'fecha_nacimiento' => 'required|date',
            'email' => 'required|email|unique:users,email,' . $trabajador->user_id,
            'cargo_id' => 'required|exists:cargos,id',
        ]);

        // Actualizar el trabajador
        $trabajador->update([
            'nombres' => $request->nombres,
            'paterno' => $request->paterno,
            'materno' => $request->materno,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'cargo_id' => $request->cargo_id,
        ]);
        // Actualizar el usuario asociado
        $trabajador->user->update([
            'name' => $request->nombres,
            'email' => $request->email,
        ]);

        return redirect()->route('trabajadores.index')->with('success', 'Trabajador actualizado correctamente.');
    }

    public function destroy(Trabajador $trabajador)
    {
        $trabajador->delete();
        return redirect()->route('trabajadores.index')->with('success', 'Trabajador eliminado correctamente.');
    }
}
