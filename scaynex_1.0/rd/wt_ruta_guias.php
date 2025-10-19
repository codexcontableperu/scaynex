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

        width: 100%;

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

    width: 100px; /* Ancho al pasar el cursor */

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

</style>
<?php
$idp=$_GET['idp'];
$idr=$_GET['idr'];
$idd=$_GET['idd'];
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

    <div id="second-header" style="font-size: 14px">
        <img src="whatsaap/user-icon.png" alt="Usuario" id="user-icon">
        <a class="boton bton noselec" href="wt_prog_user.php?dni=<?php  echo $dni_user ; ?> ">Ordenes</a>
        &nbsp &nbsp 
        <a class="boton noselec " href="wt_panel_user.php?idp=<?php echo $idp ?>"><i class="fas fa-map-marker-alt"></i> BASE</a></a>
        &nbsp &nbsp 
        <a class="boton  noselec" href="wt_ruta_ruta.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>"><i class="fas fa-map-marker-alt"></i> CARGA</a>
        &nbsp &nbsp 
        <a class="boton  selec" href=""><i class="fas fa-map-marker-alt"></i>DESCARGA</a></a>
    </div>
    

<?php


$queryD="
SELECT *
FROM rd_descargas
WHERE (((rd_descargas.id_hruta)=$idr) AND ((rd_descargas.id_descaga)=$idd))";
$resultD=mysqli_query($conexion, $queryD);
$filasD=mysqli_fetch_assoc($resultD);
?>
<style>
        .btn-xs {
            padding: 0.25rem 0.5rem;
            font-size: 0.90rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }
    </style>
<br>

<div style="background-color: #d6d8db;">
    <div  style=" font-size: 15px;">
    <B><span class="icon-truck"></span> EN RUTA (Descargas)</B> <br>
    <span class="icon-database"></span> P<?php echo $idp?>R<?php echo $idr?>D<?php echo $idd?> 
    </div>
</div>



    <style>
        .cajaboton {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px; /* Espacio entre los botones */
            margin: 20px 0;
        }
        .button-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .button-item .btn {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;

        }
        .button-item .btn i {
            font-size: 30px;
        }
        .button-item .button-label {
            font-size: 14px;
        }
    </style>
<br><br>

<div class="cajaboton">
    <div class="button-item">
        <a type="button" class="btn btn-primary" href="#GUIAR" data-toggle="modal">
            <i class="icon-clipboard"></i>
        </a>
        <span class="button-label">GUIAS</span>
    </div>
    <div class="button-item">
        <a type="button" class="btn btn-secondary" href="#rdescarga" data-toggle="modal">
            <i class="icon-download2"></i>
        </a>
        <span class="button-label">ENTREGA</span>
    </div>
    <div class="button-item">
        <a type="button" class="btn btn-success"  href="#FOTOS" data-toggle="modal">
            <i class="icon-images"></i>
        </a>
        <span class="button-label">IMAGENES</span>
    </div>
</div>

<div class="dropdown-divider"></div>

<!-- SECCION DE DESCARGAS -->


