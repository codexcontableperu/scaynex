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


img {
    width: 50px; /* Ajusta el tamaño de los iconos según sea necesario */
    border-radius: 10px; /* Bordes redondeados de 20px */
}

img:hover  {

    opacity: 0.7;

    border: 2px solid #008169; /* Cambiar el borde a verde al pasar el cursor */

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

  
  align-items: center; /* Alinea verticalmente */
}
   .ancho {
    width: 180px; /* Ancho al pasar el cursor */
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

<?php
$idp=$_GET['idp'];
$idr=$_GET['idr'];
?>

    <link rel="stylesheet" href="whatsaap/stilo_what.css">

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
        <a class="boton bton noselec" href="wt_prog_user.php?dni=<?php  echo $dni_user ; ?> ">Ordenes</a>
        &nbsp &nbsp 
        <a class="boton noselec " href="wt_panel_user.php?idp=<?php echo $idp ?>"><i class="fas fa-map-marker-alt"></i> BASE</a></a>
        &nbsp &nbsp 
        <a class="boton  selec" href=""><i class="fas fa-map-marker-alt"></i> CARGA</a></a>
    </div>
</div>

<style>
.titu {
  display: flex;
  align-items: center;
  text-align: center;
}

.titu h5 {
  width: 90%;
}

.titu button {
  width: 10%;
}

.titu a  {
  border-color: red;
}

.titu a :hover {
  border: 1px solid red;
  padding: 3px;
}

</style>

<br><br><br>


<div class="dropdown-divider"></div>
<br>
    <B><i class="fas fa-map-marker-alt"></i> EN RUTA (Carga en Almacen)</B> 




  
<?php
$queryo="
SELECT rd_servicio.*, rd_servicio.Id_SERG, hruta.id_ruta, rd_segimientos_head.S_FECHA
FROM (rd_servicio INNER JOIN hruta ON rd_servicio.Id_SERG = hruta.id_prog) INNER JOIN rd_segimientos_head ON rd_servicio.Id_SERG = rd_segimientos_head.Id_SERG
WHERE (((rd_servicio.ID_SERV )=$idr));


";
$resulto=mysqli_query($conexion, $queryo);
$filaso=mysqli_fetch_assoc($resulto);
$FECHA_S =$filaso ['S_FECHA'];

?>
<br>



<div class="card ">
</div>    
      <h6 class="card-title" style="color: white;">  
<a  class="btn btn-dark btn-sm" data-toggle="modal" data-target="#HRUTA"> <i class="icon-libreoffice"></i> DATOS DEL SERVICIO </a>
      </h6>
<div >
    <div  style=" font-size: 15px;">

    <span class="icon-database"></span> <?php echo $FECHA_S ?>-P<?php echo $idp?>R<?php echo $idr?> 
    </div>
</div>
      <table class="table-success table-bordered  tdx" style="background-color:white;">
  <tbody>
    <tr>
      <th >EPS</th>
      <td class="tdx"><?php echo $filaso ['EPS']?></td>
      <th >EMPRESA</th>
      <td class="tdx"><?php echo $filaso ['CLIENTE']?></td>

    </tr>

    <tr>
      <th >PLACA</th>
      <td><?php echo $filaso ['PLACA']?></td>
      <th >CUENTA</th>
      <td class="tdx"><?php echo $filaso ['CUENTA']?></td>
    </tr>
    <tr>
      <th >TEMPERATURA</th>
      <td class="tdx"><?php echo $filaso ['TEMPERATURA']?></td>
      <th >CLIENTE</th>
      <td class="tdx"><?php echo $filaso ['CTE_TERCERO']?></td>

    </tr>
      <tr>
      <th >CONDUCTOR</th>
      <td class="tdx"><?php echo $filaso ['CONDUCTOR']?></td>
      <th >H.CITA - BASE</th>
      <td class="tdx"><?php echo $filaso ['H_CITA']?></td> 


    </tr>
    <tr>
      <th >AUXILIAR 1</th>
      <td class="tdx"><?php echo $filaso ['AUXILIAR1']?></td>
      <th >H.CITA - RECOJO</th>
      <td class="tdx"><?php echo $filaso ['H_CITA_R']?></td>
    </tr>
    <tr>
      <th >AUXILIAR 2</th>
      <td class="tdx"><?php echo $filaso ['AUXILIAR2']?></td>
      <th>RESGUARDO</th>
      <td class="tdx"><?php echo $filaso ['RESGUARDO']?> </td>         
    </tr>

    <tr>
      <th>AUXILIAR 3</th>
      <td class="tdx"><?php echo $filaso ['AUXILIAR3']?> </td>
      <th >BULTOS</th>
      <td class="tdx"><?php echo $filaso ['NBULTOS']?></td>      
    </tr>
  
    <tr>
      <th>SUPERVISOR</th>
      <td class="tdx"><?php echo $filaso ['SUPERVISOR']?> </td>
      <th>PALETAS</th>
      <td class="tdx"><?php echo $filaso ['PALETAS']?> </td>      
    </tr>

    <tr>
      <th>CONTACTO</th>
      <td class="tdx"><?php echo $filaso ['CONTACTO_CTA']?> </td>
      <th>DATALOGER</th>

<?php
$queryDAT="SELECT * FROM rd_dataloger WHERE ID_SERV=$idr";
$resultDAT=mysqli_query($conexion, $queryDAT);
$numfilas = mysqli_num_rows($resultDAT);

if ($numfilas === 0) {
  ?>
<td class="tdx">
            <a href="#ndataloger" class="btn btn-secondary" data-toggle="modal">
          <small><?php echo $filaso ['DATALOGGER']?> </small> 
          </a> 

</td> 

  <?php
} else {
  ?>
<td class="tdx">
            <a href="#ndataloger" class="btn btn-primary" data-toggle="modal">
          <small><?php echo $filaso ['DATALOGGER']?></small> 
          
          </a> 

</td> 
  <?php
}

?>      
    </tr>

<tr>
      <th >OBSERVACION</th>
      <td class="tdx" colspan="3"><?php echo $filaso ['OBSERVACION_SERV']?></td>  
</tr>

  </tbody>



</table>
</div>



      <table>
        <tbody>





<br>











<?php

     $query2="
SELECT *
FROM hruta
 /* WHERE id_prog=$idp */
WHERE id_serv=$idr
                ";
     $result2=mysqli_query($conexion, $query2);
     $filas2=mysqli_fetch_assoc($result2);



?>



<table class="table table-sm table-success">

  <tbody>
    <tr>&nbsp<span class="icon-truck"></span>&nbspLLEGADA A ALMACEN</tr>
    <tr >


    <tr>


          <div class="container text-center " style="background-color:white; padding: 10px;">

<?php

     if ($filas2 ['h_llegadaorigen'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=3" class="btn btn-light"> 
              <span class="icon-clock2"></span>
            </a> 
            
            
          <?php
     } else {
          ?> 
            <a href="#h_llegadaorigen" class="btn btn-primary" data-toggle="modal">
              <span class="icon-clock2"></span><br>
            <small><?php echo date("H:i", strtotime($filas2['h_llegadaorigen']))?></small>  
            </a> 
            
            
          <?php

     }


     if ($filas2 ['t_llegadaorigen'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=33" class="btn btn-light"> 
              <span class="icon-text-height"></span>
              </a>
          <?php
     } else {
          ?> 
            <a href="#t_llegadaorigen" class="btn btn-danger" data-toggle="modal">
              <span class="icon-text-height"></span><br>
              <small><?php echo $filas2['t_llegadaorigen']?></small> 
              </a>
          <?php

     }

     if ($filas2 ['k_llegadaorigen'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=30" class="btn btn-light"> 
              <span class="icon-road"></span>
              </a>
          <?php
     } else {
          ?> 
          <a href="#k_llegadaorigen" class="btn btn-warning" data-toggle="modal">
              <span class="icon-road"></span><br>
              <small><?php echo $filas2['k_llegadaorigen']?></small> 
              </a>
          <?php

     }

     if ($filas2 ['hr_foto'] === "NO" ) {
          ?> 
          <a href="#FOTOS" class="btn btn-light" data-toggle="modal"> 
            <span class="icon-image"></span><br>
            
          </a> 
          <?php
     } else {
          ?> 
            <a href="#FOTOS" class="btn btn-primary" data-toggle="modal">
          <span class="icon-image"></span> <br>
          <small><?php echo $filas2['hr_foto']?></small> 
          </a> 
          <?php

     }
 ?>


          </div>

    </tr>
<tr> &nbsp<span class="icon-cart"></span>&nbspINICIO CARGA</tr>
    <tr>

          <div class="container text-center "style="background-color:white; padding: 10px;">

     <?php            
     if ($filas2 ['h_iniciocarga'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=4" class="btn btn-light"> 
              <span class="icon-clock2"></span>

            </a>
          <?php
     } else {
          ?> 
          <a href="#h_iniciocarga" class="btn btn-primary" data-toggle="modal">
              <span class="icon-clock2"></span>
              <br>
            <small><?php echo date("H:i", strtotime($filas2['h_iniciocarga']))?></small>
            </a>
          <?php

     }


     if ($filas2 ['t_iniciocarga'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=44" class="btn btn-light"> 
              <span class="icon-text-height"></span>
              </a>
          <?php
     } else {
          ?> 
          <a href="#t_iniciocarga" class="btn btn-danger" data-toggle="modal">
              <span class="icon-text-height"></span><br>
              <small><?php echo $filas2['t_iniciocarga']?></small> 
              </a>
          <?php

     }

     if ($filas2 ['hr_foto'] === "NO" ) {
          ?> 
          <a href="#FOTOS1" class="btn btn-light" data-toggle="modal"> 
            <span class="icon-image"></span><br>
            
          </a> 
          <?php
     } else {
          ?> 
            <a href="#FOTOS1" class="btn btn-primary" data-toggle="modal">
          <span class="icon-image"></span> <br>
          <small><?php echo $filas2['hr_foto']?></small> 
          </a> 
          <?php

     }
        
     ?>


          </div>

    </tr>

    <tr>&nbsp<span class="icon-road"></span>&nbspSALIDA DE ALMACEN</tr>

    <tr>


          <div class="container text-center "style="background-color:white; padding: 10px;">

     <?php            
     if ($filas2 ['h_salidaorigen'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=5" class="btn btn-light"> 
              <span class="icon-clock2"></span>
            </a>
          <?php
     } else {
          ?> 
          <a href="#h_salidaorigen" class="btn btn-primary" data-toggle="modal">
              <span class="icon-clock2"></span>
              <br>
            <small><?php echo date("H:i", strtotime($filas2['h_salidaorigen']))?></small>
            </a>
          <?php

     }


     if ($filas2 ['t_salidaorigen'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=55" class="btn btn-light"> 
              <span class="icon-text-height"></span>
              </a>
          <?php
     } else {
          ?> 
          <a href="#t_salidaorigen" class="btn btn-danger" data-toggle="modal">
              <span class="icon-text-height"></span><br>
              <small><?php echo $filas2['t_salidaorigen']?></small>
              </a>
          <?php

     }

     if ($filas2 ['hr_foto'] === "NO" ) {
          ?> 
          <a href="#FOTOS2" class="btn btn-light" data-toggle="modal"> 
            <span class="icon-image"></span>
            
          </a> 
          <?php
     } else {
          ?> 
            <a href="#FOTOS2" class="btn btn-primary" data-toggle="modal">
          <span class="icon-image"></span> <br>
          <small><?php echo $filas2['hr_foto']?></small> 
          </a> 
          <?php

     }  

      if ($filaso ['serv_actualizado']==='NO') {
        ?> 
      <a  class="btn btn-light " data-toggle="modal" data-target="#SCARGAS"> <span class="icon-truck"></span> <br> <small>Carga</small> </a>

        <?php
      } else {
        ?> 
      <a style="color:white;" class="btn btn-info" data-toggle="modal" data-target="#SCARGAS"> <span class="icon-truck"></span><br><small>Carga</small></a>

        <?php
      }



     if ($filas2 ['WT_ENVIO'] === 'NO' ) {
          ?> 
          <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=9" class="btn btn-light" target="_blank"> 
           <span class="icon-whatsapp"></span>
           </a>
          <?php
     } else {
          ?> 
          <a  href="./crud_mensajes/msj_almacen.php?idr=<?php echo $idr?> " target="_blank"  class="btn btn-success" data-toggle="modal"> 
           <span class="icon-whatsapp"></span><br>
           <small style="font-size: 10px;" >Enviado</small>
           </a>
          <?php

     }

     ?>



          </div>

    </tr>

 </tbody>  
</table>







 



<!--

    <tr>



      <th scope="row"> &nbsp<span class="icon-clipboard"></span></th>
      <td> SOLICITAR GUIA TRNSPORTISTA</td>
      <td>
          <div class="container text-center ">

     <?php            
     if ($filas2 ['num_guiatrans'] === null ) {
          ?> 
            <a href="https://docs.google.com/forms/d/e/1FAIpQLScB63y7Z3G3h-m5k5AHQ3GWTf3Vs3IZ3h5fxuJfXszNjmI4Dg/viewform" class="btn btn-light" target="_blank"> 
              &nbsp REGISTRAR &nbsp
            </a>
          <?php
     } else {
          ?> 
            <a href="https://docs.google.com/forms/d/e/1FAIpQLScB63y7Z3G3h-m5k5AHQ3GWTf3Vs3IZ3h5fxuJfXszNjmI4Dg/viewform" class="btn btn-primary" target="_blank"> 
              &nbsp REGISTRAR &nbsp
            </a>
          <?php

     }

    ?> 


            

          </div>
      </td>
    </tr>

-->        
  </tbody>
</table>




<style>
.titu {
  display: flex;
  align-items: center;
  text-align: center;
}

.titu h5 {
  width: 90%;
}

.titu button {
  width: 10%;
}

.titu a  {
  border-color: red;
}

.titu a :hover {
  border: 1px solid red;
  padding: 3px;
}

.descarga   {
 
  font-size: 1.25rem;
  margin: 8px;
}

</style>

<br>

<div class="titu" >
  <i class="icon-download2"></i>&nbsp DESCARGAS   &nbsp &nbsp &nbsp &nbsp &nbsp
  <div style="display: flex;">
<?php 
$querydd="SELECT id_descaga FROM rd_descargas WHERE id_hruta=$idr";
$resultdd=mysqli_query($conexion, $querydd);

?>   
<marquee behavior="scroll"  direction="right" style="width: 130px; " > 
<?php while($filasdd=mysqli_fetch_assoc($resultdd)) { ?>
<span class="icon-cart"> </span>   
<?php } ?> 

</marquee >
</div>
  <a data-toggle="modal" data-target="#elimina"  style="color: red;"><span class="icon-bin"></span>   </a>
</div>


<div class="botones8">
<div class="container8 text-center" style="background-color:white;">
  <div class="row">
    <div class="col">
<?php
$queryS="
SELECT rd_descargas.hora_cita, rd_descargas.id_descaga, rd_descargas.pe_cliente, rd_descargas.prioridad, rd_descargas.desg_distrito, rd_descargas.id_hruta, Sum(guias_remitente.gr_bultos) AS tbultos
FROM guias_remitente RIGHT JOIN rd_descargas ON guias_remitente.id_desg = rd_descargas.id_descaga
GROUP BY rd_descargas.id_descaga, rd_descargas.pe_cliente, rd_descargas.desg_distrito, rd_descargas.id_hruta
HAVING (((rd_descargas.id_hruta)=$idr));
";
$resultS=mysqli_query($conexion, $queryS);
$numfilas = mysqli_num_rows($resultS);
?>



<?php while($filasS=mysqli_fetch_assoc($resultS)) { 

if ($filasS['tbultos'] === null) {
          ?>
          <a class="btn btn-lg btn-outline-success descarga"  href="wt_ruta_descargas.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&idd=<?php echo $filasS ['id_descaga']?>"> 
          <span class=" icon-download2 "></span><br>
          <span style="font-size: 13px;">REGISTRAR</span>
     
          </a> <?php 
} else {
        ?>
        <a class="btn btn-lg btn-success descarga" style="color: white; " href="wt_ruta_descargas.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&idd=<?php echo $filasS ['id_descaga']?>">
        <span class=" icon-download2 "></span>
        <?php echo $filasS ['tbultos']?>B
        <br>
          <span style="font-size: 13px;"><?php echo $filasS ['desg_distrito']?></span>
        <br>
        <span style="font-size: 13px;">
            <?php echo $filasS['hora_cita'] ? date("H:i", strtotime($filasS['hora_cita'])) : '--:--'; ?>
        </span> 
              
        </a> 

        <?php 
}

} ?>

<?php
$queryGTR="
SELECT rd_descargas.id_descaga, guias_remitente.id_guiar, guias_remitente.gr_bultos
FROM guias_remitente INNER JOIN rd_descargas ON guias_remitente.id_desg = rd_descargas.id_descaga
WHERE (((rd_descargas.id_hruta)=$idr));

";
$resultGTR=mysqli_query($conexion, $queryGTR);
$numfilasGTR = mysqli_num_rows($resultGTR);
?>

<?php

if ($numfilasGTR != 0) {

     if ($filas2 ['GUIA_TRANSP'] === "NO" ) {
          ?> 
          <a href="#nGUIATRANSP" class="btn btn-warning" data-toggle="modal"> 
            <span class="icon-compass"></span> <br>
            <span>Solicitar</span><br>
            <span>G. Transporte</span>
          </a> 
          <?php
     } else {
          ?> 
            <a href="#aGUIATRANSP" class="btn btn-info" data-toggle="modal" style="color:white;">
          <span class="icon-compass"></span> 
          <br>
          <span>Solicitado</span> 
          </a> 
          <?php

     } 
} 

?>


      <a data-toggle="modal" data-target="#descarga" class="btn btn-lg btn-outline-success square-btn" style="font-size: 13px;"><span class="icon-plus">
        <br> Nueva Descarga</a>
    </div>
  </div>
</div>
</div>






<!-- Modal eliminar-->
<div class="modal fade" id="elimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Registro de Descarga</h5>
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
SELECT rd_descargas.*, rd_descargas.id_hruta
FROM rd_descargas
WHERE (((rd_descargas.id_hruta)=$idr))
";
$resultS=mysqli_query($conexion, $queryS);

?>
<?php while($filasS=mysqli_fetch_assoc($resultS)) { ?>
        <a class="btn btn-lg btn-danger descarga" style="color: white; " href="crud_descargas/delete.php?idd=<?php echo $filasS ['id_descaga']?>&idr=<?php echo $idr?>&idp=<?php echo $idp?>">
        <span class="icon-download2"></span>
        <?php echo $filasS ['desg_bultos']?>P<br>
        <span style="font-size: 13px;"><?php echo $filasS ['pe_cliente']?></span><br><span style="font-size: 15px;">ELIMINAR</span>
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



<!-- Modal solicitar g transporte-->
<div class="modal fade" id="nGUIATRANSP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Solicitar Guia Transportista</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<div class="dropdown-divider"></div>

<h6 >GUIAS DE REMISION :</h6>      
<?php
$queryS="
SELECT guias_remitente.id_ruta, guias_remitente.gr_serienum, guias_remitente.fact_cliente, guias_remitente.gr_bultos
FROM guias_remitente
WHERE (((guias_remitente.id_ruta)=$idr));
";
$resultS=mysqli_query($conexion, $queryS);

?>

<?php while($filasS=mysqli_fetch_assoc($resultS)) { ?>

       GR: <?php echo $filasS ['gr_serienum']?> FT: <?php echo $filasS ['fact_cliente']?> BT: <?php echo $filasS ['gr_bultos']?><br>

<?php } ?>

<div class="dropdown-divider"></div>

<form  action="crud_gtransp/create.php" method="POST" enctype="multipart/form-data" class="colm">
<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>
<input class="form-control"  type="hidden" id="gt_solicita" name="gt_solicita" value="<?php echo $id_userup ; ?> " readonly>


<div class="form-group">
    <label for="gt_observ">OBSERVACION:</label>    
    <!-- Campo de texto para ingresar observaciones -->
    <textarea id="gt_observ" name="gt_observ" class="form-control" rows="2" placeholder="Ingrese su observación aquí..."></textarea>
</div>

      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">SOLICITAR</button>
</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>

      </div>
    </div>
  </div>
</div>

















<!-- Modal Nueva Descarga-->
<div class="modal fade" id="descarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva Descarga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<table class="table table-sm " >
  <form action="crud_descargas/create.php" method="POST">
<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>
<input class="form-control"  type="hidden"  id="user_desg" name="user_desg" value="<?php echo $id_userup ?>" >

    <tr>
        <td>CLIENTE</td>
        <td><input class="ancho" type="text" id="pe_cliente" name="pe_cliente" required></td>
    </tr>
        <tr>
        <td>DIRECCION</td>
        <td><input class="ancho" type="text" id="desg_direccion" name="desg_direccion"  ></td>
    </tr>
    <tr>
        <td>DISTRITO</td>
        <td><input class="ancho" type="text" id="desg_distrito" name="desg_distrito" required></td>
    </tr>
    <tr>
        <td>CON H. CITA</td>
       
        <td>
    <select class="ancho"   id="hrcita" name="hrcita" required>
    <option selected>  </option>
    <option value="SI" > SI </option>
    <option value="NO" > NO </option>         
    </select> 
        </td>
    </tr>

    
<tr>
        <td>HORA CITA</td>
        <td><input class="ancho" type="time" id="hora_cita" name="hora_cita"  ></td>
    </tr>



    <tr>
        <td>PRIORIDAD</td>
        <td>
    <select class="ancho"   id="prioridad" name="prioridad" required>
    <option selected>  </option> 
    <option value="Normal" > Normal </option>
    <option value="Urgente" > Urgente </option>       
    </select> 
        </td>
    </tr>
    <tr>
        <td>OBSERVACION</td>
        <td><input class="ancho" id="obs_descarga" name="obs_descarga" ></input></td>
    </tr>

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





<?php

     $query7="
SELECT *
FROM update2
WHERE tipo='h'
                ";
     $result7=mysqli_query($conexion, $query7);



?>

  <?php while($filas7=mysqli_fetch_assoc($result7)) { ?>

<div class="modal" tabindex="-1" role="dialog" id="<?php echo $filas7 ['campo']?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo $filas7 ['titulo']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_ruta/update2.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>
<input class="form-control"  type="hidden" id="i" name="i" value="<?php echo $filas7 ['indicador']?>" readonly>

  <div class="form-group" >
    <label for="head_fecha">Ingrese: </label>
    <input class="form-control" type="time"  id="txt" name="txt" required>
  </div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">REGISTRAR</button>
</form>
        
      </div>
    </div>
  </div>
</div>

   <?php } ?>



<?php

     $query7="
SELECT *
FROM update2
WHERE tipo='t'
                ";
     $result7=mysqli_query($conexion, $query7);



?>

  <?php while($filas7=mysqli_fetch_assoc($result7)) { ?>

<div class="modal" tabindex="-1" role="dialog" id="<?php echo $filas7 ['campo']?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo $filas7 ['titulo']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_ruta/update2.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>
<input class="form-control"  type="hidden" id="i" name="i" value="<?php echo $filas7 ['indicador']?>" readonly>

  <div class="form-group" >
    <label for="head_fecha">Ingrese: </label>
    <input class="form-control" type="text"  id="txt" name="txt" required>
  </div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">REGISTRAR</button>
</form>
        
      </div>
    </div>
  </div>
</div>

   <?php } ?>


<div class="modal" tabindex="-1" role="dialog" id="guiatrans">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">SOLICITAR GUIA REMISION TRANSPORTISTA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<iframe src="https://docs.google.com/forms/d/e/1FAIpQLScoksFZEmXYDzABhUGEOg5HzBjHnzMi87nqCQmfj8CNKk01Ug/viewform?embedded=true" width="640" height="1034" frameborder="0" marginheight="0" marginwidth="0">Cargando…</iframe>


      </div>
    </div>
  </div>
</div>








<!-- SECCION DEL PROCESO -->
  <div class="botones">
  
<a href="wt_panel_user.php?idp=<?php echo $idp ?>" class="btn btn-secondary btn-block custom-btn"> <span  class=" icon-folder-open "> </span></span>CERRAR</a>
  </div>





<div class="dropdown-divider"></div>






<!-- Modal SCARGA-->
<div class="modal fade" id="SCARGAS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CARGA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<form action="crud_servicio/update2.php" method="POST">
    <!-- Identificadores ocultos -->
    <input type="hidden" class="form-control" id="idr" name="idr" value="<?php echo $idr; ?>">
    <input type="hidden" class="form-control" id="idp" name="idp" value="<?php echo $idp; ?>">
    <input type="hidden" class="form-control" id="ID_SERV" name="ID_SERV" value="<?php echo $filaso['ID_SERV']; ?>">

    <!-- Contenedor para colocar BULTOS, PALETAS, y RESGUARDO en la misma línea -->
    <div class="form-row">

        <div class="col">
            <label for="PALETAS">PALETAS</label>
            <input type="number" class="form-control" id="PALETAS" name="PALETAS" value="<?php echo $filaso['PALETAS']; ?>">
        </div>

        <div class="col">
            <label for="NBULTOS">BULTOS</label>
            <input type="number" class="form-control" id="NBULTOS" name="NBULTOS" value="<?php echo $filaso['NBULTOS']; ?>">
        </div>

        <div class="col">
            <label for="RESGUARDO">RESGUARDO</label>
            <select class="custom-select" id="RESGUARDO" name="RESGUARDO">
                <option selected value="<?php echo $filaso['RESGUARDO']; ?>"><?php echo $filaso['RESGUARDO']; ?></option>
                <option value="SI">SI</option>
                <option value="NO">NO</option>
            </select>
        </div>
    </div>

    <!-- Campo para OBSERVACION (textarea) -->
    <div class="form-group mt-3">
        <label for="OBS_PROG">OBSERVACION</label>
        <textarea class="form-control" id="OBS_PROG" name="OBS_PROG" rows="2" placeholder="Ingresar observaciones..."><?php echo $filaso['OBSERVACION_SERV']; ?></textarea>
    </div>

    <!-- Botón para enviar el formulario -->
    <div class="form-group">
        <button id="guardar" name="guardar" type="submit" class="btn btn-primary btn-block">Actualizar</button>
    </div>
</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>

      </div>
    </div>
  </div>
</div>












<div class="modal" tabindex="-1" role="dialog" id="FOTOS">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> <i class="icon-images"></i> IMAGENES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_fotos/createimg.php" method="POST" enctype="multipart/form-data" class="colm">
<input class="form-control"  type="hidden" id="tipo" name="tipo" value="CARGA" readonly>
<input class="form-control"  type="hidden" id="Redirigir" name="Redirigir" value="ruta_ruta" readonly>
<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly> 
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>
 <input class="form-control"  type="hidden" id="idd" name="idd" value="" readonly> 
<div class="form-group">
        <label for="head_imagen">Imagen: </label>
        <input class="form-control" type="file" id="head_imagen" name="head_imagen" accept="image/*" required>
        <label for="head_imagen">Descripción : </label>
        <input class="form-control" type="txt" id="ALCANCE" name="ALCANCE" value="Llegada Almacen" required>
    </div>

      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">GUARDAR</button>
</form>
        
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="FOTOS1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> <i class="icon-images"></i> IMAGENES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_fotos/createimg.php" method="POST" enctype="multipart/form-data" class="colm">
<input class="form-control"  type="hidden" id="tipo" name="tipo" value="ALMACEN" readonly>
<input class="form-control"  type="hidden" id="Redirigir" name="Redirigir" value="ruta_ruta" readonly>
<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly> 
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>
 <input class="form-control"  type="hidden" id="idd" name="idd" value="" readonly> 
<div class="form-group">
        <label for="head_imagen">Imagen: </label>
        <input class="form-control" type="file" id="head_imagen" name="head_imagen" accept="image/*" required>
        <label for="head_imagen">Descripción : </label>
        <input class="form-control" type="txt" id="ALCANCE" name="ALCANCE" value="Inicio de Carga" required>
    </div>

      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">GUARDAR</button>
</form>
        
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="FOTOS2">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> <i class="icon-images"></i> IMAGENES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_fotos/createimg.php" method="POST" enctype="multipart/form-data" class="colm">
<input class="form-control"  type="hidden" id="tipo" name="tipo" value="CARGA" readonly>
<input class="form-control"  type="hidden" id="Redirigir" name="Redirigir" value="ruta_ruta" readonly>
<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly> 
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>
 <input class="form-control"  type="hidden" id="idd" name="idd" value="" readonly> 
<div class="form-group">
        <label for="head_imagen">Imagen: </label>
        <input class="form-control" type="file" id="head_imagen" name="head_imagen" accept="image/*" required>
        <label for="head_imagen">Descripción : </label>
        <input class="form-control" type="txt" id="ALCANCE" name="ALCANCE" value="Salida de Almacen" required>
    </div>

      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">GUARDAR</button>
</form>
        
      </div>
    </div>
  </div>
</div>


  <div class="modal-dialog" role="document">



<!-- Modal nuevo dataloger -->
<div class="modal fade" id="ndataloger" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Dataloger</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="crud_dataloger/create.php" method="POST">
          <table class="table table-sm">
            <tbody>
              <input type="hidden" class="form-control" id="idr" name="idr" value="<?php echo htmlspecialchars($idr); ?>">
              <input type="hidden" class="form-control" id="idp" name="idp" value="<?php echo htmlspecialchars($idp); ?>">
              <tr>
                <th>FECHA</th>
                <td>
                  <input type="date" class="ancho" id="dt_fecha" name="dt_fecha" value="<?php echo htmlspecialchars($FECHA_S); ?>" required>
                </td>
              </tr>
              <tr>
                <th>CUENTA</th>
                <td>
                  <input type="text" class="ancho" id="dt_cuenta" name="dt_cuenta" value="<?php echo htmlspecialchars($filaso['CLIENTE']); ?>" required>
                </td>
              </tr>
              <tr>
                <th>CLIENTE</th>
                <td>
                  <input type="text" class="ancho" id="dt_cliente" name="dt_cliente" value="<?php echo htmlspecialchars($filaso['CTE_TERCERO']); ?>" required>
                </td>
              </tr>
              <tr>
                <th>GUIA</th>
                <td>
                  <input type="text" class="ancho" id="dt_guia" name="dt_guia" required>
                </td>
              </tr>
              <tr>
                <th>FACTURA</th>
                <td>
                  <input type="text" class="ancho" id="dt_factura" name="dt_factura" required>
                </td>
              </tr>
              <tr>
                <th>CODIGO</th>
                <td>
                  <input type="text" class="ancho" id="dt_codigo" name="dt_codigo" required>
                </td>
              </tr>
              <tr>
                <th>CANTIDAD</th>
                <td>
                  <input type="number" class="ancho" id="dt_cantidad" name="dt_cantidad" required>
                </td>
              </tr>
              <tr>
                <th>PLACA</th>
                <td>
                  <input class="ancho" list="PLACAS" type="text" id="dt_placa" name="dt_placa" value="<?php echo htmlspecialchars($filaso['PLACA']); ?>" placeholder="Placa" required>
                  <datalist id="PLACAS">
                    <option selected></option>
                    <?php
                    $queryP = "SELECT * FROM unidades";
                    $resultP = mysqli_query($conexion, $queryP);
                    while ($filasP = mysqli_fetch_assoc($resultP)) {
                    ?>
                      <option value="<?php echo htmlspecialchars($filasP['vh_placa']); ?>"></option>
                    <?php } ?>
                  </datalist>
                </td>
              </tr>
            </tbody>
          </table>
          <button id="guardar" name="guardar" type="submit" class="btn btn-success btn-block">GUARDAR</button>
        </form>
      </div>


<div style="padding: 15px">

        <?php 
          $queryDL="SELECT * FROM rd_dataloger WHERE ID_SERV=$idr";
          $resultDL=mysqli_query($conexion, $queryDL);
        ?>

        <?php while($filasDL=mysqli_fetch_assoc($resultDL)) { ?>
<div style="display: inline-block; font-size:12px; text-align: center;">
  <a href="wt_ruta_dataloger.php?id=<?php echo $filasDL['id_dt']; ?>&idp=<?php echo $idp; ?>&idr=<?php echo $idr; ?>"> <img  src="img/dataloger.jpg" ></a>
  <br><span><b>C:</b><?php echo htmlspecialchars($filasDL['dt_codigo']); ?></span>

</div>

        <?php } ?>



</div>








      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal nuevo servicio + nueva ruta-->

<div class="modal fade" id="HRUTA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Actualizar Servicio</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">



      <table class="table table-sm ">

  <form action="crud_servicio/update.php" method="POST">

  <tbody>

    <input type="hidden" class="form-control" id="idr" name="idr" value="<?php echo $idr; ?>">
    <input type="hidden" class="form-control" id="idp" name="idp" value="<?php echo $idp; ?>">
    <input type="hidden" class="form-control" id="ID_SERV " name="ID_SERV " value="<?php echo $filaso ['ID_SERV']; ?>">
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
      <input  type="text" class=" ancho" id="SUPERVISOR" name="SUPERVISOR" value="<?php echo $filaso ['SUPERVISOR']; ?>" required> 
      </td>
</tr>

 <tr>

      <th >CONTACTO DE CUENTA</th>
      <td >
<input  type="text" class=" ancho" id="CONTACTO_CTA" name="CONTACTO_CTA" value="<?php echo $filaso ['CONTACTO_CTA']?>" required>  
      </td>
</tr>


 <tr>

      <th >EMPRESA</th>

      <td >

          <input class="ancho"  value="<?php echo $filaso ['CLIENTE']; ?>" list="CLIENTES" type="text" id="CLIENTE" name="CLIENTE" placeholder="Cliente" required>

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

<input  type="text" class=" ancho" id="CUENTA" name="CUENTA" value="<?php echo $filaso ['CUENTA']; ?>" required>  

      </td>



</tr>



 <tr>

      <th >CLIENTE</th>

      <td >

<input  type="text" class=" ancho" id="CTE_TERCERO" name="CTE_TERCERO" value="<?php echo $filaso ['CTE_TERCERO']; ?>" required> 

      </td>



</tr>



  <tr>      

      <th >TIPO</th>

      <td >



      

      <select class="ancho"  id="TIPO_PROG" name="TIPO_PROG" required>

        <option selected <?php echo $filaso ['TIPO_PROG']; ?>><?php echo $filaso ['TIPO_PROG']; ?></option>

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

      <th >OBSERVACION</th>

      <td >

          <input class="ancho" type="text" id="OBS_PROG" name="OBS_PROG" value="<?php echo $filaso ['OBSERVACION_SERV']  ?>" placeholder="Observacion">

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

                <input  type="time" class="form-control" id="H_CITA_R" name="H_CITA_R" value="<?php echo $filaso ['H_CITA_R']  ?>" disabled>

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

        



</td>


</tr>


<tr>
<td colspan="2">

        <div class="form-row">
            <div class="col">
                <label for="NBULTOS">BULTOS</label>
                <input  type="number" class="form-control" id="NBULTOS" name="NBULTOS" value="<?php echo $filaso ['NBULTOS']  ?>">
            </div>
            <div class="col">
                <label for="PALETAS">PALETAS</label>
                <input  type="number" class="form-control" id="PALETAS" name="PALETAS" value="<?php echo $filaso ['PALETAS']  ?>">
            </div>
            <div class="col">
                <label for="DATALOGGER">DATALOGGER</label>
                <select class="custom-select" id="DATALOGGER" name="DATALOGGER" >
                <option selected value="<?php echo $filaso ['DATALOGGER']  ?>"> <?php echo $filaso ['DATALOGGER']  ?></option>
                <option value="SI" > SI </option>
                <option value="NO" > NO </option>         
                </select>
            </div>           
        </div>
  



</td>
</tr>
   </tbody>
</table>
        <button id="guardar" name="guardar" type="submit" class="btn btn-success btn-block">     
         ACTUALIZAR
        </button>
</form>
<div class="dropdown-divider"></div>



      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>
