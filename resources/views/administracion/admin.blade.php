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
        <nav>
            <img src="{{ asset('images/codev.png') }}" alt="Logo icon">

            <h1>¡Bienvenido, admin!</h1>

            <div>
                <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Cerrar sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </nav>

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