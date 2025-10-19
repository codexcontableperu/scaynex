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
<link rel="stylesheet" href="whatsaap/stilo_list.css">
<link rel="stylesheet" href="whatsaap/stilo_what.css">
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Contact">
    <meta property="og:type" content="website">

<?php include('includes/ffecha.php'); ?>   

    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Contact">
    <meta property="og:type" content="website">
    <link rel="stylesheet" href="style.css">

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
} else  {
    $fecha = $_GET['f'];
}


?>

<div >
    <form  action="unidades.php" method="POST" class="form-inline">
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
    <button  type="button" class="btn btn-outline-success btn-block bt"> UNIDADES DISPONIBLES:       
    </button>  
    
  </div>
</div>

  <?php 
  $queryOP="

SELECT rd_operadores.Id_SERG, Count(rd_operadores.NOMBRE) AS CuentaDeNOMBRE, rd_segimientos_head.S_FECHA, Count(rd_servicio.ID_SERV) AS CuentaDeID_SERV, rd_segimientos_head.PLACA, unidades.vh_avatar, unidades.vh_modelo, unidades.vh_placa
FROM ((rd_operadores INNER JOIN rd_segimientos_head ON rd_operadores.Id_SERG = rd_segimientos_head.Id_SERG) LEFT JOIN rd_servicio ON rd_segimientos_head.Id_SERG = rd_servicio.Id_SERG) LEFT JOIN unidades ON rd_segimientos_head.PLACA = unidades.vh_placa
GROUP BY rd_operadores.Id_SERG, rd_segimientos_head.S_FECHA, rd_segimientos_head.PLACA, unidades.vh_avatar, unidades.vh_modelo, unidades.vh_placa
HAVING (((rd_segimientos_head.S_FECHA)='$fecha'));



";
  $resultOP=mysqli_query($conexion, $queryOP);

  ?>

    <div id="contact-list">
        <?php while($filasOP=mysqli_fetch_assoc($resultOP)) { ?>
        <div class="contact">
            <img src="../panel/<?php echo $filasOP ['vh_avatar']?>" alt="user" width="30" height="30">
            
            <div class="contact-details">
                <div class="contact-name">
                    
                     <a style="margin: 3px;" href="wt_panel_user.php?idp=<?php echo $filasOP ['Id_SERG']?>" class="btn btn-success btn-sm" style="display: inline-block;"> 
                         <?php echo $filasOP ['vh_placa']?>
                         - 
                        <?php echo  $filasOP ['vh_modelo'];?>
                      </a>
                </div>
                <div>
                    <a style="color: blue;" href="">
                    <span class="icon-user"> </span>
                    <?php echo $filasOP ['CuentaDeNOMBRE']?>
                    </a>

                    <a style="color: red;" href="">
                    <span class="icon-clipboard"> </span> 
                    <?php echo $filasOP ['CuentaDeID_SERV']?>
                    </a>


                    
 
                              

                </div>
            </div>
        </div>
          <?php } ?>

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