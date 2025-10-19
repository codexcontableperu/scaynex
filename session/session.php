
<?php $user = $_GET['ve'];


@session_start();

$_SESSION['ve']=$user;




    	echo'<script type="text/javascript">
    window.location.href="./../index.php";
    </script>';
exit();
 ?>