<table class="table table-sm table-dark">

  <tbody>
 
     <tr>&nbsp<span class="icon-road"></span>&nbspdescarga 1</tr>

    <tr>


          <div class="container text-center "style="background-color:white; padding: 10px;">

     <?php            
     if ($filasD ['h_llegadadestino'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=5" class="btn btn-light"> 
              <span class="icon-download2"></span>
              <br><span style="font-size: 8px;">REGISTRO</span>
            </a>
          <?php
     } else {
          ?> 
          <a href="#h_salidaorigen" class="btn btn-primary" data-toggle="modal">
            <span class="icon-download2"></span>
            <br><span style="font-size: 8px;">REGISTRO</span>
            </a>
          <?php

     }

     if ($filasD ['h_entrega'] === null ) {
          ?> 
        <a type="button" class="btn btn-primary" href="#GUIAR" data-toggle="modal">
            <i class="icon-clipboard"></i>
            <br><span style="font-size: 8px;">GUIAS REM</span>
        </a>

          <?php
     } else {
          ?> 
          <a type="button" class="btn btn-primary" href="#GUIAR" data-toggle="modal">
            <i class="icon-clipboard"></i>
            <br><span style="font-size: 8px;">GUIAS REM</span>
            </a>

          <?php

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


<table class="table table-sm table-dark">

  <tbody>
    <tr>
          <div class="container text-center "style="background-color:white; padding: 10px;">

     <?php            
     if ($filasD ['h_llegadadestino'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=5" class="btn btn-light"> 
              <span class="icon-clock2"></span>
              <br><span style="font-size: 8px;">LLEGADA</span>
            </a>
          <?php
     } else {
          ?> 
          <a href="#h_salidaorigen" class="btn btn-primary" data-toggle="modal">
            <span class="icon-clock2"></span>
            <br><small><?php echo date("H:i", strtotime($filasD['h_llegadadestino']))?></small>
            <br><span style="font-size: 8px;">LLEGADA</span>
            </a>
          <?php

     }

     if ($filasD ['h_entrega'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=5" class="btn btn-light"> 
              <span class="icon-clock2"></span>
              <br><span style="font-size: 8px;">ENTREGA</span>
            </a>
          <?php
     } else {
          ?> 
          <a href="#h_entrega" class="btn btn-primary" data-toggle="modal">
            <span class="icon-clock2"></span>
            <br><small><?php echo date("H:i", strtotime($filasD['h_entrega']))?></small>
            <br><span style="font-size: 8px;">ENTREGA</span>
            </a>

          <?php

     }

     if ($filasD ['t_entrega'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=55" class="btn btn-light"> 
              <span class="icon-text-height"></span>
              <br><span style="font-size: 8px;">TEMPERATURA</span>
              </a>
          <?php
     } else {
          ?> 
          <a href="#t_salidaorigen" class="btn btn-danger" data-toggle="modal">
              <span class="icon-text-height"></span>
              <br><small><?php echo $filasD['t_entrega']?></small>
              <br><span style="font-size: 8px;">TEMP</span>
              </a>
          <?php

     }

     if ($filasD ['h_salida'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=5" class="btn btn-light"> 
              <span class="icon-clock2"></span>
              <br><span style="font-size: 8px;">SALIDA</span>
            </a>
          <?php
     } else {
          ?> 
          <a href="#h_salida" class="btn btn-primary" data-toggle="modal">
            <span class="icon-clock2"></span>
            <br><small><?php echo date("H:i", strtotime($filasD['h_salida']))?></small>
            <br><span style="font-size: 8px;">SALIDA</span>
            </a>
          <?php

     }

     

     if ($filasD ['WT_ENVIO_D'] === 'NO' ) {
          ?> 
          <a href="./crud_inicio_fin/updateIF.php?idp=<?php echo $idp?>&i=1" class="btn btn-light" target="_blank"> 
           <span class="icon-whatsapp"></span>
           </a>
          <?php
     } else {
          ?> 
          <a  href="./crud_mensajes/msj_inicio.php?idp=<?php echo $idp?> " target="_blank"  class="btn btn-success" data-toggle="modal"> 
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



<br><br><br>



<div class="dropdown-divider"></div>
<a href="wt_ruta_ruta.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>"  class="btn btn-secondary btn-block " > <span  class=" icon-folder-open "> </span></span>CERRAR</a>
</div>
<br>

<div class="dropdown-divider"></div>


<div class="formula">
  
  <h4 class="text-center"><i class="icon-clipboard"></i> Guias de Remision / Facturas</h4>
  <div class="dropdown-divider"></div>
    <form action="crud_guiarem/create.php" method="POST">
     <input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>
     <input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>  
     <input class="form-control"  type="hidden" id="idd" name="idd" value="<?php echo $idd ; ?> " readonly> 
        <input  type="text" name="guias" id="guias" placeholder="GUIA: TG00-000" required>
        <input  type="text" name="factura" id="factura" placeholder="FACTURA: FG00-000" required>
        <input class="bult" type="number" name="bustos" id="bustos" placeholder="Cantidad de Bultos" required>
        <input class="bult" type="text" name="gr_obs" id="gr_obs" placeholder="Observacion">
        <button id="guardar" name="guardar" type="submit" class="btn btn-success btn-sm">  
         GUARDAR
        </button>
    </form>

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
<div class="dropdown-divider"></div>

<br>

<br>

<div class="formula" >

<h4 class="text-center"><i class="icon-download2"></i> Punto de Entrega </h4>
<div class="dropdown-divider"></div>
<div>
  <span class="icon-truck"> </span>
  &nbsp  IDP <?php echo $idp?> IDR <?php echo $idr?> IDD <?php echo $idd?>


<br><br>



<table class="table table-sm " >

  <form action="crud_descargas/update.php" method="POST">

<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>

<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>

<input class="form-control"  type="hidden" id="idd" name="idd" value="<?php echo $idd ; ?> " readonly>



    <tr>

        <td>P.E. CLIENTE</td>

        <td><input class="ancho" type="text" id="pe_cliente" name="pe_cliente" value="<?php echo $filasD ['pe_cliente']?>" required></td>

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

        <td>PRIORIDAD</td>

        <td>

    <select class="ancho"   id="prioridad" name="prioridad" required>

    <option selected> <?php echo $filasD ['prioridad']?> </option>  

    <option value="Normal" > Normal </option>

    <option value="Urgente" > Urgente </option>         

    </select> 

        </td>

    </tr>

        <tr>

        <td>HORA DE LLEGADA</td>

        <td><input class="ancho" type="time" id="h_llegadadestino" name="h_llegadadestino" value="<?php echo $filasD ['h_llegadadestino']?>" required></td>

    </tr>

    <tr>

        <td>HORA DE ENTREGA</td>

        <td><input class="ancho" type="time" id="h_entrega" name="h_entrega" value="<?php echo $filasD ['h_entrega']?>" required></td>

    </tr>

    <tr>

        <td>TEMPERATURA °C</td>

        <td><input class="ancho" type="text" name="t_entrega" id="t_entrega" value="<?php echo $filasD ['t_entrega']?>" required></td>

    </tr>

    <tr>

        <td>HORA DE SALIDA</td>

        <td><input class="ancho" type="time" name="h_salida" id="h_salida" value="<?php echo $filasD ['h_salida']?>" required></td>

    </tr>

    <tr>

        <td>OBSERVACION</td>

        <td><input class="ancho" id="obs_descarga" name="obs_descarga" value="<?php echo $filasD ['obs_descarga']?>"></input></td>

    </tr>

</table>

       

        <button id="guardar" name="guardar" type="submit" class="btn btn-success btn-block">

        

         ACTUALIZAR

        </button>



</form>

</div>
</div>
<br>
<div class="dropdown-divider"></div>

<br>


<div class="formula" >

<h4 class="text-center"><i class="icon-images"></i> Cargar Imagenes</h4>
<div class="dropdown-divider"></div>

<form  action="crud_inicio_fin/createimg.php" method="POST" enctype="multipart/form-data" class="colm">
<input class="form-control"  type="hidden" id="tipo" name="tipo" value="PARTIDA" readonly>
<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly> 
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>
<input class="form-control"  type="hidden" id="idd" name="idd" value="<?php echo $idd ; ?> " readonly>    <div class="form-group">
        <label for="head_imagen">Imagen: </label>
        <input class="form-control" type="file" id="head_imagen" name="head_imagen" accept="image/*" required>
        <label for="head_imagen">Descripción : </label>
        <input class="form-control" type="txt" id="ALCANCE" name="ALCANCE" required>
    </div>

      <div class="modal-footer">
        <button id="guardar" name="guardar" type="submit" class="btn btn-success btn-block">       
         GUARDAR
        </button>
      </div>  
</form>


</div>



<div class="dropdown-divider"></div>


<style>
    
        .galeriafoto {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            background-color: #f0f0f0;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); /* Tamaño más pequeño */
            gap: 10px;
            width: 90%;
            max-width: 1200px;
        }

        .gallery img {
            width: 100%;
            height: auto;
            border-radius: 10px; /* Bordes redondeados */
            transition: transform 0.3s ease;
        }

        .gallery img:hover {
            transform: scale(1.05); /* Efecto de zoom al pasar el ratón */
        }

        .gallery-item {
            overflow: hidden;
            border-radius: 10px; /* Bordes redondeados en el contenedor */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra para efecto 3D */
        }

        @media (max-width: 768px) {
            .gallery {
                grid-template-columns: repeat(auto-fit, minmax(100px, 1fr)); /* Tamaño aún más pequeño para móviles */
            }
        }

        @media (max-width: 480px) {
            .gallery {
                grid-template-columns: repeat(auto-fit, minmax(80px, 1fr)); /* Tamaño más pequeño en pantallas muy pequeñas */
            }

            .gallery img {
                border-radius: 5px; /* Bordes redondeados más pequeños */
            }
        }
 
</style>


<?php
// Consulta para obtener datos de la tabla rd_fotos
$query = "
SELECT rd_fotos.*, rd_fotos.ID_DESG AS idd
FROM rd_fotos
WHERE (((rd_fotos.ID_DESG)='$idd'));

";
$result = mysqli_query($conexion, $query);
?>


    <div class="galeriafoto">
        <div class="gallery">
            <?php while ($filas = mysqli_fetch_assoc($result)) { ?>
                <div class="gallery-item">
                        <!-- Botón con Icono de Eliminar -->
                        <a style="color: red; " href="crud_inicio_fin/deleteimg.php?id=<?php echo $filas['ID_FOTO']; ?>">
                            <i class="fas fa-trash-alt"></i> 
                        </a>                    
                    <img src="../panel/<?php echo $filas['IMG']; ?>" alt="Imagen">                    
                </div>

            <?php } ?>
        </div>
    </div>



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
        <button id="guardar" name="guardar" type="submit" class="btn btn-success btn-sm">  
         REGISTRAR
        </button>
 </form>
        
   

</div>
<div class="dropdown-divider"></div>



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
        <td>P.E. CLIENTE</td>
        <td><input class="ancho" type="text" id="pe_cliente" name="pe_cliente" value="<?php echo $filasD ['pe_cliente']?>" required></td>
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
        <td>PRIORIDAD</td>
        <td>
    <select class="ancho"   id="prioridad" name="prioridad" required>
    <option selected> <?php echo $filasD ['prioridad']?> </option> 
    <option value="Normal" > Normal </option>
    <option value="Urgente" > Urgente </option>       
    </select> 
        </td>
    </tr>
        <tr>
        <td>HORA DE LLEGADA</td>
        <td><input class="ancho" type="time" id="h_llegadadestino" name="h_llegadadestino" value="<?php echo $filasD ['h_llegadadestino']?>" required></td>
    </tr>
    <tr>
        <td>HORA DE ENTREGA</td>
        <td><input class="ancho" type="time" id="h_entrega" name="h_entrega" value="<?php echo $filasD ['h_entrega']?>" required></td>
    </tr>
    <tr>
        <td>TEMPERATURA °C</td>
        <td><input class="ancho" type="text" name="t_entrega" id="t_entrega" value="<?php echo $filasD ['t_entrega']?>" required></td>
    </tr>
    <tr>
        <td>HORA DE SALIDA</td>
        <td><input class="ancho" type="time" name="h_salida" id="h_salida" value="<?php echo $filasD ['h_salida']?>" required></td>
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
  
<form  action="crud_inicio_fin/createimg.php" method="POST" enctype="multipart/form-data" class="colm">
<input class="form-control"  type="hidden" id="tipo" name="tipo" value="DESCARGA" readonly>
<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly> 
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>
<input class="form-control"  type="hidden" id="idd" name="idd" value="<?php echo $idd ; ?> " readonly>   
<div class="form-group">
        <label for="head_imagen">Imagen: </label>
        <input class="form-control" type="file" id="head_imagen" name="head_imagen" accept="image/*" required>
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



<?php include('includes/footer.php'); ?>

