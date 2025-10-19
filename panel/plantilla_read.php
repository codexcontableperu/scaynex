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


a {

    text-decoration: none; /* Eliminar el subrayado, si también deseas quitarlo */

    color: black;

}





</style>


















</head>
  <body class="u-body">

<?php include('includes/headerPan.php'); ?>


<?php
$tabla = 'rd_segimientos_pll';
  // Crear la consulta
  $query = "SELECT * FROM $tabla ";
  $result = mysqli_query($conexion, $query);

?>

<div class="dropdown-divider"></div> 


<div class="container">
  <div class="row">
    <div class="col-sm">
      <div class="form-container d-flex align-items-center justify-content-between">      
        <h5>PLANTILLA DE PROGRAMACION</h5>
        <a style="color: white;" type="button" data-toggle="modal" data-target="#nuevo" class="btn btn-success mb-2 nv">
          <span class="icon-plus"></span> NUEVO
        </a>
      </div>
    </div>
  </div>
</div>

    <style>
        .table-container {
            width: 100%;
            overflow-x: auto;
        }
        .table {
            width: 100px; /* Ajusta el ancho según sea necesario */
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            background-color: #f2f2f2;
        }




 .ancho:hover {
    width: 300px; /* Ancho al pasar el cursor */
    padding: .10rem;
    align-items: center; /* Alinea verticalmente */
}



    </style>


<div class="dropdown-divider"></div> 




<table id="example" class="table-container table-dark table-sm">
  <thead  class="thead-dark">
    <tr>
      <th scope="col">EMPRESA_PS</th>  
      <th scope="col">PLACA</th> 
      <th scope="col">TIPO-VH</th>          
      <th scope="col">CONDUCTOR</th>
      <th scope="col">AUXILIAR(1)</th>
      <th scope="col">AUXILIAR(2)</th>
      <th scope="col">AUXILIAR(3)</th>
      <th scope="col">CLIENTE</th>
      <th scope="col">SERVICIOS</th>
      <th scope="col">H BASE</th>
      <th scope="col"> OPCIONES </th>
    </tr>
  </thead>
  <tbody>
 
      <?php while($filas=mysqli_fetch_assoc($result)) { ?>
<form action="crud_plantillas/update.php" method="POST">
     
      <tr>       
      <td>
<input type="hidden" class="form-control" id="ID_PLL" name="ID_PLL" value="<?php echo $filas ['Id_pll']  ?>" >

    <select class="custom-select" id="EPS" name="EPS" >
    <option selected value="<?php echo $filas ['EPS']  ?>"> <?php echo $filas ['EPS']  ?></option>
    <option value="JSA LLANOS" > JSA LLANOS </option>
    <option value="JS GREGORI" > JS GREGORI </option>         
    </select>
         
      </td>
        <td >
          <input st class="form-control " list="PLACAS" type="text" id="PLACA" name="PLACA" value='<?php echo $filas ['PLACA'];?>' required>
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

<td>

       <input class="form-control ancho" list="temp" type="text" id="TEMPERATURA" name="TEMPERATURA" value='<?php echo $filas ['TEMPERATURA'];?>' >

          <datalist id="temp" >  
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
          </datalist>

</td>


        <td style="text-align:left;">
          
          <input class="form-control ancho" list="NOMBRES" type="text" id="CONDUCTOR" name="CONDUCTOR" value='<?php echo $filas ['CONDUCTOR'];?>' >
          <datalist id="NOMBRES" >  
          <option selected ></option>
              <?php               

                $queryP="SELECT user_nombre, user_disponible FROM usuarios WHERE user_disponible ='si' ";
                $resultP=mysqli_query($conexion, $queryP);
              ?>
              <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
                
          <option value="<?php echo $filasP ['user_nombre']?>" >
          </option>
          <?php } ?>
          </datalist>

        </td>
      <td style="text-align:left;">
        
          <input class="form-control ancho" list="AUX1" type="text" id="AUXILIAR1" name="AUXILIAR1" value='<?php echo $filas ['AUXILIAR1'];?>' >
          <datalist id="AUX1" >  
          <option selected ></option>
              <?php 
                $queryP="SELECT user_nombre, user_disponible FROM usuarios WHERE user_disponible ='si'";
                $resultP=mysqli_query($conexion, $queryP);
              ?>
              <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
                
          <option value="<?php echo $filasP ['user_nombre']?>" >
          </option>
          <?php } ?>
          </datalist>        

      </td>
      <td style="text-align:left;">

          <input class="form-control ancho" list="AUX2" type="text" id="AUXILIAR2" name="AUXILIAR2" value='<?php echo $filas ['AUXILIAR2'];?>' >
          <datalist id="AUX2" >  
          <option selected ></option>
              <?php 
                $queryP="SELECT user_nombre, user_disponible FROM usuarios WHERE user_disponible ='si'";
                $resultP=mysqli_query($conexion, $queryP);
              ?>
              <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
                
          <option value="<?php echo $filasP ['user_nombre']?>" >
          </option>
          <?php } ?>
          </datalist>         

      </td>
      <td style="text-align:left;">
       
          <input class="form-control ancho" list="AUX3" type="text" id="AUXILIAR3" name="AUXILIAR3" value='<?php echo $filas ['AUXILIAR3'];?>' >
          <datalist id="AUX3" >  
          <option selected ></option>
              <?php 
                $queryP="SELECT user_nombre, user_disponible FROM usuarios WHERE user_disponible ='si' ";
                $resultP=mysqli_query($conexion, $queryP);
              ?>
              <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
                
          <option value="<?php echo $filasP ['user_nombre']?>" >
          </option>
          <?php } ?>
          </datalist>         

      </td>
      <td>
        
      <input value="<?php echo $filas ['ID_CLIENTE']; ?>" class="form-control" list="CLIENTES" type="text" id="CLIENTE" name="CLIENTE" >
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

      <td>
       <input type="text" class="form-control ancho" id="SERVICIOS" name="SERVICIOS" value="<?php echo $filas ['SERVICIOS']  ?>" >   
      </td>

      <td>
        <input type="times" class="form-control" id="HCITA" name="HCITA" value="<?php echo $filas ['H_CITA']  ?>" >
        
      </td> 

      <td>
          <a onclick="return confirmLink()" href="crud_plantillas/delete.php?id=<?php echo $filas ['Id_pll']?>" class="btn btn-danger btn-sm"> 
          <span class="icon-bin"></span>
          </a>
    <button type="submit" id="guardar" name="guardar" class="btn btn-primary btn-sm "><span class=" icon-floppy-disk "></span></button>
       </td>                 
      </tr>
