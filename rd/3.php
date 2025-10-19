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




?>




<style>



</style>


<div class="card text-center">
  <div class="card-header">
    <B><h4>
    <span class="icon-truck"></span>  PROGRAMACION DE UNIDADES <?php echo $fecha ?>
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
SELECT rd_segimientos_head.S_FECHA, Count(rd_operadores.Id_SERG) AS CuentaDeId_SERG, Sum(diario.HABER) AS SumaDeHABER
FROM (rd_segimientos_head INNER JOIN rd_operadores ON rd_segimientos_head.Id_SERG = rd_operadores.Id_SERG) LEFT JOIN diario ON rd_operadores.ID_OPERA = diario.ID_OPERA
GROUP BY rd_segimientos_head.S_FECHA
HAVING (((rd_segimientos_head.S_FECHA)='$fecha'));

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

.ancho:focus {
    width: 300px; /* Ancho al pasar el cursor */
  }

</style>


<div  style="display: flex; justify-content: space-between;">
  <div class="form-container" style="text-align: right;">


<div class="container">
  <div class="row botoness">
   
    <a href="segimientos_caja.php?f=<?php echo $fecha ?>">
    <button  type="button" class="btn btn-outline-primary bt">EFECTIVO DEL DIA: S/.<?php echo $filasEF ['SumaDeHABER'] ?>      
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
    <form  action="rd_programaciones_read.php" method="POST" class="form-inline">
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
    <a style="color: white;" type="button" data-toggle="modal" data-target="#nuevod" class="btn btn-success mb-2 nv ">
      <span class="icon-plus"></span> NUEVO
    </a>
    <a style="color: white;" type="button" data-toggle="modal" data-target="#nuevo_pll" class="btn btn-warning mb-2 nv ">
      <span class="icon-plus"></span> PLANTILLA
    </a>
    </form>

    </div>

  </div>
</div>


  </div>
</div>



<div class="dropdown-divider"></div> 

<?php 
$query="
SELECT rd_segimientos_head.*, rd_segimientos_head.S_FECHA
FROM rd_segimientos_head
WHERE (((rd_segimientos_head.S_FECHA)='$fecha'))";
$result=mysqli_query($conexion, $query);

$numfilas = mysqli_num_rows($result);
/*echo $numfilas;
while($filas=mysqli_fetch_assoc($result)) {
 echo $filas ['CONDUCTOR'];
};

 ?>
<?/*---cabeseras de la tabla---*/?>

