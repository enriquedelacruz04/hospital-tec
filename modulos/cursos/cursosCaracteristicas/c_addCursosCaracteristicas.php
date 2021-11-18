<?php
require_once("../../../clases/conexcion.php");
require_once("../../../clases/class.Sesion.php");
require_once("../../../clases/class.Funciones.php");
require_once('../../../clases/class.MovimientoBitacora.php');
require_once("../../../clases/class.CursosCaracteristicas.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$movBitacora = new MovimientoBitacora();
$cursosCaracteristicas = new CursosCaracteristicas();
$movBitacora->db = $db;
$cursosCaracteristicas->db = $db;

//---------------------- Sesion.
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../../login.php");
    exit;
}

//---------------------- Editando o creando
$cursosCaracteristicas->id = $_POST['viId'];
$editar = ($cursosCaracteristicas->id != 0) ? true : false;

try {
    $db->begin();

    //---------------------- Valores que vienen de formulario con ajax
    $cursosCaracteristicas->titulo = trim($fun->guardar_cadena_utf8($_POST['viTitulo']));
    $cursosCaracteristicas->idCursos = trim($fun->guardar_cadena_utf8($_POST['viIdCursos']));



    if ($editar) {
        //---------------------- Modificar en la base de datos
        $cursosCaracteristicas->modificarCursosCaracteristicas();

        //---------------------- Guardar en la bitacora
        $movBitacora->guardarMovimiento(
            $fun->guardar_cadena_utf8('CursosCaracteristicas'),
            'CursosCaracteristicas',
            $fun->guardar_cadena_utf8('Modificar CursosCaracteristicas con el ID :' . $cursosCaracteristicas->id)
        );
    } else {
        //---------------------- Guardar nuevo en la base de datos
        $cursosCaracteristicas->guardarCursosCaracteristicas();

        //---------------------- Guardar en la bitacora
        $movBitacora->guardarMovimiento(
            $fun->guardar_cadena_utf8('CursosCaracteristicas'),
            'CursosCaracteristicas',
            $fun->guardar_cadena_utf8('Nuevas CursosCaracteristicas creado con el ID :' . $cursosCaracteristicas->ultimoId)
        );
    }


    $db->commit();
    echo 1;
} catch (Exception $e) {
    $db->rollback();
    $v = explode('|', $e);
    // echo $v[1];
    $n = explode("'", $v[1]);
    $n[0];
    echo $db->m_error($n[0]);
}
