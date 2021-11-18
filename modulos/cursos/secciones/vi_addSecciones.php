<?php
require_once("../../../clases/conexcion.php");
require_once("../../../clases/class.Sesion.php");
require_once("../../../clases/class.Funciones.php");
require_once("../../../clases/class.Secciones.php");
// require_once("../../../clases/class.Imagenes.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$secciones = new Secciones();
// $imagenes = new Imagenes();
$secciones->db = $db;
// $imagenes->db = $db;

//---------------------- Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//---------------------- Rutas 
$rutaSecciones = "modulos/cursos/secciones/";

//---------------------- Parametros por GET
$idCursos =  $_GET['idCursos'];

//---------------------- Editando o creando
$id = $_GET['id'];
$editar = ($id != 0) ? true : false;

if ($editar) {
    $rowSecciones = $secciones->getOneSecciones($id);
}

//---------------------- Datos a rellenar del formulario si esta en editar o valor predeterminado si esta en crear
$titulo = ($editar) ?  $fun->imprimir_cadena_utf8($rowSecciones['titulo']) : '';
$contenido = ($editar) ?  $fun->imprimir_cadena_utf8($rowSecciones['contenido']) : '';
$posicion = ($editar) ?  $fun->imprimir_cadena_utf8($rowSecciones['posicion']) : '';

?>

<!-- //////////////////////////////////////// Vista de formulario -->
<!-- //////////////////////////////////////// Vista de formulario -->

<div class="card th-card-titulo">
    <div class="card-header th-card-header">
        <h5 class="card-title "><?= ($editar) ? "MODIFICAR SECCION" : "ALTA DE SECCIÓN" ?></h5>
        <div class="card-botones">
            <button onClick="aparecermodulos('<?= $rutaSecciones ?>vi_secciones.php?idCursos=<?= $idCursos ?>','main');" type="button" class="btn btn-info">VER SECCIONES</button>
        </div>
    </div>
</div>

<div class="card th-card-table">
    <div class="card-body p-4">
        <h5 class="card-title">DATOS DE LA SECCIÓN</h5>
        <form id="form-add-secciones" class="mt-4">

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>TITULO:</label>
                    <input type="text" class="form-control" id="viTitulo" name="viTitulo" value="<?= $titulo ?>">
                </div>
              

            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>CONTENIDO:</label>
                    <textarea class="form-control" id="viContenido" name="viContenido" rows="5"><?= $contenido ?></textarea>
                </div>
            </div>


            <div class=" form-row">
                <div class="col-md-12 d-flex justify-content-end">

                    <input type="hidden" id="viId" name="viId" value="<?= $id ?>" />
                    <input type="hidden" id="viIdCursos" name="viIdCursos" value="<?= $idCursos ?>" />

                    <button onClick="guardarSecciones('form-add-secciones',
                        '<?= $rutaSecciones ?>c_addSecciones.php',
                        '<?= $rutaSecciones ?>vi_secciones.php?idCursos=<?= $idCursos ?>',
                        'main')" type="button" class="btn btn-success mt-3"><?= ($editar) ? "ACTUALIZAR" : "GUARDAR" ?></button>
                </div>
            </div>
        </form>
    </div>
</div>