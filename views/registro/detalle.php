<?php require ('views/header.php'); ?>
<br>
<div class="grid-container">
    <div class="grid-x align-spaced callout shadow-h">
        <h2>Informacion de: <?php echo @$this->data['nombre'] ?></h2>
    </div>
<div class="grid-x grid-margin-x">
    <div class="cell grid-x small-12 medium-12 large-12 align-spaced">
        <form action="<?php echo constant('URL') ?>registro/updatePersonal" method="POST" id="update-personal">
        <div class="grid-x grid-margin-x callout shadow">
            <div class="cell large-12 grid-x text-center align-center">
                <input type="text" name="idpersonal" value="<?php echo @$this->data['idpersonal']; ?>" id="idpersonal-update" hidden style="display:none">
            </div>
            <div class="cell large-6">
                <label for="nombre">Nombres
                    <input type="text" id="nombre" name="nombre" value="<?php echo @$this->data['nombre']; ?>">
                </label>
            </div>
            <div class="cell large-6">
                <label for="apellido">Apellidos
                    <input type="text" id="apellido" name="apellido" value="<?php echo @$this->data['apellido']; ?>">
                </label>
            </div>
            <div class="cell large-6">
                <label for="dni">DNI
                    <input type="number" id="dni" name="dni" value="<?php echo @$this->data['dni']; ?>">
                </label>
            </div>
            <div class="cell large-6">
                <label for="catLicencia">Categoría de Licencia
                    <input type="text" id="catLicencia" name="catLicencia" value="<?php echo @$this->data['catLicencia']; ?>">
                </label>
            </div>
            <div class="cell large-6">
                <label for="fechaPsicosomatico">Fecha de Registro del Psicosomático
                    <input type="date" id="fechaPsicosomatico" name="fechaPsicosomatico" value="<?php echo @$this->data['fechaPsicosomatico']; ?>">
                </label>
            </div>
            <div class="cell large-6 text-center">
                <h6>._.</h6>
                <button class="hollow button success" style="border-radius: 20px;"><i class="fa-solid fa-retweet"></i> Actualizar</button>
            </div>
        </div>
    </form>
    <button class="hollow button warning" style="border-radius: 20px;" id="editar"><i class="fa fa-check-square"></i> Habilitar Edicion</button>
    <a href="<?php echo constant('URL') ?>registro" class="hollow button alert" style="border-radius: 20px;"> <i class="fa-solid fa-rotate-left"></i> Volver</a>
    </div>
</div>
</div>
<script>
    $("input").prop("disabled", true);
    let edicionHabilitada = false;

    $("#editar").click(function () {
        $("input").prop("disabled", false);
        edicionHabilitada = true;
    });

    $("#btnActualizar").click(function () {
        if (edicionHabilitada) {
            $("#update-personal").submit();
        } 
    });
</script>
<script src="<?php echo constant('URL') ?>public/js/registro.js"></script>
<?php require ('views/footer.php'); ?>