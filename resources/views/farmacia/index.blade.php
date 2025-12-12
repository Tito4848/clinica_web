@extends('layouts.base')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
        font-family: 'Montserrat', sans-serif;
    }

    .product-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 1.5rem;
        color: #212121;
        transition: transform 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    .product-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 15px;
        background: rgba(227, 242, 253, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1976D2;
        font-size: 3rem;
    }

        .price-tag {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1976D2;
        }

    .stock-badge {
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .filter-sidebar {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 1.5rem;
        color: #212121;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="text-dark mb-2">
                <i class="bi bi-capsule-pill me-2"></i>Farmacia Clínica Vida
            </h1>
            <p class="text-muted">Productos farmacéuticos de calidad al mejor precio</p>
        </div>
    </div>

    <div class="row">
        <!-- Sidebar de Filtros -->
        <div class="col-md-3 mb-4">
            <div class="filter-sidebar">
                <h5 class="mb-3"><i class="bi bi-funnel me-2"></i>Filtros</h5>
                
                <!-- Búsqueda -->
                <form method="GET" action="{{ route('farmacia.index') }}" class="mb-4">
                    <div class="mb-3">
                        <label class="form-label">Buscar</label>
                        <input type="text" name="buscar" class="form-control" 
                               value="{{ request('buscar') }}" 
                               placeholder="Nombre, laboratorio...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Categoría</label>
                        <select name="categoria" class="form-select">
                            <option value="">Todas</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" 
                                        {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ordenar por</label>
                        <select name="orden" class="form-select mb-2">
                            <option value="nombre" {{ request('orden') == 'nombre' ? 'selected' : '' }}>Nombre</option>
                            <option value="precio" {{ request('orden') == 'precio' ? 'selected' : '' }}>Precio</option>
                        </select>
                        <select name="direccion" class="form-select">
                            <option value="asc" {{ request('direccion') == 'asc' ? 'selected' : '' }}>Ascendente</option>
                            <option value="desc" {{ request('direccion') == 'desc' ? 'selected' : '' }}>Descendente</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 mb-2">
                        <i class="bi bi-search me-2"></i>Filtrar
                    </button>
                    <a href="{{ route('farmacia.index') }}" class="btn btn-outline-light w-100">
                        <i class="bi bi-arrow-clockwise me-2"></i>Limpiar
                    </a>
                </form>
            </div>
        </div>

        <!-- Productos -->
        <div class="col-md-9">
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

            @if($productos->count() > 0)
                <div class="row g-4">
                    @foreach($productos as $producto)
                        <div class="col-md-4">
                            <div class="product-card position-relative">
                                @if($producto->stock > 0)
                                    <span class="badge bg-success stock-badge">En Stock</span>
                                @else
                                    <span class="badge bg-danger stock-badge">Agotado</span>
                                @endif

                                <div class="product-image mb-3">
                                    @if($producto->imagen)
                                        <img src="{{ asset('storage/' . $producto->imagen) }}" 
                                             alt="{{ $producto->nombre }}" 
                                             class="w-100 h-100" style="object-fit: cover; border-radius: 15px;">
                                    @else
                                        <i class="bi bi-capsule"></i>
                                    @endif
                                </div>

                                <h5 class="mb-2">{{ $producto->nombre }}</h5>
                                <p class="text-muted small mb-2">{{ $producto->categoria->nombre }}</p>
                                
                                @if($producto->laboratorio)
                                    <p class="text-muted small mb-2">
                                        <i class="bi bi-building me-1"></i>{{ $producto->laboratorio }}
                                    </p>
                                @endif

                                <div class="price-tag mb-3">S/ {{ number_format($producto->precio, 2) }}</div>

                                <div class="mt-auto">
                                    <a href="{{ route('farmacia.show', $producto->slug) }}" 
                                       class="btn btn-warning w-100 mb-2">
                                        <i class="bi bi-eye me-2"></i>Ver Detalles
                                    </a>
                                    
                                    @if($producto->stock > 0)
                                        <form method="POST" action="{{ route('carrito.store') }}">
                                            @csrf
                                            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                            <input type="hidden" name="cantidad" value="1">
                                            <button type="submit" class="btn btn-success w-100">
                                                <i class="bi bi-cart-plus me-2"></i>Agregar al Carrito
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary w-100" disabled>
                                            <i class="bi bi-x-circle me-2"></i>Agotado
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginación -->
                <div class="mt-4">
                    {{ $productos->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox fs-1 text-muted mb-3"></i>
                    <h4 class="text-dark">No se encontraron productos</h4>
                    <p class="text-muted">Intenta con otros filtros de búsqueda</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

