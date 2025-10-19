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
      margin: 10px;
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
    .green {
      background-color: green;
    }
    .text {
      font-size: 12px;
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
if (isset($_GET['id'])) {
  $idp = $_GET['id'];
}
?>

<div class="dropdown-divider"></div> 



      <div style="text-align: center;">
<?php        

$queryo="
SELECT *
FROM rd_segimientos_head
WHERE Id_SERG='$idp'
";

$resulto=mysqli_query($conexion, $queryo);
$filaso=mysqli_fetch_assoc($resulto);
$PLACA = $filaso ['PLACA'];
$S_FECHA =$filaso ['S_FECHA']; 
?>



<div class="card text-center">
    <B><h6>
    <span class="icon-truck"></span>  PROGRAMACION  <?php echo $filaso ['PLACA'];?> <br> <?php echo $S_FECHA ?>
    </B></h6>
</div>




      <table class="table table-sm ">
  <form action="crud_programacion/update_mn.php" method="POST">
  <tbody>    
<input type="hidden"  class="form-control" id="S_FECHA" name="S_FECHA" value="<?php echo  $S_FECHA ?>" >
<input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="<?php echo $idp ?>" >
<input type="hidden"  class="form-control" id="S_USER" name="S_USER" value="<?php echo $id_userup ?>" >
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
      <th >CLIENTE</th>
      <td >
<input  type="text" class=" ancho" id="ID_CLIENTE" name="ID_CLIENTE" value="<?php echo $filaso ['ID_CLIENTE'];?>" required> 
      </td>
</tr>


 <tr>
      <th >CUENTA</th>
      <td >
<input  type="text" class=" ancho" id="CUENTA" name="CUENTA" value="<?php echo $filaso ['CUENTA'];?>" >  
      </td>
</tr>

 <tr>
      <th >EMPRESA TERCERO</th>
      <td >
<input  type="text" class=" ancho" id="EMPRESA" name="EMPRESA" value="<?php echo $filaso ['EMPRESA'];?>" > 
      </td>
</tr>



 <tr>
      <th >SERVICIO</th>
      <td >
<input  type="text" class=" ancho" id="SERVICIOS" name="SERVICIOS" value="<?php echo $filaso ['SERVICIOS'];?>" > 
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

<textarea class="form-control" id="OBS_PROG" name="OBS_PROG" rows="2" placeholder="Ingresar observaciones..."><?php echo $filaso['OBS_PROG']; ?></textarea>
      </td>

</tr>


<tr>
<td colspan="2">


       <div class="dropdown-divider"></div>




        <div class="form-row">

             <div class="col">

                <label for="H_CITA">HCITA - BASE</label>

                <input  type="time" class="form-control" id="H_CITA" name="H_CITA" value="<?php echo $filaso ['H_CITA']  ?>" >

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

       

        <button id="guardar" name="guardar" type="submit" class="btn btn-primary btn-block">   
         ACTUALIZAR
        </button>



</form>

      </div>

<br>
        <a href="programacion.php?f=<?php echo $filaso ['S_FECHA'] ?>" class="btn btn-dark btn-block">
          CERRAR
        </a>


<br><br>

<?php

$queryoX="

SELECT S_FECHA, ID_CLIENTE, PLACA, Id_SERG
FROM rd_segimientos_head
WHERE PLACA='$PLACA'  AND PENDIENTE = 1;

";
$resultoX=mysqli_query($conexion, $queryoX);




?>

<style>
.titu {

  align-items: center;
  text-align: center;
}




</style>

<div class="titu" >
  <h5>Programaciones Activas</h5>

</div>


<div class="botones">
<div class="container text-center">
  <div class="row">
    <div class="col">

<?php while($filasoX=mysqli_fetch_assoc($resultoX)) { ?>
        <a class="btn btn-lg btn-dark square-btn" style="color: white; " href="../rd/wt_panel_user.php?idp=<?php echo $filasoX ['Id_SERG']?>">
        <span class="icon-truck"></span><br>
        <?php echo $filasoX ['PLACA']?><br>
        <span style="font-size: 13px;"><?php echo $filasoX ['ID_CLIENTE']?></span>
        <br>
        <span style="font-size: 13px;"><?php echo $filasoX ['S_FECHA']?></span>
        </a>
<?php } ?>

    </div>
  </div>
</div>
</div>



  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>