

<style >

.fondo {
  width: 0px; /* Cambia el ancho según tus necesidades */
  z-index: -30;
}

input {
border: 0px;
background-color: #d6d8db;
}

</style>

<table class="table table-sm table-secondary">

  <tbody>

    <tr>
          
      <td>

<div class="container text-center ">        


<form action="crud_inicio_fin/updateFIN.php?" method="post">
    <!-- Campos del formulario -->
    
    <!-- Campo oculto para la latitud -->
    <input class="fondo" type="text" id="latitud" name="latitud" disabled="disabled" >
    
    <!-- Campo oculto para la longitud -->
    <input disabled="disabled" class="fondo" type="text" id="longitud" name="longitud">

    <!-- Campo oculto para la longitud -->
    <input type="hidden" id="idp" name="idp" value="<?php echo $idp ?>">  

    <!-- Botón de envío -->
    <button type="submit" class="btn btn-success">FINALIZAR SERVICIO</button>
</form>








</div>
      </td>
    </tr>


    
  </tbody>
</table>


<!-- Paso 2: Captura la latitud y longitud en JavaScript -->
<script>
    function obtenerUbicacion() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(mostrarUbicacion);
        } else {
            alert("La geolocalización no es compatible con este navegador.");
        }
    }

    function mostrarUbicacion(posicion) {
        var latitud = posicion.coords.latitude;
        var longitud = posicion.coords.longitude;
        document.getElementById("latitud").value = latitud;
        document.getElementById("longitud").value = longitud;
    }

    // Llama a la función para obtener la ubicación al cargar la página
    window.onload = obtenerUbicacion;
</script>