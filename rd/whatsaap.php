    <link rel="stylesheet" href="whatsaap/stilo_what.css">
          <?php 
          $timestamp = new DateTime(null, new DateTimeZone('America/Lima'));
          $hoy = $timestamp->format('y-m-d');
          $horaa = $timestamp->format('H:i:s');
          $hoyfor = $timestamp->format('d-m-y');
          $fehra = $timestamp->format('d-m-y-H:i:s');
          ?>
          
    <div id="header">
        <div id="whatsapp-text">
            WhatsApp </div>
        <div id="header-icons">
            <img src="whatsaap/camera-icon.png" alt="Cámara" id="camera-icon">
            <img src="whatsaap/search-icon.png" alt="Buscar" id="search-icon">
            <img src="whatsaap/menu-icon.png" alt="Menú" id="menu-icon">
        </div>
    </div>

    <div id="second-header">
        <img src="whatsaap/user-icon.png" alt="Usuario" id="user-icon">
        <a class="boton bton selec" href="wt_lista-user.php?f=<?php echo $hoy ?>">Operadores</a>
        &nbsp &nbsp 
        <a class="boton noselec " href="wt_lista-und.php?f=<?php echo $hoy ?>">Unidades</a>
        &nbsp &nbsp 
        <a class="boton noselec " href="index.php">Programacion</a>
    </div>
