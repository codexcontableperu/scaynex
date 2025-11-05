    <div class="header-bar">
        <div class="header-left">
            <div class="avatar-container">
                <a href="home.php">
                <img src="<?php echo htmlspecialchars($avatar); ?>" alt="Avatar">
                </a>
            </div>
            <div class="user-info">
                <p class="user-name"><?php echo htmlspecialchars($nombre_user); ?></p>
                <p class="user-role"><?php echo htmlspecialchars($permisos); ?></p>
            </div>
        </div>
        <div class="header-right">
            <button class="menu-toggle" id="menuToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Menú Lateral -->
    <div class="side-menu" id="sideMenu">
        <div class="side-menu-header">
            <img src="<?php echo htmlspecialchars($avatar); ?>" alt="Avatar">
            <h5><?php echo htmlspecialchars($nombre_user); ?></h5>
            <small><?php echo htmlspecialchars($permisos); ?></small>
        </div>
        <ul class="menu-items">
            <li><a href="home.php"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="myperfil.php"><i class="fas fa-user-circle"></i> Mi Perfil</a></li>
            <li><a href="lista_usuarios.php"><i class="fas fa-users"></i> Usuarios</a></li>
            <li><a href="programacion.php"><i class="fas fa-chart-bar"></i> Programacion</a></li>
            <li><a href="home_unidades.php"><i class="fa-solid fa-truck"></i> Unidades</a></li>
            <li><a href="canvas_rutas.php"><i class="fas fa-folder"></i> Tablero Canvas</a></li>
            <li><a href="monitoreo.php"><i class="fas fa-bell"></i> Monitoreo</a></li>
            <li><a href="#"><i class="fas fa-key"></i> Cambiar Contraseña</a></li>
            <li><a href="#"><i class="fas fa-question-circle"></i> Ayuda</a></li>
            <li><a href="#"><i class="fas fa-info-circle"></i> Acerca de</a></li>
            <li><a href="valida/cerrar_sesion.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
        </ul>
    </div>
