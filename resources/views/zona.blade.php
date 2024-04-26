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
        <a href='/admin'>Regresar</a>
        <h2>{{ $zona->nombre }}</h2>
        <label class="switchBtn">
        <input type="checkbox" id="toggle-{{ $zona->id }}" {{ $zona->encendido ? 'checked' : '' }}>
            <div class="slide"></div>
        </label>
    </nav>
        <h3>Entradas</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accesos as $acceso)
                    @if ($acceso['tipo'] == 'entrada')
                        <tr>
                            <td>{{ $acceso['_id'] }}</td>
                            <td>{{ $acceso['fecha']->toDateTime()->format('Y-m-d H:i:s') }}</td>
                            <td>{{ $acceso['tipo'] }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        <h3>Salidas</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accesos as $acceso)
                    @if ($acceso['tipo'] == 'salida')
                        <tr>
                            <td>{{ $acceso['_id'] }}</td>
                            <td>{{ $acceso['fecha']->toDateTime()->format('Y-m-d H:i:s') }}</td>
                            <td>{{ $acceso['tipo'] }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>


    </main>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#toggle-{{ $zona->id }}').change(function() {
        var encendido = $(this).is(':checked');
        $.ajax({
            url: '{{ route('toggle-zona', ['id' => $zona->id]) }}',
            method: 'POST',
            data: {
                encendido: encendido,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response);
            }
        });
    });
});
</script>

</html>
