<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Insumo.php");

//========================= Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$insumo = new Insumo();
$insumo->db = $db;

//========================= Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//========================= Rutas
$rutaViInsumo = "modulos/insumo/vi_insumo.php";
$rutaFaInsumo = "modulos/insumo/fa_insumo.php";
$rutaGaInsumo = "modulos/insumo/ga_insumo.php";
?>

<!-- //=========================================================== -->
<!-- // Vista de tabla  -->
<!-- //===========================================================  -->

<div class="card th-card-titulo">
    <div class="card-header">
        <h5 class="card-title">LISTA DE INSUMOS </h5>
        <div class="card-botones">
            <button onClick="aparecermodulos('<?= $rutaFaInsumo . "?id=0"  ?>','main');" type=" button" class="btn btn-info">NUEVO INSUMO</button>
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
                        <th class="text-center">CANTIDAD</th>
                        <th class="text-center">MARCA</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    //========================= Consulta
                    $consultaInsumo = $insumo->getAllInsumo();
                    while ($rowInsumo = $db->fetch_assoc($consultaInsumo)) {

                        //========================= Variables de la vista
                        $id = $rowInsumo['idinsumo'];
                        $nombre = $rowInsumo['nombre'];
                        $cantidad = $rowInsumo['cantidad'];
                        $marca = $rowInsumo['marca'];
                    ?>
                        <tr>
                            <td align="center"><?= $id ?></td>
                            <td align="center"><?= $nombre ?></td>
                            <td align="center"><?= $cantidad ?></td>
                            <td align="center"><?= $marca ?></td>
                            <td align="center">

                                <!-- Editar -->
                                <button onClick="aparecermodulos('<?= $rutaFaInsumo . "?id=$id" ?>','main');" type="button" class="btn btn-outline-info" title="EDITAR"><i class="fas fa-pencil-alt"></i></button>

                                <!-- Eliminar -->
                                <button onClick="BorrarDatos('<?= $id; ?>','idinsumo','insumo','n','<?= $rutaViInsumo ?>','main');" type="button" class="btn btn-outline-danger" title="ELIMINAR"><i class="fas fa-trash-alt"></i></button>

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