<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Cursos.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$cursos = new Cursos();

$cursos->db = $db;

//---------------------- Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//---------------------- Rutas 
$rutaCursos = "modulos/cursos/";
$rutaSecciones = "modulos/cursos/secciones/";
$rutaCursosCaracteristicas = "modulos/cursos/cursosCaracteristicas/";

//---------------------- Consulta
$consultaCursos = $cursos->getAllCursos();

//---------------------- Funcion para vista Add
function add($id)
{
    global $rutaCursos;
    return "aparecermodulos('{$rutaCursos}vi_addCursos.php?id={$id}','main')";
}

//---------------------- Funcion para cortar palabras
function cortarPalabras($contenido, $noPalabras)
{
    $arrayContenido = explode(" ", $contenido);
    if (count($arrayContenido) > $noPalabras) {
        $contenido = "";
        for ($i = 0; $i < $noPalabras; $i++) {
            $contenido .= $arrayContenido[$i] . " ";
        }
        $contenido .= " ...";
    } else {
        $contenido = $contenido;
    }
    return $contenido;
}
?>

<!-- //////////////////////////////////////// Vista tabla -->
<!-- //////////////////////////////////////// Vista tabla -->

<div class="card th-card-titulo">
    <div class="card-header">
        <h5 class="card-title">CURSOS</h5>
        <div class="card-botones">
            <button onClick="<?= add(0) ?>" type="button" class="btn btn-info">NUEVO CURSO</button>
        </div>
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
                        <th class="text-center">TIPO</th>
                        <th class="text-center">CONTENIDO</th>
                        <th class="text-center">COSTO</th>
                        <th class="text-center">MONEDA</th>
                        <th class="text-center">PONENTES</th>
                        <th class="text-center">IMAGEN</th>
                        <th class="text-center">DOCUMENTO</th>
                        <th class="text-center">FECHA</th>
                        <th class="text-center">ESTATUS</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($rowCursos = $db->fetch_assoc($consultaCursos)) {

                        //---------------------- Variables de la vista
                        $id = $fun->imprimir_cadena_utf8($rowCursos['idcursos']);
                        $titulo = $fun->imprimir_cadena_utf8($rowCursos['titulo']);
                        $tipo = $fun->imprimir_cadena_utf8($rowCursos['tipo']);
                        $contenido = $fun->imprimir_cadena_utf8($rowCursos['contenido']);
                        $costo = $fun->imprimir_cadena_utf8($rowCursos['costo']);
                        $tipoMoneda = $fun->imprimir_cadena_utf8($rowCursos['tipo_moneda']);
                        $ponentes = $fun->imprimir_cadena_utf8($rowCursos['ponentes']);
                        $imagen = $fun->imprimir_cadena_utf8($rowCursos['archivo_imagen']);
                        $documento = $fun->imprimir_cadena_utf8($rowCursos['archivo_documento']);
                        $fecha = $fun->imprimir_cadena_utf8($rowCursos['fecha']);
                        $estatus = $fun->imprimir_cadena_utf8($rowCursos['estatus']);


                        //---------------------- Especiales
                        $arrayEstatus = ['NO ACTIVO', 'ACTIVO'];
                        $estatus = $arrayEstatus[$estatus];

                        $arrayMoneda = ['', 'MXN', 'USD'];
                        $tipoMoneda = $arrayMoneda[$tipoMoneda];

                        $costo = "$ " . $costo;

                        $contenido = cortarPalabras($contenido, 5);
                    ?>

                        <tr>
                            <td align="center"><?= $id ?></td>
                            <td align="center"><?= $titulo ?></td>
                            <td align="center"><?= $tipo ?></td>
                            <td align="center"><?= $contenido ?></td>
                            <td align="center"><?= $costo ?></td>
                            <td align="center"><?= $tipoMoneda ?></td>
                            <td align="center"><?= $ponentes ?></td>
                            <td align="center"><?= $imagen ?></td>
                            <td align="center"><?= $documento ?></td>
                            <td align="center"><?= $fecha ?></td>
                            <td align="center"><?= $estatus ?></td>
                            <td align="center">

                                <!-- Editar -->
                                <button onClick="<?= add($id) ?>" type="button" class="btn btn-outline-info" title="EDITAR"><i class="fas fa-pencil-alt"></i></button>

                                <!-- Secciones -->
                                <button onClick="aparecermodulos('<?= $rutaSecciones ?>vi_secciones.php?idCursos=<?= $id ?>','main');" type="button" class="btn btn-outline-info" title="SECCIONES CURSO"><i class="fas fa-list-ol"></i></button>

                                <!-- Caracteristicas -->
                                <button onClick="aparecermodulos('<?= $rutaCursosCaracteristicas ?>vi_cursosCaracteristicas.php?idCursos=<?= $id ?>','main');" type="button" class="btn btn-outline-info" title="CARACTERISTICAS CURSO"><i class="fas fa-boxes"></i></button>

                                <!-- Eliminar -->
                                <button onClick="borrarCursos('<?= $id; ?>','idcursos','cursos','n','<?= $rutaCursos ?>vi_cursos.php','main');" type="button" class="btn btn-outline-danger" title="ELIMINAR"><i class="fas fa-trash-alt"></i></button>

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
        "sScrollX": "100%",
        "sScrollXInner": "100%",
    });
</script>