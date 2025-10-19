<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="./style.css">
<?php include('includes/menubar.php'); ?>
<?php include("../data/conexion.php"); ?>

<style type="text/css">
  
  table{
font-size: 12px;
  }

</style>

<?php 
$us = $_GET['us'];

     $queryus="
SELECT usuarios.id_user, usuarios.user_nombre
FROM usuarios
WHERE (((usuarios.id_user)=$us));
        ";
     $resultus=mysqli_query($conexion, $queryus);
     $filasus=mysqli_fetch_assoc($resultus);

?>




<div class="card text-center">
  <div class="card-header text-center">
    <B> <h4 class="text-center"> RESUMEN DE MOVIMIENTOS  </h4> </B> 
    <h5 class="text-center"> <span class="icon-user"></span> <?php echo $filasus['user_nombre'];?> </h5> 
  </div>

</div>


<div class= "tablescroll" > 

<div class="container p-3">

      <div class="row" >
        <div class="col-12" class="colm">

 <?php

     $queryR="
SELECT ledger.id_ledger, ledger.estado, ledger.id_responsable, ledger.fecha_registro, rend_conceptos.concepto, ledger.observacion, ledger.importe, ledger.salario
FROM ledger INNER JOIN rend_conceptos ON ledger.id_concepto = rend_conceptos.id_concepto
WHERE (((ledger.estado)='R') AND ((ledger.id_responsable)=$us))
ORDER BY ledger.id_ledger;

        ";
     $resultR=mysqli_query($conexion, $queryR);
 
?> 



<div > 

<table class="scrollable table-bordered" class="table table-sm" width="100%">
  <thead class="thead-dark text-center ">
    <tr>
      <th scope="col">FECHA</th>
      <th scope="col">CONCEPTO</th>
      <th scope="col">RENDICIONES</th>
      <th scope="col">ADELANTOS</th>
      
     </tr>
  </thead>
  <tbody>

    <?php while($filasR=mysqli_fetch_assoc($resultR)) { ?>

    <tr>
      

      <td class="text-center">
        <a href="crud_envio/delete.php?id=<?php echo $filasR ['id_ledger'];?>&us=<?php echo $us?>" class="btn btn-danger"> 
          <span class="icon-bin"></span>
           </a>  <br>      
        <?php echo $filasR ['fecha_registro'];?></td>
      <td><?php echo $filasR ['concepto'];?> <br> <?php echo $filasR['observacion'];?></td>
      <td class="text-right"><?php echo $filasR ['importe'];?></td>
      <td class="text-right"><?php echo $filasR['salario'];?></td> 
 
    </tr>

<?php }?>



  </tbody>
</table>
 </div>

    </div>
  </div>
</div>
</div> 



  
      <?php
     $query2="

          SELECT ledger.estado, ledger.id_responsable, rend_conceptos.id_concepto, rend_conceptos.concepto, Sum(ledger.importe) AS SumaDeimporte, Sum(ledger.salario) AS SumaDesalario
          FROM ledger INNER JOIN rend_conceptos ON ledger.id_concepto = rend_conceptos.id_concepto
          GROUP BY ledger.estado, ledger.id_responsable, rend_conceptos.id_concepto, rend_conceptos.concepto
          HAVING (((ledger.estado)='R') AND ((ledger.id_responsable)=$us))
          ORDER BY rend_conceptos.id_concepto;
           ";
           $result2=mysqli_query($conexion, $query2);    

$queryS="
SELECT ledger.estado, ledger.id_responsable, Sum(ledger.importe) AS SumaDeimporte, Sum(ledger.salario) AS SumaDesalario
FROM ledger
GROUP BY ledger.estado, ledger.id_responsable
HAVING (((ledger.estado)='R') AND ((ledger.id_responsable)=$us));
 ";
  $resultS=mysqli_query($conexion, $queryS); 
  
      ?>

 




<div class="container">
  <div class="row">
    <div class="col-sm">


<table class="scrollable table-secondary" class="table table-sm" width="100%">
  <tbody>

    <?php while($filas2=mysqli_fetch_assoc($result2)) { ?>

    <tr>
      <td class="text-right"><?php echo $filas2 ['concepto'];?></td>
      <td class="text-right"><?php echo $filas2 ['SumaDeimporte'];?></td>
      <td class="text-right"><?php echo $filas2 ['SumaDesalario'];?></td>
     </tr>

<?php }?>

