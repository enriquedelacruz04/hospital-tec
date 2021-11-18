<?php
require_once("../../../../clases/conexcion.php");
require_once("../../../../clases/class.Sesion.php");
require_once("../../../../clases/class.Funciones.php");
require_once('../../../../clases/class.MovimientoBitacora.php');
require_once("../../../../clases/class.ConfiguracionPagina.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$movBitacora = new MovimientoBitacora();
$configuracion = new ConfiguracionPagina();
$movBitacora->db = $db;
$configuracion->db = $db;

//---------------------- Sesion.
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../../login.php");
    exit;
}

try {
    $db->begin();

    //---------------------- Valores que vienen de formulario con ajax
    $configuracion->id = $_POST['viId'];
    $configuracion->nombrePagina = trim($fun->guardar_cadena_utf8($_POST['viNombrePagina']));
    $configuracion->noCursos = trim($fun->guardar_cadena_utf8($_POST['viNoCursos']));
    $configuracion->noCertificados = trim($fun->guardar_cadena_utf8($_POST['viNoCertificados']));
    $configuracion->noPlaticas = trim($fun->guardar_cadena_utf8($_POST['viNoPlaticas']));
    $configuracion->noClientes = trim($fun->guardar_cadena_utf8($_POST['viNoClientes']));
    $configuracion->correo = trim($fun->guardar_cadena_utf8($_POST['viCorreo']));
    $configuracion->ubicacion = trim($fun->guardar_cadena_utf8($_POST['viUbicacion']));
    $configuracion->telefono1 = trim($fun->guardar_cadena_utf8($_POST['viTelefono1']));
    $configuracion->telefono2 = trim($fun->guardar_cadena_utf8($_POST['viTelefono2']));
    $configuracion->facebook = trim($fun->guardar_cadena_utf8($_POST['viFacebook']));
    $configuracion->instagram = trim($fun->guardar_cadena_utf8($_POST['viInstagram']));
    $configuracion->twitter = trim($fun->guardar_cadena_utf8($_POST['viInstagram']));


    //----------------------  Modificar en la base de datos
    $configuracion->modificarConfiguracionPagina();

    //----------------------  Guardar en la bitacora
    $movBitacora->guardarMovimiento(
        $fun->guardar_cadena_utf8('ConfiguracionPaginaWeb'),
        'ConfiguracionPaginaWeb',
        $fun->guardar_cadena_utf8('Modificar ConfiguracionPaginaWeb con el ID :' . $configuracion->ultimoId)
    );

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
