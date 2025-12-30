<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Clínica Vida</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        html, body {
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #1976D2, #26A69A);
            min-height: 100vh;
            overflow: hidden;
        }

        #particles-js {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }

        .login-container {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
            animation: fadeIn 1s ease-in-out;
            color: #212121;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-control,
        .input-group-text {
            border-radius: 12px !important;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(25, 118, 210, 0.25);
            border-color: #1976D2;
        }

        .btn-primary {
            background-color: #1976D2;
            color: #ffffff;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1565C0;
            color: #ffffff;
        }

        .btn-outline-secondary {
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 0.85rem;
            color: #e0f2f1;
        }

        .login-container a {
            color: #1976D2;
            text-decoration: underline;
        }

        .login-container a:hover {
            color: #1565C0;
        }

        .d-flex-center {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .mt-4{
            color: black;
        }
    </style>
</head>
<body>

<!-- Fondo de partículas -->
<div id="particles-js"></div>

<!-- Contenido principal -->
<div class="d-flex-center">
    <div class="login-container text-center">
        <h2 class="mb-1"><i class="bi bi-hospital-fill me-1"></i> Clínica Vida</h2>
        <p class="text-muted mb-4">Bienvenido, por favor inicia sesión</p>

        @if ($errors->any())
            <div class="alert alert-danger mb-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="text-start">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="correo@ejemplo.com" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
                </div>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">
                    Recordarme
                </label>
            </div>

            <div class="text-end mb-3">
                <a href="/recuperar" class="small"><i class="bi bi-question-circle me-1"></i>¿Olvidaste tu contraseña?</a>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-in-right me-1"></i> Iniciar Sesión</button>
                <button type="reset" class="btn btn-outline-secondary">Limpiar</button>
            </div>
        </form>

        <div class="mt-4 small">
            ¿No tienes cuenta? <a href="/register">Regístrate aquí</a>
        </div>

        <div class="footer mt-4">
            © Clínica Vida 2025 - Desarrollado por Maycol Anderson Coaquira De La Cruz
        </div>
    </div>
</div>

<!-- Partículas -->
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script>
    particlesJS("particles-js", {
        "particles": {
            "number": { "value": 65 },
            "color": { "value": "#ffffff" },
            "shape": { "type": "circle" },
            "opacity": { "value": 0.2 },
            "size": { "value": 3 },
            "line_linked": {
                "enable": true,
                "distance": 140,
                "color": "#ffffff",
                "opacity": 0.2,
                "width": 1
            },
            "move": { "enable": true, "speed": 1 }
        },
        "interactivity": {
            "events": {
                "onhover": { "enable": true, "mode": "repulse" }
            }
        }
    });
</script>


</body>
</html>
