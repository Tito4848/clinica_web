    @extends('layouts.base')

    @section('content')

    <!-- ESTILOS Y FONDO -->
    <style>
        body {
            background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
            font-family: 'Montserrat', sans-serif;
            color: #212121;
            position: relative;
            overflow-x: hidden;
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

        .container {
            position: relative;
            z-index: 2;
        }

        .glass-form {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 2.5rem;
            color: #fff;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.3);
        }

        .glass-form input,
        .glass-form select,
        .glass-form textarea {
            border-radius: 12px;
            background-color: rgba(255, 255, 255, 0.15);
            color: #fff;
            border: none;
        }

        .glass-form input::placeholder,
        .glass-form textarea::placeholder {
            color: #f1f1f1a6;
        }

        .glass-form label {
            font-weight: 600;
        }

        .glass-form select option {
            background-color: #1976D2;
            color: #fff;
        }

        .glass-form button {
            border-radius: 12px;
            padding: 0.75rem 2rem;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
            background: linear-gradient(45deg, #1976D2, #26A69A);
            color: #ffffff;
            border: none;
        }

        .glass-form button:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(25, 118, 210, 0.3);
            background: linear-gradient(45deg, #1565C0, #00897B);
            color: #ffffff;
        }

        .alert-success {
            background-color: rgba(40,167,69,0.9);
            border: none;
            color: white;
        }

        .text-white-muted {
            color: #d9f3ffcc;
        }
    </style>

    <!-- Fondo animado -->
    <div id="particles-js"></div>

    <!-- CONTENIDO -->
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-down">
            <h2 class="fw-bold text-primary"><i class="bi bi-calendar2-plus-fill me-2"></i>Agenda tu Cita</h2>
            <p class="lead text-white-muted">Coordina tu atención médica en segundos. Rápido, fácil y totalmente en línea.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div id="mensajeExito" class="alert alert-success d-none text-center" role="alert" data-aos="zoom-in">
                    <i class="bi bi-check-circle-fill me-2"></i> ¡Tu cita fue enviada exitosamente!
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success mb-3">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('citas.store') }}" id="formCita" class="glass-form" data-aos="fade-up">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" value="{{ old('nombre') }}" required
                            placeholder="Ingresa tu nombre completo"
                            pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,60}$"
                            title="Solo se permiten letras y espacios. No números ni caracteres especiales.">
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control form-control-lg" id="telefono" name="telefono" value="{{ old('telefono') }}" required
                            placeholder="Ej: 987654321"
                            pattern="^[0-9]{9}$"
                            maxlength="9"
                            title="Debe contener exactamente 9 dígitos numéricos.">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email" value="{{ old('email') }}" required placeholder="ejemplo@correo.com">
                    </div>

                    <div class="mb-3">
                        <label for="especialidad" class="form-label">Especialidad</label>
                        <select class="form-select form-select-lg text-white" id="especialidad" name="especialidad" required>
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option value="Consulta General" {{ old('especialidad') == 'Consulta General' ? 'selected' : '' }}>Consulta General</option>
                            <option value="Pediatría" {{ old('especialidad') == 'Pediatría' ? 'selected' : '' }}>Pediatría</option>
                            <option value="Ginecología" {{ old('especialidad') == 'Ginecología' ? 'selected' : '' }}>Ginecología</option>
                            <option value="Medicina Interna" {{ old('especialidad') == 'Medicina Interna' ? 'selected' : '' }}>Medicina Interna</option>
                            <option value="Laboratorio Clínico" {{ old('especialidad') == 'Laboratorio Clínico' ? 'selected' : '' }}>Laboratorio Clínico</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control form-control-lg" id="fecha" name="fecha" value="{{ old('fecha') }}" required min="{{ date('Y-m-d') }}">
                    </div>

                    <div class="mb-3">
                        <label for="hora" class="form-label">Hora</label>
                        <input type="time" class="form-control form-control-lg" id="hora" name="hora" value="{{ old('hora') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="mensaje" class="form-label">Comentarios Adicionales</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="4" placeholder="Escribe tu mensaje...">{{ old('mensaje') }}</textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-lg">
                            <i class="bi bi-check2-circle me-2"></i> Confirmar Cita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- AOS & Particles -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 900, once: true });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script>
        particlesJS("particles-js", {
            "particles": {
                "number": { "value": 60 },
                "color": { "value": "#ffffff" },
                "shape": { "type": "circle" },
                "opacity": { "value": 0.15 },
                "size": { "value": 3 },
                "line_linked": {
                    "enable": true,
                    "distance": 130,
                    "color": "#ffffff",
                    "opacity": 0.15,
                    "width": 1
                },
                "move": { "enable": true, "speed": 1.2 }
            },
            "interactivity": {
                "events": {
                    "onhover": { "enable": true, "mode": "repulse" }
                }
            }
        });
    </script>


    @endsection
