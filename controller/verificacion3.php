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
		// Obtener datos
		$resultado = $this->model->ListaFiltro();

		// Intentar usar PhpSpreadsheet si está disponible
		if (!class_exists('\\PhpOffice\\PhpSpreadsheet\\Spreadsheet')) {
			$autoload = __DIR__ . '/../../vendor/autoload.php';
			if (file_exists($autoload)) {
				require_once $autoload;
			}
		}

		if (class_exists('\\PhpOffice\\PhpSpreadsheet\\Spreadsheet')) {
			// Generar .xlsx real
				$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();

			// Títulos
			$sheet->mergeCells('A1:K1');
			$sheet->setCellValue('A1', 'RELACION DE POSTULANTES PARA EL EXAMEN DE MANEJO PRACTICO (HABILIDADES)');
			$sheet->mergeCells('A2:K2');
			$sheet->setCellValue('A2', 'CIRCUITO DE MANEJO');

			// Encabezados (fila 4)
			$headerRow = 4;
			$headers = [
				'A' => 'N°', 'B' => 'PRIMER APELLIDO', 'C' => 'SEGUNDO APELLIDO', 'D' => 'NOMBRES', 'E' => 'DNI',
				'F' => 'CLASE', 'G' => 'CAT.', 'H' => 'TRAMITE', 'I' => 'E. MEDICO', 'J' => 'DIAS PARA VENCER', 'K' => 'RESULTADO'
			];
			foreach ($headers as $col => $text) {
				$sheet->setCellValue($col . $headerRow, $text);
			}

			// Estilos header
			$sheet->getStyle('A' . $headerRow . ':K' . $headerRow)->getFont()->setBold(true);
				$sheet->getStyle('A' . $headerRow . ':K' . $headerRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

			// Rellenar filas
			$i = 1;
			$rowIndex = $headerRow + 1;
			while ($row = mysqli_fetch_assoc($resultado)) {
				$apellidos = trim($row['apellido']);
				// usar última o primera estrategia: por defecto tomar dos primeras palabras
				$parts = preg_split('/\\s+/', $apellidos);
				$primerApellido = isset($parts[0]) ? $parts[0] : '';
				$segundoApellido = isset($parts[1]) ? $parts[1] : '';

				$nombres = $row['nombre'];
				$dni = $row['dni'];
				$cat = $row['catLicencia'];
				$clase = '';
				if (!empty($cat)) {
					$clase = strtoupper(substr($cat, 0, 1));
				}

				$dias = '';
				if (!empty($row['fechaPsicosomatico']) && $row['fechaPsicosomatico'] != '0000-00-00') {
					$fecha = strtotime($row['fechaPsicosomatico']);
					$now = strtotime(date('Y-m-d'));
					$diasCalc = ceil(($fecha - $now) / 86400);
					$dias = $diasCalc;
				}

				$sheet->setCellValue('A' . $rowIndex, $i);
				$sheet->setCellValue('B' . $rowIndex, $primerApellido);
				$sheet->setCellValue('C' . $rowIndex, $segundoApellido);
				$sheet->setCellValue('D' . $rowIndex, $nombres);
				$sheet->setCellValue('E' . $rowIndex, $dni);
				$sheet->setCellValue('F' . $rowIndex, $clase);
				$sheet->setCellValue('G' . $rowIndex, $cat);
				$sheet->setCellValue('H' . $rowIndex, '');
				$sheet->setCellValue('I' . $rowIndex, '');
				$sheet->setCellValue('J' . $rowIndex, $dias);
				$sheet->setCellValue('K' . $rowIndex, '');

				$i++;
				$rowIndex++;
			}

			// Ajustar ancho de columnas
			foreach (range('A','K') as $col) {
				$sheet->getColumnDimension($col)->setAutoSize(true);
			}

			// Bordes simples
			$lastRow = $rowIndex - 1;
			if ($lastRow >= $headerRow) {
					$sheet->getStyle('A' . $headerRow . ':K' . $lastRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
			}

			// Enviar salida
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="relacion_postulantes.xlsx"');
			header('Cache-Control: max-age=0');

				$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
			$writer->save('php://output');
			exit;
		} else {
			// Fallback: generar HTML (como antes) y avisar que para .xlsx instale PhpSpreadsheet
			// Preparar headers para descarga
			header("Content-Type: application/vnd.ms-excel; charset=utf-8");
			header("Content-Disposition: attachment; filename=relacion_postulantes.xls");
			echo "<meta http-equiv=Content-Type content='text/html; charset=utf-8'/>";

			// Título similar al de la imagen
			echo "<table><tr><td colspan='12' style='font-size:18pt; font-weight:bold; text-align:center;'>RELACION DE POSTULANTES PARA EL EXAMEN DE MANEJO PRACTICO (HABILIDADES)</td></tr>";
			echo "<tr><td colspan='12' style='text-align:center;'>CIRCUITO DE MANEJO</td></tr>";
			echo "</table>";

			// Estilos e inicio de tabla
			echo "<table border='1' style='border-collapse:collapse; width:100%; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>";
			echo "<thead style='background:#ddd; font-weight:bold; text-align:center;'>";
			echo "<tr>";
			echo "<th>N°</th>";
			echo "<th>PRIMER APELLIDO</th>";
			echo "<th>SEGUNDO APELLIDO</th>";
			echo "<th>NOMBRES</th>";
			echo "<th>DNI</th>";
			echo "<th>CLASE</th>";
			echo "<th>CAT.</th>";
			echo "<th>TRAMITE</th>";
			echo "<th>E. MEDICO</th>";
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

				// calcular dias para vencer usando fechaPsicosomatico si existe
				$dias = '';
				if (!empty($row['fechaPsicosomatico']) && $row['fechaPsicosomatico'] != '0000-00-00') {
					$fecha = strtotime($row['fechaPsicosomatico']);
					$now = strtotime(date('Y-m-d'));
					$diasCalc = ceil(($fecha - $now) / 86400);
					$dias = $diasCalc;
				}

				echo "<tr>";
				echo "<td style='text-align:center;'>". $i ."</td>";
				echo "<td>".htmlspecialchars($primerApellido, ENT_QUOTES, 'UTF-8')."</td>";
				echo "<td>".htmlspecialchars($segundoApellido, ENT_QUOTES, 'UTF-8')."</td>";
				echo "<td>".htmlspecialchars($nombres, ENT_QUOTES, 'UTF-8')."</td>";
				echo "<td style='text-align:center;'>".htmlspecialchars($dni, ENT_QUOTES, 'UTF-8')."</td>";
				echo "<td style='text-align:center;'>".htmlspecialchars($clase, ENT_QUOTES, 'UTF-8')."</td>";
				echo "<td style='text-align:center;'>".htmlspecialchars($cat, ENT_QUOTES, 'UTF-8')."</td>";
				echo "<td></td>"; // TRAMITE (no disponible)
				echo "<td></td>"; // E. MEDICO (no disponible)
				echo "<td style='text-align:center;'>".htmlspecialchars($dias, ENT_QUOTES, 'UTF-8')."</td>";
				echo "<td></td>"; // RESULTADO
				echo "</tr>";

				$i++;
			}

			echo "</tbody></table>";
			exit;
		}
	}

	
}