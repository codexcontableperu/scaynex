


<style>

    .container{

        margin-top: 6px;

          

        margin-bottom: 10px;  



    }





.info {

    display: flex;

    align-items: center;

    justify-content: center;

    margin: 0;

}



.step {

    text-align: center;

    margin: 0 1px; /* Reducir el espacio entre los pasos */

    transition: opacity 0.3s ease-in-out;



}



a {

    text-decoration: none; /* Eliminar el subrayado, si también deseas quitarlo */

    color: black;

}



img:hover  {

    opacity: 0.7;

    border: 2px solid #008169; /* Cambiar el borde a verde al pasar el cursor */

}



img {

    width: 80px; /* Ajusta el tamaño de los iconos según sea necesario */

    border-radius: 50%;



}



.image-container:hover img {

    transform: scale(1.1); /* Cambia la escala al 110% al pasar el cursor */

}



p {

    font-size: 13px; /* Ajusta el tamaño de la letra según sea necesario */

}





.table td, .table th {

  padding: .15rem;

  vertical-align:  baseline;



}



        table {

            font-size: 13px; /* Cambia el tamaño de fuente para toda la tabla */

            width: 100%; /* Define el ancho de la tabla al 100% del contenedor */

             height: 300%;

        }



        /* Define el tamaño de fuente específico para las celdas de datos */

        .tdx {

            font-size:10px; /* Cambia el tamaño de fuente para las celdas de datos */



        }

    /* Estilo personalizado para el botón */

    .custom-btn {

      margin: 5px auto; /* Centrar el botón */

      border: 0px solid white; /* Borde gris claro */

      border-radius: 5px; /* Bordes redondeados */

      padding: 10px 20px; /* Espaciado interno */

    }



    .botones {

      margin: 20px auto; /* Centrar el botón */

      border: 1px solid white; /* Borde gris claro */

      border-radius: 5px; /* Bordes redondeados */

      padding: 1px 30px; /* Espaciado interno */

      align-items: center; /* Alinea verticalmente */

    }





    .square-btn {



margin: 5px;

  

  align-items: center; /* Alinea verticalmente */

}

   .ancho {

    width: 300px; /* Ancho al pasar el cursor */

    padding: .10rem;

    align-items: center; /* Alinea verticalmente */

  }

</style>


<br>
<h5 class="text-center">REPORTES</h5>


<div class="botones">

<div class="container">
  <div class="row">
    <div class="col-sm">

<div class="info">
    <div class="step" id="step1">
        <a href="">        
        <img src="./whatsaap/gasto.png" alt="Paso 1">
        <p>GASTOS</p>
        </a>

    </div>
    <div class="step" id="step2">
        <a href=""> 
        <img src="./whatsaap/liquidacion.png" alt="Paso 2">
        <p>LIQUIDACIONES</p>
        </a>
    </div>
    <div class="step" id="step3">
        <a href=""> 
        <img src="./whatsaap/incidencias.png" alt="Paso 3">
        <p>INCIDENCIAS</p>
        </a>
    </div>
    <div class="step" id="step3">
        <a href=""> 
        <img src="./whatsaap/datos.png" alt="Paso 3">
        <p>FICHA DATOS</p>
        </a>
    </div>
</div>
    </div>
  </div>
</div>  
</div>
