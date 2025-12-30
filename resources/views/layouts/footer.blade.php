<footer class="footer-glass text-white">
    <div class="container py-4 text-center" style="max-width: 1200px;">
        <div class="row mb-3">
            <div class="col-12">
                <h5 class="fw-bold mb-2 d-flex justify-content-center align-items-center gap-2" data-aos="fade-up">
                    <i class="bi bi-hospital-fill fs-4"></i> 
                    <span>Clínica Vida</span>
                </h5>
                <p class="mb-3" data-aos="fade-up" data-aos-delay="100" style="font-size: 0.95rem;">
                    Cuidamos de ti con calidad humana y profesionalismo
                </p>
            </div>
        </div>

        <!-- Íconos sociales mejorados -->
        <div class="mb-3" data-aos="zoom-in" data-aos-delay="200">
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="https://facebook.com" target="_blank" class="social-icon" aria-label="Facebook">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="https://instagram.com" target="_blank" class="social-icon" aria-label="Instagram">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="https://twitter.com" target="_blank" class="social-icon" aria-label="Twitter">
                    <i class="bi bi-x"></i>
                </a>
                <a href="mailto:contacto@clinicavida.com" class="social-icon" aria-label="Correo electrónico">
                    <i class="bi bi-envelope"></i>
                </a>
            </div>
        </div>

        <hr class="my-3" style="border-color: rgba(255, 255, 255, 0.2); max-width: 600px; margin: 1rem auto;">

        <div class="row">
            <div class="col-12">
                <p class="mb-1" style="font-size: 0.9rem;">
                    &copy; {{ date('Y') }} Clínica Vida. Todos los derechos reservados.
                </p>
                <small class="text-white-50" style="font-size: 0.8rem;">
                    Desarrollado por <strong>Maycol Anderson C De La Cruz</strong>
                </small>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer-glass {
        background: linear-gradient(135deg, #0D47A1 0%, #1565C0 100%);
        border-top: 2px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 -4px 16px rgba(0, 0, 0, 0.15);
    }

    .footer-glass .container {
        max-width: 1200px;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }

    .social-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        background: rgba(255, 255, 255, 0.12);
        border-radius: 50%;
        color: #E8EAF6;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .social-icon:hover {
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        border-color: rgba(255, 255, 255, 0.3);
    }

    @media (max-width: 576px) {
        .footer-glass {
            font-size: 0.9rem;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            font-size: 1.1rem;
        }
    }
</style>
