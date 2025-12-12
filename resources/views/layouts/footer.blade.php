<footer class="footer-glass text-white mt-5">
    <div class="container py-4 text-center">
        <h5 class="fw-bold mb-2 d-flex justify-content-center align-items-center gap-2" data-aos="fade-up">
            <i class="bi bi-hospital-fill fs-4"></i> Clínica Vida
        </h5>

        <p class="mb-3" data-aos="fade-up" data-aos-delay="100">
            Cuidamos de ti con calidad humana y profesionalismo
        </p>

        <!-- Íconos sociales alineados horizontalmente -->
        <div class="mb-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="https://facebook.com" target="_blank" class="text-white" aria-label="Facebook">
                    <i class="bi bi-facebook fs-5"></i>
                </a>
                <a href="https://instagram.com" target="_blank" class="text-white" aria-label="Instagram">
                    <i class="bi bi-instagram fs-5"></i>
                </a>
                <a href="https://twitter.com" target="_blank" class="text-white" aria-label="Twitter">
                    <i class="bi bi-twitter-x fs-5"></i>
                </a>
                <a href="mailto:contacto@clinicavida.com" class="text-white" aria-label="Correo electrónico">
                    <i class="bi bi-envelope fs-5"></i>
                </a>
            </div>
        </div>

        <p class="mb-0">&copy; {{ date('Y') }} Clínica Vida. Todos los derechos reservados.</p>
        <small class="text-white-50">Desarrollado por <strong>Maycol Anderson Coaquira De La Cruz</strong></small>
    </div>
</footer>

<style>
    .footer-glass {
        background: linear-gradient(to right, rgba(21, 101, 192, 0.9), rgba(25, 118, 210, 0.9));
        backdrop-filter: blur(12px);
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 -5px 30px rgba(0, 0, 0, 0.1);
        animation: fadeInUp 1s ease-out;
    }

    .footer-glass a {
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .footer-glass a:hover {
        color: #ffffff;
        transform: scale(1.2);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 576px) {
        .footer-glass {
            font-size: 0.85rem;
            text-align: center;
        }
    }
</style>
