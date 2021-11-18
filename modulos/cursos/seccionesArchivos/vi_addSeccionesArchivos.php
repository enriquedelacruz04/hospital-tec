<?php
require_once("../../../clases/conexcion.php");
require_once("../../../clases/class.Sesion.php");
require_once("../../../clases/class.Funciones.php");
require_once("../../../clases/class.SeccionesArchivos.php");
require_once("../../../clases/class.Secciones.php");
require_once("../../../clases/class.Cursos.php");
require_once("../../../clases/class.Archivos.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$seccionesArchivos = new SeccionesArchivos();
$secciones = new Secciones();
$cursos = new Cursos();
$archivos = new Archivos();
$seccionesArchivos->db = $db;
$secciones->db = $db;
$cursos->db = $db;
$archivos->db = $db;

//---------------------- Sesion 
if (!isset($_SESSION['se_SAS'])) {
	header("Location: ../login.php");
	exit;
}

//---------------------- Rutas 
$rutaSeccionesArchivos = "modulos/cursos/seccionesArchivos/";
// $rutaSecciones = "modulos/cursos/secciones/";

//---------------------- Parametros por GET
$idSecciones =  $_GET['idSecciones'];
$idCursos =  $_GET['idCursos'];
$idArchivos =  $_GET['idArchivos'];

//---------------------- Editando o creando
$id = $_GET['id'];
$editar = ($id != 0) ? true : false;

if ($editar) {
	$rowSeccionesArchivos = $seccionesArchivos->getOneSeccionesArchivos($id);
}

//---------------------- Datos a rellenar del formulario si esta en editar o valor predeterminado si esta en crear
$contenido = ($editar) ?  $fun->imprimir_cadena_utf8($rowSeccionesArchivos['contenido']) : '';
$idArchivos = ($editar) ?  $fun->imprimir_cadena_utf8($rowSeccionesArchivos['idarchivos']) : '';

// //---------------------- Directorio de Archivos
$directorioDocumentos = "modulos/cursos/archivos/documentos/";
$directorioImagenes = "modulos/cursos/archivos/imagenes/";


// //---------------------- Consultas nombre Archivo
if ($editar) {
	$rowArchivos =  $archivos->getOneArchivos($idArchivos);
	$archivosTitulo = $fun->imprimir_cadena_utf8($rowArchivos['titulo']);
}
?>

<!-- //////////////////////////////////////// Vista de formulario -->
<!-- //////////////////////////////////////// Vista de formulario -->

<div class="card th-card-titulo">
	<div class="card-header th-card-header">
		<h5 class="card-title "><?= ($editar) ? "MODIFICAR ARCHIVO" : "ALTA DE ARCHIVO" ?></h5>
		<div class="card-botones">
			<button onClick="aparecermodulos('<?= $rutaSeccionesArchivos ?>vi_seccionesArchivos.php?idSecciones=<?= $idSecciones ?>&idCursos=<?= $idCursos ?>','main');" type="button" class="btn btn-info">VER ARCHIVOS DE CURSO</button>
		</div>
	</div>
</div>

<div class="card th-card-table">
	<div class="card-body p-4">
		<h5 class="card-title">DATOS DEL ARCHIVO</h5>
		<form id="form-add-seccionesArchivos" class="mt-4">
			<div class="form-row">

				<div class="form-group col-md-12">
					<label>CONTENIDO:</label>
					<textarea class="form-control" id="viContenido" name="viContenido" rows="7"><?= $contenido ?></textarea>
				</div>

				<div class="form-group col-md-6">
					<label><?= ($editar) ? "CAMBIAR ARCHIVO:" : "AÑADIR ARCHIVO:" ?></label>
					<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modalAddArchivo">SELECCIONAR ARCHIVO</button>
				</div>

				<div class="form-group col-md-6" id="archivoSelect">
					<label>ARCHIVO SELECCIONADO:</label>
					<input type="hidden" class="form-control" id="viIdArchivos" name="viIdArchivos" value="<?= $idArchivos ?>">

					<div class="th-vizualizar-documentos">
						<p><?= ($editar) ?  $archivosTitulo : 'NO SE HA SELECCIONADO ARCHIVO' ?></p>
					</div>

				</div>

			</div>
			<div class="form-row">
				<div class="col-md-12 d-flex justify-content-end">

					<input type="hidden" id="viId" name="viId" value="<?= $id ?>" />
					<input type="hidden" id="viIdSecciones" name="viIdSecciones" value="<?= $idSecciones ?>" />

					<button onClick="guardarSeccionesArchivos('form-add-seccionesArchivos',
                        '<?= $rutaSeccionesArchivos ?>c_addSeccionesArchivos.php',
                        '<?= $rutaSeccionesArchivos ?>vi_seccionesArchivos.php?idSecciones=<?= $idSecciones ?>&idCursos=<?= $idCursos ?>',
                        'main')" type="button" class="btn btn-success mt-3"><?= ($editar) ? "ACTUALIZAR" : "GUARDAR" ?>
					</button>

				</div>
			</div>
		</form>
	</div>
