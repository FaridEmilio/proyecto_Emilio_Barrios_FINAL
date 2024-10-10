<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriMix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css'); ?>">
</head>

<body style="display: flex; flex-direction: column; min-height: 100%;">
    <?php $session = session();
    $nombre = $session->get('nombre');
    $perfil = $session->get('perfil_id');
    $id = $session->get('id'); ?>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="titulo navbar-brand" href="<?= base_url('/') ?>">
                Nutrimix
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <?php if (($perfil == '1')) { ?>
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a href="<?= base_url('compras') ?>" class="nav-link mx-lg-3">
                                Compras
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('consultas') ?>" class="nav-link mx-lg-3">
                                Consultas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('usuarios-list') ?>" class="nav-link mx-lg-3">
                                Usuarios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Lista_Productos') ?>" class="nav-link mx-lg-3">
                                Productos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('logout') ?>" class="nav-link mx-lg-3">
                                Cerrar Sesión
                            </a>
                        </li>
                    </ul>
                    <!-- -------------------------------- Fin Admin -------------------------------- -->


                    <!-- -------------------------------- NAVBAR PARA CLIENTES -------------------------------- -->
                <?php } else if ((($perfil == '2'))) { ?>
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a href="<?php echo base_url('catalogo'); ?>" class="nav-link mx-lg-3 ">
                                Productos
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('contacto') ?>" class="nav-link mx-lg-3">
                                Contacto
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('quienes_somos') ?>" class="nav-link mx-lg-3">
                                Quiénes Somos
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('comercializacion') ?>" class="nav-link mx-lg-3">
                                Comercialización
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-3" href="<?= base_url('CarritoList') ?>">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('Datatable_controller/editoMisDatos/' . $id); ?>" class="nav-link mx-lg-3">
                                Mi cuenta
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('misCompras/' . $id); ?>" class="nav-link mx-lg-3">
                                Mis Compras
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('logout') ?>" class="nav-link mx-lg-3">
                                Cerrar Sesión
                            </a>
                        </li>
                    </ul>
                <?php } else { ?>
                    <!-- -------------------------------- Para todos los usuarios-------------------------------- -->
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a href="<?php echo base_url('catalogo'); ?>" class="nav-link mx-lg-3">
                                Productos
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('contacto') ?>" class="nav-link mx-lg-3">
                                Contacto
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('quienes_somos') ?>" class="nav-link mx-lg-3">
                                Quiénes Somos
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('comercializacion') ?>" class="nav-link mx-lg-3">
                                Comercialización
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('login') ?>" class="nav-link mx-lg-3">
                                Ingresar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('registro') ?>" class="nav-link mx-lg-3">
                                Regístrarse
                            </a>
                        </li>
                    </ul>
                <?php } ?>

            </div>
        </div>
    </nav>


    <script>
        function handleScroll() {
            const navbar = document.querySelector('.navbar');
            const scrollPosition = window.scrollY;

            if (scrollPosition > 0) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }
        window.addEventListener('scroll', handleScroll);
    </script>

    <body>