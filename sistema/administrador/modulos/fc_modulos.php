<?php
require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();


if(!isset($_SESSION['se_SAS']))
{
	header("Location: ../login.php");
	exit;
}

require_once("../../clases/conexcion.php");
require_once("../../clases/class.ModulosMenu.php");
require_once("../../clases/class.Funciones.php");


try
{
	$db= new MySQL();
	$mm= new ModulosMenu();
	$fu = new Funciones();
	
	$mm->db=$db;
	
	
	$idmodulo=$_GET['id'];
	
	$mm->idmodulo=$idmodulo;
	$datos=$mm->ObtenerInfoModulo();
?>
<form id="alta_modulos" method="post" action="">
	
	<div class="card mb-3">
		<div class="card-header">
			<h5 class="card-title" style="float: left; margin-top: 5px;">MODIFICAR M&Oacute;DULOS</h5>
			<button type="button" onClick="aparecermodulos('administrador/modulos/vi_modulos.php','main');" class="btn btn-info" style="float: right;">VER M&Oacute;DULOS</button>
			<div style="clear: both;"></div>
		</div>
	</div>
	
	<div class="card mb-3">
		<div class="card-header">
			<h5 class="card-title" style="float: left; margin-top: 5px;">DATOS GENERALES</h5>
		</div>
		
		<div class="card-body">
			<div class="form-group m-t-20">
				<label>NOMBRE DEL MÓDULO:</label>
				<input type="text" name="nombre" id="nombre" class="form-control" title="Nombre" placeholder="Nombre" value="<?php echo $datos['modulo'];?>" />
			</div>
			
			<div class="form-group m-t-20">
				<label>NIVEL EN EL ORDEN:</label>
				<input type="text" name="nivel" id="nivel" class="form-control" title="Nivel de Orden" placeholder="0" value="<?php echo $datos['nivel'];?>" />
			</div>
			
			<div class="form-group m-t-20">
				<label>ESTATUS:</label>
				<select id="estatus" name="estatus" class="form-control">
					<option value="1" <?php if($datos['estatus']==1){echo 'selected="selected"';}?> >ACTIVO</option>
					<option value="0" <?php if($datos['estatus']==0){echo 'selected="selected"';}?> >INACTIVO</option>
				</select>
			</div>
		</div>
		
		<div class="card-footer text-muted">
			<input type="hidden" name="tipo" id="tipo" value="2" />
    		<input type="hidden" name="idmodulo" id="idmodulo" value="<?php echo $idmodulo;?>" />
			<button type="button" onClick="var resp=MM_validateForm('nombre','','R'); if(resp==1){ GuardarEspecial('alta_modulos','administrador/modulos/ga_md_modulosMenu.php','administrador/modulos/vi_modulos.php','main');}" class="btn btn-success alt_btn" style="float: right;" <?php echo $disabled; ?>>GUARDAR</button>
	  	</div>
	</div>
</form>
<?php
}
catch(Exception $e)
{
	echo $e;
}
?>