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
  width: 100px; /* Adjust size as needed */
margin: 5px;
  
  align-items: center; /* Alinea verticalmente */
}
   .ancho {
    width: 230px; /* Ancho al pasar el cursor */
    padding: .10rem;
    align-items: center; /* Alinea verticalmente */
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
        <a class="boton  selec" href=""><i class="fas fa-map-marker-alt"></i> IMAGENES</a></a>
    </div>

<?php


$queryo="


SELECT rd_servicio.*, rd_servicio.Id_SERG, hruta.id_ruta, rd_segimientos_head.S_FECHA
FROM (rd_servicio INNER JOIN hruta ON rd_servicio.Id_SERG = hruta.id_prog) INNER JOIN rd_segimientos_head ON rd_servicio.Id_SERG = rd_segimientos_head.Id_SERG
WHERE (((rd_servicio.ID_SERV )=$idr));


";
$resulto=mysqli_query($conexion, $queryo);
$filaso=mysqli_fetch_assoc($resulto);


?>
<br>

<div >
    <div  style=" font-size: 15px;">
    <B><span class="icon-truck"></span> IMAGENES </B> <br>
    <span class="icon-database"></span> <?php echo $filaso ['S_FECHA']?>-P<?php echo $idp?>R<?php echo $idr?> 
    </div>

</div>

<div style="color:white; padding: 10px;">
    <a  data-target="#FOTOS"  data-toggle="modal" class="btn btn-block btn-success"> SUBIR IMAGEN</a>
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
    }

    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    .close {
        position: absolute;
        top: 15px;
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

<div>INICIO PARTIDA</div>
<?php
// Consulta para obtener datos de la tabla rd_fotos
$query2 = "
SELECT * FROM rd_fotos
WHERE Id_SERG='$idp' AND TIPO='PARTIDA'
";
$result2 = mysqli_query($conexion, $query2);

if ($result2 && mysqli_num_rows($result2) > 0) { // Verifica si hay resultados
?>
    <div class="galeriafoto">
        <div class="gallery">
            <?php while ($filas2 = mysqli_fetch_assoc($result2)) { ?>
                <div class="gallery-item">
                    <!-- Botón con Icono de Eliminar -->
                    <a style="color: red;" href="crud_fotos/deleteimg.php?id=<?php echo $filas2['ID_FOTO']; ?>&R=4">
                        <i class="fas fa-trash-alt"></i> 
                    </a>                    
                    <img src="../panel/<?php echo $filas2['IMG']; ?>" alt="Imagen" onclick="openModal(this.src)">
                    <div style="font-size: 12px;">
                        <label><?php echo $filas2['ALCANCE']; ?></label> 
                    </div>                  
                </div>
            <?php } ?>
        </div>
    </div>
<?php
} else {
    echo "No se encontraron imágenes de partida.";
}
?>

<div>EN RUTA</div>
<?php
// Consulta para obtener datos de la tabla rd_fotos
$query = "
SELECT * FROM rd_fotos
WHERE ID_SERV='$idr' AND Id_SERG='$idp'
";
$result = mysqli_query($conexion, $query);

if ($result && mysqli_num_rows($result) > 0) { // Verifica si hay resultados
?>
    <div class="galeriafoto">
        <div class="gallery">
            <?php while ($filas = mysqli_fetch_assoc($result)) { ?>
                <div class="gallery-item">
                    <!-- Botón con Icono de Eliminar -->
                    <a style="color: red;" href="crud_fotos/deleteimg.php?id=<?php echo $filas['ID_FOTO']; ?>&R=4">
                        <i class="fas fa-trash-alt"></i> 
                    </a>                    
                    <img src="../panel/<?php echo $filas['IMG']; ?>" alt="Imagen" onclick="openModal(this.src)">
                    <div style="font-size: 12px;">
                        <label><?php echo $filas['ALCANCE']; ?></label> 
                    </div>                  
                </div>
            <?php } ?>
        </div>
    </div>
<?php
} else {
    echo "No se encontraron imágenes en ruta.";
}
?>

<div>FIN RETORNO</div>
<?php
// Consulta para obtener datos de la tabla rd_fotos
$query2 = "
SELECT * FROM rd_fotos
WHERE Id_SERG='$idp' AND TIPO='RETORNO'
";
$result2 = mysqli_query($conexion, $query2);

if ($result2 && mysqli_num_rows($result2) > 0) { // Verifica si hay resultados
?>
    <div class="galeriafoto">
        <div class="gallery">
            <?php while ($filas2 = mysqli_fetch_assoc($result2)) { ?>
                <div class="gallery-item">
                    <!-- Botón con Icono de Eliminar -->
                    <a style="color: red;" href="crud_fotos/deleteimg.php?id=<?php echo $filas2['ID_FOTO']; ?>&R=4">
                        <i class="fas fa-trash-alt"></i> 
                    </a>                    
                    <img src="../panel/<?php echo $filas2['IMG']; ?>" alt="Imagen" onclick="openModal(this.src)">
                    <div style="font-size: 12px;">
                        <label><?php echo $filas2['ALCANCE']; ?></label> 
                    </div>                  
                </div>
            <?php } ?>
        </div>
    </div>
<?php
} else {
    echo "No se encontraron imágenes de retorno.";
}
?>








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
<input class="form-control"  type="hidden" id="Redirigir" name="Redirigir" value="wt_images" readonly>
<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly> 
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>
 <input class="form-control"  type="hidden" id="idd" name="idd" value="" readonly> 
<div class="form-group">
        <label for="head_imagen">Imagen: </label>
        <input class="form-control" type="file" id="head_imagen" name="head_imagen" accept="image/*" required>

        <label for="tipo">Tipo: </label>
        <select id="tipo" name="tipo" class="form-control" required>
            <option value="" disabled selected></option>
            <option value="PARTIDA">PARTIDA</option>
            <option value="CARGA">CARGA</option>
            <option value="DESCARGA">DESCARGA</option>
            <option value="RETORNO">RETORNO</option>
        </select>

        <label for="head_imagen">Descripción : </label>
        <input class="form-control" type="txt" id="ALCANCE" name="ALCANCE"  required>
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

