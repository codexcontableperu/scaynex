<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>

<link rel="stylesheet" href="style.css">




<style>

  body {

background: #F2F2F2;  

  }


	.infigrafia{

		padding-top: 20px;
		padding-bottom: 10px;
	}



.menu a:hover {
filter: brightness(80%);

}
.mm{
  font: 130% sans-serif;
}



</style>




<div class="container">
  <div class="row text-center">
    <div class="col col-lg-4">
      
    </div>
    <div class="col-md-auto">
        <div class="infigrafia">
      	    
      	<img src="img/home.png" width="300" heigth="350" > 
    	</div>

      <div class="menu mm">
        
        <a href="user_listado.php" class="btn btn-primary btn-lg btn-block">LISTADO USUARIOS</a>

        <a href="head_create_read.php" class="btn btn-primary btn-lg btn-block">PROGRAMAR</a>

        <a href="head_print.php" class="btn btn-primary btn-lg btn-block">RESUMEN</a>
        
        <a href="asistencia.php" class="btn btn-primary btn-lg btn-block">ASISTENCIAS</a>

        <a href="envio_fondos.php" class="btn btn-primary btn-lg btn-block">RENDICIONES</a>
        
       </div>

  </div>
</div>
<div>
	




<?php include('includes/footer.php'); ?>