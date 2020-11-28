<?php
session_start();
require('../metodos/conexion.php');
?>

<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/toastr.min.css">

	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> 
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="../js/toastr.min.js"></script>
	<script type="text/javascript" src="../css/fontawesome/js/all.js"></script>

	<link rel="icon"  href="../icon/farmbarn_101085.png">


	<title>Las huertas || Cambio de contraseña</title>
</head>
<body>
	<div class="row ">
		<div class="col ">

			

			<form method="POST" action="Modulo.php">
				<div class="row ">
					<div class="col text-center mt-4 mb-5">
						<h3><b>Recuperar contraseña</b> </h3>
					</div>
				</div>
				<div class="row justify-content-md-center">
					<div class="col-md-3 mb-2">
						<label> Correo electrónico</label>
						<input type="email"  class="form-control" id="txtcorreo" name="txtcorreo">
					</div>
				</div>
				<div class="row justify-content-md-center">
					<div class="col-md-3 mb-2">
						<label> Teléfono</label>
						<input type="number" class="form-control" id="txtTelefono" name="txtTelefono">
					</div>
				</div>
				<div class="row justify-content-md-center">
					<div class="col-md-3 mb-5">
						<label> Cédula</label>
						<input type="number" class="form-control" id="txtCedula" name="txtCedula">
						<input type="hidden" name="txtidusuario" id="txtidusuario">	

					</div>

				</div>
				<div id="divoculta">
					<div class="row justify-content-md-center">
						<div class="col-md-3">
							<label> Nueva contraseña</label>
							<input type="password" class="form-control" id="txtNuevaCotrasenia" name="txtNuevaCotrasenia">	

						</div>
					</div>

					<div class="row justify-content-md-center">
						<div class="col-md-3 mb-5">
							<label> Confirmar contraseña</label>
							<input type="password" class="form-control" id="txtcNuevaContrasenias" name="txtcNuevaContrasenias">	
							<input type="hidden" class="form-control" id="txtnombre">	

						</div>
					</div>
				</div>

				<div class="row">
					<div class="col text-center">
						<button class="btn btn-info btn-lg" id="btnAccion" name="btnAccion">Cambiar contraseña </button>
						<a class="btn btn-outline-danger btn-lg" href="../pag/Login.php" >Regresar</a>
					</div> 
					
				</div>	
			</div>		
		</form>

	</div>

	<script>
		$(function(){
			$('#btnAccion').on('click',function(e){
				e.preventDefault();
				var correo = $('#txtcorreo').val();
				var telefono = $('#txtTelefono').val(); 
				var cedula = $('#txtCedula').val();
				var contrasenianueva = $('#txtNuevaCotrasenia').val();
				var confirmaNuevaContrasenias = $('#txtcNuevaContrasenias').val();
				if(correo==""){
					toastr.error("El CORREO ELECTRÓNICO no puede ser vacio", "Error!");
					return false;
				} 
				if(telefono==""){
					toastr.error("El TELÉFONO no puede ser vacio", "Error!");
					return false;
				}       
				if(cedula==""){
					toastr.error("La CÉDULA no puede ser vacio", "Error!");
					return false;
				} 
				$.ajax({
					url: 'validaDatosCambioClave.php',
					type: 'POST',
					data: {txtCorreo:correo,
						   txtTelefono:telefono,
						   txtCedula:cedula},
					success: function(respuesta){
						try{
							if(!respuesta){
								throw new Error();
							}
							const {idusuario, nombre} = JSON.parse(respuesta);
							$('#txtidusuario').val(idusuario);
							$('#txtnombre').val(nombre);
							if(contrasenianueva=="" || confirmaNuevaContrasenias == "" ){
								toastr.error("Debe escribir una nueva contraseña", "Error!");
								return false;
							} 
							if(contrasenianueva != confirmaNuevaContrasenias){
								toastr.error('las contraseñas deben coincidir', 'Error!',{
									"progressBar":true,
									"closeButton":true,
									"timeOut":3000
								});
								return false;
							}else{
								const idusuario = $('#txtidusuario').val();
								$.ajax({
								  url: 'cambioContrasenia.php',
								  type: 'POST',
								  data: ('txtContrasenia='+ contrasenianueva +'&txtIdUsuario='+ idusuario),
								  success: function(ok){
								  	toastr.success("La contraseña ha sido cambiada", "Correcto!");
								window.setTimeout(function(){
									window.open("../pag/Login.php","_self");
								}, 2500);

								  }
								});
							}
						}catch(e){
							toastr.info("Alguno de los datos registrados está incorrecto", "Información!"); 
						}
					}
				})
			})
		});	



	</script>
</body>
</html>