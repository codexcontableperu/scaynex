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
  border-color: red;
}

.titu a :hover {
  border: 1px solid red;
  padding: 3px;
}

</style>
<div class="titu" >
<tr> &nbsp<span class="fas fa-map-marker-alt"></span> &nbsp EN RUTA (Servicios) </tr>
<?php
$queryS="
SELECT  rd_servicio.Id_SERG
FROM rd_servicio
WHERE (((rd_servicio.Id_SERG)=$idp))";
$resultS=mysqli_query($conexion, $queryS);
?>

<div style="display: flex;">
<marquee behavior="scroll"  direction="right" style="width: 130px; " > 
<?php while($filasS=mysqli_fetch_assoc($resultS)) { ?>
<span class="icon-truck"> </span>   
<?php } ?> 

</marquee >
</div>
 &nbsp &nbsp&nbsp&nbsp <a data-toggle="modal" data-target="#elimina" style="color: red;"><span class="icon-bin"></span>   </a>
<br>
</div>

<tr>
<div class="botones" style="background-color:white;">
<div class="container text-center">
  <div class="row">
    <div class="col">
<?php

$queryS="
SELECT rd_servicio.*, rd_servicio.Id_SERG
FROM rd_servicio
WHERE (((rd_servicio.Id_SERG)=$idp))";
$resultS=mysqli_query($conexion, $queryS);
?>

<?php while($filasS=mysqli_fetch_assoc($resultS)) { ?>
<?php

if ($filasS ['PALETAS'] != 0) {
  ?>
          <a class="btn  btn-info square-btn" style="color: white; " href="crud_ruta/create1.php?idp=<?php echo $idp?>&ids=<?php echo $filasS ['ID_SERV']?>">
        <span class="icon-truck"></span>
        <?php echo $filasS ['PALETAS']?>P
        <br>  <span style="font-size: 13px;"><?php echo $filasS ['CUENTA']?></span>
        </a>

  <?php
} else {
  ?>
        <a class="btn  btn-outline-info "  href="crud_ruta/create1.php?idp=<?php echo $idp?>&ids=<?php echo $filasS ['ID_SERV']?>">
        <span class="icon-truck"></span> <br>
        <span>Registrar</span>    
        </a>
  <?php
}

?>

<?php } ?>

      <a data-toggle="modal" data-target="#HRUTA" class="btn btn-sm btn-outline-info square-btn" style="font-size: 13px; "><span class="icon-plus">
        <br> Nuevo<br> Servicio</a>
    </div>

  </div>
</div>
</div>
</tr>


<!-- Modal nuevo servicio + nueva ruta-->

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
SELECT *
FROM rd_segimientos_head
WHERE Id_SERG=$idp;
";

$resulto=mysqli_query($conexion, $queryo);
$filaso=mysqli_fetch_assoc($resulto);
?>

      <table class="table table-sm ">
  <form action="crud_servicio/create_serv.php" method="POST">
  <tbody>    
<input type="hidden"  class="form-control" id="FECHA_SERV" name="FECHA_SERV" value="<?php echo $filaso ['S_FECHA']  ?>" >
<input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="<?php echo $idp ?>" >
<input type="hidden"  class="form-control" id="user_serv" name="user_serv" value="<?php echo $id_userup ?>" >
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

      <th >CONTACTO DE CUENTA</th>

      <td >

<input  type="text" class=" ancho" id="CONTACTO_CTA" name="CONTACTO_CTA"  required>  

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

<input  type="text" class=" ancho" id="CUENTA" name="CUENTA" required>  

      </td>



</tr>



 <tr>

      <th >CLIENTE</th>

      <td >

<input  type="text" class=" ancho" id="CTE_TERCERO" name="CTE_TERCERO" required> 

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

<textarea class="form-control" id="OBSERVACION_SERV" name="OBSERVACION_SERV" rows="2" placeholder="Ingresar observaciones..."><?php echo $filaso['OBSERVACIONES_PROG']; ?></textarea>
      </td>

</tr>
<tr>
<td colspan="2">
       <div class="dropdown-divider"></div>




        <div class="form-row">

            <div class="col">

                <label for="NBULTOS">BULTOS</label>

                <input  type="number" class="form-control" id="NBULTOS" name="NBULTOS" >

            </div>

            <div class="col">

                <label for="PALETAS">PALETAS</label>

                <input  type="number" class="form-control" id="PALETAS" name="PALETAS" >

            </div>

            <div class="col">

                <label for="DATALOGGER">DATALOGGER</label>

                <select class="custom-select" id="DATALOGGER" name="DATALOGGER" >

                <option selected value="NO"> NO</option>

                <option value="SI" > SI </option>

                <option value="NO" > NO </option>         

                </select>

            </div>            

        </div>

        

</td>


</tr>


<tr>
<td colspan="2">


       <div class="dropdown-divider"></div>




        <div class="form-row">

             <div class="col">

                <label for="H_CITA">HCITA - BASE</label>

                <input  type="time" class="form-control" id="H_CITA" name="H_CITA" value="<?php echo $filaso ['H_CITA_BASE']  ?>" readonly >

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

