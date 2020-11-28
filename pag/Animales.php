<?php 
date_default_timezone_set('America/Bogota');

session_start();
require_once('../metodos/sesionIniciada.php');
require('../metodos/conexion.php');
require_once('menu.php');

$ocultaBotones = "";
if ($_SESSION['modulo']!= 1) {
	$ocultaBotones = "d-none";
	
}
?>
<!DOCTYPE html>
<head>
	<?php 
	include_once("../metodos/links.php");
	?>	
	<title>Las huertas || Animal</title>

</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col text-center mt-4">
				<h3><b>Registro total de animales por especie</b></h3>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3">
				<div class="btn-group">
					<button class="btn btn-success mb-4 mt-3" data-toggle="modal" data-target="#insertaAnimal"><i class="fa fa-plus"></i> Nuevo registro</button>
					<button class="btn btn-warning mb-4 mt-3 <?php echo $ocultaBotones ?>" data-toggle="modal"  data-target="#ActualizarVaca ">Actualizar a vaca</button>
					<input type="hidden" id="txtmodulo" value="<?php echo $_SESSION['modulo']?>">

				</div>
			</div>

		</div>
		<?php 
		$porPagina = 5;
		if(isset($_GET['pagina'])){
			$pagina =  $_GET['pagina'];
		}else{
			$pagina = 1;
		}
		$empieza = ($pagina - 1) * $porPagina; ?>

		<table  class="table table-striped table-bordered table-responsive-sm table-responsive-lg table-responsive-md">
			<thead>
				<tr>
					<th>CHAPA/NOMBRE</th>
					<th>PADRE</th>
					<th>MADRE</th>
					<th>SEXO</th>
					<th>FECHA DE NACIMIENTO</th>
					<th>PESO DE NACIMIENTO</th>
					<th>ESTADO DESCARTE</th>
					<th>DESCRIPCIÓN MUERTE</th>
					<?php if ($_SESSION['modulo'] == 1){
						echo'<th>¿ES VACA?</th>';
					}						
					?>
					<th>¿EN PRODUCCIÓN?</th>
					
					<th class="text-center">ACTUALIZAR/PRODUCCIÓN</th>
					<th>HISTORIAL</th>
					<th>ELIMINAR</th>
				</tr>
			</thead>
			<tbody>
				
				<?php
				$sql = mysqli_query($conexion,"SELECT 
					IDANIMAL, 
					(SELECT NUMEROCHAPA FROM ANIMAL WHERE IDANIMAL = ANIMAL2.IDPADRE) CHAPAPADRE,
					(SELECT NUMEROCHAPA FROM ANIMAL WHERE IDANIMAL = ANIMAL2.IDMADRE) CHAPAMADRE,
					IDPADRE,
					IDMADRE,
					NUMEROCHAPA,
					CATEGORIA,
					SEXO,
					FECHANACIMIENTO,
					PESONACIMIENTO,
					DESCRIPCIONMUERTE,
					ESTADODESCARTE,
					ESVACA,
					PRODUCCION,
					CASE WHEN (ESVACA = 1 AND SEXO = 'HEMBRA') THEN 'SI' ELSE CASE WHEN (ESVACA = 0 AND SEXO = 'HEMBRA') THEN 'NO' ELSE 'NO APLICA'END END ESVACA1 ,
					CASE WHEN (ESTADODESCARTE = 1) THEN 'SI' ELSE 'NO' END ESTADODESCARTE1 
					FROM ANIMAL ANIMAL2 
					WHERE CATEGORIA = ".$_SESSION['modulo']." ORDER BY IDANIMAL AND ESTADODESCARTE <> 0 LIMIT $empieza, $porPagina ");
				while ($fila = mysqli_fetch_array($sql)){

					if($fila['ESTADODESCARTE'] == 1){
						$bloqueaActualiza = 'disabled=""';
						$bloqueaElimina = "disabled";


					}else{
						$bloqueaActualiza ="";
						$bloqueaElimina ="";
					}

					if ($fila['SEXO'] == 'MACHO' || $fila['ESVACA'] != 1) {
						$bloqueaProduccion = 'disabled=""';
					}
					else{
						$bloqueaProduccion = '';
					}

					?>

					<tr>
						<td class="align-middle"><a href="Historial.php?HistorialAnimal=<?php echo $fila['IDANIMAL'];?>"><b><?php echo $fila['NUMEROCHAPA']; ?></b></a></td>
					
						<td><?php echo $fila['CHAPAPADRE']; ?></td>
						<td><?php echo $fila['CHAPAMADRE']; ?></td>
						<td><?php echo $fila['SEXO']; ?></td>
						<td><?php echo $fila['FECHANACIMIENTO']; ?></td>
						<td><?php echo $fila['PESONACIMIENTO']." Kg"; ?></td>
						<td>
							<?php 
							if ($fila['ESTADODESCARTE1'] == 'SI') {
								?>
								<span class="badge badge-danger p-2"> <?php echo $fila['ESTADODESCARTE1'] ?> </span>	
								<?php 
							}else{
								?>	
								<span class="badge badge-success p-2"> <?php echo $fila['ESTADODESCARTE1'] ?> </span>
								<?php 
							}
							?>	
						</td>
						<td><?php echo $fila['DESCRIPCIONMUERTE']; ?></td>
						<?php 
						if ($_SESSION['modulo'] == 1){ 
							if ($fila['ESVACA1'] == 'SI') { ?>		
								<td> <span class="badge badge-success p-2"> <?php echo $fila['ESVACA1'] ?> </span></td>
								<?php 
							}elseif ($fila['ESVACA1'] == 'NO') { 
								?>
								<td> <span class="badge badge-danger p-2"> <?php echo $fila['ESVACA1'] ?> </span></td>
								<?php 
							}else{ 
								?>
								<td> <span class="badge badge-secondary p-2"> <?php echo $fila['ESVACA1'] ?> </span></td>
								<?php 
							}
						}
						?>

						<?php 
						if ($fila['PRODUCCION'] == 'SI') { 
							?>		
							<td> <span class="badge badge-success p-2"> <?php echo $fila['PRODUCCION'] ?> </span></td>
							<?php 
						}elseif ($fila['PRODUCCION'] == 'NO') { 
							?>
							<td> <span class="badge badge-danger p-2"> <?php echo $fila['PRODUCCION'] ?> </span></td>
							<?php 
						}
						?>


						<td class="align-middle text-center"> 
							<div class="btn-group">
								<button class="btn btn-outline-warning " data-toggle="modal" <?php echo $bloqueaActualiza; ?>  data-target="#actualizaAnimal<?php echo $fila['IDANIMAL']?>"><i class="fa fa-edit fa-2x"></i></button>
								<button class="btn btn-outline-primary <?php echo $ocultaBotones ?>" data-toggle="modal" <?php echo $bloqueaActualiza; echo $bloqueaProduccion; ?> data-target="#ActualizaProduccion<?php echo $fila['IDANIMAL']?>"><i class="fa fa-dollar-sign fa-2x"></i></button>
							</div> 
						</td>
						<td class="align-middle text-center"><a class="btn btn-outline-info" href="Historial.php?HistorialAnimal=<?php echo $fila['IDANIMAL'];?>"><i class="fa fa-file-contract fa-2x"></i></a></td>
						<td class="align-middle text-center"> <a onclick="javascript:return confirm('¿Está seguro de eliminar el registro?')"  class="btn btn-outline-danger <?php echo $bloqueaElimina ?> " 
							href="Animales.php?Eliminar=<?php echo $fila['IDANIMAL'];?>"> <i class="fa fa-trash-alt fa-2x"></i></a></td>
						</tr>
						<?php  
						include('./ModalUpdateAnimal.php'); 
						include('./ModalUpdateProduccion.php');
					}  ?>

				</tbody>

			</table>
			<div class="row">
				<div class="col">
					<ul class="pagination justify-content-center">
						<?php 
						$query = mysqli_query($conexion,"SELECT * FROM ANIMAL WHERE CATEGORIA = ".$_SESSION['modulo']);
						$totalRegistros = mysqli_num_rows($query);
						$totalPagina = ceil($totalRegistros / $porPagina);
						?>
						<li class="page-item"> <a class="page-link" href="Animales.php?pagina=1">Primera</a></li>
						<?php 
						

						for ($i=1; $i <= $totalPagina ; $i++) { 

							if($i == $pagina){

								?>
								<li class="page-item active"><a class="page-link >" href="Animales.php?pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
							<?php } else{ ?>
								<li class="page-item"><a class="page-link >" href="Animales.php?pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
							<?php	} }?>
							<li class="page-item "> <a class="page-link" href="Animales.php?pagina=<?php echo $totalPagina ?>">Última</a></li>
						</ul>
						<div class="row">
							<div class="col text-right">
								<h6>Página <b><?php echo $pagina ?></b> de <b><?php echo $totalPagina ?></b></div>
								</div>

							</div>
						</div>
					</div>
				</div>

				<?php //INICIO modal actualiza estado es vaca ?>

				<div class="modal fade" id="ActualizarVaca">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Actualizar estado ternera a vaca</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="POST">	
									<div class="row">
										<div class="col-sm-12 col-lg-12 mb-5">
											<label>Seleccione la vaca</label>

											<select class="custom-select" name="sltVaca">
												<option value="NULL">Seleccionar...</option>
												<?php 
												$sqlMacho = mysqli_query($conexion, "SELECT IDANIMAL,NUMEROCHAPA FROM ANIMAL WHERE ESVACA = 0 AND ESTADODESCARTE <> 1 AND SEXO = 'HEMBRA' AND CATEGORIA =".$_SESSION['modulo']);
												while ($fila = mysqli_fetch_array($sqlMacho)){
													$idanimalMacho = $fila['IDANIMAL'];
													$numeroChapaMacho = $fila['NUMEROCHAPA'];
													?>
													<option value="<?php echo $idanimalMacho; ?>"> <?php echo $numeroChapaMacho;?></option>

												<?php }
												?>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col text-center">
											<button class="btn btn-warning btn-lg" name="actualizaEsVaca">Actualizar</button>
										</div>
									</div>
								</form>
							</div>

						</div>

					</div>

				</div>


				<?php //FIN modal actuliza estado es vaca ?>


				<!--INICIO modal inserta animal-->
				<div class="modal fade" id="insertaAnimal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Agregar nuevo animal</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="POST">
									<div class="row">
										<div class="col-sm-12 col-lg-6">
											<label>Seleccione el padre</label>
											<select class="custom-select" name="sltIdPadre" id="sltIdPadre">
												<option value="NULL">Seleccionar...</option>
												<?php 
												$sqlMacho = mysqli_query($conexion, "SELECT IDANIMAL,NUMEROCHAPA FROM ANIMAL WHERE ESTADODESCARTE <> 1 AND SEXO = 'MACHO' AND CATEGORIA =".$_SESSION['modulo']);
												while ($fila = mysqli_fetch_array($sqlMacho)){
													$idanimalMacho = $fila['IDANIMAL'];
													$numeroChapaMacho = $fila['NUMEROCHAPA'];
													?>
													<option value="<?php echo $idanimalMacho; ?>"> <?php echo $numeroChapaMacho;?></option>

												<?php }
												?>
											</select>
										</div>
										<div class="col-sm-12 col-lg-6">
											<label>Seleccione la madre</label>
											<select class="custom-select" name="sltIdMadre" id="sltIdMadre">
												<option value="NULL">Seleccionar...</option>
												<?php 
												$sqlHembra = mysqli_query($conexion, "SELECT IDANIMAL,NUMEROCHAPA FROM ANIMAL WHERE ESVACA= 1 AND ESTADODESCARTE <> 1 AND SEXO = 'HEMBRA'AND CATEGORIA =".$_SESSION['modulo']);
												while ($fila = mysqli_fetch_array($sqlHembra)){
													$idanimal = $fila['IDANIMAL'];
													$numeroChapa = $fila['NUMEROCHAPA'];
													?>
													<option value="<?php echo $idanimal; ?>"> <?php echo $numeroChapa;?></option>

												<?php }
												?>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12 col-lg-6">
											<label for="txtNumeroChapa">Número de la chapa / Nombre</label>
											<input type="text" id="txtNumeroChapa" class="form-control"  name="txtNumeroChapa" id="txtNumeroChapa">
										</div>
										<div class="col-sm-12 col-lg-6">
											<label for="sltSexo">Sexo</label>
											<select class="custom-select" name="sltSexo" id="sltSexo" >
												<option value="MACHO">MACHO</option>
												<option value="HEMBRA">HEMBRA</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12 col-lg-6">
											<label>fecha de nacimiento</label>
											<input type="date" class="form-control"  name="txtFechaNacimiento" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}" id="txtFechaNacimiento">
										</div>
										<div class="col-sm-12 col-lg-6">
											<label>Peso de nacimiento(Kg)</label>
											<input type="number" class="form-control"  name="txtPesoNacimiento" id="txtPesoNacimiento">
										</div>
									</div>

									<div class="row">
										<div class="col-sm-12 col-lg-12 text-center mt-4 mb-3">
											<button name="btnInsertaAnimal" id="btnInsertaAnimal" class="btn btn-success btn-lg">Insertar</button>
										</div>
									</div>
								</form>
							</div>
						</div>	
					</div>
				</div>
				<!--FIN modal inserta animal-->

				<?php 

