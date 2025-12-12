@extends('layouts.base')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
        font-family: 'Montserrat', sans-serif;
    }

    .checkout-card {
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
                <i class="bi bi-credit-card me-2"></i>Finalizar Compra
            </h1>
        </div>
    </div>

    <form method="POST" action="{{ route('farmacia.pedido.store') }}">
        @csrf

        <div class="row">
            <div class="col-md-8">
                <div class="checkout-card mb-4">
                    <h4 class="mb-4">Datos de Entrega</h4>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Nombre Completo *</label>
                        <input type="text" name="nombre_cliente" class="form-control" 
                               value="{{ old('nombre_cliente', Auth::check() ? Auth::user()->name : '') }}" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico *</label>
                        <input type="email" name="email_cliente" class="form-control" 
                               value="{{ old('email_cliente', Auth::check() ? Auth::user()->email : '') }}" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Teléfono *</label>
                        <input type="tel" name="telefono_cliente" class="form-control" 
                               value="{{ old('telefono_cliente', Auth::check() ? Auth::user()->telefono : '') }}" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Dirección de Entrega *</label>
                        <textarea name="direccion_entrega" class="form-control" rows="3" required>{{ old('direccion_entrega') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Notas (Opcional)</label>
                        <textarea name="notas" class="form-control" rows="3">{{ old('notas') }}</textarea>
                        <small class="text-white-50">Instrucciones especiales para la entrega</small>
                    </div>
                </div>

                <div class="checkout-card">
                    <h4 class="mb-4">Resumen del Pedido</h4>
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
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->producto->nombre }}</td>
                                    <td>{{ $item->cantidad }}</td>
                                    <td>S/ {{ number_format($item->precio_unitario, 2) }}</td>
                                    <td>S/ {{ number_format($item->cantidad * $item->precio_unitario, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-4">
                <div class="checkout-card">
                    <h4 class="mb-4">Total a Pagar</h4>
                    
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
                        <strong class="text-primary fs-4">S/ {{ number_format($total, 2) }}</strong>
                    </div>

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <small>El pedido será procesado y te contactaremos para coordinar la entrega.</small>
                    </div>

                    <a href="{{ route('farmacia.carrito') }}" class="btn btn-outline-light w-100 mb-2">
                        <i class="bi bi-arrow-left me-2"></i>Volver al Carrito
                    </a>

                    <button type="submit" class="btn btn-warning btn-lg w-100">
                        <i class="bi bi-check-circle me-2"></i>Confirmar Pedido
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

