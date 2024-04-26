<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codev</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
</head>
<body>
    <main>
        <div class="banner">
            <nav>
                <img src="{{ asset('images/codev.png') }}" alt="Logo icon">

                <div class="nav-elements">
                    <a href="login">Inicia sesión</a>
                    <a href="#info-section">Información</a>
                    <a href="#contactFooter">Contáctanos</a>
                </div>
            </nav>

            <div class="banner-content">
                <h1>Codev</h1>
                <h3 class="text-animated">Seguridad y software en un solo lugar</h3>
                <h3>Desarrollo de software que funciona en conjunto con tus herramientas de seguridad.</h3>
                
                <div>
                    <button onclick="sendToLogin()">Comenzar</button> <!--hsl(228 39% 23%)-->
                    <button>Descarga la app</button>
                </div>
            </div>
        </div>

        <section class="info" id="info-section">
            <div class="about">
                <img src="{{ asset('images/equipo.svg') }}" alt="Team illustration">

                <div>
                    <h2>¿Quiénes somos?</h2>
                    <p>Somos un equipo de desarrollo enfocado en la combinación de la tecnología con la seguridad, logrando así llevar la seguridad al siguiente nivel, implementando funcionalidades útiles y fáciles de administrar para el usuario.</p>
                </div>
            </div>

            <div class="weDo">
                <img src="{{ asset('images/alerta.svg') }}" alt="Alert illustration">
                
                <div>
                    <h2>¿Qué hacemos?</h2>
                    <p>Creamos proyectos combinando el software con la seguridad, logrando así proyectos avanzados con funcionalidades superiores a las convencionales, dando el siguiente paso en la seguridad.</p>
                </div>
            </div>

            <div class="contact">
                <img src="{{ asset('images/contactanos.svg') }}" alt="contact illustration">

                <div id='contactanos'>
                    <h2>Contáctanos</h2>
                    <p>Contáctanos para realizar una consulta acerca del proyecto que tienes planeado y así poder ayudarte proporcionándote una cotización</p>
                    <div>
                        <button>WhatsApp</button>
                        <button>Facebook</button>
                    </div>
                </div>
            </div>
        </section>


        <footer id='contactFooter'>
            <div>
                <a href="">Facebook</a>
                <a href="">Instagram</a>
                <a href="">X</a>
            </div>
            <div>
                <a href="">WhatsApp</a>
                <a href="">Threads</a>
                <a href="">Descarga la app</a>
            </div>
        </footer>

    </main>
</body>
<script src="{{ asset('js/app.js') }}"></script>

</html>
