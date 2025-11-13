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
    
    // Formato: DD/MM/YYYY HH:MM:SS (24 horas)
    const fechaHoraFormato = `${dia}/${mes}/${año} ${horas}:${minutos}:${segundos}`;
    
    // Asignar al campo
    $("#hora").val(fechaHoraFormato);
  }

  // Establecer fecha y hora al cargar la página
  establecerFechaHora();
});

