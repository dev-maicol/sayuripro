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

  public function create()
  {
    return view('usuarios.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:6|confirmed',
    ]);

    User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password),
    ]);

    return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
  }
}
