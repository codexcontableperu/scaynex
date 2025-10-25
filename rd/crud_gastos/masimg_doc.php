<?php
include("./../../data/conexion.php");

// Obtener el id_operacion desde la URL
$id_operacion = isset($_GET['id_operacion']) ? intval($_GET['id_operacion']) : 0;
$idp = isset($_GET['idp']) ? intval($_GET['idp']) : 23;

// Alias para mantener compatibilidad
$conn = $conexion;

// Procesar eliminación de imagen
if (isset($_POST['eliminar_imagen'])) {
    $id_imagen = intval($_POST['id_imagen']);
    
    // Obtener la ruta de la imagen antes de eliminar
    $query_ruta = "SELECT ruta_imagen FROM rd_control_cuentas_imagenes WHERE id_imagen = ?";
    $stmt_ruta = $conn->prepare($query_ruta);
    $stmt_ruta->bind_param("i", $id_imagen);
    $stmt_ruta->execute();
    $result_ruta = $stmt_ruta->get_result();
    
    if ($row_ruta = $result_ruta->fetch_assoc()) {
        $ruta_archivo = $row_ruta['ruta_imagen'];
        
        // Eliminar el archivo físico
        if (file_exists($ruta_archivo)) {
            unlink($ruta_archivo);
        }
        
        // Eliminar el registro de la base de datos
        $query_eliminar = "DELETE FROM rd_control_cuentas_imagenes WHERE id_imagen = ?";
        $stmt_eliminar = $conn->prepare($query_eliminar);
        $stmt_eliminar->bind_param("i", $id_imagen);
        $stmt_eliminar->execute();
        $stmt_eliminar->close();
    }
    $stmt_ruta->close();
    
    header("Location: masimg_doc.php?id_operacion=$id_operacion&idp=$idp");
    exit;
}

// Procesar carga de nueva imagen
if (isset($_POST['subir_imagen'])) {
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $carpeta_destino = "crud_gastos/fotos_gastos/";
        
        // Crear la carpeta si no existe
        if (!file_exists($carpeta_destino)) {
            mkdir($carpeta_destino, 0777, true);
        }
        
        $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $nombre_archivo = "img_" . $id_operacion . "_" . time() . "." . $extension;
        $ruta_completa = $carpeta_destino . $nombre_archivo;
        
        // Validar que sea una imagen
        $extensiones_permitidas = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array(strtolower($extension), $extensiones_permitidas)) {
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_completa)) {
                // Insertar en la base de datos
                $query_insertar = "INSERT INTO rd_control_cuentas_imagenes (id_operacion, ruta_imagen) VALUES (?, ?)";
                $stmt_insertar = $conn->prepare($query_insertar);
                $stmt_insertar->bind_param("is", $id_operacion, $ruta_completa);
                $stmt_insertar->execute();
                $stmt_insertar->close();
                
                header("Location: masimg_doc.php?id_operacion=$id_operacion&idp=$idp");
                exit;
            }
        }
    }
}

// Consultar las imágenes
$query_imagenes = "SELECT id_imagen, ruta_imagen FROM rd_control_cuentas_imagenes WHERE id_operacion = ?";
$stmt_img = $conn->prepare($query_imagenes);
$stmt_img->bind_param("i", $id_operacion);
$stmt_img->execute();
$result_imagenes = $stmt_img->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Imágenes - Operación #<?php echo $id_operacion; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .gallery-container {
            padding: 30px 0;
        }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .gallery-item {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0,0,0,0.2);
        }
        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
        }
        .delete-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(220, 53, 69, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 20px;
            transition: background-color 0.3s ease;
            z-index: 10;
        }
        .delete-btn:hover {
            background-color: rgba(220, 53, 69, 1);
        }
        .empty-gallery {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }
        .empty-gallery i {
            font-size: 80px;
            margin-bottom: 20px;
        }
        .header-section {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container gallery-container">
        <!-- Header -->
        <div class="header-section">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h2 class="mb-1">
                        <i class="bi bi-images"></i> Imegenes / Comprobantes
                    </h2>
                    <p class="text-muted mb-0">Operación #<?php echo $id_operacion; ?></p>
                </div>
                <div class="d-flex gap-2 mt-2 mt-md-0">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCargarImagen">
                        <i class="bi bi-upload"></i> Cargar Imagen
                    </button>

                </div>
            </div>
        </div>

        <!-- Galería -->
        <?php if ($result_imagenes->num_rows > 0): ?>
            <div class="gallery-grid">
                <?php while ($img = $result_imagenes->fetch_assoc()): ?>
                    <div class="gallery-item">
                        <img src="<?php echo htmlspecialchars($img['ruta_imagen']); ?>" 
                             alt="Imagen <?php echo $img['id_imagen']; ?>">
                        <form method="POST" style="display: inline;" 
                              onsubmit="return confirm('¿Estás seguro de eliminar esta imagen?');">
                            <input type="hidden" name="id_imagen" value="<?php echo $img['id_imagen']; ?>">
                            <button type="submit" name="eliminar_imagen" class="delete-btn">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </form>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="empty-gallery">
                <i class="bi bi-image"></i>
                <h4>No hay imágenes</h4>
                <p>Haz clic en "Cargar Imagen" para agregar la primera imagen</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Modal para cargar imagen -->
    <div class="modal fade" id="modalCargarImagen" tabindex="-1" aria-labelledby="modalCargarImagenLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCargarImagenLabel">
                        <i class="bi bi-upload"></i> Cargar Nueva Imagen
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Seleccionar imagen</label>
                            <input type="file" class="form-control" id="imagen" name="imagen" 
                                   accept="image/jpeg,image/jpg,image/png,image/gif" required>
                            <div class="form-text">Formatos permitidos: JPG, JPEG, PNG, GIF</div>
                        </div>
                        <div id="preview" class="text-center mt-3"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" name="subir_imagen" class="btn btn-primary">
                            <i class="bi bi-upload"></i> Subir Imagen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preview de la imagen antes de subir
        document.getElementById('imagen').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('preview');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = '<img src="' + e.target.result + '" class="img-fluid rounded" style="max-height: 200px;">';
                }
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = '';
            }
        });
    </script>
</body>
</html>

<?php
$stmt_img->close();
$conexion->close();
?>