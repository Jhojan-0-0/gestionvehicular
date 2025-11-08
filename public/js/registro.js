$(document).ready(function () {
    postRegistro();
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
