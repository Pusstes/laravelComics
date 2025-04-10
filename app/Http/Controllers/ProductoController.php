<?php

namespace App\Http\Controllers;

use App\Services\FastApiService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class ProductoController extends Controller
{
    protected $apiService;

    public function __construct(FastApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $productos = $this->apiService->get('/productos');
        $categorias = $this->apiService->get('/categorias');
        $proveedores = $this->apiService->get('/proveedores');

        $categoriasMap = collect($categorias)->pluck('nombre', 'id')->toArray();
        $proveedoresMap = collect($proveedores)->pluck('nombre', 'id')->toArray();

        return view('productos.index', compact('productos', 'categoriasMap', 'proveedoresMap'));
    }

    public function create()
    {
        $categorias = $this->apiService->get('/categorias');
        $proveedores = $this->apiService->get('/proveedores');
        return view('productos.create', compact('categorias', 'proveedores'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'id_categoria' => 'required|integer',
            'id_proveedor' => 'required|integer'
        ]);

        $response = $this->apiService->post('/productos', $data);

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente');
    }

    public function show($id)
    {
        $producto = $this->apiService->get("/productos/$id");
        return view('productos.show', compact('producto'));
    }

    public function edit($id)
    {
        $producto = $this->apiService->get("/productos/$id");
        $categorias = $this->apiService->get('/categorias');
        $proveedores = $this->apiService->get('/proveedores');
        return view('productos.edit', compact('producto', 'categorias', 'proveedores'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'id_categoria' => 'required|integer',
            'id_proveedor' => 'required|integer'
        ]);

        $response = $this->apiService->put("/productos/$id", $data);

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente');
    }

    public function destroy($id)
    {
        $response = $this->apiService->delete("/productos/$id");

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente');
    }
}