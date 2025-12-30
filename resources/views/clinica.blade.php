@extends('layouts.base')

@section('content')

<style>
    body {
        background: #F5F7FA;
        font-family: 'Montserrat', sans-serif;
        color: #2C3E50;
    }

    .clinica-hero {
        background: #ffffff;
        border-radius: 12px;
        padding: 2.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        color: #2C3E50;
        border: 1px solid #E0E0E0;
    }

    .feature-card {
        background: #ffffff;
        border-radius: 10px;
        padding: 1.75rem;
        transition: all 0.3s ease;
        height: 100%;
        color: #2C3E50;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: 1px solid #E0E0E0;
    }

    .feature-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        border-color: #1565C0;
    }

    .feature-icon {
        font-size: 2.5rem;
        color: #1565C0;
        margin-bottom: 1rem;
    }
</style>

<!-- Hero Section -->
<div class="clinica-hero text-center" data-aos="fade-down">
    <h1 class="fw-bold mb-3" style="font-size: 2.25rem; color: #0D47A1;">
        <i class="bi bi-hospital-fill me-2"></i>Nuestra Clínica
    </h1>
    <p class="lead" style="font-size: 1.1rem; color: #546E7A;">
        Comprometidos con tu salud y bienestar. Ofrecemos atención médica de calidad 
        con tecnología de vanguardia y un equipo humano excepcional.
    </p>
</div>

<!-- Características -->
<section class="py-4">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="feature-card text-center">
                    <i class="bi bi-shield-check feature-icon"></i>
                    <h4 class="fw-bold mb-3">Seguridad y Confianza</h4>
                    <p>Protocolos de seguridad médica de primer nivel para garantizar tu bienestar.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="feature-card text-center">
                    <i class="bi bi-clock-history feature-icon"></i>
                    <h4 class="fw-bold mb-3">Atención 24/7</h4>
                    <p>Servicio de emergencias disponible las 24 horas del día, los 7 días de la semana.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="feature-card text-center">
                    <i class="bi bi-people feature-icon"></i>
                    <h4 class="fw-bold mb-3">Equipo Profesional</h4>
                    <p>Médicos especialistas certificados con años de experiencia en sus respectivas áreas.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
                <div class="feature-card text-center">
                    <i class="bi bi-cpu feature-icon"></i>
                    <h4 class="fw-bold mb-3">Tecnología Avanzada</h4>
                    <p>Equipos médicos de última generación para diagnósticos precisos y tratamientos efectivos.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="500">
                <div class="feature-card text-center">
                    <i class="bi bi-heart-pulse feature-icon"></i>
                    <h4 class="fw-bold mb-3">Atención Personalizada</h4>
                    <p>Cada paciente recibe un trato único y personalizado según sus necesidades específicas.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="600">
                <div class="feature-card text-center">
                    <i class="bi bi-geo-alt feature-icon"></i>
                    <h4 class="fw-bold mb-3">Ubicación Estratégica</h4>
                    <p>Fácil acceso y ubicación céntrica para tu comodidad y la de tu familia.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Llamado a la acción -->
<section class="py-5 text-center">
    <div class="clinica-hero" data-aos="fade-up">
        <h3 class="fw-bold mb-3">¿Listo para cuidar de tu salud?</h3>
        <p class="lead mb-4">Agenda tu cita hoy mismo y da el primer paso hacia una vida más saludable.</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ route('solicitar.cita') }}" class="btn btn-primary">
                <i class="bi bi-calendar-check me-2"></i>Agendar Cita
            </a>
            <a href="{{ route('servicio.consulta') }}" class="btn btn-outline-primary">
                <i class="bi bi-info-circle me-2"></i>Conocer Servicios
            </a>
        </div>
    </div>
</section>

<!-- AOS Animation -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>

@endsection

