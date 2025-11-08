<?php

class registro extends Controller
{

	function __construct()
	{
		parent::__construct();
	}

	function render()
	{
        $datos = $this->model->ListaPersonal();
        $this->view->data = $datos;
		$this->view->Render('registro/index');
	}
	function createPersonal()
	{
		$dni = $_POST['dni'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
        $catLicencia = $_POST['catLicencia'];
        $fechaPsicosomatico = $_POST['fechaPsicosomatico'];
		if($this->model->CreatePersonal($dni,$nombre,$apellido,$catLicencia,$fechaPsicosomatico)){
			echo "REGISTRO EXITOSO";
		}else{
			echo "ERROR AL INSERTAR";
		}
	}

    
}