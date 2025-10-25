<?php include("includes/header.php"); ?>
</head>
<body>
    <!-- Header Bar -->
    <?php include("includes/menubar.php"); ?>
    <?php include("../data/conexion.php"); ?>

    <?php
    // Obtener fechas por defecto (hoy)
    $fecha_inicio = date('Y-m-d');
    $fecha_fin = date('Y-m-d');
    
    // Procesar filtros si se envió el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_GET['buscar'])) {
        $fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : (isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : $fecha_inicio);
        $fecha_fin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : (isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : $fecha_fin);
        $busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : (isset($_GET['busqueda']) ? $_GET['busqueda'] : '');
    } else {
        $busqueda = '';
    }

    // Procesar SQL personalizado
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ejecutar_sql'])) {
        $sql_personalizado = $_POST['sql_personalizado'];
        try {
            $resultado_sql = $conexion->query($sql_personalizado);
            if ($resultado_sql) {
                echo "<script>alert('SQL ejecutado correctamente');</script>";
            } else {
                echo "<script>alert('Error en SQL: " . $conexion->error . "');</script>";
            }
        } catch (Exception $e) {
            echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
        }
    }

    // Obtener lista de placas activas para el dropdown
    $sql_placas = "SELECT id_vh, vh_placa, vh_nick FROM unidades WHERE vh_activo = 'si' ORDER BY vh_placa";
    $resultado_placas = $conexion->query($sql_placas);
    $placas = [];
    while ($fila = $resultado_placas->fetch_assoc()) {
        $placas[] = $fila;
    }

    // Construir consulta con filtros
    $where_conditions = ["S_FECHA BETWEEN '$fecha_inicio' AND '$fecha_fin'"];
    
    if (!empty($busqueda)) {
        $busqueda_like = $conexion->real_escape_string($busqueda);
        $where_conditions[] = "(PLACA LIKE '%$busqueda_like%' 
                             OR CONDUCTOR LIKE '%$busqueda_like%' 
                             OR AUXILIAR1 LIKE '%$busqueda_like%'
                             OR AUXILIAR2 LIKE '%$busqueda_like%'
                             OR EMPRESA LIKE '%$busqueda_like%'
                             OR CLIENTE_FINAL LIKE '%$busqueda_like%'
                             OR CUENTA LIKE '%$busqueda_like%')";
    }

    $where_sql = "WHERE " . implode(" AND ", $where_conditions);
    
    // Consulta principal
    $sql = "SELECT 
                Id_SERG,
                S_FECHA,
                H_CITA_R as HORA_BASE,
                SUPERVISOR,
                PLACA,
                CONDUCTOR,
                AUXILIAR1 as AYUDANTE_1,
                AUXILIAR2 as AYUDANTE_2,
                AUXILIAR3 as AYUDANTE_3,
                CUENTA,
                CLIENTE_FINAL as CLIENTE,
                H_CITA as CITA,
                TIPO_DESPACHO as TIPO,
                CAPACIDAD_VEHICULO as UND,
                TEMPERATURA,
                NUM_PALETAS as PALLET,
                BULTOS_ROLLER as BULTOS,
                DEVOLUCIONES,
                KM_INICIO,
                KM_FINAL,
                GUIA_TRANSPORTE,
                OBSERVACION_GENERAL as OBSERVACIONES,
                ESTADO_IDP
            FROM rd_segimientos_head 
            $where_sql 
            ORDER BY S_FECHA DESC, H_CITA_R ASC";

    $resultado = $conexion->query($sql);
    ?>

    <!-- Área de Contenido -->
    <div class="content-area">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>Programación de Unidades</h2>
                <p class="text-white">Control y seguimiento de servicios programados</p>
            </div>
            <div class="btn-group">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-download"></i> Exportar
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" onclick="exportarFormato('excel')"><i class="fas fa-file-excel text-success"></i> Excel</a></li>
                        <li><a class="dropdown-item" href="#" onclick="exportarFormato('txt')"><i class="fas fa-file-alt text-info"></i> TXT</a></li>
                        <li><a class="dropdown-item" href="#" onclick="exportarFormato('pdf')"><i class="fas fa-file-pdf text-danger"></i> PDF</a></li>
                    </ul>
                </div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNuevoRegistro">
                    <i class="fas fa-plus"></i> Nuevo Registro
                </button>
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalSQL">
                    <i class="fas fa-database"></i> +SQL
                </button>
            </div>
        </div>

        <!-- Filtros de Búsqueda -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" id="formFiltros">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label text-white">Fecha Inicio</label>
                            <input type="date" class="form-control" name="fecha_inicio" value="<?php echo $fecha_inicio; ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-white">Fecha Fin</label>
                            <input type="date" class="form-control" name="fecha_fin" value="<?php echo $fecha_fin; ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-white">Buscar (Placa, Conductor, Empresa, etc.)</label>
                            <input type="text" class="form-control" name="busqueda" value="<?php echo htmlspecialchars($busqueda); ?>" 
                                   placeholder="Placa, conductor, auxiliar, empresa...">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla de Programación -->
        <div class="card">
            <div class="card-body">
                <?php if (!empty($busqueda)): ?>
                    <div class="alert alert-info mb-3">
                        <i class="fas fa-info-circle"></i> 
                        Mostrando resultados para: "<strong><?php echo htmlspecialchars($busqueda); ?></strong>"
                        en el rango: <strong><?php echo date('d/m/Y', strtotime($fecha_inicio)); ?></strong> al 
                        <strong><?php echo date('d/m/Y', strtotime($fecha_fin)); ?></strong>
                        <span class="badge bg-primary ms-2"><?php echo $resultado->num_rows; ?> registros</span>
                    </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="tablaProgramacion">
                        <thead class="table-dark">
                            <tr>
                                <th>FECHA</th>
                                <th>HORA BASE</th>
                                <th>SUPERVISOR</th>
                                <th>PLACA</th>
                                <th>CONDUCTOR</th>
                                <th>AYUDANTE 1</th>
                                <th>AYUDANTE 2</th>
                                <th>AYUDANTE 3</th>
                                <th>CUENTA</th>
                                <th>CLIENTE</th>
                                <th>CITA</th>
                                <th>TIPO</th>
                                <th>UND</th>
                                <th>TEMP</th>
                                <th>PALLET</th>
                                <th>BULTOS</th>
                                <th>DEVOL.</th>
                                <th>KM INI</th>
                                <th>KM FIN</th>
                                <th>GUÍA TRANS.</th>
                                <th>OBSERVACIONES</th>
                                <th>ESTADO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($resultado->num_rows > 0) {
                                while ($fila = $resultado->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . date('d/m/Y', strtotime($fila['S_FECHA'])) . "</td>";
                                    echo "<td>" . substr($fila['HORA_BASE'], 0, 5) . "</td>";
                                    echo "<td>" . htmlspecialchars($fila['SUPERVISOR'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars($fila['PLACA'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars($fila['CONDUCTOR'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars($fila['AYUDANTE_1'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars($fila['AYUDANTE_2'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars($fila['AYUDANTE_3'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars($fila['CUENTA'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars($fila['CLIENTE'] ?? '') . "</td>";
                                    echo "<td>" . substr($fila['CITA'], 0, 5) . "</td>";
                                    echo "<td><span class='badge bg-info'>" . htmlspecialchars($fila['TIPO'] ?? '') . "</span></td>";
                                    echo "<td>" . htmlspecialchars($fila['UND'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars($fila['TEMPERATURA'] ?? '') . "</td>";
                                    echo "<td class='text-center'>" . ($fila['PALLET'] ? htmlspecialchars($fila['PALLET']) : '0') . "</td>";
                                    echo "<td class='text-center'>" . ($fila['BULTOS'] ? htmlspecialchars($fila['BULTOS']) : '0') . "</td>";
                                    echo "<td>" . htmlspecialchars($fila['DEVOLUCIONES'] ?? '') . "</td>";
                                    echo "<td class='text-center'>" . ($fila['KM_INICIO'] ? htmlspecialchars($fila['KM_INICIO']) : '-') . "</td>";
                                    echo "<td class='text-center'>" . ($fila['KM_FINAL'] ? htmlspecialchars($fila['KM_FINAL']) : '-') . "</td>";
                                    echo "<td>" . htmlspecialchars($fila['GUIA_TRANSPORTE'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars($fila['OBSERVACIONES'] ?? '') . "</td>";
                                    echo "<td><span class='badge bg-" . obtenerColorEstado($fila['ESTADO_IDP']) . "'>" . obtenerTextoEstado($fila['ESTADO_IDP']) . "</span></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='22' class='text-center'>No hay registros de programación para el rango de fechas seleccionado</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal SQL -->
    <div class="modal fade" id="modalSQL" tabindex="-1" aria-labelledby="modalSQLLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="modalSQLLabel">
                        <i class="fas fa-database"></i> Ejecutar SQL Personalizado
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Sentencia SQL</label>
                            <textarea class="form-control" name="sql_personalizado" rows="8" 
                                      placeholder="INSERT INTO rd_segimientos_head (S_FECHA, PLACA, CONDUCTOR, ...) VALUES (...);" 
                                      style="font-family: 'Courier New', monospace;"></textarea>
                            <small class="text-muted">Ejecuta sentencias SQL INSERT para agregar múltiples registros</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" name="ejecutar_sql" class="btn btn-success">
                            <i class="fas fa-play"></i> Ejecutar SQL
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo Registro -->
    <div class="modal fade" id="modalNuevoRegistro" tabindex="-1" aria-labelledby="modalNuevoRegistroLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalNuevoRegistroLabel">
                        <i class="fas fa-truck"></i> Nuevo Registro por Placa
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="GET" action="placa_programacion.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Seleccionar Vehículo</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-truck"></i>
                                </span>
                                <select class="form-select" name="id_vh" required>
                                    <option value="">-- Seleccionar Placa --</option>
                                    <?php foreach ($placas as $placa): ?>
                                        <option value="<?php echo $placa['id_vh']; ?>">
                                            <?php echo htmlspecialchars($placa['vh_placa']); ?> - <?php echo htmlspecialchars($placa['vh_nick']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <small class="text-muted">Seleccione un vehículo activo del sistema</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-cog"></i> Generar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function exportarFormato(formato) {
            // Crear URL con parámetros actuales
            let params = new URLSearchParams();
            params.append('fecha_inicio', document.querySelector('[name="fecha_inicio"]').value);
            params.append('fecha_fin', document.querySelector('[name="fecha_fin"]').value);
            params.append('busqueda', document.querySelector('[name="busqueda"]').value);
            params.append('exportar', formato);
            
            window.open('programacion.php?' + params.toString(), '_blank');
        }

        // Auto-enviar formulario cuando cambien las fechas
        document.querySelector('[name="fecha_inicio"]').addEventListener('change', function() {
            document.getElementById('formFiltros').submit();
        });
        
        document.querySelector('[name="fecha_fin"]').addEventListener('change', function() {
            document.getElementById('formFiltros').submit();
        });

        // Ejemplo de SQL al abrir modal
        document.getElementById('modalSQL').addEventListener('show.bs.modal', function() {
            const textarea = this.querySelector('textarea[name="sql_personalizado"]');
            if (textarea.value === '') {
                textarea.value = `INSERT INTO rd_segimientos_head (
S_FECHA, PLACA, CONDUCTOR, AUXILIAR1, SUPERVISOR, 
TIPO_DESPACHO, EMPRESA, H_CITA, H_CITA_R, ESTADO_IDP
) VALUES 
('2024-10-25', 'ABC123', 'CONDUCTOR 1', 'AYUDANTE 1', 'SUPERVISOR 1', 'EXCLUSIVO', 'EMPRESA 1', '08:00:00', '06:00:00', 0),
('2024-10-25', 'XYZ789', 'CONDUCTOR 2', 'AYUDANTE 2', 'SUPERVISOR 2', 'RUTA', 'EMPRESA 2', '09:00:00', '07:00:00', 0);`;
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

    $conexion->close();
    include("includes/footer.php"); 
    ?>
</body>
</html>