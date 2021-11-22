<?php
class TipoProcedimiento
{
    //=========================  Objeto de conexion con la base de datos
    public $db;

    //========================= Variables de la DB 
    public $id;
    public $nombre;
    public $costo;
    public $iva;

    //=========================  Datos de la tabla de la DB
    private $tablaNombre = "tipo_procedimiento";
    private $tablaId = "idtipo_procedimiento";

    //===========================================================
    // Funciones 
    //=========================================================== 

    //========================= Guardar nuevo registro 
    public function guardarTipoProcedimiento()
    {
        $query = "INSERT INTO $this->tablaNombre
			(nombre, costo, iva)

			 VALUES 
			 (
			 '$this->nombre',
			 '$this->costo',
			 '$this->iva'
			 )";

        $this->db->consulta($query);
    }

    //========================= Modificar registro 
    public function modificarTipoProcedimiento()
    {
        $query = "UPDATE $this->tablaNombre SET 
		nombre = '$this->nombre',
		costo = '$this->costo',
		iva = '$this->iva'

		WHERE $this->tablaId = '$this->id'";

        $this->db->consulta($query);
    }

    //========================= Consulta todos los registros
    public function getAllTipoProcedimiento()
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
    public function getOneTipoProcedimiento($id)
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
