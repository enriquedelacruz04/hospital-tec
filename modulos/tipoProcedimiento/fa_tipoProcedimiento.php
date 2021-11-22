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

//========================= Editando o creando
$id = $_GET['id'];

$editar = ($id != 0) ? true : false;

if ($editar) {
    $rowTipoProcedimiento = $tipoProcedimiento->getOneTipoProcedimiento($id);
}

//========================= Datos a rellenar del formulario si esta en editar o valor predeterminado si esta en crear
$nombre = ($editar) ?  $rowTipoProcedimiento['nombre'] : '';
$costo = ($editar) ?  $rowTipoProcedimiento['costo'] : '';
$iva = ($editar) ?  $rowTipoProcedimiento['iva'] : '';
?>

<!-- //=========================================================== -->
<!-- // Vista de formulario  -->
<!-- //===========================================================  -->


<div class="card th-card-titulo">
    <div class="card-header th-card-header">
        <h5 class="card-title "><?= ($editar) ? "MODIFICAR PRCEDIMIENTO" : "AÑADIR PRCEDIMIENTO" ?></h5>
    </div>
</div>

<div class="card th-card-table">
    <div class="card-body p-4">
        <form id="form-add-tipoProcedimiento" class="mt-4">
            <div class="form-row">


                <div class="form-group col-md-6">
                    <label>NOMBRE:</label>
                    <input type="text" class="form-control" id="viNombre" name="viNombre" value="<?= $nombre ?>">
                </div>

                <div class="form-group col-md-6">
                    <label>COSTO:</label>
                    <input type="text" class="form-control" id="viCosto" name="viCosto" value="<?= $costo ?>">
                </div>

                <div class="form-group col-md-6">
                    <label>IVA:</label>
                    <input type="text" class="form-control" id="viIva" name="viIva" value="<?= $iva ?>">
                </div>


            </div>


            <div class="form-row">
                <div class="col-md-12 d-flex justify-content-end">

                    <input type="hidden" id="viId" name="viId" value="<?php echo $id ?>" />

                    <button onClick=" GuardarEspecial('form-add-tipoProcedimiento', '<?= $rutaGaTipoProcedimiento ?>' , '<?= $rutaViTipoProcedimiento ?>' , 'main' )" type="button" class="btn btn-success mt-3"><?= ($editar) ? "ACTUALIZAR" : "GUARDAR" ?></button>

                </div>
            </div>
        </form>
    </div>
</div>