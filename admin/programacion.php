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
    if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_GET['fecha_inicio'])) {
    $fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : (isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : $fecha_inicio);
    $fecha_fin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : (isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : $fecha_fin);
    $busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : (isset($_GET['busqueda']) ? $_GET['busqueda'] : '');
    } else {
    $busqueda = '';
    }

    // Procesar navegación por días
    if (isset($_GET['navegar'])) {
    $direccion = $_GET['navegar'];
    if ($direccion == 'anterior') {
    $fecha_inicio = date('Y-m-d', strtotime($fecha_inicio . ' -1 day'));
    $fecha_fin = $fecha_inicio;
    } elseif ($direccion == 'siguiente') {
    $fecha_inicio = date('Y-m-d', strtotime($fecha_inicio . ' +1 day'));
    $fecha_fin = $fecha_inicio;
    } elseif ($direccion == 'hoy') {
    $fecha_inicio = date('Y-m-d');
    $fecha_fin = $fecha_inicio;
    }
    }

    // Validar fechas
    if ($fecha_inicio > $fecha_fin) {
    $temp = $fecha_inicio;
    $fecha_inicio = $fecha_fin;
    $fecha_fin = $temp;
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
    h.Id_SERG,
    h.S_FECHA,
    h.H_CITA_R AS HORA_BASE,
    h.PLACA,
    u_cond.user_nombre AS CONDUCTOR,
    u_aux1.user_nombre AS AYUDANTE_1,
    u_aux2.user_nombre AS AYUDANTE_2,
    u_aux3.user_nombre AS AYUDANTE_3,
    h.CUENTA,
    h.ID_CLIENTE,
    h.CUENTA_CLIENTE,
    h.H_CITA_BASE AS CITA,
    h.TIPO_DESPACHO AS TIPO,
    h.CAPACIDAD_VEHICULO AS UND,
    h.TEMPERATURA,
    h.NUM_PALETAS AS PALLET,
    h.BULTOS_ROLLER AS BULTOS,
    h.DEVOLUCIONES,
    h.OBSERVACIONES_PROG  AS OBSERVACIONES,
    h.ESTADO_IDP
    FROM
    rd_segimientos_head AS h
    LEFT JOIN usuarios AS u_cond ON h.ID_CONDUC = u_cond.id_user
    LEFT JOIN usuarios AS u_aux1 ON h.ID_AUX1 = u_aux1.id_user
    LEFT JOIN usuarios AS u_aux2 ON h.ID_AUX2 = u_aux2.id_user
    LEFT JOIN usuarios AS u_aux3 ON h.ID_AUX3 = u_aux3.id_user
    {$where_sql}
    ORDER BY
    h.S_FECHA DESC, h.H_CITA_R ASC";
    
    // *** EJECUTAR LA CONSULTA ***
    $resultado = $conexion->query($sql);
    if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
    }

    // Función auxiliar para renderizar nombres de personal
    function renderNombrePersonal($valor) {
      $v = trim((string)($valor ?? ''));
      if ($v === '') {
        return "<span class='text-muted'>-</span>";
      }
      if (strcasecmp($v, 'NO REGISTRA') === 0) {
        return "<span class='text-noregistra'>NO REGISTRA</span>";
      }
      return htmlspecialchars($v);
    }
    ?>

    <!-- Área de Contenido -->
    <div class="content-area">
    <!-- Mensajes de éxito/error del SQL -->
    <?php if (isset($_GET['sql_success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle"></i> <strong>SQL ejecutado correctamente.</strong> Los registros se han actualizado.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <?php if (isset($_GET['sql_error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle"></i> <strong>Error al ejecutar SQL:</strong> 
    <?php echo htmlspecialchars($_GET['sql_error']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
    <h2 class="text-dark">Programación de Unidades</h2>
    <p>Control y seguimiento de servicios programados</p>
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
    <div class="card">
    <div class="card-body">
    <form method="POST" id="formFiltros">
    <div class="row g-3 align-items-end">
    <!-- Botones de Navegación -->
    <div class="col-md-2">
    <div class="btn-group w-100" role="group">
    <a href="?navegar=anterior&fecha_inicio=<?php echo $fecha_inicio; ?>&fecha_fin=<?php echo $fecha_fin; ?>&busqueda=<?php echo urlencode($busqueda); ?>" 
    class="btn btn-outline-primary" title="Día anterior">
    ◀️
    </a>
    <a href="?navegar=hoy" 
    class="btn btn-outline-success" title="Hoy">
    Hoy
    </a>
    <a href="?navegar=siguiente&fecha_inicio=<?php echo $fecha_inicio; ?>&fecha_fin=<?php echo $fecha_fin; ?>&busqueda=<?php echo urlencode($busqueda); ?>" 
    class="btn btn-outline-primary" title="Día siguiente">
    ▶️
    </a>
    </div>
    </div>
    
    <div class="col-md-2">
    <label class="form-label text-white">Fecha Inicio</label>
    <input type="date" class="form-control" name="fecha_inicio" value="<?php echo $fecha_inicio; ?>" required>
    </div>
    <div class="col-md-2">
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
    <?php if (isset($resultado)): ?>
    <span class="badge bg-primary ms-2"><?php echo $resultado->num_rows; ?> registros</span>
    <?php endif; ?>
    </div>
    <?php endif; ?>

    <style>
    /* Barras de desplazamiento más visibles */
    .table-responsive {
    overflow-x: auto;
    scrollbar-color: #6c757d #e9ecef; /* thumb y track para Firefox */
    scrollbar-width: auto;
    position: relative;
    }
    .table-responsive::-webkit-scrollbar {
    height: 14px; /* barra inferior más alta */
    }
    .table-responsive::-webkit-scrollbar-track {
    background: #e9ecef;
    border-radius: 7px;
    }
    .table-responsive::-webkit-scrollbar-thumb {
    background: #6c757d;
    border-radius: 7px;
    }
    .table-responsive::-webkit-scrollbar-thumb:hover {
    background: #495057;
    }

    /* Barra de desplazamiento superior sincronizada */
    .scrollbar-top-wrapper {
    overflow-x: auto;
    overflow-y: hidden;
    height: 14px;
    background: #e9ecef;
    border-radius: 7px;
    margin-bottom: 8px;
    }
    .scrollbar-top-wrapper::-webkit-scrollbar {
    height: 14px;
    }
    .scrollbar-top-wrapper::-webkit-scrollbar-track {
    background: #e9ecef;
    border-radius: 7px;
    }
    .scrollbar-top-wrapper::-webkit-scrollbar-thumb {
    background: #6c757d;
    border-radius: 7px;
    }
    .scrollbar-top-wrapper::-webkit-scrollbar-thumb:hover {
    background: #495057;
    }
    .scrollbar-top-content {
    height: 1px;
    }

    /* Estilos para PLACA y celdas "NO REGISTRA" */
    .badge-placa {
    display: inline-block;
    background-color: #198754; /* Bootstrap success */
    color: #fff;
    padding: 0.25rem 0.5rem;
    border-radius: 0.35rem;
    white-space: nowrap; /* sin saltos de línea */
    font-weight: 600;
    letter-spacing: 0.3px;
    }
    .text-noregistra {
    color: #dc3545 !important; /* rojo */
    font-weight: 600;
    }
    </style>

    <!-- Scrollbar superior sincronizado -->
    <div class="scrollbar-top-wrapper" id="scrollbarTop">
    <div class="scrollbar-top-content" id="scrollbarTopContent"></div>
    </div>

    <div class="table-responsive" id="tableContainer">
    <table class="table table-sm table-hover table-striped " id="tablaProgramacion">
    <thead class="table-dark">
    <tr>
    <th>ACCIONES</th>
    <th>FECHA</th>
    <th>HORA BASE</th>
    <th>PLACA</th>
    <th>CONDUCTOR</th>
    <th>AYUDANTE 1</th>
    <th>AYUDANTE 2</th>
    <th>AYUDANTE 3</th>
    <th>CLIENTE</th>
    <th>CUENTA_CLIENTE</th>
    <th>CITA</th>
    <th>TIPO</th>
    <th>CAPACIDAD</th>
    <th>TEMP</th>
    <th>PALLET</th>
    <th>BULTOS</th>
    <th>DEVOL.</th>
    <th>OBSERVACIONES</th>
    <th>ESTADO</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
    $pallet = $fila['PALLET'] ?? '0';
    $bultos = $fila['BULTOS'] ?? '0';
    
    echo "<tr>";

    // Columna de Acciones
    echo "<td>
    <div class='btn-group btn-group-sm'>
    <a href='actualiza_programacion.php?idp=" . $fila['Id_SERG'] . "' class='btn btn-primary btn-sm' title='Ver/Editar'>
    <i class='fas fa-eye'></i>
    </a>
    <button type='button' class='btn btn-danger btn-sm' onclick='confirmarEliminacion(" . $fila['Id_SERG'] . ")' title='Eliminar'>
    <i class='fas fa-trash'></i>
    </button>
    </div>
    </td>";

    echo "<td>" . date('d/m/Y', strtotime($fila['S_FECHA'])) . "</td>";
    
    // Corregir substr() para evitar warning con null
    $horaBase = isset($fila['HORA_BASE']) && $fila['HORA_BASE'] !== null ? substr((string)$fila['HORA_BASE'], 0, 5) : '';
    echo "<td>" . htmlspecialchars($horaBase) . "</td>";
    
    // PLACA con badge verde sin saltos de línea
    echo "<td><span class='badge-placa'>" . htmlspecialchars($fila['PLACA'] ?? '') . "</span></td>";
    
    // CONDUCTOR, AYUDANTE 1, 2, 3 con color rojo si es "NO REGISTRA"
    echo "<td>" . renderNombrePersonal($fila['CONDUCTOR'] ?? '') . "</td>";
    echo "<td>" . renderNombrePersonal($fila['AYUDANTE_1'] ?? '') . "</td>";
    echo "<td>" . renderNombrePersonal($fila['AYUDANTE_2'] ?? '') . "</td>";
    echo "<td>" . renderNombrePersonal($fila['AYUDANTE_3'] ?? '') . "</td>";
    
    echo "<td>" . htmlspecialchars($fila['ID_CLIENTE'] ?? '') . "</td>";
    echo "<td>" . htmlspecialchars($fila['CUENTA_CLIENTE'] ?? '') . "</td>";
    
    // Corregir substr() para evitar warning con null
    $horaCita = isset($fila['CITA']) && $fila['CITA'] !== null ? substr((string)$fila['CITA'], 0, 5) : '';
    echo "<td>" . htmlspecialchars($horaCita) . "</td>";
    
    echo "<td><span class='badge bg-info'>" . htmlspecialchars($fila['TIPO'] ?? '') . "</span></td>"; 
    echo "<td>" . htmlspecialchars($fila['UND'] ?? '') . "</td>";
    echo "<td>" . htmlspecialchars($fila['TEMPERATURA'] ?? '') . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($pallet) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($bultos) . "</td>";
    echo "<td>" . htmlspecialchars($fila['DEVOLUCIONES'] ?? '') . "</td>";
    echo "<td>" . htmlspecialchars($fila['OBSERVACIONES'] ?? '') . "</td>";
    echo "<td><span class='badge bg-" . obtenerColorEstado($fila['ESTADO_IDP']) . "'>" . obtenerTextoEstado($fila['ESTADO_IDP']) . "</span></td>";

    echo "</tr>";
    }
    } else {
    echo "<tr><td colspan='19' class='text-center'>No hay registros de programación para el rango de fechas seleccionado</td></tr>";
    }
    ?>
    </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>

    <!-- Script para eliminación -->
    <script>
    function confirmarEliminacion(idRegistro) {
    if (confirm('¿Estás seguro de que deseas eliminar este registro de programación?')) {
    window.location.href = 'eliminar_programacion.php?id=' + idRegistro;
    }
    }

    // Sincronizar scrollbars superior e inferior
    window.addEventListener('DOMContentLoaded', function() {
    const scrollbarTop = document.getElementById('scrollbarTop');
    const scrollbarTopContent = document.getElementById('scrollbarTopContent');
    const tableContainer = document.getElementById('tableContainer');
    const table = document.getElementById('tablaProgramacion');

    // Ajustar el ancho del contenido del scrollbar superior al ancho de la tabla
    function updateScrollbarWidth() {
    if (table && scrollbarTopContent) {
    scrollbarTopContent.style.width = table.scrollWidth + 'px';
    }
    }

    // Sincronizar scroll del contenedor de la tabla con el scrollbar superior
    if (tableContainer && scrollbarTop) {
    tableContainer.addEventListener('scroll', function() {
    scrollbarTop.scrollLeft = tableContainer.scrollLeft;
    });

    scrollbarTop.addEventListener('scroll', function() {
    tableContainer.scrollLeft = scrollbarTop.scrollLeft;
    });
    }

    // Actualizar ancho al cargar y al redimensionar
    updateScrollbarWidth();
    window.addEventListener('resize', updateScrollbarWidth);
    });
    </script>

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
    <form method="POST" action="crud_programacion/ejecutar_sql.php">
    <!-- Campos hidden para mantener los filtros -->
    <input type="hidden" name="fecha_inicio" value="<?php echo $fecha_inicio; ?>">
    <input type="hidden" name="fecha_fin" value="<?php echo $fecha_fin; ?>">
    <input type="hidden" name="busqueda" value="<?php echo htmlspecialchars($busqueda); ?>">
    
    <div class="modal-body">
    <div class="mb-3">
    <div class="card p-3 shadow-sm">
    <h5 class="mb-0">
    <i class="fas fa-robot"></i> Asistente IA para Generar SQL
    </h5>
    <div class="d-flex justify-content-center align-items-center gap-3 p-3">
    <div class="d-flex bg-white rounded-pill p-2"> 
    <a href="https://chatgpt.com/" target="_blank" class="btn btn-sm btn-light text-secondary d-flex align-items-center rounded-pill">
    <span style="font-size: 1.2em; margin-right: 5px;">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4d/OpenAI_Logo.svg/512px-OpenAI_Logo.svg.png" alt="OpenAI" style="height: 1em;">
    </span>
    <span class="fw-bold">GPT-4o</span>
    </a>
    <a href="https://claude.ai/" target="_blank" class="btn btn-sm btn-light text-secondary d-flex align-items-center rounded-pill">
    <span style="font-size: 1.2em; margin-right: 5px;">
    <span style="color: #e09e73;">✱</span> 
    </span>
    <span class="fw-bold">Claude 3.5</span>
    </a>
    <a href="https://gemini.google.com/" target="_blank" class="btn btn-sm btn-light text-secondary d-flex align-items-center rounded-pill">
    <span style="font-size: 1.2em; margin-right: 5px; color: #726af9;">
    ✦
    </span>
    <span class="fw-bold">Gemini</span>
    </a>
    <a href="https://chat.deepseek.com/" target="_blank" class="btn btn-sm btn-light text-secondary d-flex align-items-center rounded-pill">
    <span style="font-size: 1.2em; margin-right: 5px; color: #2196f3;">
    ◈
    </span>
    <span class="fw-bold">DeepSeek Chat</span>
    </a>
    </div>
    </div>
    </div>
    <label class="form-label">Sentencia SQL</label>
    <textarea class="form-control" name="sql_personalizado" rows="8" 
    placeholder="INSERT INTO rd_segimientos_head (S_FECHA, PLACA, CONDUCTOR, ...) VALUES (...);" 
    style="font-family: 'Courier New', monospace;" required></textarea>
    <small class="text-muted">Ejecuta sentencias SQL INSERT, UPDATE o DELETE para gestionar registros</small>
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

    // Auto-cerrar alertas después de 5 segundos
    window.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
    setTimeout(function() {
    const bsAlert = new bootstrap.Alert(alert);
    bsAlert.close();
    }, 5000);
    });
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