</div>

<!-- //////////////////////////////////////// Modal -->
<!-- //////////////////////////////////////// Modal -->

<div class="modal fade th-modal" id="modalAddArchivo" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel"><?= ($editar) ? "MODIFICAR DOCUMENTO" : "AGREGAR DOCUMENTO" ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">





				<div class="row">
					<div class="col-md-3">
						<div class="list-group" id="list-tab" role="tablist">
							<a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">IMAGENES</a>
							<a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">DOCUMENTOS</a>
							<a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">VIDEOS</a>
							<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">WEB</a>
						</div>
					</div>
					<div class="col-md-9">
						<div class="tab-content" id="nav-tabContent">

							<!-- imagenes -->
							<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
								<div class="row">

									<?php
									$consultaArchivos = $archivos->getAllArchivos(1);
									while ($rowArchivos = $db->fetch_assoc($consultaArchivos)) {
										$rowArchivosArchivo =   $directorioImagenes . $rowArchivos['archivo'];
										$rowArchivosTitulo =   $rowArchivos['titulo'];
										$rowArchivosFecha =   $rowArchivos['fecha'];
										$rowArchivosId =   $rowArchivos['idarchivos'];
									?>

										<div class="col-md-6 th-modal-item">
											<ul class="list-unstyled">
												<li class="media">
													<img src="images/modalArchivo/imagen.png" class="mr-3" alt="imagen">
													<div class="media-body">
														<h5 class=""><?= $rowArchivosTitulo ?></h5>
														<input type="hidden" name="" id="viRowArchivosId" value="<?= $rowArchivosId ?>">

													</div>
												</li>
											</ul>
										</div>

									<?php
									}
									?>
								</div>
							</div>
							<!-- doc -->
							<div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
								<div class="row">

									<?php
									$consultaArchivos = $archivos->getAllArchivos(2);
									while ($rowArchivos = $db->fetch_assoc($consultaArchivos)) {
										$rowArchivosArchivo =   $directorioImagenes . $rowArchivos['archivo'];
										$rowArchivosTitulo =   $rowArchivos['titulo'];
										$rowArchivosFecha =   $rowArchivos['fecha'];
										$rowArchivosId =   $rowArchivos['idarchivos'];
									?>

										<div class="col-md-6 th-modal-item">
											<ul class="list-unstyled">
												<li class="media">
													<img src="images/modalArchivo/doc.png" class="mr-3" alt="imagen">
													<div class="media-body">
														<h5 class=""><?= $rowArchivosTitulo ?></h5>
														<input type="hidden" name="" id="viRowArchivosId" value="<?= $rowArchivosId ?>">


													</div>
												</li>
											</ul>
										</div>

									<?php }  ?>
								</div>
							</div>
							<!-- doc -->
							<div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
								<div class="row">

									<?php
									$consultaArchivos = $archivos->getAllArchivos(3);
									while ($rowArchivos = $db->fetch_assoc($consultaArchivos)) {
										$rowArchivosArchivo =   $directorioImagenes . $rowArchivos['archivo'];
										$rowArchivosTitulo =   $rowArchivos['titulo'];
										$rowArchivosFecha =   $rowArchivos['fecha'];
										$rowArchivosId =   $rowArchivos['idarchivos'];
									?>

										<div class="col-md-6 th-modal-item">
											<ul class="list-unstyled">
												<li class="media">
													<img src="images/modalArchivo/video.png" class="mr-3" alt="imagen">
													<div class="media-body">
														<h5 class=""><?= $rowArchivosTitulo ?></h5>
														<input type="hidden" name="" id="viRowArchivosId" value="<?= $rowArchivosId ?>">


													</div>
												</li>
											</ul>
										</div>

									<?php }  ?>
								</div>
							</div>
							<!-- web -->
							<div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
								<div class="row">

									<?php
									$consultaArchivos = $archivos->getAllArchivos(4);
									while ($rowArchivos = $db->fetch_assoc($consultaArchivos)) {
										$rowArchivosArchivo =   $directorioImagenes . $rowArchivos['archivo'];
										$rowArchivosTitulo =   $rowArchivos['titulo'];
										$rowArchivosFecha =   $rowArchivos['fecha'];
										$rowArchivosId =   $rowArchivos['idarchivos'];
									?>

										<div class="col-md-6 th-modal-item">
											<ul class="list-unstyled">
												<li class="media">
													<img src="images/modalArchivo/sitio.png" class="mr-3" alt="imagen">
													<div class="media-body">
														<h5 class=""><?= $rowArchivosTitulo ?></h5>
														<input type="hidden" name="" id="viRowArchivosId" value="<?= $rowArchivosId ?>">

													</div>
												</li>
											</ul>
										</div>

									<?php }  ?>
								</div>
							</div>
						</div>
					</div>







				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
					<button onclick="selectArchivo()" type="button" class="btn btn-success">SELECCIONAR</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		eventSelectArchivo();
	</script>