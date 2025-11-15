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
<link rel="stylesheet" href="barraprogreso.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style> 

  .formula form, tbla{
    justify-content: center;
    align-items: center;
  }

    .formula  {

       padding: 10px;

        border: 1px solid #ccc;

        border-radius: 8px;

        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background: white;

}

    .formula form {
    display: flex;
    flex-wrap: wrap; 
        width: 100%;    

    }



  .formula  input, button {

    margin-right: 10px; /* Espacio entre los elementos */

        margin-bottom: 3px;

        padding: 10px;

        border: 1px solid #ccc;

        border-radius: 4px;

        box-sizing: border-box;

       

  }



  .formula  button {

height: 45px; /* Altura del botón */

  }



.tbla{

width: 100%;

    justify-content: center;

    align-items: center;

    

 

    

  }





</style>



<style>

    .container{
 width: 100%;
 margin-bottom: 10px;

    }





.info {

 

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

.pass {


padding: 10px;


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

      margin: 15px auto; /* Centrar el botón */

      border: 0px solid white; /* Borde gris claro */

      border-radius: 5px; /* Bordes redondeados */

      padding: 1px 20px; /* Espaciado interno */

    }



    .botones {

     

      border: 1px solid white; /* Borde gris claro */

      border-radius: 5px; /* Bordes redondeados */

      padding: 1px 30px; /* Espaciado interno */

      align-items: center; /* Alinea verticalmente */

    }





    .square-btn {

  width: 100px; /* Adjust size as needed */

margin: 5px;

  

  align-items: center; /* Alinea verticalmente */

}

   .ancho {

    width: 200px; /* Ancho al pasar el cursor */

    padding: .10rem;

    align-items: center; /* Alinea verticalmente */

  }

  .info p{

background: #008169;
color: white;
padding: 10px;
border-radius: 10px;
font-size: 10px;
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
$idd=$_GET['idd'];
?> 


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

    <div class="container_progreso">
    <div class="progress-bar">
    
    <div class="progress-line"></div>
    
    <a href="wt_prog_user.php" class="step ">
    <div class="step-circle">1</div>
    <div class="step-label">Órdenes</div>
    </a>
    
    <a href="wt_panel_user.php?idp=<?php echo $idp ?>" class="step ">
    <div class="step-circle">2</i></div>
    <div class="step-label">Base</div>
    </a>
    
    <a href="wt_ruta_ruta.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>" class="step">
    <div class="step-circle">3</div>
    <div class="step-label">Carga</div>
    </a>
    
    <a href="#" class="step active">
    <div class="step-circle"><i class="fa-solid fa-truck truck" id="truck"></i></div>
    <div class="step-label">Descarga</div>
    </a>
    </div>
    </div>
</div>




</div>    

<?php


$queryD="
SELECT *
FROM rd_descargas
WHERE id_descaga=$idd";
$resultD=mysqli_query($conexion, $queryD);
$filasD=mysqli_fetch_assoc($resultD);
?>


<br><br><br><br><br>

<div style="background-color: #d6d8db;">
    <div  style=" font-size: 15px;">
    <B><span class="icon-truck"></span> EN RUTA (Descargas)</B> <br>
    <span class="icon-database"></span> P<?php echo $idp?>R<?php echo $idr?>D<?php echo $idd?> 
    </div>
</div>




    <style>
        .modern-table {
            width: 100%;
            margin: auto;
            font-size: 10px;
            border-collapse: separate;
            border-spacing: 0 5px;
        }
        .modern-table th, .modern-table td {

            background: #ffffff;
            color: #495057;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .modern-table th {
            background-color:  #008169;
            color: white;
            text-align: center;
            box-shadow: none;
        }
        .modern-table td {
            border: none;
            background-color: #f8f9fa;
        }
        .modern-table tr + tr td {
            margin-top: 10px;
        }
    </style>

    <div class="container table-sm">
        <table class="table modern-table">
            <tbody>
                <tr>
                    <th>CLIENTE</th>
                    <td colspan="2" ><?php echo $filasD ['pe_cliente']?></td>
                </tr>
                <tr>
                    <th>DIRECCION</th>
                    <td><?php echo $filasD ['desg_direccion']?> - <?php echo $filasD ['desg_distrito']?></td>

<?php 
      // Obtener la dirección ingresada por el usuario
    $direccion = $filasD ['desg_direccion'] .' '. $filasD ['desg_distrito'];

    // Codificar la dirección para URL (espacios se convierten en %20, etc.)
    $direccionCodificada = urlencode($direccion);

    // Generar la URL de Google Maps
    $googleMapsUrl = "https://www.google.com/maps/search/?api=1&query=" . $direccionCodificada;
        // Redirigir a la URL de Google Maps
    //echo "<p>Haz clic en el enlace para ver la dirección en Google Maps:</p>";
    //echo "<a href='$googleMapsUrl' target='_blank'>$googleMapsUrl</a>";

    ?>


                    <td class="text-center"> <a class=" btn-sm btn-primary " style="color:white; " href='<?php echo $googleMapsUrl ?>' target='_blank'><i class="fas fa-map-marker-alt"></i></a> </td>

                </tr>
                <tr>
                  <style>
                              @keyframes blink {
            0% {
                background-color: white; /* Inicio de la animación: fondo blanco */
            }
            100% {
                background-color: yellow; /* Final de la animación: fondo amarillo */
            }
                  </style>  

                    <th>HORA CITA </th>
                <?php
                    if ($filasD ['hrcita']=='SI') {
                        ?>
                        <td colspan="2" style="animation: blink 1s infinite alternate;"><?php echo $filasD ['hrcita']?> [<?php echo $filasD ['hora_cita']?>]</td>  
                        <?php
                    } else {
                        ?>
                        <td colspan="2"><?php echo $filasD ['hrcita']?> [<?php echo $filasD ['hora_cita']?>]</td>   
                        <?php
                    }
                ?>                    
                    
                </tr>
                <tr>
                    <th>PRIORIDAD</th>
                <?php
                    if ($filasD ['prioridad']=='Urgente') {
                        ?>
                        <td colspan="2"  style="animation: blink 1s infinite alternate;"><?php echo $filasD ['prioridad']?></td>   
                        <?php
                    } else {
                        ?>
                        <td colspan="2"><?php echo $filasD ['prioridad']?></td>   
                        <?php
                    }
                ?>
                    
                </tr>
                <tr>
                    <th>TELEFONO</th>
                    <td ><?php echo $filasD ['cont_telf']?></td>
                    <td class="text-center"> <a class=" btn-sm btn-primary " style="color:white; " href='tel:<?php echo $filasD ['cont_telf']?>' target='_blank'><span class="icon-phone"></span></a> </td>
                </tr>                
                <tr>
                    <th>CONTACTO</th>
                    <td colspan="2"><?php echo $filasD ['contacto']?></td>
                </tr>

                <tr>
                    <th>OBSERVACION</th>
                    <td ><?php echo $filasD ['obs_descarga']?></td>
                     <td class="text-center"> <a class=" btn-sm btn-primary " style="color:white; " href='wt_ruta_desimg.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>&idd=<?php echo $idd ?>'><span class="icon-image"></span></a> </td>
                </tr>


            </tbody>
        </table>

<div class="dropdown-divider"></div>


<!-- SECCION DE DESCARGAS -->


<table class="table table-sm table-dark">

  <tbody>

    <tr>


          <div class="container text-center "style="background-color:white; padding: 10px;">

     <?php            
     if ($filasD ['desg_direccion'] === null ) {
          ?> 
            <a href="#rdescarga" class="btn btn-light" data-toggle="modal"> 
              <span class="icon-download2"></span>
              <br><span style="font-size: 8px;">REGISTRO</span>
            </a>
          <?php
     } else {
          ?> 
          <a href="#rdescarga" class="btn btn-primary" data-toggle="modal">
            <span class="icon-download2"></span>
            <br><span style="font-size: 8px;">ACTUALIZAR</span>
            <br><span style="font-size: 8px;">DESCARGA</span>
            </a>
          <?php

     }


     if ($filasD ['desg_grem'] === 'NO' ) {
          ?> 
        <a type="button" class="btn btn-light" href="#GUIAR" data-toggle="modal">
            <i class="icon-clipboard"></i>
            <br><span style="font-size: 8px;">REGISTRO</span>
            <br><span style="font-size: 8px;">GUIAS REM</span>
        </a>

          <?php
     } else {
          ?> 
          <a type="button" class="btn btn-primary" href="#GUIAR" data-toggle="modal">
            <i class="icon-clipboard"></i>
            <br><span style="font-size: 8px;">REGISTRO</span>
            <br><span style="font-size: 8px;">GUIAS REM</span>
            </a>

          <?php

     }


     $query2="
SELECT GUIA_TRANSP
FROM hruta
WHERE id_serv=$idr
                ";
     $result2=mysqli_query($conexion, $query2);
     $filas2=mysqli_fetch_assoc($result2);



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

 <!-- Botón para abrir el offcanvas -->     
          <a class="btn btn-sm btn-warning" type="button" data-toggle="modal" data-target="#modalGuias"> 
            <i class="fa-solid fa-file"></i> <br>
            <span>Solicitar</span><br>
            <span>G. Transporte</span>
          </a>

 
          <?php

     }


} 





     if ($filasD ['desg_foto'] === "NO" ) {
          ?> 
          <a href="#FOTOS" class="btn btn-light" data-toggle="modal"> 
            <span class="icon-image"></span>
            
          </a> 
          <?php
     } else {
          ?> 
            <a href="#FOTOS" class="btn btn-primary" data-toggle="modal">
          <span class="icon-image"></span> <br>
          <small><?php echo $filasD['desg_foto']?></small> 
          </a> 
          <?php

     }  
     ?>
          </div>
    </tr>
 </tbody>  
</table>





<!-- Modal -->
<div class="modal fade" id="modalGuias" tabindex="-1" role="dialog" aria-labelledby="modalGuiasLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalGuiasLabel">Solicitar Guías Remision Transportista</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm small" style="font-size: 0.65rem;">
                        <thead class="thead-dark">
                            <tr>
                                <th>CLIENTE</th>
                                <th>GUÍA REM</th>
                                <th>FACTURA</th>
                                <th>ACCIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Consulta para obtener los datos relacionados
                            $sql = "SELECT 
                                        rd.pe_cliente AS cliente,
                                        rd.desg_distrito AS distrito,
                                        gr.gr_serienum AS guia_remitente,
                                        gr.fact_cliente AS factura,
                                        gr.GUIA_TRANS AS GUIA_T,
                                        gr.id_guiar
                                    FROM guias_remitente gr
                                    INNER JOIN rd_descargas rd ON gr.id_desg = rd.id_descaga
                                    WHERE gr.id_desg = ?
                                    ORDER BY rd.pe_cliente";
                            
                            $stmt = $conexion->prepare($sql);
                            $stmt->bind_param("i", $idd);
                            $stmt->execute();
                            $resultado = $stmt->get_result();
                            
                            if ($resultado->num_rows > 0) {
                                while ($fila = $resultado->fetch_assoc()) {
                                    // Determinar el color del botón según el estado
                                    $estado = strtolower(trim($fila['GUIA_T']));
                                    $colorBoton = 'btn-secondary'; // Color por defecto
                                    
                                    if ($estado == 'pendiente') {
                                        $colorBoton = 'btn-success';
                                    } elseif ($estado == 'solicitado') {
                                        $colorBoton = 'btn-warning';
                                    } elseif ($estado == 'emitido') {
                                        $colorBoton = 'btn-primary';
                                    }
                                    
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($fila['cliente']) . "<br><small class='text-muted'>" . htmlspecialchars($fila['distrito']) . "</small></td>";
                                    echo "<td>" . htmlspecialchars($fila['guia_remitente']) . "</td>";
                                    echo "<td>" . htmlspecialchars($fila['factura']) . "</td>";
                                    echo "<td>
                                            <button class='btn btn-sm " . $colorBoton . " btn-solicitar' 
                                                    data-id='" . $fila['id_guiar'] . "'
                                                    data-estado='" . htmlspecialchars($fila['GUIA_T']) . "'>
                                                " . htmlspecialchars(ucfirst($fila['GUIA_T'])) . "
                                            </button>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center'>No hay guías para esta ruta</td></tr>";
                            }
                            
                            $stmt->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Script para manejar el botón Solicitar -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-solicitar')) {
            const btn = e.target;
            const idGuia = btn.getAttribute('data-id');
            const estadoActual = btn.getAttribute('data-estado').toLowerCase().trim();

            // Si no está pendiente, solo ignoramos el click (sin alert)
            if (estadoActual !== 'pendiente') {
                return;
            }

            // Sin confirm, se solicita directo
            fetch('crud_guiarem/procesar_solicitud.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id_guiar=' + encodeURIComponent(idGuia) + '&accion=solicitar'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    btn.textContent = 'Solicitado';
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-warning');
                    btn.setAttribute('data-estado', 'solicitado');
                    // Sin alert, solo cambio visual
                } else {
                    alert('Error al procesar la solicitud: ' + (data.error || 'Error desconocido'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error en la conexión');
            });
        }
    });
});
</script>








