<div class="container py-4" style="margin-top: 20px;">
    <?php
    $session = session();
    $nombre = $session->get('nombre');
    $perfil = $session->get('perfil_id');
    $id = $session->get('id');
    ?>

    <?php if (!$productos) { ?>
        <div class="container py-4" style="margin-top: 60px; margin-bottom: 280px">
            <div class="text-center">
                <h2>Productos no encontrados. Por favor vuelva más tarde</h2>
            </div>
        </div>
    <?php } else { ?>
        <div class="container-features">
            <p><a class="btn boton-wpp mt-2" href="<?php echo base_url('Mantequilla'); ?>">Mantequilla</a></p>
            <p><a class="btn boton-wpp mt-2" href="<?php echo base_url('Snack'); ?>">Snack</a></p>
            <p><a class="btn boton-wpp mt-2" href="<?php echo base_url('Cafe'); ?>">Café</a></p>
            <p><a class="btn boton-wpp mt-2" href="<?php echo base_url('Otros'); ?>">Otros</a></p>
            <p><a class="btn boton-wpp mt-2" href="<?php echo base_url('catalogo'); ?>">Todos</a></p>
        </div>
        <section class="container top-products">
            <div class="container-products">
                <?php if ($productos) : ?>
                    <?php foreach ($productos as $index => $prod) : ?>
                        <?php if ($prod['eliminado'] == 'NO') : ?>
                            <div class="card-product">
                                <div class="container-img">
                                    <img src="<?php echo base_url('assets/uploads/' . $prod['imagen']); ?>">
                                </div>
                                <div class="content-card-product">
                                    <h3><?php echo $prod['nombre']; ?></h3>
                                    <p class="price">$<?php echo $prod['precio_vta']; ?></p>
                                </div>
                                <div>
                                    <?php
                                    if ($prod['stock'] < $prod['stock_min'] && $prod['stock'] > 0) {
                                        echo 'Producto debajo del Stock mínimo: ' . $prod['stock_min'];
                                    } elseif ($prod['stock'] == 0) {
                                        echo 'Sin unidades disponibles';
                                    } else {
                                        echo $prod['stock'] . ' unidades disponibles';
                                    }
                                    ?>
                                </div>
                                <div>
                                    <?php
                                    if ($perfil == 2) {
                                        // Generar un identificador único para cada formulario
                                        $form_id = 'carrito_form_' . $index;
                                        // Enviar los datos en forma de formulario para agregar al carrito
                                        echo form_open('Carrito_agrega', array('id' => $form_id));
                                        echo form_hidden('id', $prod['id']);
                                        echo form_hidden('nombre', $prod['nombre']);
                                        echo form_hidden('precio_vta', $prod['precio_vta']);
                                        echo form_hidden('stock', $prod['stock']);
                                        echo form_close();
                                    ?>
                                        <span class="add-cart" role="button" onclick="document.getElementById('<?php echo $form_id; ?>').submit();">
                                            <i class="fa-solid fa-basket-shopping"></i>
                                        </span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="add-cart" onclick="alert('Debes registrarte para comprar')">
                                            <i class="fa-solid fa-basket-shopping"></i>
                                        </span>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    <?php } ?>
</div>