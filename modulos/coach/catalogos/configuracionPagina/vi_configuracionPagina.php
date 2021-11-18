<?php
require_once("../../../../clases/conexcion.php");
require_once("../../../../clases/class.Sesion.php");
require_once("../../../../clases/class.Funciones.php");
require_once("../../../../clases/class.ConfiguracionPagina.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$configuracionPagina = new ConfiguracionPagina();
$configuracionPagina->db = $db;

//---------------------- Sesion 
if (!isset($_SESSION['se_SAS'])) {
	header("Location: ../login.php");
	exit;
}

$rutaConfiguracion = "modulos/coach/catalogos/configuracionPagina/";


//----------------------  Datos a rellenar del formulario si esta en editar o valor predeterminado si esta en crear
$consultaConfiguracionPagina = $configuracionPagina->getAllConfiguracionPagina();
$rowConfiguracionPagina = $db->fetch_assoc($consultaConfiguracionPagina);

$id = isset($rowConfiguracionPagina['idconfiguracion_pagina']) ?  $fun->imprimir_cadena_utf8($rowConfiguracionPagina['idconfiguracion_pagina']) : '';
$nombrePagina = isset($rowConfiguracionPagina['nombre_pagina']) ?  $fun->imprimir_cadena_utf8($rowConfiguracionPagina['nombre_pagina']) : '';
$noCursos = isset($rowConfiguracionPagina['no_cursos']) ?  $fun->imprimir_cadena_utf8($rowConfiguracionPagina['no_cursos']) : '';
$noCertificados = isset($rowConfiguracionPagina['no_certificados']) ?  $fun->imprimir_cadena_utf8($rowConfiguracionPagina['no_certificados']) : '';
$noPlaticas = isset($rowConfiguracionPagina['no_platicas']) ?  $fun->imprimir_cadena_utf8($rowConfiguracionPagina['no_platicas']) : '';
$noClientes = isset($rowConfiguracionPagina['no_clientes']) ?  $fun->imprimir_cadena_utf8($rowConfiguracionPagina['no_clientes']) : '';

$correo = isset($rowConfiguracionPagina['correo']) ?  $fun->imprimir_cadena_utf8($rowConfiguracionPagina['correo']) : '';
$telefono1 = isset($rowConfiguracionPagina['telefono1']) ?  $fun->imprimir_cadena_utf8($rowConfiguracionPagina['telefono1']) : '';
$telefono2 = isset($rowConfiguracionPagina['telefono2']) ?  $fun->imprimir_cadena_utf8($rowConfiguracionPagina['telefono2']) : '';
$ubicacion = isset($rowConfiguracionPagina['ubicacion']) ?  $fun->imprimir_cadena_utf8($rowConfiguracionPagina['ubicacion']) : '';
$ubicacionMapa = isset($rowConfiguracionPagina['ubicacion_mapa']) ?  $fun->imprimir_cadena_utf8($rowConfiguracionPagina['ubicacion_mapa']) : '';
$facebook = isset($rowConfiguracionPagina['facebook']) ?  $fun->imprimir_cadena_utf8($rowConfiguracionPagina['facebook']) : '';
$instagram = isset($rowConfiguracionPagina['instagram']) ?  $fun->imprimir_cadena_utf8($rowConfiguracionPagina['instagram']) : '';
$twitter = isset($rowConfiguracionPagina['twitter']) ?  $fun->imprimir_cadena_utf8($rowConfiguracionPagina['twitter']) : '';
?>

<!-- //////////////////////////////////////// Vista de formulario -->
<!-- //////////////////////////////////////// Vista de formulario -->

<div class="card  th-card-titulo mb-3">
	<div class="card-header">
		<h5 class="card-title">CONFIGURACIÓN DE LA PÁGINA</h5>
	</div>
</div>

<form id="form-add-configuracionPagina">
	<div class="card-body">

		<div class="card ">
			<div class="card-header card-header--black">
				DATOS GENERALES
			</div>
			<div class="card-body">

				<div class="row">

					<div class="col-md-6 m-b-20">
						<label for="viNombrePagina" class="form-label">NOMBRE DE LA PAGINA:</label>
						<input type="text" class="form-control" id="viNombrePagina" name="viNombrePagina" value="<?= $nombrePagina; ?>">
					</div>

					<div class="col-md-6 m-b-20">
						<label for="viHorario" class="form-label">CORREO:</label>
						<input type="text" class="form-control" id="viCorreo" name="viCorreo" value="<?= $correo; ?>">
					</div>

					<div class="col-md-6 m-b-20 ">
						<label for="viTelefono1" class="form-label">TELÉFONO 1:</label>
						<input type="text" class="form-control" id="viTelefono1" name="viTelefono1" value="<?= $telefono1; ?>">
					</div>
					<div class="col-md-6 m-b-20">
						<label for="viTelefono2" class="form-label">TELÉFONO 2:</label>
						<input type="text" class="form-control" id="viTelefono2" name="viTelefono2" value="<?= $telefono2; ?>">
					</div>

					<div class="col-md-6 ">
						<label for="viUbicacion" class="form-label">UBICACIÓN:</label>
						<textarea id="viUbicacion" name="viUbicacion" class="form-control" rows="3"><?= $ubicacion ?></textarea>
					</div>


				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-header card-header--black">
				REDES SOCIALES
			</div>
			<div class="card-body">

				<div class="row">

					<div class="col-md-6">
						<label for="viFacebook" class="form-label">FACEBOOK:</label>
						<input type="text" class="form-control" id="viFacebook" name="viFacebook" value="<?= $facebook; ?>">
					</div>
					<div class="col-md-6">
						<label for="viInstagram" class="form-label">INSTAGRAM:</label>
						<input type="text" class="form-control" id="viInstagram" name="viInstagram" value="<?= $instagram; ?>">
					</div>
					<div class="col-md-6">
						<label for="viInstagram" class="form-label">TWITTER:</label>
						<input type="text" class="form-control" id="viTwitter" name="viTwitter" value="<?= $twitter; ?>">
					</div>
				</div>
			</div>


		</div>

		<div class="card">
			<div class="card-header card-header--black">
				DATOS HISTORICOS
			</div>
			<div class="card-body">

				<div class="row">

					<div class="col-md-3">
						<label for="viFacebook" class="form-label">NO DE CURSOS:</label>
						<input type="number" class="form-control" id="viNoCursos" name="viNoCursos" value="<?= $noCursos; ?>">
					</div>
					<div class="col-md-3">
						<label for="viInstagram" class="form-label">NO DE CERTIFICADOS:</label>
						<input type="number" class="form-control" id="viNoCertificados" name="viNoCertificados" value="<?= $noCertificados; ?>">
					</div>
					<div class="col-md-3">
						<label for="viInstagram" class="form-label">NO DE PLATICAS:</label>
						<input type="number" class="form-control" id="viNoPlaticas" name="viNoPlaticas" value="<?= $noPlaticas; ?>">
					</div>
					<div class="col-md-3">
						<label for="viInstagram" class="form-label">NO DE CLIENTES:</label>
						<input type="number" class="form-control" id="viNoClientes" name="viNoClientes" value="<?= $noClientes; ?>">
					</div>
				</div>
			</div>


		</div>


		<div class="form-row">
			<div class="col-md-12 d-flex justify-content-end">

				<input type="hidden" id="viId" name="viId" value="<?php echo $id ?>" />

				<button onClick="guardarConfiguracionPagina('form-add-configuracionPagina',
                    '<?= $rutaConfiguracion ?>c_configuracionPagina.php',
                    '<?= $rutaConfiguracion ?>vi_configuracionPagina.php',
                    'main')" type="button" class="btn btn-success mt-3"><?= ($editar) ? "ACTUALIZAR" : "GUARDAR" ?></button>

			</div>
		</div>
	</div>
</form>


</div>