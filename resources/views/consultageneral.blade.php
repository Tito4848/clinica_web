@extends('layouts.base')

@section('content')
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

    .glass-box {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        color: #212121;
    }

    .glass-box h2, .glass-box h4 {
        color: #212121;
    }

    .glass-box p, .glass-box ul li {
        color: #424242;
    }

    .list-group-item {
        background-color: transparent;
        border: none;
    }

    .btn-primary {
        background: linear-gradient(45deg, #1976D2, #26A69A);
        border: none;
        font-weight: bold;
        border-radius: 50px;
        padding: 0.6rem 1.8rem;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: #00bcd4;
        transform: scale(1.05);
    }
</style>

<!-- Fondo animado -->
<div id="particles-js"></div>

<div class="container my-5">
    <div class="text-center mb-5" data-aos="fade-down">
        <h2 class="fw-bold text-primary">Consulta General</h2>
        <p class="lead px-3 text-dark">
            Atención médica integral para tu bienestar. Nuestro equipo está preparado para brindarte el diagnóstico y orientación que necesitas.
        </p>
    </div>

    <div class="glass-box">
        <div class="row g-4 align-items-center">
            <div class="col-md-6" data-aos="fade-right">
                <img src="{{ asset('img/consulta.jpg') }}" alt="Consulta General" class="img-fluid rounded shadow">
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <h4 class="fw-bold text-info">
                    <i class="bi bi-stethoscope me-2"></i> ¿Qué incluye nuestra consulta general?
                </h4>
                <ul class="list-group list-group-flush mt-3">
                    <li class="list-group-item">
                        <i class="bi bi-check-circle-fill text-success me-2"></i> Evaluación de signos vitales
                    </li>
                    <li class="list-group-item">
                        <i class="bi bi-check-circle-fill text-success me-2"></i> Diagnóstico inicial
                    </li>
                    <li class="list-group-item">
                        <i class="bi bi-check-circle-fill text-success me-2"></i> Derivación a especialistas si es necesario
                    </li>
                    <li class="list-group-item">
                        <i class="bi bi-check-circle-fill text-success me-2"></i> Consejos y tratamiento inmediato
                    </li>
                </ul>

                <a href="{{ url('/contacto') }}" class="btn btn-primary mt-4 shadow">
                    <i class="bi bi-calendar-check me-2"></i> Reservar una cita
                </a>
            </div>
        </div>
    </div>
</div>

<!-- AOS & Particles.js -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
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
