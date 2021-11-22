<?php
require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();


if (!isset($_SESSION['se_SAS'])) {
	header("Location: ../../login.php");
	exit;
}

require_once("../../clases/conexcion.php");
require_once("../../clases/class.Paginas.php");
require_once("../../clases/class.Funciones.php");

$db = new MySQL();
$pag = new Paginas();
$fu = new Funciones();




$query = "SELECT *,IF(estatus,'Activo','Inactivo')AS est FROM perfiles";
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
	var oTable = $('#zero_config').dataTable({

		"oLanguage": {
			"sLengthMenu": "Mostrar _MENU_ Registros por página",
			"sZeroRecords": "No Existen Perfiles en la base de datos",
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
</script>

<div class="card mb-3">
	<div class="card-header">
		<h5 class="card-title" style="float: left; margin-top: 5px;">LISTA DE PERFILES</h5>
		<button type="button" onClick="aparecermodulos('administrador/perfiles/fa_perfiles.php','main');" class="btn btn-info" style="float: right;">AGREGAR PERFIL</button>
		<div style="clear: both;"></div>
	</div>
</div>

<div class="card mb-3">
	<div class="card-body">
		<div class="table-responsive">
			<table id="zero_config" class="table table-bordered table-hover" cellpadding="0" cellspacing="0">
				<thead>
					<tr style="background: #eaeaea;">
						<th >ID PERFIL</th>
						<th >PERFIL</th>
						<th >ESTATUS</th>
						<th >ACCI&Oacute;N</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($total == 0) {
					} else {
						do {
					?>
							<tr>
								<td><?php echo $rows['idperfiles']; ?></td>
								<td><?php echo $fu->imprimir_cadena_utf8(strtoupper($rows['perfil'])); ?></td>
								<td align="center"><?php echo $fu->imprimir_cadena_utf8(strtoupper($rows['est'])); ?></td>
								<td style="text-align: center">
									<button type="button" onClick="aparecermodulos('administrador/perfiles/fc_perfiles.php?id=<?php echo $rows['idperfiles']; ?>','main');" title="EDITAR" class="btn btn-outline-info">
										<i class="fas fa-pencil-alt"></i>
									</button>
									<button type="button" onClick="BorrarDatos('<?php echo $rows['idperfiles']; ?>','idperfiles','perfiles','n','administrador/perfiles/vi_perfiles.php','main')" title="ELIMINAR" class="btn btn-outline-danger">
										<i class="fas fa-trash-alt"></i>
									</button>
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