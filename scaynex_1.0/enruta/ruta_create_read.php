<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="./style.css">
<?php include('includes/menubar.php'); ?>


<div class="container p-3">


  <div class="row" >
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" class="colm">
     <?php include('ruta_create.php'); ?> 
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
    <?php include('ruta_read.php'); ?> 
    </div>

  </div>
</div>


<?php include('includes/footer.php'); ?>