<?php
$idp=$_GET['idp'];

     $query2="
SELECT *
FROM rd_inicio_fin
 /* WHERE id_prog=$idp */
WHERE Id_SERG=$idp
                ";
     $result2=mysqli_query($conexion, $query2);
     $filas2=mysqli_fetch_assoc($result2);


?>

<table class="table table-sm " style="background-color:white;">

  <tbody>
<br>
<tr> &nbsp<span class="icon-truck"></span> &nbsp SALIDA DE BASE (Inicio)</tr>
    <tr>

      <td>

<div class=" text-center ">        
<?php

     if ($filas2 ['HORA_SALIDA_BASE'] === null ) {
          ?> 
          <a href="./crud_inicio_fin/updateIF.php?idp=<?php echo $idp?>&i=200" class="btn btn-light"> 
            <span class="icon-clock2"></span>
          </a> 
          <?php
     } else {
          ?> 
            <a href="#HORA_SALIDA_BASE" class="btn btn-primary" data-toggle="modal">
          <span class="icon-clock2"></span> <br>
          <small><?php echo date("H:i", strtotime($filas2['HORA_SALIDA_BASE']))?></small> 
          </a> 
          <?php

     }


     if ($filas2 ['TEMP_SALIDA_BASE'] === null ) {
          ?> 
          <a href="./crud_inicio_fin/updateIF.php?idp=<?php echo $idp?>&i=2200" class="btn btn-light"> 
           <span class="icon-text-height"></span>
           </a>
          <?php
     } else {
          ?> 
          <a href="#TEMP_SALIDA_BASE" class="btn btn-danger" data-toggle="modal"> 
           <span class="icon-text-height"></span><br>
           <small><?php echo $filas2['TEMP_SALIDA_BASE']?></small>
           </a>
          <?php

     }

     if ($filas2 ['KM_SALIDA_BASE'] === null ) {
          ?> 
          <a href="./crud_inicio_fin/updateIF.php?idp=<?php echo $idp?>&i=2000" class="btn btn-light"> 
           <span class="icon-road"></span>
           </a>
          <?php
     } else {
          ?> 
          <a href="#KM_SALIDA_BASE" class="btn btn-warning" data-toggle="modal"> 
           <span class="icon-road"></span><br>
           <small><?php echo $filas2['KM_SALIDA_BASE']?></small>
           </a>
          <?php

     }


     if ($filas2 ['FOTOS'] === "NO" ) {
          ?> 
          <a href="#FOTOS" class="btn btn-light" data-toggle="modal"> 
            <span class="icon-image"></span>
            
          </a> 
          <?php
     } else {
          ?> 
            <a href="#FOTOS" class="btn btn-primary" data-toggle="modal">
          <span class="icon-image"></span> <br>
          <small><?php echo $filas2['FOTOS']?></small> 
          </a> 
          <?php

     }



 
          ?> 
               <?php


// Consulta para calcular el saldo actual
$query_saldo = "SELECT IFNULL(SUM(saldo), 0) AS saldo_actual 
                FROM rd_control_cuentas 
                WHERE id_user = $id_userup AND estado = 0";

$result_saldo = mysqli_query($conexion, $query_saldo);
$row_saldo = mysqli_fetch_assoc($result_saldo);
$saldo_actual = number_format($row_saldo['saldo_actual'], 2);
?>
          <a href="#nCAJA" class="btn btn-dark" data-toggle="modal"> 
            <span class="icon-coin-dollar"></span> <br>
            <small><?php echo $saldo_actual?></small>
          </a> 
          <?php




     if ($filas2 ['wt_inicio'] === null ) {
          ?> 
          <a href="./crud_inicio_fin/updateIF.php?idp=<?php echo $idp?>&i=1" class="btn btn-light" target="_blank"> 
           <span class="icon-whatsapp"></span>
           </a>
          <?php
     } else {
          ?> 
          <a  href="./crud_mensajes/msj_inicio.php?idp=<?php echo $idp?> " target="_blank"  class="btn btn-success" data-toggle="modal"> 
           <span class="icon-whatsapp"></span><br>
           <small style="font-size: 10px;" >ok</small>
           </a>
          <?php

     }
 ?>

          </div>
      </td>
    </tr>


    
  </tbody>
