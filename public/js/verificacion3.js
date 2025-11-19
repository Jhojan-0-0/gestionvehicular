$(document).ready(function () {
  postFiltro();
  // AUTOCOMPLETAR DNI
  $("#dni").autocomplete({
    minLength: 3,
    source: function (request, response) {
      var base = typeof BASE_URL !== "undefined" ? BASE_URL : window.location.origin + "/gestionvehicular";
      base = base.replace(/\/+$/, "");
      var ajaxUrl = base + "/verificacion3/dni";

      $.ajax({
        url: ajaxUrl,
        dataType: "json",
        data: { q: request.term },
        success: function (data) {
          response(data);
        },
        error: function (xhr, status, error) {
          console.error("Error AJAX verificacion3 DNI:", error);
        },
      });
    },
    select: function (event, ui) {
      // Rellenar campos del formulario (mismos nombres que verificacion1)
      $("#idpersonal").val(ui.item.id);
      $("#dni").val(ui.item.dni);
      $("#nombre").val(ui.item.nombre);
      $("#apellidos").val(ui.item.apellido);
      $("#catLicencia").val(ui.item.catLicencia);
      $("#fechaVerificacion").val(ui.item.fechaVerificacion);
      $("#fechaPsicosomatico").val(ui.item.fechaPsicosomatico);
      // placaVehiculo si ya existe en el registro
      if (ui.item.placaVehiculo) {
        $("#placaVehiculo").val(ui.item.placaVehiculo);
      }
      // establecer fecha y hora completa en formato MySQL
      establecerFechaHora();
      return false;
    },
  });

  // manejo de botones aprobado/desaprobado
  $("#btn-aprobado").on('click', function (e) {
    e.preventDefault();
    $("#estado").val('Aprobado');
    $("#estadoVisible").val('Aprobado');
    // enviar formulario
    enviarFormulario();
  });

  $("#btn-desaprobado").on('click', function (e) {
    e.preventDefault();
    $("#estado").val('Desaprobado');
    $("#estadoVisible").val('Desaprobado');
    enviarFormulario();
  });


  // también prevenir submit directo (si el usuario pulsa enter en inputs)
  $("#signar-tareas").on('submit', function (e) {
    e.preventDefault();
    // si no hay estado definido, no enviar
    var estadoVal = $("#estado").val();
    if (!estadoVal) {
      alert('Seleccione Aprobado o Desaprobado antes de guardar.');
      return;
    }
    enviarFormulario();
  });
});

function postFiltro() {
    $("#PostFiltro").on("submit", function (event) {
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
            $("#PostFiltro")[0].reset();
            
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