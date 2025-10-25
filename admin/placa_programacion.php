<?php include("includes/header.php"); ?>
</head>
<body>
    <!-- Header Bar -->
    <?php include("includes/menubar.php"); ?>
    <?php include("../data/conexion.php"); ?>

    <?php
    // Verificar si se recibió el id_vh
    if (!isset($_GET['id_vh']) || empty($_GET['id_vh'])) {
        echo "<script>alert('ID de vehículo no válido'); window.location.href='programacion.php';</script>";
        exit();
    }

    $id_vh = (int)$_GET['id_vh'];

    // Obtener información del vehículo
    $sql_vehiculo = "SELECT * FROM unidades WHERE id_vh = $id_vh AND vh_activo = 'si'";
    $resultado_vehiculo = $conexion->query($sql_vehiculo);

    if ($resultado_vehiculo->num_rows == 0) {
        echo "<script>alert('Vehículo no encontrado o inactivo'); window.location.href='programacion.php';</script>";
        exit();
    }

    $vehiculo = $resultado_vehiculo->fetch_assoc();

    // Obtener el último registro de este vehículo en rd_segimientos_head
    $sql_ultimo_registro = "SELECT * FROM rd_segimientos_head 
                           WHERE PLACA = '" . $vehiculo['vh_placa'] . "' 
                           ORDER BY Id_SERG DESC LIMIT 1";
    $resultado_ultimo = $conexion->query($sql_ultimo_registro);
    
    $ultimo_registro = null;
    if ($resultado_ultimo->num_rows > 0) {
        $ultimo_registro = $resultado_ultimo->fetch_assoc();
    }

    // Procesar el formulario de nuevo registro
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['crear_registro'])) {
        
        // Recoger y limpiar datos del formulario
        $s_fecha = limpiarDato($_POST['s_fecha']);
        $h_cita_r = limpiarDato($_POST['h_cita_r']);
        $h_cita = limpiarDato($_POST['h_cita']);
        $supervisor = limpiarDato($_POST['supervisor']);
        $conductor = limpiarDato($_POST['conductor']);
        $auxiliar1 = limpiarDato($_POST['auxiliar1']);
        $auxiliar2 = limpiarDato($_POST['auxiliar2']);
        $auxiliar3 = limpiarDato($_POST['auxiliar3']);
        $tipo_despacho = limpiarDato($_POST['tipo_despacho']);
        $empresa = limpiarDato($_POST['empresa']);
        $cuenta = limpiarDato($_POST['cuenta']);
        $cliente_final = limpiarDato($_POST['cliente_final']);
        $temperatura = limpiarDato($_POST['temperatura']);
        $capacidad_vehiculo = limpiarDato($_POST['capacidad_vehiculo']);
        $num_paletas = limpiarDato($_POST['num_paletas']);
        $bultos_roller = limpiarDato($_POST['bultos_roller']);
        $observaciones = limpiarDato($_POST['observaciones']);
        
        // Escapar datos
        $s_fecha = $conexion->real_escape_string($s_fecha);
        $h_cita_r = $conexion->real_escape_string($h_cita_r);
        $h_cita = $conexion->real_escape_string($h_cita);
        $supervisor = $conexion->real_escape_string($supervisor);
        $conductor = $conexion->real_escape_string($conductor);
        $auxiliar1 = $conexion->real_escape_string($auxiliar1);
        $auxiliar2 = $conexion->real_escape_string($auxiliar2);
        $auxiliar3 = $conexion->real_escape_string($auxiliar3);
        $tipo_despacho = $conexion->real_escape_string($tipo_despacho);
        $empresa = $conexion->real_escape_string($empresa);
        $cuenta = $conexion->real_escape_string($cuenta);
        $cliente_final = $conexion->real_escape_string($cliente_final);
        $temperatura = $conexion->real_escape_string($temperatura);
        $capacidad_vehiculo = $conexion->real_escape_string($capacidad_vehiculo);
        $num_paletas = $conexion->real_escape_string($num_paletas);
        $bultos_roller = $conexion->real_escape_string($bultos_roller);
        $observaciones = $conexion->real_escape_string($observaciones);
        
        // Insertar nuevo registro
        $sql_insert = "INSERT INTO rd_segimientos_head (
            S_FECHA, PLACA, CONDUCTOR, AUXILIAR1, AUXILIAR2, AUXILIAR3,
            SUPERVISOR, TIPO_DESPACHO, EMPRESA, CUENTA, CLIENTE_FINAL,
            H_CITA, H_CITA_R, TEMPERATURA, CAPACIDAD_VEHICULO,
            NUM_PALETAS, BULTOS_ROLLER, OBS_PROG, S_USER, ESTADO_IDP
        ) VALUES (
            '$s_fecha', '" . $vehiculo['vh_placa'] . "', '$conductor', '$auxiliar1', '$auxiliar2', '$auxiliar3',
            '$supervisor', '$tipo_despacho', '$empresa', '$cuenta', '$cliente_final',
            '$h_cita', '$h_cita_r', '$temperatura', '$capacidad_vehiculo',
            '$num_paletas', '$bultos_roller', '$observaciones', " . $_SESSION['id_user'] . ", 0
        )";
        
        if ($conexion->query($sql_insert)) {
            echo "<script>alert('Registro creado correctamente'); window.location.href='programacion.php';</script>";
        } else {
            echo "<script>alert('Error al crear registro: " . $conexion->error . "');</script>";
        }
    }
    ?>

    <!-- Área de Contenido -->
    <div class="content-area">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="text-dark">
                <h2>Nueva Programación</h2>
                <p>Crear nuevo registro para: <strong><?php echo htmlspecialchars($vehiculo['vh_placa']); ?> - <?php echo htmlspecialchars($vehiculo['vh_nick']); ?></strong></p>
            </div>
            <a href="programacion.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>

        <!-- Información del Vehículo -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-truck"></i> Información del Vehículo</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <strong>Placa:</strong> <?php echo htmlspecialchars($vehiculo['vh_placa']); ?>
                    </div>
                    <div class="col-md-3">
                        <strong>Nick:</strong> <?php echo htmlspecialchars($vehiculo['vh_nick']); ?>
                    </div>
                    <div class="col-md-3">
                        <strong>Marca/Modelo:</strong> <?php echo htmlspecialchars($vehiculo['vh_marca'] ?? ''); ?> / <?php echo htmlspecialchars($vehiculo['vh_modelo'] ?? ''); ?>
                    </div>
                    <div class="col-md-3">
                        <strong>Capacidad:</strong> <?php echo htmlspecialchars($vehiculo['vh_capacidad'] ?? ''); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Último Registro (si existe) -->
        <?php if ($ultimo_registro): ?>
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-history"></i> Último Registro de esta Placa</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <strong>Fecha:</strong> <?php echo date('d/m/Y', strtotime($ultimo_registro['S_FECHA'])); ?>
                    </div>
                    <div class="col-md-2">
                        <strong>Hora Base:</strong> <?php echo substr($ultimo_registro['H_CITA_R'], 0, 5); ?>
                    </div>
                    <div class="col-md-2">
                        <strong>Conductor:</strong> <?php echo htmlspecialchars($ultimo_registro['CONDUCTOR'] ?? ''); ?>
                    </div>
                    <div class="col-md-2">
                        <strong>Empresa:</strong> <?php echo htmlspecialchars($ultimo_registro['EMPRESA'] ?? ''); ?>
                    </div>
                    <div class="col-md-2">
                        <strong>Tipo:</strong> <?php echo htmlspecialchars($ultimo_registro['TIPO_DESPACHO'] ?? ''); ?>
                    </div>
                    <div class="col-md-2">
                        <strong>Estado:</strong> <span class="badge bg-<?php echo obtenerColorEstado($ultimo_registro['ESTADO_IDP']); ?>">
                            <?php echo obtenerTextoEstado($ultimo_registro['ESTADO_IDP']); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Formulario de Nuevo Registro -->
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-plus-circle"></i> Nuevo Registro de Programación</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <!-- Columna 1 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Fecha de Servicio <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="s_fecha" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Hora Base <span class="text-danger">*</span></label>
                                <input type="time" class="form-control" name="h_cita_r" value="<?php echo $ultimo_registro['H_CITA_R'] ?? '06:00'; ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Hora Cita Cliente <span class="text-danger">*</span></label>
                                <input type="time" class="form-control" name="h_cita" value="<?php echo $ultimo_registro['H_CITA'] ?? '08:00'; ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Supervisor <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="supervisor" value="<?php echo htmlspecialchars($ultimo_registro['SUPERVISOR'] ?? ''); ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Conductor <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="conductor" value="<?php echo htmlspecialchars($ultimo_registro['CONDUCTOR'] ?? ''); ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Ayudante 1</label>
                                <input type="text" class="form-control" name="auxiliar1" value="<?php echo htmlspecialchars($ultimo_registro['AUXILIAR1'] ?? ''); ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Ayudante 2</label>
                                <input type="text" class="form-control" name="auxiliar2" value="<?php echo htmlspecialchars($ultimo_registro['AUXILIAR2'] ?? ''); ?>">
                            </div>
                        </div>
                        
                        <!-- Columna 2 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Ayudante 3</label>
                                <input type="text" class="form-control" name="auxiliar3" value="<?php echo htmlspecialchars($ultimo_registro['AUXILIAR3'] ?? ''); ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Tipo de Despacho <span class="text-danger">*</span></label>
                                <select class="form-select" name="tipo_despacho" required>
                                    <option value="EXCLUSIVO" <?php echo (($ultimo_registro['TIPO_DESPACHO'] ?? '') == 'EXCLUSIVO') ? 'selected' : ''; ?>>EXCLUSIVO</option>
                                    <option value="RUTA" <?php echo (($ultimo_registro['TIPO_DESPACHO'] ?? '') == 'RUTA') ? 'selected' : ''; ?>>RUTA</option>
                                    <option value="RECOJO" <?php echo (($ultimo_registro['TIPO_DESPACHO'] ?? '') == 'RECOJO') ? 'selected' : ''; ?>>RECOJO</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Empresa <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="empresa" value="<?php echo htmlspecialchars($ultimo_registro['EMPRESA'] ?? ''); ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Cuenta</label>
                                <input type="text" class="form-control" name="cuenta" value="<?php echo htmlspecialchars($ultimo_registro['CUENTA'] ?? ''); ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Cliente Final</label>
                                <input type="text" class="form-control" name="cliente_final" value="<?php echo htmlspecialchars($ultimo_registro['CLIENTE_FINAL'] ?? ''); ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Temperatura</label>
                                <input type="text" class="form-control" name="temperatura" value="<?php echo htmlspecialchars($ultimo_registro['TEMPERATURA'] ?? 'CLIMATIZADO 15° A 25°'); ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Capacidad Vehículo</label>
                                <input type="text" class="form-control" name="capacidad_vehiculo" value="<?php echo htmlspecialchars($ultimo_registro['CAPACIDAD_VEHICULO'] ?? $vehiculo['vh_capacidad'] ?? '1.5 TN'); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Fila inferior -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">N° Paletas</label>
                                <input type="number" class="form-control" name="num_paletas" value="<?php echo htmlspecialchars($ultimo_registro['NUM_PALETAS'] ?? '0'); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Bultos/Roller</label>
                                <input type="number" class="form-control" name="bultos_roller" value="<?php echo htmlspecialchars($ultimo_registro['BULTOS_ROLLER'] ?? '0'); ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Observaciones</label>
                                <textarea class="form-control" name="observaciones" rows="3"><?php echo htmlspecialchars($ultimo_registro['OBS_PROG'] ?? ''); ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" name="crear_registro" class="btn btn-success btn-lg">
                            <i class="fas fa-save"></i> Crear Registro
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Auto-completar campos relacionados
        document.querySelector('[name="empresa"]').addEventListener('change', function() {
            const empresa = this.value;
            const cuentaField = document.querySelector('[name="cuenta"]');
            if (cuentaField.value === '') {
                cuentaField.value = empresa;
            }
        });
    </script>

    <?php
    // Funciones auxiliares para estados
    function obtenerColorEstado($estado) {
        switch($estado) {
            case 0: return 'secondary'; // PROGRAMADO
            case 1: return 'dark'; // SALIDA BASE
            case 2: return 'success'; // EN ALMACEN
            case 3: return 'warning'; // EN RUTA
            case 4: return 'primary'; // FIN SERVICIO
            default: return 'secondary';
        }
    }

    function obtenerTextoEstado($estado) {
        switch($estado) {
            case 0: return 'PROGRAMADO';
            case 1: return 'SALIDA BASE';
            case 2: return 'EN ALMACEN';
            case 3: return 'EN RUTA';
            case 4: return 'FIN SERVICIO';
            default: return 'DESCONOCIDO';
        }
    }

    function limpiarDato($dato) {
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }

    $conexion->close();
    include("includes/footer.php"); 
    ?>
</body>
</html>