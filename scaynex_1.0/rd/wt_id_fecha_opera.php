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

        <form action="wt_form_operadores.php" method="GET">

      <div class="form-group mx-sm-3 mb-2">
        <label for="f" class="sr-only">FECHA</label>
        <input type="date" class="form-control nv" id="f" name="f" placeholder="DD/MM/AA" >
      </div>
<br>
        <button type="submit" id="guardar" name="guardar" class="btn  btn-lg btn-block ">BUSCAR</button>
        </form>

    </div>
  </div>
</div>  






<?php include('includes/footer.php'); ?>