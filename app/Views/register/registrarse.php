<div class="container py-4" style="margin-top: 56px;">
  <div class="container mt-2">
    <div class="row justify-content-center">
      <div class="formulario col-md-5 shadow p-3 mb-5 bg-light">
        <h2 class="titulo text-center">Registrarse</h2>

        <?php $validation = \Config\Services::validation(); ?>
        <form class="mx-auto p-2" method="post" action="<?php echo base_url('/enviar-form') ?>">
          <?= csrf_field(); ?>
          <?php if (!empty(session()->getFlashdata('fail'))) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
          <?php endif ?>
          <?php if (!empty(session()->getFlashdata('success'))) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('success'); ?></div>
          <?php endif ?>

          <div class="mb-2">
            <label class="col-sm-2 col-form-label" for="nombre">Nombre</label>
            <div class="col-auto">
              <input class="form-control form-control-sm" name="nombre" type="text" required="required">
            </div>
            <!-- Error -->
            <?php if ($validation->getError('nombre')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('nombre'); ?>
              </div>
            <?php } ?>
          </div>

          <div class="mb-2">
            <label class="col-sm-2 col-form-label" for="apellido">Apellido</label>
            <div class="col-auto">
              <input class="form-control form-control-sm" name="apellido" type="text" required="required">
            </div>
            <!-- Error -->
            <?php if ($validation->getError('apellido')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('apellido'); ?>
              </div>
            <?php } ?>
          </div>

          <div class="mb-2">
            <label class="col-sm-2 col-form-label" for="email">Email</label>
            <div class="col-auto">
              <input class="form-control form-control-sm" name="email" type="email" required="required">
            </div>
            <!-- Error -->
            <?php if ($validation->getError('email')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('email'); ?>
              </div>
            <?php } ?>
          </div>

          <div class="mb-2">
            <label class="col-sm-4 col-form-label" for="usuario">Nombre de usuario</label>
            <div class="col-auto">
              <input class="form-control form-control-sm" name="usuario" type="text" required="required">
            </div>
            <!-- Error -->
            <?php if ($validation->getError('usuario')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('usuario'); ?>
              </div>
            <?php } ?>
          </div>

          <div class="mb-2">
            <label class="col-sm-2 col-form-label" for="telefono">Teléfono</label>
            <div class="col-auto">
              <input class="form-control form-control-sm" name="telefono" type="text" required="required">
            </div>
            <!-- Error -->
            <?php if ($validation->getError('telefono')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('telefono'); ?>
              </div>
            <?php } ?>
          </div>

          <div class="mb-2">
            <label class="col-sm-2 col-form-label" for="direccion">Dirección</label>
            <div class="col-auto">
              <input class="form-control form-control-sm" name="direccion" type="text" required="required">
            </div>
            <!-- Error -->
            <?php if ($validation->getError('direccion')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('direccion'); ?>
              </div>
            <?php } ?>
          </div>

          <div class="mb-2">
            <label class="col-sm-2 col-form-label" for="pass">Contraseña</label>
            <div class="col-auto">
              <input class="form-control form-control-sm" name="pass" type="password" required="required">
            </div>
            <!-- Error -->
            <?php if ($validation->getError('pass')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('pass'); ?>
              </div>
            <?php } ?>
          </div>
          <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <input type="submit" class="btn btn-dark" value="Regístrarme" id="button">
          </div>

          <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <a href="<?php echo base_url('/'); ?>" class="btn btn-secondary">Cancelar</a>
          </div>

        </form>
      </div>
    </div>
  </div>
  </section>
</div>
<script src="https://kit.fontawesome.com/81581fb069.js" crossorigin="anonymous"></script>
</body>