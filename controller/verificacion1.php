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
		echo $dni = $_POST['idpersonal'];
		echo $nombre = $_POST['dni'];
		echo $apellido = $_POST['nombre'];
        echo $catLicencia = $_POST['apellido'];
        echo $fechaPsicosomatico = $_POST['catLicencia'];
        echo $fechaPsicosomatico = $_POST['fechaPsicosomatico'];
        echo $fechaPsicosomatico = $_POST['placa'];
        echo $fechaPsicosomatico = $_POST['hora'];
        // if($this->model->CreatePersonal($dni,$nombre,$apellido,$catLicencia,$fechaPsicosomatico)){
		// 	echo "REGISTRO EXITOSO";
		// }else{
		// 	echo "ERROR AL INSERTAR";
		// }
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