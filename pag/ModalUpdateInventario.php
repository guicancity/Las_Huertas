<div class="modal fade" id="actualizaProducto<?php echo $fila['IDPRODUCTOS']?>">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Actualizar inventario</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
			</div>
			<div class="modal-body">
				<form method="POST">
				<div class="row">
					<div class="col">
					<input type="hidden" name="txtIdProducto" value="<?php echo $fila['IDPRODUCTOS']?>">
						<label>Nombre del producto</label>
						<input type="text" class="form-control" name="txtnombreU" value=" <?php echo $fila['NOMBRE'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label>Tipo de producto</label>
						 <?php $idProducto =  $fila['TIPO']; 
						 	$nombreProducto = "";
						 	?>
						 	<select name="slttipoU" class="custom-select">
						 	<?php 
						 	switch ($idProducto) {
						 	case 1:
						 		$nombreProducto = "VACUNA";
						 		?> 
						 			<option value="<?php echo $idProducto;?>"><?php echo $nombreProducto;?></option>
									<option value="2">PURGA</option>
									<option value="3">VITAMINA</option>
									<option value="4">INSUMO</option>
						 		<?php 
						 	break;
						 	case 2:
						 		$nombreProducto = "PURGA";
						 		?> 
						 			<option value="<?php echo $idProducto;?>"><?php echo $nombreProducto;?></option>
									<option value="1">VACUNA</option>
									<option value="3">VITAMINA</option>
									<option value="4">INSUMO</option>
						 		<?php
						 	break;
						 	case 3:
						 		$nombreProducto = "VITAMINA";
						 		?> 
						 			<option value="<?php echo $idProducto;?>"><?php echo $nombreProducto;?></option>
									<option value="1">VACUNA</option>
									<option value="2">PURGA</option>
									<option value="4">INSUMO</option>
						 		<?php
						 	break;
						 	case 4:
						 		$nombreProducto = "INSUMO";
						 		?> 
						 			<option value="<?php echo $idProducto;?>"><?php echo $nombreProducto;?></option>
									<option value="1">VACUNA</option>
									<option value="2">PURGA</option>
									<option value="3">VITAMINA</option>
						 		<?php
						 	break;
						 	default:
						 		$nombreProducto = "VACUNAssss";
						 		break;
						 } ?>
						
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label>Precio</label>
						<input type="number" name="txtPrecioCompraU" class="form-control" value="<?php echo $fila['PRECIOCOMPRA']; ?>">
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label>Cantidad Actual</label>
						<input type="number" name="txtCantidadU" class="form-control" value="<?php echo $fila['STOCK']; ?>">
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label>descripcion</label>
						<textarea name="txaDescripcion" class="form-control"><?php echo $fila['DESCRIPCION']; ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col text-center">
						<button class="btn mt-5 btn-warning" name="btnActualizaInventario">Actualizar</button>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>