<table class="table table-sm table-dark">

  <tbody>
    <tr>
          <div class=" text-center "style="background-color:white; padding-bottom: 15px;padding-top: 15px;">

     <?php            
     if ($filasD ['h_llegadadestino'] === null ) {
          ?> 
            <a href="./crud_descargas/update2.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&idd=<?php echo $idd?>&i=6" class="btn btn-light "> 
              <span class="icon-clock2"></span>
              <br><span style="font-size: 8px;">LLEGADA</span>
            </a>
          <?php
     } else {
          ?> 
          <a href="#h_llegadadestino" class="btn btn-primary btn-sm" data-toggle="modal">
            <span class="icon-clock2"></span>
            <br><small><?php echo date("H:i", strtotime($filasD['h_llegadadestino']))?></small>
            <br><span style="font-size: 8px;">LLEGADA</span>
            </a>
          <?php

     }
          if ($filasD ['K_llegadadestino'] === null ) {
          ?> 
            <a href="./crud_descargas/update2.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&idd=<?php echo $idd?>&i=5" class="btn btn-light"> 
              <span class="icon-road"></span>
              <br><span style="font-size: 8px;">KMH</span>
              </a>
          <?php
     } else {
          ?> 
          <a href="#k_llegadadestino" class="btn btn-warning btn-sm" data-toggle="modal">
              <span class="icon-road"></span>
              <br><small><?php echo $filasD['K_llegadadestino']?></small>
              <br><span style="font-size: 8px;">KMH</span>
              </a>
          <?php

     }

     if ($filasD ['h_entrega'] === null ) {
          ?> 
            <a href="./crud_descargas/update2.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&idd=<?php echo $idd?>&i=7" class="btn btn-light"> 
              <span class="icon-clock2"></span>
              <br><span style="font-size: 8px;">ENTREGA</span>
            </a>
          <?php
     } else {
          ?> 
          <a href="#h_entrega" class="btn btn-primary btn-sm" data-toggle="modal">
            <span class="icon-clock2"></span>
            <br><small><?php echo date("H:i", strtotime($filasD['h_entrega']))?></small>
            <br><span style="font-size: 8px;">ENTREGA</span>
            </a>

          <?php

     }

     if ($filasD ['temp_entrega'] === null ) {
          ?> 
            <a href="./crud_descargas/update2.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&idd=<?php echo $idd?>&i=8" class="btn btn-light"> 
              <span class="icon-text-height"></span>
              <br><span style="font-size: 8px;">TEMP</span>
              </a>
          <?php
     } else {
          ?> 
          <a href="#temp_entrega" class="btn btn-danger btn-sm" data-toggle="modal">
              <span class="icon-text-height"></span>
              <br><small><?php echo $filasD['temp_entrega']?></small>
              <br><span style="font-size: 8px;">TEMP</span>
              </a>
          <?php

     }


