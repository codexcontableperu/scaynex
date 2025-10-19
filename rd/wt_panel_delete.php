<?php include("../data/conexion.php"); ?>
<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="whatsaap/stilo_what.css">
<?php include('whatsaap1.php'); ?>

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
    width: 300px; /* Ancho al pasar el cursor */
    padding: .10rem;
    align-items: center; /* Alinea verticalmente */
  }
</style>

    
<?php

$ID = $_GET['idp'];

$queryo="
SELECT rd_segimientos_head.*, rd_segimientos_head.Id_SERG
FROM rd_segimientos_head
WHERE (((rd_segimientos_head.Id_SERG)=$ID));

";
$resulto=mysqli_query($conexion, $queryo);
$filaso=mysqli_fetch_assoc($resulto);


?>
<br>
<h5 class="text-center">UNIDAD PROGRAMADA</h5>

<div>&nbsp <span class="icon-truck">&nbsp<?php echo $filaso ['S_FECHA']?> </span> 
  <div class="card ">
</div>    
      <h5 class="card-title">
<!-- Button trigger modal -->

      </h5>

      <table class="table table-sm table-striped table5">
  <tbody>
    <tr>
      <th >EPS</th>
      <td class="tdx"><?php echo $filaso ['EPS']?></td>
      <th >PLACA</th>
      <td><?php echo $filaso ['PLACA']?></td>

    </tr>
    <tr>
      <th >TEMPERATURA</th>
      <td class="tdx"><?php echo $filaso ['TEMPERATURA']?></td>
      <th >SERVICIO</th>
      <td class="tdx"><?php echo $filaso ['SERVICIOS']?></td>

    </tr>
      <tr>
      <th >CONDUCTOR</th>
      <td class="tdx"><?php echo $filaso ['CONDUCTOR']?></td>
      <th >CLIENTE</th>
      <td class="tdx"><?php echo $filaso ['ID_CLIENTE']?></td>

    </tr>
    <tr>
      <th >AUXILIAR 1</th>
      <td class="tdx"><?php echo $filaso ['AUXILIAR1']?></td>
      <th >HORA DE CITA</th>
      <td class="tdx"><?php echo $filaso ['H_CITA']?></td>
    </tr>
    <tr>
      <th >AUXILIAR 2</th>
      <td class="tdx"><?php echo $filaso ['AUXILIAR2']?></td>
      <th >OBSERVACION</th>
      <td class="tdx"><?php echo $filaso ['OBS_PROG']?></td>
    </tr>

    <tr>
      <th>AUXILIAR 3</th>
      <td class="tdx"><?php echo $filaso ['AUXILIAR3']?> </td>
    </tr>

    

  </tbody>
</table>
</div>


<?php include('wt_ruta_inicio.php'); ?>


<?php
$queryS="
SELECT rd_servicio.*, rd_servicio.Id_SERG
FROM rd_servicio
WHERE (((rd_servicio.Id_SERG)=$ID))";
$resultS=mysqli_query($conexion, $queryS);

?>



<br>
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
  border-color: black;
}

.titu a :hover {
  border: 1px solid black;
  padding: 3px;
}

</style>

<div class="titu" >
  &nbsp<h5>SERVICIOS REALIZADOS</h5>
  <a href="wt_panel_user.php?idp=<?php echo $ID?>" style="color: black;"><span class="icon-reply"></span>   </a>
</div>


<div class="botones">
<div class="container text-center">
  <div class="row">
    <div class="col">

<?php while($filasS=mysqli_fetch_assoc($resultS)) { ?>
        <a class="btn btn-lg btn-danger square-btn" style="color: white; " href="crud_servicio/deleteSR.php?ids=<?php echo $filasS ['ID_SERV']?>&idp=<?php echo $ID?>">
        <span class="icon-truck"></span>
        <?php echo $filasS ['PALETAS']?>P<br>
        <span style="font-size: 13px;"><?php echo $filasS ['CUENTA']?></span><br><span style="font-size: 15px;">ELIMINAR</span>
        </a>
<?php } ?>

      <a data-toggle="modal" data-target="#HRUTA" class="btn btn-lg btn-outline-success square-btn" style="font-size: 13px;"><span class="icon-plus">
        <br> Nuevo Servicio</a>
    </div>
  </div>
