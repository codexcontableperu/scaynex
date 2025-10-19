<?php include("../data/conexion.php"); ?>
<?php include('includes/header.php'); ?>
<?php include('whatsaap.php'); ?>
<link rel="stylesheet" href="style.css">

<style >
    .ancho:focus  {
    width: 300px; /* Ancho al pasar el cursor */
  }
</style>

          <?php 
          $timestamp = new DateTime(null, new DateTimeZone('America/Lima'));
          $hoy = $timestamp->format('y-m-d');
          $horaa = $timestamp->format('H:i:s');
          $hoyfor = $timestamp->format('d-m-y');

          ?>
    <link rel="stylesheet" href="whatsaap/stilo_pag.css">

    <div class="pagina-centrada">
        <!-- Contenido de la página aquí -->

<?php 

$PLACA=$_POST['PLACA'];

$query="
SELECT rd_segimientos_head.*
FROM rd_segimientos_head
WHERE (((rd_segimientos_head.PLACA)='$PLACA') AND ((rd_segimientos_head.S_FECHA)='$hoy'))
";
$result=mysqli_query($conexion, $query);
$numfilas = mysqli_num_rows($result);

if ($numfilas>0) {
$filas=mysqli_fetch_assoc($result);
$RD = $filas ['Id_SERG'] ;
$EPS = $filas ['EPS'] ;
$HABILIDA = $filas ['TEMPERATURA'] ;
$PLACA = $filas ['PLACA'] ;
$CONDUCTOR = $filas ['CONDUCTOR'] ;
$AUXILIAR1 = $filas ['AUXILIAR1'] ;
$AUXILIAR2 = $filas ['AUXILIAR2'] ;
$AUXILIAR3 = $filas ['AUXILIAR3'] ;
$ID_CLIENTE = $filas ['ID_CLIENTE'] ;
$SERVICIOS = $filas ['SERVICIOS'] ;
$H_CITA = $filas ['H_CITA'] ;


?>
<div class="container">
  <div class="row">
    <div class="col-sm ">


<form action="crud_servicio/create.php" method="POST">


    <input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="<?php echo $RD ?>" >

    <div class="form-group">
    <label for="EPS">EMPRESA </label>
    <select class="custom-select" id="EPS" name="EPS" required>
    <option selected value="<?php echo $EPS ?>"> <?php echo $EPS ?></option>
    <option value="JSA LLANOS" > JSA LLANOS </option>
    <option value="JS GREGORI" > JS GREGORI </option>         
    </select>
    </div>

    <div class="form-group">
      <label for="TIPO_PROG">TIPO  </label>
      <select class="custom-select" id="TIPO_PROG" name="TIPO_PROG" required>
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
    </div>




<div class="dropdown-divider"></div>

        <div class="form-row">
            <div class="col">
  <label for="PLACA">PLACA </label>
  <input value="<?php echo $PLACA ?>"  class="form-control" list="PLACAS" type="text" id="PLACA" name="PLACA" required>
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
            <div class="col">

  <label for="CONDUCTOR">CONDUCTOR  </label>
  <input value="<?php echo $CONDUCTOR; ?>" class="form-control ancho" list="NOMBRES" type="text" id="CONDUCTOR" name="CONDUCTOR" required>
    <datalist id="NOMBRES" >  
    <option selected ></option>
    <?php 
      $queryP="SELECT * FROM usuarios ";
      $resultP=mysqli_query($conexion, $queryP);
    ?>
    <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
      
    <option value="<?php echo $filasP ['user_nick']?>" >
    </option>
    <?php } ?>
  </datalist>                
            </div>

        </div>


        <div class="form-row">
            <div class="col">
  <label for="AUXILIAR1">AUXILIAR 1  </label>
  <input value="<?php echo $AUXILIAR1; ?>" class="form-control ancho" list="AUX1" type="text" id="AUXILIAR1" name="AUXILIAR1" required>
    <datalist id="AUX1" >  
    <option selected ></option>
    <?php 
      $queryP="SELECT * FROM usuarios ";
      $resultP=mysqli_query($conexion, $queryP);
    ?>
    <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
      
    <option value="<?php echo $filasP ['user_nick']?>" >
    </option>
    <?php } ?>
  </datalist>                
            </div>          
            <div class="col">
  <label for="AUXILIAR2">AUXILIAR 2  </label>
  <input value="<?php echo $AUXILIAR2; ?>" class="form-control ancho" list="AUX2" type="text" id="AUXILIAR2" name="AUXILIAR2" >
    <datalist id="AUX2" >  
    <option selected ></option>
    <?php 
      $queryP="SELECT * FROM usuarios ";
      $resultP=mysqli_query($conexion, $queryP);
    ?>
    <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
      
    <option value="<?php echo $filasP ['user_nick']?>" >
    </option>
    <?php } ?>
  </datalist>
            </div>

            <div class="col">
  <label for="AUXILIAR3">AUXILIAR 3  </label>
  <input value="<?php echo $AUXILIAR3; ?>" class="form-control ancho" list="AUX3" type="text" id="AUXILIAR3" name="AUXILIAR3" >
    <datalist id="AUX3" >  
    <option selected ></option>
    <?php 
      $queryP="SELECT * FROM usuarios ";
      $resultP=mysqli_query($conexion, $queryP);
    ?>
    <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
      
    <option value="<?php echo $filasP ['user_nick']?>" >
    </option>
    <?php } ?>
  </datalist>
            </div>            
        </div>

