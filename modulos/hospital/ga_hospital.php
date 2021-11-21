<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Hospital.php");

//========================= Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$hospital = new Hospital();
$hospital->db = $db;

//========================= Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//========================= Editando o creando
$id = $_POST['viId'];
$editar = ($id != 0) ? true : false;

try {
    $db->begin();

    //========================= Valores que vienen de formulario con ajax
    $hospital->numero = $_POST['viNumero'];
    $hospital->nombre = $_POST['viNombre'];
    $hospital->direccion = $_POST['viDireccion'];
    $hospital->telefono = $_POST['viTelefono'];
    $hospital->correo = $_POST['viCorreo'];


    if ($editar == true) {
        //========================= Modificar en la base de datos
        $hospital->modificarHospital();
    } else {
        //========================= Guardar nuevo en la base de datos
        $hospital->guardarHospital();
    }

    $db->commit();
    echo 1;
} catch (Exception $e) {
    $db->rollback();
}
