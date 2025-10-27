<?php session_start(); 

if (isset($_SESSION['usuario'])) {
      $userup=$_SESSION['usuario'];
      $id_userup=$_SESSION['id_usuario'];
      $dni_user=$_SESSION['user_dni'];
} else {
  session_destroy();
  mysqli_close($conexion);
  echo'<script type="text/javascript">
    window.location.href="./index.php";
    </script>';

}
?>

<?php include("../data/conexion.php"); ?>

<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="whatsaap/stilo_what.css">





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
            border-collapse: separate;
            border-spacing: 0 5px;


        }

                .tdx th {
            background-color: #008169;
            color: white;
            text-align: center;
            box-shadow: none;
        }


                .tdx td {
            border: none;
            background-color: #fff;
        }

    /* Estilo personalizado para el botón */

    .custom-btn {

      margin: 5px auto; /* Centrar el botón */

      border: 0px solid white; /* Borde gris claro */

      border-radius: 5px; /* Bordes redondeados */

      padding: 10px 20px; /* Espaciado interno */

    }



    .botones {

      margin: 20px auto; /* Centrar el botón */

      border: 1px solid white; /* Borde gris claro */

      border-radius: 5px; /* Bordes redondeados */

      padding: 1px 30px; /* Espaciado interno */

      align-items: center; /* Alinea verticalmente */

    }





    .square-btn {

margin: 5px;
  align-items: center; /* Alinea verticalmente */

}

   .ancho {

    width: 200px; /* Ancho al pasar el cursor */

    padding: .10rem;

    align-items: center; /* Alinea verticalmente */

  }
  .whatsapp-button {
position: fixed;
        width: 100%;
   color: white;
    overflow-y: auto;
    z-index: 1000;

}
</style>

 <div class="whatsapp-button">
    <div id="header">
        <div id="whatsapp-text">
            <span class="icon-user"></span>  <?php  echo $userup ; ?>
        </div>
        <div id="header-icons">
            <img src="whatsaap/camera-icon.png" alt="Cámara" id="camera-icon">
            <img src="whatsaap/search-icon.png" alt="Buscar" id="search-icon">
            <img src="whatsaap/menu-icon.png" alt="Menú" id="menu-icon">
        </div>
    </div>

    <div id="second-header">
        <img src="whatsaap/user-icon.png" alt="Usuario" id="user-icon">
        <a class="boton bton " href="wt_prog_user.php?dni=<?php  echo $dni_user ; ?> ">Ordenes</a>
        &nbsp &nbsp 
        <a class="boton bton selec" href=""> <i class="fas fa-map-marker-alt"></i> BASE</a>
        &nbsp &nbsp 
    </div>
</div>




<br><br><br><br>


<?php

$idp = $_GET['idp'];
$queryo="
SELECT *
FROM rd_segimientos_head
WHERE Id_SERG=$idp;
";
$resulto=mysqli_query($conexion, $queryo);
$filaso=mysqli_fetch_assoc($resulto);

?>

<br>
<div >
  <div  style=" font-size: 15px;">
  <B><span class="icon-libreoffice"></span> PROGRAMACION </B> <br>  
  </div>
</div>
  <div class="card ">
</div>    
      <h6 class="card-title">
<span class="icon-database"></span> OTR - <?php echo $filaso ['S_FECHA']?> 

      </h6>
      <table class="tdx table-bordered" >
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
      <th >DESPACHO</th>
      <td class="tdx"><?php echo $filaso ['TIPO_DESPACHO']?></td>
    </tr>

    <tr>
      <th >AUXILIAR 3</th>
      <td class="tdx"><?php echo $filaso ['AUXILIAR3']?> </td>
      <th >OBSERVACION</th>
      <td class="tdx"><?php echo $filaso ['OBS_PROG']?></td>      
    </tr>

  </tbody>

</table>

</div>
<br>



<?php

$queryIF="
SELECT *
FROM rd_inicio_fin
WHERE Id_SERG=$idp";
$resultIF=mysqli_query($conexion, $queryIF);
$numfilasIF = mysqli_num_rows($resultIF);
?>
<?php

