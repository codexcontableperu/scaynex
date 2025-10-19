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



   <link rel="stylesheet" href="whatsaap/stilo_pag.css">



   <style type="text/css">





.pagina-centrada {

    background-color: #fff; /* Fondo blanco */

    margin: 30px auto; /* Margen superior e inferior, centrado horizontalmente */

    padding: 20px;

    border-radius: 7px; /* Bordes redondeados */

    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sutil sombra en los bordes */

max-width:350px;

    width: 100%;

}





   </style>




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

    width: 110px; /* Ajusta el tamaño de los iconos según sea necesario */





}



.image-container:hover img {

    transform: scale(1.1); /* Cambia la escala al 110% al pasar el cursor */

}



p {

    font-size: 13px; /* Ajusta el tamaño de la letra según sea necesario */

}





.table td, .table th {

  padding: .10rem;

  vertical-align:  baseline;



}



        table {

            font-size: 9px; /* Cambia el tamaño de fuente para toda la tabla */

            width: 100%; /* Define el ancho de la tabla al 100% del contenedor */



        }



    .square-btn {

  width: 100px; /* Adjust size as needed */

margin: 5px;

  

  align-items: center; /* Alinea verticalmente */

}




  thead {



    align-items: center; /* Alinea verticalmente */

    text-align: center; /* Alinea horizontalmente */

  }



</style>

<?php
$idp=$_GET['idp'];
$idr=$_GET['idr'];
?> 
    <link rel="stylesheet" href="whatsaap/stilo_what.css">

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
        <a class="boton  selec" href=""><i class="icon-printer"></i> HOJA DE RUTA</a></a>
    </div>





<style>
        .tiket {
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            padding: 0;
            line-height: 1.1;
        }
        .hoja-de-ruta {
            width: 300px;
            padding: 5px;
        }
        .titulo {
            font-weight: bold;
            text-align: left;
        }
        .info-linea {
            margin: 2px 0;
        }
        .info-label {
            font-weight: bold;
        }
        .separador {
            text-align: center;
            font-weight: bold;
        }
        .line {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }
                .bold {
            font-weight: bold;
        }
        .signature {
            margin-top: 20px;
            text-align: center;
        }
        .signature-line {
            border-top: 1px solid #000;
            width: 80%;
            margin: 40px auto 5px auto;
        }
    </style>


<?php

$queryo="
SELECT *
FROM rd_servicio 
WHERE ID_SERV=$idr;
";

$resulto=mysqli_query($conexion, $queryo);
$filaso=mysqli_fetch_assoc($resulto);
?>


<div class="pagina-centrada">

<div class="tiket">
    <div class="hoja-de-ruta">
<?php
if ($filaso ['EPS'] == 'JSA LLANOS') {
    ?>
       <div class="text-center"><img style="flex: 0 0 auto;" src="img/llanos.png" alt="Imagen 2"></div>
    <?php   
} else {
    ?>
       <div class="text-center"><img style="flex: 0 0 auto;" src="img/llanos.png" alt="Imagen 2"></div>
    <?php  
}

?>
<div class="separator ">==============================</div>
<div style="font-size: 12px">

        <div class="titulo"><span class="icon-truck"></span>&nbspHOJA DE RUTA: <br> P<?php echo $idp?>R<?php echo $idr?> - <?php echo $filaso ['FECHA_SERV'] ?></div>
        <div class="line"></div>
        <div class="info-linea"><span class="info-label">EPS:</span> <?php echo $filaso ['EPS']?></div>
        <div class="info-linea"><span class="info-label">PLACA:</span> <?php echo $filaso ['PLACA']?></div>
        <div class="info-linea"><span class="info-label">TEMP:</span> <?php echo $filaso ['TEMPERATURA']?></div>
        <div class="info-linea"><span class="info-label">TIPO:</span> <?php echo $filaso ['TIPO_PROG']?></div>
        <div class="info-linea"><span class="info-label">ATENCION:</span> <?php echo $filaso ['TIPO_DESPACHO']?></div> 
        <div class="info-linea"><span class="info-label">RESGUARDO:</span> <?php echo $filaso ['RESGUARDO']?></div> 
        <div class="info-linea"><span class="info-label">DATALOGER:</span> <?php echo $filaso ['DATALOGGER']?></div>         
        <div class="info-linea"><span class="info-label">CONDUCTOR:</span> <?php echo $filaso ['CONDUCTOR']?></div>
        <div class="info-linea"><span class="info-label">AUXILIAR 1:</span> <?php echo $filaso ['AUXILIAR1']?></div>
        <div class="info-linea"><span class="info-label">AUXILIAR 2:</span><?php echo $filaso ['AUXILIAR2']?></div>
        <div class="info-linea"><span class="info-label">AUXILIAR 3:</span><?php echo $filaso ['AUXILIAR3']?></div>
        <div class="info-linea"><span class="info-label">CLIENTE:</span> <?php echo $filaso ['CLIENTE']?> / <?php echo $filaso ['CUENTA']?></div>
        <div class="info-linea"><span class="info-label">HORA DE CITA:</span> <?php echo $filaso ['H_CITA']?></div>
        <div class="line"></div>
        <div><span class="bold">OBSERVACION:</span></div><br>
        <span> <?php echo $filaso ['OBSERVACION_SERV']?></span> 

