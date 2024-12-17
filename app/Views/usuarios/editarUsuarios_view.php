<div class="container py-4" style="margin-top: 56px;">
  <div class="container mt-2">
    <div class="row justify-content-center">
      <div class="formulario col-md-5 shadow p-3 mb-5 bg-light">
        <h2 class="titulo text-center">Editar Usuarios</h2>

        <?php $validation = \Config\Services::validation(); ?>
        <form class="mx-auto p-2" method="post" action="<?php echo base_url('/enviarEdicion') ?>" novalidate>
          <?= csrf_field(); ?>

          <?php if (!empty(session()->getFlashdata('fail'))) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
          <?php endif ?>
          <?php if (!empty(session()->getFlashdata('success'))) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
          <?php endif ?>

          <!-- Nombre -->
          <div class="mb-2">
            <label for="nombre" class="form-label">Nombre</label>
            <input
              name="nombre"
              type="text"
              class="form-control"
              placeholder="Nombre"
              id="nombre"
              value="<?php echo esc($data['nombre']); ?>"
              required
              minlength="3"
              maxlength="20"
              pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+"
              title="El nombre debe contener solo letras y tener entre 3 y 20 caracteres">
            <?php if ($validation->getError('nombre')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $validation->getError('nombre'); ?>
              </div>
            <?php } ?>
          </div>

          <!-- Apellido -->
          <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input
              type="text"
              name="apellido"
              class="form-control"
              placeholder="Apellido"
              id="apellido"
              value="<?php echo esc($data['apellido']); ?>"
              required
              minlength="3"
              maxlength="20"
              pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+"
              title="El apellido debe contener solo letras y tener entre 3 y 20 caracteres">
            <?php if ($validation->getError('apellido')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $validation->getError('apellido'); ?>
              </div>
            <?php } ?>
          </div>

          <!-- Email -->
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
              name="email"
              type="email"
              class="form-control"
              placeholder="correo@ejemplo.com"
              id="email"
              value="<?php echo esc($data['email']); ?>"
              required
              maxlength="100"
              title="Introduce un email válido">
            <?php if ($validation->getError('email')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $validation->getError('email'); ?>
              </div>
            <?php } ?>
          </div>

          <!-- Usuario -->
          <div class="mb-3">
            <label for="usuario" class="form-label">Usuario</label>
            <input
              type="text"
              name="usuario"
              class="form-control"
              placeholder="Usuario"
              value="<?php echo esc($data['usuario']); ?>"
              required
              minlength="3"
              title="El nombre de usuario debe tener al menos 3 caracteres">
            <?php if ($validation->getError('usuario')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $validation->getError('usuario'); ?>
              </div>
            <?php } ?>
          </div>

          <!-- Teléfono -->
          <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input
              name="telefono"
              type="tel"
              class="form-control"
              placeholder="Teléfono"
              id="telefono"
              value="<?php echo esc($data['telefono']); ?>"
              required
              minlength="10"
              maxlength="10"
              pattern="\d{10}"
              title="El teléfono debe contener exactamente 10 dígitos numéricos">
            <?php if ($validation->getError('telefono')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $validation->getError('telefono'); ?>
              </div>
            <?php } ?>
          </div>

          <!-- Dirección -->
          <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input
              name="direccion"
              type="text"
              class="form-control"
              placeholder="Dirección"
              value="<?php echo esc($data['direccion']); ?>"
              required
              maxlength="100"
              title="Introduce una dirección válida (máximo 100 caracteres)">
            <?php if ($validation->getError('direccion')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $validation->getError('direccion'); ?>
              </div>
            <?php } ?>
          </div>

          <!-- Contraseña -->
          <div class="mb-3">
            <label for="pass" class="form-label">Contraseña</label>
            <input
              name="pass"
              type="password"
              class="form-control"
              placeholder="Deje en blanco para mantener la contraseña actual"
              minlength="8"
              maxlength="16"
              title="La contraseña debe tener entre 8 y 16 caracteres">
            <?php if ($validation->getError('pass')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $validation->getError('pass'); ?>
              </div>
            <?php } ?>
          </div>

          <!-- Categoría -->
          <div class="mb-3">
            <label for="perfil_id" class="form-label">Perfil</label>
            <select name="perfil_id" id="perfil_id" class="form-control">
              <option value="1" <?= $data['perfil_id'] == '1' ? 'selected' : ''; ?>>Admin</option>
              <option value="2" <?= $data['perfil_id'] == '2' ? 'selected' : ''; ?>>Cliente</option>
            </select>
          </div>

          <!-- Baja -->
          <div class="mb-3">
            <label for="baja" class="form-label">Eliminado</label>
            <input name="baja" type="text" readonly class="form-control" value="<?= esc($data['baja']); ?>">
          </div>

          <!-- ID oculto -->
          <input type="hidden" name="id" value="<?= esc($data['id']); ?>">

          <!-- Botones -->
          <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <input type="submit" class="btn btn-dark" value="Modificar">
          </div>
          <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <a href="<?php echo base_url('usuarios-list'); ?>" class="btn btn-secondary">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
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