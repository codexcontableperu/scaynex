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
