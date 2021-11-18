<?php
   require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();


if(!isset($_SESSION['se_SAS']))
{
	header("Location: ../../login.php");
	exit;
}

   
   require_once("../../clases/conexcion.php");
   require_once("../../clases/class.Configuracion.php");
   require_once("../../clases/class.Funciones.php");

	
   $db = new MySQL();
   $conf = new Configuracion();
   $fu = new Funciones();
    
   $conf->db = $db;
   
   

 try{  

   echo "resultado".$row_configuracion = $conf->ObtenerInformacionConfiguracion();
  

   if($row_configuracion['cuantos'] == 0)
      {
		  $id = 0;
		  $iva = 50;
	  }else
	  {
		  $id =  $row_configuracion['idconfiguracion'];
		  $iva = $row_configuracion['iva'];
	   }
   

   if(isset($_GET['ac']))
{
	if($_GET['ac']==1)
	{
		$msj='<div id="mens" class="alert alert-success" role="alert">'.$_GET['msj'].'</div>';
	}
	else
	{
		$msj='<div id="mens" class="alert alert-danger" role="alert">Error. Intentar mas Tarde '.$_GET['msj'].'</div>';
	}
	
	echo '<script type="text/javascript">OcultarDiv(\'mens\')</script>';
	
	echo $msj;
}

?>
<meta name="viewport" content="width=device-width, initial-scale=1">



  
<form name="f_configuracion" id="f_configuracion">
	
	<div class="card mb-3">
		<div class="card-header">
			<h5 class="card-title" style="float: left; margin-top: 5px;">CONFIGURACI&Oacute;N DE TU EMPRESA</h5>
		</div>
		
		<div class="card-body" style="padding-left: 0; padding-right: 0;">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">DATOS GENERALES</span></a> </li>
				<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">DATOS FISCALES</span></a> </li>
				<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">CONFIGURACIÓN TIENDA</span></a> </li>
				<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#politicas" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">POLITICAS Y TERMINOS</span></a> </li>
				<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#nosotros" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">NOSOTROS</span></a> </li>
				<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#openpay" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">OPENPAY</span></a> </li>
			</ul>
			<!-- Tab panes -->
			
			
			<div class="tab-content tabcontent-border" style="padding-left: 15px; padding-right: 15px;">

				<div class="tab-pane active" id="home" role="tabpanel">
					<div class="form-group m-t-20">
						<div class="row">
						<div class="col-6">
						<label>NOMBRE EMPRESA</label>
						<input name="v_nombre_empresa" type="text" id="v_nombre_empresa" class="form-control" title="Nombre de Empresa" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['nombre_empresa']); ?>">
						</div>
						<div class="col-6">
							<div class="form-group ">
											<label>HORARIO:</label>
											<input type="text" class="form-control" id="v_horario" name="v_horario" value="<?php echo $fu->imprimir_cadena_utf8( $row_configuracion['horario']); ?>" title="HORARIO">
								</div>
										</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group m-t-20">
								<label>DIRECCION</label>
								<input name="v_direccion" type="text" id="v_direccion" title="Direccion" class="form-control" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['direccion'])?>">
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group m-t-20">
								<label>TELEFONO</label>
								<input name="v_telefono" type="text" id="v_telefono" class="form-control" title="Telefono" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['telefonos'])?>">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group m-t-20">
								<label>PÁGINA WEB</label>
								<input name="v_url" type="text" id="v_url" class="form-control" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['url'])?>">
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group m-t-20">
								<label>Email</label>
								<input name="v_email" type="text" id="v_email" class="form-control" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['email'])?>">
							</div>
						</div>
					</div>

					<div class="row">

						<div class="col-md-6">
							<div class="form-group m-t-20">
								<label>CONTRASEÑA CAJA</label>
								<input name="v_pass_caja" type="password" id="v_pass_caja" class="form-control" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['clave_caja']);?>">
							</div>	
						</div>

						<div class="col-md-6">
							<div class="form-group m-t-20">
								<label>EMAIL (ENVIO DE PEDIDOS)</label>
								<input name="v_email_pedido" type="text" id="v_email_pedido" class="form-control" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['email_pedido'])?>">
							</div>
						</div>
						
						
						
						<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3">
							<div class="form-group m-t-20">
											<label>FACEBOOK:</label>
											<input type="text" class="form-control" id="v_facebook" name="v_facebook" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['facebook']) ?>" title="FACEBOOK">
								</div>
										</div>
											
										
										<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3">
											<div class="form-group m-t-20">
											<label>INSTAGRAM:</label>
											<input type="text" class="form-control" id="v_instagram" name="v_instagram" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['instagram']) ?>" title="INSTAGRAM">
												</div>
										</div>
												
										
										<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3">
											<div class="form-group m-t-20">
											<label>TWITTER:</label>
											<input type="text" class="form-control" id="v_twiter" name="v_twiter" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['twitter']) ?>" title="TWITER">
												</div>
										</div>
										
										
										<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3">
											<div class="form-group m-t-20">
											<label>YOUTUBE:</label>
											<input type="text" class="form-control" id="v_youtube" name="v_youtube" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['youtube']) ?>" title="YOUTUBE">
												</div>
										</div>

					</div>

				</div>


				<div class="tab-pane  p-20" id="profile" role="tabpanel">
					<div class="form-group m-t-20">
						<label style="width:92%;">IVA</label>
						 <!--<div class="clear"></div>-->
						 <input name="v_iva" type="text" id="v_iva" class="form-control" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['iva'])?>" >
						 <!--<div id="slider-range-max" style="width:72%; float:left"></div>-->
					</div>

					<div class="form-group m-t-20">
						<label>RAZÓN SOCIAL</label>
						<input name="v_razonsocial" type="text" id="v_razonsocial" class="form-control" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['razon_social'])?>">
					</div>

					<div class="form-group m-t-20">
						<label>RFC</label>
						<input name="v_rfc" type="text" id="v_rfc" class="form-control" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['rfc'])?>">
					</div>

					<div class="form-group m-t-20">
						<label>DIRECCIÓN FISCAL</label>
						<textarea name="v_dfiscal" rows="2" class="form-control" id="v_dfiscal"><?php echo $fu->imprimir_cadena_utf8($row_configuracion['direccion_fiscal'])?></textarea>
					</div>

					<div class="row">

						<div class="col-md-6">
							<div class="form-group m-t-20">
								<label>NO. INTERIOR.</label>
								<input name="v_nint" type="text" id="v_nint" class="form-control"  value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['no_int_fiscal'])?>">
							</div>	
						</div>

						<div class="col-md-6">
							<div class="form-group m-t-20">
								<label>NO. EXTERIOR</label>
								<input name="v_next" type="text" id="v_next" class="form-control" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['no_ext_fiscal'])?>">
							</div>
						</div>


						<div class="col-md-6">
							<div class="form-group m-t-20">
								<label>CIUDAD</label>
								<input name="v_ciudad" type="text" id="v_ciudad" class="form-control" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['ciudad_fiscal'])?>">
							</div>	
						</div>

						<div class="col-md-6">
							<div class="form-group m-t-20">
								<label>ESTADO</label>
								<input name="v_estado" type="text" id="v_estado" class="form-control" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['estado_fiscal'])?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group m-t-20">
								<label>COLONIA</label>
								<input name="v_colonia" type="text" id="v_colonia" class="form-control" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['colonia_fiscal'])?>">
							</div>	
						</div>

						<div class="col-md-6">
							<div class="form-group m-t-20">
								<label>CP</label>
								<input name="v_cp" type="text" id="v_cp" class="form-control" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['cp_fiscal'])?>">
							</div>
						</div>

					</div>

				</div>

				<div class="tab-pane p-20" id="messages" role="tabpanel" align="center">

					
				<div class="row">
					<div class="col-md-12">
						<div class="form-group m-t-20">
						<label style="width:92%;">LOGO EMPRESA</label>
						<div id="d_logo" style="text-align:center">
	<?php
						if($row_configuracion['logo'] != "")
						{
							$imagen = "images/configuracion/".$row_configuracion['logo'];
						}else{
							$imagen = "images/logoempresa.png";
						}
	?>
							<img src="<?php echo $imagen; ?>" width="150" height="150" alt="" style="border: 1px #707070 solid"/> 
						</div>

						<p style="text-align:center;">&nbsp;&nbsp;Dimensiones de la imagen Ancho: 150px Alto: 150px</p>   
						<div class="spacer"></div>
						<input type="file" id="v_logo" name="v_logo[]" accept="image/png">
					</div>
						
						
						
					</div>
					
					<div class="col-md-12">
					<div class="card">
					  <div class="card-header">
						CONFIGURACION DE EMAIL NOTIFICADOR.
					  </div>
					  <div class="card-body">
						  <div class="row">
						       <div class="col-md-3 form-group">
									<label>CUENTA DE EMAIL:</label>
									 <input type="text" name="v_e_cuenta" id="v_e_cuenta" class="form-control" value="<?php echo $row_configuracion['e_cuenta']; ?>">
									  
							  </div>
							  
							   <div class="col-md-3 form-group">
									<label>CLAVE DE EMAIL:</label>
									 <input type="password" name="v_e_clave" id="v_e_clave" class="form-control" value="<?php echo $row_configuracion['e_clave']; ?>">
									  
							  </div>
							  
							  
							  <div class="col-md-3 form-group">
									<label>SERVIDOR ENTRANTE:</label>
									 <input type="text" name="v_e_pop" id="v_e_pop" class="form-control" value="<?php echo $row_configuracion['e_pop']; ?>">
									  
							  </div>
							  
							  <div class="col-md-3 form-group">
									<label>PUERTO ENTRANTE:</label>
									 <input type="text" name="v_e_pentrante" id="v_e_pentrante" class="form-control" value="<?php echo $row_configuracion['e_pentrante']; ?>">
									  
							  </div>
							  
							  
							  <div class="col-md-3 form-group">
									<label>SERVIDOR SALIENTE:</label>
									 <input type="text" name="v_e_smtp" id="v_e_smtp" class="form-control" value="<?php echo $row_configuracion['e_smtp']; ?>">
									  
							  </div>
							  
							  <div class="col-md-3 form-group">
									<label>PUERTO SALIENTE:</label>
									 <input type="text" name="v_e_psaliente" id="v_e_psaliente" class="form-control" value="<?php echo $row_configuracion['e_psaliente']; ?>">
									  
							  </div>
							  
							  
							  <div class="col-md-3">
									<label>REQUIERE AUTENTICACION</label>
									 <select name="v_e_autenticacion" id="v_e_autenticacion" class="form-control">
									   <option value="1" <?PHP if($row_configuracion['e_autentication'] == '1'){ echo "selected" ;}?>>SI</option>
									   <option value="0" <?PHP if($row_configuracion['e_autentication'] == '0'){ echo "selected" ;}?>>NO</option>
									 </select>
							  </div>
							  
							  
							  	<div class="col-md-3">
									<label>REQUIERE AUTENTICACION SSL</label>
									 <select name="v_e_ss" id="v_e_ss" class="form-control">
									   <option value="1" <?PHP if($row_configuracion['e_ss'] == '1'){ echo "selected" ;}?>>SI</option>
									   <option value="0" <?PHP if($row_configuracion['e_ss'] == '0'){ echo "selected" ;}?>>NO</option>
									 </select>
							  </div>
							  
							  
							  
							  
						  
						  </div>
						
						
					  </div>
					</div>
					</div>
					
					
					<input type="hidden" id="comision" name="comision" value="0">
					
					
					<div class="form-group col-md-6">
						<label>TIPO DE IMPRESORA</label>
						<select  name="tipo_impresion" id="tipo_impresion" class="form-control" >
							<option selected value="0" <?PHP if($row_configuracion['notas_print'] == 0){ echo "selected" ;}?> >TAMAÑO CARTA</option>
							<option value="1" <?PHP if($row_configuracion['notas_print'] == 1){ echo "selected" ;}?>>TERMICO 80MM</option>

						</select>
					</div>
					
					
					
					<div class="form-group col-md-6">
						<label>TIPO DESCUENTO</label>
						<select disabled name="v_tipo_descuento" id="v_tipo_descuento" class="form-control" >
							<option selected value="0" <?PHP if($row_configuracion['t_descuento'] == 0){ echo "selected" ;}?> >Por Producto</option>
							<option value="1" <?PHP if($row_configuracion['t_descuento'] == 1){ echo "selected" ;}?>>Por Paquete de Compra</option>
							<option value="2" <?PHP if($row_configuracion['t_descuento'] == 2){ echo "selected" ;}?>>Ambos</option>
						</select>
					</div>
					
					
					<div class="form-group col-md-6">
						<label>Cuentas Bancarias</label>
						<textarea name="v_cuentas" rows="4" class="form-control" id="v_cuentas"><?php echo $row_configuracion['cuentasbancarias']?></textarea>
					</div>

					<div class="form-group col-md-6">
						<label>Moneda</label>
						 <select name="v_moneda" id="v_moneda" class="form-control">
						   <option value="MNX" <?PHP if($row_configuracion['moneda'] == 'MNX'){ echo "selected" ;}?>>PESOS</option>
						   <option value="DLL" <?PHP if($row_configuracion['moneda'] == 'DLL'){ echo "selected" ;}?>>USD</option>
						 </select>
					</div>
					
					
					
				
				
				</div>  <!-- TERMINA MODULO DE ROW-->
					
					
				</div>

			<div class="tab-pane row" id="politicas" role="tabpanel">
					<div class="form-group m-t-20">
						<label>POLITICAS DE PRIVACIDAD</label>
						<textarea  name="v_politicas" id="v_politicas" class="form-control"  rows="12" title="Campo Politicas de envio" placeholder="Respuesta"><?php echo $fu->imprimir_cadena_utf8($row_configuracion['politicas']); ?></textarea>
						
					</div>
				
				
					<div class="form-group m-t-20">
						<label>TERMINOS Y CONDICIONES</label>
						<textarea  name="v_terminosycondiciones" id="v_terminosycondiciones" class="form-control"  rows="12" title="Campo Politicas de envio" placeholder="Respuesta"><?php echo $fu->imprimir_cadena_utf8($row_configuracion['terminosycondiciones']); ?></textarea>
						
					</div>
					
					

				</div>
			<div class="tab-pane" id="nosotros" role="tabpanel" align="center">
				

				
				
				
				<div class="row">
				
					<div class="form-group col-md-12">
						<label>IMAGEN NOSOTROS</label>
						<div id="d_logo" style="text-align:center">
	<?php
						if($row_configuracion['logonosotros'] != "")
						{
							$imagen = "images/configuracion/".$row_configuracion['logonosotros'];
						}else{
							$imagen = "images/sinfoto.png";
						}
	?>
							<img src="<?php echo $imagen; ?>" width="150" height="150" alt="" style="border: 1px #707070 solid"/> 
						</div>

						<p style="text-align:center;">&nbsp;&nbsp;Dimensiones de la imagen Ancho: 500px Alto: 600px</p>   
						<div class="spacer"></div>
						<input type="file" id="v_logo2" name="v_logo2[]" accept="image/jpeg">
					</div>
					
	
				
				</div>
					
				
					<div class="form-group m-t-20">
						<label>ACERCA DE NOSOTROS:</label>
						<textarea  name="v_nosotros" id="v_nosotros" class="form-control"  rows="12" title="Campo Acerca de Nosotros" placeholder="Nosotros"><?php echo $fu->imprimir_cadena_utf8($row_configuracion['nosotros']); ?></textarea>
						
					</div>
					
					<div class="form-group m-t-20">
						<label>DESCRIPCION BREVE:</label>
						<textarea  name="v_descripcion" id="v_descripcion" class="form-control"  rows="5" title="Campo Descripcion breve" placeholder="Descripcion"><?php echo $fu->imprimir_cadena_utf8($row_configuracion['descripcion']); ?></textarea>
						
					</div>

				</div>
				
				<div class="tab-pane" id="openpay" role="tabpanel" align="center">
					
					<div class="row">
					<div  class="col-12 ">
					<div style="float:left" class="col-4 form-group m-t-20">
						
					<label>Activo</label>
					<label class="switch">
					  <input type="checkbox" value="1" id="ativeopenpay" name="ativeopenpay" <?php if($row_configuracion['ativeopenpay']==1){echo("checked");} ?>>
					  <span class="slider"></span>
					</label>
					</div>
						</div>
				<br>
									
				
					<div class="col-4 form-group m-t-20">
						<label>Id de Negocio:</label>
						<input name="idnegocio" type="text" id="idnegocio" class="form-control" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['idnegocio'])?>">
						
					</div>
					
					<div class="col-4 form-group m-t-20">
						<label>Key Private:</label>
						<input name="key_private" type="text" id="key_private" class="form-control" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['key_private'])?>">
						
					</div>
					
					<div class="col-4 form-group m-t-20">
						<label>Key Public:</label>
						<input name="key_public" type="text" id="key_public" class="form-control" value="<?php echo $fu->imprimir_cadena_utf8($row_configuracion['key_public'])?>">
						
					</div>
					</div>

				</div>
			</div>
			
		</div>
		
		<div class="card-footer text-muted">
			<input name="v_id" type="hidden" value="<?php echo $id; ?>" id="v_id">
			<button type="button" onClick="var resp=MM_validateForm('v_nombre_empresa','','R','v_direccion','','R','v_telefono','','R','v_email','','R','v_iva','','isNum','v_email','','isEmail'); if(resp==1){ g_Configuracion();}" class="btn btn-success alt_btn" style="float: right;" <?php echo $disabled; ?>>GUARDAR</button>
	  	</div>
	</div>
</form>
    
<?php
 }//fin del try
 catch(Exception $e)
 {
	 $v = explode ('|',$e);
		// echo $v[1];
	     $n = explode ("'",$v[1]);
		 $n[0];
	$result = $db->m_error($n[0]);
	echo $result ;
	 
	 
 }

?>
