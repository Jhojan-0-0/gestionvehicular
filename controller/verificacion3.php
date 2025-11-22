<?php

class verificacion3 extends Controller
{

	function __construct()
	{
		parent::__construct();
	}

	function render()
	{
		$datos = $this->model->ListaFiltro();
        $this->view->data = $datos;
		$this->view->Render('verificacion3/index');
	}

	// Acción para búsqueda por DNI (autocompletar)
	public function dni()
	{
		if (isset($_GET['q'])) {
			$dni = $_GET['q'];
			$resultado = $this->model->ListaPersonalPorDni($dni);
			$data = array();

			foreach ($resultado as $row) {
				$temp['id'] = $row['idpersonal'];
				$temp['label'] = $row['dni'] . ' — ' . $row['nombre'] . ' ' . $row['apellido'];
				$temp['dni'] = $row['dni'];
				$temp['nombre'] = $row['nombre'];
				$temp['apellido'] = $row['apellido'];
				$temp['catLicencia'] = $row['catLicencia'];
				$temp['fechaVerificacion'] = $row['fechaVerificacion'];
				$temp['fechaPsicosomatico'] = $row['fechaPsicosomatico'];
				// incluir placa si está disponible
				$temp['placaVehiculo'] = isset($row['placaVehiculo']) ? $row['placaVehiculo'] : '';
				array_push($data, $temp);
			}

			echo json_encode($data, JSON_UNESCAPED_UNICODE);
			exit;
		}
	}

	// Acción para guardar en filtroPersonal
	function guardarFiltro()
	{
		$idpersonal = $_POST['idpersonal'];
		$estado = $_POST['estado'];
		if($this->model->registroFiltr($idpersonal,$estado)){
			echo "REGISTRO EXITOSO";
		}else{
			echo "ERROR AL INSERTAR";
		}
	}

    
	// Exportar listado como archivo Excel (HTML compatible)
	public function export()
	{
		// Obtener parámetros de fecha del formulario
		$fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : date('Y-m-d');
		$fecha_fin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : date('Y-m-d');

		// Obtener datos con filtro de fechas
		$resultado = $this->model->ListaFiltroConFechas($fecha_inicio, $fecha_fin);

		// Preparar headers para descarga
		header("Content-Type: application/vnd.ms-excel; charset=utf-8");
		header("Content-Disposition: attachment; filename=relacion_postulantes_" . date('Y-m-d_His') . ".xls");
		echo "<meta http-equiv=Content-Type content='text/html; charset=utf-8'/>";

		// Estilos
		echo "<style>";
		echo "body { font-family: Arial, Helvetica, sans-serif; }";
		echo "table { border-collapse:collapse; width:100%; }";
		echo "td, th { border: 1px solid #000; padding: 8px; text-align: center; }";
		echo ".title-main { font-size: 14pt; font-weight: bold; text-align: center; border: none; padding: 10px; background: none; }";
		echo ".subtitle { font-size: 12pt; text-align: center; border: none; padding: 5px; background: none; }";
		echo ".header-row { background: #FFFFFF; font-weight: bold; font-size: 11pt; }";
		echo ".data-row td { text-align: left; font-size: 10pt; }";
		echo ".data-row td:nth-child(1) { text-align: center; }";
		echo ".data-row td:nth-child(2) { text-align: center; }";
		echo ".data-row td:nth-child(5) { text-align: center; }";
		echo ".data-row td:nth-child(6) { text-align: center; }";
		echo ".data-row td:nth-child(7) { text-align: center; }";
		echo ".data-row td:nth-child(8) { text-align: center; }";
		echo ".data-row td:nth-child(10) { text-align: center; }";
		echo "</style>";

		// Título
		echo "<table>";
		echo "<tr><td colspan='11' class='title-main'>RELACION DE POSTULANTES PARA EL EXAMEN DE MANEJO PRACTICO (HABILIDADES)</td></tr>";
		
		// Obtener la fecha actual en formato día/mes/año hora
		$fecha_actual = date('d/m/Y');
		$hora_actual = date('H:i A');
		echo "<tr><td colspan='11' class='subtitle'>CIRCUITO DE MANEJO PATALLANI  $fecha_actual HORA $hora_actual</td></tr>";
		echo "</table>";

		echo "<br>";

		// Tabla con datos
		echo "<table>";
		echo "<thead>";
		echo "<tr class='header-row'>";
		echo "<th>N°</th>";
		echo "<th>PRIMER APELLIDO</th>";
		echo "<th>SEGUNDO APELLIDO</th>";
		echo "<th>NOMBRES</th>";
		echo "<th>DNI</th>";
		echo "<th>CLASE</th>";
		echo "<th>CAT.</th>";
		echo "<th>TRAMITE</th>";
		echo "<th>F. INICIAL</th>";
		echo "<th>DIAS PARA VENCER</th>";
		echo "<th>RESULTADO</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";

		$i = 1;
		while ($row = mysqli_fetch_assoc($resultado)) {
			// separar apellidos (primer y segundo)
			$apellidos = trim($row['apellido']);
			$parts = preg_split('/\\s+/', $apellidos);
			$primerApellido = isset($parts[0]) ? $parts[0] : '';
			$segundoApellido = isset($parts[1]) ? $parts[1] : '';

			$nombres = $row['nombre'];
			$dni = $row['dni'];
			$cat = $row['catLicencia'];

			// intentar deducir clase (ej: la letra inicial de la cat)
			$clase = '';
			if (!empty($cat)) {
				$clase = strtoupper(substr($cat, 0, 1));
			}

			// Obtener fecha inicial (fechaPsicosomatico formateado)
			$fechaInicial = '';
			if (!empty($row['fechaPsicosomatico']) && $row['fechaPsicosomatico'] != '0000-00-00') {
				$fechaInicial = date('d-m-Y', strtotime($row['fechaPsicosomatico']));
			}

			// calcular dias para vencer usando fechaPsicosomatico si existe
			$dias = '';
			if (!empty($row['fechaPsicosomatico']) && $row['fechaPsicosomatico'] != '0000-00-00') {
				$fecha = strtotime($row['fechaPsicosomatico']);
				$now = strtotime(date('Y-m-d'));
				$diasCalc = ceil(($fecha - $now) / 86400);
				$dias = $diasCalc . ' DIAS';
			}

			echo "<tr class='data-row'>";
			echo "<td>". $i ."</td>";
			echo "<td>".htmlspecialchars($primerApellido, ENT_QUOTES, 'UTF-8')."</td>";
			echo "<td>".htmlspecialchars($segundoApellido, ENT_QUOTES, 'UTF-8')."</td>";
			echo "<td style='text-align:left;'>".htmlspecialchars($nombres, ENT_QUOTES, 'UTF-8')."</td>";
			echo "<td>".htmlspecialchars($dni, ENT_QUOTES, 'UTF-8')."</td>";
			echo "<td>".htmlspecialchars($clase, ENT_QUOTES, 'UTF-8')."</td>";
			echo "<td>".htmlspecialchars($cat, ENT_QUOTES, 'UTF-8')."</td>";
			echo "<td>OBTENCION</td>"; // Tipo de trámite fijo
			echo "<td>".$fechaInicial."</td>";
			echo "<td>".$dias."</td>";
			echo "<td></td>"; // RESULTADO (vacío)
			echo "</tr>";

			$i++;
		}

		echo "</tbody></table>";
		exit;
	}

	
}