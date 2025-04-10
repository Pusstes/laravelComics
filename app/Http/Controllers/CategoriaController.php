<?php

namespace App\Http\Controllers;

use App\Services\FastApiService;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    protected $apiService;

    public function __construct(FastApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $categorias = $this->apiService->get('/categorias');
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre'
        ]);

        $response = $this->apiService->post('/categorias', $data);

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente');
    }

    public function edit($id)
    {
        $categoria = $this->apiService->get("/categorias/$id");
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre,'.$id
        ]);

        $response = $this->apiService->put("/categorias/$id", $data);

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente');
    }

    public function destroy($id)
    {
        $response = $this->apiService->delete("/categorias/$id");

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada exitosamente');
    }
}