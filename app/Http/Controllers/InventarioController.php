<?php

namespace App\Http\Controllers;

use App\Services\FastApiService;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    protected $apiService;

    public function __construct(FastApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $inventario = $this->apiService->get('/inventario');
        $productos = $this->apiService->get('/productos');
        
        $productosMap = collect($productos)->pluck('nombre', 'id')->toArray();
        
        return view('inventario.index', compact('inventario', 'productosMap'));
    }

    public function edit($id)
    {
        $item = $this->apiService->get("/inventario/$id");
        $productos = $this->apiService->get('/productos');
        
        $productosMap = collect($productos)->pluck('nombre', 'id')->toArray();
        
        return view('inventario.edit', compact('item', 'productosMap'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'stock' => 'required|integer|min:0'
        ]);

        $response = $this->apiService->put("/inventario/$id", $data);

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('inventario.index')->with('success', 'Inventario actualizado exitosamente');
    }
}