<?php
// require_once("../../../../clases/conexcion.php");
// require_once("../../../../clases/class.Sesion.php");
// require_once("../../../../clases/class.Funciones.php");
// require_once("../../../../clases/class.Servicios.php");

// //---------------------- Funciones
// $db = new MySQL();
// $se = new Sesion();
// $fun = new Funciones();

// $servicios = new Servicios();
// $servicios->db = $db;

// //---------------------- Sesion 
// if (!isset($_SESSION['se_SAS'])) {
//     header("Location: ../login.php");
//     exit;
// }

// //---------------------- Rutas 
// $rutaServicios = "modulos/coach/catalogos/servicios/";

// //---------------------- Editando o creando
// $id = $_GET['id'];
// $editar = ($id != 0) ? true : false;

// if ($editar) {
//     $rowServicios = $servicios->getOneServicios($id);
// }

// //---------------------- Datos a rellenar del formulario si esta en editar o valor predeterminado si esta en crear
// $titulo = ($editar) ?  $fun->imprimir_cadena_utf8($rowServicios['titulo']) : '';
// $descripcion = ($editar) ?  $fun->imprimir_cadena_utf8($rowServicios['descripcion']) : '';
// $estatus = ($editar) ?  $fun->imprimir_cadena_utf8($rowServicios['estatus']) : '1';

// //---------------------- Directorio de Imagenes
// $directorioImagenes = "modulos/coach/catalogos/servicios/imagenes/";
// $archivoImagenExiste = ($rowServicios['archivo_imagen'] !== null) ? true : false;

// $archivoImagen = ($editar) ?  $directorioImagenes . $fun->imprimir_cadena_utf8($rowServicios['archivo_imagen']) : '';
?>

<!-- //////////////////////////////////////// Vista de formulario -->
<!-- //////////////////////////////////////// Vista de formulario -->

<div class="card th-card-titulo">
    <div class="card-header th-card-header">
        <h5 class="card-title "><?= ($editar) ? "MODIFICAR SERVICIO" : "AÑADIR HOSPITAL" ?></h5>
        <div class="card-botones">
            <button onClick="aparecermodulos('<?= $rutaServicios ?>vi_servicios.php','main');" type="button" class="btn btn-info">VER SERVICIOS</button>
        </div>
    </div>
</div>

<div class="card th-card-table">
    <div class="card-body p-4">
        <h5 class="card-title">DATOS DEL HOPSITAL</h5>
        <form id="form-add-servicios" class="mt-4">
            <div class="form-row">

                <div class="form-group col-md-6">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" id="viTitulo" name="viTitulo" value="<?= $titulo ?>">
                </div>

                <div class="form-group col-md-6">
                    <label>Direccion:</label>
                    <input type="text" class="form-control" id="viTitulo" name="viTitulo" value="<?= $titulo ?>">
                </div>


            </div>

            <div class="form-row">

                <div class="form-group col-md-6">
                    <label>DESCRIPCIÓN:</label>
                    <textarea class="form-control" id="viDescripcion" name="viDescripcion" rows="3"><?= $descripcion ?></textarea>
                </div>

                <div class="form-group col-md-6">
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

            <div class="form-row">
                <div class="col-md-12 d-flex justify-content-end">

                    <input type="hidden" id="viId" name="viId" value="<?php echo $id ?>" />

                    <button onClick="guardarServiciosCoach('form-add-servicios',
                    '<?= $rutaServicios ?>c_addServicios.php',
                    '<?= $rutaServicios ?>vi_servicios.php',
                    'main')" type="button" class="btn btn-success mt-3"><?= ($editar) ? "ACTUALIZAR" : "GUARDAR" ?></button>

                </div>
            </div>
        </form>
    </div>
</div>