if ($filasD ['h_entrega'] != null and $filasD ['h_llegadadestino'] != null) {

         if ( $filasD ['h_salida'] === null ) {
              ?> 
                <a href="./crud_descargas/update2.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&idd=<?php echo $idd?>&i=9" class="btn btn-light"> 
                  <span class="icon-clock2"></span>
                  <br><span style="font-size: 8px;">SALIDA</span>
                </a>
              <?php
         } else {
              ?> 
              <a href="#h_salida" class="btn btn-primary btn-sm" data-toggle="modal">
                <span class="icon-clock2"></span>
                <br><small><?php echo date("H:i", strtotime($filasD['h_salida']))?></small>
                <br><span style="font-size: 8px;">SALIDA</span>
                </a>
              <?php

         }
    
} else {

}

     

     if ($filasD ['WT_ENVIO_D'] === 'NO' ) {
          ?> 
          <a href="./crud_descargas/update2.php?idp=<?php echo $idp?>&idd=<?php echo $idd?>&idr=<?php echo $idr?>&i=10" class="btn btn-light" target="_blank"> 
           <span class="icon-whatsapp"></span>
           </a>
          <?php
     } else {
          ?> 
          <a  href="./crud_mensajes/msj_descarga.php?idd=<?php echo $idd?> " target="_blank"  class="btn btn-success btn-sm" data-toggle="modal"> 
           <span class="icon-whatsapp"></span><br>
           <small style="font-size: 10px;" >Reporte</small> <br>
           <small style="font-size: 10px;" >Enviado</small>
           </a>
          <?php

     }






     ?>



          </div>

    </tr>

 </tbody>  
