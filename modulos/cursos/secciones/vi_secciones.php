<?php
require_once("../../../clases/conexcion.php");
require_once("../../../clases/class.Sesion.php");
require_once("../../../clases/class.Funciones.php");
require_once("../../../clases/class.Secciones.php");
require_once("../../../clases/class.Cursos.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$secciones = new Secciones();
$cursos = new Cursos();
$secciones->db = $db;
$cursos->db = $db;

//---------------------- Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//---------------------- Rutas 
$rutaSecciones = "modulos/cursos/secciones/";
$rutaCursos = "modulos/cursos/";
$rutaSeccionesArchivos = "modulos/cursos/seccionesArchivos/";


//---------------------- Parametros por GET
$idCursos =  $_GET['idCursos'];

//---------------------- Consulta
$consultaSecciones = $secciones->getAllSecciones($idCursos);

//---------------------- Consulta nombre del curso
$rowCursos = $cursos->getOneCursos($idCursos);
$cursosNombre = $fun->imprimir_cadena_utf8($rowCursos['titulo']);

//---------------------- Funcion para vista Add
function add($id, $idCursos)
{
    global $rutaSecciones;
    return "aparecermodulos('{$rutaSecciones}vi_addSecciones.php?id={$id}&idCursos={$idCursos}','main')";
}
?>

<!-- //////////////////////////////////////// Vista tabla -->
<!-- //////////////////////////////////////// Vista tabla -->

<div class="card th-card-titulo">
    <div class="card-header">
        <h5 class="card-title">SECCIONES</h5>
        <div class="card-botones">

            <button onClick="aparecermodulos('<?= $rutaCursos ?>vi_cursos.php','main');" type="button" class="btn btn-info">VER CURSOS</button>

            <button onClick="<?= add(0, $idCursos) ?>" type="button" class="btn btn-info">NUEVA SECCION</button>

        </div>
    </div>
</div>

<div class="card th-card-subtitulo">
    <div class="card-header">
        <h5 class="card-title">CURSOS / SECCIONES</h5>
        <h5 class="card-title">CURSO : <?= $cursosNombre ?></h5>
    </div>
</div>

<div class="card th-card-table">
    <div class="card-body">
        <div class="table-responsive">
            <table id="zeroConfig" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">TITULO</th>
                        <th class="text-center">CONTENIDO</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($rowSecciones = $db->fetch_assoc($consultaSecciones)) {

                        //---------------------- Variables de la vista
                        $id = $fun->imprimir_cadena_utf8($rowSecciones['idsecciones']);
                        $titulo = $fun->imprimir_cadena_utf8($rowSecciones['titulo']);
                        $contenido = $fun->imprimir_cadena_utf8($rowSecciones['contenido']);
                    ?>
                        <tr>
                            <td align="center"><?= $id ?></td>
                            <td align="center"><?= $titulo ?></td>
                            <td align="center"><?= $contenido ?></td>

                            <td align="center">

                                <!-- Editar-->
                                <button onClick="<?= add($id, $idCursos) ?>" type="button" class="btn btn-outline-info" title="EDITAR"><i class="fas fa-pencil-alt"></i></button>

                                <!-- Archivos -->
                                <button onClick="aparecermodulos('<?= $rutaSeccionesArchivos ?>vi_seccionesArchivos.php?idSecciones=<?= $id ?>&idCursos=<?= $idCursos ?>','main');" type="button" class="btn btn-outline-info" title="ARCHIVOS"><i class="fas fa-folder-open"></i></button>

                                <!-- Eliminar -->
                                <button onClick="borrarSecciones('<?= $id; ?>','idsecciones','secciones','n','<?= $rutaSecciones ?>vi_secciones.php?idCursos=<?= $idCursos ?>','main');" type="button" class="btn btn-outline-danger" title="ELIMINAR"><i class="fas fa-trash-alt"></i></button>

                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>