<?php
require_once("../../../clases/conexcion.php");
require_once("../../../clases/class.Sesion.php");
require_once("../../../clases/class.Funciones.php");
require_once('../../../clases/class.MovimientoBitacora.php');
require_once("../../../clases/class.Secciones.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$movBitacora = new MovimientoBitacora();
$secciones = new Secciones();
$movBitacora->db = $db;
$secciones->db = $db;

//---------------------- Sesion.
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../../login.php");
    exit;
}

//---------------------- Editando o creando
$secciones->id = $_POST['viId'];
$editar = ($secciones->id != 0) ? true : false;

try {
    $db->begin();

    //---------------------- Valores que vienen de formulario con ajax
    $secciones->titulo = trim($fun->guardar_cadena_utf8($_POST['viTitulo']));
    $secciones->contenido = trim($fun->guardar_cadena_utf8($_POST['viContenido']));

    $secciones->idCursos = trim($fun->guardar_cadena_utf8($_POST['viIdCursos']));


    if ($editar) {
        //---------------------- Modificar en la base de datos
        $secciones->modificarSecciones();

        //---------------------- Guardar en la bitacora
        $movBitacora->guardarMovimiento(
            $fun->guardar_cadena_utf8('Secciones'),
            'Secciones',
            $fun->guardar_cadena_utf8('Modificar Secciones con el ID :' . $secciones->id)
        );
    } else {
        //---------------------- Guardar nuevo en la base de datos
        $secciones->guardarSecciones();

        //---------------------- Guardar en la bitacora
        $movBitacora->guardarMovimiento(
            $fun->guardar_cadena_utf8('Secciones'),
            'Secciones',
            $fun->guardar_cadena_utf8('Nuevas Secciones creado con el ID :' . $secciones->ultimoId)
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
