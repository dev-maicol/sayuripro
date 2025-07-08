<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
  public function index(Request $request)
  {
    $query = Categoria::query();

    if ($request->filled('nombre')) {
      $query->where('nombre', 'like', '%' . $request->nombre . '%');
    }

    $categorias = $query->latest()->paginate(10);

    return view('categorias.index', compact('categorias'));
  }

  public function create()
  {
    return view('categorias.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'nombre' => 'required|string|max:255|unique:categorias,nombre',
    ]);

    Categoria::create($request->only('nombre'));

    return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente.');
  }

  public function edit(Categoria $categoria)
  {
    return view('categorias.edit', compact('categoria'));
  }

  public function update(Request $request, Categoria $categoria)
  {
    $request->validate([
      'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $categoria->id,
    ]);

    $categoria->update($request->only('nombre'));

    return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente.');
  }

  public function destroy(Categoria $categoria)
  {
    $categoria->delete();

    return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente.');
  }
}
