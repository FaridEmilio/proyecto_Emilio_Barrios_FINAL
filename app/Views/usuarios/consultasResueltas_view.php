<div class="container py-4" style="margin-top: 56px;">
  <?php if (session("msg")) : ?>
    <div class="container alert alert-success text-start">
      <?php echo session("msg"); ?>
    </div>
  <?php endif ?>
  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <h3 class="text-left mb-0">Consultas Resueltas</h3>
        <div>
          <a class="btn btn-xs ml-2" style="background-color: black; color: white;" href="<?php echo base_url('consultas'); ?>" tabindex="-1" aria-disabled="true">
            <i class="bi bi-back"></i> Volver
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
              <th>Email</th>
              <th>Telefono</th>
              <th>Estado</th>
              <th>Visitante</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($consultas) : ?>
              <?php foreach ($consultas as $cons) : ?>
                <tr>
                  <td><?php echo $cons['name']; ?></td>
                  <td><?php echo $cons['email']; ?></td>
                  <td><?php echo $cons['phone']; ?></td>
                  <td><?php echo $cons['estado']; ?></td>
                  <td class="text-center"><?php echo $cons['visitante']; ?></td>
                  <td>
                    <a href="<?php echo base_url('ConsultaDetalle/' . $cons['id']); ?>">
                      <i class="bi bi-file-earmark-text-fill" style="color: royalblue; font-size: 1.5em;"></i>
                    </a>
                  <td>
                    <a href="<?php echo base_url('Contactocontroller/habilitarConsulta/' . $cons['id']); ?>">
                      <i class="bi bi-arrow-counterclockwise" style="color: blue; font-size: 2em;"></i>
                    </a>
                  </td>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
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
<br><br>