</table>



<br>



<div class="dropdown-divider"></div>
<a href="wt_ruta_ruta.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>"  class="btn btn-secondary btn-block " > <span  class=" icon-folder-open "> </span></span>CERRAR</a>
</div>
<br>

<div class="dropdown-divider"></div>





<div class="modal" tabindex="-1" role="dialog" id="GUIAR">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> <i class="icon-clipboard"></i>  REGISTRO DE GUIAS REMITENTE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
  <div style="justify-content: center;  display: flex;">


    <form action="crud_guiarem/create.php" method="POST">

     <input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>
     <input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>  
     <input class="form-control"  type="hidden" id="idd" name="idd" value="<?php echo $idd ; ?> " readonly> 
<div class="form-group text-center">     
        <input  type="text" name="guias" id="guias" placeholder="GUIA: TG00-000" required>
</div>
<div class="form-group text-center">  
        <input  type="text" name="factura" id="factura" placeholder="FACTURA: FG00-000" required>
</div>        
<div class="form-group text-center">  
        <input class="bult" type="number" name="bustos" id="bustos" placeholder="Cantidad de Bultos" required>
</div>        
<div class="form-group text-center">  
        <input class="bult" type="text" name="gr_obs" id="gr_obs" placeholder="Observacion">
</div>


        <div class="dropdown-divider"></div>
        <button id="guardar" name="guardar" type="submit" class="btn btn-success btn-block">  
         REGISTRAR
        </button>
 </form>
        


