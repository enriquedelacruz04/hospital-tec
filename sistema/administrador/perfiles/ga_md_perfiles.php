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
require_once("../../clases/class.PerfilesPermisos.php");
require_once('../../clases/class.MovimientoBitacora.php');
require_once('../../clases/class.Funciones.php');


try
{
	$db= new MySQL();
	$pp = new PerfilesPermisos();
	$md = new MovimientoBitacora();
	$fu = new Funciones();
	
	$pp->db=$db;	
	$md->db = $db;
	
	$db->begin();	
	
	$tipo=$_POST['tipo'];
	$cantidad=$_POST['cantidad_menu'];//cantidad de submenus seleccionados
	
	switch($tipo)
	{
		case 1:
				$pp->perfil=utf8_decode($_POST['nombre']);
				$pp->estatus=$_POST['estatus'];				
				$pp->GuardarNewPerfil();
				
				for($i=1;$i<=$cantidad;$i++)
				{
					if(isset($_POST['menu'.$i]))
					{
						$pp->Perfiles_Permisos($_POST['menu'.$i]);
					}
				}
				
				$md->guardarMovimiento($fu->guardar_cadena_utf8('perfiles'),'perfiles',$fu->guardar_cadena_utf8('Nuevo Perfil creado -'.$pp->ultimoperfil));				
			break;
		case 2:
				$pp->idperfiles=$_POST['idperfiles'];
				$pp->ultimoperfil=$_POST['idperfiles'];
				
				$pp->EliminarPermisos();
				
				$pp->perfil=$fu->guardar_cadena_utf8($_POST['nombre']);
				$pp->estatus=$_POST['estatus'];	
			
				$pp->ModificarPerfil();
				
				for($i=1;$i<=$cantidad;$i++)
				{
					if(isset($_POST['menu'.$i]))
					{
						$pp->Perfiles_Permisos($_POST['menu'.$i]);
					}
				}
				
				$md->guardarMovimiento($fu->guardar_cadena_utf8('perfiles'),'perfiles',$fu->guardar_cadena_utf8('Modificacion del perfil creado -'.$_POST['idperfiles']));
			break;
	}
	
	
	
	
	$db->commit();
	echo 1;
}
catch(Exception $e)
{
	//echo $e;
	echo 0;
	$db->rollback();
}
?>