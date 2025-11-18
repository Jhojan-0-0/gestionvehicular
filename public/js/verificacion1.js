$(document).ready(function () {
  // ========== AUTOCOMPLETAR DNI ==========
  $("#dni").autocomplete({
    minLength: 3,
    source: function (request, response) {
      // Construir la URL del endpoint de forma robusta
      var base = typeof BASE_URL !== "undefined" ? BASE_URL : window.location.origin + "/gestionvehicular/";
      base = base.replace(/\/+$/, ""); // limpia los "/" al final
      var ajaxUrl = base + "/verificacion1/dni"; // ruta del controlador/método

      $.ajax({
        url: ajaxUrl,
        dataType: "json",
        data: { q: request.term },
        success: function (data) {
          response(data);
        },
        error: function (xhr, status, error) {
          console.error("Error AJAX:", error);
          console.error("URL:", ajaxUrl);
          console.error("Status:", status);
        },
      });
    },
    select: function (event, ui) {
      // Al seleccionar un resultado, llenar los campos
      $("#idpersonal").val(ui.item.id);
      $("#dni").val(ui.item.dni);
      $("#nombre").val(ui.item.nombre);
      $("#apellido").val(ui.item.apellido);
      $("#catLicencia").val(ui.item.catLicencia);
      $("#fechaPsicosomatico").val(ui.item.fechaPsicosomatico);
      
      // Establecer fecha y hora automáticamente
      establecerFechaHora();
      
      return false; // Prevenir que se inserte el label en el input
    },
  });

  // ========== FUNCIÓN PARA ESTABLECER FECHA Y HORA AUTOMÁTICAMENTE ==========
  function establecerFechaHora() {
    const ahora = new Date();
    
    // Obtener componentes de fecha y hora
    const dia = String(ahora.getDate()).padStart(2, '0');
    const mes = String(ahora.getMonth() + 1).padStart(2, '0');
    const año = ahora.getFullYear();
    const horas = String(ahora.getHours()).padStart(2, '0');
    const minutos = String(ahora.getMinutes()).padStart(2, '0');
    const segundos = String(ahora.getSeconds()).padStart(2, '0');
    
  // Formato para MySQL: YYYY-MM-DD HH:MM:SS (24 horas)
  const fechaHoraFormato = `${año}-${mes}-${dia} ${horas}:${minutos}:${segundos}`;
    
    // Asignar al campo
    $("#fechaVerificacion").val(fechaHoraFormato);
  }

  // Establecer fecha y hora al cargar la página
  establecerFechaHora();
  // Adjuntar el handler de envío (asegura que el formulario tenga el comportamiento AJAX)
  RegistroVerificacion();
});

function RegistroVerificacion() {
    $("#formVerificacion").on("submit", function (event) {
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
            $("#formVerificacion")[0].reset();
            
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
