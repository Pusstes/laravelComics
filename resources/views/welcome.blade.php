@extends('layouts.plantillaInicio')
@section('Titulo', 'Home')
@section('contenidoHome')
<style>
    body {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: linear-gradient(45deg,rgb(0, 0, 0),rgb(112, 13, 0),rgb(255, 94, 0));
        background-size: 300% 300%;
        animation: backgroundAnimation 10s infinite alternate;
        font-family: Arial, sans-serif;
        text-align: center;
        color: #fff;
    }
    @keyframes backgroundAnimation {
        0% { background-position: left top; }
        100% { background-position: right bottom; }
    }
    .container {
        background: rgba(0, 0, 0, 0.8);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.2);
        transform: scale(0.9);
        animation: fadeIn 1s ease-in-out forwards;
    }
    @keyframes fadeIn {
        0% { opacity: 0; transform: scale(0.7); }
        100% { opacity: 1; transform: scale(1); }
    }
    h1 {
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 20px;
        background: -webkit-linear-gradient(#ffcc00, #ff2e63);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: glow 1.5s infinite alternate;
    }
    @keyframes glow {
        0% { text-shadow: 0 0 5px #ffcc00; }
        100% { text-shadow: 0 0 20px #ff2e63; }
    }
    .image-container {
        margin-bottom: 20px;
        border: 5px solid transparent;
        padding: 5px;
        display: inline-block;
        border-radius: 10px;
        animation: borderAnimation 3s infinite alternate;
    }
    @keyframes borderAnimation {
        0% { border-color: #ffcc00; box-shadow: 0 0 10px #ffcc00; }
        50% { border-color: #ff2e63; box-shadow: 0 0 15px #ff2e63; }
        100% { border-color: #6a11cb; box-shadow: 0 0 20px #6a11cb; }
    }
    .image-container img {
        width: 150px;
        border-radius: 10px;
    }
    .input-group {
        margin: 10px 0;
    }
    input {
        padding: 10px;
        font-size: 1rem;
        width: 250px;
        border-radius: 5px;
        border: none;
        margin: 5px 0;
    }
    .btn {
        display: inline-block;
        padding: 15px 30px;
        margin: 10px;
        font-size: 1.2rem;
        font-weight: bold;
        color: #fff;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }
    .cliente { background:rgb(0, 51, 2); }
    .admin { background:rgb(87, 0, 0); }
    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.2);
        transition: 0.5s;
    }
    .btn:hover::before {
        left: 100%;
    }
    .btn:hover {
        transform: scale(1.1);
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
    }
</style>
</head>
<body>
<div class="container">
<h1 class="comic-title">Comic Shop</h1>
<div class="image-container">
    <img src="img/s1.png" alt="Comic Shop Logo">
</div>
<form action="#" method="POST" id="login-form">
    <div class="input-group">
        <input type="text" id="username" placeholder="Usuario" required>
    </div>
    <div class="input-group">
        <input type="password" id="password" placeholder="Contraseña" required>
    </div>
    <div class="input-group">
        <button type="submit" class="btn cliente">Ingresar como Cliente</button>
        <button type="submit" class="btn admin">Ingresar como Administrador</button>
    </div>
</form>
</div>

<script>
    const clientUser = { username: "cliente", password: "cliente123" };
    const adminUser = { username: "admin", password: "admin123" };

    document.getElementById("login-form").addEventListener("submit", function(e) {
        e.preventDefault();

        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;

        if (username === clientUser.username && password === clientUser.password) {
            alert("¡Bienvenido Cliente!");
            window.location.href = "{{ route('rutainicio') }}"; // redirige al cliente
        } else if (username === adminUser.username && password === adminUser.password) {
            alert("¡Bienvenido Administrador!");
            window.location.href = "{{ route('rutainicioAdmin') }}"; // redirige al admin
        } else {
            alert("Usuario o contraseña incorrectos");
        }
    });
</script>

@endsection
