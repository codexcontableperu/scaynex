<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>

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
  <label for="user_dni">DOCUMENTO - DNI</label>
  <input class="form-control" type="text" placeholder="DNI" id="user_dni" name="user_dni" required>
  </div>

  <div class="form-group" >
    <label for="user_nombre">Nombre de Usuario</label>
    <input class="form-control" type="text" placeholder="Nombre completo" id="user_nombre" name="user_nombre" required>

  </div>
  
 <div class="form-group" >
    <label for="user_nick">Nick de Usuario</label>
    <input class="form-control" type="text" placeholder="Nombre Corto" id="user_nick" name="user_nick" required>

  </div>

  <div class="form-group" >
    <label for="user_cargo">Cargo Asignado</label>
    <input class="form-control" type="text" placeholder="Cargo asignado" id="user_cargo" name="user_cargo" required>
    
  </div>

    
  <div class="form-group" >
    <label for="user_perfil">Nivel de Acceso</label>
    <input class="form-control" type="number" placeholder="(1 Administrador) , (2 Conductor) ,(3 Ambos)" id="user_perfil" name="user_perfil" required>
    
  </div>



  <div class="form-group" >
    <label for="user_salario">Salario Diario Asignado</label>
    <input class="form-control" type="number" placeholder="00.00" id="user_salario" name="user_salario" required>
    
  </div> 

  <div class="form-group" >
    <label for="user_hingreso">HORA de Ingreso</label>
    <input class="form-control" type="time" placeholder="00.00:00" id="user_hingreso" name="user_hingreso" required>
    
  </div>  







  <button type="submit" class="btn btn-primary" id="guardar" name="guardar">CREAR USUARIO</button>
</form>



<?php include('includes/footer.php'); ?>