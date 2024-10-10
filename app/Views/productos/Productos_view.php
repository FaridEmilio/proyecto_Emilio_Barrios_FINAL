<div class="container py-4" style="margin-top: 56px;">
  <?php if (session("msg")) : ?>
    <div class="container alert alert-success text-start">
      <?php echo session("msg"); ?>
    </div>
  <?php endif ?>
  <div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
      <h3 class="text-left mb-0">Productos</h3>
      <div>
        <a class="btn btn-xs ml-2" style="background-color: black; color: white;" href="<?php echo base_url('nuevoProducto'); ?>">
          <i class="bi bi-plus-circle-fill"></i> Nuevo Producto
        </a>
        <a class="btn btn-xs ml-2" style="background-color: lightcoral; color: black;" href="<?php echo base_url('eliminadosProd'); ?>">
          <i class="bi bi-trash3-fill"></i> Eliminados
        </a>
      </div>
    </div>
    </div>
    <div class="card-body">

      <div class="table-responsive mt-2">
        <table class="table table-sm table-striped text-center" id="users-list">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Precio</th>
              <th>Precio Venta</th>
              <th>Categoría</th>
              <th>Imagen</th>
              <th>Stock</th>
              <th>Stock Min</th>
              <th></th>
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
                  <?php switch ($prod['categoria_id']) {
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
                  <td><?php echo $categoria  ?></td>
                  <td><img class="frmImg3" src="<?php echo base_url('assets/uploads/' . $prod['imagen']); ?>"></td>
                  <td class="text-center"><?php echo $prod['stock']; ?></td>
                  <td class="text-center"><?php echo $prod['stock_min']; ?></td>


                  <td>
                    <a href="<?php echo base_url('ProductoEdit/' . $prod['id']); ?>">
                      <i class="bi bi-pencil-square" style="color: royalblue; font-size: 1.5em;"></i>
                    </a>
                  <td>
                    <a href="<?php echo base_url('deleteProd/' . $prod['id']); ?>">
                      <i class="bi bi-trash3" style="color: red; font-size: 1.5em;" onclick="return confirm('Confirme para eliminar el producto');">
                      </i>
                    </a>
                  </td>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>

        </table>

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