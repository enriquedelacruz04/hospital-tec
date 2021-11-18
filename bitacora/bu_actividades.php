<?php
require_once("../clases/class.Sesion.php");
$se = new Sesion();

require_once("../clases/conexcion.php");
require_once("../clases/class.Fechas.php");
require_once("../clases/class.MovimientoBitacora.php");
require_once("../clases/class.Clientes.php");


$db = new MySQL();
$fe = new Fechas();
$mb = new MovimientoBitacora();
$cl = new Clientes();

$mb->db = $db;
$cl->db = $db;

$tipo = $_SESSION['se_sas_Tipo'];

//enviamos datos a las variables de la tablas	
$idcliente = $_POST['nombre'];
$mb->fecha = $_POST['v_fecha'];

$actividades = $mb->lista_filtro();
$actividades_num = $db->num_rows($actividades);
$actividades_row = $db->fetch_assoc($actividades);

$t_tipo = array('MENSAJE GENERAL','MENSAJE DE SISTEMA','GUIAS','SOBRE PEDIDO');

?>
<script type="text/javascript" charset="utf-8">
	var oTable = $('#d_actividades').dataTable( {	
	   "ordering": false,
	   "lengthChange": true,
	   "pageLength": 100,	
	   "oLanguage": {
					"sLengthMenu": "Mostrar _MENU_ REGISTROS POR PÁGINA",
					"sZeroRecords": "Lo sentimos - Ningun registro encontrado",
					"sInfo": "",
					"sInfoEmpty": "desde 0 a 0 de 0 records",
					"sInfoFiltered": "(filtered desde _MAX_ total Registros)",
					"sSearch": "Buscar",
					"oPaginate": {
								 "sFirst":    "Inicio",
								 "sPrevious": "Anterior",
								 "sNext":     "Siguiente",
								 "sLast":     "ÚLTIMO"
								 }
					},
	   "sPaginationType": "full_numbers",
	   "sScrollX": "100%",
	   "sScrollXInner": "100%",
	   "bScrollCollapse": true,
	} );
</script>
       
<table  class="table table-bordered" cellspacing="0" id="d_actividades"> 
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
		<?php
		if($actividades_num != 0){
			do
			{
				$fecha = explode(" ",$actividades_row['fecha_movimiento']);
				
				$fecha_lat = $fe->f_esp($fecha[0])." ".$fecha[1];
		?>
			<tr> 
				<td>&nbsp;</td> 
				<td><?php echo utf8_encode($actividades_row['modulo']); ?></td>
				<td><?php echo nl2br(utf8_encode($actividades_row['descripcion'])); ?></td> 
				<td><?php echo $fecha_lat; ?></td>
				<!--<td align="center">
					<a href="#" onclick="imprimirPDF('ventas/pdf/reporteProduccion.php?id=<?php echo $result_campanas_row['idsobrepedido_camp']; ?>')" title="REPORTE DE PRODUCCI&Oacute;N"><i class="mdi mdi-printer"></i></a>
					<a href="#" onClick="aparecermodulos('ventas/fa_campanas.php?id=<?php echo $result_campanas_row['idsobrepedido_camp']?>','main');" title="EDITAR"><i class="fas fa-pencil-alt"></i></a>
					<a href="#" onClick="BorrarDatos('<?php echo $result_campanas_row['idsobrepedido_camp']?>','idsobrepedido_camp','sobrepedido_camp','n','ventas/vi_campanas.php','main')" title="ELIMINAR"><i class="fas fa-trash-alt"></i></a>
				</td> -->
			</tr>
		<?php	
			}while($actividades_row = $db->fetch_assoc($actividades));
		}
		?>
	</tbody> 
</table>