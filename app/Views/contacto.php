<body class="body">
    <?php
    $session = session();
    $nombre = $session->get('nombre');
    $email = $session->get('email');
    $id = $session->get('id');
    $tel = $session->get('telefono');
    ?>
    <?php $validation = \Config\Services::validation(); ?>
    <section class="hero-section" style="background: url('assets/img/principal.jpg') no-repeat center;
    background-size: cover;
    width: 100%;
    height: 140vh;">
        <div class="container d-flex align-items-center justify-content-center fs-1 text-white flex-column">
            <div class="container-contact">
                <?php $validation = \Config\Services::validation(); ?>
                <form method="post" action="<?php echo base_url('/submit-form') ?>">
                    <h1 class="h3 mb-3 fw-normal">Contáctanos</h1>
                    <div class="mb-2">
                        <?php if ($nombre != null) { ?>

                            <input type="text" name="name" value="<?php echo $nombre ?>" readonly="true" required="required">
                        <?php } else { ?>
                            <input type="text" name="name" placeholder="Nombre" required="required">

                        <?php } ?>
                    </div>
                    <?php if ($validation->getError('name')) { ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('name'); ?>
                        </div>
                    <?php } ?>
                    <div class="mb-2">
                        <?php if ($email != null) { ?>

                            <input type="text" name="email" value="<?php echo $email ?>" readonly="true" required="required">
                            <input type="hidden" name="visitante" value="No">
                        <?php } else { ?>
                            <input type="text" name="email" placeholder="ejemplo@gmail.com" required="required">
                            <input type="hidden" name="visitante" value="Sí">
                        <?php } ?>
                    </div>
                    <?php if ($validation->getError('email')) { ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('email'); ?>
                        </div>
                    <?php } ?>
                    <div class="mb-2">

                        <input type="text" name="mensaje" placeholder="Tu mensaje aqui." required="required">


                    </div>
                    <?php if ($validation->getError('mensaje')) { ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('mensaje'); ?>
                        </div>

                    <?php } ?>
                    <div class="mb-2">
                        <?php if ($tel != null) { ?>

                            <input type="text" name="phone" value="<?php echo $tel ?>" readonly="true" required="required">

                        <?php } else { ?>
                            <input type="text" name="phone" placeholder="Tu teléfono" required="required">
                    </div>
                <?php } ?>


                <input type="submit" value="Enviar" id="button" />
                </form>
            </div>
        </div>
    </section>
    <section class="contact-info">
        <div class=" flex-column justify-content-center align-items-center text-center">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <h5 class="contact-text my-2">nutrimix@contacto.com</h5>
                </div>
                <div class="col-sm-12 col-md-4">
                    <i class="fa fa-phone-square"></i>
                    <h5 class="contact-text my-2">3777-636786</h5>
                </div>
                <div class="col-sm-12 col-md-4">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                    <h5 class="contact-text my-2">LU-VI de 09:00 a 18:00</h5>
                </div>
            </div>
            <div class="justify-content-center align-items-center text-center mt-6">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <h5 class="contact-text my-2">9 de Julio, 1449, Corrientes Argentina</h5>
                <iframe class="w-75 h-75" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d442.51552329872135!2d-58.8347892,17!3d-27.4664506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456b1e7c96546f%3A0x5fd8545ab4c46264!2sAv.%20Libertad%205251%2C%20W3402%20Corrientes!5e0!3m2!1ses-419!2sar!4v1682382082279!5m2!1ses-419!2sar" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <p class="contact-text mt-3">Titular: Barrios, Emilio Farid</p>
            </div>
        </div>
    </section>

</body>