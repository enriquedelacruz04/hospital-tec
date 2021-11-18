<?php
require_once("../../../clases/conexcion.php");
require_once("../../../clases/class.Sesion.php");
require_once("../../../clases/class.Funciones.php");
require_once("../../../clases/class.CursosCaracteristicas.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$cursosCaracteristicas = new CursosCaracteristicas();
$cursosCaracteristicas->db = $db;

//---------------------- Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//---------------------- Rutas 
$rutaCursosCaracteristicas = "modulos/cursos/cursosCaracteristicas/";

//---------------------- Parametros por GET
$idCursos =  $_GET['idCursos'];

//---------------------- Editando o creando
$id = $_GET['id'];
$editar = ($id != 0) ? true : false;

if ($editar) {
    $rowCursosCaracteristicas = $cursosCaracteristicas->getOneCursosCaracteristicas($id);
}

//---------------------- Datos a rellenar del formulario si esta en editar o valor predeterminado si esta en crear
$titulo = ($editar) ?  $fun->imprimir_cadena_utf8($rowCursosCaracteristicas['titulo']) : '';

?>

<!-- //////////////////////////////////////// Vista de formulario -->
<!-- //////////////////////////////////////// Vista de formulario -->

<div class="card th-card-titulo">
    <div class="card-header th-card-header">
        <h5 class="card-title "><?= ($editar) ? "MODIFICAR CARACTERISTICA" : "ALTA DE CARACTERISTICA" ?></h5>
        <div class="card-botones">
            <button onClick="aparecermodulos('<?= $rutaCursosCaracteristicas ?>vi_cursosCaracteristicas.php?idCursos=<?= $idCursos ?>','main');" type="button" class="btn btn-info">VER CARACTERISTICAS</button>
        </div>
    </div>
</div>

<div class="card th-card-table">
    <div class="card-body p-4">
        <h5 class="card-title">DATOS DE LA CARACTERISTICAS</h5>
        <form id="form-add-cursosCaracteristicas" class="mt-4">

            <div class="form-row">
                <div class="form-group col-md-10">
                    <label>TITULO:</label>
                    <textarea class="form-control" id="viTitulo" name="viTitulo" rows="8"  wrap="hard"><?= $titulo ?></textarea>
                </div>
            </div>


            <div class=" form-row">
                <div class="col-md-12 d-flex justify-content-end">

                    <input type="hidden" id="viId" name="viId" value="<?= $id ?>" />
                    <input type="hidden" id="viIdCursos" name="viIdCursos" value="<?= $idCursos ?>" />

                    <button onClick="guardarCursosCaracteristicas('form-add-cursosCaracteristicas',
                        '<?= $rutaCursosCaracteristicas ?>c_addCursosCaracteristicas.php',
                        '<?= $rutaCursosCaracteristicas ?>vi_cursosCaracteristicas.php?idCursos=<?= $idCursos ?>',
                        'main')" type="button" class="btn btn-success mt-3"><?= ($editar) ? "ACTUALIZAR" : "GUARDAR" ?></button>
                </div>
            </div>
        </form>
    </div>
</div>