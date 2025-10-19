<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="whatsaap/stilo_what.css">
<?php include('whatsaap1.php'); ?>

<style>
    .container{
        margin-top: 30px;


    }
.btn {
    color: white;
    background: #25D366;
}


.info {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 40vh;
    margin: 0;
}

.step {
    text-align: center;
    margin: 0 1px; /* Reducir el espacio entre los pasos */
    transition: opacity 0.3s ease-in-out;

}

a {
    text-decoration: none; /* Eliminar el subrayado, si también deseas quitarlo */
    color: black;
}

img:hover  {
    opacity: 0.7;
    border: 2px solid #008169; /* Cambiar el borde a verde al pasar el cursor */
}

img {
    width: 80px; /* Ajusta el tamaño de los iconos según sea necesario */
    border-radius: 50%;

}

.image-container:hover img {
    transform: scale(1.1); /* Cambia la escala al 110% al pasar el cursor */
}

p {
    font-size: 10px; /* Ajusta el tamaño de la letra según sea necesario */
}
</style>

    </div>

<div class="container">
  <div class="row">
    <div class="col-sm">

<div class="info">
    <div class="step" id="step1">
        <a href="./wt_idplaca_inicio.php">        
        <img src="./whatsaap/salida_base.png" alt="Paso 1">
        <p>SALIDA_BASE</p>
        </a>

    </div>
    <div class="step" id="step2">
        <a href="./wt_idplaca_inicio.php"> 
        <img src="./whatsaap/salida_alm.png" alt="Paso 2">
        <p>SALIDA_ALMACEN</p>
        </a>
    </div>
    <div class="step" id="step3">
        <a href="./wt_idplaca.php"> 
        <img src="./whatsaap/en_rutas.png" alt="Paso 3">
        <p>EN_RUTA</p>
        </a>
    </div>
    <div class="step" id="step3">
        <a href="./wt_idplaca_fin.php"> 
        <img src="./whatsaap/retorno.png" alt="Paso 3">
        <p>RETORNO</p>
        </a>
    </div>
</div>
    </div>
  </div>
</div>  









<?php include('includes/footer.php'); ?>