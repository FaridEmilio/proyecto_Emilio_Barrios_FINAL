<div class="container py-4" style="margin-top: 56px;">
  <div class="container mt-2">
    <div class="row justify-content-center">
      <div class="formulario col-md-5 shadow p-3 mb-5 bg-light">
        <h2 class="titulo text-center">Nuevo Usuario</h2>

        <?php $validation = \Config\Services::validation(); ?>
        <form class="mx-auto p-2" method="post" action="<?php echo base_url('crearUs') ?>" novalidate>
          <?= csrf_field(); ?>

          <?php if (!empty(session()->getFlashdata('fail'))) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
          <?php endif ?>
          <?php if (!empty(session()->getFlashdata('success'))) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
          <?php endif ?>

          <!-- Nombre -->
          <div class="mb-2">
            <label for="nombre" class="col-form-label">Nombre</label>
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
            <label for="apellido" class="col-form-label">Apellido</label>
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
            <label for="email" class="col-form-label">Email</label>
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
            <label for="usuario" class="col-form-label">Usuario</label>
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
            <label for="telefono" class="col-form-label">Teléfono</label>
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
            <label for="direccion" class="col-form-label">Dirección</label>
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
            <label for="pass" class="col-form-label">Contraseña</label>
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

          <!-- Perfil -->
          <div class="mb-2">
            <label for="perfil_id" class="col-form-label">Perfil</label>
            <div class="form-check col-sm-7 col-12">
              <input class="form-check-input" type="radio" name="perfil_id" id="Cliente" value="2">
              <label class="form-check-label" for="perfil_id">Cliente</label>
            </div>
            <div class="form-check col-sm-7 col-12 mt-2">
              <input class="form-check-input" type="radio" name="perfil_id" id="Admin" value="1">
              <label class="form-check-label" for="perfil_id">Administrador</label>
            </div>
            <?php if ($validation->getError('perfil_id')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $validation->getError('perfil_id'); ?>
              </div>
            <?php } ?>
          </div>

          <!-- Botones -->
          <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <input type="submit" class="btn btn-dark" value="Crear">
          </div>
          <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <a href="<?php echo base_url('usuarios-list'); ?>" class="btn btn-secondary">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Validaciones en tiempo real -->
<script>
  // Validar solo letras en los campos nombre y apellido
  function validateInput(selector) {
    const inputElement = document.querySelector(selector);
    if (inputElement) {
      inputElement.addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
      });
    }
  }
  validateInput('#nombre');
  validateInput('#apellido');

  // Validar solo números en el campo teléfono
  document.getElementById('telefono').addEventListener('input', function() {
    this.value = this.value.replace(/\D/g, '');
  });
</script>