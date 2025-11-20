<?php
class Registromodel extends Model{
    function __construct()
    {
        parent::__construct();
    }
    public function CreatePersonal($dni, $nombre, $apellido, $catLicencia, $fechaPsicosomatico)
    {
        $sql = "INSERT INTO personal (dni, nombre, apellido, catLicencia, fechaPsicosomatico) VALUES ('$dni', '$nombre', '$apellido', '$catLicencia', '$fechaPsicosomatico');";
        $res = $this->conn->ConsultaSin($sql);
        return $res;
    }
    public function ListaPersonal()
    {
        $sql = "SELECT * FROM personal;";
        $res = $this->conn->ConsultaCon($sql);
        return $res;
    }
    // Verifica si un DNI ya existe en la tabla personal. Retorna true si existe, false si no.
    public function ExistsDni($dni)
    {
    // La propiedad conn es una instancia de Conexion; el objeto mysqli está en $this->conn->conn
    $dni = isset($this->conn->conn) ? $this->conn->conn->real_escape_string($dni) : $dni;
        $sql = "SELECT COUNT(*) AS c FROM personal WHERE dni = '$dni'";
        $res = $this->conn->ConsultaArray($sql);
        if ($res === false) {
            return false;
        }
        return isset($res['c']) && intval($res['c']) > 0;
    }
}
?>