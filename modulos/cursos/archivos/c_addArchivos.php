<?php
require_once("../../../clases/conexcion.php");
require_once("../../../clases/class.Sesion.php");
require_once("../../../clases/class.Funciones.php");
require_once('../../../clases/class.MovimientoBitacora.php');
require_once("../../../clases/class.Archivos.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$movBitacora = new MovimientoBitacora();
$archivos = new Archivos();

$movBitacora->db = $db;
$archivos->db = $db;

//---------------------- Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//---------------------- Editando o creando
$archivos->id = $_POST['viId'];
$editar = ($archivos->id != 0) ? true : false;

//---------------------- Respuesta a devolver
$respuesta = [];

//---------------------- Ruta de Archivos
$rutaImagenes = "imagenes/";
$rutaDocumentos = "documentos/";

try {
    $db->begin();

    //---------------------- Valores que vienen de formulario con ajax
    $archivos->titulo = trim($fun->guardar_cadena_utf8($_POST['viTitulo']));
    $archivos->tipo = trim($fun->guardar_cadena_utf8($_POST['viTipo']));


    if ($editar) {

        //---------------------- Modificar en la base de datos
        $respuesta["db"] = $archivos->modificarArchivos();
        // $respuesta["db"] = true;

        //---------------------- Guardar en la bitacora
        $movBitacora->guardarMovimiento(
            $fun->guardar_cadena_utf8('Archivos'),
            'Archivos',
            $fun->guardar_cadena_utf8('Modificar Archivos con el ID :' . $archivos->id)
        );
    } else {

        //---------------------- Guardar nuevo en la base de datos
        $respuesta["db"] = $archivos->guardarArchivos();
        // $respuesta["db"] = true;

        // ---------------------- Guardar en la bitacora
        $movBitacora->guardarMovimiento(
            $fun->guardar_cadena_utf8('Archivos'),
            'Archivos',
            $fun->guardar_cadena_utf8('Nuevo Archivos creado con el ID :' . $archivos->ultimoId)
        );
    }


    //////////////////////////////////////// Detectar que tipo de archivo es
    //////////////////////////////////////// Detectar que tipo de archivo es

    // imagen
    if ($editar) {

        if ($archivos->tipo == 1) {
            $respuesta["img"] = guadarArchivoImagen("viImagen", $rutaImagenes, $archivos->id, "archivo");
            $respuesta["doc"] = true;
        } else if ($archivos->tipo == 2) {
            $respuesta["doc"] = guadarArchivoDocumento("viDocumento", $rutaDocumentos, $archivos->id, "archivo");
            $respuesta["img"] = true;
        } else if ($archivos->tipo == 3) {
            $video = trim($fun->guardar_cadena_utf8($_POST['viVideo']));
            $respuesta["video"] = guadarArchivoUrl($video, $archivos->id, "archivo");
            $respuesta["img"] = true;
            $respuesta["doc"] = true;
        } else if ($archivos->tipo == 4) {
            $url = trim($fun->guardar_cadena_utf8($_POST['viWeb']));
            $respuesta["url"] = guadarArchivoUrl($url, $archivos->id, "archivo");
            $respuesta["img"] = true;
            $respuesta["doc"] = true;
        }
    } else {

        if ($archivos->tipo == 1) {
            $respuesta["img"] = guadarArchivoImagen("viImagen", $rutaImagenes, $archivos->ultimoId, "archivo");
            $respuesta["doc"] = true;
        } else if ($archivos->tipo == 2) {
            $respuesta["doc"] = guadarArchivoDocumento("viDocumento", $rutaDocumentos, $archivos->ultimoId, "archivo");
            $respuesta["img"] = true;
        } else if ($archivos->tipo == 3) {
            $video = trim($fun->guardar_cadena_utf8($_POST['viVideo']));
            $respuesta["video"] = guadarArchivoUrl($video, $archivos->ultimoId, "archivo");
            $respuesta["img"] = true;
            $respuesta["doc"] = true;
        } else if ($archivos->tipo == 4) {
            $url = trim($fun->guardar_cadena_utf8($_POST['viWeb']));
            $respuesta["url"] = guadarArchivoUrl($url, $archivos->ultimoId, "archivo");
            $respuesta["img"] = true;
            $respuesta["doc"] = true;
        }
    }


    //---------------------- Verficar si todo esta OK
    if ($respuesta["db"]) {
        $db->commit();
        echo 1;
    } else {
        if ($respuesta["img"] != 1) {
            echo  $respuesta["img"] . " ";
        }
        if ($respuesta["doc"] != 1) {
            echo  $respuesta["doc"] . " ";
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


//---------------------- Funciones para guardar archivos
function guadarArchivoUrl($archivo, $id, $col)
{
    global $archivos;
    $obj = $archivos;

    $obj->guardarArchivo($id, $archivo, $col);
    return true;
}


function guadarArchivoImagen($input, $ruta, $id, $col)
{
    global $archivos;
    $obj = $archivos;
    global $editar;
    $tam = 5000;

    // Tipo de archivos
    $jpg = "image/jpg";
    $jpeg = "image/jpeg";
    $png = "image/png";

    if (!empty($_FILES[$input])) {
        $archivo = $_FILES[$input];

        if ($archivo['error'] == UPLOAD_ERR_OK) {
            $tipo = $archivo['type']; // Tipo de archivo
            $temporal = $archivo['tmp_name']; // Ubicacion temporal del archivo
            $size = ($archivo['size'] / 1000); //Obtenemos el tamaño en KB

            if ($tipo == $jpeg || $tipo == $jpg || $tipo == $png) {

                if ($size <= $tam) {

                    if ($tipo == $jpeg) {
                        $archivo =  "img_" . $id . '.jpeg';
                    } else if ($tipo == $jpg) {
                        $archivo =  "img_" . $id . '.jpg';
                    } else if ($tipo == $png) {
                        $archivo =  "img_" . $id . '.png';
                    }

                    if ($editar) {
                        // Obtener archivo de la DB
                        $archivoAnterior = $obj->getOneArchivo($id, $col);
                        // Eliminar el archivo anterior del servidor
                        unlink($ruta . $archivoAnterior);
                    }
                    // Guardar ruta en la DB
                    $obj->guardarArchivo($id, $archivo, $col);

                    //Movemos el archivo nuevo al servidor
                    move_uploaded_file($temporal, $ruta . $archivo);
                    return true;
                } else {
                    return "EL ARCHIVO NO DEBE DE PESAR MAS DE " . $tam . " KB";
                }
            } else {
                return "EL ARCHIVO DE IMAGEN NO ES COMPATIBLE";
            }
        } else {
            return "OCURRIO UN ERROR AL SUBIR EL ARCHIVO";
        }
    }
    return true;
}


function guadarArchivoDocumento($input, $ruta, $id, $col)
{
    global $archivos;
    $obj = $archivos;
    global $editar;
    $tam = 5000;

    $word = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
    $pdf = "application/pdf";

    if (!empty($_FILES[$input])) {
        $archivo = $_FILES[$input];

        if ($archivo['error'] == UPLOAD_ERR_OK) {
            $tipo = $archivo['type']; // Tipo de archivo
            $temporal = $archivo['tmp_name']; // Ubicacion temporal del archivo
            $size = ($archivo['size'] / 1000); //Obtenemos el tamaño en KB

            if ($tipo == $pdf || $tipo == $word) {

                if ($size <= $tam) {

                    if ($tipo == $word) {
                        $archivo =  "doc_" . $id . '.docx';
                    } else if ($tipo == $pdf) {
                        $archivo =  "doc_" . $id . '.pdf';
                    }

                    if ($editar) {
                        // Obtener archivo de la DB
                        $archivoAnterior = $obj->getOneArchivo($id, $col);
                        // Eliminar el archivo anterior del servidor
                        unlink($ruta . $archivoAnterior);
                    }

                    // Guardar ruta en la DB
                    $obj->guardarArchivo($id, $archivo, $col);

                    //Movemos el archivo nuevo al servidor
                    move_uploaded_file($temporal, $ruta . $archivo);
                    return true;
                } else {
                    return "EL ARCHIVO NO DEBE DE PESAR MAS DE " . $tam . " KB";
                }
            } else {
                return "EL ARCHIVO DE DOCUMENTO NO ES COMPATIBLE";
            }
        } else {
            return "OCURRIO UN ERROR AL SUBIR EL ARCHIVO";
        }
    }
    return true;
}
