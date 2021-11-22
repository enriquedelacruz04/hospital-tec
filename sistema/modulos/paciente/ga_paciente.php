<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Paciente.php");

//========================= Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$paciente = new Paciente();
$paciente->db = $db;

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
    $paciente->rfc = $_POST['viRfc'];
    $paciente->nombre = $_POST['viNombre'];
    $paciente->edad = $_POST['viEdad'];
    $paciente->sexo = $_POST['viSexo'];
    $paciente->telefono = $_POST['viTelefono'];
    $paciente->tipo = $_POST['viTipo'];


    if ($editar == true) {
        //========================= Modificar en la base de datos
        $paciente->modificarPaciente();
    } else {
        //========================= Guardar nuevo en la base de datos
        $paciente->guardarPaciente();
    }

    $db->commit();
    echo 1;
} catch (Exception $e) {
    $db->rollback();
}
