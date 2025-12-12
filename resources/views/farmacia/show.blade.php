@extends('layouts.base')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
        font-family: 'Montserrat', sans-serif;
    }

    .product-detail-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        color: white;
    }

    .product-image-large {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.2);
    }
</style>

<div class="container py-4">
    <div class="row mb-3">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('farmacia.index') }}" class="text-white">Farmacia</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('farmacia.index', ['categoria' => $producto->categoria_id]) }}" class="text-white">{{ $producto->categoria->nombre }}</a></li>
                    <li class="breadcrumb-item active text-white">{{ $producto->nombre }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="product-detail-card">
                <div class="product-image-large d-flex align-items-center justify-content-center mb-3">
                    @if($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" 
                             alt="{{ $producto->nombre }}" 
                             class="w-100 h-100" style="object-fit: cover; border-radius: 15px;">
                    @else
                        <i class="bi bi-capsule" style="font-size: 8rem;"></i>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="product-detail-card">
                <h1 class="mb-3">{{ $producto->nombre }}</h1>
                
                <div class="mb-3">
                    <span class="badge bg-info">{{ $producto->categoria->nombre }}</span>
                    @if($producto->requiere_receta)
                        <span class="badge bg-warning">Requiere Receta</span>
                    @endif
                </div>

                <div class="mb-4">
                    <h2 class="text-primary mb-0">S/ {{ number_format($producto->precio, 2) }}</h2>
                    @if($producto->stock > 0)
                        <p class="text-success mb-0">
                            <i class="bi bi-check-circle me-1"></i>En Stock ({{ $producto->stock }} unidades)
                        </p>
                    @else
                        <p class="text-danger mb-0">
                            <i class="bi bi-x-circle me-1"></i>Agotado
                        </p>
                    @endif
                </div>

                @if($producto->laboratorio)
                    <p class="mb-2">
                        <strong>Laboratorio:</strong> {{ $producto->laboratorio }}
                    </p>
                @endif

                @if($producto->descripcion)
                    <div class="mb-4">
                        <h5>Descripción</h5>
                        <p>{{ $producto->descripcion }}</p>
                    </div>
                @endif

                @if($producto->indicaciones)
                    <div class="mb-4">
                        <h5>Indicaciones</h5>
                        <p>{{ $producto->indicaciones }}</p>
                    </div>
                @endif

                @if($producto->contraindicaciones)
                    <div class="mb-4">
                        <h5>Contraindicaciones</h5>
                        <p>{{ $producto->contraindicaciones }}</p>
                    </div>
                @endif

                @if($producto->stock > 0)
                    <form method="POST" action="{{ route('carrito.store') }}" class="mb-3">
                        @csrf
                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                        <div class="row mb-3">
                            <div class="col-4">
                                <label class="form-label">Cantidad</label>
                                <input type="number" name="cantidad" class="form-control" 
                                       value="1" min="1" max="{{ $producto->stock }}" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg w-100">
                            <i class="bi bi-cart-plus me-2"></i>Agregar al Carrito
                        </button>
                    </form>
                @else
                    <button class="btn btn-secondary btn-lg w-100" disabled>
                        <i class="bi bi-x-circle me-2"></i>Producto Agotado
                    </button>
                @endif
            </div>
        </div>
    </div>

    @if($productosRelacionados->count() > 0)
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="text-white mb-4">Productos Relacionados</h3>
                <div class="row g-4">
                    @foreach($productosRelacionados as $relacionado)
                        <div class="col-md-3">
                            <div class="product-detail-card">
                                <a href="{{ route('farmacia.show', $relacionado->slug) }}" class="text-decoration-none text-white">
                                    <div class="mb-3" style="height: 150px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                        @if($relacionado->imagen)
                                            <img src="{{ asset('storage/' . $relacionado->imagen) }}" 
                                                 alt="{{ $relacionado->nombre }}" 
                                                 style="max-width: 100%; max-height: 100%; object-fit: cover;">
                                        @else
                                            <i class="bi bi-capsule" style="font-size: 3rem;"></i>
                                        @endif
                                    </div>
                                    <h6>{{ $relacionado->nombre }}</h6>
                                    <p class="text-primary mb-0">S/ {{ number_format($relacionado->precio, 2) }}</p>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>

@endsection

