<?php

namespace App\Http\Controllers;

use App\Services\FastApiService;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    protected $apiService;

    public function __construct(FastApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $pedidos = $this->apiService->get('/pedidos_usuarios');
        $usuarios = $this->apiService->get('/usuarios');
        
        $usuariosMap = collect($usuarios)->pluck('nombre', 'id')->toArray();
        
        return view('pedidos.index', compact('pedidos', 'usuariosMap'));
    }

    public function create()
    {
        $usuarios = $this->apiService->get('/usuarios');
        $productos = $this->apiService->get('/productos');
        return view('pedidos.create', compact('usuarios', 'productos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_usuario' => 'required|integer',
            'total' => 'required|numeric|min:0',
            'productos' => 'required|array|min:1',
            'productos.*.id_producto' => 'required|integer',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0'
        ]);

        $response = $this->apiService->post('/pedidos_usuarios', $data);

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('pedidos.index')->with('success', 'Pedido creado exitosamente');
    }

    public function show($id)
    {
        $pedido = $this->apiService->get("/pedidos_usuarios/$id");
        $detalles = $this->apiService->get("/detalle_pedidos_usuarios?pedido=$id");
        $usuarios = $this->apiService->get('/usuarios');
        $productos = $this->apiService->get('/productos');
        
        $usuariosMap = collect($usuarios)->pluck('nombre', 'id')->toArray();
        $productosMap = collect($productos)->pluck('nombre', 'id')->toArray();
        
        return view('pedidos.show', compact('pedido', 'detalles', 'usuariosMap', 'productosMap'));
    }

    public function destroy($id)
    {
        $response = $this->apiService->delete("/pedidos_usuarios/$id");

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado exitosamente');
    }
}