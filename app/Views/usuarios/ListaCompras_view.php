<div class="container py-4" style="margin-top: 56px;">
  <div class="card">
    <div class="card-header">
      <h3 class="text-center mb-0">Compras</h3>
    </div>
    <div class="card-body">
      <div class="table-responsive mt-2">
        <table class="table table-sm table-striped text-center" id="users-list">
          <thead>
            <tr>
              <th>ID Compra</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Teléfono</th>
              <th>Direccion</th>
              <th>Fecha</th>
              <th>Total</th>
              <th>Tipo Pago</th>
              <th>Detalle</th>
              <th>Factura</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($ventas) : ?>
              <?php foreach ($ventas as $vta) : ?>
                <tr>
                  <td><?php echo $vta['id']; ?></td>
                  <td><?php echo $vta['nombre']; ?></td>
                  <td><?php echo $vta['apellido']; ?></td>
                  <td><?php echo $vta['telefono']; ?></td>
                  <td><?php echo $vta['direccion']; ?></td>
                  <td class="text-center"><?php echo $vta['fecha']; ?></td>
                  <td class="text-center"><?php echo $vta['total_venta']; ?></td>
                  <td><?php echo $vta['tipo_pago']; ?></td>
                  <td>
                    <a href="<?php echo base_url('DetalleVta/' . $vta['id']); ?>">
                      <i class="bi bi-file-earmark-text-fill" style="color: royalblue; font-size: 1.5em;"></i>
                    </a>
                  <td>
                    <a href="<?php echo base_url('factura/' . $vta['id']); ?>">
                      <i class="bi bi-receipt" style="color: green; font-size: 1.5em;"></i>
                    </a>
                  </td>
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