if ($numfilasIF>0) {
  include('wt_ruta_inicio.php'); 

  include('wt_nvo_servicio.php');

} else {
  include('wt_btn_inicio.php');

}

?>




<?php
// Realiza la consulta
$queryIF = "
SELECT *
FROM rd_inicio_fin
WHERE Id_SERG = $idp;
";
$resultIF = mysqli_query($conexion, $queryIF);

// Verifica si la consulta devolvió al menos una fila
if ($resultIF && mysqli_num_rows($resultIF) > 0) {
    // Si se encontró una fila, obtenemos los datos
    $filasIF = mysqli_fetch_assoc($resultIF);
    $HFINAL = $filasIF['H_FINAL_SERV'];

    // Verificamos si H_FINAL_SERV es null
    if (is_null($HFINAL)) {
        include('wt_btn_fin.php');
    } else {
        include('wt_ruta_fin.php');
    }
} else {

}
?>





<div class="dropdown-divider"></div>

<?php
$querySe="
SELECT rd_servicio.CUENTA, rd_servicio.CLIENTE, rd_servicio.CTE_TERCERO, rd_servicio.ID_SERV, rd_servicio.Id_SERG, Sum(guias_remitente.gr_bultos) AS TBULTOS
FROM guias_remitente INNER JOIN rd_servicio ON guias_remitente.id_ruta = rd_servicio.ID_SERV
GROUP BY rd_servicio.CUENTA, rd_servicio.CLIENTE, rd_servicio.CTE_TERCERO, rd_servicio.ID_SERV, rd_servicio.Id_SERG
HAVING (((rd_servicio.Id_SERG)=$idp));
";
$resultSe = mysqli_query($conexion, $querySe);
$numRowsSe = mysqli_num_rows($resultSe); // Verificar el número de filas
?>

<style>
  .rut th td {
    font-size: 10px;
  }
</style>

