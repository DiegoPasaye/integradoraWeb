<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicia sesión</title>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <main>
        <form action="/login" method="post">
            <h1>Inicia sesión</h1>

            @if ($errors->any())
                <button disabled class="error-message">¡Vaya! Credenciales incorrectas</button>
            @endif

            @csrf
            <input type="text" name="usuario" placeholder="Introduce tu nombre de usuario" autocomplete="off">
            <input type="password" name="contraseña" placeholder="Introduce tu contraseña" autocomplete="off">
            <button type="submit">Enviar</button>
        </form>
    </main>

</body>




</html>
