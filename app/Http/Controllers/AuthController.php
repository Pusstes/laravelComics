<?php

namespace App\Http\Controllers;

use App\Services\FastApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;


class AuthController extends Controller
{
    protected $apiService;

    public function __construct(FastApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $response = $this->apiService->post('/login', $credentials);

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        Session::put('api_user', $response);
        return redirect()->route('home');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string',
            'contrasena' => 'required|min:6|confirmed'
        ]);

        $response = $this->apiService->post('/usuarios', $data);

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('login')->with('success', 'Registro exitoso. Por favor inicie sesión.');
    }

    public function logout()
    {
        Session::forget('api_user');
        return redirect()->route('login');
    }
}