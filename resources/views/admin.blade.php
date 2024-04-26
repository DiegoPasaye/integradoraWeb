<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @yield('scripts')
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
        <h1>Áreas</h1>

        <div class="cards">
        @foreach ($zonas as $zona)
            <div class="card">
                <div>
                    <h3>{{ $zona->nombre }}</h3>
                </div>
                <p>Zona de acceso al {{ $zona->nombre }}</p>
                <button onclick="window.location='{{ route('zona', ['id' => $zona->id]) }}'">Administrar</button>
            </div>
        @endforeach


        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        </section>
    </main>
</body>
<script>
    const toggleButtons = document.querySelectorAll('#toggle');

    toggleButtons.forEach(button => {
        button.addEventListener('change', function() {
            const zonaId = this.closest('.card').querySelector('h3').textContent;
            const isChecked = this.checked;
            const cardElement = this.closest('.card');

            // Enviar una solicitud AJAX para actualizar el estado de la zona
            fetch(`/admin/update-zona/${zonaId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ encendido: isChecked })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.message);
                // Actualizar el estado visual del botón de alternancia
                cardElement.querySelector('#toggle').checked = data.encendido;
            })
            .catch(error => {
                console.error('Error:', error);
                // Revertir el estado visual del botón de alternancia si hay un error
                this.checked = !isChecked;
            });
        });
    });
</script>
</html>
