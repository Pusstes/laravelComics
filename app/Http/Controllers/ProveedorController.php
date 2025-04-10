<?php

namespace App\Http\Controllers;

use App\Services\FastApiService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class ProveedorController extends Controller
{
    protected $apiService;

    public function __construct(FastApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $proveedores = $this->apiService->get('/proveedores');
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'contacto' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email',
            'direccion' => 'nullable|string'
        ]);

        $response = $this->apiService->post('/proveedores', $data);

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('proveedores.index')->with('success', 'Proveedor creado exitosamente');
    }

    public function edit($id)
    {
        $proveedor = $this->apiService->get("/proveedores/$id");
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'contacto' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email',
            'direccion' => 'nullable|string'
        ]);

        $response = $this->apiService->put("/proveedores/$id", $data);

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado exitosamente');
    }

    public function destroy($id)
    {
        $response = $this->apiService->delete("/proveedores/$id");

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado exitosamente');
    }
}