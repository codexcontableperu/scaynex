<?php include("includes/header.php"); ?>
</head>
<body>
    <!-- Header Bar -->
<?php include("includes/menubar.php"); ?>
<?php include("data/conexion.php"); ?>

<?php
// Obtener la conexión
$conexion = getConexion();

// Obtener datos actuales del usuario
$id_user = $_SESSION['id_user'];
$sql = "SELECT * FROM usuarios WHERE id_user = $id_user";
$resultado = mysqli_query($conexion, $sql);
$usuario = mysqli_fetch_assoc($resultado);

// Procesar actualización de datos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar_datos'])) {
    
    $nombre = limpiarDato($_POST['nombre_user']);
    $movil = limpiarDato($_POST['movil']);
    
    $nombre = escaparDato($conexion, $nombre);
    $movil = escaparDato($conexion, $movil);
    
    $sql_update = "UPDATE usuarios SET 
                   nombre_user = '$nombre',
                   movil = '$movil'
                   WHERE id_user = $id_user";
    
    if (mysqli_query($conexion, $sql_update)) {
        $_SESSION['nombre_user'] = $nombre;
        echo "<script>alert('Datos actualizados correctamente'); window.location.href='myperfil.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar datos');</script>";
    }
}

// Procesar cambio de contraseña
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cambiar_contraseña'])) {
    
    $contraseña_nueva = limpiarDato($_POST['contraseña_nueva']);
    $contraseña_confirmar = limpiarDato($_POST['contraseña_confirmar']);
    
    if ($contraseña_nueva === $contraseña_confirmar) {
        
        if (strlen($contraseña_nueva) >= 4) {
            
            $contraseña_nueva = escaparDato($conexion, $contraseña_nueva);
            
            $sql_update = "UPDATE usuarios SET contraseña = '$contraseña_nueva' WHERE id_user = $id_user";
            
            if (mysqli_query($conexion, $sql_update)) {
                echo "<script>alert('Contraseña actualizada correctamente');</script>";
            } else {
                echo "<script>alert('Error al actualizar contraseña');</script>";
            }
            
        } else {
            echo "<script>alert('La contraseña debe tener al menos 4 caracteres');</script>";
        }
        
    } else {
        echo "<script>alert('Las contraseñas nuevas no coinciden');</script>";
    }
}

// Procesar cambio de avatar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cambiar_avatar'])) {
    
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        
        $permitidos = array("image/jpg", "image/jpeg", "image/png", "image/gif");
        $limite_tamaño = 2097152; // 2MB
        
        if (in_array($_FILES['avatar']['type'], $permitidos) && $_FILES['avatar']['size'] <= $limite_tamaño) {
            
            $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            $nombre_archivo = "avatar_" . $id_user . "_" . time() . "." . $extension;
            $ruta_destino = "img/avatars/" . $nombre_archivo;
            
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $ruta_destino)) {
                
                // Eliminar avatar anterior si no es el default
                if ($usuario['avatar'] != 'default-avatar.png' && file_exists("img/avatars/" . $usuario['avatar'])) {
                    unlink("img/avatars/" . $usuario['avatar']);
                }
                
                $sql_update = "UPDATE usuarios SET avatar = '$nombre_archivo' WHERE id_user = $id_user";
                
                if (mysqli_query($conexion, $sql_update)) {
                    $_SESSION['avatar'] = $nombre_archivo;
                    echo "<script>alert('Foto de perfil actualizada correctamente'); window.location.href='myperfil.php';</script>";
                } else {
                    echo "<script>alert('Error al actualizar foto de perfil');</script>";
                }
                
            } else {
                echo "<script>alert('Error al subir el archivo');</script>";
            }
            
        } else {
            echo "<script>alert('Formato no permitido o archivo muy grande (máx 2MB)');</script>";
        }
        
    } else {
        echo "<script>alert('No se seleccionó ningún archivo');</script>";
    }
}

// Recargar datos del usuario después de cualquier actualización
$sql = "SELECT * FROM usuarios WHERE id_user = $id_user";
$resultado = mysqli_query($conexion, $sql);
$usuario = mysqli_fetch_assoc($resultado);
?>

    <!-- Área de Contenido -->
    <div class="content-area">
        <h2>Mi Perfil</h2>
        <p class="text-muted">Administra tu información personal</p>
            
        <!-- Aquí va el contenido dinámico -->
        <div class="row mt-4">
            
            <!-- Foto de Perfil -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header bg-gradient">
                        <h5 class="mb-0"><i class="fas fa-camera"></i> Foto de Perfil</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="img/avatars/<?php echo htmlspecialchars($usuario['avatar']); ?>" 
                             alt="Avatar" 
                             class="img-fluid rounded-circle mb-3" 
                             style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #667eea;">
                        
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <input type="file" class="form-control" name="avatar" accept="image/*" required>
                                <small class="text-muted">Formatos: JPG, PNG, GIF (Máx 2MB)</small>
                            </div>
                            <button type="submit" name="cambiar_avatar" class="btn btn-primary w-100">
                                <i class="fas fa-upload"></i> Actualizar Foto
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Datos Personales -->
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-header bg-gradient">
                        <h5 class="mb-0"><i class="fas fa-user"></i> Datos Personales</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">DNI</label>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($usuario['dni_user']); ?>" disabled>
                                    <small class="text-muted">No se puede modificar</small>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nombre Completo</label>
                                    <input type="text" class="form-control" name="nombre_user" value="<?php echo htmlspecialchars($usuario['nombre_user']); ?>" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Móvil</label>
                                    <input type="text" class="form-control" name="movil" value="<?php echo htmlspecialchars($usuario['movil']); ?>" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Permisos</label>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($usuario['permisos']); ?>" disabled>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Estado</label>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($usuario['estado_user']); ?>" disabled>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Fecha de Registro</label>
                                    <input type="text" class="form-control" value="<?php echo date('d/m/Y H:i', strtotime($usuario['fecha_registro'])); ?>" disabled>
                                </div>
                            </div>
                            
                            <button type="submit" name="actualizar_datos" class="btn btn-success">
                                <i class="fas fa-save"></i> Guardar Cambios
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Cambiar Contraseña -->
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header bg-gradient">
                        <h5 class="mb-0"><i class="fas fa-lock"></i> Cambiar Contraseña</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nueva Contraseña</label>
                                    <input type="password" class="form-control" name="contraseña_nueva" required>
                                    <small class="text-muted">Mínimo 4 caracteres</small>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Confirmar Nueva Contraseña</label>
                                    <input type="password" class="form-control" name="contraseña_confirmar" required>
                                </div>
                            </div>
                            
                            <button type="submit" name="cambiar_contraseña" class="btn btn-warning">
                                <i class="fas fa-key"></i> Cambiar Contraseña
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <style>
        .bg-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        
        .card-header {
            border-bottom: none;
            padding: 15px 20px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
    </style>

<?php 
cerrarConexion($conexion);
include("includes/footer.php"); 
?>
</body>
</html>