<?php if ($numRowsSe > 0) { // Solo muestra la tabla si hay filas ?>
<div class="rut container mt-5">
  <h5><span class="icon-libreoffice"></span> Hojas de Rutas Generadas:</h5>
  <table class="table table-dark table-bordered table-sm">
    <thead class="thead-dark text-center">
      <tr>
        <th>ORDEN</th>
        <th>SERVICIO</th>
        <th>BULTOS</th>
        <th><span class="icon-printer"></span></th>
        <th><span class="icon-images"></span></th>
      </tr>
    </thead>
    <tbody>
      <!-- Ejemplo de fila de la tabla -->
      <?php while ($filasSe = mysqli_fetch_assoc($resultSe)) { ?>
        <?php 
          $idp = $filasSe['Id_SERG'];
          $idr = $filasSe['ID_SERV'];
        ?>
        <tr>
          <td>0<?php echo $idp ?> - <?php echo $idr ?></td>
          <td><?php echo $filasSe['CLIENTE'] ?> / <?php echo $filasSe['CUENTA'] ?></td>
          <td style="text-align:center;"><?php echo $filasSe['TBULTOS'] ?> BLT</td>
          <td class="text-center">
            <a href="hr_tiketgen.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>" class="btn btn-danger btn-sm"><span class="icon-ticket"></span></a>
          </td>
          <td class="text-center">
            <a href="wt_images.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>" class="btn btn-success btn-sm"><span class="icon-image"></span></a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<?php } ?>



<div class="dropdown-divider"></div>



<?php
$queryGT = "
SELECT guias_transp.*, rd_servicio.Id_SERG, rd_servicio.ID_SERV, rd_servicio.EPS, rd_servicio.PLACA, rd_servicio.CUENTA, rd_servicio.CLIENTE
FROM guias_transp 
INNER JOIN rd_servicio ON guias_transp.gt_servicio = rd_servicio.ID_SERV
WHERE rd_servicio.Id_SERG=$idp;
";
$resultGT = mysqli_query($conexion, $queryGT);

// Verificar si hay resultados antes de mostrar la tabla
if (mysqli_num_rows($resultGT) > 0) {
?>

<style>
  .rut th, .rut td {
    font-size: 10px;
  }
</style>

<div class="rut container mt-5">
  <h5><span class="icon-libreoffice"></span> Guias de Transporte Generadas:</h5>
  <table class="table table-dark table-bordered table-sm">
    <thead class="thead-dark text-center">
      <tr>
        <th>FECHA</th>
        <th>EPS</th>
        <th>PLACA</th>
        <th>SERVICIO</th>                 
        <th><span class="icon-files-empty"></span></th>
      </tr>
    </thead>
    <tbody>
      <?php while($filasGT = mysqli_fetch_assoc($resultGT)) { ?>
      <tr>
        <td><?php echo $filasGT['fechagen'] ?></td>
        <td><?php echo $filasGT['EPS'] ?></td>    
        <td style="text-align:center;"><?php echo $filasGT['PLACA'] ?></td>
        <td><?php echo $filasGT['CUENTA'] ?> / <?php echo $filasGT['CLIENTE'] ?></td>       
        <td style="text-align:center;">
          <a href="hr_hofarm.php?idp=<?php echo $idp ?>&idr=<?php echo $filasGT['ID_SERV'] ?>" class="btn btn-primary btn-sm">
            <span class="icon-files-empty"></span>
          </a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php
} 
?>



















<!-- Modal nuevo servicio + nueva ruta-->

<div class="modal fade" id="HRUTA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<?php        

$queryo="
SELECT *
FROM rd_segimientos_head
WHERE Id_SERG=$idp;
";

$resulto=mysqli_query($conexion, $queryo);
$filaso=mysqli_fetch_assoc($resulto);
?>

      <table class="table table-sm ">
  <form action="crud_servicio/create_serv.php" method="POST">
  <tbody>    
<input type="hidden"  class="form-control" id="FECHA_SERV" name="FECHA_SERV" value="<?php echo $filaso ['S_FECHA']  ?>" >
<input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="<?php echo $idp ?>" >
<input type="hidden"  class="form-control" id="user_serv" name="user_serv" value="<?php echo $id_userup ?>" >
    <tr>
      <th >EPS</th>
      <td >
    <select class="ancho"   id="EPS" name="EPS" >
    <option selected value="<?php echo $filaso ['EPS']  ?>"> <?php echo $filaso ['EPS']  ?></option>
    <option value="JSA LLANOS" > JSA LLANOS </option>
    <option value="JS GREGORI" > JS GREGORI </option>     
    </select>         
      </td>

</tr>
 <tr>

      <th >PLACA</th>
      <td>
 <input class="ancho"  list="PLACAS" type="text" id="PLACA" name="PLACA" value='<?php echo $filaso ['PLACA'];?>' placeholder="Placa " required>

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
 </tr>
 <tr> 
      <th >TEMPERATURA</th>
      <td >
          <select class="ancho"  type="text" id="TEMPERATURA" name="TEMPERATURA">  
            <option ></option>
            <option selected value='<?php echo $filaso ['TEMPERATURA'];?>'><?php echo $filaso ['TEMPERATURA'];?></option>

            <?php 
              $querya="SELECT * FROM  habilidad ";
              $resulta=mysqli_query($conexion, $querya);
             ?>

              <?php while($filash=mysqli_fetch_assoc($resulta)) { ?>
              <option value="<?php echo $filash ['nom_habilidad']?>" >
                <?php echo $filash ['nom_habilidad']  ?>  
              </option>
              <?php } ?>
          </select>         

      </td>
      </tr>
 <tr>
      <th >CONDUCTOR</th>
      <td >
          <select type="text" id="CONDUCTOR" name="CONDUCTOR" class="ancho">
          <option selected value='<?php echo $filaso ['CONDUCTOR'];?>'>
            <?php echo $filaso ['CONDUCTOR'];?>
          </option>
          <option></option>

              <?php            



                $queryP="SELECT id_user, user_nombre, user_disponible FROM usuarios WHERE user_disponible ='si' ORDER BY usuarios.user_nombre ";

                $resultP=mysqli_query($conexion, $queryP);

              ?>

          <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>

                

          <option value="<?php echo $filasP ['user_nombre']?>" >

            <?php echo $filasP ['user_nombre']?>

          </option>

          <?php } ?>

          </select>



      </td>

</tr>



 <tr>

      <th >AUXILIAR 1</th>

      <td >

          <select  type="text" id="AUXILIAR1" name="AUXILIAR1" class="ancho">

          <option selected value='<?php echo $filaso ['AUXILIAR1'];?>'>

            <?php echo $filaso ['AUXILIAR1'];?>



          </option>

          <option></option>

              <?php            



                $queryP="SELECT id_user, user_nombre, user_disponible FROM usuarios WHERE user_disponible ='si' ORDER BY usuarios.user_nombre; ";

                $resultP=mysqli_query($conexion, $queryP);

              ?>

          <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>

                

          <option value="<?php echo $filasP ['user_nombre']?>" >

            <?php echo $filasP ['user_nombre']?>

          </option>

          <?php } ?>

          </select> 

      </td>

