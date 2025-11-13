<?php
session_start();

// Validar sesión
if (!isset($_SESSION['usuario'])) {
    echo "<script>alert('Sesión no iniciada o expirada.'); window.location.href='../index.php';</script>";
    exit;
}

$userup   = $_SESSION['usuario'];
$id_userup = $_SESSION['id_usuario'];
$dni_user  = $_SESSION['user_dni'];

include("../data/conexion.php");

// Procesar cierre de programación
if (isset($_POST['cerrar_programacion'])) {
    $idp_cerrar = intval($_POST['idp_cerrar']);
    
    $query_cerrar = "UPDATE rd_segimientos_head SET PENDIENTE = 2 WHERE Id_SERG = ?";
    $stmt_cerrar = $conexion->prepare($query_cerrar);
    $stmt_cerrar->bind_param("i", $idp_cerrar);
    
    if ($stmt_cerrar->execute()) {
    echo "<script>alert('Programación cerrada exitosamente.'); window.location.href='wt_prog_user.php';</script>";
    } else {
    echo "<script>alert('Error al cerrar la programación.');</script>";
    }
    $stmt_cerrar->close();
    exit;
}

// Procesar cierre de sesión desde el menú
if (isset($_GET['logout'])) {
    // Limpieza de sesión
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
    $params['path'], $params['domain'],
    $params['secure'], $params['httponly']
    );
    }
    session_destroy();
    header("Location: ../index.php");
    exit;
}
?>

<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="whatsaap/stilo_what.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
/* Estilos para programaciones */
.titu {
  align-items: center;
  text-align: center;
  margin: 20px 0;
}

.titu h5 {
  font-weight: 600;
  color: #2c3e50;
}

.icon-close-prog {
    position: absolute;
    top: 8px;
    left: 8px;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    z-index: 10;
    color: white;
    background-color: rgba(220, 53, 69, 0.85);
    padding: 4px 10px;
    border-radius: 6px;
    transition: all 0.3s ease;
    line-height: 1;
}

.icon-close-prog:hover {
    background-color: rgba(220, 53, 69, 1);
    transform: scale(1.05);
}

.square-btn {
    position: relative;
    margin-bottom: 15px !important;
    min-width: 150px;
    padding: 20px 15px !important;
    border-radius: 12px !important;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.square-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}

.btn-pendiente-2 {
    background-color: #ffc107 !important;
    border-color: #ffc107 !important;
    color: #000 !important;
}

.btn-pendiente-2:hover {
    background-color: #ffb300 !important;
    border-color: #ffb300 !important;
}

/* Mejorar el contenedor de botones */
.botones .container {
    max-width: 1200px;
}

/* Modal de cierre mejorado */
.modal-header.bg-warning {
    background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%) !important;
    color: #000;
}

.modal-header.bg-warning .btn-close {
    filter: brightness(0);
}

/* Estilos para el menú desplegable de tres puntos */
#menu-icon {
    cursor: pointer;
    position: relative;
}

.dropdown-menu-custom {
    position: absolute;
    top: 50px;
    right: 10px;
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    min-width: 220px;
    z-index: 1000;
    display: none;
}

.dropdown-menu-custom.show {
    display: block;
}

.dropdown-menu-custom a {
    display: block;
    padding: 12px 20px;
    color: #333;
    text-decoration: none;
    transition: background-color 0.2s;
    border-bottom: 1px solid #f0f0f0;
}

.dropdown-menu-custom a:last-child {
    border-bottom: none;
}

.dropdown-menu-custom a:hover {
    background-color: #f5f5f5;
}

.dropdown-menu-custom a i {
    margin-right: 10px;
    width: 20px;
    display: inline-block;
}

/* Overlay para cerrar el menú al hacer clic fuera */
.menu-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 999;
    display: none;
}

.menu-overlay.show {
    display: block;
}
</style>

<div id="header">
    <div id="whatsapp-text">
    <span class="icon-user"></span> <?php echo htmlspecialchars($userup, ENT_QUOTES, 'UTF-8'); ?> 
    </div>

    <div id="header-icons">
    <img src="whatsaap/camera-icon.png" alt="Cámara" id="camera-icon">
    <img src="whatsaap/search-icon.png" alt="Buscar" id="search-icon">
    <img src="whatsaap/menu-icon.png" alt="Menú" id="menu-icon" onclick="toggleMenu()">
    </div>
