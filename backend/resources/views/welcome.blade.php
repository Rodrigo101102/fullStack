<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Servicios Generales J&A</title>

    <!-- Agregamos los estilos de Laravel -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/script.js') }}" defer></script>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
        <div class="container">
            <a class="navbar-brand" href="#">Servicios Generales J&A</a>
            <div class="d-flex">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="btn btn-primary mx-2">Login</a>
                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Sección principal -->
    <header class="hero-section text-center text-white d-flex align-items-center">
        <div class="container">
            <h1 class="fw-bold">Bienvenido a Servicios Generales J&A</h1>
            <p class="lead">Especialistas en Vidriería y Servicios Generales</p>
            <a href="#about" class="btn btn-lg btn-warning mt-3">Más información</a>
        </div>
    </header>

    <!-- Sección sobre la empresa -->
    <section id="about" class="container my-5">
        <h2 class="text-center">¿Quiénes Somos?</h2>
        <p class="text-center">Servicios Generales J&A es una empresa dedicada a la vidriería y mantenimiento general con más de 10 años de experiencia en el sector.</p>

        <div class="row text-center mt-4">
            <div class="col-md-4">
                <img src="{{ asset('images/jya-img.jpg') }}" class="img-fluid rounded">
                <h4 class="mt-2">Instalaciones</h4>
                <p>Realizamos instalaciones de vidrios y ventanas para hogares y empresas.</p>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('images/jya-img2.jpg') }}" class="img-fluid rounded">
                <h4 class="mt-2">Mantenimiento</h4>
                <p>Ofrecemos mantenimiento de estructuras de vidrio y aluminio.</p>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('images/jya-img3.jpg') }}" class="img-fluid rounded">
                <h4 class="mt-2">Atención Personalizada</h4>
                <p>Brindamos soluciones a medida con asesoría especializada.</p>
            </div>
        </div>
    </section>

    <!-- Sección interactiva -->
    <section class="faq bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">Preguntas Frecuentes</h2>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            ¿Cuáles son los servicios que ofrecemos?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Ofrecemos instalación de vidrios, mantenimiento de ventanas, y trabajos en aluminio.
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            ¿Cómo solicitar un presupuesto?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Puedes contactarnos a través del formulario de contacto o llamarnos directamente.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pie de página -->
    <footer class="text-center text-white py-3" style="background: #333;">
        <p>&copy; {{ date('Y') }} Servicios Generales J&A - Todos los derechos reservados</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
