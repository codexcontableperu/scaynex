<?php include('includes/header.php'); ?>

<?php include("../data/conexion.php"); ?>
<link rel="stylesheet" href="./miruta.css">
<?php
$idr=$_GET['idr'];
$idp=$_GET['idp'];
     $query="


SELECT programaciones.id_prog, clientes.cte_ruc, clientes.cte_nombrecomercial, cuentas.cta_ruc, cuentas.cta_nombrecomercial, unidades.vh_avatar, unidades.vh_placa, usuarios.user_nombre AS consuctor, usuarios_1.user_nombre AS ayudante, head_programaciones.head_fecha, programaciones.cant_estiva, tipo_prog.tprog_nombre, programaciones.serie_guiatrans, programaciones.num_guiatrans, programaciones.obs_prog, habilidad.nom_habilidad, hruta.*, hruta.id_ruta
FROM ((((unidades INNER JOIN ((((head_programaciones INNER JOIN programaciones ON head_programaciones.id_head = programaciones.id_head) INNER JOIN clientes ON head_programaciones.id_cliente = clientes.id_cliente) INNER JOIN hruta ON programaciones.id_prog = hruta.id_prog) INNER JOIN cuentas ON programaciones.id_cta = cuentas.id_cta) ON unidades.id_vh = programaciones.vh_reportado) INNER JOIN usuarios ON programaciones.id_conductor = usuarios.id_user) INNER JOIN usuarios AS usuarios_1 ON programaciones.id_ayudante = usuarios_1.id_user) INNER JOIN tipo_prog ON programaciones.id_tprog = tipo_prog.id_tprog) INNER JOIN habilidad ON programaciones.id_habilidad = habilidad.id_habilidad
WHERE (((hruta.id_ruta)=$idr))

				";
     $result=mysqli_query($conexion, $query);
     $filas=mysqli_fetch_assoc($result);
     ?>

<div class="card">
  <div class="card-body">
   <B><span class="icon-attachment"></span> HOJA DE RUTA </B> P<?php echo $filas ['id_prog'];?>00<?php echo $filas ['id_ruta'];?> - <?php echo $filas ['head_fecha'];?>
  </div>
</div>



<div class="tiket card">
  <div class="card-body">
  <span class="icon-checkbox-checked"></span> <B>OTR:</B> 00<?php echo $filas ['id_prog'];?> <br>

<?php

     $query4="
SELECT serie_guiatrans , num_guiatrans ,id_prog
FROM programaciones
WHERE id_prog=$idp
                ";
     $result4=mysqli_query($conexion, $query4);
     $filas4=mysqli_fetch_assoc($result4);
?>

  <span class="icon-checkbox-checked"></span> <B>GUIA TRASPORTISTAS:</B> 00<?php echo $filas4['serie_guiatrans'];?> - 00<?php echo $filas4['num_guiatrans'];?> <br>

  <span class="icon-checkbox-checked"></span> <B>CLIENTE:</B> <?php echo $filas ['cte_nombrecomercial'];?> <br>
  <span class="icon-checkbox-checked"></span> <B>CUENTA:</B> <?php echo $filas ['cta_nombrecomercial'];?> <br>
  <span class="icon-checkbox-checked"></span> <B>VEHICULO:</B> <?php echo $filas ['vh_placa'];?><br>
  <span class="icon-checkbox-checked"></span> <B>CONDUCTOR:</B> <?php echo $filas ['consuctor'];?><br>
  <span class="icon-checkbox-checked"></span> <B>AYUDATE:</B> <?php echo $filas ['ayudante'];?><br>
  <span class="icon-checkbox-checked"></span> <B>ESTIVA: </B> <?php echo $filas ['cant_estiva'];?><br>
  <span class="icon-checkbox-checked"></span> <B>ALCANCE:</B> <?php echo $filas ['tprog_nombre'];?>  - <?php echo $filas ['nom_habilidad'];?> <br>
  
  <span class="icon-checkbox-checked"></span> <B>GUIAS REMISION:</B>  <br>
<?php 
       $query5="

SELECT guias_remitente.gr_serienum, guias_remitente.id_ruta, guias_remitente.id_guiar, guias_remitente.id_prog, distritos.distrito, guias_remitente.fact_cliente, guias_remitente.gr_bultos, guias_remitente.gr_obs
FROM guias_remitente INNER JOIN distritos ON guias_remitente.destino_distrito = distritos.id_distrito
WHERE (((guias_remitente.id_ruta)=$idr))

                ";
     $result5=mysqli_query($conexion, $query5);

?> 

