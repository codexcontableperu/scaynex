    <link rel="stylesheet" href="stilo_pag.css">

    <div class="pagina-centrada">
        <!-- Contenido de la página aquí -->




<div class="container">
  <div class="row">
    <div class="col-sm ">


<form action="crud_tablas/create.php" method="POST">


  <div class="form-group">
    <label for="COM_SOLES">IMPORTE:</label>
    <input type="number" class="form-control" id="COM_SOLES" name="COM_SOLES" step="any" placeholder="0.00" >
  </div>

  <div class="form-group">
    <label for="COM_GALONES">GALONES:</label>
    <input type="number" class="form-control" id="COM_GALONES" name="COM_GALONES" step="any" >
  </div>

  <div class="form-group">
    <label for="KILOMETRAJE">KILOMETRAJE:</label>
    <input type="number" class="form-control" id="KILOMETRAJE" name="KILOMETRAJE" step="any" >
  </div>

  <div class="form-group">
    <label for="NFACTURA">NUMERO DE FACTURA:</label>
    <input type="text" class="form-control" id="NFACTURA" name="NFACTURA" placeholder="E001-0000" >
  </div>

  <div class="form-group">
    <label for="GASOLINERA">GASOLINERA:</label>
    <input type="text" class="form-control" id="GASOLINERA" name="GASOLINERA" placeholder="Razon Social" >
  </div>

  <div class="form-group">
    <label for="COM_FECHA">FECHA:</label>
    <input type="date" class="form-control" id="COM_FECHA" name="COM_FECHA" >
  </div>

  <div class="form-group">
    <label for="COM_HORA">HORA:</label>
    <input type="time" class="form-control" id="COM_HORA" name="COM_HORA" >
  </div>

  <button  id="guardar" name="guardar"  type="submit" class="btn btn-primary">REGISTRAR</button>
</form>


    </div>
  </div>
</div>




    </div>

