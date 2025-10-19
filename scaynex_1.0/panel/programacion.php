<?php include('includes/session1.php'); ?>
<?php include("../data/conexion.php"); ?>
<!DOCTYPE html>

<html style="font-size: 16px;">
<!-- Mirrored from website726460.nicepage.io/es/Contact.html?version=c99f6d58-dbb4-4080-9506-a3a93b2be7f2 by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Feb 2024 16:54:43 GMT -->
<head>
            <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="main.css"> 

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Subscribe Now">
    <meta name="description" content>
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>App-Scaynex</title>
    <link rel="stylesheet" href="stylos/nicepage6168.css?version=6a9bdefb-4bc9-4812-9536-5d51bd2eb046" media="screen">
    <script class="u-script" type="text/javascript" src="js_login/jquery-1.9.1.min.js" defer></script>
    <script class="u-script" type="text/javascript" src="js_login/nicepage.js" defer></script>
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alata:400">
    <link rel="stylesheet" href="stylos/mimenu.css" media="screen">

    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Contact">
    <meta property="og:type" content="website">

<?php include('includes/ffecha.php'); ?>   

    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Contact">
    <meta property="og:type" content="website">
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


    .containerl {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap; /* Asegura que los elementos se adapten si hay poco espacio */

    }
    .box {
      display: flex;
      align-items: center;
      margin: 5px;
      flex: 1 1 90px; /* Se ajusta el ancho mínimo a 100px para pantallas pequeñas */
      max-width: 150px; /* Para que no ocupen demasiado en pantallas grandes */
    }
    .square {
      width: 20px;
      height: 20px;
      margin-right: 10px;
    }
    .black {
      background-color: black;
    }
    .blue {
      background-color: blue;
    }
    .white {
      background-color: #eeeeee;
    }
    .green {
      background-color: green;
    }  
    .yellow {
      background-color:  #ffd700;
    }

    .text {
      font-size: 10px;
      color: #000;
    }

    /* Media query para pantallas pequeñas */
    @media (max-width: 385px) {
      .container {
        justify-content: center; /* Centra los elementos en pantallas pequeñas */
      }
      .box {
        flex: 1 1 80px; /* Ajusta el ancho mínimo en pantallas muy pequeñas */
        max-width: 100px; /* Limita el tamaño máximo del elemento */
        margin: 5px; /* Reduce el margen en pantallas pequeñas */
      }
      .text {
        font-size: 12px; /* Reduce el tamaño de la fuente en pantallas pequeñas */
      }
    }

</style>


















</head>
  <body class="u-body">

<?php include('includes/headerPan.php'); ?>

<?php
if (isset($_POST['f'])) {
    $fecha = $_POST['f'];
    $_SESSION['fechaw'] = $fecha;
    $FECHAW = $_SESSION['fechaw'];
} elseif (isset($_GET['f'])) {
    $fecha = $_GET['f'];
    $_SESSION['fechaw'] = $fecha;
    $FECHAW = $_SESSION['fechaw'];
} else {
    $fecha = $hoy;
    $_SESSION['fechaw'] = $fecha;
    $FECHAW = $_SESSION['fechaw'];
}



try {
    // Crear un objeto DateTime con la fecha proporcionada
    $date = new DateTime($fecha);
    
    // Establecer la localización para nombres de días y meses en español
    $fmt = new IntlDateFormatter(
        'es_ES',
        IntlDateFormatter::FULL,
        IntlDateFormatter::NONE,
        'America/Lima',
        IntlDateFormatter::GREGORIAN,
        'EEEE d ' . "de" . ' MMMM ' . "de" . ' yyyy'
    );
    
    // Formatear la fecha
    $newDate = $fmt->format($date);

    //echo utf8_encode($newDate); // Output: jueves 22 de febrero 2024
} catch (Exception $e) {
    // Manejar cualquier excepción que pueda ocurrir
    echo 'Error al procesar la fecha: ' . $e->getMessage();
}
?>




<div class="card text-center">
    <B><h6>
    <span class="icon-truck"></span>  PROGRAMACION DE UNIDADES <br> <?php echo $fecha ?>
    </B></h6>
</div>

