@extends('layouts.base')

@section('content')

<!-- ESTILOS GLOBALES Y FONDO ANIMADO -->
<style>
    body {
        font-family: 'Montserrat', sans-serif;
        background: linear-gradient(120deg, #1976D2, #26A69A);
        min-height: 100vh;
        margin: 0;
        padding: 0;
        color: #212121;
        position: relative;
        overflow-x: hidden;
    }

    #particles-js {
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: 0;
        top: 0;
        left: 0;
        pointer-events: none;
    }

    .contact-wrapper {
        position: relative;
        z-index: 2;
        max-width: 1200px;
        margin: 0 auto;
        padding: 60px 20px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 30px;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        padding: 40px;
        flex: 1 1 480px;
        min-width: 300px;
        color: #212121;
        transition: all 0.3s ease-in-out;
    }

    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.25);
    }

    .glass-card h2 {
        font-weight: 700;
        margin-bottom: 15px;
        color: #212121;
    }

    .form-control,
    .form-select,
    textarea {
        border: none;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 16px;
    }

    .form-control:focus,
    .form-select:focus,
    textarea:focus {
        box-shadow: 0 0 0 0.15rem rgba(255, 255, 255, 0.4);
        border: none;
    }

    .btn-custom {
        background: #1976D2;
        color: #ffffff;
        border: none;
        padding: 12px 25px;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-custom:hover {
        transform: scale(1.05);
        background: #e3f2fd;
        color: #0078d7;
    }

    iframe {
        width: 100%;
        height: 220px;
        border-radius: 15px;
        border: none;
    }

    label {
        font-weight: 600;
        color: #e3f2fd;
    }

    .icono {
        font-size: 1.2rem;
        margin-right: 8px;
        vertical-align: -2px;
    }

    .info-line {
        margin-bottom: 15px;
    }

    @media(max-width: 768px) {
        .contact-wrapper {
            flex-direction: column;
        }
    }
</style>

<!-- FONDO ANIMADO DE PARTÍCULAS -->
<div id="particles-js"></div>

<!-- CONTENIDO -->
<div class="contact-wrapper" data-aos="fade-up">
    <!-- FORMULARIO -->
    <div class="glass-card">
        <h2><i class="bi bi-envelope-paper-heart icono"></i> Contáctanos</h2>
        <p class="mb-4">Estamos para ayudarte. Completa el formulario y nos pondremos en contacto contigo.</p>

        <form id="formContacto" novalidate>
            @csrf

            <div class="mb-3">
                <label for="nombre">Nombre completo</label>
                <input type="text" id="nombre" name="nombre" class="form-control"
                    pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ ]{3,60}$" required placeholder="Ej: Ana Rodríguez"
                    title="Solo letras y espacios (mínimo 3 letras)">
            </div>

            <div class="mb-3">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" class="form-control" required placeholder="ingrese corre electronico">
            </div>

            <div class="mb-3">
                <label for="telefono">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" class="form-control"
                    pattern="^\d{9}$" maxlength="9" required placeholder="Ej: 987654321"
                    title="Solo 9 dígitos numéricos">
            </div>

            <div class="mb-3">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" name="mensaje" rows="4" class="form-control" placeholder="Tu mensaje..." required></textarea>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-custom">
                    <i class="bi bi-send-fill me-1"></i> Enviar
                </button>
            </div>

            <!-- Mensaje de éxito -->
            <div id="mensajeExito" class="alert alert-success mt-3 d-none text-center" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> ¡Tu mensaje ha sido enviado con éxito!
            </div>
        </form>
    </div>

    <!-- INFORMACIÓN DE CONTACTO -->
    <div class="glass-card">
        <h2><i class="bi bi-geo-alt-fill icono"></i> Clínica Vida</h2>

        <div class="info-line"><i class="bi bi-geo-alt-fill text-primary icono"></i> Av. Salud 123, Cercado, Arequipa</div>
        <div class="info-line"><i class="bi bi-telephone-fill text-success icono"></i> +51 987 654 321</div>
        <div class="info-line"><i class="bi bi-envelope-fill text-dark icono"></i> contacto@clinicavida.pe</div>
        <div class="info-line"><i class="bi bi-clock-fill text-info icono"></i> Lunes a Sábado: 8:00 a.m. a 6:00 p.m.</div>

        <div class="mt-4">
            <iframe
                src="https://maps.google.com/maps?q=Av.%20Salud%20123%2C%20Arequipa%2C%20Per%C3%BA&t=&z=15&ie=UTF8&iwloc=&output=embed"
                allowfullscreen loading="lazy">
            </iframe>
        </div>
    </div>
</div>

<!-- VALIDACIÓN -->
<script>
    document.getElementById('formContacto').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;

        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        document.getElementById('mensajeExito').classList.remove('d-none');
        form.reset();
        form.classList.remove('was-validated');

        setTimeout(() => {
            document.getElementById('mensajeExito').classList.add('d-none');
        }, 5000);
    });
</script>

<!-- AOS ANIMACIONES -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({ duration: 1000, once: true });</script>

<!-- PARTICLES JS -->
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

@endsection
