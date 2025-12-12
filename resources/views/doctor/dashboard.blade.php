@extends('layouts.base')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
        font-family: 'Montserrat', sans-serif;
    }

    .dashboard-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 1.5rem;
        color: white;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
    }

    .stat-card {
        text-align: center;
    }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #1976D2;
        }

    .citas-table {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        overflow: hidden;
    }

    .citas-table table {
        color: white;
    }

    .citas-table thead {
        background: rgba(255, 255, 255, 0.2);
    }

    .badge-estado {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
    }
</style>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="text-white mb-2">
                <i class="bi bi-person-badge me-2"></i>Dashboard - Dr. {{ $doctor->user->name }}
            </h1>
            <p class="text-white-50">Especialidad: {{ $doctor->especialidad }}</p>
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="dashboard-card stat-card">
                <i class="bi bi-calendar-check fs-1 text-primary mb-2"></i>
                <div class="stat-number">{{ $estadisticas['total_citas'] }}</div>
                <div class="text-white-50">Total Citas</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card stat-card">
                <i class="bi bi-calendar-day fs-1 text-info mb-2"></i>
                <div class="stat-number">{{ $estadisticas['citas_hoy'] }}</div>
                <div class="text-white-50">Citas Hoy</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card stat-card">
                <i class="bi bi-clock-history fs-1 text-primary mb-2"></i>
                <div class="stat-number">{{ $estadisticas['pendientes'] }}</div>
                <div class="text-white-50">Pendientes</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card stat-card">
                <i class="bi bi-check-circle fs-1 text-success mb-2"></i>
                <div class="stat-number">{{ $estadisticas['confirmadas'] }}</div>
                <div class="text-white-50">Confirmadas</div>
            </div>
        </div>
    </div>

    <!-- Acciones rápidas -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="dashboard-card">
                <h4 class="text-white mb-3">
                    <i class="bi bi-lightning-charge me-2"></i>Acciones Rápidas
                </h4>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('doctor.calendario') }}" class="btn btn-warning">
                        <i class="bi bi-calendar3 me-2"></i>Ver Calendario
                    </a>
                    <a href="{{ route('solicitar.cita') }}" class="btn btn-info">
                        <i class="bi bi-plus-circle me-2"></i>Agendar Cita
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Citas de hoy -->
    @if($citasHoy->count() > 0)
    <div class="row mb-4">
        <div class="col-12">
            <div class="dashboard-card">
                <h4 class="text-white mb-3">
                    <i class="bi bi-calendar-day me-2"></i>Citas de Hoy
                </h4>
                <div class="citas-table">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Hora</th>
                                <th>Paciente</th>
                                <th>Especialidad</th>
                                <th>Teléfono</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($citasHoy as $cita)
                            <tr>
                                <td>{{ \Carbon\Carbon::createFromTimeString($cita->hora)->format('H:i') }}</td>
                                <td>{{ $cita->nombre_paciente }}</td>
                                <td>{{ $cita->especialidad }}</td>
                                <td>{{ $cita->telefono_paciente }}</td>
                                <td>
                                    <span class="badge badge-estado 
                                        @if($cita->estado == 'confirmada') bg-success
                                        @elseif($cita->estado == 'pendiente') bg-warning
                                        @elseif($cita->estado == 'completada') bg-info
                                        @else bg-danger
                                        @endif">
                                        {{ ucfirst($cita->estado) }}
                                    </span>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('citas.update-estado', $cita) }}" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="estado" class="form-select form-select-sm" onchange="this.form.submit()">
                                            <option value="pendiente" {{ $cita->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                            <option value="confirmada" {{ $cita->estado == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                                            <option value="completada" {{ $cita->estado == 'completada' ? 'selected' : '' }}>Completada</option>
                                            <option value="cancelada" {{ $cita->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Todas las citas -->
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <h4 class="text-white mb-3">
                    <i class="bi bi-list-ul me-2"></i>Todas las Citas
                </h4>
                <div class="citas-table">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Paciente</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Especialidad</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($citas as $cita)
                            <tr>
                                <td>{{ $cita->fecha->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::createFromTimeString($cita->hora)->format('H:i') }}</td>
                                <td>{{ $cita->nombre_paciente }}</td>
                                <td>{{ $cita->email_paciente }}</td>
                                <td>{{ $cita->telefono_paciente }}</td>
                                <td>{{ $cita->especialidad }}</td>
                                <td>
                                    <span class="badge badge-estado 
                                        @if($cita->estado == 'confirmada') bg-success
                                        @elseif($cita->estado == 'pendiente') bg-warning
                                        @elseif($cita->estado == 'completada') bg-info
                                        @else bg-danger
                                        @endif">
                                        {{ ucfirst($cita->estado) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <form method="POST" action="{{ route('citas.update-estado', $cita) }}" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <select name="estado" class="form-select form-select-sm" onchange="this.form.submit()">
                                                <option value="pendiente" {{ $cita->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                <option value="confirmada" {{ $cita->estado == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                                                <option value="completada" {{ $cita->estado == 'completada' ? 'selected' : '' }}>Completada</option>
                                                <option value="cancelada" {{ $cita->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                            </select>
                                        </form>
                                        <form method="POST" action="{{ route('citas.destroy', $cita) }}" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta cita?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-white-50">No hay citas registradas</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<script>
    alert('{{ session('success') }}');
</script>
@endif

@endsection