<div class="dropdown-divider"></div> 

  <div class="containerl">

    <div class="box">
      <div class="square black"></div>
      <span class="text">Salida Base</span>
    </div>
    <div class="box">
      <div class="square green"></div>
      <span class="text">Almacen</span>
    </div>    
    <div class="box">
      <div class="square yellow"></div>
      <span class="text">En Ruta</span>
    </div>
    <div class="box">
      <div class="square blue"></div>
      <span class="text">Fin Servicio</span>
    </div>

  </div>

<div class="dropdown-divider"></div> 

 

<div class="container p-3" style="background: #f0f0f0;"> <!-- Fondo gris claro -->
    <form action="programacion.php" method="POST" class="form-inline row justify-content-center" style="text-align: center;">
        <!-- Campo de fecha -->
        <div class="col-auto">
            <label for="f" class="sr-only">Fecha</label>
            <input type="date" class="form-control nv" id="f" name="f" placeholder="DD/MM/AA" 
                   value="<?php echo isset($fecha) ? $fecha : ''; ?>">
        </div>

        <!-- Botón de búsqueda -->
        <div class="col-auto">
            <button type="submit" class="btn btn-primary nv">
                <span class="icon-search"></span> Buscar
            </button>
            <a class="btn nv" type="button" data-toggle="modal" data-target="#elimina" style="color: red; font-size: 17px;">  <span class=" icon-bin "></span></a>
        </div>




    </form>
</div>






<?php 
$queryCL="
SELECT rd_segimientos_head.S_FECHA, rd_segimientos_head.ID_CLIENTE
FROM rd_segimientos_head
GROUP BY rd_segimientos_head.S_FECHA, rd_segimientos_head.ID_CLIENTE
HAVING (((rd_segimientos_head.S_FECHA)='$fecha'));
";
$resultCL=mysqli_query($conexion, $queryCL);

 ?>

 <table class="table">

  <tbody style="font-size: 14px">
    

    <?php while($filasCL=mysqli_fetch_assoc($resultCL)) { $CL = $filasCL ['ID_CLIENTE'] ?>
<tr> 

<td style="padding: 25px ;text-align: left; white-space: nowrap">
    <span class="icon-checkbox-checked"> </span> <?php echo $CL  ?>
</td>

    
<td style="padding:0px">
  
   <?php 
$queryX="
SELECT rd_segimientos_head.Id_SERG, rd_segimientos_head.S_FECHA, rd_segimientos_head.PLACA, rd_segimientos_head.ID_CLIENTE, rd_segimientos_head.ESTADO_IDP
FROM rd_segimientos_head
WHERE (((rd_segimientos_head.S_FECHA)='$fecha') AND ((rd_segimientos_head.ID_CLIENTE)='$CL'));
";
$resultX=mysqli_query($conexion, $queryX);

 ?>
<?php while($filasX=mysqli_fetch_assoc($resultX)) { 

    $EST = $filasX ['ESTADO_IDP'];
switch ($EST) {
        case 0:
?><a href="prog_edit.php?id=<?php echo $filasX ['Id_SERG']  ?>" class="btn btn-light btn-sm" style="margin: 3px; color: black;width: 100px;"> <span class="icon-truck"></span> <?php echo $filasX ['PLACA']  ?> </a> <?php
        break;
    case 1:
?><a href="prog_edit.php?id=<?php echo $filasX ['Id_SERG']  ?>" class="btn btn-dark btn-sm" style="margin: 3px; color: white;width: 100px;"> <span class="icon-truck"></span> <?php echo $filasX ['PLACA']  ?> </a> <?php
        break;
    case 2:
?><a href="prog_edit.php?id=<?php echo $filasX ['Id_SERG']  ?>" class="btn btn-success btn-sm" style="margin: 3px; color: white;width: 100px;"> <span class="icon-truck"></span> <?php echo $filasX ['PLACA']  ?> </a> <?php
        break;
    case 3:
?><a href="prog_edit.php?id=<?php echo $filasX ['Id_SERG']  ?>" class="btn btn-warning btn-sm" style="margin: 3px; color: white;width: 100px;"> <span class="icon-truck"></span> <?php echo $filasX ['PLACA']  ?> </a> <?php
        break;            
    default:
?><a href="prog_edit.php?id=<?php echo $filasX ['Id_SERG']  ?>" class="btn btn-primary btn-sm" style="margin: 3px; color: white;width: 100px;"> <span class="icon-truck"></span> <?php echo $filasX ['PLACA']  ?> </a> <?php
        break;
}

}
?>



    



</td>

</tr>



   <?php } ?>

    

  </tbody>