//INICIO actualiza estado ESVACA

				if(isset($_POST['actualizaEsVaca'])){
					$idvaca = $_POST['sltVaca'];

					$sqlEsVaca = mysqli_query($conexion, "UPDATE ANIMAL SET ESVACA = 1 WHERE IDANIMAL = $idvaca");

					if($sqlEsVaca){
						echo '
						<script>  
						toastr.success("El estado ES VACA cambió a SI", "Correcto!");
						window.setTimeout(function(){
							window.open("Animales.php","_self");
							}, 1000);
							</script>';
						}else{
							echo '
							<script>  
							toastr.error("Error al relizar la actualización", "Error!");
							window.setTimeout(function(){
								window.open("Animales.php","_self");
								}, 1000);
								</script>'; 
							}



						}


//FIN actualiza estado ESVACA

//INICIO eliminar animal
						if(isset($_GET['Eliminar'])){
							$sql =	"DELETE FROM ANIMAL WHERE IDANIMAL = ".$_GET['Eliminar'];
							$sqlEliminar =mysqli_query($conexion,"DELETE FROM ANIMAL WHERE IDANIMAL = ".$_GET['Eliminar']);

							if($sqlEliminar){
								echo '
								<script>  
								toastr.success("Registro eliminado", "Correcto!");
								window.setTimeout(function(){
									window.open("Animales.php","_self");
									}, 1000);
									</script>';
								}else{ 
									$error = mysqli_error($conexion);
									echo '
									<script>  
									toastr.error("Error al eliminar el registro, no se puede eliminar un animal con descendencia", "Error!");
									window.setTimeout(function(){
										window.open("Animales.php","_self");
										}, 2500);
										</script>';
									}
								}

