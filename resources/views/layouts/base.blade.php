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
            box-sizing: border-box;
        }

        body {
            background: #F5F7FA;
            color: #2C3E50;
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Tipografía mejorada */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
            letter-spacing: -0.5px;
            line-height: 1.2;
        }

        p {
            line-height: 1.7;
        }

        /* Botones profesionales mejorados */
        .btn-primary {
            background: #1565C0;
            border: none;
            color: #ffffff;
            font-weight: 600;
            padding: 0.65rem 1.4rem;
            border-radius: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(21, 101, 192, 0.25);
            letter-spacing: 0.2px;
            font-size: 0.95rem;
        }

        .btn-primary:hover {
            background: #0D47A1;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(21, 101, 192, 0.35);
            color: #ffffff;
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-outline-secondary {
            border: 2px solid #1565C0;
            color: #1565C0;
            font-weight: 600;
            padding: 0.65rem 1.4rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: transparent;
            font-size: 0.95rem;
        }

        .btn-outline-secondary:hover {
            background: #1565C0;
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(21, 101, 192, 0.3);
        }

        .btn-outline-primary {
            border: 2px solid #1565C0;
            color: #1565C0;
            font-weight: 600;
            padding: 0.65rem 1.4rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: transparent;
            font-size: 0.95rem;
        }

        .btn-outline-primary:hover {
            background: #1565C0;
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(21, 101, 192, 0.3);
        }

        .btn-success {
            background: #009688;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 150, 136, 0.25);
            color: #ffffff;
            font-weight: 600;
            padding: 0.65rem 1.4rem;
            border-radius: 8px;
            font-size: 0.95rem;
        }

        .btn-success:hover {
            background: #00796B;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 150, 136, 0.35);
            color: #ffffff;
        }

        .btn-warning {
            background: #FF6F00;
            border: none;
            box-shadow: 0 2px 8px rgba(255, 111, 0, 0.25);
            color: #ffffff;
            font-weight: 600;
            padding: 0.65rem 1.4rem;
            border-radius: 8px;
            font-size: 0.95rem;
        }

        .btn-warning:hover {
            background: #E65100;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255, 111, 0, 0.35);
            color: #ffffff;
        }

        .btn-info {
            background: #0277BD;
            border: none;
            box-shadow: 0 2px 8px rgba(2, 119, 189, 0.25);
            color: #ffffff;
            font-weight: 600;
            padding: 0.65rem 1.4rem;
            border-radius: 8px;
            font-size: 0.95rem;
        }

        .btn-info:hover {
            background: #01579B;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(2, 119, 189, 0.35);
            color: #ffffff;
        }

        /* Footer profesional mejorado */
        footer {
            background: linear-gradient(135deg, #0D47A1 0%, #1565C0 100%);
            padding: 2.5rem 0 1.5rem;
            text-align: center;
            font-size: 0.9rem;
            color: #E8EAF6;
            margin-top: 3rem;
            box-shadow: 0 -4px 16px rgba(0, 0, 0, 0.15);
            border-top: 2px solid rgba(255,255,255,0.1);
        }

        footer a {
            color: #E8EAF6;
            margin: 0 10px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        footer a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        /* Contenedor principal mejorado */
        .container {
            max-width: 1200px;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        main.container {
            padding-top: 2rem !important;
            padding-bottom: 3rem !important;
        }

        /* Cards mejorados */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        /* Formularios mejorados */
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #1976D2;
            box-shadow: 0 0 0 0.2rem rgba(25, 118, 210, 0.15);
        }

        /* Alerts mejorados */
        .alert {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Responsive mejorado */
        @media (max-width: 768px) {
            footer {
                font-size: 0.85rem;
                padding: 2rem 0 1.5rem;
            }

            main.container {
                padding-top: 1.5rem !important;
                padding-bottom: 2rem !important;
            }
        }

        /* Animaciones suaves */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
</head>
<body>

    {{-- Menú de navegación (asegúrate que tenga la clase custom-navbar en layouts.menu.blade.php) --}}
    @include('layouts.menu')

    {{-- Contenido principal --}}
    <main class="container py-5 fade-in-up">
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