</table>


<div class="dropdown-divider"></div> 


    <a style="color: white;" href="repo_prog.php?f=<?php echo $fecha ?>" target="_blank" class="btn btn-danger btn-block ">
      <span class="icon-printer"></span> PDF
    </a>



<div class="dropdown-divider"></div> 



    <style>
        /* Estilos para el botón flotante */
        .btn-flotante {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

        .btn-flotante:hover {
            background-color: #0056b3;
        }
    </style>





<!-- Botón flotante -->
    <a href="#nuevo_p" class="btn-flotante" data-toggle="modal" data-target="#nuevo_p">
        <span class="icon-plus"></span>
    </a>










<!-- Modal -->
<div class="modal fade" id="elimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ELIMINAR PROGRAMACION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
<?php 
$queryDEL="

SELECT rd_segimientos_head.Id_SERG, rd_segimientos_head.PLACA, rd_segimientos_head.S_FECHA
FROM rd_segimientos_head
WHERE (((rd_segimientos_head.S_FECHA)='$fecha'));

";
$resultDEL=mysqli_query($conexion, $queryDEL);

 ?>

    

    <?php while($filasDEL=mysqli_fetch_assoc($resultDEL)) { ?>

<a href="crud_programacion/delete_uno.php?id=<?php echo $filasDEL['Id_SERG']; ?>&f=<?php echo $fecha; ?>" class="btn btn-danger btn-sm" style="margin: 3px; color: white; width: 100px;">
    <span class="icon-truck"></span> <?php echo $filasDEL['PLACA']; ?>
</a>

   <?php } ?>

    


      </div>
      <div class="modal-footer">
        <a href="crud_programacion/delete_todo.php?f=<?php echo $fecha  ?>" type="button" class="btn btn-danger" >ELIMINAR TODO</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>

      </div>
    </div>
  </div>
</div>












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
<div class="modal fade" id="nuevo_p" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">NUEVA PROGRAMACION </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <a style="color: white;" type="button" data-toggle="modal" data-target="#HRUTA" class="btn btn-primary btn-block ">
      <span class="icon-plus"></span> NUEVO MANUAL
    </a>    
    <a style="color: white;" type="button" data-toggle="modal" data-target="#nuevod" class="btn btn-success btn-block ">
      <span class="icon-plus"></span> NUEVO PLACA 
    </a>
    <a style="color: white;" type="button" data-toggle="modal" data-target="#nuevo_pll" class="btn btn-warning btn-block ">
      <span class="icon-plus"></span> CON PLANTILLA
    </a>
    <a style="color: white;" type="button" data-toggle="modal" data-target="#nuevoM" class="btn btn-info btn-block ">
      <span class="icon-plus"></span> UNIDAD A MANTENIMIENTO 
    </a>
    <a style="color: white;" type="button" data-toggle="modal" data-target="#gpt" class="btn btn-dark btn-block ">
      <span class="icon-plus"></span> CON GPT
    </a>

      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-outline-dark" href="plantilla_read.php"  ><span class="icon-clipboard "></span> Plantilla</a>
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
<div class="modal fade" id="nuevoM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">UNIDAD A MANTENIMIENTO</h5>
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


<button type="submit" id="mantenimiento" name="mantenimiento" class="btn btn-primary btn-lg btn-block ">REGISTRAR </button>

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



<!-- Modal -->
<div class="modal fade" id="gpt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">GENERAR PROGRAMACIONES </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
<form action="crud_programacion/createSQL.php" method="POST">
<input class="form-control"  type="hidden" id="S_USER" name="S_USER" value="<?php echo $id_userup ; ?> " readonly>
  <div class="form-group">
    <label for="S_FECHA">FECHA:</label>
    <input type="date" class="form-control" id="S_FECHA" name="S_FECHA" placeholder="FECHA" value='<?php echo $hoyfor ; ?>'>
  
  </div>
  <div class="form-group">
    <label for="CODIGO">CODIGO SQL:</label>
  <textarea class="form-control" id="CODIGO" name="CODIGO" rows="3" placeholder="Ingresar CODIGO..."></textarea>
  </div>
<button type="submit" id="guardar" name="guardar" class="btn btn-dark btn-lg btn-block ">GENERAR</button>
</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>

      </div>
    </div>
  </div>
</div>











    
<footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-53ac"><div class="u-clearfix u-sheet u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">

        </p>
      </div></footer>
    <section class="u-backlink u-clearfix u-grey-80">
      <a class="u-link" href="https://nicepage.com/website-templates" target="_blank">
        <span>  Aplicativo web - whatsaap</span>
      </a>
      <p class="u-text">
        <span> - </span>
      </p>
      <a class="u-link" href="https://nicepage.com/" target="_blank">
        <span>Website codex</span>
      </a>. 
    </section>





<!-- Modal nuevo servicio + nueva ruta-->
<div class="modal fade" id="HRUTA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">NUEVA PROGRAMACION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">


      <table class="table table-sm table-bordered">
  <form action="crud_programacion/create_mn.php" method="POST">
  <tbody>    

<input type="hidden"  class="form-control" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> "  >

 <tr>
      <th >FECHA</th>
      <td >
 <?php $fecha_formateada = date('Y-m-d', strtotime($fecha)); ?>       
        <input type="date" class="ancho" id="S_FECHA" name="S_FECHA" value="<?php echo $fecha_formateada; ?>">


      </td>
</tr>


    <tr>
      <th >EPS</th>
      <td >
    <select class="ancho"   id="EPS" name="EPS" >
    <option selected > </option>
    <option value="JSA LLANOS" > JSA LLANOS </option>
    <option value="JS GREGORI" > JS GREGORI </option>     
    </select>         
      </td>

</tr>
 <tr>

      <th >PLACA</th>
      <td>
 <input class="ancho"  list="PLACAS" type="text" id="PLACA" name="PLACA"  placeholder="Placa " required>

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
          </select>         

      </td>
      </tr>
 <tr>
      <th >CONDUCTOR</th>
      <td >
          <select type="text" id="CONDUCTOR" name="CONDUCTOR" class="ancho">
          <option selected >   </option>
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

          <option selected > </option>

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
          <option selected >  </option>
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
          <option selected >    </option>

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
<input  type="text" class=" ancho" id="SUPERVISOR" name="SUPERVISOR"  required>  
      </td>
</tr>


 <tr>
      <th >CLIENTE</th>
      <td >
          <input class="ancho"  list="ID_CLIENTE" type="text" id="ID_CLIENTE" name="ID_CLIENTE" placeholder="Cliente" required>
        <datalist id="ID_CLIENTE" >  
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
      <th >EMPRESA TERCERO</th>
      <td >
<input  type="text" class=" ancho" id="EMPRESA" name="EMPRESA" required> 
      </td>

</tr>
 <tr>
      <th >SERVICIO</th>
      <td >
<input  type="text" class=" ancho" id="SERVICIOS" name="SERVICIOS" required> 
      </td>

</tr>

<tr>
      <th >ATENCIÓN</th>
      <td >
    <select class="ancho"   id="TIPO_DESPACHO" name="TIPO_DESPACHO" >
    <option selected > </option>
    <option value="Exclusivo" > Exclusivo</option>
    <option value="Compsrtido" > Compartido </option> 
    </select>         
      </td>

</tr>
 <tr>
      <th style="vertical-align: middle;" >OBSERVACION</th>
      <td >

<textarea class="form-control" id="OBS_PROG" name="OBS_PROG" rows="2" placeholder="Ingresar observaciones..."></textarea>
      </td>

</tr>

<tr>
<td colspan="2">
       <div class="dropdown-divider"></div>
        <div class="form-row">
             <div class="col">
                <label for="H_CITA">HCITA - BASE</label>
                <input  type="time" class="form-control" id="H_CITA" name="H_CITA" >
            </div>
            <div class="col">
                <label for="H_CITA_R">HCITA - RECOJO</label>
                <input  type="time" class="form-control" id="H_CITA_R" name="H_CITA_R" >
            </div>
            <div class="col">
                <label for="RESGUARDO">RESGUARDO</label>
                <select class="custom-select" id="RESGUARDO" name="RESGUARDO" >
                <option selected > </option>
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















  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>