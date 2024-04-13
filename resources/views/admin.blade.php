<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
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


        <section class="areas">
        <h1>Areas</h1>

        <div class="cards">
            @foreach ($zonas as $zona)
                <div class="card">
                    <div>
                        <h3>{{ $zona->nombre }}</h3>
                        <label class="switchBtn">
                            <input type="checkbox" id="toggle" {{ $zona->encendido ? 'checked' : '' }}>
                            <div class="slide"></div>
                        </label>
                    </div>
                    <p>Zona de acceso al {{ $zona->nombre }}</p>
                    <button onclick="window.location='{{ route('zona', ['id' => $zona->id]) }}'">Administrar</button>
                </div>
            @endforeach
        </div>

        </section>
    </main>
</body>
</html>