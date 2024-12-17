<?php
$usuario_id = session()->get('id');
?>
<div class="container py-5 d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card shadow-lg text-center" style="max-width: 600px; width: 100%;">
        <!-- Encabezado -->
        <div class="card-header bg-success text-white">
            <h2 class="fw-bold mb-0">¡Gracias por tu compra!</h2>
        </div>

        <!-- Cuerpo de la Tarjeta -->
        <div class="card-body">
            <div class="mb-4">
                <i class="fa fa-check-circle fa-5x text-success"></i>
            </div>
            <h4 class="fw-bold text-secondary mb-3">Tu compra se ha realizado con éxito</h4>
            <p class="lead text-muted">Recibirás un correo con los detalles de la compra.</p>
        </div>

        <!-- Botones de Acción -->
        <div class="card-footer bg-light">
            <div class="d-grid gap-3">
                <a href="<?= base_url('misCompras/' . $usuario_id) ?>" class="btn btn-primary btn-lg">
                    <i class="fa fa-shopping-bag me-2"></i> Ver mis compras
                </a>
                <a href="<?= base_url('catalogo') ?>" class="btn btn-secondary btn-lg">
                    <i class="fa fa-store me-2"></i> Seguir comprando
                </a>
            </div>
        </div>
    </div>
</div>

<!-- CSS Personalizado -->
<style>
    body {
        background-color: #f8f9fa;
    }

    .fa-check-circle {
        animation: pop 0.8s ease-in-out;
    }

    @keyframes pop {
        0% {
            transform: scale(0);
        }

        50% {
            transform: scale(1.2);
        }

        100% {
            transform: scale(1);
        }
    }

    .btn-lg {
        font-size: 1.2rem;
        padding: 10px 20px;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Limpiar el localStorage
        localStorage.removeItem("cart");
    });
</script>