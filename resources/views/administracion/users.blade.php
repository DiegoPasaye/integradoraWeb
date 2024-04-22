<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion de usuarios</title>
    <link href="{{ asset('css/zona.css') }}" rel="stylesheet">
</head>
<body>
<main>
        <nav>
            <a href='/administracion'>Regresar</a>
            <h1>Usuarios</h1>
            <p></p>
        </nav>

        <div>
            
        </div>
        <table>
            <tr>
                <th>Usuario</th>
                <th>Zonas</th>
                <th>Acciones</th>
            </tr>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->usuario }}</td>


                <td>
                    @foreach ($user->zonasId as $zonaId)
                        {{ $zonaId }}
                    @endforeach
                </td>


                    <td class='tdButtons'>
                    <form action="/administracion/users/{{ $user->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class='eliminar' type="submit">Eliminar</button>
                    </form>
                        <button class='actualizar' onclick="window.location.href='/administracion/users/{{ $user->id }}/edit'">Actualizar</button>
                    </td>
                </tr>
            @endforeach
        </table>
        <button id="nuevoUsuario" onclick="mostrarFormulario()">Nuevo usuario</button>


        <form class='formNewUser' action="/administracion/users" method="POST">
        @csrf
            <h2>Crear Usuario</h2>
            <input type="text" id="usuario" name="usuario" placeholder='Introduce el nombre de usuario'>
            <input type="text" id="contraseña" name="contraseña" placeholder='Introduce la contraseña'>
            <label for="">Elige las zonas a las que tendrá acceso el usuario:</label>
            <div class='zonasDiv'>
                @foreach ($zonas as $zona)
                    <div>
                        <input type="checkbox" id="zona{{ $zona->id }}" name="zonasId[]" value="{{ $zona->id }}">
                        <label for="zona{{ $zona->id }}">{{ $zona->nombre }}</label><br>
                    </div>
                @endforeach
            </div>
    
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