<?php
// home_asistencia.php (con offcanvas exclusivo para marcados especiales)
session_start();

// Configuración de sesión (si no existen)
if (!isset($_SESSION['empresa'])) {
    $_SESSION['empresa'] = 1;
}
if (!isset($_SESSION['rango_marcado'])) {
    $_SESSION['rango_marcado'] = 200;
}

// Config DB
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'icemnet');
define('DB_CHARSET', 'utf8mb4');

// Endpoint AJAX: validar DNI
if (isset($_GET['action']) && $_GET['action'] === 'validar_dni') {
    header('Content-Type: application/json; charset=utf-8');
    $dni = isset($_GET['dni']) ? trim($_GET['dni']) : '';
    if ($dni === '') {
        echo json_encode(['ok' => false, 'msg' => 'DNI vacío']);
        exit;
    }
    $mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($mysqli->connect_errno) {
        echo json_encode(['ok' => false, 'msg' => 'Error de conexión']);
        exit;
    }
    $mysqli->set_charset(DB_CHARSET);

    $sql = "SELECT id_user, dni_user, nombre_user FROM usuarios WHERE dni_user = ? AND estado_user = 'activo' LIMIT 1";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $dni);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        echo json_encode([
            'ok' => true,
            'user' => [
                'id_user' => (int)$row['id_user'],
                'dni_user' => $row['dni_user'],
                'nombre_user' => $row['nombre_user'],
            ]
        ]);
    } else {
        echo json_encode(['ok' => false, 'msg' => 'DNI no encontrado o usuario inactivo']);
    }
    $stmt->close();
    $mysqli->close();
    exit;
}

// Endpoint AJAX: obtener sucursales activas
if (isset($_GET['action']) && $_GET['action'] === 'obtener_sucursales') {
    header('Content-Type: application/json; charset=utf-8');
    $id_empresa = $_SESSION['empresa'];
    
    $mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($mysqli->connect_errno) {
        echo json_encode(['ok' => false, 'msg' => 'Error de conexión']);
        exit;
    }
    $mysqli->set_charset(DB_CHARSET);

    $sql = "SELECT id_ubicacion, nombre_sucursal, latitud, longitud 
            FROM sucursales 
            WHERE id_empresa = ? AND estado = 'activo'";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $id_empresa);
    $stmt->execute();
    $res = $stmt->get_result();
    
    $sucursales = [];
    while ($row = $res->fetch_assoc()) {
        $sucursales[] = [
            'id' => (int)$row['id_ubicacion'],
            'nombre' => $row['nombre_sucursal'],
            'lat' => (float)$row['latitud'],
            'lng' => (float)$row['longitud']
        ];
    }
    
    echo json_encode([
        'ok' => true,
        'sucursales' => $sucursales,
        'rango' => $_SESSION['rango_marcado']
    ]);
    
    $stmt->close();
    $mysqli->close();
    exit;
}

