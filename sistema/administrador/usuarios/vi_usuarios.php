<?php
require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();


if (!isset($_SESSION['se_SAS'])) {
	header("Location: ../login.php");
	exit;
}

require_once("../../clases/conexcion.php");
require_once("../../clases/class.Paginas.php");
require_once("../../clases/class.Funciones.php");


$db = new MySQL();
$pag = new Paginas();
$fu = new funciones();



$su->db = $db;


$query = "SELECT usuarios.idusuarios, 
		usuarios.idperfiles, 
		usuarios.nombre, 
		usuarios.paterno, 
		usuarios.materno, 
		usuarios.telefono, 
		usuarios.celular, 
		usuarios.email, 
		usuarios.usuario, 
		usuarios.clave, 
		usuarios.estatus,
		usuarios.tipo,
		IF(usuarios.estatus,'Activo','Inactivo')AS est,
		perfiles.perfil
	FROM perfiles INNER JOIN usuarios ON perfiles.idperfiles = usuarios.idperfiles ";


$resp = $db->consulta($query);
$rows = $db->fetch_assoc($resp);
$total = $db->num_rows($resp);

if (isset($_GET['ac'])) {
	if ($_GET['ac'] == 1) {
		$msj = '<div id="mens" class="alert alert-success" role="alert">' . $_GET['msj'] . '</div>';
	} else {
		$msj = '<div id="mens" class="alert alert-danger" role="alert">Error. Intentar mas Tarde ' . $_GET['msj'] . '</div>';
	}

	echo '<script type="text/javascript">OcultarDiv(\'mens\')</script>';

	echo $msj;
}


?>

<script type="text/javascript" charset="utf-8">
	//$(document).ready(function() {

	var oTable = $('#zero_config').dataTable({

		"oLanguage": {
			"sLengthMenu": "Mostrar _MENU_ REGISTROS POR PÁGINA",
			"sZeroRecords": "No Existen Usuarios en la base de datos",
			"sInfo": "",
			"sInfoEmpty": "desde 0 a 0 de 0 records",
			"sInfoFiltered": "(filtered desde _MAX_ total Registros)",
			"sSearch": "",
			"oPaginate": {
				"sFirst": "Inicio",
				"sPrevious": "Anterior",
				"sNext": "Siguiente",
				"sLast": "ÚLTIMO"
			}
		},
		"sPaginationType": "full_numbers",
		"sScrollX": "100%",
		"sScrollXInner": "100%",
		"bScrollCollapse": true



	});
	//} );
</script>

<div class="card mb-3">
	<div class="card-header ">
		<h5 class="card-title" style="float: left; margin-top: 5px;">LISTA DE USUARIOS</h5>
		<button type="button" onClick="aparecermodulos('administrador/usuarios/fa_usuarios.php','main');" class="btn btn-info" style="float: right;">AGREGAR USUARIO</button>
		<div style="clear: both;"></div>
	</div>
</div>
<div class="card mb-3">
	<div class="card-body">
		<div class="table-responsive">
			<table id="zero_config" class="table table-bordered table-hover" cellpadding="0" cellspacing="0">
				<thead>
					<tr style="background: #eaeaea;">
						<th>PERFIL</th>
						<th>USUARIO</th>
						<th>NOMBRE</th>
						<th>CELULAR</th>
						<th>TEL&Eacute;FONO</th>
						<th>EMAIL</th>

						<th>ESTATUS</th>
						<th>ACCI&Oacute;N</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($total == 0) {
					} else {
						do {
					?>
							<tr>
								<td align="center"><?php echo $fu->imprimir_cadena_utf8(strtoupper($rows['perfil'])); ?></td>
								<td align="center"><?php echo $rows['usuario']; ?></td>
								<td align="center"><?php echo $fu->imprimir_cadena_utf8($rows['nombre'] . " " . $rows['paterno'] . " " . $rows['materno']); ?></td>
								<td align="center"><?php echo strtoupper($rows['celular']); ?></td>
								<td align="center"><?php echo strtoupper($rows['telefono']); ?></td>
								<td align="center"><?php echo strtoupper($rows['email']); ?></td>
								<?php
								$tipo = $rows['tipo'];
								if ($tipo == 0) {
									$usuario = "Superusuario";
								} else {
									$usuario = "Usuario";
								}


								?>

								<td align="center"><?php echo strtoupper($rows['est']); ?></td>
								<td align="center">

									<button type="button" onClick="aparecermodulos('administrador/usuarios/fc_usuarios.php?id=<?php echo $rows['idusuarios']; ?>','main')" title="EDITAR" class="btn btn-outline-info"><i class="fas fa-pencil-alt"></i></button>
									<?php
									if ($tipo == 0) {
									?>
										<!--<input type="image" src="images/icn_trash.png" title="ELIMINAR" onclick="return false">-->
									<?php
									} else {
									?>
										<button type="button" onClick="BorrarDatos('<?php echo $rows['idusuarios']; ?>','idusuarios','usuarios','n','administrador/usuarios/vi_usuarios.php','main')" title="ELIMINAR" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></i></button>
									<?php
									}
									?>
								</td>
							</tr>
					<?php
						} while ($rows = $db->fetch_assoc($resp));
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>