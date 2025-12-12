<nav class="navbar navbar-expand-lg navbar-dark custom-navbar sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center fw-bold text-white" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Clínica Vida" width="45" height="45" class="me-2 rounded-circle shadow">
            <span class="fs-4">Clínica Vida</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#menuVida"
                aria-controls="menuVida" aria-expanded="false" aria-label="Menú">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuVida">
            <ul class="navbar-nav ms-auto text-center">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('principal') ? 'active-link' : '' }}" href="{{ url('/principal') }}">
                        <i class="bi bi-house-door-fill me-1"></i>Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('clinica') ? 'active-link' : '' }}" href="{{ route('clinica') }}">
                        <i class="bi bi-hospital-fill me-1"></i>Clínica
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('farmacia*') ? 'active-link' : '' }}" href="{{ route('farmacia.index') }}">
                        <i class="bi bi-capsule-pill me-1"></i>Farmacia
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('acercade') ? 'active-link' : '' }}" href="{{ url('/acercade') }}">
                        <i class="bi bi-info-circle-fill me-1"></i>Acerca de
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('servicios') ? 'active-link' : '' }}" href="{{ url('/servicios') }}">
                        <i class="bi bi-heart-pulse-fill me-1"></i>Servicios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('cita') ? 'active-link' : '' }}" href="{{ route('solicitar.cita') }}">
                        <i class="bi bi-calendar-check-fill me-1"></i>Citas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('contacto') ? 'active-link' : '' }}" href="{{ url('/contacto') }}">
                        <i class="bi bi-envelope-fill me-1"></i>Contacto
                    </a>
                </li>
                @auth
                    @if(Auth::user()->isDoctor())
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('doctor/*') ? 'active-link' : '' }}" href="{{ route('doctor.dashboard') }}">
                                <i class="bi bi-speedometer2 me-1"></i>Dashboard
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('farmacia/carrito') ? 'active-link' : '' }}" href="{{ route('farmacia.carrito') }}">
                            <i class="bi bi-cart me-1"></i>Carrito
                            @php
                                $carritoCount = 0;
                                if (Auth::check()) {
                                    $carritoCount = \App\Models\Carrito::where('user_id', Auth::id())->sum('cantidad');
                                } elseif (session()->has('cart_session_id')) {
                                    $carritoCount = \App\Models\Carrito::where('session_id', session('cart_session_id'))->sum('cantidad');
                                }
                            @endphp
                            @if($carritoCount > 0)
                                <span class="badge bg-danger">{{ $carritoCount }}</span>
                            @endif
                        </a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('farmacia/mis-pedidos') ? 'active-link' : '' }}" href="{{ route('farmacia.mis-pedidos') }}">
                                <i class="bi bi-bag-check me-1"></i>Mis Pedidos
                            </a>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link border-0 bg-transparent text-white" style="cursor: pointer;">
                                <i class="bi bi-box-arrow-right me-1"></i>Salir
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('login') ? 'active-link' : '' }}" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Iniciar Sesión
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
    .custom-navbar {
        background: linear-gradient(to right, #1976D2, #26A69A); 
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transition: background 0.4s ease-in-out;
    }

    .navbar-nav {
        gap: 5px;
    }

    .navbar-nav .nav-link {
        color: #e0f7fa;
        font-weight: 500;
        transition: all 0.3s ease;
        text-align: left; 
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .active-link {
        color: #ffffff !important;
        background-color: rgba(255, 255, 255, 0.15);
        border-radius: 12px;
        padding: 6px 14px;
    }

    .navbar-toggler {
        border: none;
        outline: none;
    }

    .navbar-toggler-icon {
        filter: invert(100%);
    }

    @media (max-width: 991.98px) {
        .navbar-nav {
            align-items: flex-start !important;
            text-align: left;
        }

        .navbar-collapse {
            background: rgba(0, 0, 0, 0.3); 
            padding: 15px;
            border-radius: 12px;
        }

        .navbar-nav .nav-link {
            padding: 12px 0;
            width: 100%;
        }
    }
</style>



