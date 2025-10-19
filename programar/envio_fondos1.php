<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>
<?php include("../data/conexion.php"); ?>

    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="main.css">  
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
           
    <!--font awesome con CDN-->  
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">  





<div class="card text-center">
  <div class="card-header text-center">
    <span class="icon-truck"></span> <br>
    <B> <h4 class="text-center"> ENTREGAS A RENDIR </h4> </B>
  </div>

</div>



<br>

<div class="container">
  <div class="row">
    <div class="col-sm col-1">
      
    </div>
    <div class="col-sm col-5 ">
      <a href="#RENDIR" class="btn btn-block btn-primary " data-toggle="modal">  RENDIR     </a>
      
    </div>
    <div class="col-sm col-5 ">
      <a href="#ASUELDO" class="btn btn-block btn-success " data-toggle="modal">  SUELDO     </a>
    </div>
        <div class="col-sm col-1">
      
    </div>
  </div>
</div>

<br>

      <?php
           $query2=" SELECT * FROM totalenviooy  ";
           $result2=mysqli_query($conexion, $query2);
           $filas2=mysqli_fetch_assoc($result2)
      ?>

      <div>

        <div class="card" >
        <div class="card-header text-right">
      TOTAL A RENDIR DEL DIA = S/. <?php echo $filas2 ['SumaDeimporte'] ; ?>  </div>

      </div>

      </div>



<div class= "tablescroll" > 

<div class="container p-3">

      <div class="row" >
        <div class="col-12" class="colm">

    

    <table id="example" class="table table-striped table-bordered" class="table table-sm" width="100%">
      <thead class="thead-dark text-center">
        <tr>
        <th scope="col">SALDO</th>
         <th scope="col">A RENDIR</th>
        <th scope="col">ENVIAR </th>
        <th scope="col">SALARIO </th>
        <th scope="col">ENVIAR </th>
      
        </tr>
      </thead>
  <tbody>


          <?php

               $query="

          SELECT usuarios.id_user, usuarios.user_nick, enviooy.SumaDeimporte, rsaldo.rsaldo, salario_xuser.SumaDesalario
          FROM ((usuarios LEFT JOIN enviooy ON usuarios.id_user = enviooy.id_responsable) LEFT JOIN rsaldo ON usuarios.id_user = rsaldo.id_responsable) LEFT JOIN salario_xuser ON usuarios.id_user = salario_xuser.id_responsable
          ORDER BY usuarios.user_nick



              ";
           $result=mysqli_query($conexion, $query);



          ?>
          <?php while($filas=mysqli_fetch_assoc($result)) { ?>

          <tr>
            
            <td class="text-left"> 
            <a href="envio_fondosxuser.php?us=<?php echo $filas['id_user']; ?>" > 
            <span class="icon-user"></span> <?php echo $filas ['user_nick']?> </a>
            <br> S/<?php echo $filas ['rsaldo'] ; ?></td> 
          
            <td>
            <form  action="crud_envio/create.php" method="POST" enctype="multipart/form-data">
            <input class="form-control"  type="hidden" id="fechacrea" name="fechacrea" value="<?php echo $hoy ; ?> " readonly>
            <input class="form-control"  type="hidden" id="fecha_registro" name="fecha_registro" value="<?php echo $hoy ; ?> " readonly>
            <input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>
            <input class="form-control"  type="hidden" id="id_responsable" name="id_responsable" value="<?php echo $filas ['id_user'] ; ?> " readonly>
            <input class="form-control"  type="hidden" id="observacion" name="observacion" value="" readonly>
            <input   type="text" class="form-control text-right" id="importe" name="importe" placeholder="S/. 00.00"> 

            <span class="text-right"> + <?php echo $filas ['SumaDeimporte'] ; ?> </span> 

            </td>

            <td class="text-center">
              <button type="submit" class="btn btn-primary" id="guardar" name="guardar"> Enviar</button>
            </form>  
            </td>
            


            <td>
            <form  action="crud_salario/create.php" method="POST" enctype="multipart/form-data">
            <input class="form-control"  type="hidden" id="fechacrea" name="fechacrea" value="<?php echo $hoy ; ?> " readonly>
            <input class="form-control"  type="hidden" id="fecha_registro" name="fecha_registro" value="<?php echo $hoy ; ?> " readonly>
            <input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>
            <input class="form-control"  type="hidden" id="id_responsable" name="id_responsable" value="<?php echo $filas ['id_user'] ; ?> " readonly>
            <input class="form-control"  type="hidden" id="observacion" name="observacion" value="" readonly>
            <input   type="text" class="form-control text-right" id="salario" name="salario" placeholder="S/. 00.00"> 
            <span class="text-right"> + <?php echo $filas ['SumaDesalario'] ; ?> </span> 

            </td>
            <td class="text-center">
              <button type="submit" class="btn btn-success" id="guardar" name="guardar"> Envia</button>
              
            </td>
            </form>



            </tr>




         <?php } ?>




  </tbody>
