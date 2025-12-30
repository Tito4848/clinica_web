@extends('layouts.base')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
        font-family: 'Montserrat', sans-serif;
    }

    .dashboard-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 1.5rem;
        color: #212121;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
    }

    .horario-item {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 0.5rem;
        border-left: 4px solid #1976D2;
    }

    .horario-item.disabled {
        opacity: 0.6;
        border-left-color: #dc3545;
    }
</style>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="text-dark mb-2">
                <i class="bi bi-clock me-2"></i>Gestión de Horarios Disponibles
            </h1>
            <p class="text-muted">Dr. {{ $doctor->user->name }} - {{ $doctor->especialidad }}</p>
            <a href="{{ route('doctor.dashboard') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Volver al Dashboard
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Formulario para agregar horario -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="dashboard-card">
                <h4 class="text-dark mb-3">
                    <i class="bi bi-plus-circle me-2"></i>Agregar Nuevo Horario
                </h4>
                <form method="POST" action="{{ route('doctor.horarios.store') }}" class="row g-3">
                    @csrf
                    <div class="col-md-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" 
                               value="{{ old('fecha') }}" required min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="hora_inicio" class="form-label">Hora Inicio</label>
                        <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" 
                               value="{{ old('hora_inicio') }}" required>
                    </div>
                    <div class="col-md-3">
                        <label for="hora_fin" class="form-label">Hora Fin</label>
                        <input type="time" class="form-control" id="hora_fin" name="hora_fin" 
                               value="{{ old('hora_fin') }}" required>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-plus-lg me-2"></i>Agregar Horario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Lista de horarios -->
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <h4 class="text-dark mb-3">
                    <i class="bi bi-list-ul me-2"></i>Horarios Disponibles
                </h4>
                @forelse($horarios as $horario)
                    <div class="horario-item {{ !$horario->disponible ? 'disabled' : '' }}">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <strong>{{ $horario->fecha->format('d/m/Y') }}</strong>
                            </div>
                            <div class="col-md-3">
                                <i class="bi bi-clock me-2"></i>
                                {{ \Carbon\Carbon::createFromTimeString($horario->hora_inicio)->format('H:i') }} - 
                                {{ \Carbon\Carbon::createFromTimeString($horario->hora_fin)->format('H:i') }}
                            </div>
                            <div class="col-md-2">
                                @if($horario->disponible)
                                    <span class="badge bg-success">Disponible</span>
                                @else
                                    <span class="badge bg-danger">No Disponible</span>
                                @endif
                            </div>
                            <div class="col-md-5 text-end">
                                <form method="POST" action="{{ route('doctor.horarios.toggle', $horario) }}" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $horario->disponible ? 'btn-warning' : 'btn-success' }}">
                                        <i class="bi bi-{{ $horario->disponible ? 'x-circle' : 'check-circle' }} me-1"></i>
                                        {{ $horario->disponible ? 'Desactivar' : 'Activar' }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('doctor.horarios.destroy', $horario) }}" 
                                      class="d-inline" 
                                      onsubmit="return confirm('¿Estás seguro de eliminar este horario?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash me-1"></i>Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>
                        <p>No hay horarios disponibles registrados.</p>
                        <p class="small">Agrega horarios usando el formulario de arriba.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection

