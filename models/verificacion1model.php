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
    /**
     * Verifica si ya existe un registro en verificacion1 para el idpersonal dado.
     * Devuelve true si existe, false si no.
     */
    public function existeRegistroPorIdPersonal($idpersonal)
    {
        $mysqli = $this->conn->conn;
        // Asegurar entero
        $idpersonal = (int)$idpersonal;
        if ($stmt = $mysqli->prepare("SELECT COUNT(*) FROM verificacion1 WHERE idpersonal = ?")) {
            $stmt->bind_param('i', $idpersonal);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();
            return ($count > 0);
        } else {
            // Fallback si no hay prepare: consulta directa (menos seguro)
            $sql = "SELECT COUNT(*) as c FROM verificacion1 WHERE idpersonal = '" . $mysqli->real_escape_string($idpersonal) . "'";
            $res = $this->conn->ConsultaCon($sql);
            if ($res && $row = mysqli_fetch_assoc($res)) {
                return ((int)$row['c'] > 0);
            }
            return false;
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
    public function GetPersonalId($id)
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
                WHERE 
                    p.idpersonal = '$id'
                ORDER BY 
                    p.apellido ASC";

        $data = $this->conn->ConsultaArray($sql);
        return $data;
    }

    public function updateVerificacion1($idpersonal, $placaVehiculo)
    {
        $sql = "UPDATE `verificacion1` SET `placaVehiculo` = '$placaVehiculo' WHERE (`idpersonal` = '$idpersonal');";
        $res = $this->conn->ConsultaSin($sql);
        return $res;
    }

}
