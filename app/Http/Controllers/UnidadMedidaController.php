<?php

namespace App\Http\Controllers;

use App\Models\UnidadMedida;
use Illuminate\Http\Request;

class UnidadMedidaController extends Controller
{
  public function index(Request $request)
  {
    $query = UnidadMedida::query();

    if ($request->filled('nombre')) {
      $query->where('nombre', 'like', '%' . $request->nombre . '%');
    }

    $unidades = $query->latest()->paginate(10);
    return view('unidades_medida.index', compact('unidades'));
  }

  public function create()
  {
    return view('unidades_medida.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'nombre' => 'required|string|max:255|unique:unidades_medida,nombre',
    ]);

    UnidadMedida::create($request->only('nombre'));

    return redirect()->route('unidades_medida.index')->with('success', 'Unidad de medida creada correctamente.');
  }

  public function edit(UnidadMedida $unidadMedida)
  {
    return view('unidades_medida.edit', compact('unidadMedida'));
  }

  public function update(Request $request, UnidadMedida $unidadMedida)
  {
    $request->validate([
      'nombre' => 'required|string|max:255|unique:unidades_medida,nombre,' . $unidadMedida->id,
    ]);

    $unidadMedida->update($request->only('nombre'));

    return redirect()->route('unidades_medida.index')->with('success', 'Unidad de medida actualizada correctamente.');
  }

  public function destroy(UnidadMedida $unidadMedida)
  {
    $unidadMedida->delete();

    return redirect()->route('unidades_medida.index')->with('success', 'Unidad de medida eliminada correctamente.');
  }
}
