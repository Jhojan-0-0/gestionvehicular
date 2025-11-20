<?php require ('views/header.php');?>
	<div class="grid-container">
		<!-- Poner el codigo en HTML aqui -->
        <!-- <div class="grid-x align-center callout shadow">
			<h3 class="title1">2 Verificacion fi</h3>
		</div>
		<form action="<?php echo constant('URL') ?>proyectos/createTarea" method="POST" class="tarea callout shadow" id="signar-tareas">
			<div class="grid-x grid-padding-x">
				<div class="cell small-12 medium-12 large-12 text-center">
					<label for="">Proyecto
					<input type="text" id="" value="<?php echo $project['nombreCorto']; ?>" readonly>
					</label>
				</div>
				<input type="hidden" name="idproyecto" id="idproyecto" value="<?php echo $project['idproyecto']; ?>">
				<div class="cell small-12 medium-12 large-4">
					<label for="idrequisito">Tareas
					<select name="idrequisito" id="idrequisito" >
							<option value="" selected disabled>[Seleccionar]</option>
						</select>
					</label>
				</div>
				<div class="cell small-12 medium-12 large-4">
					<div id="resultado"></div>
					<label for="txtprioridad">Prioridad de la Tarea
						<input type="number" name="txtprioridad" id="txtprioridad" readonly>
					</label>
					<label for="estado" style="display: none;">
						<select name="estado" id="estado" >
							<option value="desarrollo">Desarrollo</option >
						</select>
					</label>
				</div>
				<div class="cell small-12 medium-12 large-4">
					<label for="txtunidadMedida">Dias
						<input type="text" name="txtunidadMedida" id="txtunidadMedida" readonly>
					</label>
				</div>
			</div>
			<div class="grid-x grid-padding-x">
				<div class="cell small-12 medium-12 large-4">
					<label for="txtfechaInicio">Fecha Inicio
						<input type="date" name="txtfechaInicio" id="txtfechaInicio" onchange="calcularDiferencia()">
					</label>
				</div>
				<div class="cell small-12 medium-12 large-4">
					<label for="txtfechaFin">Fecha Fin
						<input type="date" name="txtfechaFin" id="txtfechaFin" onchange="calcularDiferencia()">
					</label>
				</div>
				<div class="cell small-12 medium-12 large-4">
					<label for="txttiempoHoras">Horas
						<input type="text" name="txttiempoHoras" id="txttiempoHoras">
					</label>
				</div>
			</div>
			<div class="grid-x grid-padding-x">
				<div class="cell small-12 medium-12 large-6">
					<label for="">Lista de Desarrolladores
						<select name="lstPersonal1" id="lstPersonal1" size="10" multiple="multiple">
						</select>
					</label>
				</div>

				<div class="cell small-12 medium-12 large-6">
					<label for="lstPersonal2">Responsables
						<select name="lstPersonal2" id="lstPersonal2" size="10" multiple="multiple"></select>
						<input type="hidden" name="responsables" id="responsables" required>
					</label>
				</div>
			</div>

			<div class="grid-x">
				<div class="cell small-12 medium-12 large-12 text-center">
				<button class="button" type="submit"> <i class="fa-solid fa-floppy-disk"></i> Guardar</button>
				</div>
			</div>
		</form>
		<hr>
		<div class="grid-x callout shadow">
    <div class="cell small-12 medium-12 large-12">
        <h3 class="title2 text-center callout ">Lista de Tareas a Desarrollar</h3>
        <div class="grid-x text-center">
            <table class="stack">
                <thead>
                    <tr>
                        <th class="text-center">N°</th>
                        <th class="text-center">Tarea</th>
                        <th class="text-center">Prioridad</th>
                        <th class="text-center">Fecha Inicio</th>
                        <th class="text-center">Fecha Fin</th>
                        <th class="text-center">Horas de Desarrollo</th>
                        <th class="text-center">Dias</th>
                        <th class="text-center">Responsables</th>
                        <th class="text-center" colspan="1">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div> -->


	</div>

<script src="<?php echo constant('URL') ?>public/js/tareas.js"></script>

<?php require ('views/footer.php');?>