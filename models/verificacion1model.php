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

}
