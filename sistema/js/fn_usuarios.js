



function validarUsuario ()

{

	var usuario = $('#usuario').val();

	

	console.log("entro a validarUsuario con el usuario = "+usuario);

	

	

	$.ajax({

			  type: 'POST',

			  url: 'administrador/usuarios/validar_usuario.php',

			  data: 'usuario='+usuario,

			  cache:false,

			  success:function(msj){

				  console.log("este es el msj de validarUsuario = "+msj);

				  

				  if(msj == 1)

				  {

					  

					  $('#msj_error').css('color','red');

					  $('#msj_error').html('Error este usuario ya existe');

					  document.getElementById('alt_btn').disabled = true ;

					  

				  }

				  else

				  {

					  $('#msj_error').css('color','green');

					  $('#msj_error').html('Usuario valido');

					  document.getElementById('alt_btn').disabled = false ;

				  }

				  

				  

			  },

			  error:function(XMLHttpRequest, textStatus, errorThrown){

				  console.log(arguments);

				  var error;

				  if (XMLHttpRequest.status === 404) error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 

				  if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 

				  $('#mensajes').html('<div class="alert_error"></div>');

				  $('.alert_error').hide(0).html('Ha ocurrido un error durante la ejecución'+error);

				  $('.alert_error').slideDown(timeSlide);

				  //OcultarDiv('mensajes');							  

			  }

		  });

	

	

}



