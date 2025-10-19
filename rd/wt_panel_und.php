<?php include("../data/conexion.php"); ?>
<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="whatsaap/stilo_what.css">
<?php include('whatsaap1.php'); ?>

<style>
    .container{
        margin-top: 30px;


    }
.btn {
    color: white;
    background: #25D366;
}


.info {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0;
}

.step {
    text-align: center;
    margin: 0 1px; /* Reducir el espacio entre los pasos */
    transition: opacity 0.3s ease-in-out;

}

a {
    text-decoration: none; /* Eliminar el subrayado, si también deseas quitarlo */
    color: black;
}

img:hover  {
    opacity: 0.7;
    border: 2px solid #008169; /* Cambiar el borde a verde al pasar el cursor */
}

img {
    width: 80px; /* Ajusta el tamaño de los iconos según sea necesario */
    border-radius: 50%;

}

.image-container:hover img {
    transform: scale(1.1); /* Cambia la escala al 110% al pasar el cursor */
}

p {
    font-size: 10px; /* Ajusta el tamaño de la letra según sea necesario */
}


        table {
            font-size: 10px; /* Cambia el tamaño de fuente para toda la tabla */
            width: 50%; /* Define el ancho de la tabla al 100% del contenedor */
        }

        /* Define el tamaño de fuente específico para las celdas de datos */
        td {
            font-size: 8px; /* Cambia el tamaño de fuente para las celdas de datos */
        }

</style>

    </div>
<?php

$ID = $_GET['id'];


$queryo="
SELECT rd_segimientos_head.*, rd_segimientos_head.Id_SERG
FROM rd_segimientos_head
WHERE (((rd_segimientos_head.Id_SERG)=$ID));

";
$resulto=mysqli_query($conexion, $queryo);
$filaso=mysqli_fetch_assoc($resulto);


?>
UNIDAD PROGRAMADA
<div> <span class="icon-truck">&nbsp<?php echo $filaso ['S_FECHA']?> </span> 
  <div class="card ">
</div>    
      <h5 class="card-title">
<!-- Button trigger modal -->

      </h5>

      <table class="table table-sm table-striped ">
  <tbody>
    <tr>
      <th >EPS</th>
      <td><?php echo $filaso ['EPS']?></td>
      <th >PLACA</th>
      <td><?php echo $filaso ['PLACA']?></td>

    </tr>
    <tr>
      <th >TEMPERATURA</th>
      <td><?php echo $filaso ['TEMPERATURA']?></td>
      <th >SERVICIO</th>
      <td><?php echo $filaso ['SERVICIOS']?></td>

    </tr>
      <tr>
      <th >CONDUCTOR</th>
      <td><?php echo $filaso ['CONDUCTOR']?></td>
      <th >CLIENTE</th>
      <td><?php echo $filaso ['ID_CLIENTE']?></td>

    </tr>
    <tr>
      <th >AUXILIAR 1</th>
      <td><?php echo $filaso ['AUXILIAR1']?></td>
      <th >HORA DE CITA</th>
      <td><?php echo $filaso ['H_CITA']?></td>
    </tr>
    <tr>
      <th >AUXILIAR 2</th>
      <td><?php echo $filaso ['AUXILIAR2']?></td>
      <th >OBSERVACION</th>
      <td><?php echo $filaso ['OBS_PROG']?></td>
    </tr>

    <tr>
      <th>AUXILIAR 3</th>
      <td><?php echo $filaso ['AUXILIAR3']?> </td>
    </tr>

    

  </tbody>
</table>

  </div>


<div class="container">
  <div class="row">
    <div class="col-sm">

<div class="info">
    <div class="step" id="step1">
        <a href="./wt_form_base.php?id=<?php echo $filaso ['Id_SERG']?>">        
        <img src="./whatsaap/salida_base.png" alt="Paso 1">
        <p>SALIDA_BASE</p>
        </a>

    </div>
    <div class="step" id="step2">
        <a href="./wt_form_almacen.php?id=<?php echo $filaso ['Id_SERG']?>"> 
        <img src="./whatsaap/salida_alm.png" alt="Paso 2">
        <p>SALIDA_ALMACEN</p>
        </a>
    </div>
    <div class="step" id="step3">
        <a href="./wt_idplaca.php"> 
        <img src="./whatsaap/en_rutas.png" alt="Paso 3">
        <p>REPORTE_SERVICIO</p>
        </a>
    </div>
    <div class="step" id="step3">
        <a href="./wt_idplaca_fin.php"> 
        <img src="./whatsaap/retorno.png" alt="Paso 3">
        <p>RETORNO</p>
        </a>
    </div>
</div>
    </div>
  </div>
</div>  



<div class="container">
  <div class="row">
    <div class="col-sm">

<div class="info">
    <div class="step" id="step1">
        <a href="">        
        <img src="./whatsaap/gasto.png" alt="Paso 1">
        <p>GASTOS</p>
        </a>

    </div>
    <div class="step" id="step2">
        <a href=""> 
        <img src="./whatsaap/liquidacion.png" alt="Paso 2">
        <p>LIQUIDACIONES</p>
        </a>
    </div>
    <div class="step" id="step3">
        <a href=""> 
        <img src="./whatsaap/incidencias.png" alt="Paso 3">
        <p>INCIDENCIAS</p>
        </a>
    </div>
    <div class="step" id="step3">
        <a href=""> 
        <img src="./whatsaap/datos.png" alt="Paso 3">
        <p>FICHA DATOS</p>
        </a>
    </div>
</div>
    </div>
  </div>
</div>  







<?php include('includes/footer.php'); ?>