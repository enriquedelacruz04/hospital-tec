<?php
class Insumo
{
    //=========================  Objeto de conexion con la base de datos
    public $db;

    //========================= Variables de la DB 
    public $id;
    public $nombre;
    public $cantidad;
    public $marca;

    //=========================  Datos de la tabla de la DB
    private $tablaNombre = "insumo";
    private $tablaId = "idinsumo";

    //===========================================================
    // Funciones 
    //=========================================================== 

    //========================= Guardar nuevo registro 
    public function guardarInsumo()
    {
        $query = "INSERT INTO $this->tablaNombre
			(nombre, cantidad, marca)

			 VALUES 
			 (
			 '$this->nombre',
			 '$this->cantidad',
			 '$this->marca'
			 )";

        $this->db->consulta($query);
    }

    //========================= Modificar registro 
    public function modificarInsumo()
    {
        $query = "UPDATE $this->tablaNombre SET 
		nombre = '$this->nombre',
		cantidad = '$this->cantidad',
		marca = '$this->marca'

		WHERE $this->tablaId = '$this->id'";

        $this->db->consulta($query);
    }

    //========================= Consulta todos los registros
    public function getAllInsumo()
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
    public function getOneInsumo($id)
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
