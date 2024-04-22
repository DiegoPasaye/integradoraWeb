<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zonas</title>
    <link href="{{ asset('css/zona.css') }}" rel="stylesheet">
</head>
<body>
    <main>
        <nav>
            <a href='/administracion'>Regresar</a>
            <h1>Zonas</h1>
            <p></p>
        </nav>

        <div>
            
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Encendido</th>
                <th>Acciones</th>
            </tr>
            @foreach ($zonas as $zona)
                <tr>
                    <td>{{ $zona->id }}</td>
                    <td>{{ $zona->nombre }}</td>
                    <td>{{ $zona->encendido ? 'Sí' : 'No' }}</td>
                    <td class='tdButtons'>
                    <form action="/administracion/zonas/{{ $zona->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class='eliminar' type="submit">Eliminar</button>
                    </form>
                    <button class='actualizar' onclick="window.location.href='/administracion/zonas/{{ $zona->id }}/edit'">Actualizar</button>
                    </td>
                </tr>
            @endforeach
        </table>
        <button id="nuevaZona" onclick="mostrarFormulario()">Nueva zona</button>

        <form id="formNewUser" class='formNewUser' action="/administracion/zonas" method="POST">
            @csrf
            <h2>Crear Zona</h2>
                <input type="text" id="nombre" name="nombre" placeholder='Introduce el nombre de la zona'>
                <select id="encendido" name="encendido">
                    <option value="1" {{ $zona->encendido ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ $zona->encendido ? '' : 'selected' }}>No</option>
                </select>
        
                <button type="submit">Crear</button>
        </form>
    </main>
</body>
<script>
function mostrarFormulario() {
    var form = document.querySelector('.formNewUser');
    form.style.display = 'flex';
}
</script>
</html>
