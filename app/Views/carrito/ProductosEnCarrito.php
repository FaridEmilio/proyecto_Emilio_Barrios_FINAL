<div class="container py-4" style="margin-top: 56px;">
    <?php $cart = \Config\Services::cart(); ?>

    <?php if (session("msg")) : ?>
        <div class="container alert alert-success text-start">
            <?php echo session("msg"); ?>
        </div>
    <?php endif ?>
    <?php if (session("msgEr")) : ?>
        <div class="container alert alert-success text-start">
            <?php echo session("msgEr"); ?>
        </div>
    <?php endif ?>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="text-center mb-0">Mi carrito</h3>
            </div>
        </div>
        <div class="card-body">
           
                <?php
                // Si el carrito está vacio, mostrar el siguiente mensaje
                if (empty($carrito)) {
                    echo 'Tu carrito está vacío, vuelve al catálogo para comprar';
                }
                ?>
            
        </div>


        <div class="table-responsive mt-2">
            <table class="table table-sm table-striped text-center" id="users-list">


                <?php // Todos los items de carrito en "$cart".
                if ($carrito) :
                ?>
                    <tr id="main_heading" style="color: #1D94AC; background-color: #EAF7FD; font-weight: bold;">
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Precio</td>
                        <td>Cantidad</td>
                        <td>Subtotal</td>
                        <td>Eliminar</td>
                    </tr>

                    <?php // Crea un formulario y manda los valores a carrito_controller/actualiza carrito
                    echo form_open('carrito_actualiza');
                    $gran_total = 0;
                    $i = 1;

                    foreach ($carrito as $item) :
                        echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                        echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                        echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                        echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                        echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                    ?>
                        <tr style="color: white;">
                            <td>
                                <?php echo $i++; ?>
                            </td>
                            <td>
                                <?php echo $item['name']; ?>
                            </td>
                            <td>
                                $ARS <?php echo number_format($item['price'], 2); ?>
                            </td>
                            <td>
                                <?php echo form_input(
                                    'cart[' . $item['id'] . '][qty]',
                                    $item['qty'],
                                    'maxlength="3" size="1" style="text-align: right"'
                                ); ?>
                            </td>
                            <?php $gran_total = $gran_total + $item['subtotal']; ?>
                            <td>
                                $ARS <?php echo number_format($item['subtotal'], 2) ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url('carrito_elimina/' . $item['rowid']); ?>" onclick="return confirm('Confirme para eliminar el producto');">
                                    <i class="bi bi-trash3" style="color: red; font-size: 1.5em;"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>

                    <tr>
                        <td colspan="6">
                            <b style="color: black;">Total: $
                                <?php //Gran Total
                                echo number_format($gran_total, 2);
                                ?>
                            </b>

                        </td>
                    </tr>
                    <td colspan="6">
                        <!-- Borrar carrito con mensaje de confirmación -->
                        <div class="d-grid gap-2 col-6 mx-auto mt-4">
                            <a href="<?php echo base_url('carrito_elimina/all'); ?>" class="btn btn-danger"><i class="bi bi-cart-x-fill"></i> Vaciar carrito</a>
                        </div>

                        <!-- Submit boton. Actualiza los datos en el carrito -->

                        <div class="d-grid gap-2 col-6 mx-auto mt-2">
                            <input type="submit" class="btn btn-dark" value="Actualizar carrito">
                        </div>

                        <!-- " Confirmar orden envia a carrito_controller/muestra_compra  -->
                        <div class="d-grid gap-2 col-6 mx-auto mt-2">
                            <a href="<?php echo base_url('comprar'); ?>" class="btn btn-success">Confirmar</a>
                        </div>
                    </td>

                <?php echo form_close();
                endif; ?>
            </table>

        </div>
    </div>
</div>