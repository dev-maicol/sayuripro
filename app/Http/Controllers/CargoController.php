<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
  public function index(Request $request)
  {
    $query = Cargo::query();

    if ($request->filled('nombre')) {
      $query->where('nombre', 'like', '%' . $request->nombre . '%');
    }

    if ($request->filled('nombre_corto')) {
      $query->where('nombre_corto', 'like', '%' . $request->nombre_corto . '%');
    }
    
    if ($request->filled('funciones')) {
      $query->where('funciones', 'like', '%' . $request->funciones . '%');
    }

    $cargos = $query->latest()->paginate(10);
    return view('cargos.index', compact('cargos'));
  }

  public function create()
  {
    return view('cargos.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'nombre' => 'required|string|max:255',
      'nombre_corto' => 'nullable|string|max:100',
      'funciones' => 'nullable|string',
    ]);

    Cargo::create($request->all());

    return redirect()->route('cargos.index')->with('success', 'Cargo creado correctamente.');
  }

  public function edit(Cargo $cargo)
  {
    return view('cargos.edit', compact('cargo'));
  }

  public function update(Request $request, Cargo $cargo)
  {
    $request->validate([
      'nombre' => 'required|string|max:255',
      'nombre_corto' => 'nullable|string|max:100',
      'funciones' => 'nullable|string',
    ]);

    $cargo->update($request->all());

    return redirect()->route('cargos.index')->with('success', 'Cargo actualizado correctamente.');
  }

  public function destroy(Cargo $cargo)
  {
    $cargo->delete();
    return redirect()->route('cargos.index')->with('success', 'Cargo eliminado correctamente.');
  }
}