</div>

<!-- Menú desplegable -->
<div class="menu-overlay" id="menuOverlay" onclick="toggleMenu()"></div>
<div class="dropdown-menu-custom" id="dropdownMenu">
    <a href="solicita_prog.php">
    <i class="bi bi-clipboard-plus"></i> Solicitar Programación
    </a>
    <a href="?logout=1" onclick="return confirm('¿Está seguro que desea cerrar sesión?')">
    <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
    </a>
</div>


<!-- barra de progreso  -->

<link rel="stylesheet" href="barraprogreso.css">


<div id="second-header">

    <div class="container_progreso">
    <div class="progress-bar">
    
    <div class="progress-line"></div>
    
    <a href="wt_prog_user.php" class="step active">
    <div class="step-circle"><i class="fa-solid fa-truck truck" id="truck"></i></div>
    <div class="step-label">Órdenes</div>
    </a>

    </div>
    </div>
</div>







<?php
// Verificar la conexión
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

$mi_id = intval($id_userup); // ID del usuario logueado

// Consulta SQL filtrando por id_user del operador usando los nombres reales de columnas
$sql = "SELECT 
    Id_SERG,
    CONDUCTOR, ID_CONDUC,
    AUXILIAR1, ID_AUX1,
    AUXILIAR2, ID_AUX2,
    AUXILIAR3, ID_AUX3,
    ID_CLIENTE, S_FECHA, PLACA, PENDIENTE
    FROM rd_segimientos_head
    WHERE PENDIENTE IN (1, 2)
    AND (
    ID_CONDUC = ?
    OR ID_AUX1 = ?
    OR ID_AUX2 = ?
    OR ID_AUX3 = ?
    )";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("iiii", $mi_id, $mi_id, $mi_id, $mi_id);
$stmt->execute();
$result = $stmt->get_result();

$nueva_tabla = array();
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    if ($row["ID_CONDUC"] == $mi_id) {
    $nueva_tabla[] = array(
    "TIPO_OPERADOR" => "CONDUCTOR",
    "NOMBRE" => $row["CONDUCTOR"],
    "ID_USER" => $row["ID_CONDUC"],
    "Id_SERG" => $row["Id_SERG"],
    "PENDIENTE" => $row["PENDIENTE"],
    "ID_CLIENTE" => $row["ID_CLIENTE"],
    "S_FECHA" => $row["S_FECHA"],
    "PLACA" => $row["PLACA"]
    );
    }
    if ($row["ID_AUX1"] == $mi_id) {
    $nueva_tabla[] = array(
    "TIPO_OPERADOR" => "AUXILIAR1",
    "NOMBRE" => $row["AUXILIAR1"],
    "ID_USER" => $row["ID_AUX1"],
    "Id_SERG" => $row["Id_SERG"],
    "PENDIENTE" => $row["PENDIENTE"],
    "ID_CLIENTE" => $row["ID_CLIENTE"],
    "S_FECHA" => $row["S_FECHA"],
    "PLACA" => $row["PLACA"]
    );
    }
    if ($row["ID_AUX2"] == $mi_id) {
    $nueva_tabla[] = array(
    "TIPO_OPERADOR" => "AUXILIAR2",
    "NOMBRE" => $row["AUXILIAR2"],
    "ID_USER" => $row["ID_AUX2"],
    "Id_SERG" => $row["Id_SERG"],
    "PENDIENTE" => $row["PENDIENTE"],
    "ID_CLIENTE" => $row["ID_CLIENTE"],
    "S_FECHA" => $row["S_FECHA"],
    "PLACA" => $row["PLACA"]
    );
    }
    if ($row["ID_AUX3"] == $mi_id) {
    $nueva_tabla[] = array(
    "TIPO_OPERADOR" => "AUXILIAR3",
    "NOMBRE" => $row["AUXILIAR3"],
    "ID_USER" => $row["ID_AUX3"],
    "Id_SERG" => $row["Id_SERG"],
    "PENDIENTE" => $row["PENDIENTE"],
    "ID_CLIENTE" => $row["ID_CLIENTE"],
    "S_FECHA" => $row["S_FECHA"],
    "PLACA" => $row["PLACA"]
    );
    }
    }
}
$stmt->close();
?>

