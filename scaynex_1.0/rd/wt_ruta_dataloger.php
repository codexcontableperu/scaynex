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
    width: 60px; /* Ajusta el tamaño de los iconos según sea necesario */

    border-radius: 10px; /* Bordes redondeados de 20px */
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
$id=$_GET['id'];
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
        <a class="boton noselec " href="wt_panel_user.php?idp=<?php echo $idp ?>"><i class="fas fa-map-marker-alt"></i> BASE</a>
        &nbsp &nbsp 
        <a class="boton  noselec" href="wt_ruta_ruta.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>"><i class="fas fa-map-marker-alt"></i> CARGA</a>
        &nbsp &nbsp 
        <a class="boton  selec" href=""><i class="fas fa-map-marker-alt"></i>DATALOGER</a>
    </div>
 </div>

<br><br><br><br><br>
 
<div style="padding: 15px; background: white;">

        <?php 
          $queryDL="SELECT * FROM rd_dataloger WHERE ID_SERV=$idr";
          $resultDL=mysqli_query($conexion, $queryDL);
        ?>

        <?php while($filasDL=mysqli_fetch_assoc($resultDL)) { ?>
<div style="display: inline-block; font-size:12px">
  <a href="wt_ruta_dataloger.php?id=<?php echo $filasDL['id_dt']; ?>&idp=<?php echo $idp; ?>&idr=<?php echo $idr; ?>"> <img  src="img/dataloger.jpg" ></a>
  <br><span><b>C:</b><?php echo htmlspecialchars($filasDL['dt_codigo']); ?></span>
  <br><span><b>G:</b><?php echo htmlspecialchars($filasDL['dt_guia']); ?></span>
  <br><span><b>F:</b><?php echo htmlspecialchars($filasDL['dt_factura']); ?></span>

</div>

        <?php } ?>



</div>
<br>


<?php 
          $queryData="SELECT * FROM rd_dataloger WHERE id_dt=$id";
          $resultData=mysqli_query($conexion, $queryData);
          $filasData=mysqli_fetch_assoc($resultData)
?>

<?php 

if (!is_null($filasData) && isset($filasData['id_dt'])) {
    // Accede al valor si no es null y existe el índice
   ?> 
   <div style="text-align: center;"> 
<form action="crud_dataloger/update.php" method="POST">
          <table class="table table-sm">
            <tbody>
              <input type="hidden" class="form-control" id="idr" name="idr" value="<?php echo htmlspecialchars($idr); ?>">
              <input type="hidden" class="form-control" id="idp" name="idp" value="<?php echo htmlspecialchars($idp); ?>">
              <input type="hidden" class="form-control" id="id_dt" name="id_dt" value="<?php echo htmlspecialchars($id); ?>">              
              <tr>
                <th>FECHA</th>
                <td>
                  <input type="date" class="ancho" id="dt_fecha" name="dt_fecha" value="<?php echo htmlspecialchars($filasData['dt_fecha']); ?>" required>
                </td>
              </tr>
              <tr>
                <th>CUENTA</th>
                <td>
                  <input type="text" class="ancho" id="dt_cuenta" name="dt_cuenta" value="<?php echo htmlspecialchars($filasData['dt_cuenta']); ?>" required>
                </td>
              </tr>
              <tr>
                <th>CLIENTE</th>
                <td>
                  <input type="text" class="ancho" id="dt_cliente" name="dt_cliente" value="<?php echo htmlspecialchars($filasData['dt_cliente']); ?>" required>
                </td>
              </tr>
              <tr>
                <th>GUIA</th>
                <td>
                  <input type="text" class="ancho" id="dt_guia" name="dt_guia" value="<?php echo htmlspecialchars($filasData['dt_guia']); ?>" required>
                </td>
              </tr>
              <tr>
                <th>FACTURA</th>
                <td>
                  <input type="text" class="ancho" id="dt_factura" name="dt_factura" value="<?php echo htmlspecialchars($filasData['dt_factura']); ?>" required>
                </td>
              </tr>
              <tr>
                <th>CODIGO</th>
                <td>
                  <input type="text" class="ancho" id="dt_codigo" name="dt_codigo" value="<?php echo htmlspecialchars($filasData['dt_codigo']); ?>" required>
                </td>
              </tr>
              <tr>
                <th>CANTIDAD</th>
                <td>
                  <input type="number" class="ancho" id="dt_cantidad" name="dt_cantidad" value="<?php echo htmlspecialchars($filasData['dt_cantidad']); ?>" required>
                </td>
              </tr>
              <tr>
                <th>PLACA</th>
                <td>
                  <input class="ancho" list="PLACAS" type="text" id="dt_placa" name="dt_placa" value="<?php echo htmlspecialchars($filasData['dt_placa']); ?>" placeholder="Placa" required>
                  <datalist id="PLACAS">
                    <option selected  ><?php echo $filasData['dt_placa'] ?></option>
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
          <button id="guardar" name="guardar" type="submit" class="btn btn-primary btn-block">ACTUALIZAR</button>
        </form>
<br>
<a class="btn btn-danger btn-block" href="crud_dataloger/delete.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>&id_dt=<?php echo $id ?>"> ELIMINAR</a>
<a class="btn btn-dark btn-block" href="wt_ruta_ruta.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>"> CERRAR</a>

</div>
   <?php 
} else {
    // Manejar el caso en que el valor sea null
    echo "Selecione DATALOGER";
}
?>







<?php include('includes/footer.php'); ?>

