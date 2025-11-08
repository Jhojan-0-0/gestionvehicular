<?php require('views/header.php'); ?>

<div class="grid-container">
	<br>
	<!-- Encabezado -->
	<div class="grid-x align-center">
		<h3 class="title1">1. Verificación de Inicio</h3>
	</div>

	<!-- Formulario principal -->
	<form action="<?php echo constant('URL') ?>proyectos/cd" 
			method="POST" 
			enctype="multipart/form-data" 
			class="tarea callout shadow" 
			id="signar-tareas">

		<div class="grid-x grid-padding-x">

		<!-- DNI -->
		<div class="cell small-12 medium-6 large-4">
			<label for="dni">DNI
			<input type="text" id="dni" name="dni">
			</label>
		</div>

		<!-- Apellidos -->
		<div class="cell small-12 medium-6 large-4">
			<label for="apellidos">Apellidos
			<input type="text" name="apellidos" id="apellidos" placeholder="Ingrese apellidos"readonly>
			</label>
		</div>

		<!-- Nombre -->
		<div class="cell small-12 medium-6 large-4">
			<label for="nombre">Nombre
			<input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre completo" readonly>
			</label>
		</div>

		<!-- Placa -->
		<div class="cell small-12 medium-6 large-4">
			<label for="placa">Placa
			<input type="text" name="placa" id="placa" placeholder="Ingrese número de placa">
			</label>
		</div>

		<!-- Consulta de placa -->
		<div class="cell small-12 medium-6 large-4">
			<label for="consulta_placa">Consulta de Placa
			<input type="text" name="consulta_placa" id="consulta_placa">
			</label>
		</div>

		<!-- Hora -->
		<div class="cell small-12 medium-6 large-4">
			<label for="hora">Hora
			<input type="time" name="hora" id="hora" readonly>
			</label>
		</div>

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

<?php require('views/footer.php'); ?>