//FIN eliminar animal

// INICIO actualizar animal
								if(isset($_POST['btnActualizaAnimal'])){
									$descripcionMuerte = $_POST['txtDescripcionMuerte'];
									$sltEstadoDescarte = $_POST['sltEstadoDescarte'];
									$sqlActualizar = mysqli_query($conexion,"UPDATE ANIMAL SET DESCRIPCIONMUERTE = '$descripcionMuerte', ESTADODESCARTE = $sltEstadoDescarte , PRODUCCION = 'NO', ESVACA = 0 WHERE IDANIMAL = ".$_POST['txtIdAnimal']);
									if($sqlActualizar){
										echo '
										<script>  
										toastr.success("Registro Actualizado", "Correcto!");
										window.setTimeout(function(){
											window.open("Animales.php","_self");
											}, 1000);
											</script>';
										}else{ 
											echo '
											<script>  
											toastr.error("Error al actualizar, verifique los datos", "Error!");
											window.setTimeout(function(){
												window.open("Animales.php","_self");
												}, 2500);
												</script>';
											}
										}
//FIN actualizar animal

//INICIO actualiza producción
										if (isset($_POST['btnActualizaProduccion'])) {

											$sqlActualizarProduccion = mysqli_query($conexion,"UPDATE ANIMAL SET PRODUCCION = '".$_POST['sltProduccion']."' WHERE IDANIMAL = ".$_POST['txtidAnimal']);
											if($sqlActualizarProduccion){
												echo '
												<script>  
												toastr.success("Registro Actualizado", "Correcto!");
												window.setTimeout(function(){
													window.open("Animales.php","_self");
													}, 1000);
													</script>';
												}else{ 
													$error = mysqli_error($conexion);
													echo '
													<script>  
													toastr.error("Error al actualizar, verifique los datos", "Error!");
													window.setTimeout(function(){
														window.open("Animales.php","_self");
														}, 2500);
														</script>';
													}	
												}