</div>
        <div class="separator ">==============================</div>
<?php

$queryIF="
SELECT *
FROM rd_inicio_fin
WHERE Id_SERG=$idp;
";

$resulIF=mysqli_query($conexion, $queryIF);
$filasIF=mysqli_fetch_assoc($resulIF);
?>



        <div class="center bold">DATOS DEL RECORRIDO:</div>
        <div class="line"></div>
        <div class="bold">◉ SALIDA DE BASE (Inicio)</div>
        <div>
        |H:<?php echo $filasIF ['HORA_SALIDA_BASE']?> 
        |T:<?php echo $filasIF ['TEMP_SALIDA_BASE']?> 
        |K:<?php echo $filasIF ['KM_SALIDA_BASE']?>
        </div>
<?php
$queryHR="
SELECT *
FROM hruta
WHERE id_serv=$idr;
";

$resulHR=mysqli_query($conexion, $queryHR);
$filasHR=mysqli_fetch_assoc($resulHR);
?>       
        <div class="line"></div>
        <div class="bold">◉ EN RUTA (Servicios)</div>
        <div>&nbsp;&nbsp;➤ LLEGADA A ALMACEN</div>
        <div>&nbsp;&nbsp;
        |H:<?php $hora = $filasHR['h_llegadaorigen'] ?? ''; echo substr($hora, 0, 5); ?>
        |T:<?php echo $filasHR ['t_llegadaorigen']?> 
        |K:<?php echo $filasHR ['k_llegadaorigen']?>
        </div>
        <div>&nbsp;&nbsp;➤ INICIO CARGA</div>
        <div>&nbsp;&nbsp;
        |H:<?php $hora = $filasHR['h_iniciocarga'] ?? ''; echo substr($hora, 0, 5); ?>
        |T:<?php echo $filasHR ['t_iniciocarga']?>  
        </div>
        <div>&nbsp;&nbsp;➤ SALIDA DE ALMACEN</div>
        <div>&nbsp;&nbsp;
        |H:<?php $hora = $filasHR['h_salidaorigen'] ?? ''; echo substr($hora, 0, 5); ?>
        |T:<?php echo $filasHR ['t_salidaorigen']?> 
        </div>

<?php
$queryDE="
SELECT *
FROM rd_descargas
WHERE id_hruta=$idr;
";

$resulDE=mysqli_query($conexion, $queryDE);

