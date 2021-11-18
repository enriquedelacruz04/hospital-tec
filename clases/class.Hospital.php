<?php
class Hospital
{
    //=========================  Objeto de conexion con la base de datos
    public $db;

    //========================= ID's
    // public $ultimoId;
    // public $id;

    //========================= Variables de la DB 
    public $numero;
    public $nombre;
    public $direccion;
    public $telefono;
    public $correo;

    //=========================  Datos de la tabla de la DB
    private $tablaNombre = "hospital";
    private $tablaId = "numero";

    //===========================================================
    // Funciones 
    //=========================================================== 

    //========================= Guardar nuevo registro 
    public function guardarHospital()
    {
        $query = "INSERT INTO $this->tablaNombre
			(numero, nombre, direccion, telefono, correo)

			 VALUES 
			 (
			 '$this->numero',
			 '$this->nombre',
			 '$this->direccion',
			 '$this->telefono',
			 '$this->correo'
			 )";

        $result = $this->db->consulta($query);
        $this->ultimoId = $this->db->id_ultimo();
        return $result;
    }

    //========================= Modificar registro 
    public function modificarHospital()
    {
        $query = "UPDATE $this->tablaNombre SET 
		idSucursales = '$this->idSucursal'

		WHERE $this->tablaId = '$this->id'";

        $result = $this->db->consulta($query);
        return $result;
    }

    //========================= Consulta todos los registros
    public function getAllHospital()
    {
        $query = "SELECT * FROM $this->tablaNombre";
        $result = $this->db->consulta($query);
        $numResult = $this->db->num_rows($result);

        if ($numResult > 0) {
            return $result;
        } else {
            return false;
        }
    }

    //========================= Consulta 1 registro 
    public function getOneHospital($id)
    {
        $query = "SELECT * FROM $this->tablaNombre WHERE $this->tablaId = $id";
        $result = $this->db->consulta($query);
        $numResult = $this->db->num_rows($result);
        $rowResult = $this->db->fetch_assoc($result);

        if ($numResult > 0) {
            return $rowResult;
        } else {
            return false;
        }
    }
}
