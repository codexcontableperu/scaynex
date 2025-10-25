<?php include("includes/header.php"); ?>
</head>
<body>
    <!-- Header Bar -->
<?php include("includes/menubar.php"); ?>
<?php include("../data/conexion.php"); ?>

<?php
// Verificar si se recibió el ID del usuario
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID de usuario no válido'); window.location.href='lista_usuarios.php';</script>";
    exit();
}

$id_usuario = (int)$_GET['id'];

// Obtener datos del usuario a editar
$sql = "SELECT * FROM usuarios WHERE id_user = $id_usuario";
$resultado = $conexion->query($sql);

if ($resultado->num_rows == 0) {
    echo "<script>alert('Usuario no encontrado'); window.location.href='lista_usuarios.php';</script>";
    exit();
}

$usuario = $resultado->fetch_assoc();

// Procesar actualización de usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar_usuario'])) {
    
    $nombre = limpiarDato($_POST['nombre_user']);
    $nick = limpiarDato($_POST['user_nick']);
    $telefono = limpiarDato($_POST['user_telefono']);
    $cargo = limpiarDato($_POST['user_cargo']);
    $perfil = limpiarDato($_POST['user_perfil']);
    $activo = limpiarDato($_POST['user_activo']);
    
    $nombre = $conexion->real_escape_string($nombre);
    $nick = $conexion->real_escape_string($nick);
    $telefono = $conexion->real_escape_string($telefono);
    $cargo = $conexion->real_escape_string($cargo);
    $perfil = $conexion->real_escape_string($perfil);
    $activo = $conexion->real_escape_string($activo);
    
    $sql_update = "UPDATE usuarios SET 
                   user_nombre = '$nombre',
                   user_nick = '$nick',
                   user_telefono = '$telefono',
                   user_cargo = '$cargo',
                   user_perfil = '$perfil',
                   user_activo = '$activo'
                   WHERE id_user = $id_usuario";
    
    if ($conexion->query($sql_update)) {
        echo "<script>alert('Usuario actualizado correctamente'); window.location.href='lista_usuarios.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar usuario: " . $conexion->error . "');</script>";
    }
}

// Procesar cambio de contraseña
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cambiar_contraseña'])) {
    
    $contraseña_nueva = limpiarDato($_POST['contraseña_nueva']);
    $contraseña_confirmar = limpiarDato($_POST['contraseña_confirmar']);
    
    if ($contraseña_nueva === $contraseña_confirmar) {
        
        if (strlen($contraseña_nueva) >= 4) {
            
            $contraseña_nueva = $conexion->real_escape_string($contraseña_nueva);
            
            $sql_update = "UPDATE usuarios SET user_clave = '$contraseña_nueva' WHERE id_user = $id_usuario";
            
            if ($conexion->query($sql_update)) {
                echo "<script>alert('Contraseña actualizada correctamente');</script>";
            } else {
                echo "<script>alert('Error al actualizar contraseña');</script>";
            }
            
        } else {
            echo "<script>alert('La contraseña debe tener al menos 4 caracteres');</script>";
        }
        
    } else {
        echo "<script>alert('Las contraseñas no coinciden');</script>";
    }
}

// Procesar cambio de avatar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cambiar_avatar'])) {
    
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        
        $permitidos = array("image/jpg", "image/jpeg", "image/png", "image/gif");
        $limite_tamaño = 2097152; // 2MB
        
        if (in_array($_FILES['avatar']['type'], $permitidos) && $_FILES['avatar']['size'] <= $limite_tamaño) {
            
            $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            $nombre_archivo = "avatar_" . $id_usuario . "_" . time() . "." . $extension;
            $ruta_destino = "../img/user/" . $nombre_archivo;
            
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $ruta_destino)) {
                
                // Eliminar avatar anterior si no es el default
                if ($usuario['user_avatar'] != 'user.jpg' && file_exists("../img/user/" . $usuario['user_avatar'])) {
                    unlink("../img/user/" . $usuario['user_avatar']);
                }
                
                $sql_update = "UPDATE usuarios SET user_avatar = '$nombre_archivo' WHERE id_user = $id_usuario";
                
                if ($conexion->query($sql_update)) {
                    echo "<script>alert('Foto de perfil actualizada correctamente'); window.location.href='editar_usuario.php?id=$id_usuario';</script>";
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
$sql = "SELECT * FROM usuarios WHERE id_user = $id_usuario";
$resultado = $conexion->query($sql);
$usuario = $resultado->fetch_assoc();
?>

    <!-- Área de Contenido -->
    <div class="content-area">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="text-dark">Editar Usuario</h2>

            </div>
            <a href="lista_usuarios.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
            
        <!-- Aquí va el contenido dinámico -->
        <div class="row mt-4">
            
            <!-- Foto de Perfil -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0"><i class="fas fa-camera"></i> Foto de Perfil</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="<?php echo htmlspecialchars($usuario['user_avatar'] ?? 'img/user/user.jpg'); ?>" 
                             alt="Avatar" 
                             class="img-fluid rounded-circle mb-3" 
                             style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #00d4ff;">
                        
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
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0"><i class="fas fa-user"></i> Datos Personales</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">ID Usuario</label>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($usuario['id_user']); ?>" disabled>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">DNI</label>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($usuario['user_dni']); ?>" disabled>
                                    <small class="text-muted">No se puede modificar</small>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nombre Completo <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nombre_user" value="<?php echo htmlspecialchars($usuario['user_nombre']); ?>" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nick <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="user_nick" value="<?php echo htmlspecialchars($usuario['user_nick'] ?? ''); ?>" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" name="user_telefono" value="<?php echo htmlspecialchars($usuario['user_telefono'] ?? ''); ?>">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Cargo <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="user_cargo" value="<?php echo htmlspecialchars($usuario['user_cargo'] ?? ''); ?>" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Perfil <span class="text-danger">*</span></label>
                                    <select class="form-select" name="user_perfil" required>
                                        <option value="1" <?php echo ($usuario['user_perfil'] == 1) ? 'selected' : ''; ?>>Administrador</option>
                                        <option value="2" <?php echo ($usuario['user_perfil'] == 2) ? 'selected' : ''; ?>>Conductor</option>
                                        <option value="3" <?php echo ($usuario['user_perfil'] == 3) ? 'selected' : ''; ?>>Auxiliar</option>
                                        <option value="4" <?php echo ($usuario['user_perfil'] == 4) ? 'selected' : ''; ?>>Admin-Operador</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Estado <span class="text-danger">*</span></label>
                                    <select class="form-select" name="user_activo" required>
                                        <option value="si" <?php echo ($usuario['user_activo'] == 'si') ? 'selected' : ''; ?>>Activo</option>
                                        <option value="no" <?php echo ($usuario['user_activo'] == 'no') ? 'selected' : ''; ?>>Inactivo</option>
                                    </select>
                                </div>
                            </div>
                            
                            <button type="submit" name="actualizar_usuario" class="btn btn-success">
                                <i class="fas fa-save"></i> Guardar Cambios
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Cambiar Contraseña -->
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header bg-dark text-white">
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

<?php 
$conexion->close();
include("includes/footer.php"); 
?>
</body>
</html>