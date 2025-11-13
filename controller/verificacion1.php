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