<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  </head>
  <body>




<?php include("./../../data/conexion.php"); ?>


<?php 

/*---NEW ARTICULOS---*/

if (($_GET['s'])==0) {

  $us= $_GET['us'];


/// actualisa tabla

  $query = "UPDATE ledger set 
  estado  = 'L' 
  WHERE id_responsable=$us";

  mysqli_query($conexion, $query);
mysqli_close($conexion);


  $query2 = "UPDATE asistencias set 
  estado  = 'L' 
  WHERE  id_empleado =$us";

  mysqli_query($conexion, $query2);
mysqli_close($conexion);



echo'<script type="text/javascript">
    window.location.href="./../envio_fondos.php";
    </script>';



} else {
$us= $_GET['us'];
  ?>  
  <br> <br><br>


  <div class="container text-center">
  <div class="row">
<div class="col-12 col-md-8">
        <div class="card">
          <div class="card-body">
            <div>
                <div> <h4> Para poder liquidar la rendición el saldo debe ser igual a S/. 0.00 </h4></div>
              <br><br> 
               <a href="./../envio_fondosxuser.php?us=<?php echo $us;?>" class="btn btn-primary btn-lg btn-block" data-toggle="modal"> 
                                  &nbsp REGRESAR &nbsp
               </a>
            </div>
          </div>
        </div>
</div>
  </div>
  </div>





<?php } ?>

<!-- BOOTSTRAP 4 SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>


</body>
</html>
