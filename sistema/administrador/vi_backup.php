<?php
header("Content-Type: text/text; charset=ISO-8859-1");
require_once("../clases/class.Sesion.php");
require_once("../clases/conexcion.php");

//creamos nuestra sesion.
$se = new Sesion();


if(!isset($_SESSION['se_SAS']))
{
	header("Location: ../login.php");
	exit;
}


$db= new MySQL();


if(isset($_GET['ac']))
{
	if($_GET['ac']==1)
	{
		$msj='<div id="mens" class="alert_success">'.$_GET['msj'].'</div>';
	}
	else
	{
		$msj='<div id="mens" class="alert_error">Error. Intentar mas Tarde '.$_GET['msj'].'</div>';
	}
	
	echo '<script type="text/javascript">OcultarDiv(\'mens\')</script>';
	
	echo $msj;
}

?>

<div class="card">
	<div class="card-body">
		<h5 class="card-title">LISTA DE RESPALDOS</h5>
		
		<div style="padding: 20px;">
			<button type="button" onClick="Backup('main','administrador/vi_backup.php');" class="btn btn-primary" style="float: right;">Generar Respaldo de la BD</button>
			<div style="clear: both;"></div>
		</div>
		
<?php
	   $dir = "../backup/";
	   $directorio=opendir($dir); 
?>
		
		<div class="table-responsive">
			<table id="zero_config" class="table table-striped table-bordered">
				<thead>
					<tr> 
						<th align="center"></th> 
						<th align="center">Archivo</th> 
						<th align="center">Acciones</th> 
					</tr> 
				</thead>
				<tbody>
<?php
           				while($archivo = readdir($directorio))
		   				{
			   				if($archivo <> "." && $archivo <> ".." && $archivo <> ".svn")
			   				{
?>
							<tr> 
   								<td align="center"><input type="checkbox" value="<?php echo $archivo; ?>" id="ck_bd" name="ck_bd[]"></td> 
    							<td align="center"><?php echo $archivo; ?></td> 
    							<td align="center" style="text-align:center">
   				    				<span style="text-align: center">
										<a href="backup/<?php echo $archivo; ?>" target="new">
											<i class="fas fa-pencil-alt"></i>
										</a>
									</span>    
								</td> 
							</tr> 
<?php
			   				}
		   				}
		   				closedir($directorio); 
?>  
				</tbody>
			</table>
			
			<div style="width: 100%;">
				<button type="button" onClick="E_SeleccionadoBD('main');" class="btn btn-primary alt_btn" style="float: right;">Eliminar</button>
			</div>
		</div>
	</div>
</div>