@extends('layouts.base')

@section('content')

<style>
    body {
        background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
        font-family: 'Montserrat', sans-serif;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
        color: #212121;
    }

    .glass-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .glass-card h5, .glass-card p {
        color: #212121;
    }

    .section-title {
        color: #212121;
    }

    .section-subtitle {
        color: #616161;
    }

    .glass-card img {
        border-radius: 15px;
    }
</style>

<div class="container py-5">

    <!-- TÍTULO -->
    <div class="text-center mb-5" data-aos="fade-down">
        <h2 class="section-title fw-bold">Nuestros Servicios</h2>
        <p class="section-subtitle lead">Soluciones médicas integrales para ti y tu familia</p>
    </div>

    <!-- SERVICIOS -->
    <div class="row g-4">
        @php
            $servicios = [
                [
                    'titulo' => 'Consulta General',
                    'descripcion' => 'Atención médica personalizada y evaluación integral de tu salud.',
                    'imagen' => asset('img/consulta.jpg'),
                    'ruta' => route('servicio.consulta')
                ],
                [
                    'titulo' => 'Laboratorio Clínico',
                    'descripcion' => 'Realizamos análisis clínicos confiables para diagnóstico oportuno.',
                    'imagen' => asset('img/laboratorio.png'),
                    'ruta' => '#'
                ],
                [
                    'titulo' => 'Especialidades Médicas',
                    'descripcion' => 'Contamos con médicos especialistas en diversas áreas de la salud.',
                    'imagen' => asset('img/especialidades.jpg'),
                    'ruta' => '#'
                ],
                [
                    'titulo' => 'Emergencias 24/7',
                    'descripcion' => 'Atención inmediata para casos urgentes, todo el día, todos los días.',
                    'imagen' => asset('img/emergencia.jpg'),
                    'ruta' => '#'
                ],
                [
                    'titulo' => 'Pediatría',
                    'descripcion' => 'Cuidamos la salud de los más pequeños con atención especializada.',
                    'imagen' => asset('img/pediatria.jpg'),
                    'ruta' => '#'
                ],
                [
                    'titulo' => 'Ginecología',
                    'descripcion' => 'Salud femenina con tratamientos y controles adecuados.',
                    'imagen' => asset('img/ginecologia.jpg'),
                    'ruta' => '#'
                ],
            ];
        @endphp

        @foreach ($servicios as $servicio)
            <div class="col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                <a href="{{ $servicio['ruta'] }}" class="text-decoration-none">
                    <div class="glass-card h-100">
                        <img src="{{ $servicio['imagen'] }}" alt="{{ $servicio['titulo'] }}" class="img-fluid mb-3" style="height: 220px; width: 100%; object-fit: cover;">
                        <h5 class="fw-bold">{{ $servicio['titulo'] }}</h5>
                        <p class="mb-0">{{ $servicio['descripcion'] }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

<!-- ANIMACIONES AOS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>

@endsection
