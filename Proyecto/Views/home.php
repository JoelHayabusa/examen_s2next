<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src="<?php echo base_url();?>/Assets/js/main.js"></script>
      <?php getMainModule('header', $data); ?>  
    <title>Examen S2Next</title>
  </head>
  <body>
  <?php 
    getModal('modalAddMenu', $data);
    getMainModule('navBar', $data);
  ?>

<div class="container">
    <div class="card my-4">
        <div class="card-header">
            <h4>Lista de Menus <button class="btn btn-primary" type="button" onclick="openAddMenuModal();"><i class="fas fa-plus-circle"></i> Nuevo</button></h4> 
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="menuList" class="table table-bordered table-hover table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Menu Padre</th>
                        <th scope="col">Fecha de Modificación</th>
                        <th scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Cristian</td>
                        <td>Ruiz</td>
                        <td></td>
                        <td>hoy</td>
                        <td>
                            <a href="#"><i class="fas fa-edit"></i></a> | <a href="#"><i class="fas fa-user-times"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    <?php getMainModule('footer', $data);?>

  </body>
</html>