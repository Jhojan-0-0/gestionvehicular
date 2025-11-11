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

	public function dni()
    {
        // Responder siempre JSON
        header('Content-Type: application/json; charset=utf-8');

        // Datos
        $token = 'apis-token-8574.bPsef4wHOYjVwA7bFoDMZqLLrNrAMKiY';
        $dni = isset($_POST["dni"]) ? trim($_POST["dni"]) : '';

        if (empty($dni)) {
            echo json_encode(['error' => 'DNI no recibido']);
            return;
        }

        // Iniciar llamada a API
        $curl = curl_init();
        // Buscar dni
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero=' . $dni,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 2,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Referer: https://apis.net.pe/consulta-dni-api',
                    'Authorization: Bearer ' . $token
                ),
            )
        );

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $err = curl_error($curl);
            curl_close($curl);
            echo json_encode(['error' => 'error de cURL: ' . $err]);
            return;
        }

        curl_close($curl);

        // Pasar respuesta tal cual (la API ya devuelve JSON), pero validar
        $decoded = json_decode($response, true);
        if ($decoded === null) {
            // Respuesta no es JSON válido
            echo json_encode(['error' => 'respuesta inválida de la API', 'raw' => $response]);
            return;
        }

        echo json_encode($decoded);

    }
    
}