<?php
require_once("../../../clases/conexcion.php");
require_once("../../../clases/class.Sesion.php");
require_once("../../../clases/class.Funciones.php");
require_once('../../../clases/class.MovimientoBitacora.php');
require_once("../../../clases/class.SeccionesArchivos.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$movBitacora = new MovimientoBitacora();
$seccionesArchivos = new SeccionesArchivos();
$movBitacora->db = $db;
$seccionesArchivos->db = $db;

//---------------------- Sesion.
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../../login.php");
    exit;
}

//---------------------- Editando o creando
$seccionesArchivos->id = $_POST['viId'];
$editar = ($seccionesArchivos->id != 0) ? true : false;

try {
    $db->begin();

    //---------------------- Valores que vienen de formulario con ajax
    $seccionesArchivos->contenido = trim($fun->guardar_cadena_utf8($_POST['viContenido']));
    $seccionesArchivos->idArchivos = trim($fun->guardar_cadena_utf8($_POST['viIdArchivos']));
    $seccionesArchivos->idSecciones = trim($fun->guardar_cadena_utf8($_POST['viIdSecciones']));

    if ($editar) {
        //---------------------- Modificar en la base de datos
        $seccionesArchivos->modificarSeccionesArchivos();

        //---------------------- Guardar en la bitacora
        $movBitacora->guardarMovimiento(
            $fun->guardar_cadena_utf8('SeccionesArchivos'),
            'SeccionesArchivos',
            $fun->guardar_cadena_utf8('Modificar SeccionesArchivos con el ID :' . $seccionesArchivos->id)
        );
    } else {
        //---------------------- Guardar nuevo en la base de datos
        $seccionesArchivos->guardarSeccionesArchivos();

        //---------------------- Guardar en la bitacora
        $movBitacora->guardarMovimiento(
            $fun->guardar_cadena_utf8('SeccionesArchivos'),
            'SeccionesArchivos',
            $fun->guardar_cadena_utf8('Nuevas SeccionesArchivos creado con el ID :' . $seccionesArchivos->ultimoId)
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
    echo "ERROR EN LA BASE DE DATOS";
}
