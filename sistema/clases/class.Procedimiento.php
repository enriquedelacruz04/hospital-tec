<?php
class Procedimiento
{
    //=========================  Objeto de conexion con la base de datos
    public $db;

    public $id;

    //========================= Variables de la DB 
    public $fecha;
    public $hora;

    // id foraneas
    public $paciente;
    public $tipoProcedimeinto;
    public $doctor;
    public $insumo;

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
        	(paciente_rfc, tipo_procedimiento_idtipo_procediento, doctor_cedula, insumo_idinsumo, fecha, hora)

        	 VALUES 
        	 (
        	 '$this->paciente',
        	 '$this->tipoProcedimeinto',
        	 '$this->doctor',
        	 '$this->insumo',
        	 '$this->fecha',
        	 '$this->hora'
        	 )";

        $this->db->consulta($query);
    }

    //========================= Modificar registro 
    public function modificarProcedimiento()
    {
        $query = "UPDATE $this->tablaNombre SET 
		paciente_rfc = '$this->paciente',
		tipo_procedimiento_idtipo_procediento = '$this->tipoProcedimeinto',
		doctor_cedula = '$this->doctor',
		insumo_idinsumo = '$this->insumo',
		fecha = '$this->fecha',
		hora = '$this->hora'

		WHERE $this->tablaId = '$this->id'";

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
