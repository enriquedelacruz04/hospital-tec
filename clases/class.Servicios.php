<?php
class Servicios
{
    //---------------------- Objeto de conexion con la base de datos
    public $db;

    //---------------------- ID's
    public $ultimoId;
    public $id;

    //---------------------- Variables de la DB
    public $titulo;
    public $descripcion;
    public $imagen;
    public $estatus;

    //---------------------- Datos de la tabla de la DB
    private $tablaNombre = "servicios";
    private $tablaId = "idservicios";

    //////////////////////////////////////// Funciones (servicios)
    //////////////////////////////////////// Funciones (servicios)

    //---------------------- Guardar nuevo registro
    public function guardarServicios()
    {
        $query = "INSERT INTO $this->tablaNombre
			(titulo, descripcion, estatus )
			 VALUES 
			 (
			 '$this->titulo', 
			 '$this->descripcion', 
			 '$this->estatus'
			 )";

        $result = $this->db->consulta($query);
        $this->ultimoId = $this->db->id_ultimo();
        return $result;
    }

    //---------------------- Modificar registro
    public function modificarServicios()
    {
        $query = "UPDATE $this->tablaNombre SET 
		titulo = '$this->titulo',
		descripcion = '$this->descripcion',
		estatus = '$this->estatus'

		WHERE $this->tablaId = '$this->id'";

        $result =  $this->db->consulta($query);
        return $result;
    }

    //---------------------- Consulta todos los registros
    public function getAllServicios()
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

    //---------------------- Consulta 1 registro
    public function getOneServicios($id)
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
