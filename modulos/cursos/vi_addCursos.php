<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Cursos.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$cursos = new Cursos();

$cursos->db = $db;

//---------------------- Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//---------------------- Rutas 
$rutaCursos = "modulos/cursos/";

//---------------------- Editando o creando
$id = $_GET['id'];
$editar = ($id != 0) ? true : false;

if ($editar) {
    $rowCursos = $cursos->getOneCursos($id);
}

//---------------------- Datos a rellenar del formulario si esta en editar o valor predeterminado si esta en crear
$titulo = ($editar) ?  $fun->imprimir_cadena_utf8($rowCursos['titulo']) : '';
$tipo = ($editar) ?  $fun->imprimir_cadena_utf8($rowCursos['tipo']) : '';
$contenido = ($editar) ?  $fun->imprimir_cadena_utf8($rowCursos['contenido']) : '';
$costo = ($editar) ?  $fun->imprimir_cadena_utf8($rowCursos['costo']) : '0';
$tipoMoneda = ($editar) ?  $fun->imprimir_cadena_utf8($rowCursos['tipo_moneda']) : '1';
$ponentes = ($editar) ?  $fun->imprimir_cadena_utf8($rowCursos['ponentes']) : '';
$estatus = ($editar) ?  $fun->imprimir_cadena_utf8($rowCursos['estatus']) : '1';

//---------------------- Directorio de Imagenes
$directorioImagenes = "modulos/cursos/imagenes/";
$archivoImagenExiste = ($rowCursos['archivo_imagen'] !== null) ? true : false;

$archivoImagen = ($editar) ?  $directorioImagenes . $fun->imprimir_cadena_utf8($rowCursos['archivo_imagen']) : '';

//---------------------- Directorio de Documentos
$directorioDocumentos = "modulos/cursos/documentos/";
$archivoDocumentoExiste = ($rowCursos['archivo_documento'] !== null) ? true : false;

$archivoDocumento = ($editar) ?  $directorioDocumentos . $fun->imprimir_cadena_utf8($rowCursos['archivo_documento']) : '';
$archivoDocumentoNombre =  ($editar) ? $fun->imprimir_cadena_utf8($rowCursos['archivo_documento']) : "";
?>

<!-- //////////////////////////////////////// Vista de formulario -->
<!-- //////////////////////////////////////// Vista de formulario -->

<div class="card th-card-titulo">
    <div class="card-header th-card-header">
        <h5 class="card-title "><?= ($editar) ? "MODIFICAR CURSO" : "ALTA DE CURSO" ?></h5>
        <div class="card-botones">
            <button onClick="aparecermodulos('<?= $rutaCursos ?>vi_cursos.php','main');" type="button" class="btn btn-info">VER CURSOS</button>
        </div>
    </div>
</div>

<div class="card th-card-table">
    <div class="card-body p-4">
        <h5 class="card-title">DATOS DEL CURSO</h5>
        <form id="form-add-cursos" class="mt-4">
            <div class="row">
                <!-- col-6 -->
                <div class="col-md-6">
                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label>TITULO:</label>
                            <input type="text" class="form-control" id="viTitulo" name="viTitulo" value="<?= $titulo ?>">
                        </div>

                        <div class="form-group col-md-12">
                            <label>TIPO:</label>
                            <select class="form-control" id="viTipo" name="viTipo">
                                <option value="TALLER" <?= ($tipo == "TALLER") ? 'selected="selected"' : "" ?>>TALLER</option>
                                <option value="CURSO" <?= ($tipo == "CURSO") ? 'selected="selected"' : "" ?>>CURSO</option>
                                <option value="CONFERENCIA" <?= ($tipo == "CONFERENCIA") ? 'selected="selected"' : "" ?>>CONFERENCIA</option>
                                <option value="PLATICA" <?= ($tipo == "PLATICA") ? 'selected="selected"' : "" ?>>PLATICA</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label>PONENTES:</label>
                            <input type="text" class="form-control" id="viPonentes" name="viPonentes" value="<?= $ponentes ?>">
                        </div>

                        <div class="form-group col-md-12">
                            <label>CONTENIDO:</label>
                            <textarea class="form-control" id="viContenido" name="viContenido" rows="15" cols="50" wrap="hard"><?= $contenido ?></textarea>
                        </div>

                        <div class="form-group col-md-12 th-format-money">
                            <label>INVERSIÓN:</label>
                            <i class="fas fa-dollar-sign"></i>
                            <input type="number" class="form-control" id="viCosto" name="viCosto" value="<?php echo ($costo); ?>">
                        </div>

                        <div class="form-group col-md-12">
                            <label>MONEDA:</label>
                            <select class="form-control" id="tipoMoneda" name="viTipoMoneda">
                                <option value="1" <?= ($tipoMoneda == 1) ? 'selected="selected"' : "" ?>>MXN</option>
                                <option value="2" <?= ($tipoMoneda == 2) ? 'selected="selected"' : "" ?>>USD</option>
                            </select>
                        </div>

                    </div>
                </div>
                <!-- col-6 end -->

                <!-- col-6 -->
                <div class="col-md-6">
                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label>ESTATUS:</label>
                            <select class="form-control" id="viEstatus" name="viEstatus">
                                <option value="1" <?= ($estatus == 1) ? 'selected="selected"' : "" ?>>ACTIVO</option>
                                <option value="0" <?= ($estatus == 0) ? 'selected="selected"' : "" ?>>NO ACTIVO</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label><?= ($editar) ? "CAMBIAR IMAGEN:" : "AÑADIR IMAGEN:" ?></label>
                            <input type="file" class="form-control" id="viImagen" name="viImagen" accept=".png, .jpg, .jpeg">

                            <?php if ($editar && $archivoImagenExiste) { ?>

                                <div class="th-vizualizar-imagenes">
                                    <img src="<?php echo $archivoImagen; ?>" alt="imagen" />
                                </div>

                            <?php }
                            if ($editar && !$archivoImagenExiste) { ?>

                                <div class="th-vizualizar-imagenes">
                                    <p>NO SE HA CARGADO EL ARCHIVO</p>
                                </div>

                            <?php } ?>
                        </div>


                        <div class="form-group col-md-12">
                            <label><?= ($editar) ? "CAMBIAR DOCUMENTO:" : "AÑADIR DOCUMENTO:" ?></label>
                            <input type="file" class="form-control" id="viDocumento" name="viDocumento" accept=".pdf, .docx, .ppx">

                            <?php if ($editar && $archivoDocumentoExiste) { ?>

                                <div class="th-vizualizar-documentos">
                                    <p> <?= $archivoDocumentoNombre ?></p>
                                    <a href="<?= $archivoDocumento ?>" target="_blank" class="btn btn-success" role="button"> VER ARCHIVO</a>
                                </div>

                            <?php }
                            if ($editar && !$archivoDocumentoExiste) { ?>

                                <div class="th-vizualizar-documentos">
                                    <p>NO SE HA CARGADO EL ARCHIVO</p>
                                </div>

                            <?php } ?>
                        </div>



                    </div>
                </div>
                <!-- col-6 end -->

                <div class="col-12">
                    <div class=" form-row">
                        <div class="col-md-12 d-flex justify-content-end">

                            <input type="hidden" id="viId" name="viId" value="<?= $id ?>">

                            <button onClick="guardarCursos('form-add-cursos',
                            '<?= $rutaCursos ?>c_addCursos.php',
                            '<?= $rutaCursos ?>vi_cursos.php',
                            'main')" type="button" class="btn btn-success mt-3"><?= ($editar) ? "ACTUALIZAR" : "GUARDAR" ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>