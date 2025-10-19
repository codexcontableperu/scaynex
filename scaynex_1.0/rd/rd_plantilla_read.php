<?php include("../data/conexion.php"); ?>
<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">
<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>



<?php
$tabla = 'rd_segimientos_pll';
  // Crear la consulta
  $query = "SELECT * FROM $tabla ";
  $result = mysqli_query($conexion, $query);

?>

<div class="dropdown-divider"></div> 

<style>
  .form-container {
  display: flex;
  justify-content: flex-end;
  align-items: center;
}
.ancho:focus {
    width: 300px; /* Ancho al pasar el cursor */
  }

</style>
<div class="container">
  <div class="row">
    <div class="col-sm">
      <h5>PLANTILLA DE PROGRAMACION</h5>
      <div class="form-container text-right">

        <a style="color: white;" type="button" data-toggle="modal" data-target="#nuevo" class="btn btn-success mb-2 nv ">
        <span class="icon-plus"></span> NUEVO
        </a>

        &nbsp
        <a href="segimientos_read.php?f=<?php echo $FECHAW ?>" style="color: white ;" type="button" class="btn btn-secondary mb-2">
          <span class="icon-reply "></span> CERRAR
        </a>
      </div>
    </div>
  </div>
</div>


<div class="dropdown-divider"></div> 
<div class="container">
  <div class="row">
    <div class="col-sm">

<table id="example" class="table table-dark table-sm">
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
      <th scope="col">CITA</th>
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



    </div>
  </div>
</div>



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


<?php include('includes/footer.php'); ?>