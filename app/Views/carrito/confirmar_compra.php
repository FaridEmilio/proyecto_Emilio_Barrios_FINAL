<?php
// Obtener fecha y hora actuales
$fechaHoraCompra = date('d/m/Y H:i:s'); // Formato: día/mes/año horas:minutos:segundos
?>

<div class="container py-4" style="margin-top: 15px;">
    <div class="card shadow-lg">
        <!-- Encabezado -->
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Resumen de la Compra</h3>
            </div>
        </div>
        <!-- Cuerpo de la Tarjeta -->
        <div class="card-body">
            <!-- Datos del Comprador -->
            <div class="mb-4">
                <h5 class="text-secondary fw-bold">Datos del Comprador</h5>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <p><strong>Nombre:</strong> <?= esc(session()->get('nombre') ?? 'No disponible') ?></p>
                    </div>
                    <div class="col-md-6 mb-2">
                        <p><strong>Apellido:</strong> <?= esc(session()->get('apellido') ?? 'No disponible') ?></p>
                    </div>
                    <div class="col-md-6 mb-2">
                        <p><strong>Email:</strong> <?= esc(session()->get('email') ?? 'No disponible') ?></p>
                    </div>
                    <div class="col-md-6 mb-2">
                        <p><strong>Teléfono:</strong> <?= esc(session()->get('telefono') ?? 'No disponible') ?></p>
                    </div>
                    <div class="col-md-12 mb-2">
                        <p><strong>Dirección:</strong> <?= esc(session()->get('direccion') ?? 'No disponible') ?></p>
                    </div>
                    <div class="col-md-12 mb-2">
                        <p><strong>Fecha Compra:</strong> <?= $fechaHoraCompra ?></p>
                    </div>
                </div>
            </div>

            <!-- Tabla de Productos -->
            <div class="table-responsive mb-4">
                <h5 class="text-secondary fw-bold">Productos en el Carrito</h5>
                <table class="table table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $item): ?>
                            <tr>
                                <td><?= esc($item['name']) ?></td>
                                <td><?= esc($item['qty']) ?></td>
                                <td>$<?= number_format($item['price'], 2) ?></td>
                                <td>$<?= number_format($item['price'] * $item['qty'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Total -->
            <div class="text-end mb-4">
                <h4 class="text-success fw-bold">Total a Pagar:
                    $<?= number_format(array_reduce($cart, fn($sum, $item) => $sum + ($item['price'] * $item['qty']), 0), 2) ?>
                </h4>
            </div>


            <!-- Formulario -->
            <form method="POST" action="<?= base_url('confirma_compra') ?>" class="p-3 border rounded bg-light shadow-sm">
                <input type="hidden" name="cart_data" value="<?= esc(json_encode($cart)) ?>">
                <div class="form-group mb-3">
                    <label for="tipo_pago" class="fw-bold">Seleccione el método de pago:</label>
                    <select name="tipo_pago" id="tipo_pago" class="form-select">
                        <option value="Débito">Tarjeta Débito</option>
                        <option value="Crédito">Tarjeta Crédito</option>
                        <option value="Efectivo">Efectivo</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg px-5">Confirmar Compra</button>
                    <a href="<?= base_url('CarritoList') ?>" class="btn btn-secondary btn-lg px-5">Volver</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CSS Adicional -->
<style>
    .table-hover tbody tr:hover {
        background-color: #f9f9f9;
        transition: background-color 0.3s ease-in-out;
    }

    .form-select {
        max-width: 400px;
        margin: 0 auto;
    }

    .btn-lg {
        margin-top: 10px;
        min-width: 200px;
    }

    .card-header i {
        color: #ffffff;
    }

    h5.text-secondary {
        border-bottom: 2px solid #ddd;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }
</style>