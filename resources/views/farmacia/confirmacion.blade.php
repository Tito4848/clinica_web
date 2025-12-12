@extends('layouts.base')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
        font-family: 'Montserrat', sans-serif;
    }

    .confirmation-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 3rem;
        color: white;
        text-align: center;
    }

    .success-icon {
        font-size: 5rem;
        color: #28a745;
        margin-bottom: 1rem;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="confirmation-card">
                <i class="bi bi-check-circle-fill success-icon"></i>
                <h1 class="mb-3">¡Pedido Confirmado!</h1>
                <p class="lead mb-4">Gracias por tu compra. Tu pedido ha sido registrado exitosamente.</p>

                <div class="alert alert-success">
                    <strong>Número de Pedido:</strong> {{ $pedido->numero_pedido }}
                </div>

                <div class="text-start mb-4">
                    <h5 class="mb-3">Detalles del Pedido</h5>
                    <p><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Estado:</strong> 
                        <span class="badge bg-warning">{{ ucfirst($pedido->estado) }}</span>
                    </p>
                    <p><strong>Total:</strong> S/ {{ number_format($pedido->total, 2) }}</p>
                </div>

                <div class="text-start mb-4">
                    <h5 class="mb-3">Productos</h5>
                    <table class="table text-white">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
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

                <div class="text-start mb-4">
                    <h5 class="mb-3">Datos de Entrega</h5>
                    <p><strong>Nombre:</strong> {{ $pedido->nombre_cliente }}</p>
                    <p><strong>Email:</strong> {{ $pedido->email_cliente }}</p>
                    <p><strong>Teléfono:</strong> {{ $pedido->telefono_cliente }}</p>
                    <p><strong>Dirección:</strong> {{ $pedido->direccion_entrega }}</p>
                </div>

                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Te contactaremos pronto para coordinar la entrega de tu pedido.
                </div>

                <div class="d-flex gap-2 justify-content-center">
                    <a href="{{ route('farmacia.index') }}" class="btn btn-warning">
                        <i class="bi bi-shop me-2"></i>Seguir Comprando
                    </a>
                    @auth
                        <a href="{{ route('farmacia.mis-pedidos') }}" class="btn btn-info">
                            <i class="bi bi-list-ul me-2"></i>Ver Mis Pedidos
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

