$(document).ready(function () {
  postRegistro();
  dni();
});

function postRegistro() {
  $("#ingresoRegistro").on("submit", function (event) {
    event.preventDefault();

    var dniVal = $("#dni").val().trim();
    if (!dniVal || dniVal.length !== 8) {
      alert('Ingrese un DNI válido de 8 dígitos antes de registrar.');
      $("#dni").focus();
      return;
    }

    var base = typeof BASE_URL !== 'undefined' ? BASE_URL : window.location.origin + '/gestionvehicular/';
    base = base.replace(/\/+$/, '');
    var checkUrl = base + '/registro/existsDni';

    // Primera llamada: comprobar si el DNI ya existe en la BD
    $.ajax({
      url: checkUrl,
      type: 'POST',
      data: { dni: dniVal },
      success: function (res) {
        var data = typeof res === 'object' ? res : JSON.parse(res);
        if (data && data.error) {
          console.error('Error en checkDni:', data.error);
          alert('Error al verificar DNI. Intente de nuevo.');
          return;
        }
        if (data && data.exists) {
          alert('El DNI ya está registrado. No se puede registrar de nuevo.');
          $("#dni").focus();
          return;
        }

        // Si no existe, proceder a enviar el formulario para crear el registro
        var formData = new FormData($("#ingresoRegistro")[0]);
        $.ajax({
          url: $("#ingresoRegistro").attr('action'),
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            alert('Registro ¡Exitoso!');
            $("#ingresoRegistro")[0].reset();
            setTimeout(function () { location.reload(true); }, 300);
          },
          error: function (error) {
            console.error('Error:', error);
            alert('Hubo un error al enviar el formulario.');
          }
        });
      },
      error: function (xhr, status, err) {
        console.error('Error verificando DNI:', err);
        alert('No se pudo verificar el DNI. Intente de nuevo.');
      }
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
