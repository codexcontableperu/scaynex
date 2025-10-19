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

.gallery {
  display: flex;
  flex-wrap: wrap;
}

.gallery-item {
  flex: 1 0 300px;
  margin: 10px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
}

.gallery-item img {
  
  height: 80px;
  width: 80px;
  
  
}
.foto{
  display: flex;
  justify-content:center;
  background-color: #f2f2f2;
}

.gallery-caption {
  padding: 2px;
  text-align: center;
  background-color: #f2f2f2;
}

.gallery-caption h5 {
  margin-top: 0;
  font-size: 15px;
}

.description {
  display: none;
}

@media screen and (max-width: 768px) {
  .gallery-item {
    flex-basis: calc(50% - 20px);
  }
  
  .description {
    display: flex;
    font-size: 10px;
    justify-content:space-around ;
    
  }
    .description p {
  
    border: solid #f2f2f2;
    border-radius: 8px;
    background-color:white ;
    padding: 3px;
    margin-bottom: 0px;
  }

}

@media screen and (min-width: 769px) {
  .description {
    display: block;
    font-size: 16px;
    text-align: left;
  }
}




  </style>



<div class="card text-center">
  <div class="card-header text-center">
    <span class="icon-users"></span> <br>
    <B> <h4 class="text-center"> ASISTENCIA</h4> </B>
  </div>

</div>



<br>

<div class="container">
  <div class="row">

    <div class="col-sm  ">
      <a href="#ASISTENCIA" class="btn btn-block btn-primary " data-toggle="modal">  REGISTRAR ASISTENCIA    </a>
      
    </div>


  </div>
</div>

<br>
          <?php
               $query="
               SELECT asisteoy.id_empleado, asisteoy.user_avatar, asisteoy.user_nombre, asisteoy.hora_asist, asisteoy.vh_placa, asisteoy.vh_avatar
               FROM asisteoy;
              ";
           $result=mysqli_query($conexion, $query);
          ?>
          

            <div class="gallery">
<?php while($filas=mysqli_fetch_assoc($result)) { ?>
              <div class="gallery-item">
                <div class="foto">
                <img src="../panel/<?php echo $filas ['user_avatar'] ; ?>" alt="User" >
                </div>
                <div class="gallery-caption">
                  <h5><?php echo $filas ['user_nombre'] ; ?></h5>
                  <div class="description">
                    <p>PLACA: <?php echo $filas ['vh_placa'] ; ?></p><br>
                    <p>HORA: <?php echo $filas ['hora_asist'] ; ?></p> 
                    
                  </div>
                </div>
              </div>
   <?php } ?>            
            </div>

         


 <!-- formulrio nuevo envio de sueldos-->


<div class="modal" tabindex="-1" role="dialog" id="ASISTENCIA">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">REGISTRO DE ASISTENCIA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_asistencia/create.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>
<input class="form-control"  type="hidden" id="fechacrea" name="fechacrea" value="<?php echo $hoy ; ?> " readonly>

  <div class="form-group" >
  

    <label for="hora">HORA DE ASISTENCIA </label>
    <input class="form-control" type="time" placeholder="00:00" id="hora" name="hora" required >
  
<br>


  <label for="id_responsable">EMPLEADO</label>
   <select class="custom-select" id="id_responsable" name="id_responsable" required >
<option >  </option>
    <?php 
      $queryp="

SELECT usuarios.id_user, usuarios.user_nick, usuarios.user_nombre, IF(asisteoy.estado = 'R', 1, 0) AS RT
FROM usuarios
LEFT JOIN asisteoy ON usuarios.id_user = asisteoy.id_empleado
WHERE IF(asisteoy.estado = 'R', 1, 0) = 0
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


  <br><br>

  <label for="placa">PLACA - UNIDAD </label>
  <select class="custom-select" id="placa" name="placa" name="placa" required>
 <option >  </option>
    <?php 
      $queryun="SELECT * FROM unidades";
      $resultun=mysqli_query($conexion, $queryun);
    ?>
    <?php while($filasun=mysqli_fetch_assoc($resultun)) { ?>
      
    <option value="<?php echo $filasun ['id_vh']?>" >
      <?php echo $filasun ['vh_placa']  ?>
    </option>
    <?php } ?>
    
  </select>

<br>  
<br>

  <label for="observacion">Observación</label>
  <textarea class="form-control" id="observacion" name="observacion" placeholder="Ingresa Observaciones" rows="2"></textarea>

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