<br>

<div class="titu">
    <h5>📋 Programaciones Activas</h5>
</div>

<div class="botones">
    <div class="container text-center">
    <div class="row d-flex justify-content-center">
    <?php 
    if (count($nueva_tabla) > 0) {
    foreach ($nueva_tabla as $filaso) { 
    $btn_class = ($filaso['PENDIENTE'] == 2) ? 'btn-pendiente-2' : 'btn-dark';
    ?>
    <a class="btn  <?php echo $btn_class; ?> square-btn mx-2" style="color: white; position: relative;" href="wt_panel_user.php?idp=<?php echo intval($filaso['Id_SERG']); ?>">
    <?php if ($filaso['PENDIENTE'] == 1): ?>
    <span class="icon-close-prog" onclick="event.preventDefault(); abrirModalCerrar(<?php echo intval($filaso['Id_SERG']); ?>);">
    ✕
    </span>
    <?php endif; ?>
    
    <span class="icon-truck"></span><br>
    <span style="font-size: 13px;"><?php echo htmlspecialchars($filaso['TIPO_OPERADOR'], ENT_QUOTES, 'UTF-8'); ?></span><br>
    <?php echo htmlspecialchars($filaso['PLACA'], ENT_QUOTES, 'UTF-8'); ?><br>
    <span style="font-size: 13px;"><?php echo htmlspecialchars($filaso['ID_CLIENTE'], ENT_QUOTES, 'UTF-8'); ?></span><br>
    <span style="font-size: 13px;"><?php echo htmlspecialchars($filaso['S_FECHA'], ENT_QUOTES, 'UTF-8'); ?></span>
    </a>
    <?php 
    } 
    } else {
    echo '<div class="col-12"><div class="alert alert-info">No hay programaciones activas para tu usuario.</div></div>';
    }
    ?>
    </div>
    </div>
</div>

<!-- Modal de confirmación para cerrar programación -->
<div class="modal fade" id="modalCerrarProgramacion" tabindex="-1" aria-labelledby="modalCerrarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header bg-warning">
    <h5 class="modal-title" id="modalCerrarLabel">
    ⚠️ Cerrar Programación
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    <div class="alert alert-warning" role="alert">
    <strong>⚠️ Importante:</strong> Solo debe cerrar la programación si <strong>todas las entregas han sido conformes</strong>.
    </div>
    <p>¿Está seguro de que desea cerrar esta programación?</p>
    <p class="text-muted small">Esta acción cambiará el estado de la programación y no se podrá deshacer fácilmente.</p>
    </div>
    <div class="modal-footer">
    <form method="POST" id="formCerrarProgramacion">
    <input type="hidden" name="idp_cerrar" id="idp_cerrar" value="">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="submit" name="cerrar_programacion" class="btn btn-warning">
    <i class="bi bi-folder-check"></i> Sí, Cerrar Programación
    </button>
    </form>
    </div>
    </div>
    </div>
</div>

<script>
function abrirModalCerrar(idp) {
    document.getElementById('idp_cerrar').value = idp;
    var modal = new bootstrap.Modal(document.getElementById('modalCerrarProgramacion'));
    modal.show();
}

function toggleMenu() {
    var menu = document.getElementById('dropdownMenu');
    var overlay = document.getElementById('menuOverlay');
    
    if (menu.classList.contains('show')) {
    menu.classList.remove('show');
    overlay.classList.remove('show');
    } else {
    menu.classList.add('show');
    overlay.classList.add('show');
    }
}

// Cerrar el menú al presionar ESC
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
    var menu = document.getElementById('dropdownMenu');
    var overlay = document.getElementById('menuOverlay');
    if (menu.classList.contains('show')) {
    menu.classList.remove('show');
    overlay.classList.remove('show');
    }
    }
});

// Cerrar el menú si se hace clic fuera (mejora)
document.addEventListener('click', function(event) {
    var menu = document.getElementById('dropdownMenu');
    var menuIcon = document.getElementById('menu-icon');
    if (!menu.contains(event.target) && event.target !== menuIcon) {
    menu.classList.remove('show');
    document.getElementById('menuOverlay').classList.remove('show');
    }
});
</script>

<?php include('wt_menureportes.php'); ?>
<?php include('includes/footer.php'); ?>