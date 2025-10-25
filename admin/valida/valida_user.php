<?php
// Iniciar sesión
session_start();

// Incluir archivo de conexión
include("../../data/conexion.php");

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Obtener y limpiar los datos del formulario
    $dni = limpiarDato($_POST['dni']);
    $contrasena = limpiarDato($_POST['contrasena']);
    
    // Validar que los campos no estén vacíos
    if (empty($dni) || empty($contrasena)) {
        echo "<script>
                alert('Por favor complete todos los campos');
                window.location.href = '../index.php';
              </script>";
        exit();
    }
    
    // Escapar datos para la consulta
    $dni = $conexion->real_escape_string($dni);
    
    // Consulta corregida según la estructura de la tabla
    $sql = "SELECT id_user, user_dni, user_nombre, user_clave, user_avatar, user_perfil, user_activo 
            FROM usuarios 
            WHERE user_dni = '$dni'";
    
    $resultado = $conexion->query($sql);
    
    // Verificar si existe el usuario
    if ($resultado->num_rows > 0) {
        
        // Obtener los datos del usuario
        $usuario = $resultado->fetch_assoc();
        
        // Verificar el estado del usuario
        if ($usuario['user_activo'] != 'si') {
            echo "<script>
                    alert('Su cuenta está inactiva. Contacte al administrador.');
                    window.location.href = '../index.php';
                  </script>";
            $conexion->close();
            exit();
        }
        
        // Verificar la contraseña (comparación directa según tu código original)
        if ($contrasena == $usuario['user_clave']) {
            
            // Crear variables de sesión con los nombres correctos de la tabla
            $_SESSION['id_user'] = $usuario['id_user'];
            $_SESSION['dni_user'] = $usuario['user_dni'];
            $_SESSION['nombre_user'] = $usuario['user_nombre'];
            $_SESSION['avatar'] = $usuario['user_avatar'];
            $_SESSION['permisos'] = $usuario['user_perfil'];
            $_SESSION['logueado'] = true;
            
            // Redirigir a home.php según el perfil
            switch ($usuario['user_perfil']) {
                case 1:
                    header("Location: ../home.php");
                    break;
                case 4:
                    header("Location: ../home.php");
                    break;
                default:
                    echo "<script>
                            alert('Usuario no tiene permisos para acceder al sistema');
                            window.location.href = '../index.php';
                          </script>";
                    exit();
                    break;
            }
            
        } else {
            // Contraseña incorrecta
            echo "<script>
                    alert('La contraseña es incorrecta');
                    window.location.href = '../index.php';
                  </script>";
            $conexion->close();
            exit();
        }
        
    } else {
        // Usuario no existe
        echo "<script>
                alert('El usuario no existe');
                window.location.href = '../index.php';
              </script>";
        $conexion->close();
        exit();
    }
    
} else {
    // Si se accede directamente sin POST, redirigir a index
    header("Location: ../index.php");
    exit();
}

// Función para limpiar datos
function limpiarDato($dato) {
    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}
?>