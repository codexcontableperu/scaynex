<?php include("../data/conexion.php"); ?>
<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="whatsaap/stilo_what.css">
<?php include('whatsaap1.php'); ?>

<style>
    .container{
        margin-top: 6px;
          
        margin-bottom: 10px;  

    }


.info {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0;
}

.step {
    text-align: center;
    margin: 0 1px; /* Reducir el espacio entre los pasos */
    transition: opacity 0.3s ease-in-out;

}

a {
    text-decoration: none; /* Eliminar el subrayado, si también deseas quitarlo */
    color: black;
}

img:hover  {
    opacity: 0.7;
    border: 2px solid #008169; /* Cambiar el borde a verde al pasar el cursor */
}

img {
    width: 80px; /* Ajusta el tamaño de los iconos según sea necesario */
    border-radius: 50%;

}

.image-container:hover img {
    transform: scale(1.1); /* Cambia la escala al 110% al pasar el cursor */
}

p {
    font-size: 13px; /* Ajusta el tamaño de la letra según sea necesario */
}


.table td, .table th {
  padding: .15rem;
  vertical-align:  baseline;

}

        table {
            font-size: 13px; /* Cambia el tamaño de fuente para toda la tabla */
            width: 100%; /* Define el ancho de la tabla al 100% del contenedor */
             height: 300%;
        }

        /* Define el tamaño de fuente específico para las celdas de datos */
        .tdx {
            font-size:10px; /* Cambia el tamaño de fuente para las celdas de datos */

        }
    /* Estilo personalizado para el botón */
    .custom-btn {
      margin: 20px auto; /* Centrar el botón */
      border: 0px solid white; /* Borde gris claro */
      border-radius: 5px; /* Bordes redondeados */
      padding: 10px 20px; /* Espaciado interno */
    }

    .botones {
      margin: 20px auto; /* Centrar el botón */
      border: 1px solid white; /* Borde gris claro */
      border-radius: 5px; /* Bordes redondeados */
      padding: 1px 30px; /* Espaciado interno */
    }


    .square-btn {
  width: 100px; /* Adjust size as needed */
  height: 90px; /* Adjust size as needed */
  margin: 0 3px; /* Add margin between buttons */
}

</style>

    </div>
<?php

$ID = $_GET['id'];

$queryo="
SELECT rd_segimientos_head.*, rd_segimientos_head.Id_SERG
FROM rd_segimientos_head
WHERE (((rd_segimientos_head.Id_SERG)=$ID));

";
$resulto=mysqli_query($conexion, $queryo);
$filaso=mysqli_fetch_assoc($resulto);

$queryS="
SELECT rd_servicio.*, rd_servicio.Id_SERG
FROM rd_servicio
WHERE (((rd_servicio.Id_SERG)=$ID))";
$resultS=mysqli_query($conexion, $queryS);
$filasS=mysqli_fetch_assoc($resultS);

?>
UNIDAD PROGRAMADA
<div> <span class="icon-truck">&nbsp<?php echo $filaso ['S_FECHA']?> </span> 
  <div class="card ">
</div>    
      <h5 class="card-title">
<!-- Button trigger modal -->

      </h5>

      <table class="table table-sm table-striped table5">
  <tbody>
    <tr>
      <th >EPS</th>
      <td class="tdx"><?php echo $filaso ['EPS']?></td>
      <th >PLACA</th>
      <td><?php echo $filaso ['PLACA']?></td>

    </tr>
    <tr>
      <th >TEMPERATURA</th>
      <td class="tdx"><?php echo $filaso ['TEMPERATURA']?></td>
      <th >SERVICIO</th>
      <td class="tdx"><?php echo $filaso ['SERVICIOS']?></td>

    </tr>
      <tr>
      <th >CONDUCTOR</th>
      <td class="tdx"><?php echo $filaso ['CONDUCTOR']?></td>
      <th >CLIENTE</th>
      <td class="tdx"><?php echo $filaso ['ID_CLIENTE']?></td>

    </tr>
    <tr>
      <th >AUXILIAR 1</th>
      <td class="tdx"><?php echo $filaso ['AUXILIAR1']?></td>
      <th >HORA DE CITA</th>
      <td class="tdx"><?php echo $filaso ['H_CITA']?></td>
    </tr>
    <tr>
      <th >AUXILIAR 2</th>
      <td class="tdx"><?php echo $filaso ['AUXILIAR2']?></td>
      <th >OBSERVACION</th>
      <td class="tdx"><?php echo $filaso ['OBS_PROG']?></td>
    </tr>

    <tr>
      <th>AUXILIAR 3</th>
      <td class="tdx"><?php echo $filaso ['AUXILIAR3']?> </td>
    </tr>

    

  </tbody>
