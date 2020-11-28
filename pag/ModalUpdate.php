<!--INICIO modal de Actualizacion-->
<div id="modalUpdate<?php echo $fila['IDPRINCIPALSLIDER']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="documento">
		<div class="modal-content">
			<div class="modal-header">
        		<h5 class="modal-title">Actualizar registro</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
			<div class="modal-body">
				<form class="col-md-5" method="POST" action="Configuracion.php" enctype="multipart/form-data">
					<div class="row">
						<div class="col">
							<input type="hidden" name="txtidPrincipalSlider" value="<?php echo $fila['IDPRINCIPALSLIDER'] ?>">
							<label for="txtTitulo">Título</label>
							<input type="text" class="form-control" name="txtTitulo" value="<?php echo $fila['TITULO'] ?>">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label for="taDescripcion">Descripción</label>
							<textarea class="form-control" name="txtDescripcion"><?php echo $fila['DESCRIPCION'] ?></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label for="imagen">Imagen actual</label>
							<img class="img-thumbnail" src="<?php echo $fila['IMAGEN'] ?>">
						</div>
					</div>
					<div class="row">
						<div class="col mt-3">
							<div class="form-group">
			    				<label for="exampleFormControlFile1">seleccionar nueva imagen</label>
			    				<input type="file" class="form-control-file" name="txtimagen">
			  				</div>
						</div>
					</div>
					<div class="row">
						<div class="col text-center mb-2 mt-4">
							<input type="submit" name="btnActualizaImagen" class="btn btn-warning" value="Guardar cambios">
						</div>
					</div>
					
					
				</form>
			</div>
		
		</div>
	</div>
   
</div>

<!--FINAL modal de Actualizacion-->