<?php
require_once("../../clases/class.Sesion.php");

//creamos nuestra sesion.
$se = new Sesion();


if (!isset($_SESSION['se_SAS'])) {
	header("Location: ../../login.php");
	exit;
}

require_once("../../clases/conexcion.php");
require_once("../../clases/class.Usuarios.php");
// require_once("../../clases/class.Sucursales.php");
require_once("../../clases/class.Funciones.php");


$db = new MySQL();
$us = new Usuarios();
$us->db = $db;
// $su = new Sucursales();
$fu = new Funciones();

// $su->db = $db;	


$queryPerfil = "SELECT idperfiles, perfil FROM perfiles WHERE estatus=1";
$resp = $db->consulta($queryPerfil);
$rows = $db->fetch_assoc($resp);
$total = $db->num_rows($resp);

$us->id_usuario = $_GET['id'];
$datos = $us->ObtenerDatosUsuario();
// die("entro");

// $result_sucursales = $su->todasSucursales();
// $result_sucursales_row = $db->fetch_assoc($result_sucursales);

?>

<form id="modi_usuario" method="post" action="">

	<div class="card mb-3">
		<div class="card-header">
			<h5 class="card-title" style="float: left; margin-top: 5px;">MODIFICAR USUARIOS</h5>
			<button type="button" onClick="aparecermodulos('administrador/usuarios/vi_usuarios.php','main');" class="btn btn-info" style="float: right;">VER USUARIO</button>
			<div style="clear: both;"></div>
		</div>
	</div>
	<div class="card mb-3">
		<div class="card-header card-header--black">
			<h5 class="card-title" style="float: left; margin-top: 5px;">DATOS GENERALES</h5>
		</div>
		<div class="card-body">
			<div class="form-group">
				<label>PERFIL:</label>
				<select id="idperfiles" name="idperfiles" class="form-control">
					<?php do { ?>
						<option value="<?php echo $rows['idperfiles']; ?>" <?php if ($datos['idperfiles'] == $rows['idperfiles']) {
																				echo 'selected="selected"';
																			} ?>><?php echo $fu->imprimir_cadena_utf8($rows['perfil']); ?></option>
					<?php } while ($rows = $db->fetch_assoc($resp)); ?>
				</select>
			</div>

			<div class="form-group m-t-20">
				<label>NOMBRE :</label>
				<input type="text" name="nombre" id="nombre" class="form-control" title="Nombre" placeholder="Nombre" value="<?php echo $fu->imprimir_cadena_utf8($datos['nombre']); ?>" />
			</div>

			<div class="form-group m-t-20">
				<label>APELLIDO PATERNO:</label>
				<input type="text" name="paterno" id="paterno" class="form-control" title="Apellido Paterno" placeholder="Apellido Paterno" value="<?php echo $fu->imprimir_cadena_utf8($datos['paterno']); ?>" />
			</div>

			<div class="form-group m-t-20">
				<label>APELLIDO MATERNO:</label>
				<input type="text" name="materno" id="materno" class="form-control" title="Apellido Materno" placeholder="Apellido Materno" value="<?php echo $fu->imprimir_cadena_utf8($datos['materno']); ?>" />
			</div>

			<div class="form-group m-t-20">
				<label>CELULAR:</label>
				<input type="text" name="celular" id="celular" class="form-control" title="Celular" placeholder="Celular" value="<?php echo $fu->imprimir_cadena_utf8($datos['celular']); ?>" />
			</div>

			<div class="form-group m-t-20">
				<label>TELÉFONO:</label>
				<input type="text" name="telefono" id="telefono" class="form-control" title="Tel&eacute;fono" placeholder="Tel&eacute;fono" value="<?php echo $fu->imprimir_cadena_utf8($datos['telefono']); ?>" />
			</div>

			<div class="form-group m-t-20">
				<label>EMAIL:</label>
				<input type="text" name="email" id="email" class="form-control" title="Email" placeholder="Email" value="<?php echo $fu->imprimir_cadena_utf8($datos['email']); ?>" />
			</div>
		</div>
	</div>

	<div class="card mb-3">
		<div class="card-header card-header--black">
			<h5 class="card-title" style="float: left; margin-top: 5px;">DATOS DE ACCESO</h5>
		</div>
		<div class="card-body">
			<div class="form-group ">
				<label>USUARIO:</label>
				<input type="text" name="usuario" id="usuario" class="form-control" title="Usuario" placeholder="Usuario" value="<?php echo $fu->imprimir_cadena_utf8($datos['usuario']); ?>" readonly />
				<span style="float:left; font-size: 10px;" id="msj_error">&nbsp;</span>
				<div id="mensajes" class="width_3_quarter"></div>
				<input type="hidden" name="user_valid" id="user_valid" value="no" title="Usuario Válido" />
				<input type="hidden" id="tipo" name="tipo" value="<?php echo $datos['tipo']; ?>" />
			</div>

			<div class="form-group m-t-20">
				<label>CLAVE:</label>
				<input type="password" name="clave" id="clave" class="form-control" title="Clave" placeholder="Clave" value="<?php echo $fu->imprimir_cadena_utf8($datos['clave']); ?>" />
			</div>




			<div class="form-group m-t-20">
				<label>ESTATUS:</label>
				<select id="estatus" name="estatus" class="form-control">
					<option value="1" <?php if ($datos['estatus'] == 1) {
											echo 'selected="selected"';
										} ?>>ACTIVO</option>
					<option value="0" <?php if ($datos['estatus'] == 0) {
											echo 'selected="selected"';
										} ?>>CANCELADO</option>
				</select>
			</div>
		</div>

		<div class="card-footer text-muted">
			<input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_GET['id']; ?>" />
			<button type="button" onClick="var resp=MM_validateForm('nombre','','R','paterno','','R','materno','','R','email','','RisEmail','usuario','','R','clave','','R'); if(resp==1){GuardarEspecial('modi_usuario','administrador/usuarios/md_usuarios.php','administrador/usuarios/vi_usuarios.php','main')}" class="btn btn-success" style="float: right;">GUARDAR</button>
		</div>
	</div>
</form>