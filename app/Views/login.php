<?= $head ?>

<body class="body">
    <?= $header ?>
    <section class="hero-section" style="background: <?php echo base_url('assets/img/principal.jpg'); ?> no-repeat center;
    background-size: cover;
    width: 100%;
    height: 100vh;">
        <div class="container d-flex align-items-center justify-content-center fs-1 flex-column">
            <div class="container d-flex align-items-center justify-content-center fs-1 text-white flex-column">
                <div class="container-contact">
                    <form>
                        <h1 class="h3 mb-3 fw-normal">Iniciar sesión</h1>
                        <div class="mb-2">

                            <input type="text" class="form-control" name="username" id="username" placeholder="Usuario" autofocus required>

                        </div>
                        <div class="mb-2">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>

                        </div>
                        <input type="submit" value="Iniciar sesión" id="button" />
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?= $footer ?>
    <script src="https://kit.fontawesome.com/81581fb069.js" crossorigin="anonymous"></script>
</body>