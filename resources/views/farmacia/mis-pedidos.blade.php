@extends('layouts.base')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
        font-family: 'Montserrat', sans-serif;
    }

    .order-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 1.5rem;
        color: #212121;
        margin-bottom: 1rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="text-dark">
                <i class="bi bi-list-ul me-2"></i>Mis Pedidos
            </h1>
        </div>
    </div>

    @if($pedidos->count() > 0)
        @foreach($pedidos as $pedido)
            <div class="order-card">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <strong>Pedido #{{ $pedido->numero_pedido }}</strong><br>
                        <small class="text-muted">{{ $pedido->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                    <div class="col-md-2">
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
                    <div class="col-md-3">
                        <small class="text-muted">{{ $pedido->detallePedidos->count() }} producto(s)</small>
                    </div>
                    <div class="col-md-2 text-end">
                        <strong class="text-primary">S/ {{ number_format($pedido->total, 2) }}</strong>
                    </div>
                    <div class="col-md-2 text-end">
                        <a href="{{ route('farmacia.pedido.show', $pedido) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-eye me-1"></i>Ver Detalle
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="mt-4">
            {{ $pedidos->links() }}
        </div>
    @else
        <div class="order-card text-center py-5">
            <i class="bi bi-inbox fs-1 text-muted mb-3"></i>
            <h3 class="text-dark mb-3">No tienes pedidos aún</h3>
            <p class="text-muted mb-4">Comienza a comprar en nuestra farmacia</p>
            <a href="{{ route('farmacia.index') }}" class="btn btn-warning btn-lg">
                <i class="bi bi-shop me-2"></i>Ir a la Farmacia
            </a>
        </div>
    @endif
</div>

@endsection

