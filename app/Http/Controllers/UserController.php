<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  // public function index()
  // {
  //     $usuarios = User::latest()->paginate(10); // puedes ajustar la paginación si lo deseas
  //     return view('usuarios.index', compact('usuarios'));
  // }
  public function index(Request $request)
  {
    $query = User::query();

    if ($request->filled('nombre')) {
      $query->where('name', 'like', '%' . $request->nombre . '%');
    }

    if ($request->filled('correo')) {
      $query->where('email', 'like', '%' . $request->correo . '%');
    }

    if ($request->filled('fecha')) {
      $query->whereDate('created_at', $request->fecha);
    }

    // $usuarios = $query->paginate(10)->appends($request->query());
    $usuarios = $query->latest()->paginate(10)->appends($request->query());


    return view('usuarios.index', compact('usuarios'));
  }
}
