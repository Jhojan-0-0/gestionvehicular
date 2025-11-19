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
        INNER JOIN verificacion1 v ON p.idpersonal = v.idpersonal 
        WHERE p.dni LIKE '%$dni%';";
        $res = $this->conn->ConsultaCon($sql);
        return $res;
    }

    // Registrar en la tabla filtroPersonal
    public function registroFiltr($idpersonal, $estado)
    {
        $sql = "INSERT INTO filtroPersonal (idpersonal, estado) VALUES ('$idpersonal', '$estado');";
        $res = $this->conn->ConsultaSin($sql);
        return $res;
    }

    public function ListaFiltro()
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
            v.placaVehiculo,

            f.idFiltro,
            f.estado

        FROM filtroPersonal f
        INNER JOIN personal p ON f.idpersonal = p.idpersonal
        LEFT JOIN verificacion1 v ON p.idpersonal = v.idpersonal;
        ";
        $res = $this->conn->ConsultaCon($sql);
        return $res;
    }
}
