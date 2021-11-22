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

//========================= Editando o creando
$id = $_GET['id'];

$editar = ($id != 0) ? true : false;

if ($editar) {
    $rowInsumo = $insumo->getOneInsumo($id);
}

//========================= Datos a rellenar del formulario si esta en editar o valor predeterminado si esta en crear
$nombre = ($editar) ?  $rowInsumo['nombre'] : '';
$cantidad = ($editar) ?  $rowInsumo['cantidad'] : '';
$marca = ($editar) ?  $rowInsumo['marca'] : '';
?>

<!-- //=========================================================== -->
<!-- // Vista de formulario  -->
<!-- //===========================================================  -->


<div class="card th-card-titulo">
    <div class="card-header th-card-header">
        <h5 class="card-title "><?= ($editar) ? "MODIFICAR INSUMO" : "AÑADIR INSUMO" ?></h5>
    </div>
</div>

<div class="card th-card-table">
    <div class="card-body p-4">
        <form id="form-add-insumo" class="mt-4">
            <div class="form-row">


                <div class="form-group col-md-6">
                    <label>NOMBRE:</label>
                    <input type="text" class="form-control" id="viNombre" name="viNombre" value="<?= $nombre ?>">
                </div>

                <div class="form-group col-md-6">
                    <label>CANTIDAD:</label>
                    <input type="text" class="form-control" id="viCantidad" name="viCantidad" value="<?= $cantidad ?>">
                </div>

                <div class="form-group col-md-6">
                    <label>MARCA:</label>
                    <input type="text" class="form-control" id="viMarca" name="viMarca" value="<?= $marca ?>">
                </div>


            </div>


            <div class="form-row">
                <div class="col-md-12 d-flex justify-content-end">

                    <input type="hidden" id="viId" name="viId" value="<?php echo $id ?>" />

                    <button onClick=" GuardarEspecial('form-add-insumo', '<?= $rutaGaInsumo ?>' , '<?= $rutaViInsumo ?>' , 'main' )" type="button" class="btn btn-success mt-3"><?= ($editar) ? "ACTUALIZAR" : "GUARDAR" ?></button>

                </div>
            </div>
        </form>
    </div>
</div>