<div class="container py-4" style="margin-top: 56px;">
  <?php $session = session();
  $perfil = $session->get('perfil_id');
  $id = $session->get('id');
  ?>
  <?php if ($perfil == 1) { ?>
    <a class="btn btn-xs ml-2" style="background-color: black; color: white;" href="<?php echo base_url('compras'); ?>">
      <i class="bi bi-back"></i> Volver
    </a>
  <?php } else { ?>
    <a class="btn btn-xs ml-2" style="background-color: black; color: white;" href="<?php echo base_url('misCompras/' . $id); ?>">
      <i class="bi bi-back"></i> Volver
    </a>
  <?php } ?>

  <div class="card  mt-4">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <h3 class="text-left mb-0">Detalle de la Compra</h3>
      </div>
    </div>

    <div class="card-body">

      <div class="table-responsive mt-2">
        <table class="table table-sm table-striped text-center" id="users-list">
          <thead>
            <tr>
              <th>ID Producto</th>
              <th>Nombre</th>
              <th>Cantidad Comprada</th>
              <th>Precio Unitario</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($ventas) : ?>
              <?php foreach ($ventas as $vta) : ?>
                <tr>
                  <td class="bg-light"><?php echo $vta['id']; ?></td>
                  <td class="bg-light"><?php echo $vta['nombre']; ?></td>
                  <td class="text-center bg-light"><?php echo $vta['cantidad']; ?></td>
                  <td class="text-center bg-light"><?php echo $vta['precio']; ?></td>
                  <td class="text-center bg-light"><?php echo $vta['total']; ?></td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
        </table>
      </div>
    </div>
  </div>
</div>