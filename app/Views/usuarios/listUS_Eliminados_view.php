<div class="container py-4" style="margin-top: 56px;">
   <?php if (session("msg")) : ?>
      <div class="container alert alert-success text-center" style="width: 50%;">
         <?php echo session("msg"); ?>
      </div>
   <?php endif ?>

   <div class="card">
      <div class="card-header" style="background-color: lightcoral">
         <h3 class="text-center">Usuarios Eliminados</h3>
      </div>
      <div class="card-body">
         <div class="container">
            <div class="row align-items-center">

               <div class="col-sm mt-2">
                  <a class="btn btn-xs ml-sm-auto" style="background-color: gold;" href="<?php echo base_url('usuarios-list'); ?>" tabindex="-1" aria-disabled="true">
                     <i class="bi bi-back" style="color: black;"></i> Usuarios
                  </a>
               </div>
            </div>
         </div>
         <div class="table-responsive mt-2">
            <table class="table table-sm table-striped text-center" id="users-list">
               <thead>
                  <tr>
                     <th>Nombre</th>
                     <th>Apellido</th>
                     <th>E-mail</th>
                     <th>Perfil</th>
                     <th>Eliminado</th>
                     <th>Acciones</th>
                  </tr>
               </thead>
               <tbody>
                  <?php if ($usuarios) : ?>
                     <?php foreach ($usuarios as $user) : ?>
                        <tr>
                           <td><?php echo $user['nombre']; ?></td>
                           <td><?php echo $user['apellido']; ?></td>
                           <td><?php echo $user['email']; ?></td>
                           <?php switch ($user['perfil_id']) {
                              case 1:
                                 $perfil = 'Admin';
                                 break;
                              case 2:
                                 $perfil = 'Cliente';
                                 break;
                           } ?>
                           <td><?php echo $perfil  ?></td>
                           <td><?php echo $user['baja'];  ?></td>
                           <td>
                              <a href="<?php echo base_url('Usuario_controller/habilitar/' . $user['id']); ?>">
                                 <i class="bi bi-arrow-counterclockwise" style="color: blue; font-size: 2em;"></i>
                           </td>
                        </tr>
                     <?php endforeach; ?>
                  <?php endif; ?>



            </table>
            <br>
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