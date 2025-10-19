<?php ob_start(); ?>
<?php include("../data/conexion.php"); ?>
<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="style.css">

<style>

.table td, .table th {
  padding: .10rem;
  vertical-align:  baseline;

}

        table {
            font-size: 9px; /* Cambia el tamaño de fuente para toda la tabla */
            width: 100%; /* Define el ancho de la tabla al 100% del contenedor */

        }

        /* Define el tamaño de fuente específico para las celdas de datos */
        .tdx {
            font-size:10px; /* Cambia el tamaño de fuente para las celdas de datos */

        }



  thead {

    align-items: center; /* Alinea verticalmente */
    text-align: center; /* Alinea horizontalmente */
  }

</style>


<?php

$idp=$_GET['idp'];
$idr=$_GET['idr'];

$queryo="




SELECT *
FROM rd_servicio
WHERE (((rd_servicio.ID_SERV)=$idr));


";
$resulto=mysqli_query($conexion, $queryo);
$filaso=mysqli_fetch_assoc($resulto);


?>
<br>
<div class="d-flex justify-content-between align-items-center">

    <h4 class="text-center">HOJA DE RUTA ASIGNADA AL SERVICIO</h4>

</div>



<div>


  <div class="card ">
</div>    
      <h5 class="card-title">
<!-- Button trigger modal -->

      </h5>

      <table class="table table-sm table-striped ">
  <tbody>
    <tr>
      <th >EPS</th>
      <td class="tdx"><?php echo $filaso ['EPS']?></td>
      <th >PLACA</th>
      <td><?php echo $filaso ['PLACA']?></td>

    </tr>
    <tr>
      <th >TEMPERATURA</th>
      <td class="tdx"><?php echo $filaso ['TEMPERATURA']?></td>
      <th >EMPRESA</th>
      <td class="tdx"><?php echo $filaso ['CLIENTE']?></td>

    </tr>
      <tr>
      <th >CONDUCTOR</th>
      <td class="tdx"><?php echo $filaso ['CONDUCTOR']?></td>
      <th >CUENTA</th>
      <td class="tdx"><?php echo $filaso ['CUENTA']?></td>

    </tr>
    <tr>
      <th >AUXILIAR 1</th>
      <td class="tdx"><?php echo $filaso ['AUXILIAR1']?></td>
      <th >CLIENTE</th>
      <td class="tdx"><?php echo $filaso ['CTE_TERCERO']?></td>
    </tr>
    <tr>
      <th >AUXILIAR 2</th>
      <td class="tdx"><?php echo $filaso ['AUXILIAR2']?></td>
      <th >HORA DE CITA</th>
      <td class="tdx"><?php echo $filaso ['H_CITA']?></td>
    </tr>

    <tr>
      <th>AUXILIAR 3</th>
      <td class="tdx"><?php echo $filaso ['AUXILIAR3']?> </td>
      <th >OBSERVACION</th>
      <td class="tdx"><?php echo $filaso ['OBSERVACION_SERV']?></td>      
    </tr>

    

  </tbody>
</table>
</div>
<?php
$queryh="
SELECT hruta.id_serv, rd_segimientos_head.S_FECHA, hruta.h_llegadaorigen, guias_remitente.gr_serienum, guias_remitente.fact_cliente, guias_remitente.gr_bultos, rd_descargas.pe_cliente, rd_descargas.desg_distrito, rd_descargas.hrcita, rd_descargas.prioridad, hruta.h_salidaorigen, rd_descargas.h_llegadadestino, rd_descargas.h_entrega, rd_descargas.t_entrega, rd_descargas.h_salida, rd_descargas.t_recepcion, rd_descargas.obs_descarga, hruta.id_ruta
FROM (guias_remitente INNER JOIN rd_descargas ON guias_remitente.id_desg = rd_descargas.id_descaga) INNER JOIN ((hruta INNER JOIN rd_servicio ON hruta.id_serv = rd_servicio.ID_SERV) INNER JOIN rd_segimientos_head ON hruta.id_prog = rd_segimientos_head.Id_SERG) ON rd_descargas.id_hruta = hruta.id_serv
WHERE (((hruta.id_serv)=$idr));


";
$resulth=mysqli_query($conexion, $queryh);



?>



<table  class="table table-sm table-bordered ">
  <thead class="thead" style=" text-align: center;background-color: #fafafa;">

  <tr>
      <th colspan="11">ALMACEN</th>
      <th colspan="6">PUNTO DE ENTREGA CLIENTE</th>
      <th rowspan="3" >OBSERVACION</th>
    </tr>

        <tr>
      <th colspan="2">RECEPCION</th>
      <th colspan="2">Nro DOCUMENTO</th>
      
      <th rowspan="2">Bultos</th>
      <th rowspan="2"> Punto de Entrega Cliente </th>
      <th rowspan="2"> Distrito</th>
      <th rowspan="2">Despacho</th>
      <th rowspan="2">Prioridad</th>
      <th colspan="2">Salida de Móvil</th>
      
      <th rowspan="2" >Hora llegada</th>
      <th rowspan="2" >Tiempo Espera</th>
      <th rowspan="2" >Hora Entrega</th>
      <th rowspan="2" >Temp Entrega</th>
      <th rowspan="2" >Hora Salida</th>
      <th rowspan="2" >Tiempo Resep</th>
      

    </tr>

    <tr>
      <th>Fecha</th>
      <th>Hora</th>
      <th>T</th>
      <th>Numero</th>
      <th>Fecha</th>
      <th>Hora</th>
      

    </tr>
  </thead>
  <tbody>
    <?php while($filash=mysqli_fetch_assoc($resulth)) { ?>
    <tr>
      <td><?php echo $filash ['S_FECHA'];?> </td>
      <td><?php echo $filash ['h_llegadaorigen'];?></td>
      <td>F<br>G</td>
      <td><?php echo $filash ['fact_cliente'];?><br>
          <?php echo $filash ['gr_serienum'];?>
      </td>
      <td><?php echo $filash ['gr_bultos'];?></td>
      <td><?php echo $filash ['pe_cliente'];?></td>
      <td><?php echo $filash ['desg_distrito'];?></td>
      <td><?php echo $filash ['hrcita'];?></td>
      <td><?php echo $filash ['prioridad'];?></td>
      <td><?php echo $filash ['S_FECHA'];?></td>
      <td><?php echo $filash ['h_salidaorigen'];?></td>
      <td><?php echo $filash ['h_llegadadestino'];?></td>
      <td>30 minutos</td>
      <td><?php echo $filash ['h_entrega'];?></td>
      <td><?php echo $filash ['t_entrega'];?></td>
      <td><?php echo $filash ['h_salida'];?></td>
      <td>15 minutos</td>
      <td><?php echo $filash ['obs_descarga'];?></td>
    </tr>
    

      <?php } ?>
    
  </tbody>
</table>

<?php
$tablaa=ob_get_clean();
//echo $tablaa;
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled'=> true));
$dompdf->setOptions($options);

$dompdf->loadHTML($tablaa);
//$dompdf->setPaper('letter');
$dompdf->setPaper('A4','landscape');

$dompdf->render();
$dompdf->stream("hoja_ruta.pdf", array('Attachment'=> False));
?> 

</body>
</html>


