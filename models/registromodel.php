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
}
?>