</table>
</div>

<div class="botones">
<div class="container text-center">
  <div class="row">
    <div class="col">
      <button class="btn btn-lg btn-success square-btn">Green Button</button>
      <button class="btn btn-lg btn-outline-success square-btn">+</button>
    </div>
  </div>
</div>
</div>






  <div class="botones">
  
  <a href="" data-toggle="modal" data-target="#iniciar" class="btn btn-success btn-block custom-btn" > <span  class="icon-road"> </span></span>NUEVO SERVICIO</a>

  </div>


<?php
     $query2="
SELECT hruta.estado_hr, hruta.id_ruta, hruta.id_prog, hruta.fechahr, hruta.ruta_glosa
FROM hruta
WHERE id_prog=$ID 
                ";
     $result2=mysqli_query($conexion, $query2);
     
?>


<br>
<div class="container">
  <div class="row">

    <div class="col-sm">

        <table class="table table-bordered table-sm  text-center " >

          <?/*---contenido de la tabla---*/?>

          <tbody>

            <?php while($filas2=mysqli_fetch_assoc($result2)) { ?>
                <tr>
                  <td class="">
                   <span class="icon-truck"></span>
                    RUTA: 00<?php echo $filas2 ['id_ruta'];?> 

                    <?php 
                    if ($filas2 ['estado_hr']==0) {
                       $ESTAD="  Abierto  "; 
                        ?> <br> <a href="ruta_close.php?idp=<?php echo $filas2 ['id_prog']?>&idr=<?php echo $filas2 ['id_ruta']?>" class=" btn-success"> &nbsp <?php echo $ESTAD;?> &nbsp </a><?php
                    } else {
                       $ESTAD="  Cerrado  ";
                        ?><br> <a href="ruta_close.php?idp=<?php echo $filas2 ['id_prog']?>&idr=<?php echo $filas2 ['id_ruta']?>" class=" btn-danger ">  &nbsp <?php echo $ESTAD;?> &nbsp </a><?php
                    
                    }?>
                    
                    &nbsp <a href="crud_ruta/delete.php?idp=<?php echo $filas2 ['id_prog']?>&idr=<?php echo $filas2 ['id_ruta']?>" class=" btn-danger" type="button"> <span class="icon-bin "> </span></a>

                   <br>

                  </td> 

                  <td class="">
                    
                     <?php echo $filas2 ['ruta_glosa'];?>
                  </td>      
                  
                 <td>
                    <div class="container text-center ">
                        <a data-toggle="modal" data-target="#HRUTA"   type="button" class="btn btn-primary " ><span class="icon-folder-plus"></span> </a> 
                    </div>
                 </td>
                 
                </tr>
             <?php } ?>

          </tbody>
        </table>

    </div>
  </div>
</div>






<!-- SECCION DEL PROCESO -->
<?php 
$query="SELECT hruta.id_ruta, hruta.ruta_glosa, hruta.h_inicio, hruta.id_prog
FROM hruta
WHERE (((hruta.id_prog)=$ID ))";
$result=mysqli_query($conexion, $query);
$numfilas = mysqli_num_rows($result);

