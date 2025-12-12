<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clínica Vida</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts: Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- AOS Animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Estilos personalizados globales -->
    <style>
        * {
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%); /* Fondo suave y profesional */
            color: #212121;
            overflow-x: hidden;
        }

        /* Navbar moderno y profesional */
        .custom-navbar {
            background: linear-gradient(to right, #1976D2, #26A69A);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .navbar .nav-link {
            font-weight: 600;
            color: #ffffff !important;
            transition: color 0.3s ease;
        }

        .navbar .nav-link:hover,
        .navbar .nav-link.active-link {
            color: #E3F2FD !important;
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Botones profesionales */
        .btn-primary {
            background-color: #1976D2;
            border: none;
            color: #ffffff;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #1565C0;
            transform: scale(1.02);
            color: #ffffff;
        }

        .btn-outline-secondary {
            border-color: #1976D2;
            color: #1976D2;
        }

        .btn-outline-secondary:hover {
            background-color: #1976D2;
            color: #ffffff;
        }

        /* Footer profesional */
        footer {
            background: linear-gradient(to right, #1565C0, #1976D2);
            padding: 30px 0;
            text-align: center;
            font-size: 0.9rem;
            color: #E3F2FD;
            margin-top: 60px;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.15);
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        footer a {
            color: #E3F2FD;
            margin: 0 10px;
        }

        footer a:hover {
            color: #ffffff;
        }

        /* Transición suave global */
        .transition {
            transition: all 0.3s ease;
        }

        /* Contenedor principal */
        .container {
            max-width: 1140px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            footer {
                font-size: 0.85rem;
            }

            .navbar .nav-link {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>

    {{-- Menú de navegación (asegúrate que tenga la clase custom-navbar en layouts.menu.blade.php) --}}
    @include('layouts.menu')

    {{-- Contenido principal --}}
    <main class="container py-5">
        @yield('content')
    </main>

    {{-- Pie de página moderno --}}
    @include('layouts.footer')

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 2000, once: true });
    </script>
</body>
</html>
