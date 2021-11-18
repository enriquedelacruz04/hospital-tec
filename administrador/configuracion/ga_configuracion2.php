<?php
require_once("../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();


if(!isset($_SESSION['se_SAS']))
{
	header("Location: ../login.php");
	exit;
}


require_once("../clases/conexcion.php");
require_once("../clases/class.Configuracion.php");
require_once('../clases/class.MovimientoBitacora.php');
require_once("../clases/class.Funciones.php");


try
{
	$db= new MySQL();
	$conf= new Configuracion();
	$md = new MovimientoBitacora();
	$f = new Funciones();
	
	
	//Como no sabemos cuantos archivos van a llegar, iteramos la variable $_FILES
    $ruta="../images/configuracion/";
	
	
	$conf->db=$db;	
	$md->db = $db;
	$db->begin();
		

	
	//evaluamos si ya existia la configuracion de la empresa. con la variable
	
	$id =  $_POST['v_id'];
	
	
	
	
	
	foreach ($_FILES as $key) 
	  {
		if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
		   
		  $nombre = $f->conver_especial($key['name']);//Obtenemos el nombre del archivo
		  $temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
		  $tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB
		  
		   //obtenemos el nombre del archivo anterior para ser eliminado si existe
		  
		  $sql = "SELECT logonosotros FROM configuracion";
		  $result_borrar = $db->consulta($sql);
		  $result_borrar_row = $db->fetch_assoc($result_borrar);
		  $nombreborrar = $result_borrar_row['logonosotros'];		  
		  
		  if($nombreborrar != "")
		  {
			  unlink($ruta.$nombreborrar); 
		  }
		  
		  
		  move_uploaded_file($temporal, $ruta . $nombre); //Movemos el archivo temporal a la ruta especificada
		  //El echo es para que lo reciba jquery y lo ponga en el div "cargados"
		  
		 
		  $sql = "UPDATE configuracion SET logonosotros = '$nombre'";
		   
		  $result = $db->consulta($sql);	 
		}
	  }
	
	
	
	
	$db->commit();
	echo 1;
	
	
}
catch(Exception $e)
{
	$db->rollback();
	$v = explode ('|',$e);
		// echo $v[1];
	     $n = explode ("'",$v[1]);
		 $n[0];
	$result = $db->m_error($n[0]);
	echo $result ;
}
?>