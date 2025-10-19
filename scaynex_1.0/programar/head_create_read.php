<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="./style.css">
<?php include('includes/menubar.php'); ?>




<div class="card text-center">
  <div class="card-header text-center">
    <span class="icon-truck"></span> <br>
    <B> <h4 class="text-center"> PROGRAMACIONES </h4> </B>
  </div>
  <div class="card-body text-center">
   <b>  <?php echo $hoyfor ; ?>  -  <?php echo $horaa ; ?>   </b>
  </div>
</div>




<div class="container p-3">

  <div class="row" >
    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" class="colm">
     <?php include('head_create.php'); ?> 
    </div>
    <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
    <?php include('head_read.php'); ?> 
    </div>

  </div>
</div>






<?php include('includes/footer.php'); ?>