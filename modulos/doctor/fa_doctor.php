<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Doctor.php");
require_once("../../clases/class.Hospital.php");

//========================= Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$doctor = new Doctor();
$hospital = new Hospital();
$doctor->db = $db;
$hospital->db = $db;

//========================= Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//========================= Rutas
$rutaViDoctor = "modulos/doctor/vi_doctor.php";
$rutaFaDoctor = "modulos/doctor/fa_doctor.php";
$rutaGaDoctor = "modulos/doctor/ga_doctor.php";

//========================= Editando o creando
$cedula = $_GET['cedula'];

$editar = ($cedula != 0) ? true : false;

if ($editar) {
    $rowDoctor = $doctor->getOneDoctor($cedula);
}

//========================= Datos a rellenar del formulario si esta en editar o valor predeterminado si esta en crear
$cedula = ($editar) ?  $rowDoctor['cedula'] : '';
$nombre = ($editar) ?  $rowDoctor['nombre'] : '';
$edad = ($editar) ?  $rowDoctor['edad'] : '';
$sexo = ($editar) ?  $rowDoctor['sexo'] : '';
$telefono = ($editar) ?  $rowDoctor['telefono'] : '';
$especialidad = ($editar) ?  $rowDoctor['especialidad'] : '';
$hospitalNumero = ($editar) ?  $rowDoctor['hospital_numero'] : '';

//========================= Nomnre de los  hospitales
$consultaHospital = $hospital->getAllHospital()
?>

<!-- //=========================================================== -->
<!-- // Vista de formulario  -->
<!-- //===========================================================  -->


<div class="card th-card-titulo">
    <div class="card-header th-card-header">
        <h5 class="card-title "><?= ($editar) ? "MODIFICAR DOCTOR" : "AÑADIR DOCTOR" ?></h5>
    </div>
</div>

<div class="card th-card-table">
    <div class="card-body p-4">
        <form id="form-add-doctor" class="mt-4">
            <div class="form-row">


                <div class="form-group col-md-6">
                    <label>CEDULA:</label>
                    <input type="text" class="form-control" id="viCedula" name="viCedula" value="<?= $cedula ?>">
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
                    <label>Especialidad:</label>
                    <input type="text" class="form-control" id="viEspecialidad" name="viEspecialidad" value="<?= $especialidad ?>">
                </div>

                <div class="form-group col-md-6">
                    <label>HOSPITAL:</label>
                    <select class="form-control" id="viHospitalNumero" name="viHospitalNumero">
                        <?php
                        while ($rowHospital = $db->fetch_assoc($consultaHospital)) {
                            $rowHospitalNumero = $rowHospital['numero'];
                            $rowHospitalNombre = $rowHospital['nombre'];
                        ?>
                            <option value="<?= $rowHospitalNumero ?>" <?= ($hospitalNumero == $rowHospitalNumero) ? 'selected="selected"' : ''  ?>>
                                <?= $rowHospitalNombre ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

            </div>


            <div class="form-row">
                <div class="col-md-12 d-flex justify-content-end">

                    <input type="hidden" id="viId" name="viId" value="<?php echo ($editar) ? "1" : "0" ?>" />

                    <button onClick="GuardarEspecial('form-add-doctor',
                    '<?= $rutaGaDoctor ?>',
                    '<?= $rutaViDoctor ?>',
                    'main')" type="button" class="btn btn-success mt-3"><?= ($editar) ? "ACTUALIZAR" : "GUARDAR" ?></button>

                </div>
            </div>
        </form>
    </div>
</div>