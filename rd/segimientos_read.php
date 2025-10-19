<?php include("../data/conexion.php"); ?>
<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>
<?php

if (isset($_POST['f'])) {
  $fecha = $_POST['f'];
$_SESSION['fechaw']=$fecha;
$FECHAW=$_SESSION['fechaw'];
} else  {
  $fecha = $_GET['f'];
$_SESSION['fechaw']=$fecha;
$FECHAW=$_SESSION['fechaw'];
}


$query="
SELECT rd_segimientos_head.*, rd_segimientos_head.S_FECHA
FROM rd_segimientos_head
WHERE (((rd_segimientos_head.S_FECHA)='$fecha'))";
$result=mysqli_query($conexion, $query);

?>

<style>



</style>


<div class="card text-center">
  <div class="card-header">
    <B><h4>
    <span class="icon-truck"></span>  CONTROL DE SERVICIOS <?php echo $fecha ?>
    </B></h4>

<div class="dropdown-divider"></div> 

<style>
  .form-container {
  display: flex;
  justify-content: flex-end;
  align-items: center;
}


</style>
<?php
$queryT="
SELECT Count(rd_segimientos_head.Id_SERG) AS CuentaDeId_SERG, rd_segimientos_head.S_FECHA
FROM rd_segimientos_head
GROUP BY rd_segimientos_head.S_FECHA
HAVING (((rd_segimientos_head.S_FECHA)='$fecha'))";
$resultT=mysqli_query($conexion, $queryT);
$filasT=mysqli_fetch_assoc($resultT);

?>
<?php
$queryTS="
SELECT rd_segimientos_head.S_FECHA, Count(rd_servicio.Id_SERV) AS CuentaDeId_SERV
FROM rd_segimientos_head INNER JOIN rd_servicio ON rd_segimientos_head.Id_SERG = rd_servicio.Id_SERG
GROUP BY rd_segimientos_head.S_FECHA
HAVING (((rd_segimientos_head.S_FECHA)='$fecha'))
";
$resultTS=mysqli_query($conexion, $queryTS);
$filasTS=mysqli_fetch_assoc($resultTS);

?>

<?php
$queryEF="
SELECT rd_segimientos_head.S_FECHA, Count(rd_operadores.Id_SERG) AS CuentaDeId_SERG, Sum(diario.DEBE) AS SumaDeDEBE, pcge.DOSDIGITOS
FROM ((rd_segimientos_head INNER JOIN rd_operadores ON rd_segimientos_head.Id_SERG = rd_operadores.Id_SERG) LEFT JOIN diario ON rd_operadores.ID_OPERA = diario.ID_OPERA) INNER JOIN pcge ON diario.CTA_CONT = pcge.ID_CTA
GROUP BY rd_segimientos_head.S_FECHA, pcge.DOSDIGITOS
HAVING (((rd_segimientos_head.S_FECHA)='$fecha') AND ((pcge.DOSDIGITOS)=14));


";
$resultEF=mysqli_query($conexion, $queryEF);
$filasEF=mysqli_fetch_assoc($resultEF);

?>


<style >
 .bt   {

 padding: 8px;
 width: 130px;
  font-size: 80%;
  box-sizing:content-box;
}

 .efectivo   {
 color: green;
 border-radius: 5px;
 border: 1px solid green;

 background-color: red;
}



.nv{

 margin: 3px;

}

@media (max-width: 767px) {
  .nv {
    width: 100%;

  }


}

</style>


<div  style="display: flex; justify-content: space-between;">
  <div class="form-container" style="text-align: right;">


<div class="container">
  <div class="row botoness">
   
    <a href="segimientos_caja.php?f=<?php echo $fecha ?>">
    <button  type="button" class="btn btn-outline-primary bt">EFECTIVO DEL DIA: S/.<?php echo $filasEF ['SumaDeDEBE'] ?>      
    </button>
    </a>
    &nbsp
    <a href="">
    <button type="button" class="btn btn-outline-success bt">VIAJES DEL DIA: 0<?php echo $filasT ['CuentaDeId_SERG'] ?>
    </button>
    </a>
    &nbsp
    <a href="segimientos_servicios.php?f=<?php echo $fecha ?>">
    <button type="button" class="btn btn-outline-dark bt">SERVICIOS DEL DIA: 0<?php echo $filasTS ['CuentaDeId_SERV'] ?>      
    </button>
    </a>

  </div>
