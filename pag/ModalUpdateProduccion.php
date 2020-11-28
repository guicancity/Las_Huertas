<?php 
require_once('../metodos/conexion.php');

 ?>
<div class="modal fade" id="ActualizaProduccion<?php echo $fila['IDANIMAL']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Actualizar producción</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST">
					<input type="hidden" name="txtidAnimal" value="<?php echo $fila['IDANIMAL']?>">
					<div class="container-fluid">
						<label>Actualmente en producción</label>
						<select class="form-control" name="sltProduccion">
		  				<?php 
		  					switch ($fila['PRODUCCION']) {
		  					case 'SI':
		  				?>
		  						<option selected="" value="SI">SI</option>
		  						<option value="NO">NO</option>
		  				<?php 
		  					break;
		  					case 'NO':
		  				?>
			  			 		<option selected="" value="NO">NO</option>
			  					<option value="SI">SI</option>
		  				<?php
		  					break;
		  					}
		  				?>
		  				</select>
		  				<div class="row">
		  					<div class="col text-center mt-4 mb-3">
		  						<button class="btn btn-lg btn-warning" name="btnActualizaProduccion">Actualizar</button>
		  					</div>
		  				</div>
		  			</div>
	  			</form>
	  		</div>
		</div>
	</div>
</div>