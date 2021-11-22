<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.TipoProcedimiento.php");

//========================= Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$tipoProcedimiento = new TipoProcedimiento();
$tipoProcedimiento->db = $db;

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
    $tipoProcedimiento->id = $_POST['viId'];
    $tipoProcedimiento->nombre = $_POST['viNombre'];
    $tipoProcedimiento->costo = $_POST['viCosto'];
    $tipoProcedimiento->iva = $_POST['viIva'];


    if ($editar == true) {
        //========================= Modificar en la base de datos
        $tipoProcedimiento->modificarTipoProcedimiento();
    } else {
        //========================= Guardar nuevo en la base de datos
        $tipoProcedimiento->guardarTipoProcedimiento();
    }

    $db->commit();
    echo 1;
} catch (Exception $e) {
    $db->rollback();
}
