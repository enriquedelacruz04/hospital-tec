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
	$db = new MySQL();
	$mm = new ModulosMenu();
	$fu = new Funciones();
	
	$mm->db=$db;
	
	$idmenu=$_GET['id'];
	$mm->idmenu=$idmenu;	
	$datos=$mm->ObtenerInfoMenu();
	
	$query="SELECT * FROM modulos WHERE estatus=1";
	$resp=$db->consulta($query);
	$row=$db->fetch_assoc($resp);
	$total=$db->num_rows($resp);
	
	$disabled='';
?>

<form id="alta_modulos" method="post" action="">
	
	<div class="card mb-3">
		<div class="card-header">
			<h5 class="card-title" style="float: left; margin-top: 5px;">ALTA DE MENU</h5>
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
<?php
        	if($total==0)
			{
				$disabled='disabled="disabled"';
?>
        		<label>NO EXISTEN MODULOS DISPONIBLES, POR LO QUE NO ES POSIBLE CREAR MENUS</label>
<?php
			}else{
?>
        		<label>Modulo</label>
				<select name="idmodulos" id="idmodulos" class="form-control">
					<?php do{?>
					<option value="<?php echo $row['idmodulos'];?>" <?php if($datos['idmodulos']==$row['idmodulos']){echo 'selected="selected"';}?> ><?php echo $fu->imprimir_cadena_utf8(strtoupper($row['modulo']));?></option>   
					<?php }while($row=$db->fetch_assoc($resp));?>         
				</select>
<?php
			}
?>
			</div>
			

			<div class="form-group m-t-20">
				<label>NOMBRE DEL MENU:</label>
				<input type="text" name="nombre" id="nombre" class="form-control" title="Nombre" placeholder="Nombre" value="<?php echo $datos['menu'];?>" />
			</div>
			
			<div class="form-group m-t-20">
				<label>NOMBRE DEL ARCHIVO:</label>
				<input type="text" name="archivo" id="archivo" class="form-control" title="Archivo" placeholder="Archivo" value="<?php echo $datos['archivo'];?>" />
			</div>
			
			<div class="form-group m-t-20">
				<label>UBICACION DEL ARCHIVO:</label>
				<input type="text" name="ubi" id="ubi" class="form-control" title="Ubicaci&oacute;n del Archivo" placeholder="Ubicaci&oacute;n de Archivo" value="<?php echo $datos['ubicacion_archivo'];?>" />
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
			<input type="hidden" name="tipo" id="tipo" value="4" />
    		<input type="hidden" name="idmodulos_menu" id="idmodulos_menu" value="<?php echo $idmenu;?>" />
			<button type="button" onClick="var resp=MM_validateForm('nombre','','R','archivo','','R','ubi','','R'); if(resp==1){ GuardarEspecial('alta_modulos','administrador/modulos/ga_md_modulosMenu.php','administrador/modulos/vi_modulos.php','main');}" class="btn btn-success alt_btn" style="float: right;" <?php echo $disabled; ?>>GUARDAR</button>
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