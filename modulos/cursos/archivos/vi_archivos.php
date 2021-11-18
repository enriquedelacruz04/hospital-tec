<?php
require_once("../../../clases/conexcion.php");
require_once("../../../clases/class.Sesion.php");
require_once("../../../clases/class.Funciones.php");
require_once("../../../clases/class.Archivos.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$archivos = new Archivos();

$archivos->db = $db;

//---------------------- Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//---------------------- Rutas 
$rutaArchivos = "modulos/cursos/archivos/";

//---------------------- Consulta
$consultaArchivos = $archivos->getAllArchivos();

//---------------------- Funcion para vista Add
function add($id)
{
    global $rutaArchivos;
    return "aparecermodulos('{$rutaArchivos}vi_addArchivos.php?id={$id}','main')";
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
        <h5 class="card-title">INVENTARIO DIGITAL</h5>
        <div class="card-botones">
            <button onClick="<?= add(0) ?>" type="button" class="btn btn-info">NUEVO ARCHIVO</button>
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
                        <th class="text-center">ARCHIVO</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($rowArchivos = $db->fetch_assoc($consultaArchivos)) {

                        //---------------------- Variables de la vista
                        $id = $fun->imprimir_cadena_utf8($rowArchivos['idarchivos']);
                        $titulo = $fun->imprimir_cadena_utf8($rowArchivos['titulo']);
                        $tipo = $fun->imprimir_cadena_utf8($rowArchivos['tipo']);
                        $archivo = $fun->imprimir_cadena_utf8($rowArchivos['archivo']);

                        //---------------------- Especiales
                        $arrayTipo = ['', 'IMAGEN', 'DOCUMENTO', 'VIDEO', 'WEB'];
                        $tipo = $arrayTipo[$tipo];

                    ?>

                        <tr>
                            <td align="center"><?= $id ?></td>
                            <td align="center"><?= $titulo ?></td>
                            <td align="center"><?= $tipo ?></td>
                            <td align="center"><?= $archivo ?></td>
                            <td align="center">

                                <!-- Editar -->
                                <button onClick="<?= add($id) ?>" type="button" class="btn btn-outline-info" title="EDITAR"><i class="fas fa-pencil-alt"></i></button>

                                <!-- Eliminar -->
                                <button onClick="borrarArchivos('<?= $id; ?>','idarchivos','archivos','n','<?= $rutaArchivos ?>vi_archivos.php','main');" type="button" class="btn btn-outline-danger" title="ELIMINAR"><i class="fas fa-trash-alt"></i></button>

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