</table>



<?php

     $query7="
SELECT *
FROM update2
WHERE tipo='h'
                ";
     $result7=mysqli_query($conexion, $query7);



?>

  <?php while($filas7=mysqli_fetch_assoc($result7)) { ?>

<div class="modal" tabindex="-1" role="dialog" id="<?php echo $filas7 ['campo']?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo $filas7 ['titulo']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_inicio_fin/update2.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>

<input class="form-control"  type="hidden" id="i" name="i" value="<?php echo $filas7 ['indicador']?>" readonly>

  <div class="form-group" >
    <label for="head_fecha">Ingrese: </label>
    <input class="form-control" type="time"  id="txt" name="txt" required>
  </div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">REGISTRAR</button>
</form>
        
      </div>
    </div>
  </div>
</div>

   <?php } ?>



<?php

     $query7="
SELECT *
FROM update2
WHERE tipo='t'
                ";
     $result7=mysqli_query($conexion, $query7);



?>

  <?php while($filas7=mysqli_fetch_assoc($result7)) { ?>

<div class="modal" tabindex="-1" role="dialog" id="<?php echo $filas7 ['campo']?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo $filas7 ['titulo']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_inicio_fin/update2.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>

<input class="form-control"  type="hidden" id="i" name="i" value="<?php echo $filas7 ['indicador']?>" readonly>

  <div class="form-group" >
    <label for="head_fecha">Ingrese: </label>
    <input class="form-control" type="text"  id="txt" name="txt" required>
  </div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">REGISTRAR</button>
</form>
        
      </div>
    </div>
  </div>
</div>

   <?php } ?>

