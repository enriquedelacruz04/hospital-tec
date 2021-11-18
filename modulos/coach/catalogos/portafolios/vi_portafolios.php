<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Portafolios.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$portafolios = new Portafolios();
$portafolios->db = $db;

//---------------------- Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//---------------------- Mensajes de confirmacion
if (isset($_GET['ac'])) {
    if ($_GET['ac'] == 1) {
        $msj = '<div id="mens" class="alert alert-success" role="alert">' . $_GET['msj'] . '</div>';
    } else {
        $msj = '<div id="mens" class="alert alert-danger" role="alert">Error. Intentar mas Tarde ' . $_GET['msj'] . '</div>';
    }
    echo '<script type="text/javascript">OcultarDiv(\'mens\')</script>';
    echo $msj;
}

//---------------------- Rutas de archivo
$ruta1 = "catalogos/portafolios/";

//---------------------- Consulta
$consultaPortafolios = $portafolios->getAllPortafolios();
?>

<!-- //////////////////////////////////////// Vista tabla -->
<!-- //////////////////////////////////////// Vista tabla -->

<div class="card">
    <div class="card-header th-card-header">
        <h5 class="card-title">PORTAFOLIOS</h5>
        <div class="card-botones">
            <button onClick="aparecermodulos('<?= $ruta1 ?>vi_addSucursales.php?id=<?= "0" ?>','main');" type="button" class="btn btn-info">NUEVO ARCHIVO</button>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="zeroConfig" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">TITULO</th>
                        <th class="text-center">DESCRIPCIÓN</th>
                        <th class="text-center">IMAGEN</th>
                        <th class="text-center">VIDEO</th>
                        <th class="text-center">DOCUMENTO</th>
                        <th class="text-center">ESTATUS</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($rowPortafolios = $db->fetch_assoc($consultaPortafolios)) {

                        //---------------------- Variables de la vista
                        $id = $fun->imprimir_cadena_utf8($rowPortafolios['idportafolios']);
                        $titulo = $fun->imprimir_cadena_utf8($rowPortafolios['titulo']);
                        $descripcion = $fun->imprimir_cadena_utf8($rowPortafolios['descripcion']);
                        $idImagenes = $fun->imprimir_cadena_utf8($rowPortafolios['idimagenes']);
                        $idVideos = $fun->imprimir_cadena_utf8($rowPortafolios['idvideos']);
                        $idDocumentos = $fun->imprimir_cadena_utf8($rowPortafolios['iddocumentos']);


                        //---------------------- Especiales
                        $arrayEstatus = ['DESACTIVADO', 'ACTIVADO'];
                        $estatus = $arrayEstatus[$rowPortafolios['estatus']];
                    ?>
                        <tr>
                            <td align="center"><?= $id ?></td>
                            <td align="center"><?= $titulo ?></td>
                            <td align="center"><?= $descripcion ?></td>
                            <td align="center"><?= $idImagenes ?></td>
                            <td align="center"><?= $idVideos ?></td>
                            <td align="center"><?= $idDocumentos ?></td>
                            <td align="center"><?= $estatus ?></td>
                            <td align="center">

                                <button onClick="aparecermodulos('<?= $ruta1 ?>vi_addSucursales.php?id=<?= $id ?>','main');" type="button" class="btn btn-outline-info" title="EDITAR"><i class="fas fa-pencil-alt"></i></button>

                                <button onClick="BorrarDatos('<?php echo $id; ?>','idsucursales','sucursales','n','<?= $ruta1 ?>vi_sucursales.php','main');" type="button" class="btn btn-outline-danger" title="ELIMINAR"><i class="fas fa-trash-alt"></i></button>

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