<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/x-icon" href="/assets/logo-vt.svg" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIRER</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
      crossorigin="anonymous"
    />
  </head>
  <body class="bg-info d-flex justify-content-center align-items-center vh-100">
    <div
      class="bg-white p-5 rounded-5 text-secondary shadow"
      style="width: 25rem"
    >
      <div class="d-flex justify-content-center" style="border-radius: 50%; overflow: hidden;">
        <img
          src="logo.png"
          alt="login-icon"
          style="height: 14rem"
        />
      </div>
<br>
      <div class="text-center fs-1 fw-bold">www.fullruta.com</div>
      

<form action="./valida/valida_user.php" method="post" class="AjaxForms MainLogin" data-type-form="login" autocomplete="off">
        <p class="text-center text-muted lead text-uppercase">ACT: CORPORACION JSA LLANOS S.A.C.</p>
        <div class="form-group">
          <label class="control-label" for="usuario">INGRESA TU DNI</label>
          <input class="form-control" name="dni" id="dni" type="text" required="">
        </div>
        <br><br>
        <p class="text-center">
            <button type="submit" class="btn btn-primary btn-block"> &nbsp &nbsp &nbsp VALIDAR &nbsp &nbsp &nbsp</button>        
        </p>
    </form>




      <div class="d-flex justify-content-around mt-1">
   

      </div>
      <br>
      <div
        class="btn d-flex gap-2 justify-content-center border mt-3 shadow-sm"
      >
        <img
          src="google.png"
          alt="google-icon"
          style="height: 1.6rem"
        />
        <div class="fw-semibold text-secondary">Continue with Google</div>
      </div>
    </div>
  </body>
</html>
