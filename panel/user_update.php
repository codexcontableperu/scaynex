<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="./style.css">
<?php include('includes/menubar.php'); ?>

<?php include("../data/conexion.php"); ?>

<?php /*if (isset($_GET['id'])) { $id = $_GET['id'];	}  } */?>

<?php 

$query= "SELECT * FROM usuarios WHERE id_user= $id_userup"; 
		$result = mysqli_query($conexion, $query);

		$filas=mysqli_fetch_array($result);
	
	$c2 = $filas['user_dni'];	
	$c3 = $filas['user_avatar'];
	$c4 = $filas['user_nombre'];
	$c6 = $filas['user_nick'];
	$c8 = $filas['user_telefono'];
	$c9 = $filas['user_mail'];
	$c10 = $filas['user_perfil'];
	$c11 = $filas['user_cargo'];
	$c12 = $filas['user_clave'];
  $c14 = $filas['user_activo'];
  $c15 = $filas['user_disponible'];
  $c16 = $filas['user_ordenes'];


?>

 <form  action="crud_user/update.php" method="POST" enctype="multipart/form-data" class="colm">


<div class="container p-4 mx-auto">
<h4> MI PERFIL </h4>
  <div class="row" >



    <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5" >
     
        <div class="text-center" >
        		
       	<img class="fmg" src="../panel/<?php echo $c3 ?>" width="280" heigth="250" > 
       	<h3><?php echo $c6 ?></h3>
    	</div>

   		<div class="form-group " >
	    <label for="user_avatar">FOTO</label>
	    <input class="form-control" type="file" placeholder="Logotipo" id="user_avatar" name="user_avatar" >
	    <input class="form-control" type="hidden" id="avataractual" name="avataractual" value="<?php echo $c3; ?>" readonly>
	    <small id="Help" class="form-text text-muted">Actualizar FOTO (imagen 125 x 125).</small>
	    </div>

	  <div class="form-group " >
	    <label for="user_nombre">Nombre</label>
	    <input class="form-control" type="text" placeholder="Nombre de Usuario" id="user_nombre" name="user_nombre" value="<?php echo $c4; ?>">
	    <small id="Help" class="form-text text-muted">Actualizar nombre de usuario.</small>
	  </div>


	  <div class="form-group " >
	    <label for="user_nick">NICK</label>
	    			<input class="form-control" type="text" placeholder="Nombre de Empresa" id="user_nick" name="user_nick" value="<?php echo $c6; ?>">
	    <small id="Help" class="form-text text-muted">Actualizar Nick.</small>
	  </div>



 
    </div>


    <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 " class="colm">

    

	  <div class="form-group " >
	    <label for="user_dni">DOCUMENTO DE IDENTIDAD </label>
	    <input class="form-control" type="text" placeholder="Link Whatsapp" id="user_dni" name="user_dni" value="<?php echo $c2; ?>">
	    <small id="Help" class="form-text text-muted">Numero de DNI.</small>
	  </div>

	  <div class="form-group " >
	    <label for="user_mail">CORREO ELECTRONICO</label>
	    <input class="form-control" type="text" placeholder="Correo@mail.com" id="user_mail" name="user_mail" value="<?php echo $c9; ?>">
	    <small id="Help" class="form-text text-muted">Actualizar correo.</small>
	  </div>
	  


	  <div class="form-group " >
	    <label for="user_cargo">CARGO  </label>
	    <input class="form-control" type="text" placeholder="corporativo@mail.com" id="user_cargo" name="user_cargo" value="<?php echo $c11; ?>">
	    <small id="Help" class="form-text text-muted">Ingrese su CARGO.</small>
	  </div>

	  <div class="form-group " >
	    <label for="user_telefono">Télefono </label>
	    <input class="form-control" type="text" placeholder="Telefono de Contacto" id="user_telefono" name="user_telefono" value="<?php echo $c8; ?>">
	    <small id="Help" class="form-text text-muted">Ingrese su numero teléfonico de contacto.</small>
	  </div>

	  <div class="form-group " >
	    <label for="user_clave">Clave</label>
	    <input class="form-control" type="password" placeholder="Clave de Usuario" id="user_clave" name="user_clave" value="<?php echo $c12; ?>"maxlength="8">
	    <small id="Help" class="form-text text-muted">Actualizar clave.</small>
	  </div>
		  

	  <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">ACTUALIZAR</button>


	</form>

    </div>
  </div>
</div>


<?php mysqli_close($conexion); ?>
<?php include('includes/footer.php'); ?>