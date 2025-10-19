<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ARTICULOS---*/

if (isset($_POST['idp'])) {

$idp = $_POST['idp'];

    $latitud = $_POST["latitud"];
    $longitud = $_POST["longitud"];


$query= "INSERT INTO rd_inicio_fin ( 

Id_SERG,
i_latitud,
i_longitud
) VALUES (

'$idp',
'$latitud',
'$longitud'
)";

/*---create ---*/
$result = mysqli_query($conexion, $query);

$query = "UPDATE rd_segimientos_head SET
         
        ESTADO_IDP = 1,
        PENDIENTE = 0
    WHERE Id_SERG = $idp";

    mysqli_query($conexion, $query);



mysqli_close($conexion);
/*---secion para msj ---*/

/*---redireccion ---*/



}

?> 



<meta http-equiv="refresh" content="0;url=./../wt_panel_user.php?idp=<?php echo $idp ?>" />


