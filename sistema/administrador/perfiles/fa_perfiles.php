<?php
require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();


if (!isset($_SESSION['se_SAS'])) {
	header("Location: ../../login.php");
	exit;
}

require_once("../../clases/conexcion.php");
require_once("../../clases/class.Funciones.php");

try {
	$db = new MySQL();
	$fu = new Funciones();

	$query = "SELECT * FROM modulos WHERE estatus=1";
	$resp = $db->consulta($query);
	$rows = $db->fetch_assoc($resp);
	$total = $db->num_rows($resp);

	$disabled = '';
?>

	<form id="alta_perfil" method="post" action="">
		<div class="card mb-3">
			<div class="card-header ">
				<h5 class="card-title" style="float: left; margin-top: 5px;">ALTA DE PERFILES</h5>
				<button type="button" onClick="aparecermodulos('administrador/perfiles/vi_perfiles.php','main');" class="btn btn-info" style="float: right;">VER PERFILES</button>
				<div style="clear: both;"></div>
			</div>
		</div>

		<div class="card mb-3">
			<div class="card-header card-header--black">
				<h5 class="card-title" style="float: left; margin-top: 5px;">DATOS GENERALES</h5>
			</div>

			<div class="card-body">
				<div class="form-group m-t-10">
					<label>NOMBRE DEL PERFIL:</label>
					<input type="text" name="nombre" id="nombre" class="form-control" title="Nombre" placeholder="Ingresa un nombre para este perfil..." />
				</div>

				<div class="form-group m-t-10">
					<label>ESTATUS :</label>
					<select id="estatus" name="estatus" class="form-control">
						<option value="1">ACTIVO</option>
						<option value="0">INACTIVO</option>
					</select>
				</div>
			</div>
		</div>

		<div class="card mb-3">
			<div class="card-header card-header--black ">
				<h5 class="card-title" style="float: left; margin-top: 5px;">MENÚ</h5>
			</div>

			<div class="card-body">
				<input type="hidden" name="tipo" id="tipo" value="1" />
				<label class="width_full th_texto-rojo"><span id="requerido"></span> ➧ SELECCIONA LOS MENÚS A LOS CUALES TENDRÁ ACCESOS ESTE PERFIL</label>
				<div class="row d-flex justify-content-around">
					<?php
					if ($total == 0) {
						$disabled = 'disabled="disabled"';
					?>
						<div class="col-md-12">
							NO EXISTEN MODULOS DISPONIBLES PARA CREAR PERFILES
						</div>

						<?php
					} else {
						$contador_menus = 0;
						do {
						?>
							<div class="card mb-3 col-md-3" style="border: solid 1px #eaeaea; padding: 0;">
								<div class="card-header card-header--black">
									<?php
									//echo htmlentities($rows['modulo'], ENT_QUOTES | ENT_IGNORE, "ISO-8859-1");
									echo $fu->imprimir_cadena_utf8(strtoupper($rows['modulo']));
									?>

								</div>
								<div class="card-body text-info">
									<?php
									$querym = "SELECT * FROM modulos_menu WHERE estatus=1 AND idmodulos=" . $rows['idmodulos'];
									$respm = $db->consulta($querym);
									$rowsm = $db->fetch_assoc($respm);
									$totalm = $db->num_rows($respm);

									if ($totalm == 0) {
										echo 'No existen menus disponibles ';
									} else {
										do {
											$contador_menus = $contador_menus + 1;
									?>
											<div class="check_custom">
												<input type="checkbox" name="menu<?php echo $contador_menus; ?>" id="menu<?php echo $contador_menus; ?>" value="<?php echo $rowsm['idmodulos_menu']; ?>" />
												<?php
												echo $fu->imprimir_cadena_utf8(strtoupper($rowsm['menu']));

												?>
											</div>
										
									<?php
										} while ($rowsm = $db->fetch_assoc($respm));
									}
									?>
								</div>
							</div>
					<?php
						} while ($rows = $db->fetch_assoc($resp));
					}
					?>
				</div>
			</div>


			<div class="card-footer text-muted">
				<input type="hidden" name="cantidad_menu" id="cantidad_menu" value="<?php echo $contador_menus; ?>" />
				<button type="button" onClick="var resp=MM_validateForm('nombre','','R'); if(resp==1){ if(Validar_Check()==1)
            { GuardarEspecial('alta_perfil','administrador/perfiles/ga_md_perfiles.php','administrador/perfiles/vi_perfiles.php','main');}}" class="btn btn-success alt_btn " style="float: right;" <?php echo $disabled; ?>>GUARDAR</button>
			</div>
		</div>
	</form>
<?php
} catch (Exception $e) {
	echo $e;
}
?>