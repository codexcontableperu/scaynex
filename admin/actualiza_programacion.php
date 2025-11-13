<?php include("includes/header.php"); ?>
</head>
<body>
    <!-- Header Bar -->
    <?php include("includes/menubar.php"); ?>
    <?php include("../data/conexion.php"); ?>

    <?php
    // Verificar si se recibió el id_vh
    if (!isset($_GET['id_vh']) || empty($_GET['id_vh'])) {
        echo "<script>alert('ID de registro no válido'); window.location.href='programacion.php';</script>";
        exit();
    }

    $id_registro = (int)$_GET['id_vh'];

    // Obtener información del registro
    $sql_registro = "SELECT * FROM rd_segimientos_head WHERE Id_SERG = $id_registro";
    $resultado_registro = $conexion->query($sql_registro);

    if ($resultado_registro->num_rows == 0) {
        echo "<script>alert('Registro no encontrado'); window.location.href='programacion.php';</script>";
        exit();
    }

    $registro = $resultado_registro->fetch_assoc();

    // Obtener información del vehículo
    $sql_vehiculo = "SELECT * FROM unidades WHERE vh_placa = '" . $registro['PLACA'] . "' AND vh_activo = 'si'";
    $resultado_vehiculo = $conexion->query($sql_vehiculo);
    
    $vehiculo = null;
    if ($resultado_vehiculo->num_rows > 0) {
        $vehiculo = $resultado_vehiculo->fetch_assoc();
    }

    // Obtener usuarios activos para dropdowns
    $sql_usuarios = "SELECT id_user, user_nick, user_nombre FROM usuarios WHERE user_activo = 'si' ORDER BY user_nombre";
    $resultado_usuarios = $conexion->query($sql_usuarios);
    $usuarios = [];
    while($usuario = $resultado_usuarios->fetch_assoc()) {
        $usuarios[] = $usuario;
    }

    // Procesar el formulario de actualización
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar_registro'])) {
        
        // Recoger y limpiar datos del formulario
        $s_fecha = limpiarDato($_POST['s_fecha']);
        $h_cita_r = limpiarDato($_POST['h_cita_r']);
        $h_cita = limpiarDato($_POST['h_cita']);
        $supervisor_id = limpiarDato($_POST['supervisor']);
        $conductor_id = limpiarDato($_POST['conductor']);
        $auxiliar1_id = limpiarDato($_POST['auxiliar1']);
        $auxiliar2_id = limpiarDato($_POST['auxiliar2']);
        $auxiliar3_id = limpiarDato($_POST['auxiliar3']);
        $tipo_despacho = limpiarDato($_POST['tipo_despacho']);
        $empresa = limpiarDato($_POST['empresa']);
        $cuenta = limpiarDato($_POST['cuenta']);
        $cliente_final = limpiarDato($_POST['cliente_final']);
        $temperatura = limpiarDato($_POST['temperatura']);
        $capacidad_vehiculo = limpiarDato($_POST['capacidad_vehiculo']);
        $num_paletas = limpiarDato($_POST['num_paletas']);
        $bultos_roller = limpiarDato($_POST['bultos_roller']);
        $observaciones = limpiarDato($_POST['observaciones']);
        
        // Obtener nombres de usuarios basados en los IDs seleccionados
        $conductor_nombre = '';
        $auxiliar1_nombre = '';
        $auxiliar2_nombre = '';
        $auxiliar3_nombre = '';
        $supervisor_nombre = '';
        
        if (!empty($conductor_id)) {
            $sql_user = "SELECT user_nick, user_nombre FROM usuarios WHERE id_user = $conductor_id";
            $result = $conexion->query($sql_user);
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $conductor_nombre = $user['user_nick'] . ' - ' . $user['user_nombre'];
            }
        }
        
        if (!empty($auxiliar1_id)) {
            $sql_user = "SELECT user_nick, user_nombre FROM usuarios WHERE id_user = $auxiliar1_id";
            $result = $conexion->query($sql_user);
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $auxiliar1_nombre = $user['user_nick'] . ' - ' . $user['user_nombre'];
            }
        }
        
        if (!empty($auxiliar2_id)) {
            $sql_user = "SELECT user_nick, user_nombre FROM usuarios WHERE id_user = $auxiliar2_id";
            $result = $conexion->query($sql_user);
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $auxiliar2_nombre = $user['user_nick'] . ' - ' . $user['user_nombre'];
            }
        }
        
        if (!empty($auxiliar3_id)) {
            $sql_user = "SELECT user_nick, user_nombre FROM usuarios WHERE id_user = $auxiliar3_id";
            $result = $conexion->query($sql_user);
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $auxiliar3_nombre = $user['user_nick'] . ' - ' . $user['user_nombre'];
            }
        }
        
        if (!empty($supervisor_id)) {
            $sql_user = "SELECT user_nick, user_nombre FROM usuarios WHERE id_user = $supervisor_id";
            $result = $conexion->query($sql_user);
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $supervisor_nombre = $user['user_nick'] . ' - ' . $user['user_nombre'];
            }
        }
        
        // Escapar datos
        $s_fecha = $conexion->real_escape_string($s_fecha);
        $h_cita_r = $conexion->real_escape_string($h_cita_r);
        $h_cita = $conexion->real_escape_string($h_cita);
        $supervisor_nombre = $conexion->real_escape_string($supervisor_nombre);
        $conductor_nombre = $conexion->real_escape_string($conductor_nombre);
        $auxiliar1_nombre = $conexion->real_escape_string($auxiliar1_nombre);
        $auxiliar2_nombre = $conexion->real_escape_string($auxiliar2_nombre);
        $auxiliar3_nombre = $conexion->real_escape_string($auxiliar3_nombre);
        $tipo_despacho = $conexion->real_escape_string($tipo_despacho);
        $empresa = $conexion->real_escape_string($empresa);
        $cuenta = $conexion->real_escape_string($cuenta);
        $cliente_final = $conexion->real_escape_string($cliente_final);
        $temperatura = $conexion->real_escape_string($temperatura);
        $capacidad_vehiculo = $conexion->real_escape_string($capacidad_vehiculo);
        $num_paletas = $conexion->real_escape_string($num_paletas);
        $bultos_roller = $conexion->real_escape_string($bultos_roller);
        $observaciones = $conexion->real_escape_string($observaciones);
        
        // Actualizar registro con IDs y nombres
        $sql_update = "UPDATE rd_segimientos_head SET
            S_FECHA = '$s_fecha',
            CONDUCTOR = '$conductor_nombre',
            AUXILIAR1 = '$auxiliar1_nombre',
            AUXILIAR2 = '$auxiliar2_nombre',
            AUXILIAR3 = '$auxiliar3_nombre',
            SUPERVISOR = '$supervisor_nombre',
            TIPO_DESPACHO = '$tipo_despacho',
            EMPRESA = '$empresa',
            CUENTA = '$cuenta',
            CLIENTE_FINAL = '$cliente_final',
            H_CITA = '$h_cita',
            H_CITA_R = '$h_cita_r',
            TEMPERATURA = '$temperatura',
            CAPACIDAD_VEHICULO = '$capacidad_vehiculo',
            NUM_PALETAS = '$num_paletas',
            BULTOS_ROLLER = '$bultos_roller',
            OBS_PROG = '$observaciones',
            ID_CONDUC = " . (!empty($conductor_id) ? $conductor_id : "NULL") . ",
            ID_AUX1 = " . (!empty($auxiliar1_id) ? $auxiliar1_id : "NULL") . ",
            ID_AUX2 = " . (!empty($auxiliar2_id) ? $auxiliar2_id : "NULL") . ",
            ID_AUX3 = " . (!empty($auxiliar3_id) ? $auxiliar3_id : "NULL") . "
            WHERE Id_SERG = $id_registro";
        
        if ($conexion->query($sql_update)) {
            echo "<script>alert('Registro actualizado correctamente'); window.location.href='programacion.php';</script>";
        } else {
            echo "<script>alert('Error al actualizar registro: " . $conexion->error . "');</script>";
        }
    }
    ?>

    <!-- Área de Contenido -->
    <div class="content-area">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="text-dark">
                <h4 class="mb-1">Actualizar Programación</h4>
                <p class="mb-0 small text-muted">Editando registro: <strong><?php echo htmlspecialchars($registro['PLACA']); ?> - <?php echo date('d/m/Y', strtotime($registro['S_FECHA'])); ?></strong></p>
            </div>
            <a href="programacion.php" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>

        <!-- Información del Vehículo -->
        <?php if ($vehiculo): ?>
        <div class="card mb-3">
            <div class="card-header bg-primary text-white py-2">
                <h6 class="mb-0"><i class="fas fa-truck"></i> Información del Vehículo</h6>
            </div>
            <div class="card-body py-2">
                <div class="row small">
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
        <?php endif; ?>

        <!-- Información del Estado -->
        <div class="card mb-3">
            <div class="card-header bg-info text-white py-2">
                <h6 class="mb-0"><i class="fas fa-info-circle"></i> Información del Registro</h6>
            </div>
            <div class="card-body py-2">
                <div class="row small">
                    <div class="col-md-2">
                        <strong>ID Registro:</strong> <?php echo $registro['Id_SERG']; ?>
                    </div>
                    <div class="col-md-2">
                        <strong>Estado:</strong> 
                        <span class="badge bg-<?php echo obtenerColorEstado($registro['ESTADO_IDP']); ?>">
                            <?php echo obtenerTextoEstado($registro['ESTADO_IDP']); ?>
                        </span>
                    </div>
                    <div class="col-md-2">
                        <strong>Creado por:</strong> <?php echo htmlspecialchars($registro['S_USER'] ?? ''); ?>
                    </div>
                    <div class="col-md-3">
                        <strong>Fecha creación:</strong> <?php echo date('d/m/Y H:i', strtotime($registro['REGISTER'])); ?>
                    </div>
                    <div class="col-md-3">
                        <strong>Última actualización:</strong> <?php echo date('d/m/Y H:i', strtotime($registro['REGISTER'])); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario de Actualización -->
        <div class="card">
            <div class="card-header bg-warning text-white py-2">
                <h6 class="mb-0"><i class="fas fa-edit"></i> Actualizar Registro de Programación</h6>
            </div>
            <div class="card-body p-3">
                <form method="POST">
                    
                    <!-- SECCIÓN 1: Información Básica -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="border-bottom pb-1 mb-2 text-primary">1. Información Básica</h6>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small">Placa</label>
                            <input type="text" class="form-control form-control-sm" value="<?php echo htmlspecialchars($registro['PLACA']); ?>" readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small">Fecha Servicio <span class="text-danger">*</span></label>
                            <input type="date" class="form-control form-control-sm" name="s_fecha" value="<?php echo htmlspecialchars($registro['S_FECHA']); ?>" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small">Hora Base <span class="text-danger">*</span></label>
                            <input type="time" class="form-control form-control-sm" name="h_cita_r" value="<?php echo substr($registro['H_CITA_R'], 0, 5); ?>" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small">Hora Cita <span class="text-danger">*</span></label>
                            <input type="time" class="form-control form-control-sm" name="h_cita" value="<?php echo substr($registro['H_CITA'], 0, 5); ?>" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small">Empresa <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="empresa" value="<?php echo htmlspecialchars($registro['EMPRESA'] ?? ''); ?>" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small">Cuenta</label>
                            <input type="text" class="form-control form-control-sm" name="cuenta" value="<?php echo htmlspecialchars($registro['CUENTA'] ?? ''); ?>">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label class="form-label small">Cliente Final</label>
                            <input type="text" class="form-control form-control-sm" name="cliente_final" value="<?php echo htmlspecialchars($registro['CLIENTE_FINAL'] ?? ''); ?>">
                        </div>
                    </div>

                    <!-- SECCIÓN 2: Personal Asignado -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="border-bottom pb-1 mb-2 text-primary">2. Personal Asignado</h6>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small">Conductor <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" name="conductor" required>
                                <option value="">Seleccionar conductor</option>
                                <?php foreach($usuarios as $usuario): 
                                    $selected = ($registro['ID_CONDUC'] == $usuario['id_user']) ? 'selected' : '';
                                ?>
                                <option value="<?php echo $usuario['id_user']; ?>" <?php echo $selected; ?>>
                                    <?php echo htmlspecialchars($usuario['user_nick'] . ' - ' . $usuario['user_nombre']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small">Ayudante 1</label>
                            <select class="form-select form-select-sm" name="auxiliar1">
                                <option value="">Seleccionar ayudante</option>
                                <?php foreach($usuarios as $usuario): 
                                    $selected = ($registro['ID_AUX1'] == $usuario['id_user']) ? 'selected' : '';
                                ?>
                                <option value="<?php echo $usuario['id_user']; ?>" <?php echo $selected; ?>>
                                    <?php echo htmlspecialchars($usuario['user_nick'] . ' - ' . $usuario['user_nombre']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small">Ayudante 2</label>
                            <select class="form-select form-select-sm" name="auxiliar2">
                                <option value="">Seleccionar ayudante</option>
                                <?php foreach($usuarios as $usuario): 
                                    $selected = ($registro['ID_AUX2'] == $usuario['id_user']) ? 'selected' : '';
                                ?>
                                <option value="<?php echo $usuario['id_user']; ?>" <?php echo $selected; ?>>
                                    <?php echo htmlspecialchars($usuario['user_nick'] . ' - ' . $usuario['user_nombre']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small">Ayudante 3</label>
                            <select class="form-select form-select-sm" name="auxiliar3">
                                <option value="">Seleccionar ayudante</option>
                                <?php foreach($usuarios as $usuario): 
                                    $selected = ($registro['ID_AUX3'] == $usuario['id_user']) ? 'selected' : '';
                                ?>
                                <option value="<?php echo $usuario['id_user']; ?>" <?php echo $selected; ?>>
                                    <?php echo htmlspecialchars($usuario['user_nick'] . ' - ' . $usuario['user_nombre']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-12 mt-2">
                            <label class="form-label small">Supervisor <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" name="supervisor" required>
                                <option value="">Seleccionar supervisor</option>
                                <?php foreach($usuarios as $usuario): ?>
                                <option value="<?php echo $usuario['id_user']; ?>">
                                    <?php echo htmlspecialchars($usuario['user_nick'] . ' - ' . $usuario['user_nombre']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- SECCIÓN 3: Configuración del Servicio -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="border-bottom pb-1 mb-2 text-primary">3. Configuración del Servicio</h6>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small">Tipo de Despacho <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" name="tipo_despacho" required>
                                <option value="EXCLUSIVO" <?php echo ($registro['TIPO_DESPACHO'] == 'EXCLUSIVO') ? 'selected' : ''; ?>>EXCLUSIVO</option>
                                <option value="RUTA" <?php echo ($registro['TIPO_DESPACHO'] == 'RUTA') ? 'selected' : ''; ?>>RUTA</option>
                                <option value="RECOJO" <?php echo ($registro['TIPO_DESPACHO'] == 'RECOJO') ? 'selected' : ''; ?>>RECOJO</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small">Temperatura</label>
                            <input type="text" class="form-control form-control-sm" name="temperatura" value="<?php echo htmlspecialchars($registro['TEMPERATURA'] ?? 'CLIMATIZADO 15° A 25°'); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small">Capacidad Vehículo</label>
                            <input type="text" class="form-control form-control-sm" name="capacidad_vehiculo" value="<?php echo htmlspecialchars($registro['CAPACIDAD_VEHICULO'] ?? '1.5 TN'); ?>">
                        </div>
                    </div>

                    <!-- SECCIÓN 4: Datos de Carga -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="border-bottom pb-1 mb-2 text-primary">4. Datos de Carga</h6>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small">N° Paletas</label>
                            <input type="number" class="form-control form-control-sm" name="num_paletas" value="<?php echo htmlspecialchars($registro['NUM_PALETAS'] ?? '0'); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small">Bultos/Roller</label>
                            <input type="number" class="form-control form-control-sm" name="bultos_roller" value="<?php echo htmlspecialchars($registro['BULTOS_ROLLER'] ?? '0'); ?>">
                        </div>
                    </div>

                    <!-- OBSERVACIONES -->
                    <div class="row">
                        <div class="col-12">
                            <h6 class="border-bottom pb-1 mb-2 text-primary">Observaciones</h6>
                            <div class="mb-2">
                                <label class="form-label small">Observaciones Generales</label>
                                <textarea class="form-control form-control-sm" name="observaciones" rows="2"><?php echo htmlspecialchars($registro['OBS_PROG'] ?? ''); ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <button type="submit" name="actualizar_registro" class="btn btn-warning btn-sm">
                            <i class="fas fa-sync-alt"></i> Actualizar Registro
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