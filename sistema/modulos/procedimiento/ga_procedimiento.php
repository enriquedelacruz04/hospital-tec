<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Procedimiento.php");

//========================= Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$procedimiento = new Procedimiento();
$procedimiento->db = $db;

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
    $procedimiento->id = $_POST['viId'];
    $procedimiento->paciente = $_POST['viPaciente'];
    $procedimiento->tipoProcedimeinto = $_POST['viTipoProcedimiento'];
    $procedimiento->doctor = $_POST['viDoctor'];
    $procedimiento->insumo = $_POST['viInsumo'];
    $procedimiento->fecha = $_POST['viFecha'];
    $procedimiento->hora = $_POST['viHora'];


    if ($editar == true) {
        //========================= Modificar en la base de datos
        $procedimiento->modificarProcedimiento();
    } else {
        //========================= Guardar nuevo en la base de datos
        $procedimiento->guardarProcedimiento();
    }

    $db->commit();
    echo 1;
} catch (Exception $e) {
    $db->rollback();
}