<div class="dropdown-divider"></div>

        <div class="form-group">
  <label for="CLIENTE">EMPRESA </label>
  <input value="<?php echo $ID_CLIENTE ?>"  class="form-control " list="CLIENTES" type="text" id="CLIENTE" name="CLIENTE" required>
    <datalist id="CLIENTES" >  
    <option selected ></option>
    <?php 
      $query="SELECT *FROM clientes ";
      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['cte_nombrecomercial']?>" >
    </option>
    <?php } ?>
  </datalist>            
        </div>

        <div class="form-row">
            <div class="col">
                <label for="CUENTA">CUENTA</label>
                <input  type="text" class="form-control ancho" id="CUENTA" name="CUENTA">
            </div>
            <div class="col">
                <label for="CTE_TERCERO">CLIENTE</label>
                <input  type="text" class="form-control ancho" id="CTE_TERCERO" name="CTE_TERCERO" >
            </div>
        </div>
<br>        
<div class="dropdown-divider"></div>

        <div class="form-row">
            <div class="col">
  <label for="TEMPERATURA">TIPO_UNIDAD </label>
  <select class="custom-select" id="TEMPERATURA" name="TEMPERATURA" required>
    <option selected value="<?php echo $HABILIDA ?>"><?php echo $HABILIDA ?></option>
    <?php 
      $query="SELECT * FROM  habilidad ";
      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['nom_habilidad']?>" >
      <?php echo $filas ['nom_habilidad']  ?>  
    </option>
    <?php } ?>

  </select>
            </div>
            <div class="col">
                <label for="TEMP_VH">TEMPERATURA</label>
                <input  type="text" class="form-control" id="TEMP_VH" name="TEMP_VH" placeholder="00.0°" required>
 
            </div>
        </div>

<div class="dropdown-divider"></div>

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
        <div class="form-row">
            <div class="col">
                <label for="H_CITA">HORA de CITA programada</label>
                <input  type="time" class="form-control" id="H_CITA" name="H_CITA" required>
 
            </div>            
            <div class="col">
                <label for="HORA_LLEGADA_CLTE">HORA de llegada al Cliente</label>
                <input  type="time" class="form-control" id="HORA_LLEGADA_CLTE"  name="HORA_LLEGADA_CLTE">
            </div>
            <div class="col">
                <label for="HORA_SALIDA_CLTE">HORA de salida al Cliente</label>
                <input  type="time" class="form-control" id="HORA_SALIDA_CLTE"  name="HORA_SALIDA_CLTE">
            </div>
        </div>




<div class="dropdown-divider"></div>
        <div class="form-group">
            <label for="NRO_GUIA">GUIA DE REMISION TRASPORTISTA</label>
            <textarea  class="form-control" id="NRO_GUIA" name="NRO_GUIA" rows="3" placeholder="Ingrese las guias relacionadas con el servicio"></textarea>
        </div>

<div class="dropdown-divider"></div>
        <div class="form-group">
            <label for="NRO_GUIA_CTE">GUIA DE REMISION REMITENTE</label>
            <textarea  class="form-control" id="NRO_GUIA_CTE" name="NRO_GUIA_CTE" rows="3" placeholder="Ingrese las guias del cliente"></textarea>
        </div>

<div class="dropdown-divider"></div>        
        <div class="form-group">
            <label for="OBSERVACION_SERV">OBSERVACIONES</label>
            <textarea  class="form-control" id="OBSERVACION_SERV" name="OBSERVACION_SERV" rows="3" placeholder="Ingrese observaciones  del servicio"></textarea>
        </div>

<div class="dropdown-divider"></div>
<br>        
        <button id="guardar" name="guardar" type="submit" class="btn btn-success btn-block">
        <span class="icon-whatsapp"></span>
         ENVIAR
        </button>
</form>

    </div>
  </div>
