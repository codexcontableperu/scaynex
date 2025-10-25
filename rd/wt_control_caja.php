<?php
session_start();

// Validar sesión
if (!isset($_SESSION['usuario'])) {
    echo "<script>alert('Sesión no iniciada o expirada.'); window.location.href='../index.php';</script>";
    exit;
}

$userup = $_SESSION['usuario'];
$id_userup = $_SESSION['id_usuario'];
$dni_user = $_SESSION['user_dni'];

// Inicializar variable idp si no existe
$idp = isset($_GET['idp']) ? $_GET['idp'] : 0;
?>
<?php include("../data/conexion.php"); ?>

<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="whatsaap/stilo_what.css">

<style>
.main-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px;
}

.titu {
    text-align: center;
    margin: 20px 0;
}

.titu h5 {
    font-weight: 600;
    color: #2c3e50;
}

.form-container {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin: 20px 0;
    padding: 0;
}

.form-header {
    padding: 15px 20px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    color: white;
}

.form-ingreso { 
    background: #28a745;
}

.form-egreso { 
    background: #dc3545;
}

.card-body {
    padding: 25px;
}

.nav-tabs {
    margin-bottom: 20px;
}

.nav-tabs .nav-link {
    border: none;
    padding: 12px 20px;
}

.nav-tabs .nav-link.active {
    border-bottom: 3px solid #007bff;
    background: transparent;
}

.tabla-saldo-container {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.saldo-actual-display {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    color: white;
    text-align: center;
}

.offcanvas-gastos {
    width: 400px;
}

.zoomable {
    cursor: zoom-in;
    transition: transform 0.3s ease;
}

.zoomable:hover {
    transform: scale(1.05);
}
</style>

<div id="header">
    <div id="whatsapp-text">
        <span class="icon-user"></span> <?php echo htmlspecialchars($userup); ?> 
    </div>
    <div id="header-icons">
        <img src="whatsaap/camera-icon.png" alt="Cámara" id="camera-icon">
        <img src="whatsaap/search-icon.png" alt="Buscar" id="search-icon">
        <img src="whatsaap/menu-icon.png" alt="Menú" id="menu-icon">
    </div>
</div>

<div id="second-header">
    <img src="whatsaap/user-icon.png" alt="Usuario" id="user-icon">
    <a class="boton bton selec" href="wt_prog_user.php?dni=<?php echo htmlspecialchars($dni_user); ?>">Ordenes</a>
</div>

<div class="main-container">
    <div class="titu">
        <h5>💰 CAJA A RENDIR</h5>
    </div>

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
                                if ($result_conceptos) {
                                    while ($row_concepto = mysqli_fetch_assoc($result_conceptos)) {
                                        echo '<option value="' . $row_concepto['id_concepto'] . '">' . htmlspecialchars($row_concepto['concepto']) . '</option>';
                                    }
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
                                if ($result_conceptos) {
                                    while ($row_concepto = mysqli_fetch_assoc($result_conceptos)) {
                                        echo '<option value="' . $row_concepto['id_concepto'] . '">' . htmlspecialchars($row_concepto['concepto']) . '</option>';
                                    }
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
                if ($result_saldo) {
                    $row_saldo = mysqli_fetch_assoc($result_saldo);
                    $saldo_actual = number_format($row_saldo['saldo_actual'], 2);
                } else {
                    $saldo_actual = "0.00";
                }
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
                
                if ($result && mysqli_num_rows($result) > 0) {
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
                                    <td class="fw-bold">S/. <?php echo number_format($row['saldo'], 2); ?></td>
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
                                        <?php if (!empty($row['doc_imagen'])) { ?>
                                        <div class="mb-3 text-center">
                                            <img src="<?php echo htmlspecialchars($row['doc_imagen']); ?>" alt="Comprobante" class="img-fluid rounded zoomable" style="max-height: 400px;">
                                        </div>
                                        <?php } ?>
                                        
                                        <!-- Detalles -->
                                        <div class="mb-3">
                                            <p><strong>📅 Fecha:</strong> <?php echo date('d/m/Y H:i:s', strtotime($row['fecha_creacion'])); ?></p>
                                            <p><strong>📝 Concepto:</strong> <?php echo htmlspecialchars($row['concepto']); ?></p>
                                            <p><strong>📊 Tipo:</strong> 
                                                <span class="badge <?php echo ($row['tipo_dh'] == 'D') ? 'bg-success' : 'bg-danger'; ?>">
                                                    <?php echo ($row['tipo_dh'] == 'D') ? 'Ingreso' : 'Egreso'; ?>
                                                </span>
                                            </p>
                                            <p><strong>💵 Importe:</strong> S/. <?php echo number_format($row['importe'], 2); ?></p>
                                            <p><strong>💰 Saldo:</strong> S/. <?php echo number_format($row['saldo'], 2); ?></p>
                                            <p><strong>💬 Observación:</strong> <?php echo !empty($row['observacion']) ? htmlspecialchars($row['observacion']) : 'Sin observación'; ?></p>
                                        </div>
                                        
                                        <!-- Botones -->
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
                <?php } else { ?>
                    <div class="alert alert-info text-center">
                        No hay registros para mostrar.
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap y Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/medium-zoom@1.0.6/dist/medium-zoom.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        mediumZoom('.zoomable', {
            margin: 24,
            background: '#000'
        });
    });
</script>

<?php include('includes/footer.php'); ?>