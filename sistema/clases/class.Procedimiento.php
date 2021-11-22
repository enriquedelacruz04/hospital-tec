<?php
class Procedimiento
{
    //=========================  Objeto de conexion con la base de datos
    public $db;

    //========================= Variables de la DB 
    public $cedula;
    public $nombre;
    public $edad;
    public $sexo;
    public $telefono;
    public $especialidad;
    public $hospitalNumero;

    //=========================  Datos de la tabla de la DB
    private $tablaNombre = "procedimiento";
    private $tablaId = "idprocedimiento";

    //===========================================================
    // Funciones 
    //=========================================================== 

    //========================= Guardar nuevo registro 
    public function guardarProcedimiento()
    {
        $query = "INSERT INTO $this->tablaNombre
        	(cedula, nombre, edad, sexo, telefono, especialidad, hospital_numero)

        	 VALUES 
        	 (
        	 '$this->cedula',
        	 '$this->nombre',
        	 '$this->edad',
        	 '$this->sexo',
        	 '$this->telefono',
        	 '$this->especialidad',
        	 '$this->hospitalNumero'
        	 )";

        $this->db->consulta($query);
    }

    //========================= Modificar registro 
    public function modificarProcedimiento()
    {
        $query = "UPDATE $this->tablaNombre SET 
		nombre = '$this->nombre',
		edad = '$this->edad',
		sexo = '$this->sexo',
		telefono = '$this->telefono',
		especialidad = '$this->especialidad',
		hospital_numero = '$this->hospitalNumero'

		WHERE $this->tablaId = '$this->cedula'";

        $this->db->consulta($query);
    }

    //========================= Consulta todos los registros
    public function getAllProcedimiento()
    {
        $query = "SELECT * FROM $this->tablaNombre ";
        $result = $this->db->consulta($query);
        $numResult = $this->db->num_rows($result);

        if ($numResult > 0) {
            return $result;
        } else {
            return false;
        }
    }

    //========================= Consulta 1 registro 
    public function getOneProcedimiento($id)
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
