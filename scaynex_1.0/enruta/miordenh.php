<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="./miruta.css">


<?php include('includes/menubar.php'); ?>

<div class="container p-3">
<h4> ORDENES DE SERVICIO </h4>

</div>


  <?php include("../data/conexion.php"); ?>

  <?php
       $query="


SELECT head_programaciones.head_fecha, programaciones.id_prog, tipo_prog.tprog_nombre, programaciones.id_conductor, programaciones.id_ayudante, usuarios.user_nick AS conductor, usuarios_1.user_nick AS ayudante, cuentas.cta_logo, cuentas.cta_nombrecomercial, programaciones.cant_estiva, habilidad.nom_habilidad, unidades.vh_placa, unidades.vh_avatar, programaciones.obs_prog, programaciones.id_estado
FROM ((((((programaciones INNER JOIN head_programaciones ON programaciones.id_head = head_programaciones.id_head) INNER JOIN usuarios ON programaciones.id_conductor = usuarios.id_user) INNER JOIN cuentas ON programaciones.id_cta = cuentas.id_cta) INNER JOIN tipo_prog ON programaciones.id_tprog = tipo_prog.id_tprog) INNER JOIN usuarios AS usuarios_1 ON programaciones.id_ayudante = usuarios_1.id_user) INNER JOIN unidades ON programaciones.vh_asignado = unidades.id_vh) INNER JOIN habilidad ON programaciones.id_habilidad = habilidad.id_habilidad
WHERE (((programaciones.id_ayudante)=$id_userup)) OR ((programaciones.id_conductor)=$id_userup )


          ";
       $result=mysqli_query($conexion, $query);
  ?>



<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link " href="miorden.php">ACTIVAS</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="miordenc.php">CERRADAS</a>
  </li>
  <li class="nav-item ">
    <a class="nav-link active" href="miordenh.php">HISTORICO</a>
  </li>

</ul>

<br><br>


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">CUENTA</th>
      <th scope="col">ALCANCE</th>
      <th scope="col">UNIDAD</th>
      <th scope="col">OBS</th>
    </tr>
  </thead>
  <tbody>
 <?php while($filas=mysqli_fetch_assoc($result)) { ?>

    <tr>
      <th ><img loading="lazy" src="../panel/<?php echo $filas ['cta_logo'];?>" width="40" heigth="10" ></th>
      <td><?php echo $filas ['tprog_nombre'];?> -  <?php echo $filas ['nom_habilidad'];?></td>
      <td><img loading="lazy" src="../panel/<?php echo $filas ['vh_avatar'];?>" width="30" heigth="30" > 
               - <?php echo $filas ['vh_placa'];?></td>
      <td><span class="icon-profile">&nbsp</span>OBS:   <?php echo $filas ['obs_prog'];?></td>
    </tr>

  <?php } ?>
  </tbody>
</table>



       
  






<?php include('includes/footer.php'); ?>