<?php
if (!isset($_SESSION)) 
{
  session_start();
  //session_cache_expire(1);
	
  //echo "Inicio sesiones por que no los detectava";	
	
}
  //echo "si detecto sesiones";	

 require_once("clases/class.Login.php");

$lo= new Login();

$lo->usuario = $_POST['usuario'];
$lo->contrasena = $_POST['contrasena'];
$lo->tabla = "usuarios";



$quepaso=$lo->ValidandoDatos();
$quepaso = 1;


echo $quepaso;

?>