</div>
</div>
<br>
<?php include('wt_ruta_fin.php'); ?>
<br>
<h5 class="text-center">REPORTES</h5>


<div class="botones">

<div class="container">
  <div class="row">
    <div class="col-sm">

<div class="info">
    <div class="step" id="step1">
        <a href="">        
        <img src="./whatsaap/gasto.png" alt="Paso 1">
        <p>GASTOS</p>
        </a>

    </div>
    <div class="step" id="step2">
        <a href=""> 
        <img src="./whatsaap/liquidacion.png" alt="Paso 2">
        <p>LIQUIDACIONES</p>
        </a>
    </div>
    <div class="step" id="step3">
        <a href=""> 
        <img src="./whatsaap/incidencias.png" alt="Paso 3">
        <p>INCIDENCIAS</p>
        </a>
    </div>
    <div class="step" id="step3">
        <a href=""> 
        <img src="./whatsaap/datos.png" alt="Paso 3">
        <p>FICHA DATOS</p>
        </a>
    </div>
</div>
    </div>
  </div>
</div>  
</div>


<!-- Modal -->
<div class="modal fade" id="HRUTA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<?php        
$queryo="
SELECT rd_segimientos_head.*, rd_segimientos_head.Id_SERG
FROM rd_segimientos_head
WHERE (((rd_segimientos_head.Id_SERG)=$ID));

";
$resulto=mysqli_query($conexion, $queryo);
$filaso=mysqli_fetch_assoc($resulto);
?>
      <table class="table table-sm ">
  <form action="crud_servicio/create1.php" method="POST">
          <div class="dropdown-divider"></div>
<input type="hidden"  class="form-control" id="Id_SERG " name="Id_SERG" value="<?php echo $ID ?>" >

        <div class="form-row">
            <div class="col">
                <label for="NBULTOS">BULTOS</label>
                <input  type="number" class="form-control" id="NBULTOS" name="NBULTOS">
            </div>
            <div class="col">
                <label for="PALETAS">PALETAS</label>
                <input  type="number" class="form-control" id="PALETAS" name="PALETAS" >
            </div>
            <div class="col">
                <label for="DATALOGGER">DATALOGGER</label>
                <select class="custom-select" id="DATALOGGER" name="DATALOGGER" required>
                <option selected > </option>
                <option value="SI" > SI </option>
                <option value="NO" > NO </option>         
                </select>
            </div>            
        </div>
        
<div class="dropdown-divider"></div>

      
  <tbody>
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
          <select type="text" id="CONDUCTOR" name="CONDUCTOR">
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
          <select  type="text" id="AUXILIAR1" name="AUXILIAR1">
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
          <select  type="text" id="AUXILIAR2" name="AUXILIAR2">
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
            <select   type="text" id="AUXILIAR3" name="AUXILIAR3">
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
      <th >EMPRESA</th>
      <td >
          <input class="ancho"  value="<?php echo $filaso ['ID_CLIENTE']; ?>" list="CLIENTES" type="text" id="CLIENTE" name="CLIENTE" placeholder="Cliente" required>
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
<input  type="text" class=" ancho" id="CUENTA" name="CUENTA">  
      </td>

</tr>

 <tr>
      <th >CLIENTE</th>
      <td >
<input  type="text" class=" ancho" id="CTE_TERCERO" name="CTE_TERCERO" > 
      </td>

</tr>

  <tr>      
      <th >TIPO</th>
      <td >

      
      <select class="ancho"  id="TIPO_PROG" name="TIPO_PROG" required>
        <option selected></option>
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
      <th >HORA DE CITA</th>
      <td >
          <input class="ancho"  type="times" id="H_CITA" name="H_CITA" value="<?php echo $filaso ['H_CITA']  ?>"  required>
      </td>
</tr>

 <tr>
      <th >OBSERVACION</th>
      <td >
          <input class="ancho" type="text" id="OBS_PROG" name="OBS_PROG" value="<?php echo $filaso ['OBS_PROG']  ?>" placeholder="Observacion">
      </td>
</tr>
<tr>

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



<?php include('includes/footer.php'); ?>