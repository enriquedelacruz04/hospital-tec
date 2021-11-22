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
require_once("../../clases/class.Configuracion.php");
require_once('../../clases/class.MovimientoBitacora.php');
require_once("../../clases/class.Funciones.php");


try
{
	$db= new MySQL();
	$conf= new Configuracion();
	$md = new MovimientoBitacora();
	$f = new Funciones();
	
	
	//Como no sabemos cuantos archivos van a llegar, iteramos la variable $_FILES
    $ruta="../../images/configuracion/";
	
	
	$conf->db=$db;	
	$md->db = $db;
	$db->begin();
		

    //recibiendo datos
    $conf->nombre_empresa = $f->guardar_cadena_utf8( $_POST['v_nombre_empresa']);
    $conf->direccion = '';//$f->guardar_cadena_utf8( $_POST['v_direccion']);
    $conf->telefonos = '';//$_POST['v_telefonos'];
    $conf->url = $_POST['v_url'];
    $conf->email = $_POST['v_email'];
    $conf->direccion = $f->guardar_cadena_utf8($_POST['v_direccion']);
    $conf->telefonos = $_POST['v_telefono'];
    $conf->email_pedido = $_POST['v_email_pedido'];
    $conf->clave_caja = $_POST['clave_caja'];
    $conf->notas_print = $_POST['formato_impresion'];
    $conf->porc_comision = $_POST['comision'];

    $conf->razon_social = $f->guardar_cadena_utf8($_POST['v_razonsocial']);
    $conf->rfc = $f->guardar_cadena_utf8($_POST['v_rfc']);
    $conf->direccion_fiscal = $f->guardar_cadena_utf8( $_POST['v_dfiscal']);
    $conf->no_int_fiscal = $_POST['v_nint'];
    $conf->no_ext_fiscal = $_POST['v_next'];
    $conf->ciudad_fiscal = $f->guardar_cadena_utf8($_POST['v_ciudad']);
    $conf->estado_fiscal = $f->guardar_cadena_utf8($_POST['v_estado']);
    $conf->cp_fiscal = $_POST['v_cp'];
    $conf->colonia_fiscal = $f->guardar_cadena_utf8($_POST['v_colonia']);


    $conf->iva = $_POST['v_iva'];
    $conf->t_descuento = $_POST['v_tipo_descuento'];
    $conf->cuentasbancarias = $_POST['v_cuentas'];
    $conf->moneda = $_POST['v_moneda'];


	
	//valores para configurar el email que envia todas las notifiacciones del sistema.
	
    $conf->v_e_cuenta = $_POST['v_e_cuenta'];
    $conf->v_e_clave = $_POST['v_e_clave'];
    $conf->v_e_pop = $_POST['v_e_pop'];
    $conf->v_e_pentrante = $_POST['v_e_pentrante'];
    $conf->v_e_smtp = $_POST['v_e_smtp'];
    $conf->v_e_psaliente = $_POST['v_e_psaliente'];
    $conf->v_e_autenticacion = $_POST['v_e_autenticacion'];
    $conf->v_e_ss = $_POST['v_e_ss'];
	
	//terminamos recibir las variables de email que enviara los mensajes.

    $conf->v_politicas = $f->guardar_cadena_utf8($_POST['v_politicas']);
    $conf->v_terminosycondiciones = $f->guardar_cadena_utf8($_POST['v_terminosycondiciones']);
    $conf->v_nosotros = $f->guardar_cadena_utf8($_POST['v_nosotros']);
    $conf->v_descripcion = $f->guardar_cadena_utf8($_POST['v_descripcion']);

    $conf->horario = $_POST['v_horario'];
    $conf->facebook = $_POST['v_facebook'];
    $conf->instagram = $_POST['v_instagram'];
    $conf->twitter = $_POST['v_twiter'];
    $conf->youtube = $_POST['v_youtube'];

    $conf->ativeopenpay = $_POST['ativeopenpay'];
    $conf->idnegocio = $_POST['idnegocio'];
    $conf->key_private = $_POST['key_private'];
    $conf->key_public = $_POST['key_public'];


	
	//guardando
	
	//evaluamos si ya existia la configuracion de la empresa. con la variable
	
	$id =  $_POST['v_id'];
	
	
	if($id == 0)
	{
	
	$conf->GuardarNewConfiguracion();
	$md->guardarMovimiento($f->guardar_cadena_utf8('Configuracion'),'configuracion',$f->guardar_cadena_utf8('Guardando Configuracion de la empresa-'.$conf->ultimoIDConfiguracion));
	}else
	{
		
	$conf->idConfiguracion = $id;
	$conf->ModificarConfiguracion();
	$md->guardarMovimiento($f->guardar_cadena_utf8('Configuracion'),'configuracion',$f->guardar_cadena_utf8('Modificamos la Configuracion de la empresa-'.$conf->idConfiguracion));
	}
	
	$c=0;
	
	
	foreach ($_FILES as $key) 
	  {
		
		$c = explode("/",$key['type']);
		
		if($c[1]=="png"){
			
		
		if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
		   
		  $nombre = $f->conver_especial($key['name']);//Obtenemos el nombre del archivo
		  $temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
		  $tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB
		  
		   //obtenemos el nombre del archivo anterior para ser eliminado si existe
		  
		  $sql = "SELECT logo FROM configuracion";
		  $result_borrar = $db->consulta($sql);
		  $result_borrar_row = $db->fetch_assoc($result_borrar);
		  $nombreborrar = $result_borrar_row['logo'];		  
		  
		  if($nombreborrar != "")
		  {
			  unlink($ruta.$nombreborrar); 
		  }
		  
		  
		  move_uploaded_file($temporal, $ruta . $nombre); //Movemos el archivo temporal a la ruta especificada
		  //El echo es para que lo reciba jquery y lo ponga en el div "cargados"
		  
		 
		  $sql = "UPDATE configuracion SET logo = '$nombre'";
		   
		  $result = $db->consulta($sql);	 
		}}
		
		if($c[1]=="jpg" || $c[1]=="jpeg"){
			
		
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
		$c++;
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