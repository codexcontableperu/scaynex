<?php include("../data/conexion.php"); ?>
<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="whatsaap/stilo_what.css">
<?php include('whatsaap.php'); ?>

<style>
    .container{
        margin-top: 30px;


    }
.btn {
    color: white;
    background: #25D366;
}


</style>

    </div>

<div class="container">
  <div class="row">
    <div class="col-sm">

        <form action="wt_form_fin.php" method="POST">

        <div class="form-group">
          <label for="PLACA">PLACA : </label>
          <input class="form-control" list="PLACAS" type="text" id="PLACA" name="PLACA" required>
            <datalist id="PLACAS" >  
            <option selected ></option>
            <?php 
              $queryP="SELECT * FROM unidades ";
              $resultP=mysqli_query($conexion, $queryP);
            ?>
            <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
              
            <option value="<?php echo $filasP ['vh_placa']?>" >
            </option>
            <?php } ?>
          </datalist>
        </div>

        <button type="submit" id="guardar" name="guardar" class="btn  btn-lg btn-block ">BUSCAR</button>
        </form>

    </div>
  </div>
</div>  






<?php include('includes/footer.php'); ?>