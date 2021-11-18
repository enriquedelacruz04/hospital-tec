<?php
require_once("../../../../clases/conexcion.php");
require_once("../../../../clases/class.Sesion.php");
require_once("../../../../clases/class.Funciones.php");
require_once("../../../../clases/class.Noticias.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();

$noticias = new Noticias();
$noticias->db = $db;

//---------------------- Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//---------------------- Rutas 
$rutaNoticias = "modulos/coach/catalogos/noticias/";

//---------------------- Editando o creando
$id = $_GET['id'];
$editar = ($id != 0) ? true : false;

if ($editar) {
    $rowNoticias = $noticias->getOneNoticias($id);
}

//---------------------- Datos a rellenar del formulario si esta en editar o valor predeterminado si esta en crear
$titulo = ($editar) ?  $fun->imprimir_cadena_utf8($rowNoticias['titulo']) : '';
$autor = ($editar) ?  $fun->imprimir_cadena_utf8($rowNoticias['autor']) : '';
$textoNoticia = ($editar) ?  $fun->imprimir_cadena_utf8($rowNoticias['texto_noticia']) : '';
$estatus = ($editar) ?  $fun->imprimir_cadena_utf8($rowNoticias['estatus']) : '1';

//---------------------- Directorio de Imagenes
$directorioImagenes = "modulos/coach/catalogos/noticias/imagenes/";
$archivoImagenExiste = ($rowNoticias['archivo_imagen'] !== null) ? true : false;

$archivoImagen = ($editar) ?  $directorioImagenes . $fun->imprimir_cadena_utf8($rowNoticias['archivo_imagen']) : '';
?>

<!-- //////////////////////////////////////// Vista de formulario -->
<!-- //////////////////////////////////////// Vista de formulario -->

<div class="card th-card-titulo">
    <div class="card-header th-card-header">
        <h5 class="card-title "><?= ($editar) ? "MODIFICAR NOTICIA" : "ALTA DE NOTICIA" ?></h5>
        <div class="card-botones">
            <button onClick="aparecermodulos('<?= $rutaNoticias ?>vi_noticias.php','main');" type="button" class="btn btn-info">VER NOTICIAS</button>
        </div>
    </div>
</div>

<div class="card th-card-table">
    <div class="card-body p-4">
        <h5 class="card-title">DATOS DE LA NOTICIA</h5>
        <form id="form-add-noticias" class="mt-4">

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group col-md-12">
                        <label>TITULO:</label>
                        <input type="text" class="form-control" id="viTitulo" name="viTitulo" value="<?= $titulo ?>">
                    </div>

                    <div class="form-group col-md-12">
                        <label>AUTOR:</label>
                        <input type="text" class="form-control" id="viAutor" name="viAutor" value="<?= $autor ?>">
                    </div>

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

                </div>


                <div class="col-md-6">

                    <div class="form-group col-md-12">
                        <label>TEXTO NOTICIA:</label>
                        <textarea class="form-control" id="viTextoNoticia" name="viTextoNoticia" rows="15"><?= $textoNoticia ?></textarea>
                    </div>

                </div>

                <div class="col-md-12">
                    <div class="form-group col-md-12 d-flex justify-content-end">
                        <input type="hidden" id="viId" name="viId" value="<?php echo $id ?>" />

                        <button onClick="guardarNoticias('form-add-noticias',
                        '<?= $rutaNoticias ?>c_addNoticias.php',
                        '<?= $rutaNoticias ?>vi_noticias.php',
                        'main')" type="button" class="btn btn-success mt-3"><?= ($editar) ? "ACTUALIZAR" : "GUARDAR" ?>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>