<table class="table table-sm text-center  " >
  <thead class="thead-dark ">
    <tr>
      
      <th scope="col">#</th> 
      <th scope="col">FECHA</th>
      <th scope="col">EPS</th>
      <th scope="col">VEHICULO</th>
      <th scope="col">TIPO-VH</th>      
      <th scope="col">CONDUCTOR</th>
      <th scope="col">AUXILIAR(1)</th>
      <th scope="col">AUXILIAR(2)</th>
      <th scope="col">AUXILIAR(3)</th>
      <th scope="col">CLIENTE </th>
      <th scope="col">CITA</th>
      <th scope="col">SERVICIO</th>
      <th scope="col">OBSERVACION</th>
      <th scope="col">OPCIONES </th>
    </tr>
  </thead>

  <?/*---contenido de la tabla---*/?>

  <tbody>

  <?php while($filas=mysqli_fetch_assoc($result)) { ?>

<form action="crud_programacion/update.php" method="POST">
       
      <tr>

<input type="hidden"  class="form-control" id="Id_SERG " name="Id_SERG" value="<?php echo $filas ['Id_SERG'] ?>" >




         <td >
         <a class="btn btn-dark btn-sm btn-block " href="segimientos_report.php?id=<?php echo $filas ['Id_SERG'] ?>">  
        <?php $Id_SERG = $filas ['Id_SERG'];  echo $Id_SERG  ?>
      </a>
         </td> 

        <td >
          <input type="date" id="S_FECHA" name="S_FECHA"  value='<?php echo $filas ['S_FECHA'];?>'>           
        </td>

        <td >
    <select class="custom-select ancho" id="EPS" name="EPS" >
    <option selected value="<?php echo $filas ['EPS']  ?>"> <?php echo $filas ['EPS']  ?></option>
    <option value="JSA LLANOS" > JSA LLANOS </option>
    <option value="JS GREGORI" > JS GREGORI </option>         
    </select>           
        </td>

        <td >
          <input class="form-control" list="PLACAS" type="text" id="PLACA" name="PLACA" value='<?php echo $filas ['PLACA'];?>' required>
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

        </td>

<td>

       <input class="form-control ancho" list="temp" type="text" id="TEMPERATURA" name="TEMPERATURA" value='<?php echo $filas ['TEMPERATURA'];?>' >

          <datalist id="temp" >  
            <option selected ></option>
            <?php 
              $querya="SELECT * FROM  habilidad ";
              $resulta=mysqli_query($conexion, $querya);

             ?>
              <?php while($filash=mysqli_fetch_assoc($resulta)) { ?>
                
              <option value="<?php echo $filash ['nom_habilidad']?>" >
                <?php echo $filash ['nom_habilidad']  ?>  
              </option>
              <?php } ?>
          </datalist>

</td>


        <td style="text-align:left;">
          
          <input class="form-control ancho" list="NOMBRES" type="text" id="CONDUCTOR" name="CONDUCTOR" value='<?php echo $filas ['CONDUCTOR'];?>' required >
          <datalist id="NOMBRES" >  
          <option selected ></option>
              <?php               

                $queryP="SELECT user_nombre, user_disponible FROM usuarios WHERE user_disponible ='si' ";
                $resultP=mysqli_query($conexion, $queryP);
              ?>
              <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
                
          <option value="<?php echo $filasP ['user_nombre']?>" >
          </option>
          <?php } ?>
          </datalist>

        </td>
      <td style="text-align:left;">
        
          <input class="form-control ancho" list="AUX1" type="text" id="AUXILIAR1" name="AUXILIAR1" value='<?php echo $filas ['AUXILIAR1'];?>' >
          <datalist id="AUX1" >  
          <option selected ></option>
              <?php 
                $queryP="SELECT user_nombre, user_disponible FROM usuarios WHERE user_disponible ='si'";
                $resultP=mysqli_query($conexion, $queryP);
              ?>
              <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
                
          <option value="<?php echo $filasP ['user_nombre']?>" >
          </option>
          <?php } ?>
          </datalist>        

      </td>
      <td style="text-align:left;">

          <input class="form-control ancho" list="AUX2" type="text" id="AUXILIAR2" name="AUXILIAR2" value='<?php echo $filas ['AUXILIAR2'];?>' >
          <datalist id="AUX2" >  
          <option selected ></option>
              <?php 
                $queryP="SELECT user_nombre, user_disponible FROM usuarios WHERE user_disponible ='si'";
                $resultP=mysqli_query($conexion, $queryP);
              ?>
              <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
                
          <option value="<?php echo $filasP ['user_nombre']?>" >
          </option>
          <?php } ?>
          </datalist>         

      </td>
      <td style="text-align:left;">
       
          <input class="form-control ancho" list="AUX3" type="text" id="AUXILIAR3" name="AUXILIAR3" value='<?php echo $filas ['AUXILIAR3'];?>' >
          <datalist id="AUX3" >  
          <option selected ></option>
              <?php 
                $queryP="SELECT user_nombre, user_disponible FROM usuarios WHERE user_disponible ='si' ";
                $resultP=mysqli_query($conexion, $queryP);
              ?>
              <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
                
          <option value="<?php echo $filasP ['user_nombre']?>" >
          </option>
          <?php } ?>
          </datalist>         

      </td>
      <td>
        
      <input value="<?php echo $filas ['ID_CLIENTE']; ?>" class="form-control ancho" list="CLIENTES" type="text" id="ID_CLIENTE" name="ID_CLIENTE" required>
        <datalist id="CLIENTES" >  
        <option selected ></option>
        <?php 
          $queryP="SELECT * FROM clientes ";
          $resultP=mysqli_query($conexion, $queryP);
        ?>
        <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
          
        <option value="<?php echo $filasP ['cte_nombrecomercial']?>" >
        </option>
        <?php } ?>
      </datalist>        

      </td>
      <td>
        <input type="times" class="form-control ancho" id="H_CITA" name="H_CITA" value="<?php echo $filas ['H_CITA']  ?>" required>
        
      </td>      
      <td>
       <input type="text" class="form-control ancho" id="SERVICIOS" name="SERVICIOS" value="<?php echo $filas ['SERVICIOS']  ?>" required>   
      </td>
      <td>
        <input type="text" class="form-control ancho" id="OBS_PROG" name="OBS_PROG" value="<?php echo $filas ['OBS_PROG']  ?>" >
       

      </td>
   
