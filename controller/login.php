<?php

class Login extends Controller
{

	function __construct()
	{
		parent::__construct();
	}

	function render()
	{
		$this->view->Render('login/index');
	}
	public function logIn()
	{
		$user = trim(strtolower($_POST['usuario']));
		$pass = trim(strtolower($_POST['password']));
		#nivusu, chkusu, idpersonal
		$datos = $this->model->validar($user,$pass);

		if($datos['estado'])
		{
			#echo "Usuario Activo";
			switch ($datos['nivusu']) {
				case 1:
					// Administrador...
					break;
				case 2:
				   // Personal
				$_SESSION['katari'] = $datos['idusuario'];
				header("Location: ".constant('URL')."/registro");
					break;
				break;
			}
		}else{
			echo "Usuario no activo";
			header('location:'.constant('URL'));
		}

	}
	public function logout()
	{
		session_destroy();
		$_SESSION['katari'] = '';
		$_SESSION['username'] = '';
		$_SESSION['nivel'] = '';
		$_SESSION['idusuario'] = '';
		header("Location: ". constant('URL'));
	}
}