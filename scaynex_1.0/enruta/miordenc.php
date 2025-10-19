<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="./miruta.css">


<?php include('includes/menubar.php'); ?>

<div class="container p-3">
<h4> ORDENES DE SERVICIO </h4>

</div>


  <?php include("../data/conexion.php"); ?>

  <?php
       $query="

SELECT miordenc.*, miordenc.id_conductor, miordenc.id_ayudante
FROM miordenc
WHERE (((miordenc.id_conductor)=$id_userup)) OR (((miordenc.id_ayudante)=$id_userup));

          ";
       $result=mysqli_query($conexion, $query);
  ?>



<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link " href="miorden.php">ACTIVAS</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="miordenc.php">CERRADAS</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="miordenh.php">HISTORICO</a>
  </li>

</ul>

<br><br>
<div class="container ">

   <div class="row">

    <?php while($filas=mysqli_fetch_assoc($result)) { ?>

        <div class="col-6 col-md-3">
          <div class="tarjeta card card border-primary " >

            <div class="header text-center"> 
            <img loading="lazy" src="../panel/<?php echo $filas ['cta_logo'];?>" width="80" heigth="20" >
            </div>

            <div class="body  ">
              <h5 class="card-title" ><?php echo $filas ['tprog_nombre'];?> -  <?php echo $filas ['nom_habilidad'];?></h5>
              <p class="card-text ">
               <img loading="lazy" src="../panel/<?php echo $filas ['vh_avatar'];?>" width="30" heigth="30" > 
               - <?php echo $filas ['vh_placa'];?> <br>
                ____________________<br>
                <span class="icon-user-tie">&nbsp</span>COND:   <?php echo $filas ['conductor'];?> <br>
                <span class="icon-user">&nbsp</span>AYUD:   <?php echo $filas ['ayudante'];?> <br>
                <span class="icon-users">&nbsp</span>ESTIBA:   <?php echo $filas ['cant_estiva'];?> <br>
                <span class="icon-profile">&nbsp</span>OBS:   <?php echo $filas ['obs_prog'];?>
              </p>
            </div>

              <div class="footer " >
              <a href="ruta_nuevo.php?idp=<?php echo $filas ['id_prog']?>" class="btn btn-primary btn-lg btn-block">INICIAR</a> 
              </div>



          </div>
        </div>
       
    <?php } ?>


   </div>   

</div>






<?php include('includes/footer.php'); ?>