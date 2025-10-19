<?php include('includes/header.php'); ?>
<?php include("../data/conexion.php"); ?>
<?php include('includes/menubar.php'); ?>

<style type="text/css">
	
.header {
 background-color: #f1f2f6;
padding: 3px;
}

.body {
    padding: 10px;
    padding-left: 15px;
}


.tarjeta {
 width: 160px;
margin-bottom: 15px;
font-size: 14px;

}

.tiket {

font-size: 13px;

}

todo

{

font-size: 13px;

}



</style>




<?php
     $query1="
SELECT head_programaciones.id_head, head_programaciones.fechareg, head_programaciones.head_fecha, head_programaciones.head_nombre, clientes.cte_nombrecomercial, clientes.cte_logo, head_programaciones.hora_cita
FROM head_programaciones INNER JOIN clientes ON head_programaciones.id_cliente = clientes.id_cliente
WHERE (((head_programaciones.fechareg)='$hoy'))
				";
     $result1=mysqli_query($conexion, $query1);

?>



<div class="tiket card">
	<h5 class="card-header"><span class="icon-truck"></span> <B>PROGRAMACION: <?php echo $hoyfor ;?></B> </h5>
  <div class="card-body">
  <h5 class="card-title"><B> <span class="icon-road"></span> VIAJES PROGRAMADOS:</B> </h5>

   <p class="card-text"> 

	<?php while($filas1=mysqli_fetch_assoc($result1)) { ?>
               <?php $idh= $filas1 ['id_head'];?> 
               ▪  <mark> 
<a href="prog_create_read.php?id=<?php echo $filas1 ['id_head']?>">OTR: 000<?php echo $filas1 ['id_head'];?> </a> -  <?php echo $filas1 ['cte_nombrecomercial'];?> / H. CITA: <?php echo $filas1 ['hora_cita'];?></mark><br>   

              <?php
								     $query2="
											SELECT programaciones.cant_estiva, programaciones.id_head, programaciones.id_prog, cuentas.cta_nombrecomercial, unidades.vh_placa AS va, unidades_1.vh_placa AS vr, usuarios.user_nick AS conductor, usuarios_1.user_nick AS ayudante, tipo_prog.tprog_nombre, habilidad.nom_habilidad
											FROM ((((((programaciones INNER JOIN cuentas ON programaciones.id_cta = cuentas.id_cta) INNER JOIN habilidad ON programaciones.id_habilidad = habilidad.id_habilidad) INNER JOIN tipo_prog ON programaciones.id_tprog = tipo_prog.id_tprog) INNER JOIN unidades ON programaciones.vh_asignado = unidades.id_vh) INNER JOIN usuarios ON programaciones.id_conductor = usuarios.id_user) INNER JOIN usuarios AS usuarios_1 ON programaciones.id_ayudante = usuarios_1.id_user) INNER JOIN unidades AS unidades_1 ON programaciones.vh_reportado = unidades_1.id_vh
											WHERE (((programaciones.id_head)='$idh'))
								     ";

								     $result2=mysqli_query($conexion, $query2);
								?>

								<?php while($filas2=mysqli_fetch_assoc($result2)) { ?>

							              &nbsp &nbsp - Cuenta :<?php echo $filas2 ['cta_nombrecomercial'];?> 
							              / <?php echo $filas2 ['tprog_nombre'];?> / <?php echo $filas2 ['nom_habilidad'];?> <br>
							              &nbsp &nbsp - Placa :<?php echo $filas2 ['va'];?> 
							              / <?php echo $filas2 ['conductor'];?> / <?php echo $filas2 ['ayudante'];?> / E: <?php echo $filas2 ['cant_estiva'];?><br>

								 <?php } ?>
                        


	 <?php } ?>

	</p>

  </div>
</div>




<?php include('includes/footer.php'); ?>