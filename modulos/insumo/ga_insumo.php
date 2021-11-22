<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Insumo.php");

//========================= Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$insumo = new Insumo();
$insumo->db = $db;

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
    $insumo->id = $_POST['viId'];
    $insumo->nombre = $_POST['viNombre'];
    $insumo->cantidad = $_POST['viCantidad'];
    $insumo->marca = $_POST['viMarca'];


    if ($editar == true) {
        //========================= Modificar en la base de datos
        $insumo->modificarInsumo();
    } else {
        //========================= Guardar nuevo en la base de datos
        $insumo->guardarInsumo();
    }

    $db->commit();
    echo 1;
} catch (Exception $e) {
    $db->rollback();
}
