<div class="container py-4" style="margin-top: 56px;">
  <div class="card">
    <div class="card-header">
      <h3 class="text-center mb-0">Consulta Detalle</h3>
    </div>
    <?php $validation = \Config\Services::validation(); ?>
    <form method="post" enctype="multipart/form-data" action="<?php echo base_url('ConsultaResuelta/' . $data['id']) ?>">
      <?= csrf_field(); ?>
      <?php if (!empty(session()->getFlashdata('fail'))) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
      <?php endif ?>
      <?php if (!empty(session()->getFlashdata('success'))) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('success'); ?></div>
      <?php endif ?>
      <div class="card-body" media="(max-width:768px)">
        <div class="mb-2">
          <label class="col-sm-2 col-form-label" for="nombre">Nombre</label>
          <div class="col-auto">
            <input name="name" type="text" class="form-control" placeholder="nombre" value="<?php echo $data['name'] ?>">
          </div><!-- Error -->
          <?php if ($validation->getError('nombre')) { ?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('nombre'); ?>
            </div>
          <?php } ?>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">E-mail</label>
          <input type="femail" name="email" class="form-control" value="<?php echo $data['email'] ?>">
          <!-- Error -->
          <?php if ($validation->getError('descripcion')) { ?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('descripcion'); ?>
            </div>
          <?php } ?>
        </div>
        <label for="exampleFormControlInput1" class="form-label">Teléfono</label>
        <input type="text" name="phone" class="form-control" value="<?php echo $data['phone'] ?>">
        <div class="mb-3">
          <br><br>
          <!-- Error -->
          <?php if ($validation->getError('phone')) { ?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('phone'); ?>
            </div>
          <?php } ?>
        </div>

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Mensaje Consulta</label>
          <input name="mensaje" type="text" class="form-control" value="<?php echo $data['mensaje'] ?>">
          <!-- Error -->
          <?php if ($validation->getError('mensaje')) { ?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('mensaje'); ?>
            </div>
          <?php } ?>
        </div>

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Estado</label>
          <h3><?php echo $data['estado'] ?></h3>
          <!-- Error -->
          <?php if ($validation->getError('stock')) { ?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('stock'); ?>
            </div>
          <?php } ?>
        </div>

        <input type="hidden" name="id" value="<?php echo $data['id'] ?>">

        <div class="d-grid gap-2 col-6 mx-auto mt-4">
          <input type="submit" class="btn btn-dark" value="Marcar Resuelta">
        </div>

        <div class="d-grid gap-2 col-6 mx-auto mt-4">
          <a type="reset" href="<?php echo base_url('consultas'); ?>" class="btn btn-secondary">Cancelar</a>
        </div>
      </div>
    </form>
  </div>
  <br>