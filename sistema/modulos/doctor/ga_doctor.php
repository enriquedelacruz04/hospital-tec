<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Doctor.php");

//========================= Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$doctor = new Doctor();
$doctor->db = $db;

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
    $doctor->cedula = $_POST['viCedula'];
    $doctor->nombre = $_POST['viNombre'];
    $doctor->edad = $_POST['viEdad'];
    $doctor->sexo = $_POST['viSexo'];
    $doctor->telefono = $_POST['viTelefono'];
    $doctor->especialidad = $_POST['viEspecialidad'];
    $doctor->hospitalNumero = $_POST['viHospitalNumero'];


    if ($editar == true) {
        //========================= Modificar en la base de datos
        $doctor->modificarDoctor();
    } else {
        //========================= Guardar nuevo en la base de datos
        $doctor->guardarDoctor();
    }

    $db->commit();
    echo 1;
} catch (Exception $e) {
    $db->rollback();
}
