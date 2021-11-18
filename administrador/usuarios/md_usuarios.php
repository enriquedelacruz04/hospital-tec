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
	
	$db->begin();
	
	$us->db=$db;
	$md->db = $db;
	//recibiendo datos
	$us->id_usuario=$_POST['id_usuario'];
	$us->idperfiles=$_POST['idperfiles'];
	$us->nombre=trim($fu->guardar_cadena_utf8($_POST['nombre']));
	$us->paterno=trim($fu->guardar_cadena_utf8($_POST['paterno']));
	$us->materno=trim($fu->guardar_cadena_utf8($_POST['materno']));
	$us->celular=trim($_POST['celular']);
	$us->telefono=trim($_POST['telefono']);
	$us->email=trim($fu->guardar_cadena_utf8($_POST['email']));
	$us->usuario=trim($fu->guardar_cadena_utf8($_POST['usuario']));
	$us->clave=trim($fu->guardar_cadena_utf8($_POST['clave']));
	$us->estatus=$_POST['estatus'];

	
	$tipo = $_POST['tipo'];


	//Validamos que sea superUsuario
	if($tipo == 0){
		$us->tipo = 0;
	}else{
		$us->tipo = 1;
	}
	
	
		
	//guardando
	$us->ModificarUsuario();
	$db->commit();
	
	
	// $md->guardarMovimiento($fu->guardar_cadena_utf8('usuarios'),'usuarios',$fu->guardar_cadena_utf8('Modificación de Usuario -'.$_POST['usuario']));
	
	echo 1;
	
	
}
catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
