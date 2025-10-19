<?php include('includes/header.php'); ?>


<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="./style.css">
<?php include('includes/menubar.php'); ?>

<?php include("../data/conexion.php"); ?>






<?php
     $query1="
SELECT usuarios.id_user, ingreso_xuser.SumaDeimporte AS INGRESOS
FROM usuarios LEFT JOIN ingreso_xuser ON usuarios.id_user = ingreso_xuser.id_responsable
WHERE (((usuarios.id_user)=$id_userup));

        ";
     $result1=mysqli_query($conexion, $query1);
     $filas1=mysqli_fetch_assoc($result1);

?>

<?php
     $query2="
SELECT usuarios.id_user, egreso_xuser.SumaDeimporte AS EGRESOS
FROM usuarios LEFT JOIN egreso_xuser ON usuarios.id_user = egreso_xuser.id_responsable
WHERE (((usuarios.id_user)=$id_userup));

        ";
     $result2=mysqli_query($conexion, $query2);
     $filas2=mysqli_fetch_assoc($result2);

?>
<?php
     $query3="

SELECT usuarios.id_user, saldo_xuser.SumaDeimporte AS SALDO
FROM usuarios LEFT JOIN saldo_xuser ON usuarios.id_user = saldo_xuser.id_responsable
WHERE (((usuarios.id_user)=$id_userup));

        ";
     $result3=mysqli_query($conexion, $query3);
     $filas3=mysqli_fetch_assoc($result3);
?>






<div class="container p-3">

  
  <div class="row" >
    <div class="col-12 " class="colm">
<table class="table table-dark ">

  <tbody>
    <tr >
      
        <th scope="row"> <a href="#DINGRESOS"  class="btn btn-success "  data-toggle="modal"> ○ TOTAL INGRESOS </a></th>    
 
      

      <td class="text-right">S/. <?php echo $filas1 ['INGRESOS']?></td>

    </tr>
    <tr>
      <th scope="row"> &nbsp ○ TOTAL EGRESOS</th>
      <td class="text-right">S/. <?php echo $filas2 ['EGRESOS']?></td>

    </tr>
    <tr>
      <th scope="row"> &nbsp ○ SALDO DISPONIBLE</th>
      <td class="text-right">S/. <?php echo $filas3 ['SALDO']?></td>

    </tr>
  </tbody>
</table>
    </div>


    <div class="col-12 ">
      <div class="card">
       <a href="reporte.php?us=<?php echo $id_userup?>" class="btn btn-success btn-lg btn-block" > 
                          &nbsp IMPRIMIR REPORTE &nbsp
       </a>

    </div>




<?php
     $query4="

SELECT ledger.id_ledger, ledger.id_responsable, ledger.estado, ledger.tipo_dh, ledger.fecha_registro, ledger.kilometraje, rend_conceptos.concepto, tipo_doc.abrev, ledger.num_doc, ledger.importe
FROM (ledger INNER JOIN rend_conceptos ON ledger.id_concepto = rend_conceptos.id_concepto) INNER JOIN tipo_doc ON ledger.tipo_doc = tipo_doc.id_tipoD
WHERE (((ledger.id_responsable)=$id_userup) AND ((ledger.estado)='R') AND ((ledger.tipo_dh)='D' ));


        ";
     $result4=mysqli_query($conexion, $query4);
 
?>

<style type="text/css">  


.tablescroll {

overflow:auto;

}
 </style>

<div class= "tablescroll" >  
 
<table class="table table-sm">
  <thead class="thead-dark">
    <tr>
      <th> <span class="icon-bin"></span></th>
      <th scope="col">FECHA</th>
      <th scope="col">KM</th>
      <th scope="col">CONCEPTO</th>
      <th scope="col">DOCUMENTO</th>
      <th scope="col">IMPORTE</th>
    </tr>
  </thead>
  <tbody>

    <?php while($filas4=mysqli_fetch_assoc($result4)) { ?>

    <tr>
      <th scope="row"> <a href="./crud_gastos/delete.php?id=<?php echo $filas4 ['id_ledger'];?>"><span class="icon-bin"></span></a></th>
      <td>  <?php echo $filas4 ['fecha_registro'];?></td>
      <td><?php echo $filas4 ['kilometraje'];?></td>
      <td><?php echo $filas4 ['concepto'];?></td>
      <td><?php echo $filas4 ['abrev'];?> / <?php echo $filas4 ['num_doc'];?></td>
      <td class="text-right"><?php echo $filas4 ['importe'];?></td>
  
    </tr>

   <?php } ?>

  </tbody>
</table>


</div>





<div class="card">
  <div class="card-body">
    <div>
       <a href="#NGASTO" class="btn btn-primary btn-lg btn-block" data-toggle="modal"> 
                          &nbsp INGRESAR GASTO &nbsp
       </a>
    </div>
  </div>
</div>


<div class="card">
  <div class="card-body">
    <div>
       <a href="#NSALARIO" class="btn btn-warning btn-lg btn-block" data-toggle="modal"> 
                          &nbsp A CTA DE SUELDO &nbsp
       </a>
    </div>
  </div>
</div>






<div class="modal" tabindex="-1" role="dialog" id="NGASTO">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">NUEVO GASTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_gastos/create.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>
<input class="form-control"  type="hidden" id="fechacrea" name="fechacrea" value="<?php echo $hoy ; ?> " readonly>

  <div class="form-group" >
  <label for="fecha_registro">FECHA</label>
  <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" required>

