<?php include('includes/session1.php'); ?>
<?php include("../data/conexion.php"); ?>
<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="whatsaap/stilo_list3.css">
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
            <div style="display: flex;">    
      <span class="icon-user" style="padding-top: 4px">&nbsp</span>  <?php  echo $userup ; ?>   </div> 
       </div>
        <div id="header-icons">
            
            <img src="whatsaap/search-icon.png" alt="Buscar" id="search-icon">
            <a href="../index-menu.php">
            <img src="whatsaap/menu-icon.png" alt="Menú" id="menu-icon"></a>
        </div>
    </div>

    <div id="second-header">
        <img src="whatsaap/user-icon.png" alt="Usuario" id="user-icon">
        <a class="boton noselec" href="wt_lista-user.php?f=<?php echo $hoy ?>">Operadores</a>
        &nbsp &nbsp         
        <a class="boton bton selec" href="wt_lista-und.php?f=<?php echo $hoy ?>">Unidades</a>
        &nbsp &nbsp 
        <a class="boton noselec " href="../index-menu.php">Menu</a>
    </div>
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
    <form  action="wt_lista-und.php" method="POST" class="form-inline">
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


<?php include('includes/footer.php'); ?>