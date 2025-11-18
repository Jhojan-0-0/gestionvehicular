<?php

class verificacion1 extends Controller
{

	function __construct()
	{
		parent::__construct();
	}

	function render()
	{
		$this->view->Render('verificacion1/index');
	}

    function verificacionU()
	{
		$idpersonal = $_POST['idpersonal'];
        $fechaVerificacion = isset($_POST['fechaVerificacion']) ? trim($_POST['fechaVerificacion']) : '';
        // Intentar normalizar la fecha enviada (cliente envía DD/MM/YYYY HH:MM:SS)
        $fechaDB = '';
        if (!empty($fechaVerificacion)) {
            // Primer intento: formato día/mes/año
            $dt = DateTime::createFromFormat('d/m/Y H:i:s', $fechaVerificacion);
            if ($dt && $dt->format('d/m/Y H:i:s') === $fechaVerificacion) {
                $fechaDB = $dt->format('Y-m-d H:i:s');
            } else {
                // Segundo intento: formato ISO esperado por MySQL
                $dt2 = DateTime::createFromFormat('Y-m-d H:i:s', $fechaVerificacion);
                if ($dt2) {
                    $fechaDB = $dt2->format('Y-m-d H:i:s');
                } else {
                    // Fallback: usar fecha/hora actual en formato MySQL
                    $fechaDB = date('Y-m-d H:i:s');
                }
            }
        } else {
            $fechaDB = date('Y-m-d H:i:s');
        }
    $placaVehiculo = $_POST['placaVehiculo'];
    // Forzar id como entero simple para seguridad básica
    $idpersonal = (int)$idpersonal;

    if($this->model->registroverificacion($idpersonal,$fechaDB,$placaVehiculo)){
			echo "REGISTRO EXITOSO";
		}else{
			echo "ERROR AL INSERTAR";
		}
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
                $temp['fechaPsicosomatico'] = $row['fechaPsicosomatico'];
                array_push($data, $temp);
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

}