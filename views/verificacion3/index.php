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
		<button id="btn-consulta" class="button" style="border-radius: 40px;">
			<i class="fa fa-search"></i> Consulta Desaprobados
		</button>
		</div>
	</div>

	<!-- Formulario de consulta por DNI (diseño ordenado y centrado) -->
	<div class="center-screen callout shadow">
	<form action="<?php echo constant('URL') ?>verificacion3/guardarFiltro" 
			method="POST" 
			enctype="multipart/form-data" 
			class="translucent-form-overlay" id="PostFiltro">

		<h4 class="text-center">Completar datos por DNI</h4>

		<div class="grid-x grid-padding-x align-center">

			<!-- Columna 1 -->
			<div class="cell small-12 medium-6">
				<label for="dni">DNI
				<input type="text" id="dni" name="dni" placeholder="Ingrese su DNI" maxlength="8" required oninput="this.value = this.value.replace(/[^0-9]/g, '');">
				</label>

				<input type="hidden" id="idpersonal" name="idpersonal">

				<label for="apellidos">Apellidos
				<input type="text" name="apellidos" id="apellidos" placeholder="Apellidos" readonly>
				</label>

				<label for="catLicencia">Categoría de Licencia
				<input type="text" name="catLicencia" id="catLicencia" placeholder="Ejemplo: A-IIb" readonly>
				</label>
			</div>

			<!-- Columna 2 -->
			<div class="cell small-12 medium-6">
				<label for="nombre">Nombre
				<input type="text" name="nombre" id="nombre" placeholder="Nombres" readonly>
				</label>

				<label for="placaVehiculo">Placa
				<input type="text" name="placaVehiculo" id="placaVehiculo" placeholder="Ingrese placa" readonly>
				</label>

				<label for="fechaPsicosomatico">Fecha Psicosomático
				<input type="date" name="fechaPsicosomatico" id="fechaPsicosomatico" readonly>
				</label>
			</div>

			<!-- Fecha y hora completo (una sola fila) -->
			<div class="cell small-12">
				<label for="fechaVerificacion">Fecha y Hora de primera Verificacion
				<input type="text" name="fechaVerificacion" id="fechaVerificacion" placeholder="Fecha y Hora" readonly>
				</label>
			</div>

			<!-- Botones de acción y estado -->
			<div class="cell small-12">
				<div class="grid-x grid-margin-x align-middle">
					<div class="cell small-12 medium-4 text-center">
						<button id="btn-aprobado" type="button" class="button expanded warning" style="border-radius: 40px;">
						<i class="fa fa-window-close" aria-hidden="true"></i> Aprobado
						</button>
					</div>
					<div class="cell small-12 medium-4 text-center">
						<button id="btn-desaprobado" type="button" class="button expanded success" style="border-radius: 40px;">
						<i class="fa fa-check-square" aria-hidden="true"></i> Desaprobado
						</button>
					</div>
					<div class="cell small-12 medium-4 text-center">
						<label for="estadoVisible">Estado
						<input type="text" id="estadoVisible" name="estadoVisible" readonly>
						</label>
					</div>
				</div>
				<input type="hidden" id="estado" name="estado" value="">
			</div>

			<!-- Botón guardar centrado -->
			<div class="cell small-12 text-center">
				<button class="button primary" type="submit" style="border-radius: 40px; max-width:220px;">
				<i class="fa-solid fa-floppy-disk"></i> Guardar
				</button>
			</div>

		</div>

	</form>
	</div>

	<div class="grid-x text-center callout shadow">
		<div class="cell small-6 medium-6 large-6">
			<h3 class="title2 text-center">Exportar En Tabla Exel El listado de Registro</h3>
		</div>
		<div class="cell small-6 medium-6 large-6">
			<a href="<?php echo constant('URL') ?>verificacion3/export" class="button success" style="border-radius: 40px;">Exportar</a>
		</div>
	</div>
	<br>

	<!-- Tabla de resultados -->
	<div id="tabla-pendiente">
		<div class="cell small-12">
		<h3 class="title2 text-center">Lista de Postulantes</h3>
		<table id="export-table" class="stack text-center">
			<thead>
			<tr>
				<th>N°</th>
				<th>Apellidos</th>
				<th>Nombre</th>
				<th>DNI</th>
				<th>Categoría Licencia</th>
				<th>Fecha Registro Psicosomático</th>
				<th>Placa</th>
				<th>Fecha de 1 Verificacion</th>
				<th>Acciones</th>
			</tr>
			</thead>
			<tbody>
			<?php
			while($row = mysqli_fetch_assoc($this->data)){
				echo "<tr>
						<td>".$row['idpersonal']."</td>
						<td>".$row['apellido']."</td>
						<td>".$row['nombre']."</td>
						<td>".$row['dni']."</td>		
						<td>".$row['catLicencia']."</td>
						<td>".$row['fechaPsicosomatico']."</td>
						<td>".$row['placaVehiculo']."</td>
						<td>".$row['fechaVerificacion']."</td>
						<td>".$row['estado']."</td>
						<td>
							<button class='secondary button'>Editar</button>
						</td>
					</tr>";
			}
			?>	
			</tbody>
		</table>
		</div>
	</div>
	<br>
</div>

<script src="<?php echo constant('URL') ?>public/js/verificacion3.js"></script>

<?php require('views/footer.php'); ?>
