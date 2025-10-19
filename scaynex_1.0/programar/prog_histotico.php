<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>
<?php include("../data/conexion.php"); ?>


    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="main.css">  
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
           
    <!--font awesome con CDN-->  
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">  




    
  <body> 

    <div class="container p-3">
    <h4> PROGRAMADAS (HISTORIAL):</h4>
     <br><br>




<?php


     $query=" 

   SELECT head_programaciones.head_fecha, clientes.cte_logo, clientes.cte_nombrecomercial, programaciones.id_prog, programaciones.id_head, cuentas.cta_logo, cuentas.cta_nombrecomercial, unidades.vh_placa AS asignado, unidades_1.vh_placa AS reportado, usuarios.user_nick AS conductor, usuarios_1.user_nick AS ayudante, programaciones.cant_estiva, tipo_prog.tprog_nombre, programaciones.obs_prog
FROM (((((((programaciones INNER JOIN cuentas ON programaciones.id_cta = cuentas.id_cta) INNER JOIN unidades ON programaciones.vh_asignado = unidades.id_vh) LEFT JOIN unidades AS unidades_1 ON programaciones.vh_reportado = unidades_1.id_vh) INNER JOIN usuarios ON programaciones.id_conductor = usuarios.id_user) LEFT JOIN usuarios AS usuarios_1 ON programaciones.id_ayudante = usuarios_1.id_user) INNER JOIN tipo_prog ON programaciones.id_tprog = tipo_prog.id_tprog) INNER JOIN head_programaciones ON programaciones.id_head = head_programaciones.id_head) INNER JOIN clientes ON head_programaciones.id_cliente = clientes.id_cliente 

     ";

     $result=mysqli_query($conexion, $query);



?>


     
    <!--Ejemplo tabla con DataTables-->
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">  



<?/*---cabeseras de la tabla---*/?>

                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                              <th>CLIENTE</th>
                              <th>FECHA</th>
                              <th>CUENTA</th>
                              <th>TIPO</th>
                              <th>VEHICULO</th>
                              <th>OPERADORES</th>
                              <th>OBSERVACIONES</th>
                              <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($filas=mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                      <td >
                                        <?php echo $filas ['cte_nombrecomercial'];?>
                                      </td>
                                      <td >
                                        <?php echo $filas ['head_fecha'];?>
                                      </td>

                                      <td >
                                        <?php echo $filas ['cta_nombrecomercial'];?>
                                      </td>
                                      <td >
                                        <?php echo $filas ['tprog_nombre'];?>
                                      </td>

                                      
                                      <td align="left" >
                                        V.A: <?php echo $filas ['asignado'];?> <br>
                                        V.R: <?php echo $filas ['reportado'];?>

                                      </td>

                                      <td align="left" >
                                        CON: <?php echo $filas ['conductor'];?> <br>
                                        AYU: <?php echo $filas ['ayudante'];?> <br>
                                        EST: <?php echo $filas ['cant_estiva'];?>
                                      </td>

                                      <td >
                                            <?php echo $filas ['obs_prog'];?>
                                       </td>

                                     <td>

                                        <div class="container text-center ">
                                        <a href="prog_update.php?id=<?php echo $filas ['id_prog']?>" class="btn btn-primary"> 
                                        <span class="icon-checkmark"></span>
                                        </a>

                                      <a href="prog_delete.php?id=<?php echo $filas ['id_prog']?>" class="btn btn-danger"> 
                                                <span class="icon-bin"></span>
                                        </a>

                                        </div>

                                     </td>
                                    </tr>
                                 <?php } ?>
                          
                        </tbody>        
                       </table> 




                    </div>
                </div>
        </div>  
    </div>    
     
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>    
     
    <!-- para usar botones en datatables JS -->  
    <script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
     
    <!-- código JS propìo-->    
    <script type="text/javascript" src="main.js"></script>  
    

    
  </body>
</html>
