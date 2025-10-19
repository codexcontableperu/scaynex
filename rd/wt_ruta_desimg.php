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

    <div id="second-header" style="font-size: 14px">
        <img src="whatsaap/user-icon.png" alt="Usuario" id="user-icon">
        <a class="boton bton noselec" href="wt_prog_user.php?dni=<?php  echo $dni_user ; ?> ">Ordenes</a>
        &nbsp &nbsp 
        <a class="boton noselec " href="wt_panel_user.php?idp=<?php echo $idp ?>"><i class="fas fa-map-marker-alt"></i> BASE</a></a>
        &nbsp &nbsp 
        <a class="boton  noselec" href="wt_ruta_ruta.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>"><i class="fas fa-map-marker-alt"></i> CARGA</a>
        &nbsp &nbsp 
        <a class="boton  selec" href="wt_ruta_descargas.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>&idd=<?php echo $idd ?>"><i class="fas fa-map-marker-alt"></i>DESCARGA</a></a>
    </div>
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


<br><br>   

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


<div class="formula" >

<h4 class="text-center"><i class="icon-images"></i> Cargar Imagenes</h4>


<form  action="crud_fotos/createimg.php" method="POST" enctype="multipart/form-data" class="colm">
<input class="form-control"  type="hidden" id="tipo" name="tipo" value="DESCARGA" readonly>
<input class="form-control"  type="hidden" id="Redirigir" name="Redirigir" value="ruta_desimg" readonly>
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
        height: 150px; /* Altura fija para todas las imágenes */
        object-fit: cover; /* Asegura que la imagen se ajuste bien al contenedor */
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

    /* Estilo para la imagen a pantalla completa */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.9);
        padding-top: 120px; /* Margen superior para la ventana modal */
    }

    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    .close {
        position: absolute;
        top: 130px; /* Margen superior para el botón de cierre */
        right: 35px;
        color: #fff;
        font-size: 40px;
        font-weight: bold;
        z-index: 2; /* Asegura que el botón de cierre esté por encima de la imagen */
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
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

<div class="modal" id="myModal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="img01">
</div>

<script>
    function openModal(src) {
        var modal = document.getElementById("myModal");
        var modalImg = document.getElementById("img01");
        modal.style.display = "block";
        modalImg.src = src;
    }

    function closeModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }
</script>

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
                <a style="color: red;" href="crud_inicio_fin/deleteimg.php?id=<?php echo $filas['ID_FOTO']; ?>">
                    <i class="fas fa-trash-alt"></i> 
                </a>                    
                <img src="../panel/<?php echo $filas['IMG']; ?>" alt="Imagen" onclick="openModal(this.src)">
                <br><span> &nbsp &nbsp<?php echo $filas['ALCANCE']; ?></span>                    
            </div>
        <?php } ?>
    </div>
</div>


<br><br><br>



<div class="dropdown-divider"></div>
<a href="wt_ruta_descargas.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>&idd=<?php echo $idd ?>"  class="btn btn-secondary btn-block " > <span  class=" icon-folder-open "> </span></span>CERRAR</a>
</div>
<br>


<div class="dropdown-divider"></div>


<?php include('includes/footer.php'); ?>

