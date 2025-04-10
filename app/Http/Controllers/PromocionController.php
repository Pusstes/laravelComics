<?php

namespace App\Http\Controllers;

use App\Services\FastApiService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class PromocionController extends Controller
{
    protected $apiService;

    public function __construct(FastApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $promociones = $this->apiService->get('/promociones');
        $productos = $this->apiService->get('/productos');
        
        $productosMap = collect($productos)->pluck('nombre', 'id')->toArray();
        
        return view('promociones.index', compact('promociones', 'productosMap'));
    }

    public function create()
    {
        $productos = $this->apiService->get('/productos');
        return view('promociones.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_producto' => 'required|integer',
            'descuento' => 'required|numeric|min:1|max:100',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio'
        ]);

        $response = $this->apiService->post('/promociones', $data);

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('promociones.index')->with('success', 'Promoción creada exitosamente');
    }

    public function edit($id)
    {
        $promocion = $this->apiService->get("/promociones/$id");
        $productos = $this->apiService->get('/productos');
        
        $productosMap = collect($productos)->pluck('nombre', 'id')->toArray();
        
        return view('promociones.edit', compact('promocion', 'productosMap'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'descuento' => 'required|numeric|min:1|max:100',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio'
        ]);

        $response = $this->apiService->put("/promociones/$id", $data);

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('promociones.index')->with('success', 'Promoción actualizada exitosamente');
    }

    public function destroy($id)
    {
        $response = $this->apiService->delete("/promociones/$id");

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('promociones.index')->with('success', 'Promoción eliminada exitosamente');
    }
}