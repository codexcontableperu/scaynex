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

// Inicializar variable idp si no existe
$idp = isset($_GET['idp']) ? $_GET['idp'] : 0;
?>
<?php include("../data/conexion.php"); ?>

<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="whatsaap/stilo_what.css">
<!-- FONT AWESOEM -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<div id="header">
    <div id="whatsapp-text">
        <span class="icon-user"></span> <?php echo htmlspecialchars($userup); ?> 
    </div>
    <div id="header-icons">
        <img src="whatsaap/camera-icon.png" alt="Cámara" id="camera-icon">
        <img src="whatsaap/search-icon.png" alt="Buscar" id="search-icon">
        <img src="whatsaap/menu-icon.png" alt="Menú" id="menu-icon">
    </div>
</div>

<!-- barra de progreso  -->
<link rel="stylesheet" href="barraprogreso.css">

<div id="second-header">
    <div class="container_progreso">
        <div class="progress-bar">
            <div class="progress-line"></div>


            <a href="wt_prog_user.php" class="step active">
                <div class="step-circle"><i class="bi bi-truck" id="truck"></i></div>
                <div class="step-label">Órdenes</div>
            </a>

<?php if ($idp != 0 && $idp != null): ?>


    <a href="wt_panel_user.php?idp=<?php echo $idp; ?>" class="step active">
        <div class="step-circle">
            <i class="bi bi-truck" id="truck"></i>
        </div>
        <div class="step-label">Base</div>
    </a>
<?php endif; ?>


        </div>
    </div>
</div>

<?php if ($idp != 0 && $idp != null): ?>
<br>
<div class="text-right pr-3">
    <a href="wt_panel_user.php?idp=<?php echo $idp; ?>" class="btn btn-secondary">
        <i class="bi bi-x-circle"></i> Cerrar
    </a>
</div>
<?php endif; ?>


<?php include('wt_form_caja.php'); ?>


</body>
</html>
