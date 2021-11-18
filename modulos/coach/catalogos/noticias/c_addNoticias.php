<?php
require_once("../../../../clases/conexcion.php");
require_once("../../../../clases/class.Sesion.php");
require_once("../../../../clases/class.Funciones.php");
require_once('../../../../clases/class.MovimientoBitacora.php');
require_once("../../../../clases/class.Noticias.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$movBitacora = new MovimientoBitacora();
$noticias = new Noticias();
$movBitacora->db = $db;
$noticias->db = $db;

//---------------------- Sesion.
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../../login.php");
    exit;
}

//---------------------- Editando o creando
$noticias->id = $_POST['viId'];
$editar = ($noticias->id != 0) ? true : false;

//---------------------- Respuesta a devolver
$respuesta = [];

//---------------------- Ruta de Archivos
$rutaImagenes = "imagenes/";


try {
    $db->begin();

    //---------------------- Valores que vienen de formulario con ajax
    $noticias->titulo = trim($fun->guardar_cadena_utf8($_POST['viTitulo']));
    $noticias->autor = trim($fun->guardar_cadena_utf8($_POST['viAutor']));
    $noticias->textoNoticia = trim($fun->guardar_cadena_utf8($_POST['viTextoNoticia']));
    $noticias->estatus = trim($fun->guardar_cadena_utf8($_POST['viEstatus']));


    if ($editar) {

        //---------------------- Modificar en la base de datos
        $respuesta["db"] = $noticias->modificarNoticias();

        //---------------------- Modificar archivo en la base de datos
        $respuesta["img"] = guadarArchivoImagen("viImagen", $rutaImagenes, $noticias->id, "archivo_imagen");

        //---------------------- Guardar en la bitacora
        $movBitacora->guardarMovimiento(
            $fun->guardar_cadena_utf8('Noticias'),
            'Noticias',
            $fun->guardar_cadena_utf8('Modificar Noticias con el ID :' . $noticias->id)
        );
    } else {

        //---------------------- Guardar nuevo en la base de datos
        $respuesta["db"] = $noticias->guardarNoticias();

        //---------------------- Guardar archivo en la base de datos
        $respuesta["img"] =  guadarArchivoImagen("viImagen", $rutaImagenes, $noticias->ultimoId, "archivo_imagen");

        //---------------------- Guardar en la bitacora
        $movBitacora->guardarMovimiento(
            $fun->guardar_cadena_utf8('Noticias'),
            'Noticias',
            $fun->guardar_cadena_utf8('Nuevos Noticias creado con el ID :' . $noticias->ultimoId)
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

//---------------------- Funciones para guardar archivos
function guadarArchivoImagen($input, $ruta, $id, $col)
{
    global $noticias;
    $obj = $noticias;
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
                        $archivoAnterior = $obj->getOne($id, $col);
                        // Eliminar el archivo anterior del servidor
                        unlink($ruta . $archivoAnterior);
                    }
                    // Guardar ruta en la DB
                    $obj->setOne($id, $archivo, $col);

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