if ($numfilas>0) {
     ?>


      <table class="table table-sm table-striped table-success">
  <tbody>
    <tr>
      <th >EPS</th>
      <td class="tdx"><?php echo $filasS ['EPS']?></td>
      <th >PLACA</th>
      <td><?php echo $filasS ['PLACA']?></td>

    </tr>
    <tr>
      <th >TEMPERATURA</th>
      <td class="tdx"><?php echo $filasS ['TEMPERATURA']?></td>
      <th >SERVICIO</th>
      <td class="tdx"><?php echo $filasS ['SERVICIOS']?></td>

    </tr>
      <tr>
      <th >CONDUCTOR</th>
      <td class="tdx"><?php echo $filasS ['CONDUCTOR']?></td>
      <th >CLIENTE</th>
      <td class="tdx"><?php echo $filasS['ID_CLIENTE']?></td>

    </tr>
    <tr>
      <th >AUXILIAR 1</th>
      <td class="tdx"><?php echo $filasS ['AUXILIAR1']?></td>
      <th >HORA DE CITA</th>
      <td class="tdx"><?php echo $filasS ['H_CITA']?></td>
    </tr>
    <tr>
      <th >AUXILIAR 2</th>
      <td class="tdx"><?php echo $filasS ['AUXILIAR2']?></td>
      <th >OBSERVACION</th>
      <td class="tdx"><?php echo $filasS ['OBS_PROG']?></td>
    </tr>

    <tr>
      <th>AUXILIAR 3</th>
      <td class="tdx"><?php echo $filasS ['AUXILIAR3']?> </td>
    </tr>

    

  </tbody>
</table>







<?php include('wt_ruta_inicio.php'); ?>

<?php
} else {
     ?>
  <div class="botones">
  
  <a href="" data-toggle="modal" data-target="#iniciar"class="btn btn-success btn-block custom-btn" > <span  class="icon-road"> </span></span>INICIAR</a>

  </div>

<?php
}


?>
<!-- SECCION DEL PROCESO -->
  <div class="botones">
  
  <a href="" data-toggle="modal" class="btn btn-primary btn-block custom-btn" data-target="#iniciar"> <span  class="icon-icon-file-text2 "> </span></span>VER REPORTE</a>

<a href="" data-toggle="modal" class="btn btn-success btn-block custom-btn" data-target="#iniciar"> <span  class="icon-whatsapp"> </span></span>ENVIAR</a>
<a href="" data-toggle="modal" class="btn btn-secondary btn-block custom-btn" data-target="#iniciar"> <span  class=" icon-folder-open "> </span></span>CERRAR</a>
  </div>


<!-- Modal -->
<div class="modal fade" id="iniciar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">APERTURA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
<form action="crud_ruta/create.php" method="POST">
<input class="form-control"  type="hidden" id="id_user" name="id_user" value="1" readonly>
<input class="form-control"  type="hidden" id="Id_SERG" name="Id_SERG" value="<?php echo $ID ?>" readonly >
  <div class="form-group">
    <label for="H_BASE">HORA LLEGADA A BASE</label>
    <input type="time" class="form-control" id="H_BASE" name="H_BASE" placeholder="00:00" >
  
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
<div class="modal fade" id="HRUTA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">HOJA DE RUTA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

<?php include('wt_ruta_inicio.php'); ?>
<!-- SECCION DEL PROCESO -->
  <div class="botones">
  
  <a href="" data-toggle="modal" class="btn btn-primary btn-block custom-btn" data-target="#iniciar"> <span  class="icon-icon-file-text2 "> </span></span>VER REPORTE</a>

<a href="" data-toggle="modal" class="btn btn-success btn-block custom-btn" data-target="#iniciar"> <span  class="icon-whatsapp"> </span></span>ENVIAR</a>
<a href="" data-toggle="modal" class="btn btn-secondary btn-block custom-btn" data-target="#iniciar"> <span  class=" icon-folder-open "> </span></span>CERRAR</a>
  </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>

      </div>
    </div>
  </div>
</div>


<?php include('includes/footer.php'); ?>