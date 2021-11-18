<?php
require_once("../../../clases/conexcion.php");
require_once("../../../clases/class.Sesion.php");
require_once("../../../clases/class.Funciones.php");
require_once("../../../clases/class.CursosCaracteristicas.php");
require_once("../../../clases/class.Cursos.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$cursosCaracteristicas = new CursosCaracteristicas();
$cursos = new Cursos();
$cursosCaracteristicas->db = $db;
$cursos->db = $db;

//---------------------- Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//---------------------- Rutas 
$rutaCursosCaracteristicas = "modulos/cursos/cursosCaracteristicas/";
$rutaCursos = "modulos/cursos/";

//---------------------- Parametros por GET
$idCursos =  $_GET['idCursos'];

//---------------------- Consulta
$consultaCursosCaracteristicas = $cursosCaracteristicas->getAllCursosCaracteristicas($idCursos);

//---------------------- Consulta nombre del curso
$rowCursos = $cursos->getOneCursos($idCursos);
$cursosNombre = $fun->imprimir_cadena_utf8($rowCursos['titulo']);

//---------------------- Funcion para vista Add
function add($id, $idCursos)
{
    global $rutaCursosCaracteristicas;
    return "aparecermodulos('{$rutaCursosCaracteristicas}vi_addCursosCaracteristicas.php?id={$id}&idCursos={$idCursos}','main')";
}
?>

<!-- //////////////////////////////////////// Vista tabla -->
<!-- //////////////////////////////////////// Vista tabla -->

<div class="card th-card-titulo">
    <div class="card-header">
        <h5 class="card-title">CARACTERISTICAS</h5>
        <div class="card-botones">

            <button onClick="aparecermodulos('<?= $rutaCursos ?>vi_cursos.php','main');" type="button" class="btn btn-info">VER CURSOS</button>

            <button onClick="<?= add(0, $idCursos) ?>" type="button" class="btn btn-info">NUEVA CARACTERISTICA</button>

        </div>
    </div>
</div>

<div class="card th-card-subtitulo">
    <div class="card-header">
        <h5 class="card-title">CURSOS / CARACTERISTICAS</h5>
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
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($rowCursosCaracteristicas = $db->fetch_assoc($consultaCursosCaracteristicas)) {

                        //---------------------- Variables de la vista
                        $id = $fun->imprimir_cadena_utf8($rowCursosCaracteristicas['idcursos_caracteristicas']);
                        $titulo = $fun->imprimir_cadena_utf8($rowCursosCaracteristicas['titulo']);

                    ?>
                        <tr>
                            <td align="center"><?= $id ?></td>
                            <td align="center"><?= $titulo ?></td>
                            <td align="center">

                                <!-- Editar-->
                                <button onClick="<?= add($id, $idCursos) ?>" type="button" class="btn btn-outline-info" title="EDITAR"><i class="fas fa-pencil-alt"></i></button>

                                <!-- Eliminar -->
                                <button onClick="borrarCursosCaracteristicas('<?= $id; ?>','idcursos_caracteristicas','cursos_caracteristicas','n','<?= $rutaCursosCaracteristicas ?>vi_cursosCaracteristicas.php?idCursos=<?= $idCursos ?>','main');" type="button" class="btn btn-outline-danger" title="ELIMINAR"><i class="fas fa-trash-alt"></i></button>

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

<!-- //---------------------- Paginacion -->
<script type="text/javascript" charset="utf-8">
    var oTable = $('#zeroConfig').dataTable({
        "oLanguage": {
            "sLengthMenu": "Mostrar _MENU_ Registros por página",
            "sZeroRecords": "No existen registros en esta tabla",
            "sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
            "sInfoEmpty": "",
            "sInfoFiltered": "(filtered desde _MAX_ total Registros)",
            "sSearch": "",
            "oPaginate": {
                "sFirst": "Inicio",
                "sPrevious": "Anterior",
                "sNext": "Siguiente",
                "sLast": "Ultimo"
            }
        },
        "sPaginationType": "full_numbers",
        "ordering": false,
        // "sScrollX": "100%",
        // "sScrollXInner": "100%",
    });
</script>