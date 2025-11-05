<?php include("includes/header.php"); ?>
<link rel="stylesheet" href="includes/style_unidades.css">
</head>
<body>
    <!-- Header Bar -->
<?php include("includes/menubar.php"); ?>
<?php include("../data/conexion.php"); ?>

    <!-- Área de Contenido -->
    <div class="content-area">
        <h2>Bienvenido, <?php echo htmlspecialchars($nombre_user); ?>!</h2>
        <p>Gestión de Unidades - Sistema Teletran</p>
        
        <!-- Controles superiores -->
        <div class="row mb-3">
            <div class="col-md-6">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevaUnidad">
                    <i class="fas fa-plus"></i> Nueva Unidad
                </button>
            </div>
            <div class="col-md-6 text-end">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-secondary" id="btnVistaTabla" onclick="cambiarVista('tabla')">
                        <i class="fas fa-table"></i> Tabla
                    </button>
                    <button type="button" class="btn btn-outline-secondary active" id="btnVistaCards" onclick="cambiarVista('cards')">
                        <i class="fas fa-th"></i> Tarjetas
                    </button>
                </div>
            </div>
        </div>

        <!-- Barra de Búsqueda -->
        <div class="row mb-3">
            <div class="col-md-12">
                <form method="GET" action="" class="d-flex">
                    <div class="input-group">
                        <input type="text" class="form-control" name="busqueda" placeholder="Buscar por placa, marca o capacidad..." value="<?php echo isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                        <?php if(isset($_GET['busqueda']) && !empty($_GET['busqueda'])): ?>
                        <a href="home_unidades.php" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i> Limpiar
                        </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <?php
        // Construir consulta con filtro de búsqueda
        $busqueda = "";
        $where_conditions = [];
        
        if(isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
            $busqueda = trim($_GET['busqueda']);
            $search_term = mysqli_real_escape_string($conexion, $busqueda);
            
            // Buscar en placa, marca y capacidad
            $where_conditions[] = "(vh_placa LIKE '%$search_term%' OR 
                                  vh_marca LIKE '%$search_term%' OR 
                                  vh_capacidad LIKE '%$search_term%')";
        }

        // Construir la consulta final
        $query = "SELECT * FROM unidades";
        if(!empty($where_conditions)) {
            $query .= " WHERE " . implode(" AND ", $where_conditions);
        }
        $query .= " ORDER BY id_vh DESC";
        
        $resultado = mysqli_query($conexion, $query);
        $total_resultados = mysqli_num_rows($resultado);
        ?>

        <!-- Mostrar resultados de búsqueda -->
        <?php if(isset($_GET['busqueda']) && !empty($_GET['busqueda'])): ?>
        <div class="alert alert-info mb-3">
            <i class="fas fa-info-circle"></i> 
            <?php echo $total_resultados; ?> resultado(s) encontrado(s) para: "<strong><?php echo htmlspecialchars($busqueda); ?></strong>"
        </div>
        <?php endif; ?>

        <!-- Vista de Tabla -->
        <div id="vistaTabla" style="display: none;">
            <?php if($total_resultados > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Avatar</th>
                            <th>Placa</th>
                            <th>Nickname</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Año</th>
                            <th>Capacidad</th>
                            <th>Activo</th>
                            <th>Disponible</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        mysqli_data_seek($resultado, 0); // Reiniciar puntero
                        while($unidad = mysqli_fetch_assoc($resultado)) {
                        ?>
                        <tr>
                            <td><img src="<?php echo htmlspecialchars($unidad['vh_avatar']); ?>" alt="Avatar" style="width: 40px; height: 40px; object-fit: cover; border-radius: 5px;"></td>
                            <td><?php echo htmlspecialchars($unidad['vh_placa']); ?></td>
                            <td><?php echo htmlspecialchars($unidad['vh_nick']); ?></td>
                            <td><?php echo htmlspecialchars($unidad['vh_marca']); ?></td>
                            <td><?php echo htmlspecialchars($unidad['vh_modelo']); ?></td>
                            <td><?php echo htmlspecialchars($unidad['vh_año']); ?></td>
                            <td><?php echo htmlspecialchars($unidad['vh_capacidad']); ?></td>
                            <td>
                                <span class="badge bg-<?php echo $unidad['vh_activo'] == 'si' ? 'success' : 'danger'; ?>">
                                    <?php echo strtoupper($unidad['vh_activo']); ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-<?php echo $unidad['vh_disponible'] == 'si' ? 'success' : 'warning'; ?>">
                                    <?php echo strtoupper($unidad['vh_disponible']); ?>
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info" onclick="verUnidad(<?php echo $unidad['id_vh']; ?>)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-warning" onclick="editarUnidad(<?php echo $unidad['id_vh']; ?>)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="eliminarUnidad(<?php echo $unidad['id_vh']; ?>, '<?php echo htmlspecialchars($unidad['vh_placa']); ?>')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="alert alert-warning text-center">
                <i class="fas fa-exclamation-triangle"></i> No se encontraron unidades que coincidan con la búsqueda.
            </div>
            <?php endif; ?>
        </div>

        <!-- Vista de Cards/Galería -->
        <div id="vistaCards">
            <?php if($total_resultados > 0): ?>
            <div class="row">
                <?php
                mysqli_data_seek($resultado, 0); // Reiniciar puntero
                while($unidad = mysqli_fetch_assoc($resultado)) {
                ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?php echo htmlspecialchars($unidad['vh_avatar']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($unidad['vh_nick']); ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($unidad['vh_nick']); ?></h5>
                            <p class="card-text mb-2">
                                <strong>Placa:</strong> <?php echo htmlspecialchars($unidad['vh_placa']); ?><br>
                                <strong>Marca:</strong> <?php echo htmlspecialchars($unidad['vh_marca']); ?><br>
                                <strong>Modelo:</strong> <?php echo htmlspecialchars($unidad['vh_modelo']); ?><br>
                                <strong>Año:</strong> <?php echo htmlspecialchars($unidad['vh_año']); ?>
                            </p>
                            <div class="mb-2">
                                <span class="badge bg-<?php echo $unidad['vh_activo'] == 'si' ? 'success' : 'danger'; ?>">
                                    <?php echo $unidad['vh_activo'] == 'si' ? 'Activo' : 'Inactivo'; ?>
                                </span>
                                <span class="badge bg-<?php echo $unidad['vh_disponible'] == 'si' ? 'success' : 'warning'; ?>">
                                    <?php echo $unidad['vh_disponible'] == 'si' ? 'Disponible' : 'No Disponible'; ?>
                                </span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="d-grid gap-2">
                                <button class="btn btn-sm btn-info" onclick="verUnidad(<?php echo $unidad['id_vh']; ?>)">
                                    <i class="fas fa-eye"></i> Ver
                                </button>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-warning" onclick="editarUnidad(<?php echo $unidad['id_vh']; ?>)">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="eliminarUnidad(<?php echo $unidad['id_vh']; ?>, '<?php echo htmlspecialchars($unidad['vh_placa']); ?>')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php else: ?>
            <div class="alert alert-warning text-center">
                <i class="fas fa-exclamation-triangle"></i> No se encontraron unidades que coincidan con la búsqueda.
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal Nueva Unidad -->
    <div class="modal fade" id="modalNuevaUnidad" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nueva Unidad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formNuevaUnidad" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Placa *</label>
                                <input type="text" class="form-control" name="vh_placa" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nickname *</label>
                                <input type="text" class="form-control" name="vh_nick" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Marca</label>
                                <input type="text" class="form-control" name="vh_marca">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Modelo</label>
                                <input type="text" class="form-control" name="vh_modelo">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Año</label>
                                <input type="number" class="form-control" name="vh_año">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Capacidad</label>
                                <input type="text" class="form-control" name="vh_capacidad">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Configuración</label>
                                <input type="text" class="form-control" name="vh_config">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Partida RRPP</label>
                                <input type="number" class="form-control" name="vh_Partidarrpp">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Avatar</label>
                                <input type="file" class="form-control" name="vh_avatar" accept="image/*">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tercero</label>
                                <select class="form-select" name="vh_tercero">
                                    <option value="no">No</option>
                                    <option value="si">Si</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Activo</label>
                                <select class="form-select" name="vh_activo">
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Disponible</label>
                                <select class="form-select" name="vh_disponible">
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Unidad</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Ver Unidad -->
    <div class="modal fade" id="modalVerUnidad" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalles de la Unidad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="contenidoVerUnidad">
                    <!-- Contenido cargado dinámicamente -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Unidad -->
    <div class="modal fade" id="modalEditarUnidad" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Unidad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="contenidoEditarUnidad">
                    <!-- Contenido cargado dinámicamente -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Función para cambiar entre vistas
        function cambiarVista(vista) {
            if (vista === 'tabla') {
                document.getElementById('vistaTabla').style.display = 'block';
                document.getElementById('vistaCards').style.display = 'none';
                document.getElementById('btnVistaTabla').classList.add('active');
                document.getElementById('btnVistaCards').classList.remove('active');
                localStorage.setItem('vistaUnidades', 'tabla');
            } else {
                document.getElementById('vistaTabla').style.display = 'none';
                document.getElementById('vistaCards').style.display = 'block';
                document.getElementById('btnVistaCards').classList.add('active');
                document.getElementById('btnVistaTabla').classList.remove('active');
                localStorage.setItem('vistaUnidades', 'cards');
            }
        }

        // Cargar vista guardada al iniciar
        window.onload = function() {
            const vistaGuardada = localStorage.getItem('vistaUnidades') || 'cards';
            cambiarVista(vistaGuardada);
        };

        // Función para ver unidad
        function verUnidad(id) {
            fetch('ajax/ver_unidad.php?id=' + id)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('contenidoVerUnidad').innerHTML = data;
                    new bootstrap.Modal(document.getElementById('modalVerUnidad')).show();
                })
                .catch(error => console.error('Error:', error));
        }

        // Función para editar unidad
        function editarUnidad(id) {
            fetch('ajax/editar_unidad.php?id=' + id)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('contenidoEditarUnidad').innerHTML = data;
                    new bootstrap.Modal(document.getElementById('modalEditarUnidad')).show();
                })
                .catch(error => console.error('Error:', error));
        }

        // Función para eliminar unidad
        function eliminarUnidad(id, placa) {
            if (confirm('¿Está seguro de eliminar la unidad con placa ' + placa + '?')) {
                fetch('ajax/eliminar_unidad.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + id
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Unidad eliminada correctamente');
                        location.reload();
                    } else {
                        alert('Error al eliminar: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al eliminar la unidad');
                });
            }
        }

        // Enviar formulario nueva unidad
        document.getElementById('formNuevaUnidad').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('ajax/guardar_unidad.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Unidad guardada correctamente');
                    location.reload();
                } else {
                    alert('Error al guardar: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al guardar la unidad');
            });
        });
    </script>

<?php include("includes/footer.php"); ?>

</body>
</html>