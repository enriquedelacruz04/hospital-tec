<?php
class Doctor
{
    //=========================  Objeto de conexion con la base de datos
    public $db;

    //========================= ID's
    // public $ultimoId;
    // public $id;

    //========================= Variables de la DB 
    public $cedula;
    public $nombre;
    public $edad;
    public $sexo;
    public $telefono;
    public $especialidad;

    //=========================  Datos de la tabla de la DB
    private $tablaNombre = "doctor";
    private $tablaId = "cedula";

    //===========================================================
    // Funciones 
    //=========================================================== 

    //========================= Guardar nuevo registro 
    public function guardarDoctor()
    {
        $query = "INSERT INTO $this->tablaNombre
			(cedula, nombre, edad, sexo, telefono, especialidad)

			 VALUES 
			 (
			 '$this->cedula',
			 '$this->nombre',
			 '$this->edad',
			 '$this->sexo',
			 '$this->telefono'
			 '$this->especialidad'
			 )";

        $result = $this->db->consulta($query);
        $this->ultimoId = $this->db->id_ultimo();
        return $result;
    }

    //========================= Modificar registro 
    public function modificarDoctor()
    {
        $query = "UPDATE $this->tablaNombre SET 
		idSucursales = '$this->idSucursal'

		WHERE $this->tablaId = '$this->id'";

        $result = $this->db->consulta($query);
        return $result;
    }

    //========================= Consulta todos los registros
    public function getAllDoctor()
    {
        $query = "SELECT * FROM doctor ";

        $result = $this->db->consulta($query);
        $numResult = $this->db->num_rows($result);

        if ($numResult > 0) {
            return $result;
        } else {
            return false;
        }
    }

    //========================= Consulta 1 registro 
    public function getOneDoctor($id)
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
