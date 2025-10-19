<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="style.css">
<?php include("../data/conexion.php"); ?>



  <B>LISTADO DE GUIAS :</B>  <br>


<?php 
 $idr = $_GET['idr'];
 $idp = $_GET['idp'];


       $query5="

SELECT guias_remitente.id_guiar ,guias_remitente.gr_serienum, guias_remitente.id_ruta, guias_remitente.id_guiar, guias_remitente.id_prog, distritos.distrito, guias_remitente.fact_cliente, guias_remitente.gr_bultos, guias_remitente.gr_obs
FROM guias_remitente INNER JOIN distritos ON guias_remitente.destino_distrito = distritos.id_distrito
WHERE (((guias_remitente.id_ruta)=$idr))

                ";
     $result5=mysqli_query($conexion, $query5);

?> 

<table class="table table-bordered table-sm">
  <thead class="text-center">
    <tr>
      <th scope="col">DESTINO</th>
      <th scope="col"># DOCUEMNTO</th>
      <th scope="col"># BULTOS</th>
     
          
    </tr>
  </thead>
  <tbody>
          <?php while($filas5=mysqli_fetch_assoc($result5)) { ?>
    <tr>	
      <th> <?php echo $filas5 ['distrito'];?> </th>
      <td> G: <?php echo $filas5 ['gr_serienum'];?> <br> 
       F: <?php echo $filas5 ['fact_cliente'];?> </td>
      <td class="text-center"> <?php echo $filas5 ['gr_bultos'];?> </td>
      <td> 
				<a href="guiasrem_create_read.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&idg=<?php echo $filas5 ['id_guiar'] ?>" class="btn btn-success"> 
	        <span class="icon-pencil"></span>
	    	</a>
	      <a href="guiarem_delete.php?id=<?php echo $idr?>" class="btn btn-danger"> 
					<span class="icon-bin"></span>
	      	</a>

      </td>
    </tr>
      <?php } ?>


  </tbody>
</table>





<?php include('includes/footer.php'); ?>