</div>




  </div>

  <div class="form-container text-right" style="text-align: left;">
    <div class="container">
  <div class="row botoness">
    <div>    
    <form  action="segimientos_read.php" method="POST" class="form-inline">
      <div class="form-group mb-2">
        <label for="staticEmail2" class="sr-only">FECHA</label>
      </div>
      <div class="form-group mx-sm-3 mb-2">
        <label for="f" class="sr-only">FECHA</label>
        <input type="date" class="form-control nv" id="f" name="f" placeholder="DD/MM/AA" value="<?php echo $fecha ?>">
      </div>
      <button type="submit" class="btn btn-primary mb-2 nv ">
        <span class="icon-search"></span> BUSCAR
      </button>
    <a style="color: white;" type="button" data-toggle="modal" data-target="#nuevo" class="btn btn-success mb-2 nv ">
      <span class="icon-plus"></span> NUEVO
    </a>
    <a style="color: white;" type="button" data-toggle="modal" data-target="#nuevo_pll" class="btn btn-Warning mb-2 nv ">
      <span class="icon-plus"></span> PLANTILLA
    </a>
    </form>

    </div>

  </div>
</div>


  </div>
</div>



<div class="dropdown-divider"></div> 


<?/*---cabeseras de la tabla---*/?>

<table class="table table-sm text-center table-dark " >
  <thead class="thead-dark ">
    <tr>
      <th scope="col">#</th>    
      <th scope="col">FECHA</th>
      <th scope="col">VEHICULO</th>      
      <th scope="col">INICIO</th>
      <th scope="col">SERVICIO</th>
      <th scope="col">OPERADORES</th>
      <th scope="col">GASTOS</th>
      <th scope="col">FACTURACION</th>
      <th scope="col">SEGUIMIENTO</th>
      <th scope="col">FIN</th>
    </tr>
  </thead>

  <?/*---contenido de la tabla---*/?>


  <tbody>

  <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      <tr>
         <td >
         <a class="btn btn-dark btn-sm btn-block " href="segimientos_report.php?id=<?php echo $filas ['Id_SERG'] ?>">  
        <?php $Id_SERG = $filas ['Id_SERG'];  echo $Id_SERG  ?>
      </a>
         </td>       
        <td >
          <?php echo $filas ['S_FECHA'];?>
        </td>

        <td >
        <?php echo $filas ['PLACA'];?>
         </td>
        <td >
        <?php 
          $queryF="SELECT * FROM rd_inicio_fin WHERE Id_SERG= $Id_SERG ";
          $resultF=mysqli_query($conexion, $queryF);
          $filasF=mysqli_fetch_assoc($resultF);
          $numfilasf = mysqli_num_rows($resultF);
        if ($numfilasf>0) {
            ?>
          <a href="rd_inicio_create.php?id=<?php echo $filasF ['ID_IF'] ?>&rd=<?php echo $filas ['Id_SERG'] ?>&f=<?php echo $filas ['S_FECHA'] ?>" class="btn btn-success btn-sm btn-block "><span class="icon-checkmark "></span></a> 
          <?php
        } else {  
          ?>
          <a href="rd_inicio_create.php?rd=<?php echo $filas ['Id_SERG'];?>&f=<?php echo $filas ['S_FECHA'] ?>" class="btn btn-dark btn-sm btn-block "><span class="icon-blocked"></span></a>
          <?php  
        }
        ?>
        </td>

        <td >
        <?php 
          $queryS="SELECT Count(rd_servicio.ID_SERV) AS CuentaDeID_SERV, rd_servicio.Id_SERG
