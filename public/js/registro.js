$(document).ready(function () {
  postRegistro();
  dni();
});

function postRegistro() {
    $("#ingresoRegistro").on("submit", function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
        url: $(this).attr("action"),
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            alert("Registro ¡Exitoso!");
            // Limpiar todos los campos del formulario
            $("#ingresoRegistro")[0].reset();
            
            setTimeout(function () {
            location.reload(true); // true fuerza recarga completa desde el servidor
            }, 300);
        },
        error: function (error) {
            console.error("Error:", error);
            alert("Hubo un error al enviar el formulario.");
        },
    });
    });
}

function dni() {
  // Construir la URL del endpoint de forma robusta
  $("#dni").on("keyup", function () {
    var dni = $("#dni").val();
    if (dni.length == 8) {
      var base = typeof BASE_URL !== 'undefined' ? BASE_URL : window.location.origin + '/gestionvehicular/';
      base = base.replace(/\/+$/, '');
      var ajaxUrl = base + '/registro/dni';

      $.ajax({
        url: ajaxUrl,
        type: "POST",
        data: { dni: dni },
        success: function (response) {
          try {
            var data = typeof response === 'object' ? response : JSON.parse(response);
            if (data && data.error) {
              console.error('API error: ', data.error);
              return;
            }
            if (!data || Object.keys(data).length === 0) {
              // No encontrado
              console.log('DNI no encontrado');
              return;
            }
            $("#nombre").val(data.nombres || '');
            $("#apellido").val((data.apellidoPaterno || '') + ' ' + (data.apellidoMaterno || ''));
          } catch (e) {
            console.error('Error parseando la respuesta:', e, response);
          }
        },
        error: function (xhr, status, error) {
          console.log(error + " -> No se pudo hacer la solicitud a la API");
        },
      });
    } else {
      // Limpiar campos si el dni no tiene 8 caracteres
      // $("#nombre").val('');
      // $("#apellido").val('');
    }
  });
}
