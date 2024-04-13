<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona</title>
    <link href="{{ asset('css/zona.css') }}" rel="stylesheet">
</head>
<body>
    <main>
    <nav>
        <img src="{{ asset('images/codev.png') }}" alt="Logo icon">
            <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            Cerrar sesión
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
    </nav>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>ID de Zona</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accesos as $acceso)
            <tr>
                <td>{{ $acceso['_id'] }}</td>
                <td>{{ $acceso['fecha']->toDateTime()->format('Y-m-d H:i:s') }}</td>
                <td>{{ $acceso['_idZona'] }}</td>
                <td><button>Eliminar</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    </main>
</body>
</html>