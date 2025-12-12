<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Cuenta - Clínica Vida</title>
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

        .recover-container {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 500px;
            animation: fadeIn 1s ease-in-out;
            color: #fff;
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
            box-shadow: 0 0 0 0.2rem rgba(255,255,255,0.3);
            border-color: transparent;
        }

        .btn-primary {
            background-color: #ffffff;
            color: #1976D2;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #e3f2fd;
            color: #1976D2;
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

        a {
            color: #ffffff;
            text-decoration: underline;
        }

        a:hover {
            color: #e3f2fd;
        }

        .d-flex-center {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- Fondo de partículas -->
<div id="particles-js"></div>

<!-- Contenido principal -->
<div class="d-flex-center">
    <div class="recover-container text-center">
        <h2 class="mb-1"><i class="bi bi-key-fill me-1"></i> Recuperar Cuenta</h2>
        <p class="text-light mb-4">Ingresa tu correo para enviarte el enlace de recuperación</p>

        <form id="recoverForm" class="text-start">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope-at"></i></span>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="ejemplo@correo.com" required>
                </div>
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send me-1"></i> Enviar enlace de recuperación
                </button>
                <a href="/login" class="btn btn-outline-secondary">
                    <i class="bi bi-box-arrow-left me-1"></i> Volver al inicio de sesión
                </a>
            </div>
        </form>

        <div class="footer mt-4">
            © Clínica Vida 2025 — Desarrollado por Maycol Anderson Coaquira De La Cruz
        </div>
    </div>
</div>

<!-- JS Partículas -->
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

<!-- JS de validación -->
<script>
    document.getElementById('recoverForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const correo = document.getElementById('correo').value.trim();

        if (!correo) {
            alert('Por favor, ingresa un correo válido.');
            return;
        }

        alert('Hemos enviado un enlace de recuperación a: ' + correo);
        this.reset();
    });
</script>

</body>
</html>