</form> 
    <?php } ?>
  
  </tbody>
</table>






<!-- Modal -->
<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">NUEVO REGISTRO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
<form action="crud_plantillas/create.php" method="POST">

    <div class="form-group">
    <label for="EPS">EMPRESA </label>
    <select class="custom-select" id="EPS" name="EPS" >
    <option selected > </option>
    <option value="JSA LLANOS" > JSA LLANOS </option>
    <option value="JS GREGORI" > JS GREGORI </option>         
    </select>
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

 <div class="form-group">
  <label for="CONDUCTOR">CONDUCTOR </label>
  <input class="form-control" list="NOMBRES" type="text" id="CONDUCTOR" name="CONDUCTOR" >
    <datalist id="NOMBRES" >  
    <option selected ></option>
    <?php 
      $queryP="SELECT * FROM usuarios ";
      $resultP=mysqli_query($conexion, $queryP);
    ?>
    <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
      
    <option value="<?php echo $filasP ['user_nombre']?>" >
    </option>
    <?php } ?>
  </datalist>
</div>


 <div class="form-group">
  <label for="AUXILIAR1">AUXILIAR(1) </label>
  <input class="form-control" list="AUX1" type="text" id="AUXILIAR1" name="AUXILIAR1" >
    <datalist id="AUX1" >  
    <option selected ></option>
    <?php 
      $queryP="SELECT * FROM usuarios ";
      $resultP=mysqli_query($conexion, $queryP);
    ?>
    <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
      
    <option value="<?php echo $filasP ['user_nombre']?>" >
    </option>
    <?php } ?>
  </datalist>
</div>

 <div class="form-group">
  <label for="AUXILIAR2">AUXILIAR(2) </label>
  <input class="form-control" list="AUX2" type="text" id="AUXILIAR2" name="AUXILIAR2" >
    <datalist id="AUX2" >  
    <option selected ></option>
    <?php 
      $queryP="SELECT * FROM usuarios ";
      $resultP=mysqli_query($conexion, $queryP);
    ?>
    <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
      
    <option value="<?php echo $filasP ['user_nombre']?>" >
    </option>
    <?php } ?>
  </datalist>
</div>

 <div class="form-group">
  <label for="AUXILIAR3">AUXILIAR(3) </label>
  <input class="form-control" list="AUX3" type="text" id="AUXILIAR3" name="AUXILIAR3" >
    <datalist id="AUX3" >  
    <option selected ></option>
    <?php 
      $queryP="SELECT * FROM usuarios ";
      $resultP=mysqli_query($conexion, $queryP);
    ?>
    <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
      
    <option value="<?php echo $filasP ['user_nombre']?>" >
    </option>
    <?php } ?>
  </datalist>
</div>


  <div class="form-group">
  <label for="CLIENTE">CLIENTE  </label>
  <input value="<?php echo $filas ['CLIENTE']; ?>" class="form-control" list="CLIENTES" type="text" id="CLIENTE" name="CLIENTE" >
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
</div>

    <div class="form-group">
      <label for="SERVICIOS">SERVICIOS</label>
      <input type="text" class="form-control" id="SERVICIOS" name="SERVICIOS" >
    </div>


    <div class="form-group">
      <label for="HCITA">HORA CITA</label>
      <input type="times" class="form-control" id="HCITA" name="HCITA" >
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

<script >
function confirmLink() {
  // Obtenga la confirmación del usuario.
  var confirmation = confirm(' ⚠ ¿Seguro que desea ELIMINAR el registro?');


  // Si el usuario confirma, devuelva `true` para permitir que el enlace se siga.
  // De lo contrario, devuelva `false` para evitar que el enlace se siga.
  return confirmation;
}
</script>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>