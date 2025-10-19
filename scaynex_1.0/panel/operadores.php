<?php include('includes/session1.php'); ?>
<?php include("../data/conexion.php"); ?>
<!DOCTYPE html><html style="font-size: 16px;">
<!-- Mirrored from website726460.nicepage.io/es/Contact.html?version=c99f6d58-dbb4-4080-9506-a3a93b2be7f2 by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Feb 2024 16:54:43 GMT -->
<head>
            <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="main.css"> 

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Subscribe Now">
    <meta name="description" content>
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>App-Scaynex</title>
    <link rel="stylesheet" href="stylos/nicepage6168.css?version=6a9bdefb-4bc9-4812-9536-5d51bd2eb046" media="screen">
    <script class="u-script" type="text/javascript" src="js_login/jquery-1.9.1.min.js" defer></script>
    <script class="u-script" type="text/javascript" src="js_login/nicepage.js" defer></script>
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alata:400">
    <link rel="stylesheet" href="stylos/mimenu.css" media="screen">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="whatsaap/stilo_list.css">
<link rel="stylesheet" href="whatsaap/stilo_what.css">

<?php include('includes/ffecha.php'); ?>   

    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Contact">
    <meta property="og:type" content="website">


</head>
  <body class="u-body">

<?php include('includes/headerPan.php'); ?>


<style type="text/css">

        form {
            margin: 10px;
            border: 2px solid #ddd; /* Borde gris claro */
            border-radius: 10px; /* Radio de borde de 10 píxeles */
            padding: 6px;
            justify-content: center;
            background-color: white;
        }</style>



<?php
if (isset($_POST['f'])) {
    $fecha = $_POST['f'];
    $_SESSION['fechaw'] = $fecha;
    $FECHAW = $_SESSION['fechaw'];
} elseif (isset($_GET['f'])) {
    $fecha = $_GET['f'];
    $_SESSION['fechaw'] = $fecha;
    $FECHAW = $_SESSION['fechaw'];
} else {
    $fecha = $hoy;
    $_SESSION['fechaw'] = $fecha;
    $FECHAW = $_SESSION['fechaw'];
}


?>

<div >
    <form  action="operadores.php" method="POST" class="form-inline">
      <div class="form-group mb-2">
        <label for="staticEmail2" class="sr-only">FECHA</label>
      </div>
      <div class="form-group mx-sm-3 mb-2">
        <label for="f" class="sr-only">FECHA</label>
        <input type="date" class="form-control nv" id="f" name="f" placeholder="DD/MM/AA" value="<?php echo $fecha ?>" >
      </div>
      <button type="submit" class="btn btn-success mb-2 nv ">
        <span class="icon-search"></span> BUSCAR
      </button>

    </form>
</div>    




    <!-- Lista de contactos  disponibles -->
<div class="container">
  <div class="row botoness">
    <button  type="button" class="btn btn-outline-success btn-block bt"> OPERADORES DISPONIBLES:       
    </button>  
    
  </div>
</div>

  <?php 
  $queryOP="
SELECT rd_operadores.Id_SERG, rd_operadores.NOMBRE, rd_segimientos_head.S_FECHA, usuarios.user_disponible, usuarios.user_avatar, Count(rd_servicio.ID_SERV) AS CuentaDeID_SERV, rd_segimientos_head.PLACA, saldo14_xuser.SALDOT
FROM (((rd_operadores INNER JOIN rd_segimientos_head ON rd_operadores.Id_SERG = rd_segimientos_head.Id_SERG) LEFT JOIN usuarios ON rd_operadores.NOMBRE = usuarios.user_nombre) LEFT JOIN rd_servicio ON rd_segimientos_head.Id_SERG = rd_servicio.Id_SERG) LEFT JOIN saldo14_xuser ON rd_operadores.NOMBRE = saldo14_xuser.NOMBRE
GROUP BY rd_operadores.Id_SERG, rd_operadores.NOMBRE, rd_segimientos_head.S_FECHA, usuarios.user_disponible, usuarios.user_avatar, rd_segimientos_head.PLACA, saldo14_xuser.SALDOT
HAVING S_FECHA='$fecha'
ORDER BY rd_operadores.NOMBRE;

