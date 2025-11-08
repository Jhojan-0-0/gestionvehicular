<?php require('views/header.php'); ?>

<div class="grid-container">
	<br>
	<!-- Encabezado principal -->
	<div class="grid-x align-center">
		<h3 class="title1">Filtro de Postulantes</h3>
	</div>

	<!-- Botón de consulta general -->
	<div class="grid-x text-center">
		<div class="cell small-12 medium-12 large-12">
		<button id="btn-completado" class="button" style="border-radius: 40px;">
			<i class="fa fa-search"></i> Consulta Desaprobados
		</button>
		</div>
	</div>

	<!-- Formulario de consulta por DNI -->
	<form action="<?php echo constant('URL') ?>proyectos/createTarea" 
			method="POST" 
			enctype="multipart/form-data" 
			class="tarea callout" 
			id="signar-tareas">

		<div class="grid-x grid-padding-x">

		<!-- DNI -->
		<div class="cell small-12 medium-6 large-4">
			<label for="dni">DNI
			<input type="text" id="dni" name="dni" placeholder="Ingrese su DNI">
			</label>
		</div>

		<!-- Apellidos -->
		<div class="cell small-12 medium-6 large-4">
			<label for="apellidos">Apellidos
			<input type="text" name="apellidos" id="apellidos" placeholder="Ingrese apellidos" readonly>
			</label>
		</div>

		<!-- Nombre -->
		<div class="cell small-12 medium-6 large-4">
			<label for="nombre">Nombre
			<input type="text" name="nombre" id="nombre" placeholder="Ingrese nombres" readonly>
			</label>
		</div>

		<!-- Placa -->
		<div class="cell small-12 medium-6 large-4">
			<label for="placa">Placa
			<input type="text" name="placa" id="placa" placeholder="Ingrese placa">
			</label>
		</div>

		<!-- Hora -->
		<div class="cell small-12 medium-6 large-4">
			<label for="hora">Hora
			<input type="time" name="hora" id="hora" readonly>
			</label>
		</div>

		<!-- Consulta de placa -->
		<div class="cell small-12 medium-6 large-4">
			<label for="consulta_placa">Consulta de Placa
			<input type="text" name="consulta_placa" id="consulta_placa">
			</label>
		</div>

		<!-- Categoría de licencia -->
		<div class="cell small-12 medium-6 large-4">
			<label for="categoria_licencia">Categoría de Licencia
			<input type="text" name="categoria_licencia" id="categoria_licencia" placeholder="Ejemplo: A-IIb">
			</label>
		</div>

		<!-- Fecha de registro del sicosomático -->
		<div class="cell small-12 medium-6 large-4">
			<label for="fecha_registro">Fecha de Registro del Sicosomático
			<input type="date" name="fecha_registro" id="fecha_registro">
			</label>
		</div>
		</div>

		<!-- Botones de aprobación/desaprobación -->
		<div class="grid-x text-center">
		<div class="cell small-12 medium-6 large-6">
			<button id="btn-aprobado" class="button warning" style="border-radius: 40px;">
			<i class="fa fa-window-close" aria-hidden="true"></i> Aprobado
			</button>
		</div>
		<div class="cell small-12 medium-6 large-6">
			<button id="btn-desaprobado" class="button success" style="border-radius: 40px;">
			<i class="fa fa-check-square" aria-hidden="true"></i> Desaprobado
			</button>
		</div>
		</div>

		<br>

		<!-- Botón guardar -->
		<div class="grid-x">
		<div class="cell small-12 text-center">
			<button class="button" type="submit">
			<i class="fa-solid fa-floppy-disk"></i> Guardar
			</button>
		</div>
		</div>

	</form>

	<br>

	<!-- Tabla de resultados -->
	<div id="tabla-pendiente">
		<div class="cell small-12">
		<h3 class="title2 text-center">Lista de Postulantes</h3>
		<table class="stack text-center">
			<thead>
			<tr>
				<th>N°</th>
				<th>DNI</th>
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>Placa</th>
				<th>Licencia</th>
				<th>Estado</th>
				<th>Observaciones</th>
				<th>Acciones</th>
			</tr>
			</thead>
			<tbody id="observaciones-P">
			<!-- Se llenará dinámicamente -->
			</tbody>
		</table>
		</div>
	</div>
	<br>
</div>

<?php require('views/footer.php'); ?>
