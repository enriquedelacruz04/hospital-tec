<?php
require_once("../../../../clases/conexcion.php");
require_once("../../../../clases/class.Sesion.php");
require_once("../../../../clases/class.Funciones.php");
require_once("../../../../clases/class.Noticias.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$noticias = new Noticias();
$noticias->db = $db;

//---------------------- Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//---------------------- Rutas 
$rutaNoticias = "modulos/coach/catalogos/noticias/";

//---------------------- Funcion para vista Add
function add($id)
{
    global $rutaNoticias;
    return "aparecermodulos('{$rutaNoticias}vi_addNoticias.php?id={$id}','main')";
}
?>

<!-- //////////////////////////////////////// Vista tabla -->
<!-- //////////////////////////////////////// Vista tabla -->

<div class="card th-card-titulo">
    <div class="card-header">
        <h5 class="card-title">NOTICIAS</h5>
        <div class="card-botones">
            <button onClick="<?= add(0) ?>" type="button" class="btn btn-info">NUEVO NOTICIA</button>
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
                        <th class="text-center">FECHA</th>
                        <th class="text-center">TITULO</th>
                        <th class="text-center">AUTOR</th>
                        <th class="text-center">TEXTO</th>
                        <th class="text-center">IMAGEN</th>
                        <th class="text-center">ESTATUS</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    //---------------------- Consulta
                    $consultaNoticias = $noticias->getAllNoticias();
                    while ($rowNoticias = $db->fetch_assoc($consultaNoticias)) {

                        //---------------------- Variables de la vista
                        $id = $fun->imprimir_cadena_utf8($rowNoticias['idnoticias']);
                        $fecha = $fun->imprimir_cadena_utf8($rowNoticias['fecha']);
                        $titulo = $fun->imprimir_cadena_utf8($rowNoticias['titulo']);
                        $autor = $fun->imprimir_cadena_utf8($rowNoticias['autor']);
                        $textoNoticia = $fun->imprimir_cadena_utf8($rowNoticias['texto_noticia']);
                        $archivoImagen = $fun->imprimir_cadena_utf8($rowNoticias['archivo_imagen']);
                        $estatus = $fun->imprimir_cadena_utf8($rowNoticias['estatus']);

                        //---------------------- Especiales
                        $arrayEstatus = ['NO ACTIVO', 'ACTIVO'];
                        $estatus = $arrayEstatus[$estatus];
                    ?>
                        <tr>
                            <td align="center"><?= $id ?></td>
                            <td align="center"><?= $fecha ?></td>
                            <td align="center"><?= $titulo ?></td>
                            <td align="center"><?= $autor ?></td>
                            <td align="center"><?= $textoNoticia ?></td>
                            <td align="center"><?= $archivoImagen ?></td>
                            <td align="center"><?= $estatus ?></td>
                            <td align="center">

                                <!-- Editar -->
                                <button onClick="<?= add($id) ?>" type="button" class="btn btn-outline-info" title="EDITAR"><i class="fas fa-pencil-alt"></i></button>

                                <!-- Eliminar -->
                                <button onClick="borrarNoticiasCoach('<?= $id; ?>','idnoticias','noticias','n','<?= $rutaNoticias ?>vi_noticias.php','main');" type="button" class="btn btn-outline-danger" title="ELIMINAR"><i class="fas fa-trash-alt"></i></button>

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