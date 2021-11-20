<?php
require_once("../../../../clases/conexcion.php");
require_once("../../../../clases/class.Sesion.php");
require_once("../../../../clases/class.Funciones.php");
require_once('../../../../clases/class.MovimientoBitacora.php');
require_once("../../../../clases/class.Servicios.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$movBitacora = new MovimientoBitacora();
$servicios = new Servicios();
$movBitacora->db = $db;
$servicios->db = $db;

//---------------------- Sesion.
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../../login.php");
    exit;
}

//---------------------- Editando o creando
$servicios->id = $_POST['viId'];
$editar = ($servicios->id != 0) ? true : false;

//---------------------- Respuesta a devolver
$respuesta = [];

//---------------------- Ruta de Archivos
$rutaImagenes = "imagenes/";


try {
    $db->begin();

    //---------------------- Valores que vienen de formulario con ajax
    $servicios->titulo = trim($fun->guardar_cadena_utf8($_POST['viTitulo']));
    $servicios->descripcion = trim($fun->guardar_cadena_utf8($_POST['viDescripcion']));
    $servicios->imagen = trim($fun->guardar_cadena_utf8($_POST['viImagen']));
    $servicios->estatus = trim($fun->guardar_cadena_utf8($_POST['viEstatus']));


    if ($editar) {

        //---------------------- Modificar en la base de datos
        $respuesta["db"] = $servicios->modificarServicios();

        //---------------------- Modificar archivo en la base de datos
        $respuesta["img"] = guadarArchivoImagen("viImagen", $rutaImagenes, $servicios->id, "archivo_imagen");

        //---------------------- Guardar en la bitacora
        $movBitacora->guardarMovimiento(
            $fun->guardar_cadena_utf8('Servicios'),
            'Servicios',
            $fun->guardar_cadena_utf8('Modificar Servicios con el ID :' . $servicios->id)
        );
    } else {

        //---------------------- Guardar nuevo en la base de datos
        $respuesta["db"] = $servicios->guardarServicios();

        //---------------------- Guardar archivo en la base de datos
        $respuesta["img"] =  guadarArchivoImagen("viImagen", $rutaImagenes, $servicios->ultimoId, "archivo_imagen");

        //---------------------- Guardar en la bitacora
        $movBitacora->guardarMovimiento(
            $fun->guardar_cadena_utf8('Servicios'),
            'Servicios',
            $fun->guardar_cadena_utf8('Nuevos Servicios creado con el ID :' . $servicios->ultimoId)
        );
    }

    //---------------------- Verficar si todo esta OK
    if ($respuesta["db"] && $respuesta["img"]) {
        $db->commit();
        echo 1;
    } else {
        if ($respuesta["img"] != 1) {
            echo  $respuesta["img"] . " ";
        }
    }
} catch (Exception $e) {
    $db->rollback();
    $v = explode('|', $e);
    // echo $v[1];
    $n = explode("'", $v[1]);
    $n[0];
    echo $db->m_error($n[0]);
    echo "ERROR EN LA BASE DE DATOS";
}