</div>




    </div>
    <?php
} else {
    ?>
<div class="container">
  <div class="row">
    <div class="col-sm ">

<form action="crud_servicio/create.php" method="POST">


    <input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="0" >

    <div class="form-group">
    <label for="EPS">EMPRESA </label>
    <select class="custom-select" id="EPS" name="EPS" required>
    <option selected></option>
    <option value="JSA LLANOS" > JSA LLANOS </option>
    <option value="JS GREGORI" > JS GREGORI </option>         
    </select>
    </div>

    <div class="form-group">
      <label for="TIPO_PROG">TIPO  </label>
      <select class="custom-select" id="TIPO_PROG" name="TIPO_PROG" required>
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
    </div>




<div class="dropdown-divider"></div>

        <div class="form-row">
            <div class="col">
  <label for="PLACA">PLACA </label>
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
            <div class="col">

  <label for="CONDUCTOR">CONDUCTOR  </label>
  <input  class="form-control" list="NOMBRES" type="text" id="CONDUCTOR" name="CONDUCTOR" required>
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

        </div>


        <div class="form-row">
            <div class="col">
  <label for="AUXILIAR1">AUXILIAR 1  </label>
  <input  class="form-control" list="AUX1" type="text" id="AUXILIAR1" name="AUXILIAR1" required>
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
            <div class="col">
  <label for="AUXILIAR2">AUXILIAR 2  </label>
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

            <div class="col">
  <label for="AUXILIAR3">AUXILIAR 3  </label>
  <input  class="form-control" list="AUX3" type="text" id="AUXILIAR3" name="AUXILIAR3" >
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
        </div>

<div class="dropdown-divider"></div>

        <div class="form-group">
  <label for="CLIENTE">EMPRESA </label>
  <input  class="form-control" list="CLIENTES" type="text" id="CLIENTE" name="CLIENTE" required>
    <datalist id="CLIENTES" >  
    <option selected ></option>
    <?php 
      $query="SELECT *FROM clientes ";
      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['cte_nombrecomercial']?>" >
    </option>
    <?php } ?>
  </datalist>            
        </div>

        <div class="form-row">
            <div class="col">
                <label for="CUENTA">CUENTA</label>
                <input  type="text" class="form-control" id="CUENTA" name="CUENTA" >
            </div>
            <div class="col">
                <label for="CTE_TERCERO">CLIENTE</label>
                <input  type="text" class="form-control" id="CTE_TERCERO" name="CTE_TERCERO">
            </div>
        </div>
<br>        
<div class="dropdown-divider"></div>

        <div class="form-row">
            <div class="col">
  <label for="TEMPERATURA">TIPO_UNIDAD </label>
  <select class="custom-select" id="TEMPERATURA" name="TEMPERATURA" required>
    <option selected ></option>
    <?php 
      $query="SELECT * FROM  habilidad ";
      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['nom_habilidad']?>" >
      <?php echo $filas ['nom_habilidad']  ?>  
    </option>
    <?php } ?>

  </select>
            </div>
            <div class="col">
                <label for="TEMP_VH">TEMPERATURA</label>
                <input  type="text" class="form-control" id="TEMP_VH" name="TEMP_VH" placeholder="00.0°" required>
 
            </div>
        </div>
<div class="dropdown-divider"></div>
        <div class="form-row">
            <div class="col">
                <label for="H_CITA">HORA de CITA programada</label>
                <input  type="time" class="form-control" id="H_CITA" name="H_CITA" required>
 
            </div>            
            <div class="col">
                <label for="HORA_LLEGADA_CLTE">HORA de llegada al Cliente</label>
                <input  type="time" class="form-control" id="HORA_LLEGADA_CLTE" name="HORA_LLEGADA_CLTE">
            </div>
            <div class="col">
                <label for="HORA_SALIDA_CLTE">HORA de salida al Cliente</label>
                <input  type="time" class="form-control" id="HORA_SALIDA_CLTE" name="HORA_SALIDA_CLTE">
            </div>
        </div>

<div class="dropdown-divider"></div>

        <div class="form-row">
            <div class="col">
                <label for="NBULTOS">BUSTOS</label>
                <input  type="number" class="form-control" id="NBULTOS" name="NBULTOS" >
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
        <div class="form-group">
            <label for="NRO_GUIA">GUIA DE REMISION TRASPORTISTA</label>
            <textarea  class="form-control" id="NRO_GUIA" name="NRO_GUIA" rows="3" placeholder="Ingrese las guias relacionadas con el servicio"></textarea>
            </div>

<div class="dropdown-divider"></div>
        <div class="form-group">
            <label for="NRO_GUIA_CLTE">GUIA DE REMISION REMITENTE</label>
            <textarea  class="form-control" id="NRO_GUIA_CLTE" name="NRO_GUIA_CLTE" rows="3" placeholder="Ingrese las guias del cliente"></textarea>
        </div>

<div class="dropdown-divider"></div>        
        <div class="form-group">
            <label for="OBSERVACION_SERV">OBSERVACIONES</label>
            <textarea  class="form-control" id="OBSERVACION_SERV" name="OBSERVACION_SERV" rows="3" placeholder="Ingrese observaciones  del servicio"></textarea>
            
        </div>

<div class="dropdown-divider"></div>
<br>        
        <button id="guardar" name="guardar" type="submit" class="btn btn-success btn-block">
        <span class="icon-whatsapp"></span>
         ENVIAR
        </button>
</form>


    </div>
  </div>
</div>




    </div>
    <?php
}


 ?>


<?php include('includes/footer.php'); ?>

