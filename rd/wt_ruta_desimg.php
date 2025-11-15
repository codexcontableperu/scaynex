<?php 
session_start(); 

if (isset($_SESSION['usuario'])) {
    $userup = $_SESSION['usuario'];
    $id_userup = $_SESSION['id_usuario'];
    $dni_user = $_SESSION['user_dni'];
} else {
    session_destroy();
    mysqli_close($conexion);
    echo '<script type="text/javascript">
        window.location.href="./index.php";
    </script>';
}
?>

<?php include("../data/conexion.php"); ?>
<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="whatsaap/stilo_what.css">
<link rel="stylesheet" href="barraprogreso.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<style>
    /* ========== ESTILOS GENERALES ========== */
    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f5f5f5;
    }

    .container {
        margin-top: 6px;
        margin-bottom: 10px;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    /* ========== HEADER WHATSAPP ========== */
    #header {
        background-color: #075e54;
        color: white;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    #whatsapp-text {
        font-size: 16px;
        font-weight: 600;
    }

    #header-icons img {
        width: 24px;
        margin-left: 15px;
        cursor: pointer;
        opacity: 0.8;
        transition: opacity 0.3s;
    }

    #header-icons img:hover {
        opacity: 1;
    }

    /* ========== TÍTULO Y BOTÓN PRINCIPAL ========== */
    .page-title {
        background: white;
        padding: 20px;
        margin: 20px 0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .page-title h2 {
        margin: 0 0 5px 0;
        font-size: 20px;
        color: #333;
    }

    .page-title .subtitle {
        color: #666;
        font-size: 14px;
    }

    .upload-btn-container {
        padding: 0 20px 20px;
    }

    .btn-upload {
        background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
        color: white;
        border: none;
        padding: 15px;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        width: 100%;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
    }

    .btn-upload:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
        color: white;
    }

    .btn-upload i {
        margin-right: 8px;
    }

    /* ========== SECCIONES DE GALERÍA ========== */
    .gallery-section {
        margin-bottom: 30px;
        padding: 0 20px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding: 10px 15px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .section-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: #075e54;
    }

    .image-count {
        background: #075e54;
        color: white;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 600;
    }

    /* ========== GALERÍA MODERNA ========== */
    .gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
        padding: 10px 0;
    }

    @media (min-width: 768px) {
        .gallery {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
    }

    .gallery-item {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        background: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }

    .gallery-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .gallery-item-inner {
        position: relative;
        padding-bottom: 100%; /* Aspect ratio 1:1 */
        overflow: hidden;
    }

    .gallery-item img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .gallery-item:hover img {
        transform: scale(1.1);
    }

    /* Overlay con información */
    .gallery-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 100%);
        padding: 15px 10px 10px;
        transform: translateY(100%);
        transition: transform 0.3s;
    }

    .gallery-item:hover .gallery-overlay {
        transform: translateY(0);
    }

    .gallery-overlay-text {
        color: white;
        font-size: 12px;
        font-weight: 500;
        margin: 0;
        line-height: 1.4;
    }

    /* Botón de eliminar */
    .delete-btn {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(255, 59, 48, 0.9);
        color: white;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s;
        z-index: 2;
        cursor: pointer;
        border: 2px solid white;
    }

    .gallery-item:hover .delete-btn {
        opacity: 1;
    }

    .delete-btn:hover {
        background: #ff3b30;
        transform: scale(1.1);
    }

    /* Mensaje cuando no hay imágenes */
    .no-images {
        text-align: center;
        padding: 40px 20px;
        background: white;
        border-radius: 12px;
        color: #999;
    }

    .no-images i {
        font-size: 48px;
        margin-bottom: 15px;
        opacity: 0.3;
    }

    .no-images p {
        margin: 0;
        font-size: 14px;
    }

    /* ========== MODAL DE VISUALIZACIÓN (LIGHTBOX) ========== */
    .lightbox-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.95);
        animation: fadeIn 0.3s;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .lightbox-content {
        position: relative;
        margin: auto;
        display: block;
        max-width: 90%;
        max-height: 85vh;
        top: 50%;
        transform: translateY(-50%);
        animation: zoomIn 0.3s;
    }

    @keyframes zoomIn {
        from { transform: translateY(-50%) scale(0.8); }
        to { transform: translateY(-50%) scale(1); }
    }

    .lightbox-close {
        position: absolute;
        top: 20px;
        right: 30px;
        color: white;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
        z-index: 10000;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        transition: all 0.3s;
    }

    .lightbox-close:hover {
        background: rgba(255,255,255,0.2);
        transform: rotate(90deg);
    }

    .lightbox-caption {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        color: white;
        background: rgba(0,0,0,0.7);
        padding: 15px 25px;
        border-radius: 25px;
        font-size: 14px;
        max-width: 80%;
        text-align: center;
    }

    /* ========== MODAL DE BOOTSTRAP (SUBIR IMAGEN) ========== */
    .modal-header {
        background: linear-gradient(135deg, #075e54 0%, #128c7e 100%);
        color: white;
        border-radius: 0;
    }

    .modal-header .close {
        color: white;
        opacity: 0.8;
    }

    .modal-header .close:hover {
        opacity: 1;
    }

    .modal-title {
        font-weight: 600;
    }

    .modal-body {
        padding: 25px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        border-radius: 8px;
        border: 2px solid #e0e0e0;
        padding: 10px 15px;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #075e54;
        box-shadow: 0 0 0 3px rgba(7, 94, 84, 0.1);
    }

    /* Botones de Cámara y Galería */
    .camera-gallery-container {
        display: flex;
        gap: 10px;
        border: 2px dashed #e0e0e0;
        border-radius: 10px;
        padding: 20px;
        background: #f9f9f9;
        transition: all 0.3s;
    }

    .camera-gallery-container:hover {
        border-color: #075e54;
        background: #f0f8f7;
    }

    .btn-camera, .btn-gallery {
        flex: 1;
        padding: 15px 10px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        border: none;
    }

    .btn-camera {
        background: linear-gradient(135deg, #25d366 0%, #20b358 100%);
        color: white;
    }

    .btn-camera:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
    }

    .btn-gallery {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
    }

    .btn-gallery:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
    }

    .btn-camera i, .btn-gallery i {
        font-size: 24px;
    }

    .file-name-display {
        margin-top: 10px;
        padding: 10px;
        background: #e8f5e9;
        border-radius: 8px;
        font-size: 13px;
        color: #2e7d32;
        display: none;
        align-items: center;
        gap: 8px;
    }

    .file-name-display.show {
        display: flex;
    }

    .file-name-display i {
        font-size: 16px;
    }

    /* Preview de imagen */
    .image-preview {
        margin-top: 15px;
        display: none;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .image-preview.show {
        display: block;
    }

    .image-preview img {
        width: 100%;
        height: auto;
        display: block;
    }

    .btn-primary {
        background: linear-gradient(135deg, #075e54 0%, #128c7e 100%);
        border: none;
        border-radius: 8px;
        padding: 12px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(7, 94, 84, 0.3);
    }

    /* Loading spinner */
    .loading-spinner {
        display: none;
        text-align: center;
        padding: 20px;
    }

    .loading-spinner.show {
        display: block;
    }

    .spinner {
        border: 3px solid #f3f3f3;
        border-top: 3px solid #075e54;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        margin: 0 auto;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 768px) {
        .page-title h2 {
            font-size: 18px;
        }

        .gallery {
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 10px;
        }

        .lightbox-content {
            max-width: 95%;
        }

        .lightbox-close {
            top: 10px;
            right: 10px;
            font-size: 30px;
            width: 40px;
            height: 40px;
        }

        .btn-camera, .btn-gallery {
            font-size: 12px;
            padding: 12px 8px;
        }

        .btn-camera i, .btn-gallery i {
            font-size: 20px;
        }
    }
</style>

<?php
// Sanitizar variables GET
$idp = mysqli_real_escape_string($conexion, $_GET['idp']);
$idr = mysqli_real_escape_string($conexion, $_GET['idr']);
?>

<!-- Header WhatsApp -->
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

<!-- Barra de progreso (sin modificar CSS) -->
<div id="second-header">
    <div class="container_progreso">
        <div class="progress-bar">
            <div class="progress-line"></div>
            
            <a href="wt_prog_user.php" class="step">
                <div class="step-circle">1</div>
                <div class="step-label">Órdenes</div>
            </a>
            
            <a href="wt_panel_user.php?idp=<?php echo $idp; ?>" class="step">
                <div class="step-circle">2</div>
                <div class="step-label">Base</div>
            </a>
            
            <a href="#" class="step active">
                <div class="step-circle"><i class="fas fa-images"></i></div>
                <div class="step-label">IMÁGENES</div>
            </a>
        </div>
    </div>
</div>

<?php
// Consulta para obtener información del servicio
$queryo = "
    SELECT rd_servicio.*, rd_servicio.Id_SERG, hruta.id_ruta, rd_segimientos_head.S_FECHA
    FROM (rd_servicio INNER JOIN hruta ON rd_servicio.Id_SERG = hruta.id_prog) 
    INNER JOIN rd_segimientos_head ON rd_servicio.Id_SERG = rd_segimientos_head.Id_SERG
    WHERE rd_servicio.ID_SERV = '$idr'
";
$resulto = mysqli_query($conexion, $queryo);
$filaso = mysqli_fetch_assoc($resulto);
?>

<!-- Título de la página -->
<div class="page-title">
    <h2><i class="fas fa-images"></i> Galería de Imágenes</h2>
    <div class="subtitle">
        <i class="fas fa-calendar-alt"></i> <?php echo htmlspecialchars($filaso['S_FECHA']); ?> - 
        P<?php echo $idp; ?>R<?php echo $idr; ?>
    </div>
</div>

<!-- Botón para subir imagen -->
<div class="upload-btn-container">
    <button class="btn-upload" data-toggle="modal" data-target="#FOTOS">
        <i class="fas fa-cloud-upload-alt"></i> SUBIR NUEVA IMAGEN
    </button>
</div>

<!-- Sección: INICIO PARTIDA -->
<div class="gallery-section" id="section-partida">
    <?php
    $query_partida = "SELECT * FROM rd_fotos WHERE Id_SERG='$idp' AND TIPO='PARTIDA'";
    $result_partida = mysqli_query($conexion, $query_partida);
    $count_partida = mysqli_num_rows($result_partida);
    ?>
    
    <div class="section-header">
        <div class="section-title">
            <i class="fas fa-play-circle"></i>
            <span>INICIO PARTIDA</span>
        </div>
        <div class="image-count"><?php echo $count_partida; ?></div>
    </div>

    <?php if ($count_partida > 0) { ?>
        <div class="gallery">
            <?php while ($foto = mysqli_fetch_assoc($result_partida)) { ?>
                <div class="gallery-item" onclick="openLightbox('../<?php echo htmlspecialchars($foto['IMG']); ?>', '<?php echo htmlspecialchars($foto['ALCANCE']); ?>')">
                    <div class="gallery-item-inner">
                        <img src="../<?php echo htmlspecialchars($foto['IMG']); ?>" alt="<?php echo htmlspecialchars($foto['ALCANCE']); ?>" loading="lazy">
                        <div class="gallery-overlay">
                            <p class="gallery-overlay-text"><?php echo htmlspecialchars($foto['ALCANCE']); ?></p>
                        </div>
                    </div>
                    <a href="#" class="delete-btn" onclick="event.stopPropagation(); confirmDelete(<?php echo $foto['ID_FOTO']; ?>)">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="no-images">
            <i class="fas fa-image"></i>
            <p>No hay imágenes de partida</p>
        </div>
    <?php } ?>
</div>

<!-- Sección: CARGA -->
<div class="gallery-section" id="section-carga">
    <?php
    $query_carga = "SELECT * FROM rd_fotos WHERE ID_SERV='$idr' AND Id_SERG='$idp' AND TIPO='CARGA'";
    $result_carga = mysqli_query($conexion, $query_carga);
    $count_carga = mysqli_num_rows($result_carga);
    ?>
    
    <div class="section-header">
        <div class="section-title">
            <i class="fas fa-box-open"></i>
            <span>CARGA</span>
        </div>
        <div class="image-count"><?php echo $count_carga; ?></div>
    </div>

    <?php if ($count_carga > 0) { ?>
        <div class="gallery">
            <?php while ($foto = mysqli_fetch_assoc($result_carga)) { ?>
                <div class="gallery-item" onclick="openLightbox('../<?php echo htmlspecialchars($foto['IMG']); ?>', '<?php echo htmlspecialchars($foto['ALCANCE']); ?>')">
                    <div class="gallery-item-inner">
                        <img src="../<?php echo htmlspecialchars($foto['IMG']); ?>" alt="<?php echo htmlspecialchars($foto['ALCANCE']); ?>" loading="lazy">
                        <div class="gallery-overlay">
                            <p class="gallery-overlay-text"><?php echo htmlspecialchars($foto['ALCANCE']); ?></p>
                        </div>
                    </div>
                    <a href="#" class="delete-btn" onclick="event.stopPropagation(); confirmDelete(<?php echo $foto['ID_FOTO']; ?>)">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="no-images">
            <i class="fas fa-image"></i>
            <p>No hay imágenes de carga</p>
        </div>
    <?php } ?>
</div>

<!-- Sección: DESCARGA -->
<div class="gallery-section" id="section-descarga">
    <?php
    $query_descarga = "SELECT * FROM rd_fotos WHERE ID_SERV='$idr' AND Id_SERG='$idp' AND TIPO='DESCARGA'";
    $result_descarga = mysqli_query($conexion, $query_descarga);
    $count_descarga = mysqli_num_rows($result_descarga);
    ?>
    
    <div class="section-header">
        <div class="section-title">
            <i class="fas fa-dolly"></i>
            <span>DESCARGA</span>
        </div>
        <div class="image-count"><?php echo $count_descarga; ?></div>
    </div>

    <?php if ($count_descarga > 0) { ?>
        <div class="gallery">
            <?php while ($foto = mysqli_fetch_assoc($result_descarga)) { ?>
                <div class="gallery-item" onclick="openLightbox('../<?php echo htmlspecialchars($foto['IMG']); ?>', '<?php echo htmlspecialchars($foto['ALCANCE']); ?>')">
                    <div class="gallery-item-inner">
                        <img src="../<?php echo htmlspecialchars($foto['IMG']); ?>" alt="<?php echo htmlspecialchars($foto['ALCANCE']); ?>" loading="lazy">
                        <div class="gallery-overlay">
                            <p class="gallery-overlay-text"><?php echo htmlspecialchars($foto['ALCANCE']); ?></p>
                        </div>
                    </div>
                    <a href="#" class="delete-btn" onclick="event.stopPropagation(); confirmDelete(<?php echo $foto['ID_FOTO']; ?>)">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="no-images">
            <i class="fas fa-image"></i>
            <p>No hay imágenes de descarga</p>
        </div>
    <?php } ?>
</div>

<!-- Sección: FIN RETORNO -->
<div class="gallery-section" id="section-retorno">
    <?php
    $query_retorno = "SELECT * FROM rd_fotos WHERE Id_SERG='$idp' AND TIPO='RETORNO'";
    $result_retorno = mysqli_query($conexion, $query_retorno);
    $count_retorno = mysqli_num_rows($result_retorno);
    ?>
    
    <div class="section-header">
        <div class="section-title">
            <i class="fas fa-flag-checkered"></i>
            <span>FIN RETORNO</span>
        </div>
        <div class="image-count"><?php echo $count_retorno; ?></div>
    </div>

    <?php if ($count_retorno > 0) { ?>
        <div class="gallery">
            <?php while ($foto = mysqli_fetch_assoc($result_retorno)) { ?>
                <div class="gallery-item" onclick="openLightbox('../<?php echo htmlspecialchars($foto['IMG']); ?>', '<?php echo htmlspecialchars($foto['ALCANCE']); ?>')">
                    <div class="gallery-item-inner">
                        <img src="../<?php echo htmlspecialchars($foto['IMG']); ?>" alt="<?php echo htmlspecialchars($foto['ALCANCE']); ?>" loading="lazy">
                        <div class="gallery-overlay">
                            <p class="gallery-overlay-text"><?php echo htmlspecialchars($foto['ALCANCE']); ?></p>
                        </div>
                    </div>
                    <a href="#" class="delete-btn" onclick="event.stopPropagation(); confirmDelete(<?php echo $foto['ID_FOTO']; ?>)">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="no-images">
            <i class="fas fa-image"></i>
            <p>No hay imágenes de retorno</p>
        </div>
    <?php } ?>
</div>

<!-- Modal Lightbox para visualizar imágenes -->
<div class="lightbox-modal" id="lightboxModal">
    <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
    <img class="lightbox-content" id="lightboxImg">
    <div class="lightbox-caption" id="lightboxCaption"></div>
</div>

<!-- Modal Bootstrap para subir imagen CON BOTONES CÁMARA Y GALERÍA -->
<div class="modal fade" tabindex="-1" role="dialog" id="FOTOS">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-cloud-upload-alt"></i> SUBIR IMAGEN
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="crud_fotos/createimg.php" method="POST" enctype="multipart/form-data" id="uploadForm">
                    <input type="hidden" name="Redirigir" value="wt_images">
                    <input type="hidden" name="idp" value="<?php echo $idp; ?>">
                    <input type="hidden" name="idr" value="<?php echo $idr; ?>">
                    <input type="hidden" name="idd" value="">

                    <div class="form-group">
                        <label for="head_imagen">
                            <i class="fas fa-camera"></i> Seleccionar Imagen
                        </label>

                        <!-- Input oculto -->
                        <input type="file" 
                               class="form-control d-none" 
                               id="head_imagen" 
                               name="head_imagen" 
                               accept="image/*" 
                               required>

                        <!-- Botones con Cámara y Galería -->
                        <div class="camera-gallery-container">
                            <button type="button" class="btn-camera" onclick="openCamera()">
                                <i class="bi bi-camera-fill"></i>
                                <span>Cámara</span>
                            </button>
                            
                            <button type="button" class="btn-gallery" onclick="openGallery()">
                                <i class="bi bi-folder2-open"></i>
                                <span>Galería</span>
                            </button>
                        </div>

                        <!-- Mostrar nombre del archivo seleccionado -->
                        <div class="file-name-display" id="fileNameDisplay">
                            <i class="fas fa-check-circle"></i>
                            <span id="fileName"></span>
                        </div>

                        <!-- Preview de la imagen -->
                        <div class="image-preview" id="imagePreview">
                            <img id="previewImg" src="" alt="Preview">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tipo">
                            <i class="fas fa-tag"></i> Tipo de Imagen
                        </label>
                        <select id="tipo" name="tipo" class="form-control" required>
                            <option value="" disabled selected>Seleccione un tipo...</option>
                            <option value="PARTIDA">🚀 PARTIDA</option>
                            <option value="CARGA">📦 CARGA</option>
                            <option value="DESCARGA">🚚 DESCARGA</option>
                            <option value="RETORNO">🏁 RETORNO</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="ALCANCE">
                            <i class="fas fa-comment-alt"></i> Descripción
                        </label>
                        <input class="form-control" type="text" id="ALCANCE" name="ALCANCE" placeholder="Ej: Carga completa en almacén principal" required>
                    </div>

                    <div class="loading-spinner" id="loadingSpinner">
                        <div class="spinner"></div>
                        <p style="margin-top: 10px; color: #666;">Subiendo imagen...</p>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">
                        <i class="fas fa-save"></i> GUARDAR IMAGEN
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // ========== VARIABLES GLOBALES ==========
    const fileInput = document.getElementById('head_imagen');
    const fileNameDisplay = document.getElementById('fileNameDisplay');
    const fileName = document.getElementById('fileName');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');

    // ========== FUNCIONES PARA CÁMARA Y GALERÍA ==========
    function openCamera() {
        fileInput.setAttribute('capture', 'environment');
        fileInput.click();
    }

    function openGallery() {
        fileInput.removeAttribute('capture');
        fileInput.click();
    }

    // ========== PREVIEW DE IMAGEN ==========
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            // Validar tamaño (máx 5MB)
            const maxSize = 5 * 1024 * 1024;
            if (file.size > maxSize) {
                alert('El archivo es demasiado grande. El tamaño máximo es 5MB.');
                this.value = '';
                fileNameDisplay.classList.remove('show');
                imagePreview.classList.remove('show');
                return;
            }

            // Mostrar nombre del archivo
            fileName.textContent = file.name;
            fileNameDisplay.classList.add('show');

            // Mostrar preview
            const reader = new FileReader();
            reader.onload = function(event) {
                previewImg.src = event.target.result;
                imagePreview.classList.add('show');
            }
            reader.readAsDataURL(file);
        }
    });

    // ========== LIGHTBOX FUNCTIONS ==========
    function openLightbox(src, caption) {
        const modal = document.getElementById('lightboxModal');
        const img = document.getElementById('lightboxImg');
        const captionText = document.getElementById('lightboxCaption');
        
        modal.style.display = 'block';
        img.src = src;
        captionText.textContent = caption;
        
        // Prevenir scroll del body
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const modal = document.getElementById('lightboxModal');
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Cerrar con tecla ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeLightbox();
        }
    });

    // Cerrar al hacer click fuera de la imagen
    document.getElementById('lightboxModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeLightbox();
        }
    });

    // ========== CONFIRMACIÓN DE ELIMINACIÓN ==========
    function confirmDelete(id) {
        if (confirm('¿Estás seguro de que deseas eliminar esta imagen?\n\nEsta acción no se puede deshacer.')) {
            window.location.href = 'crud_fotos/deleteimg.php?id=' + id + '&R=4';
        }
        return false;
    }

    // ========== LOADING SPINNER AL ENVIAR FORMULARIO ==========
    document.getElementById('uploadForm').addEventListener('submit', function(e) {
        // Validar que se haya seleccionado una imagen
        if (!fileInput.files || !fileInput.files[0]) {
            e.preventDefault();
            alert('Por favor, selecciona una imagen usando Cámara o Galería.');
            return false;
        }

        document.getElementById('loadingSpinner').classList.add('show');
        document.getElementById('guardar').disabled = true;
    });

    // ========== RESET MODAL AL CERRAR ==========
    $('#FOTOS').on('hidden.bs.modal', function () {
        document.getElementById('uploadForm').reset();
        fileNameDisplay.classList.remove('show');
        imagePreview.classList.remove('show');
        document.getElementById('loadingSpinner').classList.remove('show');
        document.getElementById('guardar').disabled = false;
    });

    // ========== ANIMACIÓN DE ENTRADA ==========
    document.addEventListener('DOMContentLoaded', function() {
        const galleryItems = document.querySelectorAll('.gallery-item');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, index * 50);
                }
            });
        }, { threshold: 0.1 });

        galleryItems.forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(20px)';
            item.style.transition = 'opacity 0.5s, transform 0.5s';
            observer.observe(item);
        });
    });
</script>

<?php include('includes/footer.php'); ?>