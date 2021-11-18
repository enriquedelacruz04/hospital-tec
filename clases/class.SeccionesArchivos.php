<?php
class SeccionesArchivos
{
	//---------------------- Objeto de conexion con la base de datos
	public $db;

	//---------------------- ID's
	public $ultimoId;
	public $id;

	//---------------------- Variables de la DB
	public $contenido;

	// id's foraneas
	public $idArchivos;
	public $idSecciones;

	//---------------------- Datos de la tabla de la DB
	private $tablaNombre = "secciones_archivos";
	private $tablaId = "idsecciones_archivos";

	//////////////////////////////////////// Funciones (secciones_documentos)
	//////////////////////////////////////// Funciones (secciones_documentos)

	//---------------------- Guardar nuevo registro
	public function guardarSeccionesArchivos()
	{
		$query = "INSERT INTO $this->tablaNombre
			(contenido, idsecciones, idarchivos )
			 VALUES 
			 (
			 '$this->contenido',
			 '$this->idSecciones',
			 '$this->idArchivos'
			 )";

		$result = $this->db->consulta($query);
		$this->ultimoId = $this->db->id_ultimo();
		return $result;
	}

	//---------------------- Modificar registro
	public function modificarSeccionesArchivos()
	{
		$query = "UPDATE $this->tablaNombre SET 
        
		contenido = '$this->contenido',
		idsecciones = '$this->idSecciones',
		idarchivos = '$this->idArchivos'

        WHERE  $this->tablaId = '$this->id'";

		$result =  $this->db->consulta($query);
		return $result;
	}

	//---------------------- Consulta todos los registros
	public function getAllSeccionesArchivos($id)
	{
		$query = "SELECT * FROM $this->tablaNombre WHERE idsecciones = $id";
		$result = $this->db->consulta($query);
		$numResult = $this->db->num_rows($result);

		if ($numResult > 0) {
			return $result;
		} else {
			return false;
		}
	}

	//---------------------- Consulta 1 registro
	public function getOneSeccionesArchivos($id)
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