";
  $resultOP=mysqli_query($conexion, $queryOP);

  ?>

    <div id="contact-list">
        <?php while($filasOP=mysqli_fetch_assoc($resultOP)) { ?>
        <div class="contact">
            <img src="../panel/<?php echo $filasOP ['user_avatar']?>" alt="user" width="60" height="60">
            <div class="contact-details">
                <div class="contact-name">
                     <a style="margin: 3px;" href="wt_panel_user.php?idp=<?php echo $filasOP ['Id_SERG']?>" style="display: inline-block; color: red;"> 
                        <span class="icon-user"> </span> <?php echo $filasOP ['NOMBRE']?>
                      </a>
                </div>
                <div>
                    <a style="color: blue;" href="">
                    <span class="icon-truck"> </span> 
                    <span style="color: black;" class="icon-road"> </span> 
                    <?php echo $filasOP ['PLACA']?>
                    </a>

                    <a style="color: red;" href="">
                    <span class="icon-clipboard"> </span> 
                    <?php echo $filasOP ['CuentaDeID_SERV']?>
                    </a>

                    <a style="color: green;" href="">
                    <span  class=" icon-coin-dollar "></span> 
                    <?php echo $filasOP ['SALDOT']?>
                    </a>
                    
 
                              

                </div>
            </div>
        </div>
          <?php } ?>

    </div>


   <!-- Lista de contactos NO disponibles -->

   <div class="container">
  <div class="row botoness">
    <button  type="button" class="btn btn-outline-secondary btn-block bt"> OPERADORES NO DISPONIBLES:       
    </button>  
    
  </div>
</div>

  <?php 
  $queryOP="
SELECT usuarios.user_disponible, usuarios.user_avatar, usuarios.user_nombre, saldo14_xuser.SALDOT, usuarios.user_activo, usuarios.user_operador
FROM usuarios LEFT JOIN saldo14_xuser ON usuarios.user_nombre = saldo14_xuser.NOMBRE
WHERE (((usuarios.user_disponible)='si') AND ((usuarios.user_activo)='si') AND ((usuarios.user_operador)='si'))
ORDER BY usuarios.user_nombre;


";
  $resultOP=mysqli_query($conexion, $queryOP);

  ?>

    <div id="contact-list">
        <?php while($filasOP=mysqli_fetch_assoc($resultOP)) { ?>
        <div class="contact">
            <img src="../panel/<?php echo $filasOP ['user_avatar']?>" alt="user" width="60" height="60">
            <div class="contact-details">
                <div class="contact-name">
                     <a style="margin: 3px;" href="" class="btn btn-secondary btn-sm" style="display: inline-block;"> 
                        <span class="icon-user"> </span> <?php echo $filasOP ['user_nombre']?>
                      </a>
                </div>
                <div>
                    <a style="color: blue;" href="">
                    <span class="icon-truck"> </span> 
                    </a>

 

                    <a style="color: green;" href="">
                    <span  class=" icon-coin-dollar "></span> 
                    <?php echo $filasOP ['SALDOT']?>
                    </a>
                    
 
                              

                </div>
            </div>
        </div>
          <?php } ?>

    </div>
    
    </div>



    
<footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-53ac"><div class="u-clearfix u-sheet u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">

        </p>
      </div></footer>
    <section class="u-backlink u-clearfix u-grey-80">
      <a class="u-link" href="https://nicepage.com/website-templates" target="_blank">
        <span>  Aplicativo web - whatsaap</span>
      </a>
      <p class="u-text">
        <span> - </span>
      </p>
      <a class="u-link" href="https://nicepage.com/" target="_blank">
        <span>Website codex</span>
      </a>. 
    </section>
  
</body>

</html>