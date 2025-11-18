<?php

class verificacion3 extends Controller
{

	function __construct()
	{
		parent::__construct();
	}

	function render()
	{
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
	public function guardarFiltro()
	{
		// Leer datos POST
		$idpersonal = isset($_POST['idpersonal']) ? (int)$_POST['idpersonal'] : 0;
		$estado = isset($_POST['estado']) ? trim($_POST['estado']) : '';

		if ($idpersonal <= 0 || empty($estado)) {
			echo "ERROR: Datos incompletos";
			return;
		}

		if ($this->model->registroFiltro($idpersonal, $estado)) {
			echo "REGISTRO EXITOSO";
		} else {
			echo "ERROR AL INSERTAR";
		}
	}
	
}