<?php
if (!isset($_SESSION)) 
{
  session_start();
}
require_once("clases/conexcion.php");
require_once("clases/class.Menu.php");

try
{
	$db= new MySQL();
	$me= new Menu();
	
	$me->db=$db;
	$me->idperfil=$_SESSION['se_sas_Perfil'];
	
	echo $me->ArmarMenu();
}
catch(Exception $e)
{
	echo "Error 404: ".$e;
}
?>