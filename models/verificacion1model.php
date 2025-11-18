<?php
class Verificacion1model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function ListaPersonalPorDni($dni)
    {
        // Sanitizar entrada para prevenir SQL injection
        $dni = mysqli_real_escape_string($this->conn->conn, $dni);
        $sql = "SELECT idpersonal, dni, nombre, apellido, catLicencia, fechaPsicosomatico 
                FROM personal 
                WHERE dni LIKE '%$dni%';";
        $res = $this->conn->ConsultaCon($sql);
        return $res;
    }
    public function registroverificacion($idpersonal, $fechaVerificacion, $placaVehiculo)
    {
        // Usar prepared statements para evitar inyección SQL y asegurarnos del formato
        $mysqli = $this->conn->conn; // instancia de mysqli desde Conexion

        if ($stmt = $mysqli->prepare("INSERT INTO verificacion1 (idpersonal, fechaVerificacion, placaVehiculo) VALUES (?, ?, ?)")) {
            // idpersonal as integer, fecha and placa as strings
            $stmt->bind_param('iss', $idpersonal, $fechaVerificacion, $placaVehiculo);
            $ok = $stmt->execute();
            if ($stmt->error) {
                error_log('MySQL insert error: ' . $stmt->error);
            }
            $stmt->close();
            return $ok;
        } else {
            // Fallback: si no se puede preparar, usar el método existente (escapando valores)
            $idpersonal = (int)$idpersonal;
            $fechaVerificacion = $mysqli->real_escape_string($fechaVerificacion);
            $placaVehiculo = $mysqli->real_escape_string($placaVehiculo);
            $sql = "INSERT INTO verificacion1 (idpersonal, fechaVerificacion, placaVehiculo) VALUES ('$idpersonal', '$fechaVerificacion', '$placaVehiculo');";
            $res = $this->conn->ConsultaSin($sql);
            return $res;
        }
    }
    public function ListaPersonalV()
{
    $sql = "SELECT 
    p.idpersonal, 
    p.dni, 
    p.nombre, 
    p.apellido, 
    p.catLicencia, 
    p.fechaPsicosomatico, 
    v.idVerificacion1, 
    v.fechaVerificacion, 
    v.placaVehiculo 
FROM 
    personal p 
INNER JOIN
    verificacion1 v 
ON 
    p.idpersonal = v.idpersonal
ORDER BY 
    p.apellido ASC;
";

    $res = $this->conn->ConsultaCon($sql);
    return $res;
}

}