</div>
<div class="dropdown-divider"></div>

<?php
$queryG="
SELECT *
FROM guias_remitente
WHERE id_desg=$idd";
$resultG=mysqli_query($conexion, $queryG);
?>
<div class="tbla">
    <table class="table table-sm tbla ">
  <thead >
    <tr>
      <th>GUIA </th>
      <th>FACTURA</th>
      <th>BULTOS</th>
      <th></th>
    </tr>
  </thead>
  <tbody>


  <?php while($filasG=mysqli_fetch_assoc($resultG)) { ?> 
  
    <tr>
      <td>G: <?php echo $filasG ['gr_serienum']?></td>
      <td>F: <?php echo $filasG ['fact_cliente']?></td>
      <td><?php echo $filasG ['gr_bultos']?> Bultos</td>
      <td><a href="crud_guiarem/delete.php?idp=<?php echo $idp; ?>&idr=<?php echo $idr;?>&idd=<?php echo $idd;?>&id=<?php echo $filasG ['id_guiar'];?>" style="color: red;"><span class=" icon-bin "></span></a></td>
       
    </tr>
    <tr>
      <td><?php echo $filasG ['gr_obs']?></td>  

    </tr>
    
   <?php } ?>
  </tbody>
</table>
</div> 

      </div>
    </div>
  </div>
</div>



<div class="modal" tabindex="-1" role="dialog" id="rdescarga">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> <i class="icon-download2"></i> REGISTRO DE ENTREGA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<div class="dropdown-divider"></div>


<table  >
  <form action="crud_descargas/update.php" method="POST">
