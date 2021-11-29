<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Procedimiento.php");

//========================= Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$procedimiento = new Procedimiento();
$procedimiento->db = $db;

//========================= Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//========================= Rutas
$rutaViProcedimiento = "modulos/procedimiento/vi_procedimiento.php";
$rutaFaProcedimiento = "modulos/procedimiento/fa_procedimiento.php";
$rutaGaProcedimiento = "modulos/procedimiento/ga_procedimiento.php";
?>

<!-- //=========================================================== -->
<!-- // Vista de tabla  -->
<!-- //===========================================================  -->

<div class="card th-card-titulo">
    <div class="card-header">
        <h5 class="card-title">PRECEDIMIENTOS</h5>
        <div class="card-botones">
            <button onClick="aparecermodulos('<?= $rutaFaProcedimiento . "?id=0"  ?>','main');" type=" button" class="btn btn-info">NUEVO PRECEDIMIENTO</button>
        </div>
    </div>
</div>

<div class="card th-card-table">
    <div class="card-body">
        <div class="table-responsive">
            <table id="zeroConfig" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">NUMERO DEL P.</th>
                        <th class="text-center">RFC PACIENTE</th>
                        <th class="text-center">TIPO PROCEDIMIENTO</th>
                        <th class="text-center">DOCTOR</th>
                        <th class="text-center">INSUMO</th>
                        <th class="text-center">FECHA</th>
                        <th class="text-center">HORA</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    //========================= Consulta
                    $consultaProcedimiento = $procedimiento->getAllProcedimiento();
                    while ($rowProcedimiento = $db->fetch_assoc($consultaProcedimiento)) {

                        //========================= Variables de la vista
                        $id = $rowProcedimiento['idprocedimiento'];
                        $paciente = $rowProcedimiento['paciente_rfc'];
                        $tipo = $rowProcedimiento['tipo_procedimiento_idtipo_procediento'];
                        $doctor = $rowProcedimiento['doctor_cedula'];
                        $insumo = $rowProcedimiento['insumo_idinsumo'];
                        $fecha = $rowProcedimiento['fecha'];
                        $hora = $rowProcedimiento['hora'];
                    ?>
                        <tr>
                            <td align="center"><?= $id ?></td>
                            <td align="center"><?= $paciente ?></td>
                            <td align="center"><?= $tipo ?></td>
                            <td align="center"><?= $doctor ?></td>
                            <td align="center"><?= $insumo ?></td>
                            <td align="center"><?= $fecha ?></td>
                            <td align="center"><?= $hora ?></td>
                            <td align="center">

                                <!-- Editar -->
                                <button onClick="aparecermodulos('<?= $rutaFaProcedimiento . "?id=$id" ?>','main');" type="button" class="btn btn-outline-info" title="EDITAR"><i class="fas fa-pencil-alt"></i></button>

                                <!-- Eliminar -->
                                <button onClick="BorrarDatos('<?= $id; ?>','idprocedimiento','procedimiento','n','<?= $rutaViProcedimiento ?>','main');" type="button" class="btn btn-outline-danger" title="ELIMINAR"><i class="fas fa-trash-alt"></i></button>

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