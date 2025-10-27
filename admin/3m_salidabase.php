<?php include("includes/header.php"); ?>
</head>
<body>
    <!-- Header Bar -->
    <?php include("includes/menubar.php"); ?>
    <?php include("../data/conexion.php"); ?>

    <?php
    // Verificar si se recibió el id_serg
    if (!isset($_GET['id_serg']) || empty($_GET['id_serg'])) {
        echo "<script>alert('ID de servicio no válido'); window.location.href='monitoreo.php';</script>";
        exit();
    }

    $id_serg = (int)$_GET['id_serg'];

    // Obtener datos de la programación
    $sql_programacion = "SELECT * FROM rd_segimientos_head WHERE Id_SERG = $id_serg";
    $result_programacion = $conexion->query($sql_programacion);

    if ($result_programacion->num_rows == 0) {
        echo "<script>alert('Servicio no encontrado'); window.location.href='monitoreo.php';</script>";
        exit();
    }

    $programacion = $result_programacion->fetch_assoc();

    // Obtener datos de inicio/fin (salida base)
    $sql_inicio_fin = "SELECT * FROM rd_inicio_fin WHERE Id_SERG = $id_serg";
    $result_inicio_fin = $conexion->query($sql_inicio_fin);
    $inicio_fin = $result_inicio_fin->num_rows > 0 ? $result_inicio_fin->fetch_assoc() : null;

    // Obtener fotos de PARTIDA
    $sql_fotos = "SELECT * FROM rd_fotos WHERE Id_SERG = $id_serg AND TIPO = 'PARTIDA' ORDER BY REGISTER DESC";
    $result_fotos = $conexion->query($sql_fotos);
    $fotos = [];
    while ($foto = $result_fotos->fetch_assoc()) {
        $fotos[] = $foto;
    }

    // Procesar actualización de datos de salida base
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar_salida'])) {
        $hora_salida = $_POST['hora_salida_base'];
        $km_salida = $_POST['km_salida_base'];
        $temp_salida = $_POST['temp_salida_base'];
        $arender = $_POST['arender'];
        
        if ($inicio_fin) {
            // Actualizar registro existente
            $sql_update = "UPDATE rd_inicio_fin SET 
                          HORA_SALIDA_BASE = '$hora_salida',
                          KM_SALIDA_BASE = '$km_salida',
                          TEMP_SALIDA_BASE = '$temp_salida',
                          ARENDIR = '$arender'
                          WHERE Id_SERG = $id_serg";
        } else {
            // Crear nuevo registro
            $sql_update = "INSERT INTO rd_inicio_fin (Id_SERG, HORA_SALIDA_BASE, KM_SALIDA_BASE, TEMP_SALIDA_BASE, ARENDIR) 
                          VALUES ($id_serg, '$hora_salida', '$km_salida', '$temp_salida', '$arender')";
        }
        
        if ($conexion->query($sql_update)) {
            echo "<script>alert('Datos de salida base actualizados correctamente'); window.location.reload();</script>";
        } else {
            echo "<script>alert('Error al actualizar: " . $conexion->error . "');</script>";
        }
    }

    // Procesar subida de foto
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['subir_foto'])) {
        if (isset($_FILES['foto_evidencia']) && $_FILES['foto_evidencia']['error'] == 0) {
            $permitidos = array("image/jpg", "image/jpeg", "image/png", "image/gif");
            $limite_tamaño = 5242880; // 5MB
            
            if (in_array($_FILES['foto_evidencia']['type'], $permitidos) && $_FILES['foto_evidencia']['size'] <= $limite_tamaño) {
                
                $extension = pathinfo($_FILES['foto_evidencia']['name'], PATHINFO_EXTENSION);
                $nombre_archivo = "partida_" . $id_serg . "_" . time() . "." . $extension;
                $ruta_destino = "../img/fotos/" . $nombre_archivo;
                
                if (move_uploaded_file($_FILES['foto_evidencia']['tmp_name'], $ruta_destino)) {
                    
                    $alcance = $conexion->real_escape_string($_POST['alcance_foto']);
                    $sql_insert_foto = "INSERT INTO rd_fotos (TIPO, IMG, ALCANCE, Id_SERG, ID_SERV, ID_DESG) 
                                       VALUES ('PARTIDA', '$nombre_archivo', '$alcance', $id_serg, 0, 0)";
                    
                    if ($conexion->query($sql_insert_foto)) {
                        echo "<script>alert('Foto de partida subida correctamente'); window.location.reload();</script>";
                    } else {
                        echo "<script>alert('Error al guardar foto en base de datos');</script>";
                    }
                    
                } else {
                    echo "<script>alert('Error al subir el archivo');</script>";
                }
                
            } else {
                echo "<script>alert('Formato no permitido o archivo muy grande (máx 5MB)');</script>";
            }
        } else {
            echo "<script>alert('No se seleccionó ningún archivo');</script>";
        }
    }
    ?>

    <!-- Área de Contenido -->
    <div class="content-area">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>Salida de Base</h2>
                <p class="text-white">Registro de partida - Servicio #<?php echo $id_serg; ?></p>
            </div>
            <a href="monitoreo.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver al Monitoreo
            </a>
        </div>

        <!-- Información del Servicio -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-info-circle"></i> Información del Servicio</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <strong>Placa:</strong> <?php echo htmlspecialchars($programacion['PLACA']); ?>
                    </div>
                    <div class="col-md-3">
                        <strong>Conductor:</strong> <?php echo htmlspecialchars($programacion['CONDUCTOR']); ?>
                    </div>
                    <div class="col-md-3">
                        <strong>Empresa:</strong> <?php echo htmlspecialchars($programacion['EMPRESA']); ?>
                    </div>
                    <div class="col-md-3">
                        <strong>Fecha:</strong> <?php echo date('d/m/Y', strtotime($programacion['S_FECHA'])); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Sección 1: Datos de Partida -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-flag"></i> Datos de Partida</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Hora Salida Base</label>
                                <input type="time" class="form-control" name="hora_salida_base" 
                                       value="<?php echo $inicio_fin['HORA_SALIDA_BASE'] ?? date('H:i'); ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Kilometraje Salida</label>
                                <input type="number" step="0.01" class="form-control" name="km_salida_base" 
                                       value="<?php echo $inicio_fin['KM_SALIDA_BASE'] ?? ''; ?>" placeholder="Ej: 1500.50" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Temperatura Salida</label>
                                <input type="text" class="form-control" name="temp_salida_base" 
                                       value="<?php echo $inicio_fin['TEMP_SALIDA_BASE'] ?? ''; ?>" placeholder="Ej: 18°C">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">A Rendir</label>
                                <input type="number" step="0.01" class="form-control" name="arender" 
                                       value="<?php echo $inicio_fin['ARENDIR'] ?? ''; ?>" placeholder="Monto a rendir">
                            </div>
                            
                            <button type="submit" name="actualizar_salida" class="btn btn-success w-100">
                                <i class="fas fa-save"></i> Guardar Datos de Partida
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sección 2: Fotos Evidencias -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-camera"></i> Fotos de Evidencia - PARTIDA</h5>
                    </div>
                    <div class="card-body">
                        <!-- Formulario para subir foto -->
                        <form method="POST" enctype="multipart/form-data" class="mb-4">
                            <div class="mb-3">
                                <label class="form-label">Seleccionar Foto</label>
                                <input type="file" class="form-control" name="foto_evidencia" accept="image/*" required>
                                <small class="text-muted">Formatos: JPG, PNG, GIF (Máx 5MB)</small>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Alcance/Descripción</label>
                                <input type="text" class="form-control" name="alcance_foto" 
                                       placeholder="Ej: Vehículo, Documentos, Carga" required>
                            </div>
                            
                            <button type="submit" name="subir_foto" class="btn btn-info w-100">
                                <i class="fas fa-upload"></i> Subir Foto de Partida
                            </button>
                        </form>

                        <!-- Galería de fotos existentes -->
                        <h6 class="border-bottom pb-2">Fotos Registradas</h6>
                        <div class="row g-2">
                            <?php if (count($fotos) > 0): ?>
                                <?php foreach ($fotos as $foto): ?>
                                    <div class="col-6">
                                        <div class="card">
                                            <img src="../img/fotos/<?php echo htmlspecialchars($foto['IMG']); ?>" 
                                                 class="card-img-top" 
                                                 style="height: 120px; object-fit: cover;"
                                                 alt="<?php echo htmlspecialchars($foto['ALCANCE']); ?>"
                                                 onclick="ampliarImagen(this.src, '<?php echo htmlspecialchars($foto['ALCANCE']); ?>')">
                                            <div class="card-body p-2">
                                                <small class="text-muted"><?php echo htmlspecialchars($foto['ALCANCE']); ?></small>
                                                <br>
                                                <small class="text-muted">
                                                    <?php echo date('H:i', strtotime($foto['REGISTER'])); ?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="col-12 text-center text-muted py-4">
                                    <i class="fas fa-images fa-3x mb-2"></i><br>
                                    No hay fotos de partida registradas
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para ampliar imagen -->
    <div class="modal fade" id="modalImagen" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalImagenTitulo"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="imagenAmpliada" src="" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>

    <style>
        .card-img-top {
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        
        .card-img-top:hover {
            transform: scale(1.05);
        }
    </style>

    <script>
        function ampliarImagen(src, titulo) {
            document.getElementById('imagenAmpliada').src = src;
            document.getElementById('modalImagenTitulo').textContent = titulo;
            new bootstrap.Modal(document.getElementById('modalImagen')).show();
        }

        // Auto-seleccionar hora actual si no hay datos
        document.addEventListener('DOMContentLoaded', function() {
            const horaInput = document.querySelector('[name="hora_salida_base"]');
            if (!horaInput.value) {
                const now = new Date();
                const timeString = now.getHours().toString().padStart(2, '0') + ':' + 
                                 now.getMinutes().toString().padStart(2, '0');
                horaInput.value = timeString;
            }
        });
    </script>

    <?php
    $conexion->close();
    include("includes/footer.php"); 
    ?>
</body>
</html>