<br>
  <div class="form-group">
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
</div>




  <label for="kilometraje">KILOMETRAJE</label>
  <input type="text" class="form-control" id="kilometraje" name="kilometraje" placeholder="Ingresa el kilometraje">
<br>


<div class="form-group">
  <label for="Concepto">COMCEPTO : </label>
  <select class="custom-select" id="Concepto" name="Concepto" name="Concepto" required>
<option >  </option>
    <?php 
      $query2="SELECT *FROM rend_conceptos WHERE id_concepto > 2";
      $result2=mysqli_query($conexion, $query2);
    ?>
    <?php while($filas2=mysqli_fetch_assoc($result2)) { ?>
      
    <option value="<?php echo $filas2 ['id_concepto']?>" >
      <?php echo $filas2 ['concepto']  ?>
    </option>
    <?php } ?>

  </select>
</div>

<br>
  <label for="gls">GLS - COMBUSTIBLE </label>
  <input type="number" step="any" class="form-control" id="gls" name="gls" placeholder="Ingresa cantidad de  gls">
<br>


<div class="form-group">
  <label for="tipo_doc">TIPO DE COMPROBANTE : </label>
  <select class="custom-select" id="tipo_doc" name="tipo_doc" required>
<option >  </option>
    <?php 
      $queryT="SELECT * FROM tipo_doc ";
      $resultT=mysqli_query($conexion, $queryT);
    ?>
    <?php while($filasT=mysqli_fetch_assoc($resultT)) { ?>
      
    <option value="<?php echo $filasT ['id_tipoD']?>" >
      <?php echo $filasT ['name_doc']  ?>
    </option>
    <?php } ?>

  </select>
</div>


  <label for="documento">NUMERO DE COMPROBANTE</label>
  <input type="text" class="form-control" id="documento" name="documento"  placeholder="0001-0000" required>
<br>

<div class="form-group">
  <label for="proveedor">RUC - PROVEEDOR</label>
  <select class="custom-select" id="proveedor" name="proveedor" required >
<option >  </option>
    <?php 
      $queryp="SELECT proveedores.id_proveedor, proveedores.cte_nombrecomercial
FROM proveedores
ORDER BY proveedores.cte_nombrecomercial;
";
      $resultp=mysqli_query($conexion, $queryp);
    ?>
    <?php while($filasp=mysqli_fetch_assoc($resultp)) { ?>
      
    <option value="<?php echo $filasp ['id_proveedor']?>" >
      <?php echo $filasp ['cte_nombrecomercial']  ?>
    </option>
    <?php } ?>

  </select>
</div>


<br>

  <label for="observacion">Observación</label>
  <textarea class="form-control" id="observacion" name="observacion" placeholder="Ingresa Observaciones" rows="2"></textarea>
<br>
  <label for="importe">IMPORTE</label>
  <input type="number" step="any" class="form-control" id="importe"  name="importe" placeholder="S/. 0.00" required>


</div>


      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">REGISTRAR</button>
</form>
        
      </div>
    </div>
  </div>
</div>









<div class="modal" tabindex="-1" role="dialog" id="DINGRESOS">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">INGRESOS OBTENIDOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<?php
     $query4="

SELECT ledger.id_responsable, ledger.estado, ledger.tipo_dh, ledger.fecha_registro, ledger.kilometraje, rend_conceptos.concepto, tipo_doc.abrev, ledger.num_doc, ledger.importe, ledger.salario
FROM (ledger INNER JOIN rend_conceptos ON ledger.id_concepto = rend_conceptos.id_concepto) INNER JOIN tipo_doc ON ledger.tipo_doc = tipo_doc.id_tipoD
WHERE (((ledger.id_responsable)=$id_userup) AND ((ledger.estado)='R') AND ((ledger.tipo_dh)='H' ));


        ";
     $result4=mysqli_query($conexion, $query4);
 
?> 

<table class="table table-sm">
  <thead class="thead-dark">
    <tr>
      <th scope="col">FECHA</th>
      <th scope="col">CONCEPTO</th>
      <th scope="col">A RENDIR</th>
     </tr>
  </thead>
  <tbody>

    <?php while($filas4=mysqli_fetch_assoc($result4)) { ?>

    <tr>
      <th scope="row"><?php echo $filas4 ['fecha_registro'];?></th>
      <td><?php echo $filas4 ['concepto'];?></td>
      <td class="text-right"><?php echo $filas4 ['importe'];?></td>
    </tr>



   <?php } ?>

  </tbody>
</table>
        
      </div>
    </div>
  </div>
</div>


     






<div class="modal" tabindex="-1" role="dialog" id="NSALARIO">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">A CUENTA DE SUELDO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_salario/create.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>
<input class="form-control"  type="hidden" id="fechacrea" name="fechacrea" value="<?php echo $hoy ; ?> " readonly>

  <div class="form-group" >
  <label for="fecha_registro">Fecha</label>
  <input type="date" class="form-control" id="fecha_registro" name="fecha_registro">
<br>

  <label for="observacion">Observación</label>
  <textarea class="form-control" id="observacion" name="observacion" placeholder="Ingresa Observaciones" rows="2"></textarea>
<br>
  <label for="salario">Importe</label>
  <input type="number" step="any" class="form-control" id="salario"  name="salario" placeholder="S/. 0.00">

</div>


      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-warning btn-lg btn-block" id="guardar" name="guardar">REGISTRAR </button>
</form>
        
      </div>
    </div>
  </div>
</div>




<?php include('includes/footer.php'); ?>