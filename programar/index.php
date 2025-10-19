<?php include('includes/header.php'); ?>
<div class="p-5 text-center">
  <br>
<h4> SIREP </h4>
<h6>Modulo de Programaciones de rutas 2.0 </h6>
</div>


<!-- Main CSS -->
<link rel="stylesheet" href="./stylos/main.css">
<!-- Ionicons -->
<link rel="stylesheet" href="./stylos/ionicons.css">
<!-- iCheck -->
<link rel="stylesheet" href="./stylos/blue.css">

  <body>


<?php 


if (isset($_GET['dni'])) {
$dni = $_GET['dni'];
?>  
      <form action="./valida/valida_user.php" method="post" class="AjaxForms MainLogin" data-type-form="login" autocomplete="off">
        <p class="text-center text-muted lead text-uppercase">login</p>
        <div class="form-group">
          <label class="control-label" for="usuario">DNI</label>
          <input class="form-control" name="usuario" id="usuario" type="number" value="<?php echo $dni ?>" required="">
        </div>
        <div class="form-group">
          <label class="control-label" for="pass">Contraseña</label>
          <input class="form-control" name="pass" id="pass" type="password" required="">
        </div>
        <p class="text-center">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>        
        </p>  
    </form>
    <div class="MsjAjaxForm"></div>
<?php

} else {

?>  
      <form action="./valida/valida_user.php" method="post" class="AjaxForms MainLogin" data-type-form="login" autocomplete="off">
        <p class="text-center text-muted lead text-uppercase">login</p>
        <div class="form-group">
          <label class="control-label" for="usuario">DNI</label>
          <input class="form-control" name="usuario" id="usuario" type="number"  required="">
        </div>
        <div class="form-group">
          <label class="control-label" for="pass">Contraseña</label>
          <input class="form-control" name="pass" id="pass" type="password" required="">
        </div>
        <p class="text-center">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>        
        </p>  
    </form>
    <div class="MsjAjaxForm"></div>
<?php 
} 

?>







<?php include "./includes/scripts.php"; ?>
<?php include('includes/footer.php'); ?>