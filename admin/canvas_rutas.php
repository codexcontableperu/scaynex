<?php include("includes/header.php"); ?>
</head>
<body style="background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 50%, #0a0a0a 100%);">
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

    // Consulta para obtener vehículos con su estado actual en la fecha seleccionada
    $sql_vehiculos = "SELECT 
        u.id_vh,
        u.vh_placa,
        u.vh_nick,
        u.vh_avatar,
        u.vh_capacidad,
        u.vh_marca,
        u.vh_modelo,
        u.vh_disponible,
        COALESCE(s.ESTADO_IDP, -1) as estado_actual,
        s.CONDUCTOR,
        s.EMPRESA,
        s.H_CITA,
        s.TIPO_DESPACHO
    FROM unidades u
    LEFT JOIN rd_segimientos_head s ON (
        u.vh_placa = s.PLACA 
        AND s.S_FECHA = '$fecha'
        AND s.Id_SERG = (
            SELECT MAX(Id_SERG) 
            FROM rd_segimientos_head 
            WHERE PLACA = u.vh_placa 
            AND S_FECHA = '$fecha'
        )
    )
    WHERE u.vh_activo = 'si'";

    if (!empty($busqueda)) {
        $busqueda_like = $conexion->real_escape_string($busqueda);
        $sql_vehiculos .= " AND (u.vh_placa LIKE '%$busqueda_like%' OR s.CONDUCTOR LIKE '%$busqueda_like%')";
    }

    $sql_vehiculos .= " ORDER BY u.vh_placa";

    $resultado_vehiculos = $conexion->query($sql_vehiculos);
    
    // Organizar vehículos por estado
    $vehiculos_por_estado = [
        0 => [], // PROGRAMADOS
        1 => [], // SALIDA BASE
        2 => [], // EN ALMACEN
        3 => [], // EN RUTA
        4 => [], // FIN EN BASE
        5 => [], // EN TALLER (vh_disponible = 'no')
        -1 => [] // NO PROGRAMADOS
    ];

    while ($vehiculo = $resultado_vehiculos->fetch_assoc()) {
        // Verificar si está en taller
        if ($vehiculo['vh_disponible'] == 'no') {
            $vehiculos_por_estado[5][] = $vehiculo;
        } else {
            $estado = $vehiculo['estado_actual'];
            $vehiculos_por_estado[$estado][] = $vehiculo;
        }
    }
    ?>

    <!-- Área de Contenido -->
    <div class="content-area">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="text-white">Canvas de Rutas</h2>
                <p class="text-white-50">Estado de unidades en tiempo real</p>
            </div>
            <div class="text-white">
                <i class="fas fa-calendar-day"></i> 
                <?php echo date('d/m/Y', strtotime($fecha)); ?>
            </div>
        </div>

        <!-- Filtros -->
        <div class="card mb-4 bg-dark border-light">
            <div class="card-body">
                <form method="POST" id="formFiltros">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label text-white">Fecha</label>
                            <input type="date" class="form-control bg-dark text-white border-secondary" name="fecha" value="<?php echo $fecha; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-white">Buscar (Placa o Conductor)</label>
                            <input type="text" class="form-control bg-dark text-white border-secondary" name="busqueda" value="<?php echo htmlspecialchars($busqueda); ?>" 
                                   placeholder="Buscar por placa o conductor...">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i> Actualizar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Canvas de Estados -->
        <div class="canvas-rutas">
            <div class="row g-3">
                <!-- Columna 1: PROGRAMADOS -->
                <div class="col-xl">
                    <div class="card border-primary h-100 bg-dark">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0">
                                <i class="fas fa-clock"></i> PROGRAMADOS
                                <span class="badge bg-light text-primary float-end"><?php echo count($vehiculos_por_estado[0]); ?></span>
                            </h6>
                        </div>
                        <div class="card-body p-2">
                            <?php foreach ($vehiculos_por_estado[0] as $vehiculo): ?>
                                <?php echo generarTarjetaVehiculo($vehiculo, 'primary'); ?>
                            <?php endforeach; ?>
                            <?php if (empty($vehiculos_por_estado[0])): ?>
                                <div class="text-center text-muted py-3">
                                    <i class="fas fa-truck fa-2x mb-2"></i><br>
                                    <small>Sin vehículos</small>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Columna 2: EN RUTA -->
                <div class="col-xl">
                    <div class="card border-warning h-100 bg-dark">
                        <div class="card-header bg-warning text-dark">
                            <h6 class="mb-0">
                                <i class="fas fa-road"></i> EN RUTA
                                <span class="badge bg-light text-warning float-end"><?php echo count($vehiculos_por_estado[3]); ?></span>
                            </h6>
                        </div>
                        <div class="card-body p-2">
                            <?php foreach ($vehiculos_por_estado[3] as $vehiculo): ?>
                                <?php echo generarTarjetaVehiculo($vehiculo, 'warning', true); ?>
                            <?php endforeach; ?>
                            <?php if (empty($vehiculos_por_estado[3])): ?>
                                <div class="text-center text-muted py-3">
                                    <i class="fas fa-highway fa-2x mb-2"></i><br>
                                    <small>Sin vehículos</small>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Columna 3: FIN EN BASE -->
                <div class="col-xl">
                    <div class="card border-success h-100 bg-dark">
                        <div class="card-header bg-success text-white">
                            <h6 class="mb-0">
                                <i class="fas fa-flag-checkered"></i> FIN EN BASE
                                <span class="badge bg-light text-success float-end"><?php echo count($vehiculos_por_estado[4]); ?></span>
                            </h6>
                        </div>
                        <div class="card-body p-2">
                            <?php foreach ($vehiculos_por_estado[4] as $vehiculo): ?>
                                <?php echo generarTarjetaVehiculo($vehiculo, 'success'); ?>
                            <?php endforeach; ?>
                            <?php if (empty($vehiculos_por_estado[4])): ?>
                                <div class="text-center text-muted py-3">
                                    <i class="fas fa-home fa-2x mb-2"></i><br>
                                    <small>Sin vehículos</small>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Columna 4: EN TALLER -->
                <div class="col-xl">
                    <div class="card border-danger h-100 bg-dark">
                        <div class="card-header bg-danger text-white">
                            <h6 class="mb-0">
                                <i class="fas fa-tools"></i> EN TALLER
                                <span class="badge bg-light text-danger float-end"><?php echo count($vehiculos_por_estado[5]); ?></span>
                            </h6>
                        </div>
                        <div class="card-body p-2">
                            <?php foreach ($vehiculos_por_estado[5] as $vehiculo): ?>
                                <?php echo generarTarjetaVehiculo($vehiculo, 'danger'); ?>
                            <?php endforeach; ?>
                            <?php if (empty($vehiculos_por_estado[5])): ?>
                                <div class="text-center text-muted py-3">
                                    <i class="fas fa-wrench fa-2x mb-2"></i><br>
                                    <small>Sin vehículos</small>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Columna 5: NO PROGRAMADOS -->
                <div class="col-xl">
                    <div class="card border-secondary h-100 bg-dark">
                        <div class="card-header bg-secondary text-white">
                            <h6 class="mb-0">
                                <i class="fas fa-ban"></i> NO PROGRAMADOS
                                <span class="badge bg-light text-secondary float-end"><?php echo count($vehiculos_por_estado[-1]); ?></span>
                            </h6>
                        </div>
                        <div class="card-body p-2">
                            <?php foreach ($vehiculos_por_estado[-1] as $vehiculo): ?>
                                <?php echo generarTarjetaVehiculo($vehiculo, 'secondary'); ?>
                            <?php endforeach; ?>
                            <?php if (empty($vehiculos_por_estado[-1])): ?>
                                <div class="text-center text-muted py-3">
                                    <i class="fas fa-parking fa-2x mb-2"></i><br>
                                    <small>Todos programados</small>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .canvas-rutas .card {
            min-height: 10px;
        }
        
        .tarjeta-vehiculo {
            border-left: 3px solid;
            transition: all 0.3s ease;
            margin-bottom: 6px;
            height: 80px;
            overflow: hidden;
        }
        
        .tarjeta-vehiculo:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255,255,255,0.1);
        }
        
        .tarjeta-vehiculo.primary { border-left-color: #0d6efd; background: rgba(13, 110, 253, 0.1); }
        .tarjeta-vehiculo.warning { border-left-color: #ffc107; background: rgba(255, 193, 7, 0.1); }
        .tarjeta-vehiculo.success { border-left-color: #198754; background: rgba(25, 135, 84, 0.1); }
        .tarjeta-vehiculo.danger { border-left-color: #dc3545; background: rgba(220, 53, 69, 0.1); }
        .tarjeta-vehiculo.secondary { border-left-color: #6c757d; background: rgba(108, 117, 125, 0.1); }
        
        .avatar-vehiculo {
            width: 35px;
            height: 35px;
            border-radius: 6px;
            object-fit: cover;
            border: 2px solid;
        }
        
        .avatar-vehiculo.primary { border-color: #0d6efd; }
        .avatar-vehiculo.warning { border-color: #ffc107; }
        .avatar-vehiculo.success { border-color: #198754; }
        .avatar-vehiculo.danger { border-color: #dc3545; }
        .avatar-vehiculo.secondary { border-color: #6c757d; }
        
        .marquee-ruta {
            background: linear-gradient(90deg, #ffc107, #ffdb6d);
            border-radius: 12px;
            padding: 1px 6px;
            font-size: 0.6rem;
            white-space: nowrap;
            overflow: hidden;
            display: inline-block;
            color: #000;
            font-weight: bold;
        }
        
        .marquee-ruta span {
            display: inline-block;
            animation: marquee 2s linear infinite;
        }
        
        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
        
        .animacion-ruta {
            animation: moverCamion 1.5s infinite alternate;
        }
        
        @keyframes moverCamion {
            0% { transform: translateX(0); }
            100% { transform: translateX(5px); }
        }
        
        body {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 50%, #0a0a0a 100%) !important;
        }
    </style>

    <script>
        // Auto-actualizar al cambiar fecha
        document.querySelector('[name="fecha"]').addEventListener('change', function() {
            document.getElementById('formFiltros').submit();
        });

        // Auto-refrescar cada 30 segundos
        setInterval(function() {
            if (document.querySelector('[name="busqueda"]').value === '') {
                document.getElementById('formFiltros').submit();
            }
        }, 30000);
    </script>

    <?php
    // Función para generar tarjetas de vehículos
    function generarTarjetaVehiculo($vehiculo, $color, $enRuta = false) {
        $html = '<div class="tarjeta-vehiculo ' . $color . ' card p-2 bg-dark text-white">';
        
        // Header compacto
        $html .= '<div class="d-flex align-items-center h-100">';
        
        // Avatar
        $html .= '<img src="../' . htmlspecialchars($vehiculo['vh_avatar'] ?? 'img/und/vhavatar.png') . '" class="avatar-vehiculo ' . $color . ' me-2">';
        
        // Información básica
        $html .= '<div class="flex-grow-1">';
        $html .= '<div class="d-flex align-items-center">';
        
        // Animación para vehículos en ruta
        if ($enRuta) {
            $html .= '<div class="animacion-ruta me-1">';
            $html .= '<i class="fas fa-truck-moving text-' . $color . '"></i>';
            $html .= '</div>';
        } else {
            $html .= '<i class="fas fa-truck me-1 text-' . $color . '"></i>';
        }
        
        $html .= '<strong class="small">' . htmlspecialchars($vehiculo['vh_placa']) . '</strong>';
        $html .= '</div>';
        
        // Marca del vehículo
        if (!empty($vehiculo['vh_marca'])) {
            $html .= '<div class="mt-1">';
            $html .= '<small class="text-muted">' . htmlspecialchars($vehiculo['vh_marca']) . '</small>';
            $html .= '</div>';
        }
        $html .= '</div>';
        
        // Badge de estado en ruta
        if ($enRuta) {
            $html .= '<div class="marquee-ruta">';
            $html .= '<span>EN RUTA</span>';
            $html .= '</div>';
        }
        
        $html .= '</div>';
        $html .= '</div>';
        
        return $html;
    }

    $conexion->close();
    include("includes/footer.php"); 
    ?>
</body>
</html>