</table>




    </div>
  </div>
</div>
</div> 



 <!-- formulrio nuevo envio de sueldos-->


<div class="modal" tabindex="-1" role="dialog" id="ASUELDO">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">A CUENTA DE SUELDO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_salario/create.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>
<input class="form-control"  type="hidden" id="fechacrea" name="fechacrea" value="<?php echo $hoy ; ?> " readonly>

  <div class="form-group" >
  
  <label for="fecha_registro">Fecha</label>
  <input type="date" class="form-control" id="fecha_registro" name="fecha_registro">
<br>


  <label for="id_responsable">EMPLEADO</label>
   <select class="custom-select" id="id_responsable" name="id_responsable" required >
<option >  </option>
    <?php 
      $queryp="SELECT usuarios.id_user, usuarios.user_nick
FROM usuarios
ORDER BY usuarios.user_nick;
";
      $resultp=mysqli_query($conexion, $queryp);
    ?>
    <?php while($filasp=mysqli_fetch_assoc($resultp)) { ?>
      
    <option value="<?php echo $filasp ['id_user']?>" >
      <?php echo $filasp ['user_nick']  ?>
    </option>
    <?php } ?>

  </select>
<br>

  <label for="observacion">Observación</label>
  <textarea class="form-control" id="observacion" name="observacion" placeholder="Ingresa Observaciones" rows="2"></textarea>
<br>
  <label for="salario">Importe</label>
  <input type="number" step="any" class="form-control" id="salario"  name="salario" placeholder="S/. 0.00">

</div>


      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-success btn-lg btn-block" id="guardar" name="guardar">ENVIAR </button>
</form>
        
      </div>
    </div>
  </div>
</div>


 <!-- formulrio nuevo envio de fondos-->

<div class="modal" tabindex="-1" role="dialog" id="RENDIR">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">NUEVA ENTREGA A RENDIR </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_envio/create.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>
<input class="form-control"  type="hidden" id="fechacrea" name="fechacrea" value="<?php echo $hoy ; ?> " readonly>

  <div class="form-group" >
  
  <label for="fecha_registro">Fecha</label>
  <input type="date" class="form-control" id="fecha_registro" name="fecha_registro">
<br>


  <label for="id_responsable">EMPLEADO</label>
   <select class="custom-select" id="id_responsable" name="id_responsable" required >
<option >  </option>
    <?php 
      $queryp="SELECT usuarios.id_user, usuarios.user_nick
FROM usuarios
ORDER BY usuarios.user_nick;
";
      $resultp=mysqli_query($conexion, $queryp);
    ?>
    <?php while($filasp=mysqli_fetch_assoc($resultp)) { ?>
      
    <option value="<?php echo $filasp ['id_user']?>" >
      <?php echo $filasp ['user_nick']  ?>
    </option>
    <?php } ?>

  </select>
<br>

  <label for="observacion">Observación</label>
  <textarea class="form-control" id="observacion" name="observacion" placeholder="Ingresa Observaciones" rows="2"></textarea>
<br>
  <label for="importe">Importe</label>
  <input type="number" step="any" class="form-control" id="importe"  name="importe" placeholder="S/. 0.00">

</div>


      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">ENVIAR </button>
</form>
        
      </div>
    </div>
  </div>
</div>










    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>    
     
    <!-- para usar botones en datatables JS -->  
    <script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
     
    <!-- código JS propìo-->    
    <script type="text/javascript" src="main.js"></script>  
    


  </body>
</html>
