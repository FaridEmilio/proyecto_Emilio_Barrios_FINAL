<body class="body">
    <section class="hero-section" style="background: url('assets/img/principal.jpg') no-repeat center;
    background-size: cover;
    width: 100%;
    height: 100vh;">
        <!-- Contenedor para mensajes de Flash Data -->
        <?php if (session()->getFlashdata('msg') || session()->getFlashdata('error')) : ?>
            <div class="flash-message-container">
                <?php if (session()->getFlashdata('msg')) : ?>
                    <div class="alert alert-danger flash-message"><?= session()->getFlashdata('msg') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger flash-message"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="container d-flex align-items-center justify-content-center fs-1 flex-column">
            <div class="container d-flex align-items-center justify-content-center fs-1 text-white flex-column">
                <div class="container-contact">
                    <form action="<?php echo base_url('enviarlogin'); ?>" method="post">
                        <h1 class="h3 mb-3 fw-normal">Iniciar sesión</h1>
                        <div class="mb-2">
                            <input type="text" class="form-control" name="email" id="username" placeholder="Email" autofocus required>
                        </div>
                        <div class="mb-2">
                            <input type="password" class="form-control" name="pass" id="password" placeholder="Contraseña" required>
                        </div>
                        <input type="submit" value="Iniciar sesión" id="button" />
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://kit.fontawesome.com/81581fb069.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Selecciona el input del email
            const emailInput = document.getElementById('username');

            if (emailInput) {
                // Evento para evitar espacios en tiempo real
                emailInput.addEventListener('input', function() {
                    this.value = this.value.replace(/\s/g, ''); // Elimina todos los espacios en blanco
                });

                // Mensaje de advertencia si intenta escribir un espacio
                emailInput.addEventListener('keydown', function(event) {
                    if (event.code === 'Space') {
                        event.preventDefault(); // Bloquea el ingreso de espacios
                        alert('No se permiten espacios en el email.');
                    }
                });
            }
        });
    </script>

</body>