// Endpoint AJAX: obtener marcaciones del día
if (isset($_GET['action']) && $_GET['action'] === 'obtener_marcaciones') {
    header('Content-Type: application/json; charset=utf-8');
    $id_user = isset($_GET['id_user']) ? (int)$_GET['id_user'] : 0;
    
    if ($id_user <= 0) {
        echo json_encode(['ok' => false, 'msg' => 'ID de usuario inválido']);
        exit;
    }
    
    $mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($mysqli->connect_errno) {
        echo json_encode(['ok' => false, 'msg' => 'Error de conexión']);
        exit;
    }
    $mysqli->set_charset(DB_CHARSET);

    $fecha_hoy = date('Y-m-d');
    $sql = "SELECT ID_ASISTENCIA, TIPO_MARCADO, HORA_MARCADO, LATITUD, LONGITUD, 
                   DISTANCIA_METROS, DISPOSITIVO, OBSERVACIONES
            FROM registro_asistencia 
            WHERE ID_USER = ? AND FECHA_MARCADO = ?
            ORDER BY HORA_MARCADO ASC";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('is', $id_user, $fecha_hoy);
    $stmt->execute();
    $res = $stmt->get_result();
    
    $marcaciones = [];
    while ($row = $res->fetch_assoc()) {
        $marcaciones[] = [
            'id' => (int)$row['ID_ASISTENCIA'],
            'tipo' => $row['TIPO_MARCADO'],
            'hora' => $row['HORA_MARCADO'],
            'latitud' => (float)$row['LATITUD'],
            'longitud' => (float)$row['LONGITUD'],
            'distancia' => (int)$row['DISTANCIA_METROS'],
            'dispositivo' => $row['DISPOSITIVO'],
            'observaciones' => $row['OBSERVACIONES']
        ];
    }
    
    echo json_encode([
        'ok' => true,
        'marcaciones' => $marcaciones
    ]);
    
    $stmt->close();
    $mysqli->close();
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registro de Asistencia</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="/ICEMNET/asistencia/asistencia.css" rel="stylesheet">
<style>
  body {
    min-height: 100vh;
    display: grid;
    place-items: center;
    background: linear-gradient(135deg, #eef2f7, #dfe7f3);
    font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    text-size-adjust: 100%;
    -webkit-text-size-adjust: 100%;
  }
  .btn-marcacion {
    width: 120px;
    height: 100px;
    border-radius: 16px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.75rem;
    font-weight: 600;
    border: none;
    transition: all 0.2s ease;
  }
  .btn-marcacion i {
    font-size: 1.5rem;
  }
  .btn-marcacion.sin-registro {
    background: #6c757d;
    color: white;
  }
  .btn-marcacion.con-registro {
    color: white;
  }
  .btn-marcacion.entrada {
    background: #6366f1;
  }
  .btn-marcacion.inicio-break {
    background: #f59e0b;
  }
  .btn-marcacion.fin-break {
    background: #10b981;
  }
  .btn-marcacion.salida {
    background: #b6b52d;
  }
  .btn-marcacion.especial {
    background: #06b6d4;
  }
  .btn-marcacion:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  }
  .hora-marcacion {
    font-size: 0.85rem;
    font-weight: bold;
  }
  .marcaciones-container {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 1.5rem;
    padding: 1rem;
    background: white;
    border-radius: 12px;
  }
  .btn-ubicacion {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
  }
  .tabla-marcados-especiales {
    width: 100%;
    font-size: 0.9rem;
  }
  .tabla-marcados-especiales th {
    background: #f8f9fa;
    font-weight: 600;
    padding: 0.75rem 0.5rem;
  }
  .tabla-marcados-especiales td {
    padding: 0.75rem 0.5rem;
    vertical-align: middle;
  }
</style>
</head>
<body>

<div class="search-box">
  <h1 class="h4 mb-2">Registro de asistencia</h1>
  <p class="text-muted mb-4">Ingresa tu DNI para marcar</p>

  <div class="mb-3">
    <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="20" class="form-control google-input" id="dniInput" placeholder="Escribe tu DNI">
  </div>
  <div class="d-grid gap-2">
    <button id="btnMarcar" class="btn btn-primary mark-btn" disabled>Marcar</button>
    <div class="small-muted">
      <a href="#" id="btnVerUbicacion" class="btn btn-sm btn-outline-secondary btn-ubicacion" target="_blank" style="display: none;">
        <i class="bi bi-geo-alt-fill"></i> Ver ubicación
      </a>
    </div>
    <div class="small-muted">
      Sucursal: <span id="sucursalDetectada">detectando…</span>
    </div>
  </div>

  <div id="msg" class="mt-3 small"></div>

  <?php if (isset($_GET['ok'])): ?>
    <div class="alert alert-<?php echo ($_GET['ok'] ? 'success' : 'danger'); ?> mt-3 py-2">
      <?php echo htmlspecialchars($_GET['msg'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
    </div>
  <?php endif; ?>

  <!-- Sección de marcaciones realizadas hoy -->
  <div id="marcacionesHoy" class="marcaciones-container" style="display: none;">
    <h6 class="w-100 text-center text-muted mb-3">Marcaciones realizadas hoy</h6>
    <div id="botonesContainer" class="d-flex gap-3 flex-wrap justify-content-center">
      <!-- Botones se generan dinámicamente -->
    </div>
  </div>
</div>

<!-- Modal de tipos de marcado (para marcado especial) -->
<div class="modal fade" id="marcadoModal" tabindex="-1" aria-labelledby="marcadoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="formMarcado" method="post" action="/ICEMNET/asistencia/marcado.php">
        <div class="modal-header">
          <h5 class="modal-title" id="marcadoModalLabel">Marcado Especial</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-2">
            <div class="text-muted">Usuario:</div>
            <div id="subtituloUsuario" class="fw-semibold"></div>
          </div>
          <div class="mb-3">
            <div class="text-muted small">Sucursal:</div>
            <div id="subtituloSucursal" class="fw-semibold text-primary"></div>
          </div>

          <!-- Campos ocultos para backend -->
          <input type="hidden" name="id_user" id="id_user">
          <input type="hidden" name="tipo_marcado" id="tipo_marcado" value="Especial">
          <input type="hidden" name="latlon" id="latlon">
          <input type="hidden" name="dispositivo" id="dispositivo">
          <input type="hidden" id="latitud" name="latitud">
          <input type="hidden" id="longitud" name="longitud">
          <input type="hidden" id="centro_labores" name="centro_labores">
          <input type="hidden" id="distancia_metros" name="distancia_metros">

          <div class="mb-3">
            <label for="motivo" class="form-label">Motivo (opcional)</label>
            <input type="text" class="form-control" id="motivo" name="motivo" maxlength="255" placeholder="Ej: Permiso médico, comisión, etc.">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Confirmar marcado</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal de permisos denegados -->
<div class="modal fade" id="permisosModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">🔒 Permisos de ubicación bloqueados</h5>
      </div>
      <div class="modal-body">
        <div class="text-center icono-grande">📍</div>
        <p class="text-center mb-3"><strong>No podemos acceder a tu ubicación porque los permisos están bloqueados.</strong></p>
        
        <div class="instrucciones">
          <p class="mb-2"><strong>Para habilitar los permisos, sigue estos pasos:</strong></p>
          
          <div id="instruccionesChrome">
            <p class="mb-1"><strong>Google Chrome / Microsoft Edge:</strong></p>
            <ol>
              <li>Haz clic en el <strong>icono de candado 🔒</strong> o <strong>información ℹ️</strong> en la barra de direcciones (izquierda de la URL)</li>
              <li>Busca la opción <strong>"Ubicación"</strong></li>
              <li>Cambia de <strong>"Bloquear"</strong> a <strong>"Permitir"</strong></li>
              <li>Haz clic en el botón <strong>"Recargar"</strong> abajo</li>
            </ol>
          </div>

          <div id="instruccionesFirefox" class="d-none">
            <p class="mb-1"><strong>Mozilla Firefox:</strong></p>
            <ol>
              <li>Haz clic en el <strong>icono de candado 🔒</strong> en la barra de direcciones</li>
              <li>Haz clic en <strong>"Conexión segura"</strong> → <strong>"Más información"</strong></li>
              <li>Ve a la pestaña <strong>"Permisos"</strong></li>
              <li>Busca <strong>"Acceder a su ubicación"</strong> y desmarca <strong>"Usar valores predeterminados"</strong></li>
              <li>Marca <strong>"Permitir"</strong></li>
              <li>Cierra y haz clic en <strong>"Recargar"</strong> abajo</li>
            </ol>
          </div>

          <div id="instruccionesSafari" class="d-none">
            <p class="mb-1"><strong>Safari (Mac):</strong></p>
            <ol>
              <li>Ve a <strong>Safari</strong> → <strong>Preferencias</strong> (o Configuración)</li>
              <li>Haz clic en la pestaña <strong>"Sitios web"</strong></li>
              <li>Selecciona <strong>"Ubicación"</strong> en el menú izquierdo</li>
              <li>Busca este sitio y cambia a <strong>"Permitir"</strong></li>
              <li>Cierra y haz clic en <strong>"Recargar"</strong> abajo</li>
            </ol>
          </div>

          <div id="instruccionesMobile" class="d-none">
            <p class="mb-1"><strong>Navegador móvil (Android/iOS):</strong></p>
            <ol>
              <li>Toca el <strong>icono de menú</strong> (tres puntos) en el navegador</li>
              <li>Ve a <strong>"Configuración del sitio"</strong> o <strong>"Permisos"</strong></li>
              <li>Busca <strong>"Ubicación"</strong></li>
              <li>Cambia a <strong>"Permitir"</strong></li>
              <li>Vuelve y toca <strong>"Recargar"</strong> abajo</li>
            </ol>
          </div>

          <p class="mt-3 mb-0 text-muted small">💡 <em>Después de cambiar los permisos, debes recargar la página para que surtan efecto.</em></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnRecargar" class="btn btn-primary">🔄 Recargar página</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal de fuera de rango -->
<div class="modal fade" id="fueraRangoModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title">⚠️ Fuera de rango</h5>
      </div>
      <div class="modal-body text-center">
        <div class="icono-grande">📍</div>
        <p><strong>No puedes marcar asistencia desde esta ubicación.</strong></p>
        <p class="text-muted">Debes estar dentro del rango de <?php echo $_SESSION['rango_marcado']; ?> metros de alguna sucursal de la empresa.</p>
        <div id="distanciaMasCercana" class="alert alert-info mt-3"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Offcanvas para detalles de marcaciones normales -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDetalles" aria-labelledby="offcanvasDetallesLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasDetallesLabel">Detalles de Marcación</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div id="detallesMarcaciones">
      <!-- Se llena dinámicamente -->
    </div>
  </div>
</div>

<!-- Offcanvas exclusivo para marcados especiales -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMarcadosEspeciales" aria-labelledby="offcanvasMarcadosEspecialesLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasMarcadosEspecialesLabel">Marcados Especiales</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div id="tablaMarcadosEspeciales">
      <!-- Tabla se llena dinámicamente -->
    </div>
    <div class="d-grid gap-2 mt-3">
      <button type="button" id="btnNuevoMarcadoEspecial" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nuevo Marcado Especial
      </button>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// ===============================
// Variables globales
// ===============================
let CONST_LATITUD  = null;
let CONST_LONGITUD = null;
let SUCURSALES = [];
let RANGO_PERMITIDO = 200;
let SUCURSAL_DETECTADA = null;
let DISTANCIA_CALCULADA = null;
let USUARIO_ACTUAL = null;
let MARCACIONES_HOY = [];

// Detección de dispositivo
function detectarDispositivo() {
  const ua = navigator.userAgent.toLowerCase();
  return /android|iphone|ipad|ipod|windows phone|mobile/.test(ua) ? 'movil' : 'pc';
}
document.getElementById('dispositivo').value = detectarDispositivo();

// Detección de navegador
function detectarNavegador() {
  const ua = navigator.userAgent.toLowerCase();
  if (ua.indexOf('firefox') > -1) return 'firefox';
  if (ua.indexOf('safari') > -1 && ua.indexOf('chrome') === -1) return 'safari';
  if (/android|iphone|ipad|ipod/.test(ua)) return 'mobile';
  return 'chrome';
}

function mostrarInstruccionesNavegador() {
  const navegador = detectarNavegador();
  document.getElementById('instruccionesChrome').classList.add('d-none');
  document.getElementById('instruccionesFirefox').classList.add('d-none');
  document.getElementById('instruccionesSafari').classList.add('d-none');
  document.getElementById('instruccionesMobile').classList.add('d-none');
  
  if (navegador === 'firefox') {
    document.getElementById('instruccionesFirefox').classList.remove('d-none');
  } else if (navegador === 'safari') {
    document.getElementById('instruccionesSafari').classList.remove('d-none');
  } else if (navegador === 'mobile') {
    document.getElementById('instruccionesMobile').classList.remove('d-none');
  } else {
    document.getElementById('instruccionesChrome').classList.remove('d-none');
  }
}

// Modales
const permisosModal = new bootstrap.Modal(document.getElementById('permisosModal'), {
  backdrop: 'static',
  keyboard: false
});

const fueraRangoModal = new bootstrap.Modal(document.getElementById('fueraRangoModal'), {
  backdrop: 'static',
  keyboard: false
});

const marcadoModal = new bootstrap.Modal(document.getElementById('marcadoModal'));
const offcanvasDetalles = new bootstrap.Offcanvas(document.getElementById('offcanvasDetalles'));
const offcanvasMarcadosEspeciales = new bootstrap.Offcanvas(document.getElementById('offcanvasMarcadosEspeciales'));

document.getElementById('btnRecargar').addEventListener('click', () => {
  location.reload();
});

// Botón para nuevo marcado especial desde offcanvas
document.getElementById('btnNuevoMarcadoEspecial').addEventListener('click', () => {
  offcanvasMarcadosEspeciales.hide();
  marcadoModal.show();
});

// ===============================
// Fórmula de Haversine
// ===============================
function calcularDistancia(lat1, lon1, lat2, lon2) {
  const R = 6371000;
  const dLat = (lat2 - lat1) * Math.PI / 180;
  const dLon = (lon2 - lon1) * Math.PI / 180;
  const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
            Math.sin(dLon/2) * Math.sin(dLon/2);
  const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
  return R * c;
}

// ===============================
// Cargar sucursales
// ===============================
async function cargarSucursales() {
  try {
    const resp = await fetch('home_asistencia.php?action=obtener_sucursales');
    const data = await resp.json();
    if (data.ok) {
      SUCURSALES = data.sucursales;
      RANGO_PERMITIDO = data.rango;
    }
  } catch (e) {
    console.error('Error al cargar sucursales:', e);
  }
}

// ===============================
// Detectar sucursal cercana
// ===============================
function detectarSucursalCercana(latUsuario, lngUsuario) {
  if (SUCURSALES.length === 0) {
    return { dentroRango: false, sucursal: null, distancia: null };
  }

  let sucursalMasCercana = null;
  let distanciaMinima = Infinity;

  SUCURSALES.forEach(sucursal => {
    const distancia = calcularDistancia(latUsuario, lngUsuario, sucursal.lat, sucursal.lng);
    if (distancia < distanciaMinima) {
      distanciaMinima = distancia;
      sucursalMasCercana = sucursal;
    }
  });

  const dentroRango = distanciaMinima <= RANGO_PERMITIDO;

  return {
    dentroRango: dentroRango,
    sucursal: sucursalMasCercana,
    distancia: Math.round(distanciaMinima)
  };
}

// ===============================
// Verificar permisos
// ===============================
async function verificarYObtenerUbicacion() {
  const btnMarcar = document.getElementById('btnMarcar');

  if (navigator.permissions && navigator.permissions.query) {
    try {
      const permissionStatus = await navigator.permissions.query({ name: 'geolocation' });
      
      if (permissionStatus.state === 'denied') {
        btnMarcar.disabled = true;
        mostrarInstruccionesNavegador();
        permisosModal.show();
        return;
      }
      
      if (permissionStatus.state === 'granted') {
        obtenerUbicacion();
        return;
      }
      
      if (permissionStatus.state === 'prompt') {
        obtenerUbicacion();
        return;
      }
      
      permissionStatus.onchange = function() {
        if (this.state === 'granted') {
          location.reload();
        }
      };
      
    } catch (error) {
      obtenerUbicacion();
    }
  } else {
    obtenerUbicacion();
  }
}

function obtenerUbicacion() {
  const btnMarcar = document.getElementById('btnMarcar');
  
  if (!navigator.geolocation) {
    alert("La geolocalización no es compatible con este navegador.");
    btnMarcar.disabled = true;
    return;
  }
  
  navigator.geolocation.getCurrentPosition(mostrarUbicacion, mostrarError, {
    enableHighAccuracy: true,
    timeout: 10000,
    maximumAge: 0
  });
}

function mostrarUbicacion(posicion) {
  CONST_LATITUD  = posicion.coords.latitude;
  CONST_LONGITUD = posicion.coords.longitude;
  
  // Llenar inputs ocultos
  document.getElementById('latitud').value  = CONST_LATITUD;
  document.getElementById('longitud').value = CONST_LONGITUD;
  document.getElementById('latlon').value   = CONST_LATITUD.toFixed(6) + ',' + CONST_LONGITUD.toFixed(6);
  
  // Mostrar botón de ver ubicación
  const btnVerUbicacion = document.getElementById('btnVerUbicacion');
  btnVerUbicacion.href = `https://www.google.com/maps/@${CONST_LATITUD},${CONST_LONGITUD},18z`;
  btnVerUbicacion.style.display = 'inline-flex';
  
  // Detectar sucursal cercana
  const resultado = detectarSucursalCercana(CONST_LATITUD, CONST_LONGITUD);
  
  if (resultado.dentroRango) {
    SUCURSAL_DETECTADA = resultado.sucursal;
    DISTANCIA_CALCULADA = resultado.distancia;
    
    document.getElementById('sucursalDetectada').textContent = 
      `${resultado.sucursal.nombre} (${resultado.distancia}m)`;
    document.getElementById('sucursalDetectada').className = 'text-success fw-bold';
    
    document.getElementById('centro_labores').value = resultado.sucursal.id;
    document.getElementById('distancia_metros').value = resultado.distancia;
    
    document.getElementById('btnMarcar').disabled = false;
  } else {
    document.getElementById('sucursalDetectada').textContent = 
      `⚠️ Fuera de rango (${resultado.distancia}m de ${resultado.sucursal.nombre})`;
    document.getElementById('sucursalDetectada').className = 'text-danger fw-bold';
    
    document.getElementById('btnMarcar').disabled = true;
    
    document.getElementById('distanciaMasCercana').innerHTML = 
      `<strong>Sucursal más cercana:</strong><br>${resultado.sucursal.nombre}<br>Distancia: ${resultado.distancia} metros<br>Rango permitido: ${RANGO_PERMITIDO} metros`;
    fueraRangoModal.show();
  }
}

function mostrarError(error) {
  const btnMarcar = document.getElementById('btnMarcar');
  
  let msg = '';
  switch(error.code) {
    case error.PERMISSION_DENIED:
      msg = "Has denegado el permiso de ubicación.";
      btnMarcar.disabled = true;
      mostrarInstruccionesNavegador();
      permisosModal.show();
      break;
    case error.POSITION_UNAVAILABLE:
      msg = "La información de ubicación no está disponible.";
      break;
    case error.TIMEOUT:
      msg = "La solicitud para obtener la ubicación ha caducado.";
      break;
    case error.UNKNOWN_ERROR:
      msg = "Ha ocurrido un error desconocido.";
      break;
  }
  alert(msg);
}

// ===============================
// Cargar marcaciones del día
// ===============================
async function cargarMarcacionesDelDia(idUser) {
  try {
    const resp = await fetch(`home_asistencia.php?action=obtener_marcaciones&id_user=${idUser}`);
    const data = await resp.json();
    if (data.ok) {
      MARCACIONES_HOY = data.marcaciones;
      mostrarBotonesMarcaciones();
    }
  } catch (e) {
    console.error('Error al cargar marcaciones:', e);
  }
}

// ===============================
// Mostrar botones de marcaciones
// ===============================
function mostrarBotonesMarcaciones() {
  const tipos = [
    { key: 'Entrada', icon: 'bi-clock', label: 'Ingreso Laboral', clase: 'entrada' },
    { key: 'Inicio Break', icon: 'bi-cup-hot', label: 'Salida Refrigerio', clase: 'inicio-break' },
    { key: 'Fin Break', icon: 'bi-arrow-repeat', label: 'Reingreso', clase: 'fin-break' },
    { key: 'Salida', icon: 'bi-door-open', label: 'Salida Laboral', clase: 'salida' },
    { key: 'Especial', icon: 'bi-clipboard-check', label: 'Marcado Especial', clase: 'especial' }
  ];

  const container = document.getElementById('botonesContainer');
  container.innerHTML = '';

  tipos.forEach(tipo => {
    // Para marcados especiales, buscar TODOS los registros
    const marcaciones = MARCACIONES_HOY.filter(m => m.tipo === tipo.key);
    const tieneRegistro = marcaciones.length > 0;
    
    // Para tipos normales, solo el primero
    const marcacion = marcaciones[0];

    const btn = document.createElement('button');
    btn.className = `btn btn-marcacion ${tieneRegistro ? 'con-registro ' + tipo.clase : 'sin-registro'}`;
    btn.type = 'button';
    
    btn.innerHTML = `
      <i class="bi ${tipo.icon}"></i>
      <div>${tipo.label}</div>
      <div class="hora-marcacion">${tieneRegistro ? marcacion.hora.substring(0, 5) : '00:00'}</div>
    `;

    if (tipo.key === 'Especial') {
      // Comportamiento especial para marcados especiales
      if (tieneRegistro) {
        // Si tiene registros, abre offcanvas con tabla
        btn.addEventListener('click', () => {
          mostrarTablaMarcadosEspeciales(marcaciones);
        });
      } else {
        // Si no tiene registros, abre modal directamente
        btn.addEventListener('click', () => {
          marcadoModal.show();
        });
      }
    } else {
      // Comportamiento normal para otros tipos
      if (tieneRegistro) {
        btn.addEventListener('click', () => {
          mostrarDetallesMarcacion(marcacion);
        });
      } else {
        btn.addEventListener('click', () => {
          document.getElementById('tipo_marcado').value = tipo.key;
          document.getElementById('formMarcado').submit();
        });
      }
    }

    container.appendChild(btn);
  });

  document.getElementById('marcacionesHoy').style.display = 'block';
}

// ===============================
// Mostrar tabla de marcados especiales
// ===============================
function mostrarTablaMarcadosEspeciales(marcaciones) {
  const tabla = document.getElementById('tablaMarcadosEspeciales');
  
  let html = `
    <table class="table table-striped tabla-marcados-especiales">
      <thead>
        <tr>
          <th>Hora</th>
          <th>Observaciones</th>
          <th>Ubicación</th>
        </tr>
      </thead>
      <tbody>
  `;
  
  marcaciones.forEach(m => {
    const urlMapa = `https://www.google.com/maps/@${m.latitud},${m.longitud},18z`;
    html += `
      <tr>
        <td>${m.hora.substring(0, 5)}</td>
        <td>${m.observaciones || '<em class="text-muted">Sin observaciones</em>'}</td>
        <td>
          <a href="${urlMapa}" target="_blank" class="btn btn-sm btn-outline-primary">
            <i class="bi bi-geo-alt-fill"></i>
          </a>
        </td>
      </tr>
    `;
  });
  
  html += `
      </tbody>
    </table>
  `;
  
  tabla.innerHTML = html;
  offcanvasMarcadosEspeciales.show();
}

// ===============================
// Mostrar detalles en offcanvas normal
// ===============================
function mostrarDetallesMarcacion(marcacion) {
  const detalles = document.getElementById('detallesMarcaciones');
  const urlMapa = `https://www.google.com/maps/@${marcacion.latitud},${marcacion.longitud},18z`;
  
  detalles.innerHTML = `
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">${marcacion.tipo}</h6>
        <hr>
        <p class="mb-2"><strong>Hora:</strong> ${marcacion.hora}</p>
        <p class="mb-2"><strong>Distancia:</strong> ${marcacion.distancia} metros</p>
        <p class="mb-2"><strong>Dispositivo:</strong> ${marcacion.dispositivo}</p>
        <p class="mb-2"><strong>Ubicación:</strong></p>
        <a href="${urlMapa}" target="_blank" class="btn btn-sm btn-outline-primary w-100">
          <i class="bi bi-geo-alt-fill"></i> Ver en Google Maps
        </a>
        ${marcacion.observaciones ? `<p class="mt-3 mb-0"><strong>Observaciones:</strong><br>${marcacion.observaciones}</p>` : ''}
      </div>
    </div>
  `;
  
  offcanvasDetalles.show();
}

// ===============================
// Inicialización
// ===============================
window.onload = async function() {
  await cargarSucursales();
  await verificarYObtenerUbicacion();
};

// ===============================
// Validar DNI y abrir modal
// ===============================
document.getElementById('btnMarcar').addEventListener('click', async () => {
  const dni = document.getElementById('dniInput').value.trim();
  const msg = document.getElementById('msg');
  msg.className = 'mt-3 small';
  msg.textContent = '';

  if (!dni) {
    msg.classList.add('text-danger');
    msg.textContent = 'Por favor, ingresa tu DNI.';
    return;
  }

  if (CONST_LATITUD === null || CONST_LONGITUD === null) {
    msg.classList.add('text-danger');
    msg.textContent = 'No se pudo obtener tu ubicación. Por favor, habilita los permisos.';
    return;
  }

  if (SUCURSAL_DETECTADA === null) {
    msg.classList.add('text-danger');
    msg.textContent = 'No estás dentro del rango de ninguna sucursal.';
    return;
  }

  try {
    const resp = await fetch(`home_asistencia.php?action=validar_dni&dni=${encodeURIComponent(dni)}`, {
      headers: { 'Accept': 'application/json' }
    });
    const data = await resp.json();
    if (!data.ok) {
      msg.classList.add('text-danger');
      msg.textContent = data.msg || 'DNI no válido.';
      return;
    }

    USUARIO_ACTUAL = data.user;
    
    // Cargar marcaciones del día
    await cargarMarcacionesDelDia(data.user.id_user);

    // Setear datos del usuario
    document.getElementById('id_user').value = data.user.id_user;
    document.getElementById('subtituloUsuario').textContent = `${data.user.nombre_user} (${data.user.dni_user})`;
    document.getElementById('subtituloSucursal').textContent = `${SUCURSAL_DETECTADA.nombre} (${DISTANCIA_CALCULADA}m)`;

  } catch (e) {
    msg.classList.add('text-danger');
    msg.textContent = 'No se pudo validar el DNI. Intenta nuevamente.';
  }
});

// Validación antes de enviar
document.getElementById('formMarcado').addEventListener('submit', (ev) => {
  const idu = document.getElementById('id_user').value;
  const tipo = document.getElementById('tipo_marcado').value;
  const centro = document.getElementById('centro_labores').value;
  
  if (!idu || !tipo || !centro) {
    ev.preventDefault();
    alert('Faltan datos para el marcado.');
  }
});
</script>
</body>
</html>