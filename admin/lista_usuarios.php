<?php include("includes/header.php"); ?>
</head>
<body>
    <!-- Header Bar -->
<?php include("includes/menubar.php"); ?>
<?php include("../data/conexion.php"); ?>

<?php

// Procesar creación de nuevo usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['crear_usuario'])) {
    
    $dni = limpiarDato($_POST['dni_user']);
    $nombre = limpiarDato($_POST['nombre_user']);
    $nick = limpiarDato($_POST['user_nick']);
    $telefono = limpiarDato($_POST['user_telefono']);
    $cargo = limpiarDato($_POST['user_cargo']);
    $perfil = limpiarDato($_POST['user_perfil']);
    $clave = '123'; // Contraseña por defecto
    
    // Escapar datos
    $dni = $conexion->real_escape_string($dni);
    $nombre = $conexion->real_escape_string($nombre);
    $nick = $conexion->real_escape_string($nick);
    $telefono = $conexion->real_escape_string($telefono);
    $cargo = $conexion->real_escape_string($cargo);
    $perfil = $conexion->real_escape_string($perfil);
    $clave = $conexion->real_escape_string($clave);
    
    // Verificar si el DNI ya existe
    $sql_verificar = "SELECT * FROM usuarios WHERE user_dni = '$dni'";
    $resultado_verificar = $conexion->query($sql_verificar);
    
    if ($resultado_verificar->num_rows > 0) {
        echo "<script>alert('El DNI ya está registrado');</script>";
    } else {
        $sql_insert = "INSERT INTO usuarios (user_dni, user_nombre, user_nick, user_telefono, user_cargo, user_clave, user_perfil) 
                       VALUES ('$dni', '$nombre', '$nick', '$telefono', '$cargo', '$clave', '$perfil')";
        
        if ($conexion->query($sql_insert)) {
            echo "<script>alert('Usuario creado correctamente'); window.location.href='lista_usuarios.php';</script>";
        } else {
            echo "<script>alert('Error al crear usuario: " . $conexion->error . "');</script>";
        }
    }
}

// Procesar eliminación de usuario
if (isset($_GET['eliminar'])) {
    $id_eliminar = (int)$_GET['eliminar'];
    
    // Verificar que no se elimine a sí mismo
    if ($id_eliminar == $_SESSION['id_user']) {
        echo "<script>alert('No puedes eliminar tu propio usuario');</script>";
    } else {
        $sql_delete = "DELETE FROM usuarios WHERE id_user = $id_eliminar";
        
        if ($conexion->query($sql_delete)) {
            echo "<script>alert('Usuario eliminado correctamente'); window.location.href='lista_usuarios.php';</script>";
        } else {
            echo "<script>alert('Error al eliminar usuario');</script>";
        }
    }
}

// Procesar búsqueda
$busqueda = '';
$where_condition = '';

if (isset($_GET['buscar']) && !empty($_GET['buscar'])) {
    $busqueda = $conexion->real_escape_string($_GET['buscar']);
    $where_condition = "WHERE user_dni LIKE '%$busqueda%' 
                         OR user_nombre LIKE '%$busqueda%' 
                         OR user_nick LIKE '%$busqueda%'";
}

