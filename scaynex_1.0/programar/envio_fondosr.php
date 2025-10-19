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



  
  <style>

    img {
      border-radius: 50%;
      height: 50px;
      width: 50px;
      margin-right: 10px;
    }


  </style>

<div class="card text-center">
  <div class="card-header text-center">
    
    <B> <h4 class="text-center"> RESUMEN  DE ENTREGAS A RENDIR </h4> </B>
  </div>

</div>




<div class= "tablescroll" > 

<div class="container p-3">

      <div class="row" >
        <div class="col-12" class="colm">

    

    <table id="example" class="table table-sm" width="100%">
      <thead class=" text-center">
        <tr>
          <th scope="col">USUARIO</th>
          <th scope="col">FECHA</th>
        
        <th scope="col">DETALLE</th>
        <th scope="col">CONCEPTO</th>
        <th scope="col">ENVIO</th>
        <th scope="col">ADELANTO</th>

      
        </tr>
      </thead>
  <tbody>


          <?php

               $query="
SELECT ledger.tipo_dh, ledger.estado, ledger.fecha_registro, usuarios.id_user, usuarios.user_avatar, usuarios.user_nick, ledger.id_gls, ledger.observacion, rend_conceptos.concepto, ledger.importe, ledger.salario
FROM (ledger INNER JOIN usuarios ON ledger.id_responsable = usuarios.id_user) INNER JOIN rend_conceptos ON ledger.id_concepto = rend_conceptos.id_concepto
WHERE (((ledger.estado)='R'))
ORDER BY ledger.fecha_registro;



              ";
           $result=mysqli_query($conexion, $query);



          ?>
          <?php while($filas=mysqli_fetch_assoc($result)) { ?>
<tr>
            

            <td class="text-center"> 
            <a href="envio_fondosxuser.php?us=<?php echo $filas['id_user']; ?>" >
              <?php echo $filas ['user_nick']?> 
        <img src="../panel/<?php echo $filas ['user_avatar'] ; ?>" alt="foto">
        </a>
            </td>
            <td class="text-center"> <?php echo $filas ['fecha_registro']?> 
            </td>
            <td><?php echo $filas ['observacion']?> 
            </td>

            <td><?php echo $filas ['concepto']?> 
            </td>

            <td class="text-right"><?php echo $filas ['importe']?> 
            </td>
            <td class="text-right" ><?php echo $filas ['salario']?> 
            </td>

</tr>

 
         <?php } ?>




  </tbody>
</table>




    </div>
  </div>
</div>
</div> 

<div class="container">
  <div class="row">

    <div class="col-sm">
     


    <table id="example" class="table table-sm" width="100%">
      <thead class=" text-center">
        <tr>
          <th scope="col">FECHA</th>
        <th scope="col">TOTAL ENVIO</th>
        <th scope="col">TOTAL ADELANTO</th>

      
        </tr>
      </thead>
  <tbody>

          <?php
               $queryT="
SELECT ledger.fecha_registro, Sum(ledger.importe) AS SumaDeimporte, Sum(ledger.salario) AS SumaDesalario
FROM ledger
WHERE (((ledger.estado)='R'))
GROUP BY ledger.fecha_registro;

              ";
           $resultT=mysqli_query($conexion, $queryT);

          ?>
          <?php while($filasT=mysqli_fetch_assoc($resultT)) { ?>
<tr>
            <td class="text-center"> <?php echo $filasT ['fecha_registro']?> 
            </td>

            <td class="text-right"> <?php echo $filasT ['SumaDeimporte']?> 
            </td>
            <td class="text-right"><?php echo $filasT ['SumaDesalario']?> 
            </td>

</tr>

         <?php } ?>

  </tbody>
</table>



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
