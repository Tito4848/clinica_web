@extends('layouts.base')

@section('content')

<!-- ESTILOS DE DISEÑO MODERNO -->
<style>
    body {
        background: linear-gradient(120deg, #E3F2FD 0%, #BBDEFB 100%);
        font-family: 'Montserrat', sans-serif;
        color: #212121;
    }

    .bg-futuristic {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        padding: 3rem 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .card-futuristic {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(8px);
        border: none;
        color: #fff;
        border-radius: 16px;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }

    .card-futuristic:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 32px rgba(0, 0, 0, 0.3);
    }

    .card-img-top {
        height: 250px;
        object-fit: cover;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    h2, h5 {
        font-weight: bold;
    }

    .text-muted {
        color: #e0e0e0 !important;
    }
</style>

<!-- CONTENIDO -->
<div class="container py-5">
    <div class="bg-futuristic text-center mb-5">
        <h2 class="text-primary mb-3" data-aos="fade-down">
            <i class="bi bi-person-vcard me-2"></i>Nuestros Profesionales
        </h2>
        <p class="lead text-light" data-aos="fade-up" data-aos-delay="150">
            Conoce a nuestros médicos altamente capacitados y comprometidos con tu bienestar.
        </p>
    </div>

    <div class="row g-4">
        @php
            $profesionales = [
                ['nombre' => 'Dra. María González', 'especialidad' => 'Pediatra', 'imagen' => 'img/doctor1.jpg'],
                ['nombre' => 'Dr. Carlos Ramírez', 'especialidad' => 'Cardiólogo', 'imagen' => 'img/doctor2.jpg'],
                ['nombre' => 'Dra. Laura Fernández', 'especialidad' => 'Ginecóloga', 'imagen' => 'img/doctor3.jpg'],
                ['nombre' => 'Dr. Jorge Valdez', 'especialidad' => 'Médico General', 'imagen' => 'img/doctor4.jpg'],
            ];
        @endphp

        @foreach ($profesionales as $index => $pro)
        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
            <div class="card card-futuristic text-center h-100">
                <img src="{{ asset($pro['imagen']) }}" alt="{{ $pro['nombre'] }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="text-primary">{{ $pro['nombre'] }}</h5>
                    <p class="text-muted mb-0">{{ $pro['especialidad'] }}</p>
                </div>
            </div>
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
