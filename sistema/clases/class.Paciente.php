<?php
class Paciente
{
    //=========================  Objeto de conexion con la base de datos
    public $db;

    //========================= Variables de la DB 
    public $rfc;
    public $nombre;
    public $edad;
    public $sexo;
    public $telefono;
    public $tipo;

    //=========================  Datos de la tabla de la DB
    private $tablaNombre = "paciente";
    private $tablaId = "rfc";

    //===========================================================
    // Funciones 
    //=========================================================== 

    //========================= Guardar nuevo registro 
    public function guardarPaciente()
    {
        $query = "INSERT INTO $this->tablaNombre
			(rfc, nombre, edad, sexo, telefono, tipo_derecho_habiente)

			 VALUES 
			 (
			 '$this->rfc',
			 '$this->nombre',
			 '$this->edad',
			 '$this->sexo',
			 '$this->telefono',
			 '$this->tipo'
			 )";

        $this->db->consulta($query);
    }

    //========================= Modificar registro 
    public function modificarPaciente()
    {
        $query = "UPDATE $this->tablaNombre SET 
		rfc = '$this->rfc',
		nombre = '$this->nombre',
		edad = '$this->edad',
		sexo = '$this->sexo',
		telefono = '$this->telefono',
		tipo_derecho_habiente = '$this->tipo'

		WHERE $this->tablaId = '$this->rfc'";

        $this->db->consulta($query);
    }

    //========================= Consulta todos los registros
    public function getAllPaciente()
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
    public function getOnePaciente($id)
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
