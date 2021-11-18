<?php
require_once("../../../clases/conexcion.php");
require_once("../../../clases/class.Sesion.php");
require_once("../../../clases/class.Funciones.php");
require_once("../../../clases/class.Archivos.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$archivos = new Archivos();

$archivos->db = $db;

//---------------------- Sesion 
if (!isset($_SESSION['se_SAS'])) {
	header("Location: ../login.php");
	exit;
}

//---------------------- Rutas 
$rutaArchivos = "modulos/cursos/archivos/";

//---------------------- Editando o creando
$id = $_GET['id'];
$editar = ($id != 0) ? true : false;

if ($editar) {
	$rowArchivos = $archivos->getOneArchivos($id);
}

//---------------------- Datos a rellenar del formulario si esta en editar o valor predeterminado si esta en crear
$titulo = ($editar) ?  $fun->imprimir_cadena_utf8($rowArchivos['titulo']) : '';
$tipo = ($editar) ?  $fun->imprimir_cadena_utf8($rowArchivos['tipo']) : '';
?>

<!-- //////////////////////////////////////// Vista de formulario -->
<!-- //////////////////////////////////////// Vista de formulario -->

<div class="card th-card-titulo">
	<div class="card-header th-card-header">
		<h5 class="card-title "><?= ($editar) ? "MODIFICAR ARCHIVO" : "ALTA DE ARCHIVO" ?></h5>
		<div class="card-botones">
			<button onClick="aparecermodulos('<?= $rutaArchivos ?>vi_archivos.php','main');" type="button" class="btn btn-info">VER INVENTARIO DIGITAL</button>
		</div>
	</div>
</div>

<div class="card th-card-table">
	<div class="card-body p-4">
		<h5 class="card-title">DATOS DEL ARCHIVO</h5>
		<form id="form-add-archivos" class="mt-4">


			<div class="form-row">

				<div class="form-group col-md-12">
					<label>TITULO:</label>
					<textarea class="form-control" id="viTitulo" name="viTitulo" rows="3"><?= $titulo ?></textarea>
				</div>




				<div class="form-group col-md-4">
					<label>TIPO DE ARCHIVO:</label>
					<select class="form-control" id="viTipo" name="viTipo">
						<option value="0" disabled selected="selected">SELECIONAR</option>
						<option value="1" <?= ($tipo == 1) ? 'selected="selected"' : "" ?>>IMAGEN</option>
						<option value="2" <?= ($tipo == 2) ? 'selected="selected"' : "" ?>>DOCUMENTO</option>
						<option value="3" <?= ($tipo == 3) ? 'selected="selected"' : "" ?>>VIDEO</option>
						<option value="4" <?= ($tipo == 4) ? 'selected="selected"' : "" ?>>WEB</option>
					</select>
				</div>


				<!-- //---------------------- Imagenes -->
				<div class="form-group col-md-8  <?= ($editar && $tipo == 1) ? "" : "d-none" ?>" id="addImagen">
					<label><?= ($editar) ? "CAMBIAR IMAGEN :" : "AÑADIR IMAGEN :" ?></label>
					<input type="file" class="form-control" id="viImagen" name="viImagen" accept=".png, .jpg, .jpeg">


					<?php
					if ($tipo == 1 && $editar) {

						// ---------------------- Directorio de Imagenes
						$directorioImagenes = "modulos/cursos/archivos/imagenes/";
						$archivoImagen = ($editar) ?  $directorioImagenes . $fun->imprimir_cadena_utf8($rowArchivos['archivo']) : '';
						$archivoImagenExiste = ($rowArchivos['archivo'] !== null) ? true : false;
					?>

						<?php
						if ($editar && $archivoImagenExiste) {
						?>

							<div class="th-vizualizar-imagenes">
								<img src="<?= $archivoImagen; ?>" alt="imagen" />
							</div>

						<?php
						}
						if ($editar && !$archivoImagenExiste) {
						?>

							<div class="th-vizualizar-imagenes">
								<p>NO SE HA CARGADO EL ARCHIVO</p>
							</div>

					<?php
						}
					}
					?>
				</div>



				<!-- //---------------------- documentos -->
				<div class="form-group col-md-8 <?= ($editar && $tipo == 2) ? "" : "d-none" ?>" id="addDocumento">
					<label><?= ($editar) ? "CAMBIAR DOCUMENTO :" : "AÑADIR DOCUMENTO :" ?></label>
					<input type="file" class="form-control" id="viDocumento" name="viDocumento" accept=".pdf, .docx">


					<?php
					if ($tipo == 2 && $editar) {

						// ---------------------- Directorio de Docuemntos
						$directorioDocumentos = "modulos/cursos/archivos/documentos/";
						$archivoDocumento = ($editar) ?  $directorioDocumentos . $fun->imprimir_cadena_utf8($rowArchivos['archivo']) : '';
						$archivoDocumentoExiste = ($rowArchivos['archivo'] !== null) ? true : false;
					?>

						<?php
						if ($editar && $archivoDocumentoExiste) {
						?>

							<div class="th-vizualizar-documentos">
								<p> <?= $archivoDocumentoNombre ?></p>
								<a href="<?= $archivoDocumento ?>" target="_blank" class="btn btn-success" role="button"> VER ARCHIVO</a>
							</div>

						<?php
						}
						if ($editar && !$archivoDocumentoExiste) {
						?>

							<div class="th-vizualizar-documentos">
								<p>NO SE HA CARGADO EL ARCHIVO</p>
							</div>

					<?php
						}
					}
					?>
				</div>


				<!-- //---------------------- Videos -->
				<div class="form-group col-md-8  <?= ($editar && $tipo == 3) ? "" : "d-none" ?>" id="addVideo">
					<label><?= ($editar) ? "CAMBIAR URL DEL VIDEO :" : "AÑADIR URL DEL VIDEO :" ?></label>

					<?php
					if ($tipo == 3 && $editar) {
						$archivoVideo = ($editar) ?  $fun->imprimir_cadena_utf8($rowArchivos['archivo']) : '';
					?>
						<input type="url" class="form-control" id="viVideo" name="viVideo" value="<?= $archivoVideo ?>">

					<?php
					} else {
					?>

						<input type="url" class="form-control" id="viVideo" name="viVideo" value="">

					<?php
					}
					?>

				</div>

				<!-- //---------------------- Urls -->
				<div class="form-group col-md-8  <?= ($editar && $tipo == 4) ? "" : "d-none" ?>" id="addWeb">
					<label><?= ($editar) ? "CAMBIAR URL DE LA WEB :" : "AÑADIR URL DE LA WEB :" ?></label>

					<?php
					if ($tipo == 4 && $editar) {
						$archivoUrl = ($editar) ?  $fun->imprimir_cadena_utf8($rowArchivos['archivo']) : '';

					?>
						<input type="url" class="form-control" id="viWeb" name="viWeb" value="<?= $archivoUrl ?>">

					<?php
					} else {
					?>

						<input type="url" class="form-control" id="viWeb" name="viWeb" value="">

					<?php
					}
					?>
				</div>



				<div class="col-12">
					<div class=" form-row">
						<div class="col-md-12 d-flex justify-content-end">

							<input type="hidden" id="viId" name="viId" value="<?= $id ?>">

							<button onClick="guardarArchivos('form-add-archivos',
                            '<?= $rutaArchivos ?>c_addArchivos.php',
                            '<?= $rutaArchivos ?>vi_archivos.php',
                            'main')" type="button" class="btn btn-success mt-3"><?= ($editar) ? "ACTUALIZAR" : "GUARDAR" ?>
							</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	eventTipoArchivo();
</script>