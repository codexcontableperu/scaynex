<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="style.css">
<?php include('includes/menubar.php'); ?>
<?php include("../data/conexion.php"); ?>

    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="main.css">  
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">


<style type="text/css">
	.form-control {

height: calc(1.8125rem + 10px);


}
	.OP{
      display: flex;
      align-content: center;
    } 

	table{
      font-size: 12px;
    } 

img {
      border-radius: 50%;
      height: 50px;
      width: 50px;
      margin-right: 10px;
    }
    .nick {
      color: white;
      
      padding-left: 10px;
      padding-right: 10px;
      background: grey ;
      border-radius: 10px;
    }

</style>

<?php


     $query="
SELECT usuarios.*, usuarios.user_nick
FROM usuarios
ORDER BY usuarios.user_nick;

				";
     $result=mysqli_query($conexion, $query);




?>



<div class= "tablescroll" > 

<div class="container p-3">

      <div class="row" >
        <div class="col-12" class="colm">

    

   <table id="example" class="table table-sm table-bordered  " >
  <thead class="thead-dark text-center ">
    <tr>
      <th scope="col ">USUARIO</th> 
      <th scope="col">NICK-NOMBRE</th>     
      <th scope="col">CONTACTO</th>
      <th scope="col">SALARIO</th>
      <th scope="col">ACTIVO</th>

      
    </tr>
  </thead>

  <?/*---contenido de la tabla---*/?>


  <tbody>

	<?php while($filas=mysqli_fetch_assoc($result)) { ?>
	    <tr>
	      <td class="text-center">
	      	<img src="../panel/<?php echo $filas ['user_avatar'] ; ?>" alt="foto"><br>
	      	<span class="nick"> <?php echo $filas ['user_dni'];?></span> <br>
	      	<div class="OP">
	      	<a href="crud_user/delete.php?id=<?php echo $filas ['id_user'];?>" class="btn btn-danger"> 
        	<span class="icon-bin"></span>
	    	   </a>
	      	<a href="user_update2.php?id=<?php echo $filas ['id_user'];?>" class="btn btn-primary"> 
	        EDITAR	
	    	  </a>	

	      	</div>


	      <td>
	      	   <span class="nick"> NICK:  <?php echo $filas ['user_nick'];?></span> <br>
             <?php echo $filas ['user_nombre'];?>
             
	      </td>

	      <td>

             MOVIL:    <?php echo $filas ['user_telefono'];?><br>
             CARGO:  <?php echo $filas ['user_cargo'];?><br>
              
	      </td>
	      <td>
	           SALARIO:    <?php echo $filas ['user_salario'];?><br>
             ASISTECIA:  <?php echo $filas ['user_hingreso'];?>	
	      </td>

	     <td>

			<div class="container text-center ">
         
				<div class="OP">
	    	<?php if ($filas ['user_activo']=="si") {
        		?><a href="crud_user/activar.php?id=<?php echo $filas ['id_user'];?>&a=<?php echo $filas ['user_activo'];?>" class="btn btn-success"> 
	            <?php echo $filas ['user_activo'];?>
	    	      </a><?php
        	} elseif ($filas ['user_activo']=="no") {
        		?><a href="crud_user/activar.php?id=<?php echo $filas ['id_user'];?>&a=<?php echo $filas ['user_activo'];?>" class="btn btn-light "> 
	            <?php echo $filas ['user_activo'];?>
	    	      </a><?php
        	}
        	?>

	    	<a href="crud_user/nivel.php?id=<?php echo $filas ['id_user'];?>&a=<?php echo $filas ['user_perfil'];?>" class="btn btn-primary"> 
	        <?php echo $filas ['user_perfil'];?>	
	    	</a>
        </div>

	    	<?php if ($filas ['user_clave']!=123) {
        		?> <a href="crud_user/clave.php?id=<?php echo $filas ['id_user'];?>&a=<?php echo $filas ['user_clave'];?>" class="btn btn-success"> 
	        <span class="icon-history"></span>	
	    	</a><?php
        	} else {
        		?>  <a href="crud_user/clave.php?id=<?php echo $filas ['id_user'];?>&a=<?php echo $filas ['user_clave'];?>" class="btn btn-warning "> 
	        <span class="icon-history"></span>	<?php echo $filas ['user_clave'];?>
	    	</a><?php
        	}
        	?>



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



<div class="card">
  <div class="card-body">

<a href="user_create.php" class="btn btn-primary btn-lg btn-block"> 
          <span class="icon-pencil"></span> NUEVO USUARIO 
        </a>
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