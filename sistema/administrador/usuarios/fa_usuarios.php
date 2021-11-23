<?php
require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();


if (!isset($_SESSION['se_SAS'])) {
	header("Location: ../login.php");
	exit;
}

require_once("../../clases/conexcion.php");
// require_once("../../clases/class.Sucursales.php");
require_once("../../clases/class.Funciones.php");

$db = new MySQL();
// $su = new Sucursales();
$fu = new Funciones();

// $su->db = $db;


$queryPerfil = "SELECT idperfiles, perfil FROM perfiles WHERE estatus=1";
$resp = $db->consulta($queryPerfil);
$rows = $db->fetch_assoc($resp);
$total = $db->num_rows($resp);

?>
<form id="alta_usuario" method="post" action="">
	<div class="card mb-3">
		<div class="card-header ">
			<h5 class="card-title" style="float: left; margin-top: 5px;">ALTA DE USUARIOS</h5>
			<button type="button" onClick="aparecermodulos('administrador/usuarios/vi_usuarios.php','main');" class="btn btn-info" style="float: right;">VER USUARIO</button>
			<div style="clear: both;"></div>
		</div>
	</div>
	<div class="card mb-3">
		<div class="card-header card-header--black">
			<h5 class="card-title" style="float: left; margin-top: 5px;">DATOS GENERALES</h5>
		</div>

		<div class="card-body">
		



			<div class="form-group m-t-20">
				<input type="hidden" name="idperfiles" id="idperfiles" value="1" />
			</div>

			<div class="form-group m-t-20">
				<label>NOMBRE :</label>
				<input type="text" name="nombre" id="nombre" class="form-control" title="Nombre" placeholder="Nombre del usuario" />
			</div>

			<div class="form-group m-t-20">
				<label>APELLIDO PATERNO:</label>
				<input type="text" name="paterno" id="paterno" class="form-control" title="Apellido Paterno" placeholder="Apellido Paterno" />
			</div>

			<div class="form-group m-t-20">
				<label>APELLIDO MATERNO:</label>
				<input type="text" name="materno" id="materno" class="form-control" title="Apellido Materno" placeholder="Apellido Materno" />
			</div>

			<div class="form-group m-t-20">
				<label>CELULAR:</label>
				<input type="text" name="celular" id="celular" class="form-control" title="Celular" placeholder="123456789" />
			</div>

			<div class="form-group m-t-20">
				<label>TELÉFONO:</label>
				<input type="text" name="telefono" id="telefono" class="form-control" title="Tel&eacute;fono" placeholder="123456789" />
			</div>

			<div class="form-group m-t-20">
				<label>EMAIL:</label>
				<input type="text" name="email" id="email" class="form-control" title="Email" placeholder="Ingresa un email válido" />
			</div>
		</div>
	</div>

	<div class="card mb-3">
		<div class="card-header card-header--black">
			<h5 class="card-title" style="float: left; margin-top: 5px;">DATOS DE ACCESO</h5>
		</div>
		<div class="card-body">
			<div class="form-group m-t-0">
				<label class="width_full th_texto-rojo"><span id="requerido"></span> ➧ Genera el usuario y clave con las cuales éste usuario podrá ingresar al sistema</label>
				<BR>
				<label>USUARIO:</label>
				<input onKeyPress="bloquear_enie (event.Keycode)" type="text" onBlur="var resp=MM_validateForm('usuario','','R'); if(resp==1){validarUsuario();}" value="" name="usuario" id="usuario" class="form-control" title="Usuario" placeholder="Ingresa un nombre de usuario..." />
				<span style="float:left; font-size: 10px;" id="msj_error">&nbsp;</span>
				<div id="mensajes" class="width_3_quarter"></div>
				<input type="hidden" name="user_valid" id="user_valid" value="no" title="Usuario Válido" />
			</div>

			<div class="form-group m-t-20">
				<label>CLAVE:</label>
				<input type="password" name="clave" id="clave" class="form-control" title="Clave" placeholder="Ingresa una clave..." />
			</div>


		</div>

		<div class="card-footer text-muted">
			<button type="button" onClick="var resp=MM_validateForm('nombre','','R','paterno','','R','materno','','R','email','','RisEmail','usuario','','R','clave','','R'); if(resp==1){ GuardarEspecial('alta_usuario','administrador/usuarios/ga_usuarios.php','administrador/usuarios/vi_usuarios.php','main');}" class="btn btn-success" style="float: right;">GUARDAR</button>
		</div>
	</div>
</form>

<script type="text/javascript">
	$(document).ready(function(e) {
		$('#usuario').val('');
		$('#clave').val('');
		$('#usuario').html('');
		$('#clave').html('');
	});
</script>