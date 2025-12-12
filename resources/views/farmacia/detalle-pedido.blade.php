@extends('layouts.base')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
        font-family: 'Montserrat', sans-serif;
    }

    .detail-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        color: white;
    }
</style>

<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('farmacia.mis-pedidos') }}" class="text-white">Mis Pedidos</a></li>
                    <li class="breadcrumb-item active text-white">Pedido #{{ $pedido->numero_pedido }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="detail-card mb-4">
                <h3 class="mb-4">Detalle del Pedido</h3>
                
                <div class="mb-3">
                    <strong>Número de Pedido:</strong> {{ $pedido->numero_pedido }}
                </div>
                <div class="mb-3">
                    <strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}
                </div>
                <div class="mb-4">
                    <strong>Estado:</strong> 
                    <span class="badge 
                        @if($pedido->estado == 'pendiente') bg-warning
                        @elseif($pedido->estado == 'confirmado') bg-info
                        @elseif($pedido->estado == 'en_preparacion') bg-primary
                        @elseif($pedido->estado == 'en_camino') bg-info
                        @elseif($pedido->estado == 'entregado') bg-success
                        @else bg-danger
                        @endif">
                        {{ ucfirst(str_replace('_', ' ', $pedido->estado)) }}
                    </span>
                </div>

                <h5 class="mb-3">Productos</h5>
                <table class="table text-white">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedido->detallePedidos as $detalle)
                            <tr>
                                <td>{{ $detalle->producto->nombre }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>S/ {{ number_format($detalle->precio_unitario, 2) }}</td>
                                <td>S/ {{ number_format($detalle->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-4">
            <div class="detail-card mb-4">
                <h5 class="mb-3">Resumen</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal:</span>
                    <span>S/ {{ number_format($pedido->subtotal, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>IGV (18%):</span>
                    <span>S/ {{ number_format($pedido->impuesto, 2) }}</span>
                </div>
                <hr class="bg-white">
                <div class="d-flex justify-content-between">
                    <strong>Total:</strong>
                    <strong class="text-primary">S/ {{ number_format($pedido->total, 2) }}</strong>
                </div>
            </div>

            <div class="detail-card">
                <h5 class="mb-3">Datos de Entrega</h5>
                <p><strong>Nombre:</strong><br>{{ $pedido->nombre_cliente }}</p>
                <p><strong>Email:</strong><br>{{ $pedido->email_cliente }}</p>
                <p><strong>Teléfono:</strong><br>{{ $pedido->telefono_cliente }}</p>
                <p><strong>Dirección:</strong><br>{{ $pedido->direccion_entrega }}</p>
                
                @if($pedido->notas)
                    <p class="mt-3"><strong>Notas:</strong><br>{{ $pedido->notas }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ route('farmacia.mis-pedidos') }}" class="btn btn-outline-light">
                <i class="bi bi-arrow-left me-2"></i>Volver a Mis Pedidos
            </a>
        </div>
    </div>
</div>

@endsection

