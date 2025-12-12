<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Clínica Vida</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
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

        .register-container {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 550px;
            animation: slideIn 1s ease;
            color: #fff;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            font-weight: 700;
        }

        .form-control, .input-group-text {
            border-radius: 12px !important;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(255,255,255,0.3);
            border-color: transparent;
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

        a {
            color: #ffffff;
            text-decoration: underline;
        }

        a:hover {
            color: #e3f2fd;
        }

        .centered-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- Fondo animado -->
<div id="particles-js"></div>

<!-- Contenedor principal -->
<div class="centered-wrapper">
    <div class="register-container text-center">
        <h2 class="mb-1"><i class="bi bi-person-plus-fill me-1"></i> Registro</h2>
        <p class="text-light mb-4">Crea tu cuenta en Clínica Vida</p>

        @if ($errors->any())
            <div class="alert alert-danger mb-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="text-start needs-validation" novalidate>
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre completo</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ ]{3,60}$" placeholder="Nombre y Apellidos">
                </div>
                <div class="invalid-feedback">Ingresa un nombre válido (solo letras).</div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope-at"></i></span>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required placeholder="ejemplo@correo.com">
                </div>
                <div class="invalid-feedback">Correo no válido.</div>
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                    <input type="tel" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}" placeholder="987654321">
                </div>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Tipo de Usuario</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                    <select class="form-select" id="role" name="role" required>
                        <option value="">Selecciona un tipo</option>
                        <option value="paciente" {{ old('role') == 'paciente' ? 'selected' : '' }}>Paciente</option>
                        <option value="doctor" {{ old('role') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                    </select>
                </div>
            </div>

            <div class="mb-3" id="especialidad-container" style="display: none;">
                <label for="especialidad" class="form-label">Especialidad</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-heart-pulse"></i></span>
                    <select class="form-select" id="especialidad" name="especialidad">
                        <option value="Consulta General">Consulta General</option>
                        <option value="Pediatría">Pediatría</option>
                        <option value="Ginecología">Ginecología</option>
                        <option value="Medicina Interna">Medicina Interna</option>
                        <option value="Laboratorio Clínico">Laboratorio Clínico</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" class="form-control" id="password" name="password" required minlength="6" placeholder="Contraseña segura">
                </div>
                <div class="invalid-feedback">Mínimo 6 caracteres.</div>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required minlength="6" placeholder="Confirma tu contraseña">
                </div>
                <div class="invalid-feedback">Las contraseñas deben coincidir.</div>
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-primary">Registrarse</button>
                <button type="reset" class="btn btn-outline-secondary">Limpiar</button>
            </div>
        </form>

        <div class="mt-4">
            <p>¿Ya tienes cuenta? <a href="/login">Inicia sesión aquí</a></p>
        </div>

        <div class="footer mt-3">
            © Clínica Vida 2025 — Desarrollado por Maycol Anderson Coaquira De La Cruz
        </div>
    </div>
</div>

<!-- Particles JS -->
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Validación personalizada -->
<script>
    // Mostrar campo de especialidad solo si es doctor
    document.getElementById('role').addEventListener('change', function() {
        const especialidadContainer = document.getElementById('especialidad-container');
        if (this.value === 'doctor') {
            especialidadContainer.style.display = 'block';
            document.getElementById('especialidad').required = true;
        } else {
            especialidadContainer.style.display = 'none';
            document.getElementById('especialidad').required = false;
        }
    });

    // Validación de formulario
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

</body>
</html>
