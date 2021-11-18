<?php
class Archivos
{
    //---------------------- Objeto de conexion con la base de datos
    public $db;

    //---------------------- ID's
    public $ultimoId;
    public $id;

    //---------------------- Variables de la DB
    public $titulo;
    public $tipo;
    public $fecha;

    //---------------------- Datos de la tabla de la DB
    private $tablaNombre = "archivos";
    private $tablaId = "idarchivos";

    //////////////////////////////////////// Funciones (archivos)
    //////////////////////////////////////// Funciones (archivos)

    //---------------------- Guardar nuevo registro
    public function guardarArchivos()
    {
        $query = "INSERT INTO $this->tablaNombre
			(titulo, tipo)
			 VALUES 
			 (
			 '$this->titulo', 
			 '$this->tipo' 
			 )";

        $result = $this->db->consulta($query);
        $this->ultimoId = $this->db->id_ultimo();
        return $result;
    }

    //---------------------- Modificar registro
    public function modificarArchivos()
    {
        $query = "UPDATE $this->tablaNombre SET 
		titulo = '$this->titulo',
		tipo = '$this->tipo'

		WHERE $this->tablaId = '$this->id'";

        $result =  $this->db->consulta($query);
        return $result;
    }

    //---------------------- Consulta todos los registros
    public function getAllArchivos($id = 0)
    {
        $query = ($id != 0)
            ? "SELECT * FROM $this->tablaNombre WHERE tipo = $id"
            : "SELECT * FROM $this->tablaNombre";

        $result = $this->db->consulta($query);
        $numResult = $this->db->num_rows($result);

        if ($numResult > 0) {
            return $result;
        } else {
            return false;
        }
    }

    //---------------------- Consulta 1 registro
    public function getOneArchivos($id)
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


    //////////////////////////////////////// Archivos
    //////////////////////////////////////// Archivos

    //---------------------- Consulta 1 archivo            
    public function getOneArchivo($id, $col)
    {
        $query = "SELECT $col FROM  $this->tablaNombre WHERE $this->tablaId = $id";
        $result = $this->db->consulta($query);
        $numResult = $this->db->num_rows($result);
        $rowResult = $this->db->fetch_assoc($result);

        if ($numResult > 0) {
            return $rowResult[$col];
        } else {
            return false;
        }
    }

    //---------------------- Guardar archivo
    public function guardarArchivo($id, $nombre, $col)
    {
        $query = "UPDATE $this->tablaNombre SET
		$col = '$nombre'
		WHERE $this->tablaId = '$id' ";

        $result = $this->db->consulta($query);
        return $result;
    }
}
