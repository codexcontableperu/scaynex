<?php include("../data/conexion.php"); ?>
<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">
<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>


   <?/*---formulario tabla---*/?>
<?php
$tabla = 'diario';

if (isset($_GET['id'])) {
  $ID= $_GET['id'];
  $RD= $_GET['rd'];
     $query=" SELECT * FROM $tabla  WHERE ID_OPERA ='$ID' ";
     $result=mysqli_query($conexion, $query);
     $filas=mysqli_fetch_assoc($result);

?>
<div class="container">
  <div class="row">
    <div class="col-sm">

<form action="crud_diario/update.php" method="POST">

    <input type="hidden"  class="form-control" id="ID_OPERA" name="ID_OPERA" value="<?php echo $OP ?>" >
    <input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="<?php echo $RD ?>" >

<div class="form-group">
  <label for="CTA_CONT">TIPO DE GASTO </label>
  <select class="custom-select" id="CTA_CONT" name="CTA_CONT" value="<?php echo $filas ['CTA_CONT']; ?>" required >
<option >  </option>
    <?php 
      $queryT="SELECT * FROM cta_cont ";
      $resultT=mysqli_query($conexion, $queryT);
    ?>
    <?php while($filasT=mysqli_fetch_assoc($resultT)) { ?>
      
    <option value="<?php echo $filasT ['id_cta']?>" >
      <?php echo $filasT ['name_cta']  ?>
    </option>
    <?php } ?>

  </select>
</div>

<div class="form-group">
<label for="importe">IMPORTE</label>
  <input type="number" step="any" class="form-control" id="importe"  name="importe" placeholder="S/. 0.00" value="<?php echo $filas ['importe']; ?>" required>
</div>

 <div class="form-group">
  <label for="ANEXO">PROVEEDOR </label>
  <input class="form-control" list="ANEXOS" type="text" id="ANEXO" name="ANEXO" value="<?php echo $filas ['ANEXO']; ?>" required>
    <datalist id="ANEXOS" >  
    <option selected ></option>
    <?php 
      $queryp="SELECT proveedores.id_proveedor, proveedores.cte_nombrecomercial
FROM proveedores
ORDER BY proveedores.cte_nombrecomercial;
";
      $resultp=mysqli_query($conexion, $queryp);
    ?>
    <?php while($filasp=mysqli_fetch_assoc($resultp)) { ?>
      
    <option value="<?php echo $filasp ['cte_nombrecomercial']?>" >
      <?php echo $filasp ['cte_nombrecomercial']  ?>
    </option>
    <?php } ?>
  </datalist>
</div>
  
  <div class="form-group">
    <label for="KILOMETRAJE">KILOMETRAJE</label>
    <input type="number" class="form-control" id="KILOMETRAJE" name="KILOMETRAJE" step="any" value="<?php echo $filas ['KILOMETRAJE']; ?>">
  </div>


  <div class="form-group">
    <label for="CANTIDAD">CANTIDAD:</label>
    <input type="number" class="form-control" id="CANTIDAD" name="CANTIDAD" step="any" value="<?php echo $filas ['CANTIDAD']; ?>">
  </div>

  <div class="form-row">
        <label for="MEDIDA">MEDIDA</label>
    <input class="form-control" list="MEDIDAS" type="text" id="MEDIDA" name="MEDIDA" value="<?php echo $filas ['MEDIDA']; ?>" required>
    <datalist id="MEDIDAS" >
    <option selected></option>
    <option value=" Galones" ></option>
    <option value=" Kilos" ></option>
    <option value=" Cajas" > </option>
    <option value=" Litros" ></option>
    <option value=" Unidad" ></option>
    </datalist>

    </div>

  <div class="form-row">
        <label for="TIPO_DOC">TIPO COMPROBANTE</label>
    <input class="form-control" list="TIPOD" type="text" id="TIPO_DOC" name="TIPO_DOC" value="<?php echo $filas ['TIPO_DOC']; ?>" required>
    <datalist id="TIPOD" >
    <option selected></option>
    <option value=" Factura" ></option>
    <option value=" Boleta" ></option>
    <option value=" Tiket" > </option>
    <option value=" Vale" ></option>
    <option value=" Otros" ></option>
    </datalist>

    </div>


  <div class="form-group">
    <label for="NRO_DOC">Nro COMPROBANTE </label>
    <input type="text" class="form-control" id="NRO_DOC" name="NRO_DOC" placeholder="E001-0000" value="<?php echo $filas ['NRO_DOC']; ?>" >
  </div>

  <div class="form-group">
    <label for="FECHA_DOC">FECHA COMPROBANTE</label>
    <input type="date" class="form-control" id="FECHA_DOC" name="FECHA_DOC" value="<?php echo $filas ['FECHA_DOC']; ?>" required >
  </div>


  <div class="form-group">
    <label for="GLOSA">OBSERVACION</label>
    <input type="text" class="form-control" id="GLOSA" name="GLOSA" value="<?php echo $filas ['GLOSA']; ?>" >
  </div>

  
<button id="guardar" name="guardar"  type="submit" class="btn btn-primary">ACTUALIZAR</button>
</form>



    </div>
  </div>
</div>
<?php


} else {
  $RD = $_GET['rd'];
  $OP= $_GET['op'];
?>
<div class="container">
  <div class="row">
    <div class="col-sm ">

<form action="crud_diario/create_gasto.php" method="POST">
    <input type="hidden"  class="form-control" id="ID_OPERA" name="ID_OPERA" value="<?php echo $OP ?>" >
    <input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="<?php echo $RD ?>" >

<div class="form-group">
  <label for="CTA_CONT">TIPO </label>
  <select class="custom-select" id="CTA_CONT" name="CTA_CONT" value="<?php echo $filas ['CTA_CONT']; ?>" required >
<option >  </option>
    <?php 
      $queryT="SELECT pcge.ID_CTA, pcge.CTA_NOMBRE, pcge.TRESDIGITOS, pcge.NIVEL
      FROM pcge
      WHERE (((pcge.TRESDIGITOS)=921) AND ((pcge.NIVEL)=4));
      ";
      $resultT=mysqli_query($conexion, $queryT);
    ?>
    <?php while($filasT=mysqli_fetch_assoc($resultT)) { ?>
      
    <option value="<?php echo $filasT ['ID_CTA']?>" >
      <?php echo $filasT ['CTA_NOMBRE']  ?>
    </option>
    <?php } ?>

  </select>
</div>

<div class="form-group">
<label for="importe">IMPORTE</label>
  <input type="number" step="any" class="form-control" id="importe"  name="importe" placeholder="S/. 0.00" required>
</div>

 <div class="form-group">
  <label for="ANEXO">PROVEEDOR </label>
  <input class="form-control" list="ANEXOS" type="text" id="ANEXO" name="ANEXO" required>
    <datalist id="ANEXOS" >  
    <option selected ></option>
    <?php 
      $queryp="SELECT proveedores.id_proveedor, proveedores.cte_nombrecomercial
FROM proveedores
ORDER BY proveedores.cte_nombrecomercial;
";
      $resultp=mysqli_query($conexion, $queryp);
    ?>
    <?php while($filasp=mysqli_fetch_assoc($resultp)) { ?>
      
    <option value="<?php echo $filasp ['cte_nombrecomercial']?>" >
      <?php echo $filasp ['cte_nombrecomercial']  ?>
    </option>
    <?php } ?>
  </datalist>
</div>
  
  <div class="form-group">
    <label for="KILOMETRAJE">KILOMETRAJE</label>
    <input type="number" class="form-control" id="KILOMETRAJE" name="KILOMETRAJE" step="any" >
  </div>


  <div class="form-group">
    <label for="CANTIDAD">CANTIDAD:</label>
    <input type="number" class="form-control" id="CANTIDAD" name="CANTIDAD" step="any" >
  </div>

  <div class="form-row">
        <label for="MEDIDA">MEDIDA</label>
    <input class="form-control" list="MEDIDAS" type="text" id="MEDIDA" name="MEDIDA" required>
    <datalist id="MEDIDAS" >
    <option selected></option>
    <option value=" Galones" ></option>
    <option value=" Kilos" ></option>
    <option value=" Cajas" > </option>
    <option value=" Litros" ></option>
    <option value=" Unidad" ></option>
    </datalist>

    </div>

  <div class="form-row">
        <label for="TIPO_DOC">TIPO COMPROBANTE</label>
    <input class="form-control" list="TIPOD" type="text" id="TIPO_DOC" name="TIPO_DOC" required>
    <datalist id="TIPOD" >
    <option selected></option>
    <option value=" Factura" ></option>
    <option value=" Boleta" ></option>
    <option value=" Tiket" > </option>
    <option value=" Vale" ></option>
    <option value=" Otros" ></option>
    </datalist>

    </div>


  <div class="form-group">
    <label for="NRO_DOC">Nro COMPROBANTE </label>
    <input type="text" class="form-control" id="NRO_DOC" name="NRO_DOC" placeholder="E001-0000" >
  </div>

  <div class="form-group">
    <label for="FECHA_DOC">FECHA COMPROBANTE</label>
    <input type="date" class="form-control" id="FECHA_DOC" name="FECHA_DOC" >
  </div>


  <div class="form-group">
    <label for="GLOSA">OBSERVACION</label>
    <input type="text" class="form-control" id="GLOSA" name="GLOSA" >
  </div>



  <button id="guardar" name="guardar"  type="submit" class="btn btn-primary">REGISTRAR</button>
</form>



    </div>
  </div>
</div>
<?php

}





?>







<?php include('includes/footer.php'); ?>