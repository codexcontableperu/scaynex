<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="./style.css">
<?php include('includes/menubar.php'); ?>

<div class="container p-3">

  
  <div class="row" >
    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" class="colm">
     <?php include('guiasrem_create.php'); ?> 
    </div>
    <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
    <?php include('guiasrem_read.php'); ?> 
    </div>

  </div>
</div>


<div class="card">
  <div class="card-body">

<div>

 <a href="ruta_create_read.php?idp=<?php echo $idp?>&idr=<?php echo $idr ?>" class="btn btn-success btn-lg btn-block" > 
                    &nbsp OK &nbsp
                  </a>
</div>


  </div>
</div>







<?php include('includes/footer.php'); ?>