FROM rd_servicio
GROUP BY rd_servicio.Id_SERG
HAVING (((rd_servicio.Id_SERG)='$Id_SERG'));

             ";
                      
          $resultS=mysqli_query($conexion, $queryS);
          $filasS=mysqli_fetch_assoc($resultS);
          $CANTIDASERV = $filasS ['CuentaDeID_SERV'];
          $numfilasS = mysqli_num_rows($resultS);
        if ($numfilasS>0) {
            ?>
          <a href="rd_servicio_read.php?rd=<?php echo $filas ['Id_SERG'] ?>&f=<?php echo $fecha;?>" class="btn btn-success btn-sm btn-block ">
            <span class=" icon-bookmark  "></span><?php echo $CANTIDASERV ?></a> 
          <?php
        } else {  
          ?>
          <a href="rd_servicio_read.php?rd=<?php echo $filas ['Id_SERG'];?>&f=<?php echo $fecha;?>" class="btn btn-dark btn-sm btn-block "><span class="icon-blocked"></span></a>
          <?php  
        }
        ?>
        </td>

        <td >
        <?php 
          $queryO="
SELECT rd_operadores.Id_SERG, Count(rd_operadores.ID_OPERA) AS CuentaDeID_OPERA, Sum(diario.DEBE) AS TOTAL, pcge.DOSDIGITOS
FROM (rd_operadores LEFT JOIN diario ON rd_operadores.ID_OPERA = diario.ID_OPERA) INNER JOIN pcge ON diario.CTA_CONT = pcge.ID_CTA
GROUP BY rd_operadores.Id_SERG, pcge.DOSDIGITOS
HAVING (((rd_operadores.Id_SERG)='$Id_SERG') AND ((pcge.DOSDIGITOS)=14));


;

             ";
                      
          $resultO=mysqli_query($conexion, $queryO);
          $filasO=mysqli_fetch_assoc($resultO);
          $CANTIDAOPE = $filasO ['CuentaDeID_OPERA'];
          $TOTAL = $filasO ['TOTAL'];
          $numfilasO = mysqli_num_rows($resultO);
        if ($numfilasO>0) {
            ?>
          <a href="rd_operadores_read.php?rd=<?php echo $filas ['Id_SERG'] ?>&f=<?php echo $fecha;?>" class="btn btn-success btn-sm btn-block ">
            <span class=" icon-bookmark "></span><?php echo $CANTIDAOPE ?> | S/.<?php echo $TOTAL ?></a> 
          <?php
        } else {  
          ?>
          <a href="rd_operadores_read.php?rd=<?php echo $filas ['Id_SERG'];?>&f=<?php echo $fecha;?>" class="btn btn-dark btn-sm btn-block "><span class="icon-blocked"></span></a>
          <?php  
        }
        ?>
        </td>

        <td >
        <?php 
          $queryC="
SELECT rd_operadores.Id_SERG, Count(rd_operadores.ID_OPERA) AS CuentaDeID_OPERA, Sum(diario.HABER) AS TOTAL, pcge.DOSDIGITOS
FROM (rd_operadores LEFT JOIN diario ON rd_operadores.ID_OPERA = diario.ID_OPERA) INNER JOIN pcge ON diario.CTA_CONT = pcge.ID_CTA
GROUP BY rd_operadores.Id_SERG, pcge.DOSDIGITOS
HAVING (((rd_operadores.Id_SERG)='$Id_SERG') AND ((pcge.DOSDIGITOS)=14));

             ";
                      
          $resultC=mysqli_query($conexion, $queryC);
          $filasC=mysqli_fetch_assoc($resultC);
          $SOLES= $filasC ['TOTAL'];
          $numfilasC = mysqli_num_rows($resultC);
        if ($numfilasC>0) {
            ?>
          <a href="rd_operadores_gastos.php?rd=<?php echo $filas ['Id_SERG'] ?>&f=<?php echo $fecha;?>" class="btn btn-success btn-sm btn-block ">
            <span class=" icon-bookmark  "></span>
            | S/.<?php echo $SOLES ?>  
            </a> 
          <?php
        } else {  
          ?>
          <a href="rd_operadores_gastos.php?rd=<?php echo $filas ['Id_SERG'];?>&f=<?php echo $fecha;?>" class="btn btn-dark btn-sm btn-block "><span class="icon-blocked"></span></a>
          <?php  
        }
        ?>
        </td>



<?php

// Obtener los valores de los campos
$campos = array(
  
  
  "facturacion",
  "responsables"
);

