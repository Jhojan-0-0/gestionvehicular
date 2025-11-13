<?php require('views/header.php'); ?>

<div class="grid-container">
	<br>
	<!-- Encabezado -->
	<div class="grid-x align-center">
		<h3 class="title1">1. Verificación de Inicio</h3>
	</div>

	<!-- Formulario principal -->
<form class="verificacion1 callout" method="post" id="formPersonal">
		<div class="row">
		<div class="col-md-4">
			<label>DNI</label>
			<input type="text" id="dni" name="dni" class="form-control" placeholder="Ingrese DNI" maxlength="8" required>
			<input type="hidden" id="idpersonal" name="idpersonal">
		</div>
		<div class="col-md-4">
			<label>Nombre</label>
			<input type="text" id="nombre" name="nombre" class="form-control" disabled>
		</div>
		<div class="col-md-4">
			<label>Apellido</label>
			<input type="text" id="apellido" name="apellido" class="form-control" disabled>
		</div>
		<div class="col-md-4">
			<label>Categoría Licencia</label>
			<input type="text" id="catLicencia" name="catLicencia" class="form-control" disabled>
		</div>
		<div class="col-md-4">
			<label>Fecha Psicosomático</label>
			<input type="date" id="fechaPsicosomatico" name="fechaPsicosomatico" class="form-control" disabled>
		</div>
		</div>
<!-- Placa -->
		<div class="cell small-12 medium-6 large-4">
			<label for="placa">Placa
			<input type="text" name="placa" id="placa" placeholder="Ingrese número de placa">
			</label>
		</div>

		<!-- Hora -->
		<div class="cell small-12 medium-6 large-4">
			<label for="hora">Fecha y Hora
			<input type="text" name="hora" id="hora" readonly placeholder="Se cargará automáticamente">
			</label>
		</div>
		<!-- Botón de guardar -->
		<div class="grid-x">
		<div class="cell small-12 text-center">
			<button class="button" type="submit">
			<i class="fa-solid fa-floppy-disk"></i> Guardar
			</button>
		</div>
		</div>
</form>

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
<script src="<?php echo constant('URL') ?>public/js/verificacion1.js"></script> 

<?php require('views/footer.php'); ?>
