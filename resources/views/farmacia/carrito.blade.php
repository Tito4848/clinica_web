@extends('layouts.base')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
        font-family: 'Montserrat', sans-serif;
    }

    .cart-card {
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
            <h1 class="text-white">
                <i class="bi bi-cart me-2"></i>Carrito de Compras
            </h1>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($items->count() > 0)
        <div class="row">
            <div class="col-md-8">
                <div class="cart-card mb-4">
                    <table class="table table-hover text-white">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3" style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                                @if($item->producto->imagen)
                                                    <img src="{{ asset('storage/' . $item->producto->imagen) }}" 
                                                         alt="{{ $item->producto->nombre }}" 
                                                         style="max-width: 100%; max-height: 100%; object-fit: cover; border-radius: 10px;">
                                                @else
                                                    <i class="bi bi-capsule"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <strong>{{ $item->producto->nombre }}</strong><br>
                                                <small class="text-white-50">{{ $item->producto->categoria->nombre }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>S/ {{ number_format($item->precio_unitario, 2) }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('carrito.update', $item) }}" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="cantidad" 
                                                   value="{{ $item->cantidad }}" 
                                                   min="1" 
                                                   max="{{ $item->producto->stock }}"
                                                   class="form-control form-control-sm" 
                                                   style="width: 80px;"
                                                   onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td>S/ {{ number_format($item->cantidad * $item->precio_unitario, 2) }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('carrito.destroy', $item) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3">
                        <form method="POST" action="{{ route('carrito.clear') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('¿Estás seguro de vaciar el carrito?')">
                                <i class="bi bi-trash me-2"></i>Vaciar Carrito
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="cart-card">
                    <h4 class="mb-4">Resumen del Pedido</h4>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>S/ {{ number_format($subtotal, 2) }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>IGV (18%):</span>
                        <span>S/ {{ number_format($impuesto, 2) }}</span>
                    </div>
                    
                    <hr class="bg-white">
                    
                    <div class="d-flex justify-content-between mb-4">
                        <strong>Total:</strong>
                        <strong class="text-primary">S/ {{ number_format($total, 2) }}</strong>
                    </div>

                    <a href="{{ route('farmacia.index') }}" class="btn btn-outline-light w-100 mb-2">
                        <i class="bi bi-arrow-left me-2"></i>Seguir Comprando
                    </a>

                    <a href="{{ route('farmacia.checkout') }}" class="btn btn-warning w-100">
                        <i class="bi bi-credit-card me-2"></i>Proceder al Pago
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="cart-card text-center py-5">
            <i class="bi bi-cart-x fs-1 text-white-50 mb-3"></i>
            <h3 class="text-white mb-3">Tu carrito está vacío</h3>
            <p class="text-white-50 mb-4">Agrega productos para comenzar a comprar</p>
            <a href="{{ route('farmacia.index') }}" class="btn btn-warning btn-lg">
                <i class="bi bi-shop me-2"></i>Ir a la Farmacia
            </a>
        </div>
    @endif
</div>

@endsection

