<?php
require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();


if(!isset($_SESSION['se_SAS']))
{
	header("Location: ../../login.php");
	exit;
}



require_once("../../clases/conexcion.php");
require_once("../../clases/class.Usuarios.php");
require_once('../../clases/class.MovimientoBitacora.php');
require_once('../../clases/class.Funciones.php');

try
{
	$db= new MySQL();
	$us= new Usuarios();
	$md = new MovimientoBitacora();
	$fu = new Funciones();
	
	$us->db=$db;
	$md->db = $db;	
	
	
	
	$db->begin();
		
	//recibiendo datos
	$us->idperfiles = $_POST['idperfiles'];
	$us->nombre= trim($fu->guardar_cadena_utf8($_POST['nombre']));
	$us->paterno=trim($fu->guardar_cadena_utf8($_POST['paterno']));
	$us->materno=trim($fu->guardar_cadena_utf8($_POST['materno']));
	$us->celular=trim($_POST['celular']);
	$us->telefono=trim($_POST['telefono']);
	$us->email=trim($fu->guardar_cadena_utf8($_POST['email']));
	$us->usuario=trim($fu->guardar_cadena_utf8($_POST['usuario']));
	$us->clave=trim($fu->guardar_cadena_utf8($_POST['clave']));
	$us->tipo = 1;
	
	//guardando
	$us->GuardarUsuario();
	// $md->guardarMovimiento($fu->guardar_cadena_utf8('usuarios'),'usuarios',$fu->guardar_cadena_utf8('Nuevo Usuario creado -'.$_POST['usuario']));
	
	$db->commit();
	echo 1;
	
	
}
catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
?>