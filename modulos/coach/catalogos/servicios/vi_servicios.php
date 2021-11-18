<?php
require_once("../../../../clases/conexcion.php");
require_once("../../../../clases/class.Sesion.php");
require_once("../../../../clases/class.Funciones.php");
require_once("../../../../clases/class.Servicios.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$servicios = new Servicios();
$servicios->db = $db;

//---------------------- Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//---------------------- Rutas 
$rutaServicios = "modulos/coach/catalogos/servicios/";

//---------------------- Funcion para vista Add
function add($id)
{
    global $rutaServicios;
    return "aparecermodulos('{$rutaServicios}vi_addServicios.php?id={$id}','main')";
}
?>

<!-- //////////////////////////////////////// Vista tabla -->
<!-- //////////////////////////////////////// Vista tabla -->

<div class="card th-card-titulo">
    <div class="card-header">
        <h5 class="card-title">SERVICIOS</h5>
        <div class="card-botones">
            <button onClick="<?= add(0) ?>" type="button" class="btn btn-info">NUEVO SERVICIO</button>
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
                        <th class="text-center">DESCRIPCIÓN</th>
                        <th class="text-center">IMAGEN</th>
                        <th class="text-center">ESTATUS</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    //---------------------- Consulta
                    $consultaServicios = $servicios->getAllServicios();
                    while ($rowServicios = $db->fetch_assoc($consultaServicios)) {

                        //---------------------- Variables de la vista
                        $id = $fun->imprimir_cadena_utf8($rowServicios['idservicios']);
                        $titulo = $fun->imprimir_cadena_utf8($rowServicios['titulo']);
                        $descripcion = $fun->imprimir_cadena_utf8($rowServicios['descripcion']);
                        $imagen = $fun->imprimir_cadena_utf8($rowServicios['archivo_imagen']);
                        $estatus = $fun->imprimir_cadena_utf8($rowServicios['estatus']);

                        //---------------------- Especiales
                        $arrayEstatus = ['NO ACTIVO', 'ACTIVO'];
                        $estatus = $arrayEstatus[$estatus];
                    ?>
                        <tr>
                            <td align="center"><?= $id ?></td>
                            <td align="center"><?= $titulo ?></td>
                            <td align="center"><?= $descripcion ?></td>
                            <td align="center"><?= $imagen ?></td>
                            <td align="center"><?= $estatus ?></td>
                            <td align="center">

                                <!-- Editar -->
                                <button onClick="<?= add($id) ?>" type="button" class="btn btn-outline-info" title="EDITAR"><i class="fas fa-pencil-alt"></i></button>

                                <!-- Eliminar -->
                                <button onClick="borrarServiciosCoach('<?= $id; ?>','idservicios','servicios','n','<?= $rutaServicios ?>vi_servicios.php','main');" type="button" class="btn btn-outline-danger" title="ELIMINAR"><i class="fas fa-trash-alt"></i></button>

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