?> 
<?php while($filasDE=mysqli_fetch_assoc($resulDE)) { $idd = $filasDE ['id_descaga'];?>

        <div class="line"></div>
        <div>&nbsp;&nbsp;DESCARGA <?php echo $idd ?> : <?php echo $filasDE ['desg_distrito']?> </div>
        <div>&nbsp;&nbsp;<?php echo $filasDE ['pe_cliente']?> </div>
        <div>&nbsp;&nbsp;PRIORIDAD:  <?php echo $filasDE ['prioridad']?></div>
        <div class="line"></div>
        <div>&nbsp;&nbsp;GUIAS:  </div>
        <div style="font-size: 14px">

<?php
$queryGF="
SELECT guias_remitente.id_desg, guias_remitente.gr_serienum, guias_remitente.fact_cliente, guias_remitente.gr_bultos
FROM guias_remitente
WHERE (((guias_remitente.id_desg)='$idd'));
";
$resulGF=mysqli_query($conexion, $queryGF);
?>
<?php while($filasGF=mysqli_fetch_assoc($resulGF)) {?>            
        <div>&nbsp;&nbsp;
            |F:<?php echo $filasGF ['gr_serienum']?> 
            |G:<?php echo $filasGF ['fact_cliente']?> 
            |B:<?php echo $filasGF ['gr_bultos']?> </div>
<?php } ?>

        </div>
        <div class="line"></div>        
        <div>&nbsp;&nbsp;➤ LLEGADA:
            |H:<?php $hora = $filasDE['h_llegadadestino'] ?? ''; echo substr($hora, 0, 5); ?>            
            |K:<?php echo $filasDE ['K_llegadadestino']?>
        </div>
        <div>&nbsp;&nbsp;➤ ENTREGA: 
            |H:<?php $hora = $filasDE['h_entrega'] ?? ''; echo substr($hora, 0, 5); ?>  
            |T:<?php echo $filasDE ['temp_entrega']?>
        </div>
        <div>
            &nbsp;&nbsp➤ ESPERA:  |<?php echo $filasDE ['t_espera']?><br>
            &nbsp;&nbsp➤  RECEPCION: |<?php echo $filasDE ['t_recepcion']?>
        </div>
        <div>&nbsp;&nbsp;➤ SALIDA:  |H: <?php $hora = $filasDE['h_salida'] ?? ''; echo substr($hora, 0, 5); ?> 
        <div>&nbsp;&nbsp;➤ OBS: <?php echo $filasDE ['obs_descarga']?></div>
<?php } ?>



<div class="separator ">==============================</div>
        <div class="bold">◉ RETORNO A BASE (Fin)</div>
        <div>
            |H:<?php $hora = $filasIF['HORA_LLEGADA_BASE'] ?? ''; echo substr($hora, 0, 5); ?>
            |T:<?php echo $filasIF ['TEMP_LLEGADA_BASE']?>
            |K:<?php echo $filasIF ['KM_LLEGADA_BASE']?>
        </div>
        <div class="bold">➤ RECORRIDO TOTAL:</div>
        <div>
            |H:<?php echo $filasIF ['hr_recorrido']?>            
            |K:<?php echo $filasIF ['km_recorrido']?>            
        </div>
<div class="separator ">==============================</div>

        <!-- Firmas de Control -->
<div style="text-align:center;"> 
        <div class="info-linea">V° B°</div>       
        <div class="section-title bold">FIRMAS DE CONTROL</div>
        <br><br>
        <div class="info-linea">______________________</div>
        <div class="info-linea">SUPERVISOR</div>
        <br><br>
        <div class="info-linea">______________________</div>
        <div class="info-linea">CONDUCTOR</div>
        <br><br>
        <!-- Código de barras -->

        <div class="center">
 <span class="icon-database"></span> P61R21 <br>         
 <canvas id="qr-code" class="qr-code"></canvas>
        </div>
</div>


        <div class="separator ">==============================</div>
    </div>
 </div>
 


  <div class="botones">
<a href="wt_panel_user.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>" class="btn btn-secondary btn-block custom-btn"> <span  class=" icon-folder-open "> </span></span>CERRAR</a>


    <a style="color: white;" type="button" href="repor_hofarm.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>" target="_blank" class="btn btn-danger  btn-block">
      <span class="icon-file-pdf"></span> PDF
    </a>

  </div>


<!-- Incluye la biblioteca JsBarcode -->
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>

   <!-- Generar el código QR -->
    <script>
        var qr = new QRious({
            element: document.getElementById('qr-code'),
            value: 'https://www.ejemplo.com', // URL a la que redirige
            size: 150,                        // Tamaño del QR
            level: 'H'                        // Nivel de corrección de errores (H es el más alto)
        });
                // Ajustar el tamaño para dar un efecto rectangular
        var canvas = document.getElementById('qr-code');
        canvas.style.width = '100px';   // Ancho del código QR
        canvas.style.height = '100px';  // Alto del código QR
    </script>
</body>

</html>





