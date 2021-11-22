// JavaScript Document

function buscarActividadesBitacora(formulario)
{
	console.log('entro');
	var cadena = ObtenerDatosFormulario(formulario);
	
	$("#li_actividades").html('<div align="center" class="mostrar"><img src="images/loading.gif" alt="" /><br />Cargando...</div>');	
	
	$.ajax({
			  type: 'POST',
			  url: 'bitacora/bu_actividades.php',
			  data: cadena,
			  cache:false,
			  success:function(msj){
				  $('#li_actividades').html(msj);
			  },
			  error:function(XMLHttpRequest, textStatus, errorThrown){
				  console.log(arguments);
				  var error;
				  if (XMLHttpRequest.status === 404) error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
				  if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
				  $("#li_actividades").html('<div class="alert_error"></div>');
				  $('.alert_error').hide(0).html('Ha ocurrido un error durante la ejecución'+error);
				  $('.alert_error').slideDown(timeSlide);
			  }
		  });
}