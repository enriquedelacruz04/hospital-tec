<?php
class Secciones
{
    //---------------------- Objeto de conexion con la base de datos
    public $db;

    //---------------------- ID's
    public $ultimoId;
    public $id;

    //---------------------- Variables de la DB
    public $titulo;
    public $contenido;
    public $posicion;

    // id's foraneas
    public $idCursos;

    //---------------------- Datos de la tabla de la DB
    private $tablaNombre = "secciones";
    private $tablaId = "idsecciones";

    //////////////////////////////////////// Funciones (secciones)
    //////////////////////////////////////// Funciones (secciones)

    //---------------------- Guardar nuevo registro
    public function guardarSecciones()
    {
        $query = "INSERT INTO $this->tablaNombre
			(titulo, contenido, idcursos )
			 VALUES 
			 (
			 '$this->titulo', 
			 '$this->contenido', 
			 '$this->idCursos'
			 )";

        $this->db->consulta($query);
        $this->ultimoId = $this->db->id_ultimo();
    }

    //---------------------- Modificar registro
    public function modificarSecciones()
    {
        $query = "UPDATE $this->tablaNombre SET 
		titulo = '$this->titulo',
		contenido = '$this->contenido',
		idcursos = '$this->idCursos'

		WHERE $this->tablaId = '$this->id'";
        return $this->db->consulta($query);
    }

    //---------------------- Consulta todos los registros
    public function getAllSecciones($id = 0)
    {
        $query = ($id != 0)
            ? "SELECT * FROM $this->tablaNombre WHERE idcursos = $id"
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
    public function getOneSecciones($id)
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