<input type="hidden"  class="form-control" id="S_USER" name="S_USER" value="<?php echo $id_userup ?>" >

     
<input type="hidden"  class="form-control" id="REGISTER" name="REGISTER" value="<?php echo $fehra ?>" >



<td>
    <a onclick="return confirmLink()" href="crud_programacion/delete.php?id=<?php echo $filas['Id_SERG']?>&f=<?php echo $fecha ?>" class="btn btn-danger btn-sm" style="display: inline-block;"> 
        <span class="icon-bin"></span>
    </a>
 
    <button type="submit" id="guardar" name="guardar" class="btn btn-primary btn-sm "><span class=" icon-floppy-disk "></span></button>
</td>


</tr>
</form> 

   <?php } ?>

  </tbody>
</table>




<!-- Modal -->
<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">NUEVA PROGRAMACIONES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
<form action="crud_programacion/create.php" method="POST">
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
<div class="modal fade" id="nuevod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">NUEVA PROGRAMACION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
<form action="crud_programacion/create.php" method="POST">
<input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>
  <div class="form-group">
    <label for="S_FECHA">FECHA:</label>
    <input type="date" class="form-control" id="S_FECHA" name="S_FECHA" placeholder="FECHA" value='<?php echo $hoy ; ?>'>
  
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


<button type="submit" id="guardar" name="guardar" class="btn btn-primary btn-lg btn-block ">REGISTRAR NUEVO</button>
<br>
<button type="submit" id="guardarp" name="guardarp" class="btn btn-primary btn-lg btn-block ">REGISTRAR PLANTILLA</button>
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
        <h5 class="modal-title" id="exampleModalLabel">GENERAR PROGRAMACIONES </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
<form action="crud_programacion/create_pll.php" method="POST">
<input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>
  <div class="form-group">
    <label for="S_FECHA">FECHA:</label>
    <input type="date" class="form-control" id="S_FECHA" name="S_FECHA" placeholder="FECHA" value='<?php echo $hoyfor ; ?>'>
  
  </div>

<button type="submit" id="guardar" name="guardar" class="btn btn-warning btn-lg btn-block ">GENERAR</button>
</form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>

      </div>
    </div>
  </div>
</div>

<br><br><br><br>
<h6 style="text-align:left;">OPERADORES:</h6>
<div  style="display: flex; justify-content: space-between;">
  <div class="form-container" style="text-align: right;">

<div id="user">
  <!-- Contenido de la sección específica -->
</div>

<div class="container">
  <div class="row botoness">
    <button  type="button" class="btn btn-outline-primary btn-block bt">DISPONIBLES:       
    </button>  
    
  </div>
</div>


  </div>

  <div class="form-container text-right" style="text-align: left;">
    <div class="container">
  <div class="row botoness">
    <div>    
    <a style="color: white;" type="button" data-toggle="modal" data-target="#nuser" class="btn btn-success mb-2 nv ">
      <span class="icon-plus"></span> NUEVO
    </a>
    </div>

  </div>
</div>
  </div>
