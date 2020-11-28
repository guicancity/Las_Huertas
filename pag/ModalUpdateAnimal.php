
<div class="modal fade" id="actualizaAnimal<?php echo $fila['IDANIMAL']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Actualizar animal</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="Animales.php" onSubmit="if(!confirm('¿Desea continuar? esta acción no se podrá revertir')){return false;}">
				<div class="row">
					<div class="col">
						<input type="hidden" name="txtIdAnimal" value="<?php echo $fila['IDANIMAL']; ?>">
						<label>Chapa del padre</label>
						<input type="text" class="form-control" value=" <?php echo $fila['CHAPAPADRE']; ?>" disabled="" name="">
					</div>
					<div class="col">
						<label>Chapa de la madre</label>
						<input type="text" class="form-control" value=" <?php echo $fila['CHAPAMADRE']; ?>" disabled="" name="">
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label for="txtNumeroChapa">Número de la chapa</label>
						<input type="text" class="form-control" disabled="" value=" <?php echo $fila['NUMEROCHAPA']; ?>" name="txtNumeroChapa">
					</div>
					<div class="col">
						<label for="sltSexo">Sexo</label>
						<input type="text" class="form-control" disabled="" value=" <?php echo $fila['SEXO']; ?>" name="">
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label for="txtFechaNacimiento">fecha de nacimiento</label>
						<input type="text" class="form-control" disabled="" value="<?php echo $fila['FECHANACIMIENTO']; ?>" name="txtFechaNacimiento">
					</div>
					<div class="col">
						<label for="txtPesoNacimiento">Peso de nacimiento(Kg)</label>
						<input type="text" class="form-control" disabled="" value="<?php echo $fila['PESONACIMIENTO']; ?>" name="txtPesoNacimiento">
				    </div>
				</div>
				<div class="row">
					<div class="col">
						<label>Descripción de la muerte</label>
						<textarea required="" class="form-control" name="txtDescripcionMuerte"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label for="sltEstadoDescarte">Estado descarte</label>
						<select class="custom-select disabled"  name="sltEstadoDescarte"> 
							<option value="1">SI</option>
						</select>						
					</div>
				</div>
				<div class="row">
					<div class="col text-center mt-4 mb-3">
						<button type="submit" name="btnActualizaAnimal" class="btn btn-warning btn-lg">Actualizar</button>
					</div>
				</div>
				</form>
			</div>
		</div>
		
	</div>
	
</div>