<?php include("includes/header.php"); ?>

</head>
<body>
    <!-- Header Bar -->
<?php include("includes/menubar.php"); ?>

    <!-- Área de Contenido -->
    <div class="content-area">
        <h2>Bienvenido, <?php echo htmlspecialchars($nombre_user); ?>!</h2>
        <p>Este es el panel principal del sistema Teletran.</p>
        
        <!-- Aquí va el contenido dinámico -->
        <div class="row mt-4">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">


                        <h5 class="card-title">Dashboard</h5>
                        <p class="card-text">Contenido del dashboard</p>



                    </div>
                </div>
            </div>
        </div>
    </div>






// footer
<?php include("includes/footer.php"); ?>

</body>
</html>