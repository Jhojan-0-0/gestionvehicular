<?php
class Verificacion3model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    // Buscar personal por DNI para autocompletar
    public function ListaPersonalPorDni($dni)
    {
        $dni = mysqli_real_escape_string($this->conn->conn, $dni);
    // También obtener la última placa registrada (si existe) desde la tabla verificacion1
    $sql = "SELECT p.idpersonal, p.dni, p.nombre, p.apellido, p.catLicencia, p.fechaPsicosomatico, v.placaVehiculo , v.fechaVerificacion 
        FROM personal p 
        LEFT JOIN verificacion1 v ON p.idpersonal = v.idpersonal 
        WHERE p.dni LIKE '%$dni%';";
        $res = $this->conn->ConsultaCon($sql);
        return $res;
    }

    // Registrar en la tabla filtroPersonal
    public function registroFiltro($idpersonal, $estado)
    {
        $mysqli = $this->conn->conn;

        if ($stmt = $mysqli->prepare("INSERT INTO filtroPersonal (idpersonal, estado) VALUES (?, ?)")) {
            $stmt->bind_param('is', $idpersonal, $estado);
            $ok = $stmt->execute();
            if ($stmt->error) {
                error_log('MySQL insert filtroPersonal error: ' . $stmt->error);
            }
            $stmt->close();
            return $ok;
        } else {
            // fallback
            $idpersonal = (int)$idpersonal;
            $estado = $mysqli->real_escape_string($estado);
            $sql = "INSERT INTO filtroPersonal (idpersonal, estado) VALUES ('$idpersonal', '$estado');";
            $res = $this->conn->ConsultaSin($sql);
            return $res;
        }
    }

}
