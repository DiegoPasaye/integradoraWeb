<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona de control</title>
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
    <main class='adminContainer'>
        <h1>Bienvenido administrador!</h1>

        <div class="cards">
            <div class="card">
                <p>Usuarios</p>
                <button onclick="window.location.href='/administracion/users'">Administrar</button>
            </div>
            <div class="card">
                <p>Zonas</p>
                <button onclick="window.location.href='/administracion/zonas'">Administrar</button>
            </div>
        </div>
    </main>
</body>
</html>
