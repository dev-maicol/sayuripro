<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\SubCategoria;
use Illuminate\Http\Request;

class SubCategoriaController extends Controller
{
  public function index(Request $request)
  {
    $query = SubCategoria::with('categoria');

    if ($request->filled('nombre')) {
      $query->where('nombre', 'like', '%' . $request->nombre . '%');
    }

    if ($request->filled('categoria_id')) {
      $query->where('categoria_id', $request->categoria_id);
    }

    $sub_categorias = $query->latest()->paginate(10);
    $categorias = Categoria::all();

    return view('sub_categorias.index', compact('sub_categorias', 'categorias'));
  }

  public function create()
  {
    $categorias = Categoria::all();
    return view('sub_categorias.create', compact('categorias'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'nombre' => 'required|string|max:255',
      'categoria_id' => 'required|exists:categorias,id',
    ]);

    SubCategoria::create($request->all());

    return redirect()->route('sub_categorias.index')->with('success', 'Subcategoría creada correctamente.');
  }

  public function edit(SubCategoria $sub_categoria)
  {
    $categorias = Categoria::all();
    return view('sub_categorias.edit', compact('sub_categoria', 'categorias'));
  }

  public function update(Request $request, SubCategoria $sub_categoria)
  {
    $request->validate([
      'nombre' => 'required|string|max:255',
      'categoria_id' => 'required|exists:categorias,id',
    ]);

    $sub_categoria->update($request->all());

    return redirect()->route('sub_categorias.index')->with('success', 'Subcategoría actualizada correctamente.');
  }

  public function destroy(SubCategoria $sub_categoria)
  {
    $sub_categoria->delete();
    return redirect()->route('sub_categorias.index')->with('success', 'Subcategoría eliminada correctamente.');
  }
}
