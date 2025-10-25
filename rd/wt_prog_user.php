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
?>
<?php include("../data/conexion.php"); ?>

<?php
// Procesar cierre de programación
if (isset($_POST['cerrar_programacion'])) {
    $idp_cerrar = intval($_POST['idp_cerrar']);
    
    $query_cerrar = "UPDATE rd_segimientos_head SET PENDIENTE = 2 WHERE Id_SERG = ?";
    $stmt_cerrar = $conexion->prepare($query_cerrar);
    $stmt_cerrar->bind_param("i", $idp_cerrar);
    
    if ($stmt_cerrar->execute()) {
        echo "<script>alert('Programación cerrada exitosamente.'); window.location.href='wt_prog_user.php?dni=$dni_user';</script>";
    } else {
        echo "<script>alert('Error al cerrar la programación.');</script>";
    }
    $stmt_cerrar->close();
    exit;
}
?>

<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="whatsaap/stilo_what.css">

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
</style>

<div id="header">
    <div id="whatsapp-text">
        <span class="icon-user"></span> <?php echo $userup; ?> 
    </div>

    <div id="header-icons">
        <img src="whatsaap/camera-icon.png" alt="Cámara" id="camera-icon">
        <img src="whatsaap/search-icon.png" alt="Buscar" id="search-icon">
        <img src="whatsaap/menu-icon.png" alt="Menú" id="menu-icon">
    </div>
</div>

<div id="second-header">
    <img src="whatsaap/user-icon.png" alt="Usuario" id="user-icon">
    <a class="boton bton selec" href="wt_prog_user.php?dni=<?php echo $dni_user; ?>">Ordenes</a>
    &nbsp &nbsp 
</div>

<?php
// Verificar la conexión
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Modificar la consulta SQL para incluir PENDIENTE = 1 y 2
$sql = "SELECT Id_SERG, CONDUCTOR, ID_CLIENTE, S_FECHA, PLACA, AUXILIAR1, AUXILIAR2, AUXILIAR3, PENDIENTE 
        FROM rd_segimientos_head 
        WHERE PENDIENTE IN (1, 2)";

$result = mysqli_query($conexion, $sql);

$nueva_tabla = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Añadir filas para cada operador
        $nueva_tabla[] = array("TIPO_OPERADOR" => "CONDUCTOR", "NOMBRE" => $row["CONDUCTOR"], "Id_SERG" => $row["Id_SERG"], "PENDIENTE" => $row["PENDIENTE"], "ID_CLIENTE" => $row["ID_CLIENTE"], "S_FECHA" => $row["S_FECHA"], "PLACA" => $row["PLACA"]);
        $nueva_tabla[] = array("TIPO_OPERADOR" => "AUXILIAR1", "NOMBRE" => $row["AUXILIAR1"], "Id_SERG" => $row["Id_SERG"], "PENDIENTE" => $row["PENDIENTE"], "ID_CLIENTE" => $row["ID_CLIENTE"], "S_FECHA" => $row["S_FECHA"], "PLACA" => $row["PLACA"]);
        $nueva_tabla[] = array("TIPO_OPERADOR" => "AUXILIAR2", "NOMBRE" => $row["AUXILIAR2"], "Id_SERG" => $row["Id_SERG"], "PENDIENTE" => $row["PENDIENTE"], "ID_CLIENTE" => $row["ID_CLIENTE"], "S_FECHA" => $row["S_FECHA"], "PLACA" => $row["PLACA"]);
        $nueva_tabla[] = array("TIPO_OPERADOR" => "AUXILIAR3", "NOMBRE" => $row["AUXILIAR3"], "Id_SERG" => $row["Id_SERG"], "PENDIENTE" => $row["PENDIENTE"], "ID_CLIENTE" => $row["ID_CLIENTE"], "S_FECHA" => $row["S_FECHA"], "PLACA" => $row["PLACA"]);
    }
}

// Obtener nombre del usuario
$query = "SELECT usuarios.id_user, usuarios.user_nombre FROM usuarios WHERE usuarios.id_user = $id_userup";
$result = mysqli_query($conexion, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nombre_buscado = $row['user_nombre'];
} else {
    $nombre_buscado = "No encontrado";
}

// Filtrar la nueva tabla por el nombre específico
$resultado = array_filter($nueva_tabla, function($fila) use ($nombre_buscado) {
    return $fila["NOMBRE"] === $nombre_buscado;
});
?>

<br>

<div class="titu">
    <h5>📋 Programaciones Activas</h5>
</div>

<div class="botones">
    <div class="container text-center">
        <div class="row d-flex justify-content-center">
            <?php 
            if (count($resultado) > 0) {
                foreach ($resultado as $filaso) { 
                    // Determinar la clase del botón según PENDIENTE
                    $btn_class = ($filaso['PENDIENTE'] == 2) ? 'btn-pendiente-2' : 'btn-dark';
                ?>
                    <a class="btn btn-lg <?php echo $btn_class; ?> square-btn mx-2" style="color: white; position: relative;" href="wt_panel_user.php?idp=<?php echo $filaso['Id_SERG']?>">
                        
                        <?php if ($filaso['PENDIENTE'] == 1): ?>
                            <!-- X para cerrar solo para PENDIENTE = 1 -->
                            <span class="icon-close-prog" onclick="event.preventDefault(); abrirModalCerrar(<?php echo $filaso['Id_SERG']; ?>);">
                                ✕
                            </span>
                        <?php endif; ?>
                        
                        <span class="icon-truck"></span><br>
                        <span style="font-size: 13px;"><?php echo $filaso['TIPO_OPERADOR']?></span><br>
                        <?php echo $filaso['PLACA']?><br>
                        <span style="font-size: 13px;"><?php echo $filaso['ID_CLIENTE']?></span><br>
                        <span style="font-size: 13px;"><?php echo $filaso['S_FECHA']?></span>
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
</script>

<!-- menu reportes-->
<?php include('wt_menureportes.php'); ?>

<?php include('includes/footer.php'); ?>