<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>
<input class="form-control"  type="hidden" id="idd" name="idd" value="<?php echo $idd ; ?> " readonly>
    <tr>
        <td>CLIENTE</td>
        <td><input class="ancho" type="text" id="pe_cliente" name="pe_cliente" value="<?php echo $filasD ['pe_cliente']?>" required></td>
    </tr>
    <tr>
        <td>DIRECCION</td>
        <td><input class="ancho" type="text" id="desg_direccion" name="desg_direccion" value="<?php echo $filasD ['desg_direccion']?>" required></td>
    </tr>

    <tr>
        <td>DISTRITO</td>
        <td><input class="ancho" type="text" id="desg_distrito" name="desg_distrito" value="<?php echo $filasD ['desg_distrito']?>" required></td>
    </tr>
    <tr>
        <td>CON H. CITA</td>      

        <td>
    <select class="ancho"   id="hrcita" name="hrcita" required>
    <option selected> <?php echo $filasD ['hrcita']?> </option>
    <option value="SI" > SI </option>
    <option value="NO" > NO </option>     
    </select> 
        </td>
    </tr>

    <tr>
        <td>HORA CITA</td>
        <td><input class="ancho" type="time" id="hora_cita" name="hora_cita" value="<?php echo $filasD ['hora_cita']?>" ></td>          

    </tr>

    <tr>
        <td>PRIORIDAD</td>
        <td>
    <select class="ancho"   id="prioridad" name="prioridad" required>
    <option selected> <?php echo $filasD ['prioridad']?> </option> 
    <option value="Normal" > Normal </option>
    <option value="Urgente" > Urgente </option>       
    </select> 
        </td>

    <tr>
        <td>CONTACTO</td>
        <td><input class="ancho" type="text" id="contacto" name="contacto" value="<?php echo $filasD ['contacto']?>" ></td>          

    </tr>

        <tr>
        <td>TELEFONO</td>
        <td><input class="ancho" type="text" id="cont_telf" name="cont_telf" value="<?php echo $filasD ['cont_telf']?>" ></td>          

    </tr>

    <tr>
        <td>OBSERVACION</td>
        <td><input class="ancho" id="obs_descarga" name="obs_descarga" value="<?php echo $filasD ['obs_descarga']?>"></input></td>
    </tr>
</table>      
<div class="dropdown-divider"></div>
<br>
        <button id="guardar" name="guardar" type="submit" class="btn btn-success btn-block">      
         ACTUALIZAR
        </button>
</form>
 

        
      </div>
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
<input class="form-control"  type="hidden" id="tipo" name="tipo" value="DESCARGA" readonly>
<input class="form-control"  type="hidden" id="Redirigir" name="Redirigir" value="ruta_descargas" readonly>
<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly> 
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>
<input class="form-control"  type="hidden" id="idd" name="idd" value="<?php echo $idd ; ?> " readonly>   
<div class="form-group">
        <label for="head_imagen">Imagen: </label>

<!-- Input oculto -->
<input type="file" 
       class="form-control d-none" 
       id="head_imagen" 
       name="head_imagen" 
       accept="image/*">

<!-- Botones con Bootstrap -->
<div class="d-flex gap-2 border rounded p-3">
  <button type="button" class="btn btn-success" onclick="openCameraIng()">
    <i class="bi bi-camera-fill"></i> Cámara
  </button>
  
  <button type="button" class="btn btn-primary" onclick="openGalleryIng()">
    <i class="bi bi-folder2-open"></i> Galería
  </button>
</div>

<!-- Opcional: Mostrar nombre del archivo seleccionado -->
<small id="file-name-ing" class="text-muted mt-2 d-block"></small>

<script>
  const fileInputIng = document.getElementById('head_imagen');
  const fileNameIng = document.getElementById('file-name-ing');
  
  function openCameraIng() {
    fileInputIng.setAttribute('capture', 'environment');
    fileInputIng.click();
  }
  
  function openGalleryIng() {
    fileInputIng.removeAttribute('capture');
    fileInputIng.click();
  }
  
  fileInputIng.addEventListener('change', function() {
    if (this.files && this.files[0]) {
      fileNameIng.textContent = '📎 ' + this.files[0].name;
    }
  });
</script>



        <label for="head_imagen">Descripción : </label>
        <input class="form-control" type="txt" id="ALCANCE" name="ALCANCE" required>
    </div>

      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">GUARDAR</button>
</form>
        
      </div>
    </div>
  </div>
</div>




<?php

     $query7="
SELECT *
FROM update2
WHERE tipo='d'
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
  
<form  action="crud_descargas/update3.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>
<input class="form-control"  type="hidden" id="idd" name="idd" value="<?php echo $idd ; ?> " readonly>
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
WHERE tipo='e'
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
  
<form  action="crud_descargas/update3.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>
<input class="form-control"  type="hidden" id="idd" name="idd" value="<?php echo $idd ; ?> " readonly>
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
  
<form  action="crud_descargas/update2.php" method="GET" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>
<input class="form-control"  type="hidden" id="idd" name="idd" value="<?php echo $idd ; ?> " readonly>
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




<!-- jQuery primero -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

<!-- Popper ANTES de Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

<!-- Bootstrap al final -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>


</body>
</html>