</div>
<div class="dropdown-divider"></div>
<br>

<div style="text-align:left; ">
  <?php 
  $queryOP="
  SELECT user_nombre , user_disponible, user_cargo
FROM usuarios
WHERE (((usuarios.user_disponible)='si') )
ORDER BY usuarios.user_nombre;";
  $resultOP=mysqli_query($conexion, $queryOP);

  ?>
  <?php while($filasOP=mysqli_fetch_assoc($resultOP)) { ?>
     <a style="margin: 3px;" href="" class="btn btn-primary btn-sm" style="display: inline-block;"> 
        <span class="icon-user"> </span> <?php echo $filasOP ['user_nombre']?>
      </a>

  <?php } ?>

</div>
<br>
<div  style="display: flex; justify-content: space-between;">
  <div class="form-container" style="text-align: right;">


<div class="container">
  <div class="row botoness">
    <button  type="button" class="btn btn-outline-secondary btn-block bt">NO DISPONIBLES:       
    </button>  
    
  </div>
</div>


  </div>

  <div class="form-container text-right" style="text-align: left;">
    <div class="container">
  <div class="row botoness">
    <div>    
    <a style="color: white;" type="button" data-toggle="modal" data-target="#liberar" class="btn btn-secondary mb-2 nv ">
      <span class="icon-user"></span> LIBERAR
    </a>
    </div>

  </div>
</div>
  </div>
</div>

<div class="dropdown-divider"></div>
<br>

<div style="text-align:left; ">
  <?php 
  $queryOP="
  SELECT user_nombre , user_disponible, user_cargo
FROM usuarios
WHERE (((usuarios.user_disponible)='no'))
ORDER BY usuarios.user_nombre;";
  $resultOP=mysqli_query($conexion, $queryOP);

  ?>
  <?php while($filasOP=mysqli_fetch_assoc($resultOP)) { ?>
     <a style="margin: 3px;" href="" class="btn btn-secondary btn-sm" style="display: inline-block;"> 
        <span class="icon-user"> </span> <?php echo $filasOP ['user_nombre']?>
      </a>

  <?php } ?>
</div>


<!-- Modal -->
<div class="modal fade" id="nuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">NUEVO USUARIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<form  action="crud_user/create.php" method="POST" class="colm">
  <input class="form-control"  type="hidden" id="FECHA" name="FECHA" value="<?php echo $fecha ; ?> " >
  
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

    
  <button type="submit" class="btn btn-primary btn-block" id="guardar" name="guardar">CREAR USUARIO</button>
</form>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>

      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="liberar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">LIBERAR USUARIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<form  action="crud_user/liberar.php" method="POST" class="colm">
<input class="form-control"  type="hidden" id="FECHA" name="FECHA" value="<?php echo $fecha ; ?> " >

<div class="form-group">
  <label for="USER">OPERADOR: </label>
  <select class="custom-select" id="USER" name="USER" required>
    <option selected></option>
    <?php 
      $query="SELECT usuarios.id_user, usuarios.user_nombre, usuarios.user_ordenes
FROM usuarios
WHERE (((usuarios.user_disponible)='no') AND ((usuarios.user_perfil)=2))
ORDER BY usuarios.user_nombre
";

      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['id_user']?>" >
     ▪&nbsp <?php echo $filas ['user_nombre']  ?>  
     
    </option>
    <?php } ?>
  </select>
</div>

    <br>
  <button type="submit" class="btn btn-primary btn-block" id="guardar" name="guardar">LIBERAR USUARIO</button>
</form>         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>

      </div>
    </div>
  </div>
</div>


<script >
function confirmLink() {
  // Obtenga la confirmación del usuario.
  var confirmation = confirm(' ⚠ ¿Seguro que desea ELIMINAR el registro?');


  // Si el usuario confirma, devuelva `true` para permitir que el enlace se siga.
  // De lo contrario, devuelva `false` para evitar que el enlace se siga.
  return confirmation;
}
</script>

<?php include('includes/footer.php'); ?>



