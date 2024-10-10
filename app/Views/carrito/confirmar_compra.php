<div class="container py-4" style="margin-top: 15px;">
    <?php $cart = \Config\Services::cart(); ?>
    <?php $session = session();
    $nombre = $session->get('nombre');
    $apellido = $session->get('apellido');
    $perfil = $session->get('perfil_id');
    $email = $session->get('email');
    $telefono = $session->get('telefono');
    $direccion = $session->get('direccion');
    ?>
    <?php
    //print_r($session);
    //exit;
    $gran_total = 0;

    // Calcula gran total si el carrito tiene elementos
    if ($cart) :
        foreach ($cart->contents() as $item) :
            $gran_total = $gran_total + $item['subtotal'];
        endforeach;
    endif;
    ?>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <?php // Crea formulario para guarda los datos de la venta
                echo form_open("confirma_compra", ['class' => 'form-signin', 'role' => 'form']);
                ?>
                <h3 class="text-left mb-0">Resumen de la Compra</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive mt-2">
                <table class="table table-sm table-striped text-left" id="users-list">
                    <thead>
                        <tr>
                            <td style="color: #2BD5C3;">
                                Total de la Compra:
                            </td>
                            <td>
                                <strong>$<?php echo number_format($gran_total, 2); ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #2BD5C3;">
                                Nombre:
                            </td>
                            <td>
                                <?php echo ($nombre) ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #2BD5C3;">
                                Apellido:
                            </td>
                            <td>
                                <?php echo ($apellido) ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #2BD5C3;">
                                Email:
                            </td>
                            <td>
                                <?php echo ($email) ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #2BD5C3;">
                                Teléfono:
                            </td>
                            <td>
                                <?php echo ($telefono) ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #2BD5C3;">
                                Dirección:
                            </td>
                            <td>
                                <?php echo ($direccion) ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #2BD5C3;">
                                Seleccione Tipo de Pago:
                            </td>
                            <td>
                                <select name="tipo_pago">
                                    <option value="T_Debito">Tarjeta Débito</option>
                                    <option value="T_Credito">Tarjeta Crédito</option>
                                    <option value="Efectivo">Efectivo</option>

                                </select>
                            </td>
                        </tr>
                        <?php echo form_hidden('total_venta', $gran_total); ?>
                </table>
                <div class="d-grid gap-2 col-6 mx-auto mt-4">
                    <?php echo form_submit('confirmar', 'Confirmar', "class='btn btn-success'"); ?>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto mt-4">
                    <a href="<?php echo base_url('CarritoList') ?>" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>