<footer class="mt-auto py-4">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-md-4">
                <div class="d-flex align-items-center mb-2">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                        <i class="fas fa-store"></i>
                    </div>
                    <span class="fw-bold fs-5">Tienda Cómics</span>
                </div>
                <p class="text-muted mb-0 small">Tu tienda de confianza para cómics, manga y coleccionables.</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="d-flex justify-content-center gap-3">
                    <a href="#" class="text-decoration-none">
                        <div class="bg-light rounded-circle p-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 36px; height: 36px;">
                            <i class="fab fa-facebook-f text-primary"></i>
                        </div>
                    </a>
                    <a href="#" class="text-decoration-none">
                        <div class="bg-light rounded-circle p-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 36px; height: 36px;">
                            <i class="fab fa-twitter text-info"></i>
                        </div>
                    </a>
                    <a href="#" class="text-decoration-none">
                        <div class="bg-light rounded-circle p-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 36px; height: 36px;">
                            <i class="fab fa-instagram text-danger"></i>
                        </div>
                    </a>
                    <a href="#" class="text-decoration-none">
                        <div class="bg-light rounded-circle p-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 36px; height: 36px;">
                            <i class="fab fa-youtube text-danger"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <p class="mb-0 text-md-end text-muted small">
                    &copy; {{ date('Y') }} Tienda de Cómics. <br class="d-md-none">Todos los derechos reservados.
                </p>
            </div>
        </div>
    </div>
    <div class="border-top border-light mt-4 pt-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <ul class="list-inline mb-md-0 small">
                        <li class="list-inline-item"><a href="#" class="text-decoration-none text-muted">Términos y Condiciones</a></li>
                        <li class="list-inline-item">•</li>
                        <li class="list-inline-item"><a href="#" class="text-decoration-none text-muted">Privacidad</a></li>
                        <li class="list-inline-item">•</li>
                        <li class="list-inline-item"><a href="#" class="text-decoration-none text-muted">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-muted small mb-0">Diseñado con <i class="fas fa-heart text-danger mx-1"></i> por Tu Equipo</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Estilos personalizados para el footer -->
<style>
    footer {
        background-color: #f8f9fa;
        box-shadow: 0 -5px 15px rgba(0,0,0,0.05);
    }

    footer a:hover {
        opacity: 0.8;
    }

    footer .border-light {
        border-color: rgba(0,0,0,0.05) !important;
    }

    footer .social-icon:hover {
        transform: translateY(-3px);
    }

    footer .list-inline-item:not(:last-child) {
        margin-right: 1rem;
    }
</style>
