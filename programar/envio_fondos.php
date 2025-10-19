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


  <style>
    .contacto {
      display: flex;
      align-items: center;
      margin-bottom: 2px;
      padding: 10px;
      border-radius: 10px;
      background-color: #f0f0f0;
    }

    .contacto img {
      border-radius: 50%;
      height: 50px;
      width: 50px;
      margin-right: 10px;
    }


   .btn-importe1 {
    
    background: white ;
     border-radius: 10px;
     padding-left: 5px;
     padding-right: 5px;
    font-size: 12px;
     margin: 2px;
     width: 100%;
     height: 40px ;
     border: solid #f0f0f0;

    }
    .btn-importe2 {
     background: wheat  ;
     border-radius: 10px;
     padding-left: 5px;
     padding-right: 5px;
     font-size: 12px;
     margin: 3px;
     width: 100%;
     height: 40px 
    }



    .caja {
      width: 100%;
 
 
    }

  .cajabody {
  width: 100%;
  display: flex;
    }

  .valores {
  width: 100%;

 
    }

.form-control {

height: calc(1.8125rem + 10px);


}

  </style>



<div class="card text-center">
  <div class="card-header text-center">
    <span class="icon-truck"></span> <br>
    <B> <h4 class="text-center"> ENTREGAS A RENDIR </h4> </B>
  </div>

</div>



<br>

<div class="container">
  <div class="row">
    
    <div class="col-sm col-4 " >
      <a href="#RENDIR" class="btn btn-block btn-primary " data-toggle="modal">  A-RENDIR     </a>
      
    </div>
    <div class="col-sm col-4 ">
      <a href="#ASUELDO" class="btn btn-block btn-success " data-toggle="modal">  ADELANTO     </a>
    </div>
 <div class="col-sm col-4">
      <a href="envio_fondosr.php" class="btn btn-block btn-warning " >  RESUMEN     </a>
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

    

    <table id="example" class="table table-sm" width="100%">
      <thead class=" text-center">
        <tr>
        <th scope="col">RENDICIONES</th>

      
        </tr>
      </thead>
  <tbody>


          <?php

               $query="



SELECT usuarios.user_activo, usuarios.id_user, usuarios.user_avatar, usuarios.user_nombre, usuarios.user_nick, enviooy.SumaDeimporte AS enviooy, rsaldo.rsaldo, salario_xuser.SumaDesalario AS salario, ingreso_xuser.SumaDeimporte AS envios, egreso_xuser.SumaDeimporte AS egresos
FROM ((((usuarios LEFT JOIN enviooy ON usuarios.id_user = enviooy.id_responsable) LEFT JOIN rsaldo ON usuarios.id_user = rsaldo.id_responsable) LEFT JOIN salario_xuser ON usuarios.id_user = salario_xuser.id_responsable) LEFT JOIN ingreso_xuser ON usuarios.id_user = ingreso_xuser.id_responsable) LEFT JOIN egreso_xuser ON usuarios.id_user = egreso_xuser.id_responsable
WHERE (((usuarios.user_activo)='si') AND ((ingreso_xuser.SumaDeimporte)>0))



              ";
           $result=mysqli_query($conexion, $query);



          ?>
          <?php while($filas=mysqli_fetch_assoc($result)) { ?>

          <tr>
            
            <td > 
 
  <div class="contacto">
    <div>
        <a href="envio_fondosxuser.php?us=<?php echo $filas['id_user']; ?>" >
        <img src="../panel/<?php echo $filas ['user_avatar'] ; ?>" alt="foto">
        </a>
    </div>
    <div class="caja">
        <div>
          <a href="envio_fondosxuser.php?us=<?php echo $filas['id_user']; ?>" > 
                <span class="icon-user"></span> <?php echo $filas ['user_nick']?> 
                </a>
        </div> 
        <div class="cajabody">
                <div class="valores">
                  <label class="btn-importe1" > <span class="icon-plus"></span> <strong>  ENVIOS:</strong>  <br> S/ <?php echo $filas ['envios'] ; ?> </label> 
                  <label class="btn-importe1">  <span class="icon-minus"></span>  <strong>GASTOS:</strong> <br>  S/ <?php echo $filas ['egresos'] ; ?></label>
                  
                </div>
                 
                <div class="valores"> 
                  <label class="btn-importe1"> <span class="icon-checkmark"></span>  <strong>ADELANTOS:</strong>  <br> S/ <?php echo $filas ['salario'] ; ?> </label>       
                  <label class="btn-importe1"> <span class="icon-arrow-right"></span>  <strong>SALDO:</strong> <br>S/ <?php echo $filas ['rsaldo'] ; ?></label>
                  
                </div>
                
        </div>
    </div>
  </div>        



            </td> 
          
            
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
        <h5 class="modal-title">ADELANTO DE SUELDO</h5>
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
  <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" required>
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
  <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" required>
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





 <!-- formulrio RESUMEN FILTROS-->


<div class="modal" tabindex="-1" role="dialog" id="REPO">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">FILTROS - REPORTE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="envio_reporte.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>
<input class="form-control"  type="hidden" id="fechacrea" name="fechacrea" value="<?php echo $hoy ; ?> " readonly>

  <div class="form-group" >
  
  <label for="fecha_registro">Fecha</label>
  <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" required>
<br>



</div>


      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-success btn-lg btn-block" id="guardar" name="guardar">GENERAR </button>
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
