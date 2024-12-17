<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriMix</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css'); ?>">
</head>

<body style="display: flex; flex-direction: column; min-height: 100%;">
    <?php
    $session = session();
    $perfil = $session->get('perfil_id') ?? 0; // Si no obtiene nada, se asigna 0
    $nombre = $session->get('nombre') ?? 'Invitado'; // Por ejemplo, "Invitado" por defecto
    $id = $session->get('id') ?? 0; // Si no obtiene ID, se asigna 0
    ?>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="titulo navbar-brand" href="<?= base_url('/') ?>">
                Nutrimix
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <?php if ($perfil == '1'): ?>
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
                <?php elseif ($perfil == '2'): ?>
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
                                <i class="fa fa-shopping-cart fa-1x"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user-circle fa-2x"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown" style="background-color: black;">
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
                                    <a href="<?php echo base_url('logout'); ?>" class="nav-link mx-lg-3">
                                        Cerrar Sesión
                                    </a>
                                </li>
                            </ul>
                        </li>


                    </ul>
                <?php elseif ($perfil == '0'): ?>
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
                <?php endif; ?>
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
</body>

</html>