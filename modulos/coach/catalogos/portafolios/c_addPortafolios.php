<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once('../../clases/class.MovimientoBitacora.php');
require_once("../../clases/class.Sucursales.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$movBitacora = new MovimientoBitacora();
$sucursales = new Sucursales();
$movBitacora->db = $db;
$sucursales->db = $db;

//---------------------- Sesion.
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../../login.php");
    exit;
}

//---------------------- Editando o creando
$sucursales->id = $_POST['viId'];
$editar = ($sucursales->id != 0) ? true : false;

try {
    $db->begin();

    //---------------------- Valores que vienen de formulario con ajax
    $sucursales->idCliente = trim($fun->guardar_cadena_utf8($_POST['viIdCliente']));
    $sucursales->nombre = trim($fun->guardar_cadena_utf8($_POST['viNombre']));
    $sucursales->direccion = trim($fun->guardar_cadena_utf8($_POST['viDireccion']));
    $sucursales->whatsapp = trim($fun->guardar_cadena_utf8($_POST['viWhatsapp']));
    $sucursales->email = trim($fun->guardar_cadena_utf8($_POST['viEmail']));
    $sucursales->estatus = trim($fun->guardar_cadena_utf8($_POST['viEstatus']));


    if ($editar) {
        //---------------------- Modificar en la base de datos
        $sucursales->modificarSucursales();

        //---------------------- Guardar en la bitacora
        $movBitacora->guardarMovimiento(
            $fun->guardar_cadena_utf8('Sucursales'),
            'Sucursales',
            $fun->guardar_cadena_utf8('Modificar Sucursales con el ID :' . $sucursales->id)
        );
    } else {
        //---------------------- Guardar nuevo en la base de datos
        $sucursales->guardarSucursales();

        //---------------------- Guardar en la bitacora
        $movBitacora->guardarMovimiento(
            $fun->guardar_cadena_utf8('Sucursales'),
            'Sucursales',
            $fun->guardar_cadena_utf8('Nueva Sucursales creado con el ID :' . $sucursales->ultimoId)
        );
    }

    //---------------------- Guardar Imagen 
    $ruta = "imagenes/";
    foreach ($_FILES as $key) {
        //Verificamos si se subio correctamente
        if ($key['error'] == UPLOAD_ERR_OK) {
            $imagen = $key['name']; // Nombre del archivo
            $tipo = $key['type']; // Tipo de archivo
            $temporal = $key['tmp_name']; // Ubicacion temporal del archivo
            $size = ($key['size'] / 1000) . "Kb"; //Obtenemos el tamaño en KB

            if ($tipo == "image/jpg" || $tipo == "image/jpeg" || $tipo == "image/png") {
                if ($editar) {
                    $imagenAnterior = $sucursales->getOneImagen($sucursales->id); // Obtener imagen de la DB
                    unlink($ruta . $imagenAnterior); // Eliminar la imagen anterior del servidor
                    $sucursales->guardarImagen($sucursales->id, $imagen); // Guardar ruta en la DB
                } else {
                    $sucursales->guardarImagen($sucursales->ultimoId, $imagen); // Guardar ruta en la DB
                }
                //Movemos la imagen nueva al servidor
                move_uploaded_file($temporal, $ruta . $imagen);
            }
        }
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