<!-- Modal de Gastos -->
<div class="modal fade" id="nCAJA" tabindex="-1" aria-labelledby="modalGastosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content modal-gastos">
            <div class="modal-header">
                <h5 class="modal-title" id="modalGastosLabel">💰 CAJA A RENDIR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <!-- Pestañas -->
                <ul class="nav nav-tabs" id="operacionTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="ingreso-tab" data-bs-toggle="tab" data-bs-target="#ingreso" type="button" role="tab">
                            ✅ Ingreso
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="egreso-tab" data-bs-toggle="tab" data-bs-target="#egreso" type="button" role="tab">
                            ❌ Egreso
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="saldo-tab" data-bs-toggle="tab" data-bs-target="#saldo" type="button" role="tab">
                            💵 Saldo
                        </button>
                    </li>
                </ul>

                <div class="tab-content mt-4" id="operacionTabsContent">

                    <!-- Formulario Ingreso -->
                    <div class="tab-pane fade show active" id="ingreso" role="tabpanel">
                        <div class="card shadow-sm">
                            <div class="form-header form-ingreso">
                                <i class="bi bi-arrow-down-circle"></i>
                                <h5 class="mb-0">Registro de Ingreso</h5>
                            </div>
                            <div class="card-body">
                                <form action="crud_gastos/guardar_operacion.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="tipo_dh" value="D">
                                    <input type="hidden" name="id_user" value="<?php echo $id_userup; ?>">
                                    <input type="hidden" name="id_programacion" value="<?php echo $idp; ?>">

                                    <div class="mb-3">
                                        <label for="id_concepto_ing" class="form-label">Concepto</label>
                                        <select class="form-select" id="id_concepto_ing" name="id_concepto" required>
                                            <option value="">Seleccione un concepto</option>
                                            <?php
                                            $query_conceptos = "SELECT id_concepto, concepto FROM rend_conceptos WHERE TIPO='I' ORDER BY concepto";
                                            $result_conceptos = mysqli_query($conexion, $query_conceptos);
                                            while ($row_concepto = mysqli_fetch_assoc($result_conceptos)) {
                                                echo '<option value="' . $row_concepto['id_concepto'] . '">' . htmlspecialchars($row_concepto['concepto']) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="importe_ing" class="form-label">Importe</label>
                                        <input type="number" step="0.01" class="form-control" id="importe_ing" name="importe" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="observacion_ing" class="form-label">Observación</label>
                                        <textarea class="form-control" id="observacion_ing" name="observacion" rows="2"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nro_comprobante_ing" class="form-label">Número de Comprobante</label>
                                        <input type="text" class="form-control" id="nro_comprobante_ing" name="nro_comprobante">
                                    </div>

                                    <div class="mb-3">
                                        <label for="doc_imagen_ing" class="form-label">Subir Comprobante (Imagen)</label>
                                        <input type="file" class="form-control" id="doc_imagen_ing" name="doc_imagen" accept="image/*">
                                    </div>

                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="bi bi-check-circle"></i> Registrar Ingreso
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario Egreso -->
                    <div class="tab-pane fade" id="egreso" role="tabpanel">
                        <div class="card shadow-sm">
                            <div class="form-header form-egreso">
                                <i class="bi bi-arrow-up-circle"></i>
                                <h5 class="mb-0">Registro de Egreso</h5>
                            </div>
                            <div class="card-body">
                                <form action="crud_gastos/guardar_operacion.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="tipo_dh" value="H">
                                    <input type="hidden" name="id_user" value="<?php echo $id_userup; ?>">
                                    <input type="hidden" name="id_programacion" value="<?php echo $idp; ?>">

                                    <div class="mb-3">
                                        <label for="id_concepto_egr" class="form-label">Concepto</label>
                                        <select class="form-select" id="id_concepto_egr" name="id_concepto" required>
                                            <option value="">Seleccione un concepto</option>
                                            <?php
                                            $query_conceptos = "SELECT id_concepto, concepto FROM rend_conceptos WHERE TIPO='E' ORDER BY concepto";
                                            $result_conceptos = mysqli_query($conexion, $query_conceptos);
                                            while ($row_concepto = mysqli_fetch_assoc($result_conceptos)) {
                                                echo '<option value="' . $row_concepto['id_concepto'] . '">' . htmlspecialchars($row_concepto['concepto']) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="importe_egr" class="form-label">Importe</label>
                                        <input type="number" step="0.01" class="form-control" id="importe_egr" name="importe" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="observacion_egr" class="form-label">Observación</label>
                                        <textarea class="form-control" id="observacion_egr" name="observacion" rows="2"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nro_comprobante_egr" class="form-label">Número de Comprobante</label>
                                        <input type="text" class="form-control" id="nro_comprobante_egr" name="nro_comprobante">
                                    </div>

                                    <div class="mb-3">
                                        <label for="doc_imagen_egr" class="form-label">Subir Comprobante (Imagen)</label>
                                        <input type="file" class="form-control" id="doc_imagen_egr" name="doc_imagen" accept="image/*">
                                    </div>

                                    <button type="submit" class="btn btn-danger w-100">
                                        <i class="bi bi-x-circle"></i> Registrar Egreso
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Saldo -->
                    <div class="tab-pane fade" id="saldo" role="tabpanel">
                        <div class="tabla-saldo-container">
                            <?php
                            // Consulta para calcular el saldo actual
                            $query_saldo = "SELECT IFNULL(SUM(saldo), 0) AS saldo_actual 
                                            FROM rd_control_cuentas 
                                            WHERE id_user = $id_userup AND estado = 0";
                            $result_saldo = mysqli_query($conexion, $query_saldo);
                            $row_saldo = mysqli_fetch_assoc($result_saldo);
                            $saldo_actual = number_format($row_saldo['saldo_actual'], 2);
                            ?>
                            
                            <!-- Mostrar saldo -->
                            <div class="saldo-actual-display text-center">
                                <h5>💰 Saldo Actual: S/. <span id="saldo-actual"><?php echo $saldo_actual; ?></span></h5>
                            </div>

                            <?php
                            // Consulta de registros
                            $query = "SELECT r.id_operacion, r.fecha_creacion, c.concepto, r.importe, r.saldo, r.tipo_dh, r.doc_imagen, r.observacion
                                      FROM rd_control_cuentas r
                                      INNER JOIN rend_conceptos c ON r.id_concepto = c.id_concepto
                                      WHERE r.id_user = $id_userup AND estado = 0
                                      ORDER BY r.fecha_creacion DESC";
                            $result = mysqli_query($conexion, $query);
                            ?>

                            <table class="table table-striped table-bordered table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Descripción</th>
                                        <th>Importe</th>
                                        <th class="text-center">Ver</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td><?php echo date('d/m H:i', strtotime($row['fecha_creacion'])); ?></td>
                                            <td><?php echo htmlspecialchars($row['concepto']); ?></td>
                                            <td class="fw-bold"><?php echo number_format($row['saldo'], 2); ?></td>
                                            <td class="text-center">
                                                <a href="#" data-bs-toggle="offcanvas" data-bs-target="#detalleOffcanvas<?php echo $row['id_operacion']; ?>">
                                                    <i class="bi bi-eye text-primary" style="font-size: 1.3rem;"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Offcanvas para cada operación -->
                                        <div class="offcanvas offcanvas-end offcanvas-gastos" tabindex="-1" id="detalleOffcanvas<?php echo $row['id_operacion']; ?>">
                                            <div class="offcanvas-header">
                                                <h5>📄 Detalle de la Operación</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                                            </div>
                                            <div class="offcanvas-body">
                                                <!-- Imagen -->
                                                <div class="mb-3 text-center">
                                                    <img src="<?php echo $row['doc_imagen']; ?>" alt="Comprobante" class="img-fluid rounded zoomable" style="max-height: 400px;">
                                                </div>
                                                
                                                <!-- Detalles -->
                                                <div class="mb-3">
                                                    <p><strong>📅 Fecha:</strong> <?php echo date('d/m/Y H:i:s', strtotime($row['fecha_creacion'])); ?></p>
                                                    <p><strong>📝 Concepto:</strong> <?php echo htmlspecialchars($row['concepto']); ?></p>
                                                    <p><strong>📊 Tipo:</strong> 
                                                        <span class="badge <?php echo ($row['tipo_dh'] == 'H') ? 'bg-success' : 'bg-danger'; ?>">
                                                            <?php echo ($row['tipo_dh'] == 'H') ? 'Ingreso' : 'Egreso'; ?>
                                                        </span>
                                                    </p>
                                                    <p><strong>💵 Importe:</strong> S/. <?php echo number_format($row['importe'], 2); ?></p>
                                                    <p><strong>💬 Observación:</strong> <?php echo isset($row['observacion']) ? htmlspecialchars($row['observacion']) : 'Sin observación'; ?></p>
                                                </div>
                                                
                                                <!-- Botones -->
                                                <div class="d-flex justify-content-between align-items-center mt-4 gap-2">
                                                    <a href="crud_gastos/masimg_doc.php?id_operacion=<?php echo $row['id_operacion']; ?>&idp=<?php echo $idp; ?>" 
                                                       class="btn btn-primary">
                                                        <i class="bi bi-plus-circle"></i> Imágenes
                                                    </a>
                                                    <a href="crud_gastos/eliminar_operacion.php?id=<?php echo $row['id_operacion']; ?>&idp=<?php echo $idp; ?>" 
                                                       onclick="return confirm('¿Estás seguro de eliminar este registro?');" 
                                                       class="btn btn-danger">
                                                        <i class="bi bi-trash"></i> Eliminar
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal" tabindex="-1" role="dialog" id="">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">CAJA A RENDIR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-header {
            padding: 10px 20px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .form-ingreso { background-color: #28a745; } /* Verde Bootstrap */
        .form-egreso { background-color: #dc3545; } /* Rojo Bootstrap */
    </style>
</head>



<!-- Bootstrap y Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/medium-zoom@1.0.6/dist/medium-zoom.min.js"></script>
<script>
    mediumZoom('.zoomable', {
        margin: 24,
        background: '#000'
    });
</script>


        
      </div>
    </div>
  </div>
</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="aCAJA">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">CAJA A RENDIR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_caja/update.php" method="POST" enctype="multipart/form-data" class="colm">
<?php

     $queryle="
SELECT ledger.id_ledger, ledger.IDP, ledger.importe, ledger.observacion, ledger.id_concepto, ledger.id_user, ledger.tipo_dh
FROM ledger
WHERE (((ledger.id_user)=$id_userup) AND ((ledger.tipo_dh)='H') AND ((ledger.IDP)=$idp));

                ";
     $resultle=mysqli_query($conexion, $queryle);
$filasle=mysqli_fetch_assoc($resultle)
?>
<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>
<input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>
<input class="form-control"  type="hidden" id="id_responsable" name="id_responsable" value="<?php echo $userup ; ?> " readonly>

  <div class="form-group" >
    <label for="importe">IMPORTE: </label>
    <input class="form-control" type="number"  id="importe" name="importe" value="<?php echo $filasle['importe']?>" required>
  </div>


  <div class="form-group" >
    <label for="observacion">Observacion: </label>
    <input class="form-control" type="text"  id="observacion" name="observacion" value="<?php echo $filasle['observacion']?>" required>
  </div>


      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">ACTUALIZAR</button>
</form>





        
      </div>
    </div>
  </div>
</div>













<div class="modal" tabindex="-1" role="dialog" id="guiarem">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">GUIA REMISION REMITENTE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>



<div class="modal-body">
  
<form  action="crud_guiarem/create.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>

  <div class="form-group" >
    <label for="head_fecha">Ingrese: </label> <br>




    SERIE - NUMERO : <input class="form-control" type="text"  id="gr_serienum" name="gr_serienum" required> 
    ORIGEN : 
              <select class="custom-select" id="origen_distrito" name="origen_distrito" required>
                <option selected></option>
                <?php 
                  $cta = $filas4 ['id_cta'];
                  $query="SELECT * FROM distritos ";
                  $result=mysqli_query($conexion, $query);
                ?>
                <?php while($filas=mysqli_fetch_assoc($result)) { ?>
                  
                <option value="<?php echo $filas ['id_distrito']?>" >
                  <?php echo $filas ['distrito']  ?>
                </option>
                <?php } ?>
              </select>

   

    CLIENTE : 
              <select class="custom-select" id="emp_destino" name="emp_destino" required>
                <option selected></option>
                <?php 
                  $cta = $filas4 ['id_cta'];
                  $query="SELECT * FROM emp_destino ORDER BY emp_destino";
                  $result=mysqli_query($conexion, $query);
                ?>
                <?php while($filas=mysqli_fetch_assoc($result)) { ?>
                  
                <option value="<?php echo $filas ['id_emp']?>" >
                  <?php echo $filas ['emp_destino']  ?>
                </option>
                <?php } ?>
              </select>


    DESTINO  : 
              <select class="custom-select" id="destino_distrito" name="destino_distrito" required>
                <option selected></option>
                <?php 
                  $cta = $filas4 ['id_cta'];
                  $query="SELECT * FROM distritos ";
                  $result=mysqli_query($conexion, $query);
                ?>
                <?php while($filas=mysqli_fetch_assoc($result)) { ?>
                  
                <option value="<?php echo $filas ['id_distrito']?>" >
                  <?php echo $filas ['distrito']  ?>
                </option>
                <?php } ?>
              </select>


    FACTURA  : <input class="form-control" type="text"  id="fact_cliente" name="fact_cliente" required>
    BULTOS  : <input class="form-control" type="number"  id="gr_bultos" name="gr_bultos" required>   
    OBSERVACIONES  : <input class="form-control" type="text"  id="gr_obs" name="gr_obs" >   

  </div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">REGISTRAR</button>

   </form>     
      </div>
    </div>
  </div>
</div>



<div class="modal" tabindex="-1" role="dialog" id="FOTOS">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> IMAGENES DE PARTIDA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_fotos/createimg.php" method="POST" enctype="multipart/form-data" class="colm">
<input class="form-control"  type="hidden" id="tipo" name="tipo" value="PARTIDA" readonly>
<input class="form-control"  type="hidden" id="Redirigir" name="Redirigir" value="panel_user" readonly>
<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>
<input class="form-control"  type="hidden" id="idr" name="idr" value="" readonly>  
<input class="form-control"  type="hidden" id="idd" name="idd" value="" readonly>

    <div class="form-group">
        <label for="head_imagen">Imagen: </label>
        <input class="form-control" type="file" id="head_imagen" name="head_imagen" accept="image/*" required>
        <label for="head_imagen">Descripción : </label>
        <input class="form-control" type="txt" id="ALCANCE" name="ALCANCE" required>
    </div>

      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">GUARDAR</button>
</form>
        


      </div>
    </div>
  </div>
</div>


