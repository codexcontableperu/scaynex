<?php include("includes/header.php"); ?>
</head>
<body>
    <!-- Header Bar -->
    <?php include("includes/menubar.php"); ?>
    <?php include("../data/conexion.php"); ?>

    <?php
    // Procesar SQL personalizado
    $resultado_sql = null;
    $mensaje = '';
    $sql_ejecutado = '';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ejecutar_sql'])) {
        $sql_personalizado = trim($_POST['sql_personalizado']);
        $sql_ejecutado = $sql_personalizado;
        
        if (!empty($sql_personalizado)) {
            try {
                // Verificar que sea una consulta INSERT
                if (stripos($sql_personalizado, 'INSERT') === 0) {
                    $resultado_sql = $conexion->query($sql_personalizado);
                    if ($resultado_sql) {
                        $mensaje = "<div class='alert alert-success'>✅ SQL ejecutado correctamente. Registros insertados: " . $conexion->affected_rows . "</div>";
                    } else {
                        $mensaje = "<div class='alert alert-danger'>❌ Error en SQL: " . $conexion->error . "</div>";
                    }
                } else {
                    $mensaje = "<div class='alert alert-warning'>⚠️ Solo se permiten consultas INSERT para la tabla rd_segimientos_head</div>";
                }
            } catch (Exception $e) {
                $mensaje = "<div class='alert alert-danger'>❌ Error: " . $e->getMessage() . "</div>";
            }
        } else {
            $mensaje = "<div class='alert alert-warning'>⚠️ Por favor ingrese una consulta SQL</div>";
        }
    }
    ?>

    <!-- Área de Contenido -->
    <div class="content-area">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>Asistente SQL Inteligente</h2>
                <p class="text-white">Ejecuta consultas INSERT para la tabla rd_segimientos_head</p>
            </div>
        </div>




        <!-- Formulario SQL -->
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="fas fa-database"></i> Ejecutar SQL Personalizado
                </h5>
            </div>
            <div class="card-body">
                <?php echo $mensaje; ?>
                
                <form method="POST" id="formSQL">
                    <div class="mb-3">
                        <label class="form-label">Consulta INSERT para rd_segimientos_head</label>
                        <textarea class="form-control" name="sql_personalizado" rows="10" 
                                  placeholder="INSERT INTO rd_segimientos_head (S_FECHA, PLACA, CONDUCTOR, EMPRESA, TIPO_DESPACHO, H_CITA, ESTADO_IDP) VALUES (...);" 
                                  style="font-family: 'Courier New', monospace; font-size: 14px;"><?php echo htmlspecialchars($sql_ejecutado); ?></textarea>
                        <small class="text-muted">
                            <i class="fas fa-info-circle"></i> Solo se permiten consultas INSERT. Ejecuta múltiples INSERT separados por punto y coma.
                        </small>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-info me-md-2" onclick="cargarEjemplo()">
                            <i class="fas fa-code"></i> Cargar Ejemplo
                        </button>
                        <button type="submit" name="ejecutar_sql" class="btn btn-success">
                            <i class="fas fa-play"></i> Ejecutar SQL
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Información de la Tabla -->
        <div class="card mt-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="fas fa-table"></i> Estructura de rd_segimientos_head
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Campo</th>
                                <th>Tipo</th>
                                <th>Null</th>
                                <th>Default</th>
                                <th>Comentario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>Id_SERG</td><td>int</td><td>NO</td><td>AUTO_INCREMENT</td><td>ID principal</td></tr>
                            <tr><td>S_FECHA</td><td>date</td><td>YES</td><td>NULL</td><td>Fecha de servicio</td></tr>
                            <tr><td>PLACA</td><td>varchar(10)</td><td>YES</td><td>NULL</td><td>Placa del vehículo</td></tr>
                            <tr><td>CONDUCTOR</td><td>varchar(60)</td><td>YES</td><td>NULL</td><td>Nombre del conductor</td></tr>
                            <tr><td>EMPRESA</td><td>varchar(100)</td><td>YES</td><td>NULL</td><td>Empresa cliente</td></tr>
                            <tr><td>TIPO_DESPACHO</td><td>varchar(20)</td><td>NO</td><td></td><td>EXCLUSIVO/RUTA</td></tr>
                            <tr><td>H_CITA</td><td>time</td><td>YES</td><td>NULL</td><td>Hora de cita</td></tr>
                            <tr><td>ESTADO_IDP</td><td>int</td><td>NO</td><td>0</td><td>0=Programado, 1=Salida base, 2=En almacén, 3=En ruta, 4=Fin servicio</td></tr>
                        </tbody>
                    </table>
                </div>
                <small class="text-muted">Tabla completa con 35 campos. Solo se muestran los principales.</small>
            </div>
        </div>
    </div>


        <!-- Sección de ChatGPT Embebido -->


<div class="card p-3 shadow-sm">
  <h5>Asistente IA SQL</h5>
  <p>Explora la conversación en ChatGPT.</p>
  <a href="https://chatgpt.com/share/68fd8501-260c-8002-b6b4-1f8221fb617d" target="_blank">Ver conversación</a>
</div>













    <style>
        .embed-responsive {
            position: relative;
            display: block;
            width: 100%;
            padding: 0;
            overflow: hidden;
        }
        
        .embed-responsive-16by9::before {
            padding-top: 56.25%;
        }
        
        .embed-responsive-item {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
        
        textarea {
            resize: vertical;
            min-height: 200px;
        }
        
        .table th {
            font-size: 0.85rem;
        }
        
        .table td {
            font-size: 0.8rem;
        }
    </style>

    <script>
        function cargarEjemplo() {
            const ejemploSQL = `INSERT INTO rd_segimientos_head (
    S_FECHA, PLACA, CONDUCTOR, AUXILIAR1, SUPERVISOR, 
    TIPO_DESPACHO, EMPRESA, CUENTA, CLIENTE_FINAL,
    H_CITA, H_CITA_R, TEMPERATURA, CAPACIDAD_VEHICULO,
    ESTADO_IDP, PENDIENTE
) VALUES 
('2024-10-25', 'ABC123', 'JUAN PEREZ', 'CARLOS LOPEZ', 'GREGORI', 
 'EXCLUSIVO', 'GSK', 'GSK', 'FARMACIA CENTRAL',
 '08:00:00', '06:00:00', 'CLIMATIZADO 15-25°', '1.5 TN', 0, 1),
 
('2024-10-25', 'XYZ789', 'MARIA GARCIA', 'LUIS MARTINEZ', 'GREGORI',
 'RUTA', 'SANOFI', 'SANOFI', 'DISTRIBUIDORA NORTE',
 '09:30:00', '07:00:00', 'SECO', '2 TN', 0, 1);`;

            document.querySelector('textarea[name="sql_personalizado"]').value = ejemploSQL;
        }

        // Auto-ajustar altura del textarea
        document.querySelector('textarea[name="sql_personalizado"]').addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        // Prevenir envío con Ctrl+Enter
        document.querySelector('textarea[name="sql_personalizado"]').addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'Enter') {
                document.getElementById('formSQL').submit();
            }
        });

        // Cargar ejemplo al cargar la página si está vacío
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.querySelector('textarea[name="sql_personalizado"]');
            if (textarea.value.trim() === '') {
                cargarEjemplo();
            }
        });
    </script>

    <?php
    $conexion->close();
    include("includes/footer.php"); 
    ?>
</body>
</html>