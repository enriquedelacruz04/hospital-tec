<?php
require_once('class.Sesion.php');
require_once('class.Fechas.php');

 class MovimientoBitacora
 {
	 public $db;
	 private $sesion;
	 private $f;
	 
	 public $fecha;
	 
	 public function MovimientoBitacora()
	 {
         
		 $this->sesion = new Sesion();
		 $this->f = new Fechas();
		 
		 		 
	 }// fin de MovimientoBitacora
	 
	 public function guardarMovimiento($modulo,$tabla,$descripcion)
	 {
		
		   
		   //$fechaactual = $this->f->fechaaYYYY_mm_dd_guion();
		   $idbitacora = $this->sesion->obtenerSesion('idbitacoraSAS');
		   
		   $query_movimiento = "INSERT INTO bitacora_movimientos (idbitacora,modulo,descripcion) VALUES ($idbitacora,'$modulo','$descripcion');";
		
		   $this->db->consulta($query_movimiento);
		 
	 }// fin de guardarMovimiento
	 
	 
	 //Funcion que sirve para obtener la lista de actividades en bitacora
	 public function lista_filtro()
	 {
		 $sql = "SELECT * FROM bitacora b, bitacora_movimientos bm WHERE b.idbitacora = bm.idbitacora";
		 $sql .= ($this->fecha != '') ? " AND DATE(bm.fecha_movimiento) = DATE('$this->fecha')":"";
		 $sql .= " ORDER BY bm.fecha_movimiento DESC";
				 
		 $result = $this->db->consulta($sql);
		 return $result;
	 }
	 
 }// fin de clase MovimientoBitacora
?>