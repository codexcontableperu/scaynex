<table class="table table-sm table-secondary">
  <tbody>
    <tr>
      <td>
        <div class="container text-center">        
          <form action="crud_inicio_fin/create1.php" method="post">
            <!-- Campos del formulario -->
            <!-- Campo oculto para la latitud -->
            <input type="hidden" id="latitud" name="latitud">
            
            <!-- Campo oculto para la longitud -->
            <input type="hidden" id="longitud" name="longitud">

            <!-- Campo oculto para el IDP -->
            <input type="hidden" id="idp" name="idp" value="<?php echo $idp ?>">  

            <!-- Botón de envío -->
            <button type="submit" class="btn btn-success">INICIAR (BASE)</button>
          </form>
        </div>
      </td>
    </tr>
  </tbody>
</table>

<!-- Captura la latitud y longitud en JavaScript -->
<script>
    function obtenerUbicacion() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(mostrarUbicacion, mostrarError);
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

    function mostrarError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                alert("El usuario ha denegado la solicitud de geolocalización.");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("La información de ubicación no está disponible.");
                break;
            case error.TIMEOUT:
                alert("La solicitud para obtener la ubicación ha caducado.");
                break;
            case error.UNKNOWN_ERROR:
                alert("Ha ocurrido un error desconocido.");
                break;
        }
    }

    // Llama a la función para obtener la ubicación al cargar la página
    window.onload = obtenerUbicacion;
</script>
