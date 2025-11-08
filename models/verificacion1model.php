<?php
class Verificacion1model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

     public function BuscarPorDni($dni)
    {
        // Consulta con búsqueda parcial
        $sql = "SELECT idpersonal, nombre, apellido, dni, telefono, email, sexo 
                FROM personal 
                WHERE dni LIKE '%$dni%';";

        // Usamos tu método de conexión
        $res = $this->conn->ConsultaCon($sql);

        $data = [];

        foreach ($res as $row) {
            $data[] = [
                "id"        => $row["idpersonal"],
                "label"     => $row["dni"] . " - " . $row["nombre"] . " " . $row["apellido"],
                "dni"       => $row["dni"],
                "nombre"    => $row["nombre"],
                "apellido"  => $row["apellido"],
                "telefono"  => $row["telefono"],
                "email"     => $row["email"],
                "sexo"      => $row["sexo"]
            ];
        }

        return $data;
    }
}
