<div class="container py-4" style="margin-top: 56px;">
    <?php $session = session();
    $perfil = $session->get('perfil_id');
    $id = $session->get('id');
    ?>


    <?php if ($perfil == 1) { ?>
        <a class="btn btn-xs ml-2" style="background-color: black; color: white;" href="<?php echo base_url('compras'); ?>">
            <i class="bi bi-back"></i> Volver
        </a>
    <?php } else { ?>
        <a class="btn btn-xs ml-2" style="background-color: black; color: white;" href="<?php echo base_url('misCompras/' . $id); ?>">
            <i class="bi bi-back"></i> Volver
        </a>
    <?php } ?>


    <?php $total = 0; ?>
    <div class="card  mt-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="text-left mb-0">Factura De Compra</h3>
            </div>
        </div>

        <div class="card-body">

            <div class="table-responsive mt-2">
                <table class="table table-sm table-striped text-left" id="users-list">
                    <h4 class="text-center container rounded bg-light text-dark">Datos del cliente</h4>

                    <?php if ($datos) : ?>
                        <?php foreach ($datos as $vta) : ?>
                            <tr>
                                <td class="bg-light" style="color: #074A57;">
                                    <u>Nombre:</u>
                                </td>
                                <td class="bg-light">
                                    <?php echo $vta['nombre'] ?>
                                </td>
                            </tr>

                            <tr>
                                <td class="bg-light" style="color: #074A57;">
                                    <u>Apellido:</u>
                                </td>
                                <td class="bg-light">
                                    <?php echo $vta['apellido'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-light" style="color: #074A57;">
                                    <u>Teléfono:</u>
                                </td>
                                <td class="bg-light">
                                    <?php echo $vta['telefono'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-light" style="color: #074A57;">
                                    <u>Direccion:</u>
                                </td>
                                <td class="bg-light">
                                    <?php echo $vta['direccion'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-light" style="color: #074A57;">
                                    <u>Fecha de compra:</u>
                                </td>
                                <td class="bg-light">
                                    <?php echo $vta['fecha'] ?>
                                </td>
                            </tr>

                            <?php $total = $vta['total_venta']; ?>

                            <tr>
                                <td class="bg-light" style="color: #074A57;">
                                    <u>Tipo de Pago:</u>
                                </td>
                                <td class="bg-light">
                                    <?php echo $vta['tipo_pago'] ?>
                                </td>
                            </tr>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </table>
                <table class="table table-sm table-striped text-left" id="users-list">
                    <h4 class="text-center container rounded bg-light text-dark">Detalle de la compra</h4>
                    <thead>
                        <tr>
                            <th>ID Producto</th>
                            <th>Nombre</th>
                            <th>Cantidad Comprada</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($ventas) : ?>
                            <?php foreach ($ventas as $vta) : ?>
                                <tr>
                                    <td class="bg-light"><?php echo $vta['id']; ?></td>
                                    <td class="bg-light"><?php echo $vta['nombre']; ?></td>
                                    <td class="bg-light"><?php echo $vta['cantidad']; ?></td>
                                    <td class="bg-light"><?php echo $vta['precio']; ?></td>
                                    <td class="bg-light"><?php echo $vta['total']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>

                </table>
                <div align="end" class="text-white col-11 container bg-secondary">
                    <tr>
                        <td style="color: #074A57;">
                            Total a Pagar: ARS$
                        </td>
                        <td>
                            <?php echo $total; ?>
                        </td>
                    </tr>
                </div>
            </div>
        </div>
    </div>
    <br><br>