</tr>



 <tr>

      <th >AUXILIAR 2</th>

      <td >

          <select  type="text" id="AUXILIAR2" name="AUXILIAR2" class="ancho">

          <option selected value='<?php echo $filaso ['AUXILIAR2'];?>'>

            <?php echo $filaso ['AUXILIAR2'];?>



          </option>

          <option></option>

              <?php            



                $queryP="SELECT id_user, user_nombre, user_disponible FROM usuarios WHERE user_disponible ='si' ORDER BY usuarios.user_nombre  ";

                $resultP=mysqli_query($conexion, $queryP);

              ?>

          <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>

                

          <option value="<?php echo $filasP ['user_nombre']?>" >

            <?php echo $filasP ['user_nombre']?>

          </option>

          <?php } ?>

          </select>   

      </td>

</tr>



 <tr>

      <th>AUXILIAR 3</th>

      <td >

            <select   type="text" id="AUXILIAR3" name="AUXILIAR3" class="ancho">

          <option selected value='<?php echo $filaso ['AUXILIAR3'];?>'>

            <?php echo $filaso ['AUXILIAR3'];?>



          </option>

          <option></option>

              <?php            



                $queryP="SELECT id_user, user_nombre, user_disponible FROM usuarios WHERE user_disponible ='si' ORDER BY usuarios.user_nombre  ";

                $resultP=mysqli_query($conexion, $queryP);

              ?>

          <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>

                

          <option value="<?php echo $filasP ['user_nombre']?>" >

            <?php echo $filasP ['user_nombre']?>

          </option>

          <?php } ?>

          </select> 

      </td>

</tr>

 <tr>

      <th >SUPERVISOR</th>

      <td >

<input  type="text" class=" ancho" id="SUPERVISOR" name="SUPERVISOR" value="<?php echo $filaso ['SUPERVISOR']  ?>" required>  

      </td>



</tr>


 <tr>

      <th >CONTACTO DE CUENTA</th>

      <td >

<input  type="text" class=" ancho" id="CONTACTO_CTA" name="CONTACTO_CTA"  required>  

      </td>



</tr>


 <tr>

      <th >EMPRESA</th>

      <td >

          <input class="ancho"  value="<?php echo $filaso ['ID_CLIENTE']; ?>" list="CLIENTES" type="text" id="CLIENTE" name="CLIENTE" placeholder="Cliente" required>

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



</tr>



 <tr>

      <th >CUENTA</th>

      <td >

<input  type="text" class=" ancho" id="CUENTA" name="CUENTA" required>  

      </td>



</tr>



 <tr>

      <th >CLIENTE</th>

      <td >

<input  type="text" class=" ancho" id="CTE_TERCERO" name="CTE_TERCERO" required> 

      </td>



</tr>



  <tr>
      <th >TIPO</th>
      <td >
      <select class="ancho"  id="TIPO_PROG" name="TIPO_PROG" required>
        <option selected></option>
        <?php 
          $query="SELECT * FROM  tipo_prog ";
          $result=mysqli_query($conexion, $query);
        ?>
        <?php while($filas=mysqli_fetch_assoc($result)) { ?>         
        <option value="<?php echo $filas ['tprog_nombre']?>" >
          <?php echo $filas ['tprog_nombre']  ?>  
        </option>
        <?php } ?>
      </select>
      </td>
