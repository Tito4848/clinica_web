@extends('layouts.base')

@section('content')

<style>
    body {
        background: #F5F7FA;
        font-family: 'Montserrat', sans-serif;
        color: #2C3E50;
    }

    .bg-futuristic {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        padding: 2.5rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        color: #2C3E50;
        border: 1px solid #E0E0E0;
    }

    .bg-futuristic:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }

    h2, h3, h5 {
        font-weight: 700;
    }

    .carousel-inner video,
    .carousel-inner img {
        object-fit: cover;
        max-height: 550px;
    }

    .transition {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 10px;
        background: #ffffff;
        border: 1px solid #E0E0E0;
    }

    .transition:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        border-color: #1565C0;
    }

    .btn-cta {
        background: #1565C0;
        color: #ffffff;
        font-weight: 600;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(21, 101, 192, 0.25);
        letter-spacing: 0.3px;
        font-size: 0.95rem;
    }

    .btn-cta:hover {
        background: #0D47A1;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(21, 101, 192, 0.35);
        color: #ffffff;
    }

    .btn-cta:active {
        transform: translateY(-1px);
    }

    #particles-js {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 0;
        top: 0;
        left: 0;
        pointer-events: none;
    }
</style>

<!-- Fondo animado (opcional) -->
<div id="particles-js"></div>

<!-- CARRUSEL -->
<div id="carouselVida" class="carousel slide mb-5 shadow-lg" data-bs-ride="carousel">
    <div class="carousel-inner rounded-4 overflow-hidden">
        @php
            $slides = [
                ['tipo' => 'video', 'src' => 'video/inicio7.mp4'],
                ['tipo' => 'video', 'src' => 'video/inicio9.mp4'],
                ['tipo' => 'video', 'src' => 'video/inicio10.mp4'],
                ['tipo' => 'video', 'src' => 'video/inicio11.mp4']
            ];
        @endphp

        @foreach ($slides as $index => $slide)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" data-bs-interval="6000">
                @if ($slide['tipo'] === 'video')
                    <video class="d-block w-100" autoplay muted playsinline loop>
                        <source src="{{ asset($slide['src']) }}" type="video/mp4">
                        Tu navegador no soporta el video.
                    </video>
                @else
                    <img src="{{ asset($slide['src']) }}" class="d-block w-100" alt="Slide {{ $index + 1 }}">
                @endif
            </div>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselVida" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselVida" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- SECCIONES DESTACADAS -->
<section class="py-5">
    <div class="container bg-futuristic">
        <div class="text-center mb-5">
            <h2 class="text-primary" data-aos="fade-down">¿Por qué elegir Clínica Vida?</h2>
            <p class="lead text-dark" data-aos="fade-up" data-aos-delay="150">
                Combinamos experiencia médica, innovación tecnológica y atención humana.
            </p>
        </div>

        <div class="row text-center g-4">
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                <a href="{{ url('/profesionales') }}" target="_blank" class="text-decoration-none text-dark">
                    <div class="p-4 bg-white bg-opacity-50 rounded transition h-100">
                        <i class="bi bi-person-heart fs-1 text-primary mb-3"></i>
                        <h5 class="text-dark">Profesionales Expertos</h5>
                        <p class="text-dark">Médicos con enfoque humanitario y vocación de servicio.</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="p-4 bg-white bg-opacity-50 rounded transition h-100">
                    <i class="bi bi-hospital-fill fs-1 text-info mb-3"></i>
                    <h5 class="text-dark">Servicios Integrales</h5>
                    <p class="text-dark">Desde diagnósticos hasta tratamientos personalizados.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="p-4 bg-white bg-opacity-50 rounded transition h-100">
                    <i class="bi bi-chat-heart fs-1 text-success mb-3"></i>
                    <h5 class="text-dark">Atención Personalizada</h5>
                    <p class="text-dark">Soluciones adaptadas a las necesidades de cada paciente.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- LLAMADO A LA ACCIÓN -->
<section class="py-5 text-center">
    <div class="container bg-futuristic" data-aos="fade-up">
        <h3 class="text-dark fw-bold mb-3">Agenda tu cita hoy mismo</h3>
        <p class="text-dark mb-4">Estamos para cuidar de ti y tu familia. Confía tu salud en buenas manos.</p>
        <a href="{{ route('solicitar.cita') }}" class="btn btn-cta shadow">
            <i class="bi bi-calendar-check me-2"></i>Solicitar Cita
        </a>
    </div>
</section>

<!-- AOS + Particles.js -->
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
            "opacity": { "value": 0.2 },
            "size": { "value": 3 },
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
