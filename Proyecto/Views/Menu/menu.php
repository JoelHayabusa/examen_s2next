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
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="main_nav">
                    <ul id="mainMenu" class="navbar-nav">
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container" id="vistaMenu">
            <!-- <div class="mt-5">
                <h2 id="vistaMenuTitle">Inicio</h2>
                <p id="vistaMenuDesc" >Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga quaerat repudiandae iusto nihil facere magnam saepe ea quos sed laboriosam! Optio animi voluptatem aliquid consequatur hic suscipit sequi voluptatum est!</p>
            </div> -->
        </div>
    </div>
    <?php getMainModule('footer', $data);?>
  </body>
</html>