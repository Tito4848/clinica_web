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
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        padding: 3rem 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        color: #212121;
    }

    .card-futuristic {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(8px);
        border: none;
        color: #212121;
        border-radius: 16px;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
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
        color: #616161 !important;
    }
</style>

<!-- CONTENIDO -->
<div class="container py-5">
    <div class="bg-futuristic text-center mb-5">
        <h2 class="text-primary mb-3" data-aos="fade-down">
            <i class="bi bi-person-vcard me-2"></i>Nuestros Profesionales
        </h2>
        <p class="lead text-dark" data-aos="fade-up" data-aos-delay="150">
            Conoce a nuestros médicos altamente capacitados y comprometidos con tu bienestar.
        </p>
    </div>

    <div class="row g-4">
        @forelse ($doctores as $index => $doctor)
        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
            <div class="card card-futuristic text-center h-100">
                <img src="{{ asset('img/medico.jpg') }}" alt="{{ $doctor['nombre'] }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="text-primary">{{ $doctor['nombre'] }}</h5>
                    <p class="text-muted mb-2">{{ $doctor['especialidad'] }}</p>
                    <div class="mt-3">
                        <small class="text-muted d-block">
                            <i class="bi bi-calendar-check me-1"></i>
                            Total de citas: {{ $doctor['total_citas'] }}
                        </small>
                        <small class="text-muted d-block">
                            <i class="bi bi-clock-history me-1"></i>
                            Pendientes: {{ $doctor['citas_pendientes'] }}
                        </small>
                        <small class="text-muted d-block">
                            <i class="bi bi-check-circle me-1"></i>
                            Confirmadas: {{ $doctor['citas_confirmadas'] }}
                        </small>
                    </div>
                    <a href="{{ route('profesionales') }}?doctor={{ $doctor['id'] }}" class="btn btn-sm btn-primary mt-3">
                        <i class="bi bi-eye me-1"></i>Ver Detalles
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i>
                No hay doctores registrados en este momento.
            </div>
        </div>
        @endforelse
    </div>

    <!-- Detalles del doctor seleccionado -->
    @if(isset($doctorSeleccionado) && $doctorSeleccionado)
    <div class="row mt-5">
        <div class="col-12">
            <div class="bg-futuristic">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-primary mb-0">
                        <i class="bi bi-person-badge me-2"></i>{{ $doctorSeleccionado->user->name }}
                    </h3>
                    <a href="{{ route('profesionales') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg me-1"></i>Cerrar
                    </a>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-dark mb-3">Información del Doctor</h5>
                        <p><strong>Especialidad:</strong> {{ $doctorSeleccionado->especialidad }}</p>
                        <p><strong>Email:</strong> {{ $doctorSeleccionado->user->email }}</p>
                        <p><strong>Teléfono:</strong> {{ $doctorSeleccionado->user->telefono ?? 'No disponible' }}</p>
                        <p><strong>Horario de Atención:</strong> {{ $doctorSeleccionado->hora_inicio }} - {{ $doctorSeleccionado->hora_fin }}</p>
                        <p><strong>Duración de Cita:</strong> {{ $doctorSeleccionado->duracion_cita }} minutos</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-dark mb-3">Estadísticas</h5>
                        <p><strong>Total de Citas:</strong> {{ $doctorSeleccionado->citas->count() }}</p>
                        <p><strong>Citas Pendientes:</strong> {{ $doctorSeleccionado->citas->where('estado', 'pendiente')->count() }}</p>
                        <p><strong>Citas Confirmadas:</strong> {{ $doctorSeleccionado->citas->where('estado', 'confirmada')->count() }}</p>
                        <p><strong>Citas Completadas:</strong> {{ $doctorSeleccionado->citas->where('estado', 'completada')->count() }}</p>
                        <p><strong>Citas Canceladas:</strong> {{ $doctorSeleccionado->citas->where('estado', 'cancelada')->count() }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <h5 class="text-dark mb-3">Historial de Citas</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Paciente</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($doctorSeleccionado->citas->sortByDesc('fecha') as $cita)
                                <tr>
                                    <td>{{ $cita->fecha->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::createFromTimeString($cita->hora)->format('H:i') }}</td>
                                    <td>{{ $cita->nombre_paciente }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($cita->estado == 'confirmada') bg-success
                                            @elseif($cita->estado == 'pendiente') bg-warning
                                            @elseif($cita->estado == 'completada') bg-info
                                            @else bg-danger
                                            @endif">
                                            {{ ucfirst($cita->estado) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No hay citas registradas</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- ANIMACIONES AOS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>

@endsection
