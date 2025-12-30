<nav class="navbar navbar-expand-lg navbar-dark custom-navbar sticky-top shadow-sm">
    <div class="container" style="max-width: 1200px;">
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
                {{-- Farmacia solo para usuarios no doctores --}}
                @guest
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('farmacia*') ? 'active-link' : '' }}" href="{{ route('farmacia.index') }}">
                        <i class="bi bi-capsule-pill me-1"></i>Farmacia
                    </a>
                </li>
                @endguest
                @auth
                    @if(!Auth::user()->isDoctor())
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('farmacia*') ? 'active-link' : '' }}" href="{{ route('farmacia.index') }}">
                            <i class="bi bi-capsule-pill me-1"></i>Farmacia
                        </a>
                    </li>
                    @endif
                @endauth
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('profesionales') ? 'active-link' : '' }}" href="{{ route('profesionales') }}">
                        <i class="bi bi-person-vcard me-1"></i>Profesionales
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
                    @else
                        {{-- Opciones solo para pacientes/usuarios no doctores --}}
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('mis-citas') ? 'active-link' : '' }}" href="{{ route('citas.mis-citas') }}">
                                <i class="bi bi-calendar-check me-1"></i>Mis Citas
                            </a>
                        </li>
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
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('farmacia/mis-pedidos') ? 'active-link' : '' }}" href="{{ route('farmacia.mis-pedidos') }}">
                                <i class="bi bi-bag-check me-1"></i>Mis Pedidos
                            </a>
                        </li>
                    @endif
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
        background: linear-gradient(135deg, #0D47A1 0%, #1565C0 100%); 
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        transition: all 0.4s ease-in-out;
        padding: 0.6rem 0;
        border-bottom: 2px solid rgba(255, 255, 255, 0.1);
    }

    .custom-navbar .container {
        max-width: 1200px;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }

    .navbar-brand {
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        padding: 0.5rem 0;
    }
    .navbar-brand img {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }

    .navbar-brand:hover img {
        transform: scale(1.05);
    }


    .navbar-nav {
        gap: 0.5rem;
        align-items: center;
    }

    .navbar-nav .nav-item {
        margin: 0 0.25rem;
    }

    .navbar-nav .nav-link {
        color: rgba(255, 255, 255, 0.92) !important;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-align: center;
        padding: 0.5rem 1rem !important;
        border-radius: 8px;
        position: relative;
        letter-spacing: 0.2px;
    }

    .navbar-nav .nav-link::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 2px;
        background: rgba(255, 255, 255, 0.9);
        transition: width 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
        color: #ffffff !important;
        background-color: rgba(255, 255, 255, 0.15);
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .navbar-nav .nav-link:hover::before {
        width: 80%;
    }

    .navbar-nav .nav-link.active-link {
        color: #ffffff !important;
        background-color: rgba(255, 255, 255, 0.2);
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
    }

    .navbar-nav .nav-link.active-link::before {
        width: 80%;
    }

    .navbar-nav .nav-link i {
        margin-right: 0.4rem;
        font-size: 1rem;
    }

    .navbar-toggler {
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        transition: all 0.3s ease;
    }

    .navbar-toggler:hover {
        border-color: rgba(255, 255, 255, 0.6);
        background-color: rgba(255, 255, 255, 0.1);
    }

    .navbar-toggler-icon {
        filter: invert(100%);
    }

    .navbar-toggler:focus {
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
    }

    @media (max-width: 991.98px) {
        .custom-navbar {
            padding: 0.75rem 0;
        }

        .navbar-nav {
            gap: 0.5rem;
            align-items: flex-start !important;
            text-align: left;
            margin-top: 1rem;
        }

        .navbar-nav .nav-item {
            margin: 0;
            width: 100%;
        }

        .navbar-collapse {
            background: rgba(0, 0, 0, 0.25); 
            padding: 1.5rem;
            border-radius: 15px;
            margin-top: 1rem;
            backdrop-filter: blur(10px);
        }

        .navbar-nav .nav-link {
            padding: 0.75rem 1rem !important;
            width: 100%;
            margin-bottom: 0.25rem;
        }

        .navbar-nav .nav-link::before {
            display: none;
        }
    }

    @media (min-width: 992px) {
        .navbar-nav .nav-link {
            margin: 0 0.15rem;
        }
    }
</style>



