<div class="container py-4" style="margin-top: 56px;">
   <?php if (session("msg")) : ?>
      <div class="container alert alert-success text-start">
         <?php echo session("msg"); ?>
      </div>
   <?php endif ?>
   <div class="card">
      <div class="card-header">
         <div class="d-flex justify-content-between align-items-center">
            <h3 class="text-left mb-0">Usuarios</h3>
            <div>
               <a class="btn btn-xs ml-2" style="background-color: black; color: white;" href="<?php echo base_url('nuevoUs'); ?>">
                  <i class="bi bi-plus-circle-fill"></i> Nuevo Usuario
               </a>
               <a class="btn btn-xs ml-2" style="background-color: lightcoral; color: black;" href="<?php echo base_url('eliminados'); ?>">
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
                     <th>Apellido</th>
                     <th>E-mail</th>
                     <th>Perfil</th>
                     <th>Eliminado</th>
                     <th></th>
                     <th></th>
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
                              <a href="<?php echo base_url('editarUs/' . $user['id']); ?>">
                                 <i class="bi bi-pencil-square" style="color: royalblue; font-size: 1.5em;"></i>
                              </a>
                           <td>
                              <a href="<?php echo base_url('Usuario_controller/delete/' . $user['id']); ?>">
                                 <i class="bi bi-trash3" style="color: red; font-size: 1.5em;" onclick="return confirm('Confirme para eliminar al usuario');">
                                 </i>
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