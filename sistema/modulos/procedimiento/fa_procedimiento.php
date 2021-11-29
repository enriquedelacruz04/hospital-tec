<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Procedimiento.php");
require_once("../../clases/class.Paciente.php");
require_once("../../clases/class.TipoProcedimiento.php");
require_once("../../clases/class.Doctor.php");
require_once("../../clases/class.Insumo.php");

//========================= Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();

$procedimiento = new Procedimiento();
$paciente = new Paciente();
$tipoProcedimiento = new TipoProcedimiento();
$doctor = new Doctor();
$insumo = new Insumo();

$procedimiento->db = $db;
$paciente->db = $db;
$tipoProcedimiento->db = $db;
$doctor->db = $db;
$insumo->db = $db;

//========================= Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//========================= Rutas
$rutaViProcedimiento = "modulos/procedimiento/vi_procedimiento.php";
$rutaFaProcedimiento = "modulos/procedimiento/fa_procedimiento.php";
$rutaGaProcedimiento = "modulos/procedimiento/ga_procedimiento.php";

//========================= Editando o creando
$id = $_GET['id'];

$editar = ($id != 0) ? true : false;

if ($editar) {
    $rowProcedimiento = $procedimiento->getOneProcedimiento($id);
}

//========================= Datos a rellenar del formulario si esta en editar o valor predeterminado si esta en crear
$idPaciente = ($editar) ?  $rowProcedimiento['paciente_rfc'] : '';
$idTipoProcedimiento = ($editar) ?  $rowProcedimiento['tipo_procedimiento_idtipo_procediento'] : '';
$idDoctor = ($editar) ?  $rowProcedimiento['doctor_cedula'] : '';
$idInsumo = ($editar) ?  $rowProcedimiento['insumo_idinsumo'] : '';
$fecha = ($editar) ?  $rowProcedimiento['fecha'] : '';
$hora = ($editar) ?  $rowProcedimiento['hora'] : '';

//========================= Nomnre de los pacientes
$consultaPaciente = $paciente->getAllPaciente();

//========================= Nombre de los tipos de procedimiento
$consultaTipoProcedimiento = $tipoProcedimiento->getAllTipoProcedimiento();

//========================= Nombre de los doctores
$consultaDoctor = $doctor->getAllDoctor();

//========================= Nombre de los insumos
$consultaInsumo = $insumo->getAllInsumo();

?>

<!-- //=========================================================== -->
<!-- // Vista de formulario  -->
<!-- //===========================================================  -->


<div class="card th-card-titulo">
    <div class="card-header th-card-header">
        <h5 class="card-title "><?= ($editar) ? "MODIFICAR PROCEDIMIENTO" : "AÑADIR PROCEDIMIENTO" ?></h5>
    </div>
</div>

<div class="card th-card-table">
    <div class="card-body p-4">
        <form id="form-add-procedimiento" class="mt-4">
            <div class="form-row">


                <div class="form-group col-md-6">
                    <label>PACIENTE:</label>
                    <select class="form-control" id="viPaciente" name="viPaciente">
                        <option value="Elegir">Elegir</option>

                        <?php
                        while ($rowPaciente = $db->fetch_assoc($consultaPaciente)) {
                            $rowPacienteId = $rowPaciente['rfc'];
                            $rowPacienteNombre = $rowPaciente['nombre'];
                        ?>
                            <option value="<?= $rowPacienteId ?>" <?= ($idPaciente == $rowPacienteId) ? 'selected="selected"' : ''  ?>>
                                <?= $rowPacienteNombre ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label>TIPO PROCEDIMIENTO:</label>
                    <select class="form-control" id="viTipoProcedimiento" name="viTipoProcedimiento">
                        <option value="Elegir">Elegir</option>

                        <?php
                        while ($rowTipoProcedimiento = $db->fetch_assoc($consultaTipoProcedimiento)) {
                            $rowTipoProcedimientoId = $rowTipoProcedimiento['idtipo_procedimiento'];
                            $rowTipoProcedimientoNombre = $rowTipoProcedimiento['nombre'];
                        ?>
                            <option value="<?= $rowTipoProcedimientoId ?>" <?= ($idTipoProcedimiento == $rowTipoProcedimientoId) ? 'selected="selected"' : ''  ?>>
                                <?= $rowTipoProcedimientoNombre ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label>DOCTOR:</label>
                    <select class="form-control" id="viDoctor" name="viDoctor">
                        <option value="Elegir">Elegir</option>

                        <?php
                        while ($rowDoctor = $db->fetch_assoc($consultaDoctor)) {
                            $rowDoctorId = $rowDoctor['cedula'];
                            $rowDoctorNombre = $rowDoctor['nombre'];
                        ?>
                            <option value="<?= $rowDoctorId ?>" <?= ($idDoctor == $rowDoctorId) ? 'selected="selected"' : ''  ?>>
                                <?= $rowDoctorNombre ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label>INSUMOS:</label>
                    <select class="form-control" id="viInsumo" name="viInsumo">
                        <option value="Elegir">Elegir</option>

                        <?php
                        while ($rowInsumo = $db->fetch_assoc($consultaInsumo)) {
                            $rowInsumoId = $rowInsumo['idinsumo'];
                            $rowInsumoNombre = $rowInsumo['nombre'];
                        ?>
                            <option value="<?= $rowInsumoId ?>" <?= ($idInsumo == $rowInsumoId) ? 'selected="selected"' : ''  ?>>
                                <?= $rowInsumoNombre ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label>Fecha:</label>
                    <input type="date" class="form-control" id="viFecha" name="viFecha" value="<?= $fecha ?>">
                </div>

                <div class="form-group col-md-6">
                    <label>Hora:</label>
                    <input type="time" class="form-control" id="viHora" name="viHora" value="<?= $hora ?>">
                </div>

            </div>


            <div class="form-row">
                <div class="col-md-12 d-flex justify-content-end">

                    <input type="hidden" id="viId" name="viId" value="<?php echo $id ?>" />

                    <button onClick="GuardarEspecial('form-add-procedimiento',
                    '<?= $rutaGaProcedimiento ?>',
                    '<?= $rutaViProcedimiento ?>',
                    'main')" type="button" class="btn btn-success mt-3"><?= ($editar) ? "ACTUALIZAR" : "GUARDAR" ?></button>

                </div>
            </div>
        </form>
    </div>
</div>