<?php include("includes/header.php"); ?>
</head>
<body>
    <!-- Header Bar -->
    <?php include("includes/menubar.php"); ?>
    <?php include("../data/conexion.php"); ?>

    <?php
    // Fecha por defecto (hoy)
    $fecha = date('Y-m-d');
    $busqueda = '';
    
    // Procesar filtros
    if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_GET['buscar'])) {
        $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : (isset($_GET['fecha']) ? $_GET['fecha'] : $fecha);
        $busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : (isset($_GET['busqueda']) ? $_GET['busqueda'] : '');
    }

    // Consulta para obtener todas las unidades activas
    $sql_unidades = "SELECT id_vh, vh_placa, vh_avatar, vh_nick, vh_marca, vh_modelo, vh_capacidad 
                    FROM unidades 
                    WHERE vh_activo = 'si'";

    if (!empty($busqueda)) {
        $busqueda_like = $conexion->real_escape_string($busqueda);
        $sql_unidades .= " AND vh_placa LIKE '%$busqueda_like%'";
    }

    $sql_unidades .= " ORDER BY vh_placa";
    $resultado_unidades = $conexion->query($sql_unidades);
    ?>

    <!-- Área de Contenido -->
    <div class="content-area">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>Monitoreo de Unidades</h2>

            </div>
        </div>

        <!-- Filtros -->
        <div class="card mb-4" >
            <div class="card-body">
                <form method="POST" id="formFiltros">
                    <div class="row g-3 align-items-end " class="text-white">
                        <div class="col-md-3">
                            <label class="form-label text-white">Fecha</label>
                            <input type="date" class="form-control" name="fecha" value="<?php echo $fecha; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-white">Buscar por Placa</label>
                            <input type="text" class="form-control" name="busqueda" value="<?php echo htmlspecialchars($busqueda); ?>" 
                                   placeholder="Ingrese placa para filtrar...">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla de Monitoreo -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-dark">
                        <thead class="table-dark">
                            <tr>
                                <th>UNIDAD</th>
                                <th>PROGRAMADO</th>
                                <th>SALIDA BASE</th>
                                <th>ALMACEN RECOJO</th>
                                <th>EN RUTA</th>
                                <th>SERVICIOS</th>
                                <th>FIN DE RUTA</th>
                                <th>FIN EN BASE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($resultado_unidades->num_rows > 0) {
                                while ($unidad = $resultado_unidades->fetch_assoc()) {
                                    echo "<tr>";
                                    
                                    // Obtener Id_SERG para esta unidad y fecha
                                    $sql_segimiento = "SELECT Id_SERG FROM rd_segimientos_head 
                                                     WHERE PLACA = '" . $unidad['vh_placa'] . "' 
                                                     AND S_FECHA = '$fecha' 
                                                     LIMIT 1";
                                    $result_segimiento = $conexion->query($sql_segimiento);
                                    $id_serg = $result_segimiento->num_rows > 0 ? $result_segimiento->fetch_assoc()['Id_SERG'] : null;
                                    
                                    // COLUMNA 1: UNIDAD - Modal detalles unidad
                                    echo "<td>";
                                    echo "<a href='#' class='text-decoration-none' data-bs-toggle='modal' data-bs-target='#modalUnidad" . $unidad['id_vh'] . "'>";
                                    echo "<div class='d-flex align-items-center'>";
                                    echo "<img src='" . htmlspecialchars($unidad['vh_avatar'] ?? 'img/und/vhavatar.png') . "' class='' width='40' height='40'>";
                                    echo "<div>";
                                    echo "<strong class='text-white'>" . htmlspecialchars($unidad['vh_placa']) . "</strong><br>";
                                    echo "<small class='text-white'>" . htmlspecialchars($unidad['vh_nick']) . "</small>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</a>";
                                    echo "</td>";
                                    
                                    // COLUMNA 2: PROGRAMADO - Modal detalles programación
                                    echo "<td>";
                                    if ($id_serg) {
                                        echo "<a href='#' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modalProgramado" . $id_serg . "'>SI</a>";
                                    } else {
                                        echo "<span class='badge bg-secondary'>NO</span>";
                                    }
                                    echo "</td>";
                                    
                                    // COLUMNA 3: SALIDA BASE - Link a página
                                    echo "<td>";
                                    if ($id_serg) {
                                        $sql_salida_base = "SELECT h_inicia FROM rd_inicio_fin WHERE Id_SERG = $id_serg";
                                        $result_salida_base = $conexion->query($sql_salida_base);
                                        if ($result_salida_base->num_rows > 0 && $result_salida_base->fetch_assoc()['h_inicia']) {
                                            echo "<a href='3m_salidabase.php?id_serg=" . $id_serg . "' class='btn btn-primary btn-sm'>SI</a>";
                                        } else {
                                            echo "<span class='badge bg-secondary'>NO</span>";
                                        }
                                    } else {
                                        echo "<span class='badge bg-secondary'>NO</span>";
                                    }
                                    echo "</td>";
                                    
                                    // COLUMNA 4: ALMACEN RECOJO - Link a página
                                    echo "<td>";
                                    if ($id_serg) {
                                        $sql_almacen = "SELECT h_llegadaorigen FROM hruta WHERE id_prog = $id_serg LIMIT 1";
                                        $result_almacen = $conexion->query($sql_almacen);
                                        if ($result_almacen->num_rows > 0 && $result_almacen->fetch_assoc()['h_llegadaorigen']) {
                                            echo "<a href='4m_recojo.php?id_serg=" . $id_serg . "' class='btn btn-primary btn-sm'>SI</a>";
                                        } else {
                                            echo "<span class='badge bg-secondary'>NO</span>";
                                        }
                                    } else {
                                        echo "<span class='badge bg-secondary'>NO</span>";
                                    }
                                    echo "</td>";
                                    
                                    // COLUMNA 5: EN RUTA - Link a página
                                    echo "<td>";
                                    if ($id_serg) {
                                        $sql_en_ruta = "SELECT h_salidaorigen FROM hruta WHERE id_prog = $id_serg LIMIT 1";
                                        $result_en_ruta = $conexion->query($sql_en_ruta);
                                        if ($result_en_ruta->num_rows > 0 && $result_en_ruta->fetch_assoc()['h_salidaorigen']) {
                                            echo "<a href='5m_ruta.php?id_serg=" . $id_serg . "' class='btn btn-primary btn-sm'>SI</a>";
                                        } else {
                                            echo "<span class='badge bg-secondary'>NO</span>";
                                        }
                                    } else {
                                        echo "<span class='badge bg-secondary'>NO</span>";
                                    }
                                    echo "</td>";
                                    
                                    // COLUMNA 6: SERVICIOS - Link a página
                                    echo "<td>";
                                    if ($id_serg) {
                                        $sql_servicios = "SELECT COUNT(*) as total FROM rd_servicio WHERE Id_SERG = $id_serg";
                                        $result_servicios = $conexion->query($sql_servicios);
                                        $total_servicios = $result_servicios->fetch_assoc()['total'];
                                        if ($total_servicios > 0) {
                                            echo "<a href='6m_servicios.php?id_serg=" . $id_serg . "' class='btn btn-primary btn-sm'>$total_servicios</a>";
                                        } else {
                                            echo "<span class='badge bg-secondary'>NO</span>";
                                        }
                                    } else {
                                        echo "<span class='badge bg-secondary'>NO</span>";
                                    }
                                    echo "</td>";
                                    
                                    // COLUMNA 7: FIN DE RUTA - Modal detalles fin ruta
                                    echo "<td>";
                                    if ($id_serg) {
                                        $sql_fin_ruta = "SELECT H_FINAL_SERV FROM rd_inicio_fin WHERE Id_SERG = $id_serg";
                                        $result_fin_ruta = $conexion->query($sql_fin_ruta);
                                        if ($result_fin_ruta->num_rows > 0 && $result_fin_ruta->fetch_assoc()['H_FINAL_SERV']) {
                                            echo "<a href='#' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modalFinRuta" . $id_serg . "'>SI</a>";
                                        } else {
                                            echo "<span class='badge bg-secondary'>NO</span>";
                                        }
                                    } else {
                                        echo "<span class='badge bg-secondary'>NO</span>";
                                    }
                                    echo "</td>";
                                    
                                    // COLUMNA 8: FIN EN BASE - Modal detalles fin base
                                    echo "<td>";
                                    if ($id_serg) {
                                        $sql_fin_base = "SELECT HORA_LLEGADA_BASE FROM rd_inicio_fin WHERE Id_SERG = $id_serg";
                                        $result_fin_base = $conexion->query($sql_fin_base);
                                        if ($result_fin_base->num_rows > 0 && $result_fin_base->fetch_assoc()['HORA_LLEGADA_BASE']) {
                                            echo "<a href='#' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modalFinBase" . $id_serg . "'>SI</a>";
                                        } else {
                                            echo "<span class='badge bg-secondary'>NO</span>";
                                        }
                                    } else {
                                        echo "<span class='badge bg-secondary'>NO</span>";
                                    }
                                    echo "</td>";
                                    
                                    echo "</tr>";
                                    
                                    // Generar modales para esta fila
                                    generarModalUnidad($unidad);
                                    if ($id_serg) {
                                        generarModalProgramado($id_serg, $conexion);
                                        generarModalFinRuta($id_serg, $conexion);
                                        generarModalFinBase($id_serg, $conexion);
                                    }
                                }
                            } else {
                                echo "<tr><td colspan='8' class='text-center'>No se encontraron unidades</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
.card {
            background: black;

        }
        

        .table th {
            background: blue;
            color: white;
            text-align: center;
            font-weight: 600;
        }
        
        .table td {
            text-align: center;
            vertical-align: middle;
        }
        
        .badge {
            font-size: 0.8rem;
            padding: 6px 12px;
        }
    </style>

    <script>
        // Auto-actualizar al cambiar fecha
        document.querySelector('[name="fecha"]').addEventListener('change', function() {
            document.getElementById('formFiltros').submit();
        });

        // Auto-refrescar cada 30 segundos
        setInterval(function() {
            document.getElementById('formFiltros').submit();
        }, 30000);
    </script>

    <?php
    // Función para generar modal de unidad
    function generarModalUnidad($unidad) {
        echo "
        <!-- Modal Unidad {$unidad['id_vh']} -->
        <div class='modal fade' id='modalUnidad{$unidad['id_vh']}' tabindex='-1'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header bg-primary text-white'>
                        <h5 class='modal-title'>
                            <i class='fas fa-truck'></i> Detalles de Unidad
                        </h5>
                        <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal'></button>
                    </div>
                    <div class='modal-body'>
                        <div class='text-center mb-3'>
                            <img src='../" . htmlspecialchars($unidad['vh_avatar'] ?? 'img/und/vhavatar.png') . "' class='rounded-circle' width='80' height='80'>
                        </div>
                        <div class='row'>
                            <div class='col-6'><strong>Placa:</strong></div>
                            <div class='col-6'>" . htmlspecialchars($unidad['vh_placa']) . "</div>
                            
                            <div class='col-6'><strong>Nick:</strong></div>
                            <div class='col-6'>" . htmlspecialchars($unidad['vh_nick']) . "</div>
                            
                            <div class='col-6'><strong>Marca/Modelo:</strong></div>
                            <div class='col-6'>" . htmlspecialchars($unidad['vh_marca'] ?? '') . " / " . htmlspecialchars($unidad['vh_modelo'] ?? '') . "</div>
                            
                            <div class='col-6'><strong>Capacidad:</strong></div>
                            <div class='col-6'>" . htmlspecialchars($unidad['vh_capacidad'] ?? '') . "</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
    }
    
    // Función para generar modal de programado
    function generarModalProgramado($id_serg, $conexion) {
        $sql = "SELECT * FROM rd_segimientos_head WHERE Id_SERG = $id_serg";
        $result = $conexion->query($sql);
        $programacion = $result->fetch_assoc();
        
        echo "
        <!-- Modal Programado $id_serg -->
        <div class='modal fade' id='modalProgramado$id_serg' tabindex='-1'>
            <div class='modal-dialog modal-lg'>
                <div class='modal-content'>
                    <div class='modal-header bg-info text-white'>
                        <h5 class='modal-title'>
                            <i class='fas fa-calendar-check'></i> Detalles de Programación
                        </h5>
                        <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal'></button>
                    </div>
                    <div class='modal-body'>
                        <div class='row'>
                            <div class='col-md-6'><strong>Fecha:</strong> " . date('d/m/Y', strtotime($programacion['S_FECHA'])) . "</div>
                            <div class='col-md-6'><strong>Hora Cita:</strong> " . substr($programacion['H_CITA'], 0, 5) . "</div>
                            <div class='col-md-6'><strong>Conductor:</strong> " . htmlspecialchars($programacion['CONDUCTOR'] ?? '') . "</div>
                            <div class='col-md-6'><strong>Empresa:</strong> " . htmlspecialchars($programacion['EMPRESA'] ?? '') . "</div>
                            <div class='col-md-6'><strong>Tipo Despacho:</strong> " . htmlspecialchars($programacion['TIPO_DESPACHO'] ?? '') . "</div>
                            <div class='col-md-6'><strong>Temperatura:</strong> " . htmlspecialchars($programacion['TEMPERATURA'] ?? '') . "</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
    }
    
    // Función para generar modal de fin de ruta
    function generarModalFinRuta($id_serg, $conexion) {
        $sql = "SELECT * FROM rd_inicio_fin WHERE Id_SERG = $id_serg";
        $result = $conexion->query($sql);
        $fin_ruta = $result->fetch_assoc();
        
        echo "
        <!-- Modal Fin Ruta $id_serg -->
        <div class='modal fade' id='modalFinRuta$id_serg' tabindex='-1'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header bg-success text-white'>
                        <h5 class='modal-title'>
                            <i class='fas fa-flag-checkered'></i> Fin de Ruta
                        </h5>
                        <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal'></button>
                    </div>
                    <div class='modal-body'>
                        <div class='row'>
                            <div class='col-12'><strong>Hora Final Servicio:</strong> " . ($fin_ruta['H_FINAL_SERV'] ? date('H:i', strtotime($fin_ruta['H_FINAL_SERV'])) : 'No registrado') . "</div>
                            <div class='col-12'><strong>Kilometraje Recorrido:</strong> " . htmlspecialchars($fin_ruta['km_recorrido'] ?? '') . "</div>
                            <div class='col-12'><strong>Tiempo Recorrido:</strong> " . htmlspecialchars($fin_ruta['hr_recorrido'] ?? '') . "</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
    }
    
    // Función para generar modal de fin en base
    function generarModalFinBase($id_serg, $conexion) {
        $sql = "SELECT * FROM rd_inicio_fin WHERE Id_SERG = $id_serg";
        $result = $conexion->query($sql);
        $fin_base = $result->fetch_assoc();
        
        echo "
        <!-- Modal Fin Base $id_serg -->
        <div class='modal fade' id='modalFinBase$id_serg' tabindex='-1'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header bg-primary text-white'>
                        <h5 class='modal-title'>
                            <i class='fas fa-home'></i> Fin en Base
                        </h5>
                        <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal'></button>
                    </div>
                    <div class='modal-body'>
                        <div class='row'>
                            <div class='col-12'><strong>Hora Llegada Base:</strong> " . ($fin_base['HORA_LLEGADA_BASE'] ? substr($fin_base['HORA_LLEGADA_BASE'], 0, 5) : 'No registrado') . "</div>
                            <div class='col-12'><strong>Kilometraje Llegada:</strong> " . htmlspecialchars($fin_base['KM_LLEGADA_BASE'] ?? '') . "</div>
                            <div class='col-12'><strong>Temperatura Llegada:</strong> " . htmlspecialchars($fin_base['TEMP_LLEGADA_BASE'] ?? '') . "°C</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
    }

    $conexion->close();
    include("includes/footer.php"); 
    ?>
</body>
</html>


