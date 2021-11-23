<?php
require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();


if (!isset($_SESSION['se_SAS'])) {
	header("Location: ../../login.php");
	exit;
}

require_once("../../clases/conexcion.php");
//require_once("../../clases/class.Paginas.php");
require_once("../../clases/class.ModulosMenu.php");
require_once("../../clases/class.Funciones.php");

$db = new MySQL();
//$pag= new Paginas();

$mm = new ModulosMenu();
$fu = new Funciones();

$mm->db = $db;



$query = "SELECT *,IF(estatus,'Activo','Inactivo')AS est FROM modulos ORDER BY nivel";
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




<div class="card mb-3">
	<div class="card-header">
		<h5 class="card-title" style="float: left; margin-top: 5px;">LISTA DE M&Oacute;DULOS</h5>
		<button type="button" onClick="aparecermodulos('administrador/modulos/fa_modulos.php','main');" class="btn btn-info" style="float: right;">AGREGAR M&Oacute;DULO</button>
		<div style="clear: both;"></div>
	</div>
</div>
<div class="card mb-3">

	<div class="card-body">
		<div class="table-responsive">
			<table id="zero_config" class="table table-bordered table-hover" cellpadding="0" cellspacing="0">
				<thead>
					<tr style="background: #eaeaea;">
						<th>ID M&Oacute;DULO</th>
						<th>MODULOS</th>
						<th>NIVEL</th>
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
								<td align="center"><?php echo $rows['idmodulos']; ?></td>
								<td align="center"><?php echo $fu->imprimir_cadena_utf8(strtoupper($rows['modulo'])); ?></td>
								<td align="center"><?php echo $rows['nivel']; ?></td>
								<td align="center"><?php echo $fu->imprimir_cadena_utf8(strtoupper($rows['est'])); ?></td>
								<td align="center">
									<button type="button" onClick="aparecermodulos('administrador/modulos/fc_modulos.php?id=<?php echo $rows['idmodulos']; ?>','main');" title="EDITAR" class="btn btn-outline-info">
										<i class="fas fa-pencil-alt"></i>
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

<br>

<?php

//sacando los menus del sistema
$queryMenu = "SELECT *,IF(estatus,'Activo','Inactivo')AS est FROM  modulos_menu ORDER BY nivel";
$respmenu = $db->consulta($queryMenu);
$rowsmenu = $db->fetch_assoc($respmenu);
$totalmenu = $db->num_rows($respmenu);


?>


<div class="card mb-3">
	<div class="card-header">
		<h5 class="card-title" style="float: left; margin-top: 5px;">LISTA DE MENUS</h5>
		<button type="button" onClick="aparecermodulos('administrador/modulos/fa_menu.php','main');" class="btn btn-info" style="float: right;">AGREGAR MENU</button>
		<div style="clear: both;"></div>
	</div>
</div>
<div class="card mb-3">
	<div class="card-body">
		<div class="table-responsive">
			<table id="submenus" class="table table-bordered table-hover" cellpadding="0" cellspacing="0">
				<thead>
					<tr style="background: #eaeaea;">
						<th>ID MENU</th>
						<th>MODULO</th>
						<th>MENU</th>
						<th>ARCHIVO</th>
						<th>UBICACI&Oacute;N</th>
						<th>NIVEL</th>
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
								<td align="center"><?php echo $rowsmenu['idmodulos_menu']; ?></td>
								<td align="center">
									<?php $mm->idmodulo = $rowsmenu['idmodulos'];
									$datos = $mm->ObtenerInfoModulo();
									echo $fu->imprimir_cadena_utf8($datos['modulo']); ?></td>
								<td align="center"><?php echo $fu->imprimir_cadena_utf8(strtoupper($rowsmenu['menu'])); ?></td>
								<td><?php echo $rowsmenu['archivo']; ?></td>
								<td><?php echo $rowsmenu['ubicacion_archivo']; ?></td>
								<td align="center"><?php echo $rowsmenu['nivel']; ?></td>
								<td align="center"><?php echo $fu->imprimir_cadena_utf8(strtoupper($rowsmenu['est'])); ?></td>
								<td>
									<button type="button" onClick="aparecermodulos('administrador/modulos/fc_menu.php?id=<?php echo $rowsmenu['idmodulos_menu']; ?>','main');" title="EDITAR" class="btn btn-outline-info">
										<i class="fas fa-pencil-alt"></i>
									</button>
								</td>
							</tr>
					<?php
						} while ($rowsmenu = $db->fetch_assoc($respmenu));
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>