<table class="table table-bordered table-sm">
  <thead class="text-center">
    <tr>
      <th scope="col">DESTINO</th>
      <th scope="col"># GUIA</th>
      <th scope="col"># FACTURA</th>
      <th scope="col">BULTOS</th>
          
    </tr>
  </thead>
  <tbody>
          <?php while($filas5=mysqli_fetch_assoc($result5)) { ?>
    <tr>
      <th> <?php echo $filas5 ['distrito'];?> </th>
      <td> <?php echo $filas5 ['gr_serienum'];?> </td>
      <td> <?php echo $filas5 ['fact_cliente'];?> </td>
      <td class="text-center"> <?php echo $filas5 ['gr_bultos'];?> </td>
    </tr>
      <?php } ?>


  </tbody>
</table>



  <span class="icon-checkbox-checked"></span> <B>OBSERVACION:</B> <?php echo $filas ['obs_prog'];?> <br>
  _________________________________________<br>


<?php

     $query2="
SELECT * FROM hruta
WHERE id_ruta=$idr ;

    ";
     $result2=mysqli_query($conexion, $query2);
     $filas2=mysqli_fetch_assoc($result2);



?>



  
 <B> <span class="icon-truck"></span> -RUTA-</B> <br>
     <B> 1     INICIO:</B> 
               ▪ HR: <mark>  <?php echo $filas ['h_inicio'];?> </mark>  &nbsp  
               ▪ TM: <mark> <?php echo $filas ['t_inicio'];?> </mark> <br> 
     <B> 2     SALIDA SE BASE:</B> 
               ▪ HR: <mark> <?php echo $filas ['h_salidabase'];?></mark> &nbsp  
               ▪ TM: <mark> <?php echo $filas ['t_salidabase'];?> </mark> 
               ▪ KM: <mark> <?php echo $filas ['k_salidabase'];?></mark><br> 
     <B> 3     LLEGADA A ORIGEN:</B> 
               ▪ HR: <mark> <?php echo $filas ['h_llegadaorigen'];?></mark> &nbsp  
               ▪ TM: <mark> <?php echo $filas ['t_llegadaorigen'];?></mark>  
               ▪ KM: <mark> <?php echo $filas ['k_llegadaorigen'];?></mark><br> 
     <B> 4     INICIO CARGA:</B>  
               ▪ HR: <mark> <?php echo $filas ['h_iniciocarga'];?></mark> &nbsp  
               ▪ TM: <mark> <?php echo $filas ['t_iniciocarga'];?></mark><br> 
     <B> 5     SALIDA ORIGEN:</B>  
               ▪ HR: <mark> <?php echo $filas ['h_salidaorigen'];?></mark> &nbsp  
               ▪ TM:<mark> <?php echo $filas ['t_salidaorigen'];?></mark><br> 
     <B> 6     LLEGADA DESTINO:</B> 
               ▪ HR: <mark> <?php echo $filas ['h_llegadadestino'];?></mark> &nbsp  
               ▪ TM: <mark> <?php echo $filas ['t_llegadadestino'];?></mark>  
               ▪ KM: <mark> <?php echo $filas ['k_llegadadestino'];?></mark><br>  
     <B> 7     INICIO DESCARGA:</B> 
               ▪ HR: <mark> <?php echo $filas ['h_iniciodescarga'];?></mark> &nbsp  
               ▪ TM: <mark> <?php echo $filas ['t_iniciodescarga'];?></mark><br>  
     <B> 8     RETORNO:</B> 
               ▪ HR: <mark> <?php echo $filas ['h_retorno'];?></mark> &nbsp  
               ▪ TM: <mark> <?php echo $filas ['t_retorno'];?></mark>  
               ▪ KM: <mark> <?php echo $filas ['k_retorno'];?></mark><br> 
     <B> 9     OBSERVACIONES:</B> 
               ▪  <mark> <?php echo $filas ['ruta_obs'];?></mark> &nbsp    <br> <br>

  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="" >
<div class="card">
  <div class="card-body">

<a href="ruta_pdf.php?idp=<?php echo $idp ;?>&idr=<?php echo $idr ;?>" class="btn btn-success btn-lg btn-block"> 
          <span class="icon-printer"></span>
        </a>
  </div>
</div>
</div>


<br>

<div class="container">
  <div class="row">

    <div class="col-sm">

                    <div class="container text-center ">
                        <a href="ruta_close.php?idp=<?php echo $filas2 ['id_prog']?>&idr=<?php echo $filas2 ['id_ruta']?>"  type="button" class="btn btn-danger btn-block " > CERRAR RUTA </a> 
                    </div>


    </div>
  </div>
</div>



<?php include('includes/footer.php'); ?>