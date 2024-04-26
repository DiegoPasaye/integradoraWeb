<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar zona</title>
    <link href="{{ asset('css/formEdit.css') }}" rel="stylesheet">
</head>
<body>
    <main>
        <form action="/administracion/zonas/{{ $zona->id }}" method="POST">
            @csrf
            @method('PUT')
                <h2>Actualizar Zona</h2>
                <input type="text" id="nombre" name="nombre" placeholder='Introduce el nombre de la zona' autocomplete="off">
                <select id="encendido" name="encendido">
                    <option value="1" {{ $zona->encendido ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ $zona->encendido ? '' : 'selected' }}>No</option>
                </select>
        
                <button type="submit">Actualizar</button>
        </form>
    </main>
</body>
</html>