<?php
class Cursos
{
    //---------------------- Objeto de conexion con la base de datos
    public $db;

    //---------------------- ID's
    public $ultimoId;
    public $id;

    //---------------------- Variables de la DB
    public $titulo;
    public $tipo;
    public $contenido;
    public $costo;
    public $tipoMoneda;
    public $ponentes;
    public $fecha;
    public $estatus;

    //---------------------- Datos de la tabla de la DB
    private $tablaNombre = "cursos";
    private $tablaId = "idcursos";

    //////////////////////////////////////// Funciones (cursos)
    //////////////////////////////////////// Funciones (cursos)

    //---------------------- Guardar nuevo registro
    public function guardarCursos()
    {
        $query = "INSERT INTO $this->tablaNombre
			(titulo, tipo, contenido, costo, tipo_moneda, ponentes, estatus)
			 VALUES 
			 (
			 '$this->titulo',
			 '$this->tipo',
			 '$this->contenido',
			 '$this->costo',
			 '$this->tipoMoneda',
			 '$this->ponentes',
			 '$this->estatus'
			 )";

        $result = $this->db->consulta($query);
        $this->ultimoId = $this->db->id_ultimo();
        return $result;
    }

    //---------------------- Modificar registro
    public function modificarCursos()
    {
        $query = "UPDATE $this->tablaNombre SET 
        
		titulo = '$this->titulo',
		tipo = '$this->tipo',
		contenido = '$this->contenido',
		costo = '$this->costo',
		tipo_moneda = '$this->tipoMoneda',
		ponentes = '$this->ponentes',
		estatus = '$this->estatus'
	
		WHERE $this->tablaId = '$this->id'";

        $result =  $this->db->consulta($query);
        return $result;
    }

    //---------------------- Consulta todos los registros
    public function getAllCursos()
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
    public function getOneCursos($id)
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
