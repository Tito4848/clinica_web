@extends('layouts.base')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
        font-family: 'Montserrat', sans-serif;
    }

    .citas-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        color: #212121;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        color: #212121;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        color: #1976D2;
    }

    .cita-item {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        border-left: 4px solid #1976D2;
        transition: all 0.3s ease;
    }

    .cita-item:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transform: translateX(5px);
    }

    .cita-item.pendiente {
        border-left-color: #ffc107;
    }

    .cita-item.confirmada {
        border-left-color: #28a745;
    }

    .cita-item.completada {
        border-left-color: #17a2b8;
    }

    .cita-item.cancelada {
        border-left-color: #dc3545;
    }
</style>

<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="text-dark mb-2">
                <i class="bi bi-calendar-check me-2"></i>Mis Citas
            </h1>
            <p class="text-muted">Consulta el estado de todas tus citas médicas</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Estadísticas -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <i class="bi bi-calendar-check fs-1 text-primary mb-2"></i>
                <div class="stat-number">{{ $estadisticas['total'] }}</div>
                <div class="text-muted">Total Citas</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="bi bi-clock-history fs-1 text-warning mb-2"></i>
                <div class="stat-number">{{ $estadisticas['pendientes'] }}</div>
                <div class="text-muted">Pendientes</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="bi bi-check-circle fs-1 text-success mb-2"></i>
                <div class="stat-number">{{ $estadisticas['confirmadas'] }}</div>
                <div class="text-muted">Confirmadas</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="bi bi-check2-all fs-1 text-info mb-2"></i>
                <div class="stat-number">{{ $estadisticas['completadas'] }}</div>
                <div class="text-muted">Completadas</div>
            </div>
        </div>
    </div>

    <!-- Lista de Citas -->
    <div class="row">
        <div class="col-12">
            <div class="citas-card">
                <h4 class="text-dark mb-4">
                    <i class="bi bi-list-ul me-2"></i>Historial de Citas
                </h4>

                @if($citas->count() > 0)
                    @foreach($citas as $cita)
                        <div class="cita-item {{ $cita->estado }}">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <div class="text-center">
                                        <div class="fw-bold text-primary">{{ $cita->fecha->format('d/m/Y') }}</div>
                                        <div class="text-muted">
                                            <i class="bi bi-clock me-1"></i>
                                            {{ \Carbon\Carbon::createFromTimeString($cita->hora)->format('H:i') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div>
                                        <strong class="text-dark">Dr. {{ $cita->doctor->user->name ?? 'No asignado' }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $cita->especialidad }}</small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <span class="badge 
                                        @if($cita->estado == 'confirmada') bg-success
                                        @elseif($cita->estado == 'pendiente') bg-warning
                                        @elseif($cita->estado == 'completada') bg-info
                                        @else bg-danger
                                        @endif fs-6 px-3 py-2">
                                        <i class="bi 
                                            @if($cita->estado == 'confirmada') bi-check-circle
                                            @elseif($cita->estado == 'pendiente') bi-clock-history
                                            @elseif($cita->estado == 'completada') bi-check2-all
                                            @else bi-x-circle
                                            @endif me-1"></i>
                                        {{ ucfirst($cita->estado) }}
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    @if($cita->comentarios)
                                        <small class="text-muted">
                                            <i class="bi bi-chat-left-text me-1"></i>
                                            {{ \Illuminate\Support\Str::limit($cita->comentarios, 50) }}
                                        </small>
                                    @else
                                        <small class="text-muted">Sin comentarios</small>
                                    @endif
                                </div>
                                <div class="col-md-2 text-end">
                                    @if($cita->estado == 'pendiente')
                                        <small class="text-warning">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Esperando confirmación
                                        </small>
                                    @elseif($cita->estado == 'confirmada')
                                        <small class="text-success">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Cita confirmada
                                        </small>
                                    @elseif($cita->estado == 'completada')
                                        <small class="text-info">
                                            <i class="bi bi-check2-all me-1"></i>
                                            Cita completada
                                        </small>
                                    @else
                                        <small class="text-danger">
                                            <i class="bi bi-x-circle me-1"></i>
                                            Cancelada
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-calendar-x fs-1 text-muted mb-3"></i>
                        <h4 class="text-dark mb-3">No tienes citas registradas</h4>
                        <p class="text-muted mb-4">Agenda tu primera cita médica</p>
                        <a href="{{ route('solicitar.cita') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-calendar-plus me-2"></i>Agendar Cita
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
