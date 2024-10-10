<div class="container py-4" style="margin-top: 56px;">
  <div class="container mt-2">
    <div class="row justify-content-center">
      <div class="formulario col-md-5 shadow p-3 mb-5 bg-light">
        <h2 class="titulo text-center">Nuevo Producto</h2>

        <?php $validation = \Config\Services::validation(); ?>
        <form class="mx-auto p-2" method="post" enctype="multipart/form-data" action="<?php echo base_url('ProductoValidation') ?>">
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
            <label class="col-form-label col-form-label" for="descripcion">Descripción</label>
            <div class="col-auto">
              <input class="form-control form-control-sm" name="descripcion" type="text" required="required">
            </div>
            <!-- Error -->
            <?php if ($validation->getError('descripcion')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('descripcion'); ?>
              </div>
            <?php } ?>
          </div>

          <div class="mb-2">
            <label class="col-form-label col-form-label" for="imagen">Cargar imagen</label>
            <div class="col-auto">
              <input name="imagen" type="file" required="required">
            </div>
            <?php if ($validation->getError('imagen')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('imagen'); ?>
              </div>
            <?php } ?>
          </div>


          <div class="mb-2">
            <label class="col-sm-2 col-form-label" for="categoria_id">Categoría</label>

            <div class="form-check col-sm-7 col-12">
              <input class="form-check-input" type="radio" name="categoria_id" id="Mantequilla de mani" value="1">
              <label class="form-check-label" for="Mantequilla de mani">Mantequilla de maní</label>
            </div>

            <div class="form-check col-sm-7 col-12 mt-2">
              <input class="form-check-input" type="radio" name="categoria_id" id="Snack" value="2">
              <label class="form-check-label" for="Snack">Snack</label>
            </div>

            <div class="form-check col-sm-7 col-12 mt-2">
              <input class="form-check-input" type="radio" name="categoria_id" id="cafe" value="3">
              <label class="form-check-label" for="cafe">Café</label>
            </div>

            <div class="form-check col-sm-5 col-12 mt-2">
              <input class="form-check-input" type="radio" name="categoria_id" id="otros" value="4">
              <label class="form-check-label" for="otros">Otros</label>
            </div>
            <!-- Error -->
            <?php if ($validation->getError('categoria_id')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('categoria_id'); ?>
              </div>
            <?php } ?>
          </div>

          <div class="mb-2">
            <label class="col-form-label col-form-label" for="precio">Precio</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="cash">$</span>
              <input class="form-control form-control-sm" name="precio" type="text" id="cash" required="required">
            </div>
            <!-- Error -->
            <?php if ($validation->getError('precio')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('precio'); ?>
              </div>
            <?php } ?>
          </div>

          <div class="mb-2">
            <label class="col-form-label col-form-label" for="precio_vta">Precio Venta</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="cash">$</span>
              <input class="form-control form-control-sm" name="precio_vta" type="text" id="cash" required="required">
            </div>
            <!-- Error -->
            <?php if ($validation->getError('precio_vta')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('precio_vta'); ?>
              </div>
            <?php } ?>
          </div>

          <div class="mb-2">
            <label class="col-form-label col-form-label" for="descripcion">Stock</label>
            <div class="col-auto">
              <input class="form-control form-control-sm" name="stock" type="text" required="required">
            </div>
            <!-- Error -->
            <?php if ($validation->getError('stock')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('stock'); ?>
              </div>
            <?php } ?>
          </div>

          <div class="mb-2">
            <label class="col-form-label col-form-label" for="stock_min">Stock Minimo</label>
            <div class="col-auto">
              <input class="form-control form-control-sm" name="stock_min" type="text" required="required">
            </div>
            <!-- Error -->
            <?php if ($validation->getError('stock_min')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('stock_min'); ?>
              </div>
            <?php } ?>
          </div>

          <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <input type="submit" class="btn btn-dark" value="Crear">
          </div>

          <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <a href="<?php echo base_url('Lista_Productos'); ?>" class="btn btn-secondary">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>