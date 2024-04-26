<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="{{ asset('css/formEdit.css') }}" rel="stylesheet">
</head>
<body>
    <main>
        <form action="/administracion/users/{{ $user->_id }}" method="POST">
        @csrf
        @method('PUT')
            <h2>Actualizar Usuario</h2>
            <input type="text" id="usuario" name="usuario" placeholder='Introduce el nombre de usuario' autocomplete="off">
            <input type="text" id="contraseña" name="contraseña" placeholder='Introduce la nueva contraseña' autocomplete="off">
            <label for="">Elige las zonas a las que tendrá acceso el usuario:</label>
            <div class='zonasDiv'>
                @foreach ($zonas as $zona)
                    <div>
                        <input type="checkbox" id="zona{{ $zona->id }}" name="zonasId[]" value="{{ $zona->id }}">
                        <label for="zona{{ $zona->id }}">{{ $zona->nombre }}</label><br>
                    </div>
                @endforeach
            </div>
    
            <button type="submit">Actualizar</button>
        </form>
    </main>
</body>
</html>