</tr>
<tr>
      <th >ATENCIÓN</th>
      <td >
    <select class="ancho"   id="TIPO_DESPACHO" name="TIPO_DESPACHO" >
    <option selected value="<?php echo $filaso ['TIPO_DESPACHO']  ?>"> <?php echo $filaso ['TIPO_DESPACHO']  ?></option>
    <option value="Exclusivo" > Exclusivo</option>
    <option value="Compsrtido" > Compartido </option> 
    </select>         
      </td>

</tr>
 <tr>
      <th style="vertical-align: middle;" >OBSERVACION</th>
      <td >

<textarea class="form-control" id="OBSERVACION_SERV" name="OBSERVACION_SERV" rows="2" placeholder="Ingresar observaciones..."><?php echo $filaso['OBS_PROG']; ?></textarea>
      </td>

</tr>
<tr>
<td colspan="2">
       <div class="dropdown-divider"></div>




        <div class="form-row">

            <div class="col">

                <label for="NBULTOS">BULTOS</label>

                <input  type="number" class="form-control" id="NBULTOS" name="NBULTOS" >

            </div>

            <div class="col">

                <label for="PALETAS">PALETAS</label>

                <input  type="number" class="form-control" id="PALETAS" name="PALETAS" >

            </div>

            <div class="col">

                <label for="DATALOGGER">DATALOGGER</label>

                <select class="custom-select" id="DATALOGGER" name="DATALOGGER" >

                <option selected value="NO"> NO</option>

                <option value="SI" > SI </option>

                <option value="NO" > NO </option>         

                </select>

            </div>            

        </div>

        

</td>


</tr>


<tr>
<td colspan="2">


       <div class="dropdown-divider"></div>




        <div class="form-row">

             <div class="col">

                <label for="H_CITA">HCITA - BASE</label>

                <input  type="time" class="form-control" id="H_CITA" name="H_CITA" value="<?php echo $filaso ['H_CITA']  ?>" disabled>

            </div>

            <div class="col">

                <label for="H_CITA_R">HCITA - RECOJO</label>

                <input  type="time" class="form-control" id="H_CITA_R" name="H_CITA_R" value="<?php echo $filaso ['H_CITA_R']  ?>" >

            </div>

            <div class="col">

                <label for="RESGUARDO">RESGUARDO</label>

                <select class="custom-select" id="RESGUARDO" name="RESGUARDO" >

                <option selected value="<?php echo $filaso ['RESGUARDO']  ?>"> <?php echo $filaso ['RESGUARDO']  ?></option>

                <option value="SI" > SI </option>

                <option value="NO" > NO </option>         

                </select>

            </div>           

        </div>

        

<div class="dropdown-divider"></div>

</td>


</tr>






   </tbody>

</table>   

       

        <button id="guardar" name="guardar" type="submit" class="btn btn-success btn-block">

        

         GUARDAR

        </button>



</form>

      </div>

      

      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>



      </div>

    </div>

  </div>

</div>





<!-- Modal eliminar-->

<div class="modal fade" id="elimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Eliminar Servicio</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">



<div class="botones">

<div class="container text-center">

  <div class="row">

    <div class="col">

<?php

$queryS="

SELECT rd_servicio.*, rd_servicio.Id_SERG

FROM rd_servicio

WHERE (((rd_servicio.Id_SERG)=$idp))";

$resultS=mysqli_query($conexion, $queryS);



?>

<?php while($filasS=mysqli_fetch_assoc($resultS)) { ?>

        <a class="btn btn-lg btn-danger square-btn" style="color: white; " href="crud_servicio/deleteSR.php?ids=<?php echo $filasS ['ID_SERV']?>&idp=<?php echo $idp?>">

        <span class="icon-truck"></span>

        <?php echo $filasS ['PALETAS']?>P<br>

        <span style="font-size: 13px;"><?php echo $filasS ['CUENTA']?></span><br><span style="font-size: 15px;">ELIMINAR</span>

        </a>

<?php } ?>



    </div>

  </div>

</div>

</div>



      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>



      </div>

    </div>

  </div>

</div>

<?php include('includes/footer.php'); ?>