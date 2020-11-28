<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
require('../metodos/conexion.php');
require('../metodos/sesionIniciada.php');
require('menu.php');
 ?>
 <!DOCTYPE html>
 <html>
 <head>
    <?php 
    include_once("../metodos/links.php");
    ?>
    <title>Las huertas || Vitaminas</title>
</head>
 <body>
	<div class="container">
		<form  method="POST">
			<div class="row">
				<div class="col-10 text-center mt-4">
					<h3>Registro de vitaminas por animal</h3>
				</div>
			</div>
			<div class="row my-4">
				<div class="col-3 text-right">
					<h5> Seleccione el animal:</h5>
				</div>
				<div class="col-6">
					<select id="sltIdAnimal" class="custom-select" >
						<?php 
						$categoria = $_SESSION['modulo'];
						$sql = mysqli_query($conexion,"SELECT IDANIMAL, NUMEROCHAPA,SEXO FROM ANIMAL WHERE ESTADODESCARTE <> 1 AND CATEGORIA = $categoria");

						while($ejecuta = mysqli_fetch_array($sql)){
							?> 
							<option value="<?php echo $ejecuta['IDANIMAL'] ?>">Chapa: <?php echo $ejecuta['NUMEROCHAPA'] ?> Sexo: <?php echo $ejecuta['SEXO'] ?></option> 
							<?php

						}            
						?>
					</select>
				</div>
			</div>
			<div class="row my-4">
				<div class="col-3 text-right">
					<h5>Seleccione la fecha:</h5>
				</div>
				<div class="col-6">
					<input type="date"  class="form-control" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}" id="txtFecha" >
				</div>
			</div>
			<div class="row my-4">
				<div class="col-3 text-right">
					<h5>Vitamina aplicada:</h5>
				</div>
				<div class="col-6">
					<select id="sltPurga" class="custom-select" >
						<?php 
						
						$sql = mysqli_query($conexion,"SELECT IDPRODUCTOS, NOMBRE FROM PRODUCTOS WHERE TIPO = 3");

						while($ejecuta = mysqli_fetch_array($sql)){
							?> 
							<option value="<?php echo $ejecuta['IDPRODUCTOS'] ?>"><?php echo $ejecuta['NOMBRE'] ?></option> 
							<?php
						}            
						?>
					</select>
				</div>
			</div>
			<div class="row my-4">
				<div class="col-3 text-right">
					<h5>Dosis aplicada:</h5>
				</div>
				<div class="col-6">
					<input type="text"  class="form-control"id="txtDosisAplicada" >
				</div>
			</div>
			<div class="row my-4">
				<div class="col-3 text-right">
					<h5>sintomas:</h5>
				</div>
				<div class="col-6">
					<textarea class="form-control" id="taSintomas" rows="5" maxlength="500"></textarea>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-10 text-center mt-4">
					<button id="btnAccion" class="btn btn-success btn-lg">Agregar</button>
				</div>
			</div>
		</form>           
	</div>



	<script>
		$(function(){
			$('#btnAccion').on('click',function(e){
				e.preventDefault();
				const accion = 'registraVitaminas';
				const idAnimal = $('#sltIdAnimal').val();
				const purga =  $('#sltPurga').val();
				const fecha = $('#txtFecha').val();
				const dosisAplicada = $('#txtDosisAplicada').val(); 
				const sintomas = $('#taSintomas').val();
				
				
				if(fecha==""){
					toastr.error("La FECHA no puede ser vacía", "Error!",{
						"progressBar":true,
						"closeButton":true,
						"timeOut":2000
					});
					
					return false;
				} 

				if(dosisAplicada==""){
					toastr.error("La DOSIS aplicada no puede ser vacía", "Error!",{
						"progressBar":true,
						"closeButton":true,
						"timeOut":2000
					});
					
					return false;
				} 
				if(sintomas==""){
					toastr.error("La descripción de SINTOMAS  no puede ser vacía", "Error!",{
						"progressBar":true,
						"closeButton":true,
						"timeOut":2000
					});
					
					return false;
				} 


				$.ajax({
					url: '../metodos/consultasJS.php',
					type: 'POST',
					data: {
						accion:accion,
						idAnimal:idAnimal,
						purga:purga,
						fecha:fecha,
						dosisAplicada:dosisAplicada,
						sintomas:sintomas,
					},

					success: function(respuesta){
						if (respuesta == 1) {

							toastr.success("Registro insertado con éxito", "Correcto!",{
								"progressBar":true,
								"closeButton":true,
								"timeOut":2000
							});

							window.setTimeout(function(){
								window.open("Animales.php","_self");
							}, 1000);


						}else{
							toastr.info("Revise los datos ingresados", "Alerta!",{
								"progressBar":true,
								"closeButton":true,
								"timeOut":2000
							});
						}
					}
				})
			})
		});	
	</script>



 </body>
 </html>