<?php $filasS=mysqli_fetch_assoc($resultS) ?>
     <th scope="row" class="text-right" >TOTAL</th>
     <th scope="row" class="text-right"><?php echo $filasS ['SumaDeimporte'];?></th>
     <th scope="row" class="text-right"><?php echo $filasS ['SumaDesalario'];?></th>

</tbody>
</table>

   

    </div>
  </div>
</div>


<br>

<div class="card text-center">
  <div class="card-header text-center">
    <B> <h4 class="text-center"> <span class="icon-checkmark"></span>  REGISTRO DE ASISTENCIA </h4> </B> 
 </div>

</div>


<div class= "tablescroll" > 

<div class="container p-3">

      <div class="row" >
        <div class="col-12" class="colm">

 <?php

     $queryA="
SELECT asistencias.id_empleado, asistencias.fecha_asist, asistencias.hora_asist, unidades.vh_placa, asistencias.obs_asist, asistencias.salario, asistencias.estado, asistencias.tardanza
FROM asistencias INNER JOIN unidades ON asistencias.placa_asig = unidades.id_vh
WHERE (((asistencias.id_empleado)=$us) AND ((asistencias.estado)='R'));

        ";
     $resultA=mysqli_query($conexion, $queryA);
 
?> 



<div > 

<table class="scrollable table-bordered" class="table table-sm" width="100%">
  <thead class="thead-dark text-center ">
    <tr>
      <th scope="col">FECHA</th>
      <th scope="col">PLACA</th>
      <th scope="col">OBSERV</th>
      <th scope="col">TARDANZAS</th>
      <th scope="col">SALARIO</th>
     </tr>
  </thead>
  <tbody>

    <?php while($filasA=mysqli_fetch_assoc($resultA)) { ?>

    <tr>
      <td class="text-center"><?php echo $filasA['fecha_asist'];?> <br> <?php echo $filasA ['hora_asist'];?> </td>
      <td><?php echo $filasA ['vh_placa'];?> </td>
      <td class="text-right"><?php echo $filasA ['obs_asist'];?></td>
      <td class="text-right"><?php echo $filasA['tardanza'];?></td> 
      <td class="text-right"><?php echo $filasA['salario'];?></td> 
    </tr>

<?php }?>



  </tbody>
</table>
 </div>

    </div>
  </div>
</div>
</div> 



  
      <?php


$querySA="
SELECT asistencias.id_empleado, Count(asistencias.fecha_asist) AS dias, Sum(asistencias.salario) AS SumaDesalario, asistencias.estado, Sum(asistencias.tardanza) AS tardanzas
FROM asistencias
GROUP BY asistencias.id_empleado, asistencias.estado
HAVING (((asistencias.id_empleado)=$us) AND ((asistencias.estado)='R'));

 ";
  $resultSA=mysqli_query($conexion, $querySA); 
  
      ?>

 

<div class="container">
  <div class="row">
    <div class="col-sm">


<table class="scrollable table-secondary" class="table table-sm" width="100%">
  <tbody>


<?php $filasSA=mysqli_fetch_assoc($resultSA) ?>
     <th scope="row" class="text-right" >TOTAL</th>
     <th scope="row" class="text-right"><?php echo $filasSA ['dias'];?> DIAS</th>
     <th scope="row" class="text-right"><?php echo $filasSA ['tardanzas'];?></th>
     <th scope="row" class="text-right"><?php echo $filasSA ['SumaDesalario'];?></th>
</tbody>
</table>

   

    </div>
  </div>
</div>


<br><br>

<div class="card">
  <div class="card-body">
    <div>
       <a href="./crud_envio/liquidar.php?us=<?php echo $us;?>&s=<?php echo $filasS ['SumaDeimporte'];?>" class="btn btn-primary btn-lg btn-block" > 
                          &nbsp LIQUIDAR RENDICION &nbsp
       </a>
    </div>
  </div>
</div>



<?php include('includes/footer.php'); ?>