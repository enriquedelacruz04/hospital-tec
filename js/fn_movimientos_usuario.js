// JavaScript Document

function b_movimientos(formulario,donde)
{
	
	//hacemos que se vea un loading
	
	
	$("#"+donde).html('<div style="padding: 5px; text-align:center;"><img src="images/loading.gif" alt="" /><br />Cargando...</div>');		
		
	var datos = ObtenerDatosFormulario(formulario);
	$.ajax({
		type:'POST',
		data: datos,
		url: 'reportes/bu_movimientos.php',
		cache:false,
					  error:function(XMLHttpRequest, textStatus, errorThrown){
						  console.log(arguments);
						  var error;
						  if (XMLHttpRequest.status === 404) error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
						  if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
						  $('#'+donde).html('<div class="alert_error">'+error+'</div>');						  
					  },
		success : function (msj){
			//console.log ('el msj es :'+msj) ;
			$('#'+donde).html(msj);   
			}
			
		}); 
	
	}
	//termina funcion buscar