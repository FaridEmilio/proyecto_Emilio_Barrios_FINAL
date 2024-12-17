<div class="container py-4" style="margin-top: 56px;">
  <div class="container mt-2">
    <div class="row justify-content-center">
      <div class="formulario col-md-5 shadow p-3 mb-5 bg-light">
        <h2 class="titulo text-center">Registrarse</h2>

        <?php $validation = \Config\Services::validation(); ?>
        <form class="mx-auto p-2" method="post" action="<?php echo base_url('/enviar-form') ?>" novalidate>
          <?= csrf_field(); ?>

          <!-- Nombre -->
          <div class="mb-2">
            <label class="col-sm-2 col-form-label" for="nombre">Nombre</label>
            <div class="col-auto">
              <input
                class="form-control form-control-sm"
                name="nombre"
                type="text"
                id="nombre"
                required
                minlength="3"
                maxlength="20"
                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+"
                title="El nombre debe contener solo letras y tener entre 3 y 20 caracteres">
            </div>
            <?php if ($validation->getError('nombre')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $validation->getError('nombre'); ?>
              </div>
            <?php } ?>
          </div>

          <!-- Apellido -->
          <div class="mb-2">
            <label class="col-sm-2 col-form-label" for="apellido">Apellido</label>
            <div class="col-auto">
              <input
                class="form-control form-control-sm"
                name="apellido"
                type="text"
                id="apellido"
                required
                minlength="3"
                maxlength="20"
                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+"
                title="El apellido debe contener solo letras y tener entre 3 y 20 caracteres">
            </div>
            <?php if ($validation->getError('apellido')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $validation->getError('apellido'); ?>
              </div>
            <?php } ?>
          </div>

          <!-- Email -->
          <div class="mb-2">
            <label class="col-sm-2 col-form-label" for="email">Email</label>
            <div class="col-auto">
              <input
                class="form-control form-control-sm"
                name="email"
                type="email"
                id="email"
                required
                maxlength="100"
                title="Introduce un email válido">
            </div>
            <?php if ($validation->getError('email')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $validation->getError('email'); ?>
              </div>
            <?php } ?>
          </div>

          <!-- Usuario -->
          <div class="mb-2">
            <label class="col-sm-4 col-form-label" for="usuario">Nombre de usuario</label>
            <div class="col-auto">
              <input
                class="form-control form-control-sm"
                name="usuario"
                type="text"
                id="usuario"
                required
                minlength="3"
                title="El nombre de usuario debe tener al menos 3 caracteres">
            </div>
            <?php if ($validation->getError('usuario')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $validation->getError('usuario'); ?>
              </div>
            <?php } ?>
          </div>

          <!-- Teléfono -->
          <div class="mb-2">
            <label class="col-sm-2 col-form-label" for="telefono">Teléfono</label>
            <div class="col-auto">
              <input
                class="form-control form-control-sm"
                name="telefono"
                type="tel"
                id="telefono"
                required
                minlength="10"
                maxlength="10"
                pattern="\d{10}"
                title="El teléfono debe contener exactamente 10 dígitos numéricos">
            </div>
            <?php if ($validation->getError('telefono')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $validation->getError('telefono'); ?>
              </div>
            <?php } ?>
          </div>

          <!-- Dirección -->
          <div class="mb-2">
            <label class="col-sm-2 col-form-label" for="direccion">Dirección</label>
            <div class="col-auto">
              <input
                class="form-control form-control-sm"
                name="direccion"
                type="text"
                id="direccion"
                required
                maxlength="100"
                title="Introduce una dirección válida (máximo 100 caracteres)">
            </div>
            <?php if ($validation->getError('direccion')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $validation->getError('direccion'); ?>
              </div>
            <?php } ?>
          </div>

          <!-- Contraseña -->
          <div class="mb-2">
            <label class="col-sm-2 col-form-label" for="pass">Contraseña</label>
            <div class="col-auto">
              <input
                class="form-control form-control-sm"
                name="pass"
                type="password"
                id="pass"
                required
                minlength="8"
                maxlength="16"
                title="La contraseña debe tener entre 8 y 16 caracteres">
            </div>
            <?php if ($validation->getError('pass')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $validation->getError('pass'); ?>
              </div>
            <?php } ?>
          </div>

          <!-- Botón de registro -->
          <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <input type="submit" class="btn btn-dark" value="Regístrarme" id="button">
          </div>

          <!-- Botón de cancelar -->
          <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <a href="<?php echo base_url('/'); ?>" class="btn btn-secondary">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://kit.fontawesome.com/81581fb069.js" crossorigin="anonymous"></script>

<script>
  function validateInput(selector) {
    const inputElement = document.querySelector(selector);
    if (inputElement) {
      inputElement.addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, ''); // Permite solo letras y espacios
      });
    }
  }

  function preventSpaces(selector) {
    const inputElement = document.querySelector(selector);
    if (inputElement) {
      // Elimina espacios mientras escribe
      inputElement.addEventListener('input', function() {
        this.value = this.value.replace(/\s/g, '');
      });

      // Muestra un mensaje si se intenta ingresar un espacio
      inputElement.addEventListener('keydown', function(event) {
        if (event.code === 'Space') {
          event.preventDefault(); // Bloquea la acción del espacio
          alert('No se permiten espacios en este campo.');
        }
      });
    }
  }

  // Validar solo letras en los campos nombre y apellido
  validateInput('#nombre');
  validateInput('#apellido');

  // Evitar espacios en los campos email y usuario
  preventSpaces('#email');
  preventSpaces('#usuario');

  // Validar solo números en el campo teléfono
  document.getElementById('telefono').addEventListener('input', function(e) {
    this.value = this.value.replace(/\D/g, ''); // Permite solo números
  });
</script>