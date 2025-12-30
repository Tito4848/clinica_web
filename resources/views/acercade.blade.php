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

    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
        color: #212121;
    }

    .glass-card h4,
    .glass-card p {
        color: #212121;
    }

    .glass-card img {
        border-radius: 12px;
    }

    .section-title {
        color: #212121;
    }

    .section-subtitle {
        color: #616161;
    }

    .glass-light {
        background: rgba(255, 255, 255, 0.7);
        color: #212121;
    }

    .transition {
        transition: all 0.4s ease-in-out;
    }

    .transition:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    }
</style>

<!-- FONDO ANIMADO -->
<div id="particles-js"></div>

<div class="container py-5">
    <!-- TÍTULO PRINCIPAL -->
    <div class="text-center mb-5" data-aos="fade-down">
        <h2 class="section-title fw-bold">Sobre Nosotros</h2>
        <p class="section-subtitle lead mt-2 px-3">
            En <strong>Clínica Vida</strong>, combinamos <span class="fw-semibold">tecnología</span>, <span class="fw-semibold">trato humano</span> y <span class="fw-semibold">profesionales comprometidos</span> para mejorar tu calidad de vida.
        </p>
    </div>

    <!-- VIDEO INSTITUCIONAL -->
    <div class="row mb-5 justify-content-center">
        <div class="col-lg-10" data-aos="zoom-in">
            <div class="ratio ratio-16x9 rounded glass-card">
                <video controls poster="{{ asset('img/poster_video.jpg') }}">
                    <source src="{{ asset('video/inicio6.mp4') }}" type="video/mp4">
                    Tu navegador no soporta la reproducción de video.
                </video>
            </div>
            <p class="text-center text-dark mt-3">Video institucional: Conoce nuestras instalaciones</p>
        </div>
    </div>

    <!-- MISIÓN Y VISIÓN -->
    <div class="row g-4 mb-5">
        <div class="col-md-6" data-aos="fade-right">
            <div class="glass-card border-start border-5 border-warning h-100">
                <h4><i class="bi bi-bullseye me-2 text-primary"></i> Misión</h4>
                <p>Brindar servicios de salud integrales, accesibles y de calidad, con una atención ética, empática y eficiente para todos nuestros pacientes.</p>
                <img src="{{ asset('img/Misión.png') }}" class="img-fluid mt-3" alt="Misión Clínica Vida">
            </div>
        </div>
        <div class="col-md-6" data-aos="fade-left">
            <div class="glass-card border-start border-5 border-info h-100">
                <h4><i class="bi bi-eye me-2 text-info"></i> Visión</h4>
                <p>Ser reconocidos como la clínica líder en el sur del país, destacando por nuestra <strong>innovación médica</strong>, <strong>tecnología de vanguardia</strong> y <strong>trato humano</strong>.</p>
                <img src="{{ asset('img/Vision.jpg') }}" class="img-fluid mt-3" alt="Visión Clínica Vida">
            </div>
        </div>
    </div>

    <!-- VALORES -->
    <section class="glass-card mb-5" data-aos="fade-up">
        <h4 class="text-center fw-bold mb-4">
            <i class="bi bi-heart-pulse-fill me-2 text-danger"></i> Nuestros Valores
        </h4>
        <div class="row g-3">
            @php
                $valores = [
                    ['icono' => 'bi-people-fill', 'texto' => 'Compromiso con el paciente'],
                    ['icono' => 'bi-shield-lock-fill', 'texto' => 'Ética profesional'],
                    ['icono' => 'bi-bar-chart-fill', 'texto' => 'Mejora continua'],
                    ['icono' => 'bi-emoji-smile-fill', 'texto' => 'Empatía y trato humano'],
                    ['icono' => 'bi-award-fill', 'texto' => 'Calidad y excelencia médica'],
                ];
            @endphp

            @foreach ($valores as $valor)
                <div class="col-md-6">
                    <div class="d-flex align-items-start glass-light p-3 rounded transition">
                        <i class="bi {{ $valor['icono'] }} text-primary fs-4 me-3"></i>
                        <p class="mb-0 fw-semibold text-dark">{{ $valor['texto'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- EQUIPO MÉDICO -->
    <div class="text-center my-5" data-aos="zoom-in">
        <img src="{{ asset('img/equipo.jpg') }}" class="img-fluid rounded shadow" alt="Equipo médico de Clínica Vida" style="max-height: 420px;">
        <p class="mt-3 text-dark">Nuestro equipo médico, comprometido con tu bienestar</p>
    </div>

    <!-- BOTÓN DE ACCIÓN -->
    <div class="text-center mb-5" data-aos="fade-up">
        <a href="{{ url('/servicios') }}" class="btn btn-warning btn-lg shadow-sm">
            <i class="bi bi-activity me-2"></i> Conoce nuestros servicios
        </a>
    </div>
</div>

<!-- AOS + PARTICLES -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>

<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script>
    particlesJS("particles-js", {
        "particles": {
            "number": { "value": 70 },
            "color": { "value": "#ffffff" },
            "shape": { "type": "circle" },
            "opacity": { "value": 0.15 },
            "size": { "value": 3 },
            "line_linked": {
                "enable": true,
                "distance": 150,
                "color": "#ffffff",
                "opacity": 0.15,
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
