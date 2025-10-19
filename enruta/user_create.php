<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">

    <?php if (isset($SESSION['messeage']))  { ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
       <?= $SESSION['messeage']?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
  <?php } ?>

   <?/*---formulario tabla---*/?>

<form  action="crud_user/create.php" method="POST" class="colm">
  <div class="form-group" >
    <label for="user_nombre">Nombre</label>
    <input class="form-control" type="text" placeholder="Tu Nombre" id="user_nombre" name="user_nombre">
    <small id="Help" class="form-text text-muted">Ingresa tu nombre.</small>
  </div>

  <div class="form-group" >
    <label for="user_correo">Correo Electronico</label>
    <input class="form-control" type="email" placeholder="correo@email.com" id="user_correo" name="user_correo">
    <small id="Help" class="form-text text-muted">Ingresa tu email.</small>
  </div>

  <div class="form-group" >
    <label for="user_clave">Contraseña</label>
    <input class="form-control" type="text" placeholder="Tu Clave" id="user_clave" name="user_clave">
    <small id="Help" class="form-text text-muted">Ingresa tu Clave de 8 digitos.</small>
  </div>


  <button type="submit" class="btn btn-primary" id="guardar" name="guardar">Crear Usuario</button>
</form>



<?php include('includes/footer.php'); ?>