// Obtener lista de usuarios
$sql = "SELECT * FROM usuarios $where_condition ORDER BY id_user DESC";
$resultado = $conexion->query($sql);
?>

    <!-- Área de Contenido -->
    <div class="content-area">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="text-dark">Lista de Usuarios</h2>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevoUsuario">
                <i class="fas fa-plus"></i> Nuevo Usuario
            </button>
        </div>

        <!-- Sección de Búsqueda -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" class="row g-3 align-items-center">
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="text" class="form-control" name="buscar" placeholder="Buscar por DNI, nombre o nick..." value="<?php echo htmlspecialchars($busqueda); ?>">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <?php if (!empty($busqueda)): ?>
                            <a href="lista_usuarios.php" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> Limpiar búsqueda
                            </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
            
        <!-- Tabla de Usuarios -->
        <div class="card">
            <div class="card-body">
                <?php if (!empty($busqueda)): ?>
                    <div class="alert alert-info mb-3">
                        <i class="fas fa-info-circle"></i> 
                        Mostrando resultados para: "<strong><?php echo htmlspecialchars($busqueda); ?></strong>"
                        <span class="badge bg-primary ms-2"><?php echo $resultado->num_rows; ?> resultados</span>
                    </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>DNI</th>
                                <th>Nombre</th>
                                <th>Nick</th>
                                <th>Teléfono</th>
                                <th>Cargo</th>
                                <th>Perfil</th>
                                <th>Activo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($resultado->num_rows > 0) {
                                while ($usuario = $resultado->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($usuario['id_user']) . "</td>";
                                    echo "<td><img src='" . htmlspecialchars($usuario['user_avatar'] ?? 'img/user/user.jpg') . "' class='rounded-circle' width='40' height='40' alt='Avatar'></td>";
                                    echo "<td>" . htmlspecialchars($usuario['user_dni']) . "</td>";
                                    echo "<td>" . htmlspecialchars($usuario['user_nombre']) . "</td>";
                                    echo "<td>" . htmlspecialchars($usuario['user_nick'] ?? '') . "</td>";
                                    echo "<td>" . ($usuario['user_telefono'] ? htmlspecialchars($usuario['user_telefono']) : '<span class="text-muted">no registra</span>') . "</td>";
                                    echo "<td>" . htmlspecialchars($usuario['user_cargo'] ?? '') . "</td>";
                                    echo "<td><span class='badge bg-" . ($usuario['user_perfil'] == 1 ? 'danger' : ($usuario['user_perfil'] == 2 ? 'warning' : ($usuario['user_perfil'] == 3 ? 'info' : 'primary'))) . "'>" . htmlspecialchars($usuario['user_perfil']) . "</span></td>";
                                    echo "<td><span class='badge bg-" . ($usuario['user_activo'] == 'si' ? 'success' : 'secondary') . "'>" . htmlspecialchars($usuario['user_activo']) . "</span></td>";
                                    echo "<td>
                                            <a href='editar_usuario.php?id=" . $usuario['id_user'] . "' class='btn btn-sm btn-warning' title='Editar'>
                                                <i class='fas fa-edit'></i>
                                            </a>
                                            <a href='#' onclick='confirmarEliminacion(" . $usuario['id_user'] . ")' class='btn btn-sm btn-danger' title='Eliminar'>
                                                <i class='fas fa-trash'></i>
                                            </a>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                if (!empty($busqueda)) {
                                    echo "<tr><td colspan='10' class='text-center'>No se encontraron usuarios para: \"" . htmlspecialchars($busqueda) . "\"</td></tr>";
                                } else {
                                    echo "<tr><td colspan='10' class='text-center'>No hay usuarios registrados</td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo Usuario -->
    <div class="modal fade" id="modalNuevoUsuario" tabindex="-1" aria-labelledby="modalNuevoUsuarioLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="modalNuevoUsuarioLabel">
                        <i class="fas fa-user-plus"></i> Nuevo Usuario
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" class="text-dark text-lg">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">DNI <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="dni_user" required maxlength="9">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Nombre Completo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nombre_user" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Nick <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="user_nick" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="user_telefono">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Cargo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="user_cargo" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Perfil <span class="text-danger">*</span></label>
                            <select class="form-select" name="user_perfil" required>
                                <option value="">Seleccione...</option>
                                <option value="1">Administrador</option>
                                <option value="2">Conductor</option>
                                <option value="3">Auxiliar</option>
                                <option value="4">Admin-Operador</option>
                            </select>
                        </div>
                        
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> La contraseña por defecto es: <strong>123</strong>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" name="crear_usuario" class="btn btn-primary">
                            <i class="fas fa-save"></i> Crear Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmarEliminacion(id) {
            if (confirm('¿Está seguro que desea eliminar este usuario?')) {
                window.location.href = 'lista_usuarios.php?eliminar=' + id;
            }
        }
    </script>

<?php 
$conexion->close();
include("includes/footer.php"); 
?>
</body>
</html>