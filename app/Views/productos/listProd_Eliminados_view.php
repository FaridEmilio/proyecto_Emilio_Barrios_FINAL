<div class="container py-4" style="margin-top: 56px;">
  <?php if (session("msg")) : ?>
    <div class="container alert alert-success text-center" style="width: 50%;">
      <?php echo session("msg"); ?>
    </div>
  <?php endif ?>


  <div class="card">
    <div class="card-header" style="background-color: lightcoral">
      <h3 class="text-center">Productos Eliminados</h3>
    </div>
    <div class="card-body">
      <div class="container">
        <div class="row align-items-center">

          <div class="col-sm mt-2">
            <a class="btn btn-xs ml-sm-auto" style="background-color: gold;" href="<?php echo base_url('Lista_Productos'); ?>">
              <i class="bi bi-back" style="color: black;"></i> Productos
            </a>
          </div>
        </div>
      </div>
      <div class="table-responsive mt-2">
        <table class="table table-sm table-striped text-center" id="users-list">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Precio</th>
              <th>Precio Venta</th>
              <th>Categoria</th>
              <th>Imagen</th>
              <th>Eliminado</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php if ($productos) : ?>
              <?php foreach ($productos as $prod) : ?>
                <tr>
                  <td><?php echo $prod['nombre']; ?></td>
                  <td><?php echo $prod['precio']; ?></td>
                  <td><?php echo $prod['precio_vta']; ?></td>
                  <?php
                  $categoria = '';
                  switch ($prod['categoria_id']) {
                    case 1:
                      $categoria = 'Mantequilla de mani';
                      break;
                    case 2:
                      $categoria = 'Snack';
                      break;
                    case 3:
                      $categoria = 'Cafe';
                      break;
                    case 4:
                      $categoria = 'Otros';
                      break;
                  } ?>
                  <td><?php echo $categoria ?></td>
                  <td><img class="frmImg3" src="<?php echo base_url('assets/uploads/' . $prod['imagen']); ?>"></td>
                  <td><?php echo $prod['eliminado'];  ?></td>
                  <td>
                    <a href="<?php echo base_url('Producto_controller/habilitarProd/' . $prod['id']); ?>">
                      <i class="bi bi-arrow-counterclockwise" style="color: blue; font-size: 2em;"></i>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>

        </table>
        <br>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#users-list').DataTable({
      "language": {
        "lengthMenu": "Mostrar _MENU_ registros por página",
        "zeroRecords": "Lo sentimos. No hay resultados.",
        "info": "Página _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtrado de _MAX_ registros totales)",
        "search": "Buscar ",
        "paginate": {
          "next": "Siguiente",
          "previous": "Anterior"
        }
      }
    });
  });
</script>
<br><br>