// Generar los vínculos
foreach ($campos as $campo) {

  // Convertir el valor del campo a mayúsculas
  $campomayuscula = strtoupper($campo);

  // Generar el vínculo
  
  $queryv="SELECT * FROM rd_{$campo} WHERE Id_SERG= $Id_SERG ";
  $resultv=mysqli_query($conexion, $queryv);
  $filasv=mysqli_fetch_assoc($resultv);
  $numfilasv = mysqli_num_rows($resultv);

if ($numfilasv>0) {
    
$vinculo = "<td><a href='rd_{$campo}_read.php?f=$fecha&rd=" . htmlspecialchars($Id_SERG) . "' class='btn btn-success btn-sm btn-block '> 
  <span class='icon-checkmark'></span>
</a></td>";

} else {
  
 $vinculo = "<td><a href='rd_{$campo}_read.php?f=$fecha&rd=" . htmlspecialchars($Id_SERG) . "' class='btn btn-dark btn-sm btn-block '> 
  <span class='icon-blocked'></span>
</a></td>";
}

// Imprimir el vínculo
  echo $vinculo;


}

?>
        <td >
<?php 
  $queryx="SELECT * FROM rd_inicio_fin WHERE Id_SERG= $Id_SERG ";
  $resultx=mysqli_query($conexion, $queryx);
  $filasF=mysqli_fetch_assoc($resultx);
  $numfilasx = mysqli_num_rows($resultx);
$KMI = $filasF ['KM_SALIDA_BASE'];
$KMF = $filasF ['KM_LLEGADA_BASE'];
if ($KMF =='') {
  $RECORRIDO=0;
} else {
  $RECORRIDO=$KMF-$KMI;
}

if ($numfilasx>0) {
    ?>
  <a href="rd_fin_create.php?id=<?php echo $filasF ['ID_IF'] ?>&rd=<?php echo $filas ['Id_SERG'] ?>&f=<?php echo $filas ['S_FECHA'] ?>" class="btn btn-success btn-sm btn-block "> 
  <?php echo $RECORRIDO ?>Km</a> 
  <?php

} else {
  
  ?>
  <a href="rd_fin_create.php?id=<?php echo $filasF ['ID_IF'] ?>&rd=<?php echo $filas ['Id_SERG'] ?>&f=<?php echo $filas ['S_FECHA'] ?>" class="btn btn-dark btn-sm btn-block "> 
  <span class="icon-blocked"></span></a> 
  <?php  
}
?>






         </td>

</tr>
   <?php } ?>

  </tbody>
</table>




<!-- Modal -->
<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">NUEVA PRORAMACION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
<form action="crud_rd/create.php" method="POST">
<input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>
  <div class="form-group">
    <label for="S_FECHA">FECHA:</label>
    <input type="date" class="form-control" id="S_FECHA" name="S_FECHA" placeholder="FECHA" value='<?php echo $hoyfor ; ?>'>
  
  </div>
<div class="form-group">
  <label for="PLACA">PLACA : </label>
  <input class="form-control" list="PLACAS" type="text" id="PLACA" name="PLACA" required>
    <datalist id="PLACAS" >  
    <option selected ></option>
    <?php 
      $queryP="SELECT * FROM unidades ";
      $resultP=mysqli_query($conexion, $queryP);
    ?>
    <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
      
    <option value="<?php echo $filasP ['vh_placa']?>" >
    </option>
    <?php } ?>
  </datalist>
</div>

<button type="submit" id="guardar" name="guardar" class="btn btn-primary btn-lg btn-block ">REGISTRAR</button>
</form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>

      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="nuevo_pll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">NUEVA PRORAMACION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
<form action="crud_rd/create.php" method="POST">
<input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>
  <div class="form-group">
    <label for="S_FECHA">FECHA:</label>
    <input type="date" class="form-control" id="S_FECHA" name="S_FECHA" placeholder="FECHA" value='<?php echo $hoyfor ; ?>'>
  
  </div>

<button type="submit" id="guardar" name="guardar" class="btn btn-Warning btn-lg btn-block ">GENERAR</button>
</form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>

      </div>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>