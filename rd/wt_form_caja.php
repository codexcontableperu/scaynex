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

.modal-gastos .modal-dialog {
    max-width: 400px;
    margin: 0 0 0 auto;
    height: 100%;
}

.modal-gastos .modal-content {
    height: 100%;
    border-radius: 0;
}

.zoomable {
    cursor: zoom-in;
    transition: transform 0.3s ease;
}

.zoomable:hover {
    transform: scale(1.05);
}

/* Estilos para la barra de progreso */
.progress-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    z-index: 9999;
    justify-content: center;
    align-items: center;
}

.progress-container {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    width: 90%;
    max-width: 500px;
}

.progress-title {
    text-align: center;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: #333;
}

.progress-bar-container {
    width: 100%;
    height: 30px;
    background: #e9ecef;
    border-radius: 15px;
    overflow: hidden;
    margin-bottom: 15px;
    position: relative;
}

.progress-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, #28a745 0%, #20c997 100%);
    width: 0%;
    transition: width 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 0.9rem;
}

.progress-percentage {
    text-align: center;
    font-size: 2rem;
    font-weight: bold;
    color: #28a745;
    margin-bottom: 10px;
}

.progress-message {
    text-align: center;
    color: #6c757d;
    font-size: 0.95rem;
}

.spinner {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 3px solid rgba(40, 167, 69, 0.3);
    border-radius: 50%;
    border-top-color: #28a745;
    animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Utilidades que no existen en BS4 */
.gap-2 > * {
    margin-right: 0.5rem;
}
.gap-2 > *:last-child {
    margin-right: 0;
}
</style>

<!-- Bootstrap 4 CSS y Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Overlay de progreso -->
<div class="progress-overlay" id="progressOverlay">
    <div class="progress-container">
        <div class="progress-title">
            <span class="spinner"></span>
            <span id="progressTitle">Guardando registro...</span>
        </div>
        <div class="progress-percentage" id="progressPercentage">0%</div>
        <div class="progress-bar-container">
            <div class="progress-bar-fill" id="progressBarFill"></div>
        </div>
        <div class="progress-message" id="progressMessage">Subiendo archivo...</div>
    </div>
</div>

<div class="main-container">
    <div class="titu">
        <h5>💰 CAJA A RENDIR</h5>
    </div>

    <!-- Pestañas (Bootstrap 4) -->
    <ul class="nav nav-tabs" id="operacionTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="ingreso-tab" data-toggle="tab" href="#ingreso" role="tab">
                ✅ Ingreso
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="egreso-tab" data-toggle="tab" href="#egreso" role="tab">
                ❌ Egreso
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="saldo-tab" data-toggle="tab" href="#saldo" role="tab">
                💵 Saldo
            </a>
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
                    <form id="formIngreso" action="crud_gastos/guardar_operacion.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="tipo_dh" value="D">
                        <input type="hidden" name="id_user" value="<?php echo $id_userup; ?>">
                        <input type="hidden" name="id_programacion" value="<?php echo $idp; ?>">
                        <input type="hidden" name="dni_user" value="<?php echo $dni_user; ?>">
                        <div class="form-group">
                            <label for="id_concepto_ing">Concepto</label>
                            <select class="form-control" id="id_concepto_ing" name="id_concepto" required>
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

                        <div class="form-group">
                            <label for="importe_ing">Importe</label>
                            <input type="number" step="0.01" class="form-control" id="importe_ing" name="importe" required>
                        </div>

                        <div class="form-group">
                            <label for="observacion_ing">Observación</label>
                            <textarea class="form-control" id="observacion_ing" name="observacion" rows="2"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="nro_comprobante_ing">Número de Comprobante</label>
                            <input type="text" class="form-control" id="nro_comprobante_ing" name="nro_comprobante">
                        </div>

                        <div class="form-group">
                            <label for="doc_imagen_ing">Subir Comprobante (Imagen)</label>
                            <input type="file" class="form-control d-none" id="doc_imagen_ing" name="doc_imagen" accept="image/*">
                            <div class="d-flex gap-2 border rounded p-3">
                                <button type="button" class="btn btn-dark" onclick="openCamera()">
                                    <i class="bi bi-camera-fill"></i> Cámara
                                </button>
                                <button type="button" class="btn btn-outline-dark" onclick="openGallery()">
                                    <i class="bi bi-folder2-open"></i> Galería
                                </button>
                            </div>
                            <small id="file-name" class="text-muted mt-2 d-block"></small>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">
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
                    <form id="formEgreso" action="crud_gastos/guardar_operacion.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="tipo_dh" value="H">
                        <input type="hidden" name="id_user" value="<?php echo $id_userup; ?>">
                        <input type="hidden" name="id_programacion" value="<?php echo $idp; ?>">

                        <div class="form-group">
                            <label for="id_concepto_egr">Concepto</label>
                            <select class="form-control" id="id_concepto_egr" name="id_concepto" required>
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

                        <div class="form-group">
                            <label for="importe_egr">Importe</label>
                            <input type="number" step="0.01" class="form-control" id="importe_egr" name="importe" required>
                        </div>

                        <div class="form-group">
                            <label for="observacion_egr">Observación</label>
                            <textarea class="form-control" id="observacion_egr" name="observacion" rows="2"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="nro_comprobante_egr">Número de Comprobante</label>
                            <input type="text" class="form-control" id="nro_comprobante_egr" name="nro_comprobante">
                        </div>

                        <div class="form-group">
                            <label for="doc_imagen_egr">Subir Comprobante (Imagen)</label>
                            <input type="file" class="form-control d-none" id="doc_imagen_egr" name="doc_imagen" accept="image/*">
                            <div class="d-flex gap-2 border rounded p-3">
                                <button type="button" class="btn btn-dark" onclick="openCameraEgr()">
                                    <i class="bi bi-camera-fill"></i> Cámara
                                </button>
                                <button type="button" class="btn btn-outline-dark" onclick="openGalleryEgr()">
                                    <i class="bi bi-folder2-open"></i> Galería
                                </button>
                            </div>
                            <small id="file-name-egr" class="text-muted mt-2 d-block"></small>
                        </div>

                        <button type="submit" class="btn btn-danger btn-block">
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
                                    <td class="font-weight-bold">S/. <?php echo number_format($row['saldo'], 2); ?></td>
                                    <td class="text-center">
                                        <a href="#" data-toggle="modal" data-target="#detalleModal<?php echo $row['id_operacion']; ?>">
                                            <i class="bi bi-eye text-primary" style="font-size: 1.3rem;"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal para cada operación (reemplaza offcanvas de BS5) -->
                                <div class="modal fade modal-gastos" id="detalleModal<?php echo $row['id_operacion']; ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">📄 Detalle de la Operación</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Imagen -->
                                                <?php if (!empty($row['doc_imagen'])) { ?>
                                                <div class="mb-3 text-center">
                                                    <img src="../img/<?php echo htmlspecialchars($row['doc_imagen']); ?>" alt="Comprobante" class="img-fluid rounded zoomable" style="max-height: 400px;">
                                                </div>
                                                <?php } ?>
                                                
                                                <!-- Detalles -->
                                                <div class="mb-3">
                                                    <p><strong>📅 Fecha:</strong> <?php echo date('d/m/Y H:i:s', strtotime($row['fecha_creacion'])); ?></p>
                                                    <p><strong>📝 Concepto:</strong> <?php echo htmlspecialchars($row['concepto']); ?></p>
                                                    <p><strong>📊 Tipo:</strong> 
                                                        <span class="badge <?php echo ($row['tipo_dh'] == 'D') ? 'badge-success' : 'badge-danger'; ?>">
                                                            <?php echo ($row['tipo_dh'] == 'D') ? 'Ingreso' : 'Egreso'; ?>
                                                        </span>
                                                    </p>
                                                    <p><strong>💵 Importe:</strong> S/. <?php echo number_format($row['importe'], 2); ?></p>
                                                    <p><strong>💰 Saldo:</strong> S/. <?php echo number_format($row['saldo'], 2); ?></p>
                                                    <p><strong>💬 Observación:</strong> <?php echo !empty($row['observacion']) ? htmlspecialchars($row['observacion']) : 'Sin observación'; ?></p>
                                                </div>
                                                
                                                <!-- Botones -->
                                                <div class="d-flex justify-content-between align-items-center mt-4">
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

<!-- jQuery, Popper.js y Bootstrap 4 JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/medium-zoom@1.0.6/dist/medium-zoom.min.js"></script>

<script>
// Funciones para cámara y galería - Ingreso
const fileInput = document.getElementById('doc_imagen_ing');
const fileName = document.getElementById('file-name');

function openCamera() {
    fileInput.setAttribute('capture', 'environment');
    fileInput.click();
}

function openGallery() {
    fileInput.removeAttribute('capture');
    fileInput.click();
}

fileInput.addEventListener('change', function() {
    if (this.files && this.files[0]) {
        fileName.textContent = '📎 ' + this.files[0].name;
    }
});

// Funciones para cámara y galería - Egreso
const fileInputEgr = document.getElementById('doc_imagen_egr');
const fileNameEgr = document.getElementById('file-name-egr');

function openCameraEgr() {
    fileInputEgr.setAttribute('capture', 'environment');
    fileInputEgr.click();
}

function openGalleryEgr() {
    fileInputEgr.removeAttribute('capture');
    fileInputEgr.click();
}

fileInputEgr.addEventListener('change', function() {
    if (this.files && this.files[0]) {
        fileNameEgr.textContent = '📎 ' + this.files[0].name;
    }
});

// Función para manejar el envío con barra de progreso
function handleFormSubmit(formId) {
    const form = document.getElementById(formId);
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Obtener elementos de la barra de progreso
        const overlay = document.getElementById('progressOverlay');
        const progressBar = document.getElementById('progressBarFill');
        const progressPercentage = document.getElementById('progressPercentage');
        const progressMessage = document.getElementById('progressMessage');
        const progressTitle = document.getElementById('progressTitle');
        
        // Mostrar overlay
        overlay.style.display = 'flex';
        
        // Crear FormData con los datos del formulario
        const formData = new FormData(form);
        
        // Crear XMLHttpRequest
        const xhr = new XMLHttpRequest();
        
        // Evento de progreso de subida
        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const percentComplete = Math.round((e.loaded / e.total) * 100);
                
                // Actualizar barra de progreso
                progressBar.style.width = percentComplete + '%';
                progressPercentage.textContent = percentComplete + '%';
                
                // Mensajes según el progreso
                if (percentComplete < 30) {
                    progressMessage.textContent = 'Preparando archivo...';
                } else if (percentComplete < 70) {
                    progressMessage.textContent = 'Subiendo archivo al servidor...';
                } else if (percentComplete < 100) {
                    progressMessage.textContent = 'Procesando datos...';
                } else {
                    progressMessage.textContent = 'Finalizando...';
                }
            }
        });
        
        // Cuando se complete la carga
        xhr.addEventListener('load', function() {
            if (xhr.status === 200) {
                progressBar.style.width = '100%';
                progressPercentage.textContent = '100%';
                progressMessage.textContent = '¡Registro guardado exitosamente!';
                progressTitle.innerHTML = '<i class="bi bi-check-circle-fill text-success"></i> Completado';
                
                // Redirigir después de 1 segundo
                setTimeout(function() {
                    window.location.href = 'wt_control_caja.php?idp=<?php echo $idp; ?>';
                }, 1000);
            } else {
                progressMessage.textContent = 'Error al guardar el registro';
                progressTitle.innerHTML = '<i class="bi bi-x-circle-fill text-danger"></i> Error';
                
                setTimeout(function() {
                    overlay.style.display = 'none';
                    alert('Ocurrió un error al guardar el registro. Por favor, intente nuevamente.');
                }, 2000);
            }
        });
        
        // Error de conexión
        xhr.addEventListener('error', function() {
            progressMessage.textContent = 'Error de conexión';
            progressTitle.innerHTML = '<i class="bi bi-x-circle-fill text-danger"></i> Error';
            
            setTimeout(function() {
                overlay.style.display = 'none';
                alert('Error de conexión. Por favor, verifique su internet e intente nuevamente.');
            }, 2000);
        });
        
        // Abrir conexión y enviar
        xhr.open('POST', form.action, true);
        xhr.send(formData);
    });
}

// Inicializar ambos formularios
$(document).ready(function() {
    handleFormSubmit('formIngreso');
    handleFormSubmit('formEgreso');
    
    // Zoom de imágenes
    mediumZoom('.zoomable', {
        margin: 24,
        background: '#000'
    });
});
</script>