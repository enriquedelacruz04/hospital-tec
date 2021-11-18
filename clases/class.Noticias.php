<?php
class Noticias
{
    //---------------------- Objeto de conexion con la base de datos
    public $db;

    //---------------------- ID's
    public $ultimoId;
    public $id;

    //---------------------- Variables de la DB 
    public $fecha;
    public $titulo;
    public $autor;
    public $textoNoticia;
    public $archivoImagen;
    public $estatus;

    //---------------------- Datos de la tabla de la DB
    private $tablaNombre = "noticias";
    private $tablaId = "idnoticias";

    //////////////////////////////////////// Funciones (noticias)
    //////////////////////////////////////// Funciones (noticias)

    //---------------------- Guardar nuevo registro
    public function guardarNoticias()
    {
        $query = "INSERT INTO  $this->tablaNombre
			( titulo, autor, texto_noticia, estatus)
			 VALUES 
			 (
			 '$this->titulo', 
			 '$this->autor',
			 '$this->textoNoticia',
			 '$this->estatus'
			 )";

        $result = $this->db->consulta($query);
        $this->ultimoId = $this->db->id_ultimo();
        return $result;
    }

    //---------------------- Modificar registro
    public function modificarNoticias()
    {
        $query = "UPDATE  $this->tablaNombre SET 
		titulo = '$this->titulo',
		autor = '$this->autor',
		texto_noticia = '$this->textoNoticia',
		estatus = '$this->estatus'

		WHERE $this->tablaId = '$this->id'";

        $result =  $this->db->consulta($query);
        return $result;
    }

    //---------------------- Consulta todos los registros
    public function getAllNoticias()
    {
        $query = "SELECT * FROM  $this->tablaNombre";
        $result = $this->db->consulta($query);
        $numResult = $this->db->num_rows($result);

        if ($numResult > 0) {
            return $result;
        } else {
            return false;
        }
    }

    //---------------------- Consulta 1 registro
    public function getOneNoticias($id)
    {
        $query = "SELECT * FROM  $this->tablaNombre WHERE $this->tablaId = $id";
        $result = $this->db->consulta($query);
        $numResult = $this->db->num_rows($result);
        $rowResult = $this->db->fetch_assoc($result);

        if ($numResult > 0) {
            return $rowResult;
        } else {
            return false;
        }
    }

    //////////////////////////////////////// Especiales
    //////////////////////////////////////// Especiales

    //---------------------- Obtener 1 registro de una columna
    public function getOne($id, $col)
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

    //---------------------- Guardar 1 registro de una columna
    public function setOne($id, $nombre, $col)
    {
        $query = "UPDATE $this->tablaNombre SET
		$col = '$nombre'
		WHERE $this->tablaId = '$id' ";

        $result = $this->db->consulta($query);
        return $result;
    }
}