//FIN  actualiza produccion

												?>

												<script>
													$(function(){
														const modulo = $('#txtmodulo').val();

														$('#btnInsertaAnimal').on('click',function(e) {
															e.preventDefault();
															const idPadre = $('#sltIdPadre').val();
															const idMadre = $('#sltIdMadre').val();
															const numeroChapa = $('#txtNumeroChapa').val();
															const sexo = $('#sltSexo').val();
															const fechaNacimiento = $('#txtFechaNacimiento').val();
															const pesoNacimiento = $('#txtPesoNacimiento').val();
															const accion = 'insertaAnimal';
															
															if(numeroChapa==""){
																toastr.error('El número de la chapa no puede ser vacio', 'Error!',{
																	"progressBar":true,
																	"closeButton":true,
																	"timeOut":3000
																});
																return false;
															} 

															if(fechaNacimiento==""){
																toastr.error('La fecha de nacimiento no puede ser vacia', 'Error!',{
																	"progressBar":true,
																	"closeButton":true,
																	"timeOut":2000
																});
																return false;
															} 
															if(pesoNacimiento==""){
																toastr.error('el peso de nacimiento no puede ser vacio', 'Error!',{
																	"progressBar":true,
																	"closeButton":true,
																	"timeOut":2000
																});
																return false;
															} 
															$.ajax({
																url: '../metodos/validaChapaExistente.php',
																type: 'POST',
																data: {txtNumeroChapa: numeroChapa ,
																	txtModulo: modulo},
																	success: function(respuesta){
																		if(respuesta == 0){
																			

																			$.ajax({
																				url:'../metodos/consultasJS.php',
																				type: 'POST',
																				data:{
																					modulo:modulo,
																					accion:accion,
																					sltIdPadre:idPadre,
																					sltIdMadre:idMadre,
																					txtNumeroChapa:numeroChapa,
																					sltSexo:sexo,
																					txtFechaNacimiento:fechaNacimiento,
																					txtPesoNacimiento:pesoNacimiento
																				},
																				success: function(respuesta){
																					if (respuesta == 1) {
																						toastr.success("Registro insertado con éxito", "Correcto!");
																						window.setTimeout(function(){
																							window.open("Animales.php","_self");
																						}, 1000);

																					}else{
																						toastr.error("Error al realizar el registro", "Error!");
																						window.setTimeout(function(){
																							window.open("Animales.php","_self");
																						}, 1000);

																					}

																				}
																			})
																			

																		}else{
																			toastr.warning('La chapa ya se encuentra registrada', 'Alerta!',{
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