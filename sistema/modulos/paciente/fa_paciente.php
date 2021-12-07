<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Paciente.php");

//========================= Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$paciente = new Paciente();
$paciente->db = $db;

//========================= Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//========================= Rutas
$rutaViPaciente = "modulos/paciente/vi_paciente.php";
$rutaFaPaciente = "modulos/paciente/fa_paciente.php";
$rutaGaPaciente = "modulos/paciente/ga_paciente.php";

//========================= Editando o creando
$rfc = $_GET['rfc'];

$editar = ($rfc != '0') ? true : false;

if ($editar) {
    $rowPaciente = $paciente->getOnePaciente($rfc);
}

//========================= Datos a rellenar del formulario si esta en editar o valor predeterminado si esta en crear
$rfc = ($editar) ?  $rowPaciente['rfc'] : '';
$nombre = ($editar) ?  $rowPaciente['nombre'] : '';
$edad = ($editar) ?  $rowPaciente['edad'] : '';
$sexo = ($editar) ?  $rowPaciente['sexo'] : '';
$telefono = ($editar) ?  $rowPaciente['telefono'] : '';
$tipo = ($editar) ?  $rowPaciente['tipo_derecho_habiente'] : '';

?>

<!-- //=========================================================== -->
<!-- // Vista de formulario  -->
<!-- //===========================================================  -->


<div class="card th-card-titulo">


    <!-- <?php echo $rfc ?> -->
    <div class="card-header th-card-header">
        <h5 class="card-title "><?= ($editar) ? "MODIFICAR PACIENTE" : "AÑADIR PACIENTE" ?></h5>
    </div>
</div>

<div class="card th-card-table">
    <div class="card-body p-4">
        <form id="form-add-paciente" class="mt-4">
            <div class="form-row">


                <div class="form-group col-md-6">
                    <label>RFC:</label>
                    <input type="text" class="form-control" id="viRfc" name="viRfc" value="<?= $rfc ?>">
                </div>

                <div class="form-group col-md-6">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" id="viNombre" name="viNombre" value="<?= $nombre ?>">
                </div>

                <div class="form-group col-md-6">
                    <label>EDAD:</label>
                    <input type="text" class="form-control" id="viEdad" name="viEdad" value="<?= $edad ?>">
                </div>

                <div class="form-group col-md-6">
                    <label>SEXO:</label>
                    <select class="form-control" id="viSexo" name="viSexo">
                        <option value="1" <?= ($sexo == 1) ? 'selected="selected"' : "" ?>>Hombre</option>
                        <option value="2" <?= ($sexo == 2) ? 'selected="selected"' : "" ?>>Mujer</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label>Telefono:</label>
                    <input type="text" class="form-control" id="viTelefono" name="viTelefono" value="<?= $telefono ?>">
                </div>

                <div class="form-group col-md-6">
                    <label>Tipo derecho habiente::</label>
                    <select class="form-control" id="viTipo" name="viTipo">
                        <option value="1" <?= ($tipo == 1) ? 'selected="selected"' : "" ?>>SI </option>
                        <option value="2" <?= ($tipo == 2) ? 'selected="selected"' : "" ?>>NO</option>
                    </select>
                </div>

            </div>


            <div class="form-row">
                <div class="col-md-12 d-flex justify-content-end">

                    <input type="hidden" id="viId" name="viId" value="<?php echo ($editar) ? "1" : "0" ?>" />

                    <button onClick="GuardarEspecial('form-add-paciente',
                    '<?= $rutaGaPaciente ?>',
                    '<?= $rutaViPaciente ?>',
                    'main')" type="button" class="btn btn-success mt-3"><?= ($editar) ? "ACTUALIZAR" : "GUARDAR" ?></button>

                </div>
            </div>
        </form>
    </div>
</div>