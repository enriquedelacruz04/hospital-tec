<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.TipoProcedimiento.php");

//========================= Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$tipoProcedimiento = new TipoProcedimiento();
$tipoProcedimiento->db = $db;

//========================= Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//========================= Rutas
$rutaViTipoProcedimiento = "modulos/tipoProcedimiento/vi_tipoProcedimiento.php";
$rutaFaTipoProcedimiento = "modulos/tipoProcedimiento/fa_tipoProcedimiento.php";
$rutaGaTipoProcedimiento = "modulos/tipoProcedimiento/ga_tipoProcedimiento.php";
?>

<!-- //=========================================================== -->
<!-- // Vista de tabla  -->
<!-- //===========================================================  -->

<div class="card th-card-titulo">
    <div class="card-header">
        <h5 class="card-title">LISTA DE PROCEDIMIENTOS </h5>
        <div class="card-botones">
            <button onClick="aparecermodulos('<?= $rutaFaTipoProcedimiento . "?id=0"  ?>','main');" type=" button" class="btn btn-info">NUEVO PROCEDIMIENTO</button>
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
                        <th class="text-center">NOMBRE</th>
                        <th class="text-center">COSTO</th>
                        <th class="text-center">IVA</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    //========================= Consulta
                    $consultaTipoProcedimiento = $tipoProcedimiento->getAllTipoProcedimiento();
                    while ($rowTipoProcedimiento = $db->fetch_assoc($consultaTipoProcedimiento)) {

                        //========================= Variables de la vista
                        $id = $rowTipoProcedimiento['idtipo_procedimiento'];
                        $nombre = $rowTipoProcedimiento['nombre'];
                        $costo = $rowTipoProcedimiento['costo'];
                        $iva = $rowTipoProcedimiento['iva'];
                    ?>
                        <tr>
                            <td align="center"><?= $id ?></td>
                            <td align="center"><?= $nombre ?></td>
                            <td align="center"><?= $costo ?></td>
                            <td align="center"><?= $iva ?></td>
                            <td align="center">

                                <!-- Editar -->
                                <button onClick="aparecermodulos('<?= $rutaFaTipoProcedimiento . "?id=$id" ?>','main');" type="button" class="btn btn-outline-info" title="EDITAR"><i class="fas fa-pencil-alt"></i></button>

                                <!-- Eliminar -->
                                <button onClick="BorrarDatos('<?= $id; ?>','idtipo_procedimiento','tipo_procedimiento','n','<?= $rutaViTipoProcedimiento ?>','main');" type="button" class="btn btn-outline-danger" title="ELIMINAR"><i class="fas fa-trash-alt"></i></button>

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