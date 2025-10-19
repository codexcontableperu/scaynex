<?php @session_start();?> 
          
<?php 
if (isset($_SESSION['ve'])) {
      $Vup=$_SESSION['ve'];
	

} else {

  @session_destroy();
echo'<script type="text/javascript">
    window.location.href="./page/index.html";
    </script>';
  exit();
  die();
}
?>

