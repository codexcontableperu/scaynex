 
<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">

<?php include('includes/header.php'); ?>
<?php include("../data/conexion.php"); ?>

<?php  $id_head = $_GET['id'];  ?>

    <?php 
      $query="

      SELECT head_programaciones.id_head, clientes.cte_nombrecomercial, head_programaciones.id_cliente
FROM head_programaciones INNER JOIN clientes ON head_programaciones.id_cliente = clientes.id_cliente
WHERE (((head_programaciones.id_head)=$id_head))

      ";
      $result=mysqli_query($conexion, $query);
      $filas=mysqli_fetch_assoc($result);
      $cte=$filas ['id_cliente'];

    ?>


   <?/*---formulario tabla---*/?>
<h3 style="background: #f1f2f6;"> <?php echo $filas ['cte_nombrecomercial']; ?> </h3>

<form  action="crud_prog/create.php" method="POST" enctype="multipart/form-data" class="colm">


<input class="form-control"  type="hidden" id="id_head" name="id_head" value="<?php echo $id_head ; ?> " readonly>
<?php $id_estado = 1; ?>
<input class="form-control"  type="hidden" id="id_estado" name="id_estado" value="<?php echo $id_estado ; ?> " readonly>

<div class="form-group">
  <label for="id_cta">CUENTA: </label>
  <select class="custom-select" id="id_cta" name="id_cta" required>
    <option selected></option>
    <?php 
      $query="SELECT * FROM  cuentas WHERE id_cliente=$cte";
      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['id_cta']?>" >
      <?php echo $filas ['cta_nombrecomercial']  ?>
    </option>
    <?php } ?>
  </select>
</div>

<div class="form-group">
  <label for="id_tprog">TIPO PROGRAMACION: </label>
  <select class="custom-select" id="id_tprog" name="id_tprog" required>
    <option selected></option>
    <?php 
      $query="SELECT * FROM  tipo_prog ";
      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['id_tprog']?>" >
      <?php echo $filas ['tprog_nombre']  ?>  
    </option>
    <?php } ?>
  </select>
</div>


<div class="form-group">
  <label for="id_habilidad">HABILIDAD: </label>
  <select class="custom-select" id="id_habilidad" name="id_habilidad" required>
    <option selected></option>
    <?php 
      $query="SELECT * FROM  habilidad ";
      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['id_habilidad']?>" >
      <?php echo $filas ['nom_habilidad']  ?>  
    </option>
    <?php } ?>

  </select>
</div>

<div class="form-group">
  <label for="vh_asignado">VEHICULO ASIGNADO: </label>
  <select class="custom-select" id="vh_asignado" name="vh_asignado" required>
    <option selected></option>
    <?php 
      $query="SELECT * FROM  unidades WHERE vh_disponible='si' ";
      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['id_vh']?>" >
     ▪&nbsp <?php echo $filas ['vh_placa']  ?>  
      &nbsp (<?php echo $filas ['vh_capacidad']  ?>)
      &nbsp (<?php echo $filas ['vh_ordenes']  ?>)
    </option>
    <?php } ?>
  </select>
</div>


<div class="form-group">
  <label for="vh_reportado">VEHICULO REPORTADO: </label>
  <select class="custom-select" id="vh_reportado" name="vh_reportado" >
    <option selected></option>
    <?php 
      $query="SELECT * FROM  unidades WHERE vh_disponible='si' ";
      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['id_vh']?>" >
     ▪&nbsp <?php echo $filas ['vh_placa']  ?>  
      &nbsp ( <?php echo $filas ['vh_capacidad']  ?> )
      &nbsp (<?php echo $filas ['vh_ordenes']  ?>)
    </option>
    <?php } ?>
  </select>
</div> 
<div class="form-group">
  <label for="id_conductor">CONDUCTOR: </label>
  <select class="custom-select" id="id_conductor" name="id_conductor" required>
    <option selected></option>
    <?php 
      $query="SELECT usuarios.id_user, usuarios.user_nick, usuarios.user_ordenes
FROM usuarios
WHERE (((usuarios.user_disponible)='si') AND ((usuarios.user_perfil)=2))
ORDER BY usuarios.user_nick
";

      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['id_user']?>" >
     ▪&nbsp <?php echo $filas ['user_nick']  ?>  
      &nbsp (<?php echo $filas ['user_ordenes']  ?>)
    </option>
    <?php } ?>
  </select>
</div>

<div class="form-group">
  <label for="id_ayudante">AYUDANTE: </label>
  <select class="custom-select" id="id_ayudante" name="id_ayudante" required>
    <option selected></option>
    <?php 
      $query="SELECT usuarios.id_user, usuarios.user_nick, usuarios.user_ordenes
FROM usuarios
WHERE (((usuarios.user_disponible)='si') AND ((usuarios.user_perfil)=2))
ORDER BY usuarios.user_nick";
      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['id_user']?>" >
     ▪&nbsp <?php echo $filas ['user_nick']  ?>  
      &nbsp (<?php echo $filas ['user_ordenes']  ?>)
    </option>
    <?php } ?>
  </select>
</div>

  <div class="form-group" >
    <label for="cant_estiva">CANTIDAD DE ESTIVADORES </label>
    <input class="form-control" type="number" placeholder="0" id="cant_estiva" name="cant_estiva" value="0">
  </div>



  <div class="form-group" >
    <label for="obs_prog">OBSERVACIONES: </label>
    <input class="form-control" type="text" placeholder="" id="obs_prog" name="obs_prog"  >
  </div>



      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">REGISTRAR</button>
  
</form>



<?php include('includes/footer.php'); ?>
