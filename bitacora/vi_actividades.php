<?php
require_once("../clases/class.Sesion.php");

$se = new Sesion();

if(!isset($_SESSION['se_SAS']))
{
	header("Location: ../login.php");
	exit;
}


header("Content-Type: text/text; charset=ISO-8859-1");

require_once("../clases/conexcion.php");	 
require_once("../clases/class.MovimientoBitacora.php");
require_once("../clases/class.Clientes.php");

$db = new MySQL();
$mb = new MovimientoBitacora();
$cl = new Clientes();

$mb->db = $db;
$cl->db = $db;

$tipo = $_SESSION['se_sas_Tipo'];

if(isset($_GET['ac']))
{
	if($_GET['ac']==1){
		$msj='<div id="mens" class="alert alert-success">'.$_GET['msj'].'</div>';
	}else{
		$msj='<div id="mens" class="alert alert-danger">Error. Intentar mas Tarde '.$_GET['msj'].'</div>';
	}
	echo '<script type="text/javascript">OcultarDiv(\'mens\')</script>';
	echo $msj;
}
?>
 
<div class="card">
	<div class="card-body">
		
		<div id="mensajes"></div>
		
		<h4 class="card-title" style="float: left;">BITACORA DE ACTIVIDADES</h4>
		
		<!--<button type="button" onClick="aparecermodulos('mensajes/fa_mensajes.php','main');" class="btn btn-primary" style="float: right;">Agregar Mensaje</button>-->
		<div style="clear: both;"></div>
	</div>
</div>

<form action="" name="filtro" id="filtro">
	<div class="card">
		<div class="card-body">
			<div class="row">

					<div class="col-md-3">
						<div class="form-group">
							<label>Nombre:</label>
							<div class="input-group">
								<input class="form-control" type="text" id="n_nombre" name="n_nombre">
								<div class="input-group-append" onClick="L_Clientes_venta_cliente();">
									<span class="input-group-text"><i class="mdi mdi-account-search"></i></span>
								</div>
								<input type="hidden" id="nombre" name="nombre" />
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label>Fecha:</label>
							<input class="form-control" type="text" id="v_fecha" name="v_fecha" >
						</div>
					</div>

					<div class="col-md-3">
						<br>
						<input type="button" value="Buscar" class="btn btn-primary" onClick="buscarActividadesBitacora('filtro');" style="margin-top: 5px;" >
					</div>

			</div>
		</div>
	</div>
</form>

<div class="card">
	<div class="card-body">
		<div id="li_actividades" class="tab_container">
			<table  class="table table-bordered" cellspacing="0" id="d_modulos"> 
				<thead> 
					<tr> 
						<th align="center">CLIENTE</th> 
						<th align="cealign=">M&Oacute;DULO</th>
						<th align="center">ACTIVIDAD</th>
						<th align="center">FECHA</th>
						<!--<th align="center">ACCI&Oacute;N</th>-->
					</tr> 
				</thead>

				<tbody> 
					<tr>
						<td align="center" colspan="4">&nbsp;</td>
					</tr>
				</tbody> 
			</table>
		</div>
	</div>
</div>      


<script>
jQuery('#v_fecha').datepicker({
	format: 'yyyy-mm-dd',
	autoclose: true,
	todayHighlight: true,
	orientation: "bottom"
});
</script>