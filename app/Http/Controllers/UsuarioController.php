<?php

namespace App\Http\Controllers;

use App\Services\FastApiService;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;



class UsuarioController extends Controller
{
    protected $apiService;

    public function __construct(FastApiService $apiService)
    {
        $this->apiService = $apiService;
        // $this->middleware('admin')->except(['edit', 'update']);
    }

    public function index()
    {
        $usuarios = $this->apiService->get('/usuarios');
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string',
            'contrasena' => 'required|min:6|confirmed',
            // 'role' => 'required|in:Cliente,Administrador'
        ]);

        $response = $this->apiService->post('/usuarios', $data);

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente');
    }

    public function edit($id)
    {
        $usuario = $this->apiService->get("/usuarios/$id");
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email,'.$id,
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string',
            // 'role' => 'required|in:Cliente,Administrador'
        ];

        if ($request->filled('contrasena')) {
            $rules['contrasena'] = 'required|min:6|confirmed';
        }

        $data = $request->validate($rules);

        // $response = $this->apiService->put("/usuarios/$id", $data);
        $response = $this->apiService->put("/update_profile/$id", $data);

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente');
    }

    public function destroy($id)
    {
        $response = $this->apiService->delete("/usuarios/$id");

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente');
    }
}