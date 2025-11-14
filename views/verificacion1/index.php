<?php require('views/header.php'); ?>

<div class="grid-container">
	<br>
	<!-- Encabezado -->
	<div class="grid-x align-center">
		<h3 class="title1">1. Verificación de Inicio</h3>
	</div>

	<div class="center-screen">
	<form action="<?php echo constant('URL') ?>verificacion1/verificacionU" 
			method="post" id="formPersonal" class="translucent-form-overlay">
		<label>DNI
			<input type="text" id="dni" name="dni" placeholder="Ingrese DNI" 
				maxlength="8" required 
				oninput="this.value = this.value.replace(/[^0-9]/g, '');">
		</label>

		<input type="hidden" id="idpersonal" name="idpersonal">

		<label>Nombre
			<input type="text" id="nombre" name="nombre" readonly>
		</label>

		<label>Apellido
			<input type="text" id="apellido" name="apellido" readonly>
		</label>

		<label>Categoría de Licencia
			<input type="text" id="catLicencia" name="catLicencia" readonly>
		</label>

		<label>Fecha Psicosomático
			<input type="date" id="fechaPsicosomatico" name="fechaPsicosomatico" readonly>
		</label>

		<label>Placa
			<input type="text" id="placa" name="placa" placeholder="Ingrese número de placa">
		</label>

		<label>Fecha y Hora
			<input type="text" id="hora" name="hora" placeholder="Se cargará automáticamente" readonly>
		</label>

		<button type="submit" class="primary button expanded search-button">
			<i class="fa-solid fa-floppy-disk"></i> Guardar
		</button>

	</form>
	</div>
<br>	

	<!-- Tabla de lista -->
	<div class="grid-x">
		<div class="cell small-12 medium-12 large-12">
		<h3 class="title2 text-center callout">Lista de Registros</h3>
		<div class="grid-x text-center">
			<table class="stack">
			<thead>
				<tr>
				<th class="text-center">N°</th>
				<th class="text-center">DNI</th>
				<th class="text-center">Apellidos</th>
				<th class="text-center">Nombre</th>
				<th class="text-center">Placa</th>
				<th class="text-center">Hora</th>
				<th class="text-center">Consulta de Placa</th>
				<th class="text-center">Acciones</th>
				</tr>
			</thead>
			<tbody>
				<!-- Los registros se cargan dinámicamente -->
			</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<style>
	/* Centrado total */
.center-screen {
  width: 100%;
  height: 100vh; /* ocupa toda la altura del viewport */
  display: flex;
  justify-content: center; /* horizontal */
  align-items: center;     /* vertical */
}

/* Mantén tu estilo existente */
.translucent-form-overlay {
  max-width: 500px;
  width: 100%;
  background-color: rgba(54, 54, 54, 0.8);
  padding: 20px;
  color: #fefefe;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
}

.translucent-form-overlay h3,
.translucent-form-overlay label {
  color: #fefefe;
}

.translucent-form-overlay input {
  color: #333;
}

.translucent-form-overlay input::placeholder {
  color: #8a8a8a;
}

</style>
<script src="<?php echo constant('URL') ?>public/js/verificacion1.js"></script> 

<?php require('views/footer.php'); ?>
