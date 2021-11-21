<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Hospital.php");

//========================= Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$hospital = new Hospital();
$hospital->db = $db;

//========================= Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//========================= Rutas
$rutaViHospital = "modulos/hospital/vi_hospital.php";
$rutaFaHospital = "modulos/hospital/fa_hospital.php";
$rutaGaHospital = "modulos/hospital/ga_hospital.php";

//========================= Editando o creando
$numero = $_GET['numero'];

$editar = ($numero != 0) ? true : false;

if ($editar) {
    $rowHospital = $hospital->getOneHospital($numero);
}

//========================= Datos a rellenar del formulario si esta en editar o valor predeterminado si esta en crear
$numero = ($editar) ?  $rowHospital['numero'] : '';
$nombre = ($editar) ?  $rowHospital['nombre'] : '';
$direccion = ($editar) ?  $rowHospital['direccion'] : '';
$telefono = ($editar) ?  $rowHospital['telefono'] : '';
$correo = ($editar) ?  $rowHospital['correo'] : '';
?>

<!-- //=========================================================== -->
<!-- // Vista de formulario  -->
<!-- //===========================================================  -->


<div class="card th-card-titulo">
    <div class="card-header th-card-header">
        <h5 class="card-title "><?= ($editar) ? "MODIFICAR HOSPITAL" : "AÑADIR HOSPITAL" ?></h5>
    </div>
</div>

<div class="card th-card-table">
    <div class="card-body p-4">
        <form id="form-add-hospital" class="mt-4">
            <div class="form-row">

                <div class="form-group col-md-6">
                    <label>Numero:</label>
                    <input type="text" class="form-control" id="viNumero" name="viNumero" value="<?= $numero ?>">
                </div>

                <div class="form-group col-md-6">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" id="viNombre" name="viNombre" value="<?= $nombre ?>">
                </div>

                <div class="form-group col-md-6">
                    <label>Direccion:</label>
                    <input type="text" class="form-control" id="viDireccion" name="viDireccion" value="<?= $direccion ?>">
                </div>

                <div class="form-group col-md-6">
                    <label>Telefono:</label>
                    <input type="text" class="form-control" id="viTelefono" name="viTelefono" value="<?= $telefono ?>">
                </div>

                <div class="form-group col-md-6">
                    <label>Correo:</label>
                    <input type="text" class="form-control" id="viCorreo" name="viCorreo" value="<?= $correo ?>">
                </div>

            </div>


            <div class="form-row">
                <div class="col-md-12 d-flex justify-content-end">

                    <input type="hidden" id="viId" name="viId" value="<?php echo ($editar) ? "1" : "0" ?>" />

                    <button onClick="GuardarEspecial('form-add-hospital',
                    '<?= $rutaGaHospital ?>',
                    '<?= $rutaViHospital ?>',
                    'main')" type="button" class="btn btn-success mt-3"><?= ($editar) ? "ACTUALIZAR" : "GUARDAR" ?></button>

                </div>
            </div>
        </form>
    </div>
</div>