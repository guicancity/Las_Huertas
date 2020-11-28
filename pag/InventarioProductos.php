<?php 
session_start();
require('../metodos/conexion.php');
require_once('../metodos/sesionIniciada.php');
require_once('menu.php');
 ?>

 <!DOCTYPE html>
 <html>
 <head>
    <?php 
	include_once("../metodos/links.php");
	?>	
    <title>Las huertas || Inventario</title>
</head>
 <body>

<div class="container">
	<form class="border mt-5 mb-5 p-4 rounded shadow" method="POST" >
		<div class="row">
			<div class="col text-center mb-3"> 
				<h2><b>Inventario</b></h2>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<label>Nombre del producto</label>
				<input type="text" required="" class="form-control" name="txtNombre">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-lg-4 ">
				<label>Tipo de producto</label>
				<select class="custom-select" name="sltTipo">
					<option value="1">VACUNA</option>
					<option value="2">PURGA</option>
					<option value="3">VITAMINA</option>
					<option value="4">INSUMO</option>
				</select>
			</div>
			<div class="col-sm-12 col-lg-4">
				<label>Precio de compra</label>
				<input type="number"  class="form-control"  required="" name="txtPrecioCompra">
			</div>
			<div class="col-sm-12 col-lg-4">
				<label>Cantidad en inventario</label>
				<input type="number" class="form-control" required="" name="txtCantidad">
			</div>
		</div>
		<div class="row">
			<div class="col">
				<label>Descripción del producto</label>
				<textarea class="form-control" name="txaDescripcion"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col text-center mt-3">
				<button class="btn btn-success btn-lg" type="submit" name="btnInsertaProducto">Insertar</button>
			</div>
		</div>
    </form>
<hr>
    <?php //Inicia tabla de productos en inventario ?>
    <div class="row">
    	<div class="col mt-4 mb-4 text-center">
    		<h3>Elementos en inventario</h3>
    	</div>
    </div>
    <div class="row">
    	<div class="col mb-5">
    		<table class="table table-striped text-center table-responsive-sm">
    			<thead>
    				<tr>
    					<th>Nombre</th>
    					<th>Tipo</th>
    					<th>Precio</th>
    					<th >Cantidad Actual</th>
    					<th>Descripción</th>
    					<th>Actualizar</th>
    					<th>Eliminar</th>
    					<th>activo</th>
    					
    				</tr>
    			</thead>
    			<tbody>
    				<?php 
    					$sql = mysqli_query($conexion,"SELECT IDPRODUCTOS, TIPO, NOMBRE, CASE TIPO WHEN 1 THEN 'VACUNA' WHEN 2 THEN 'PURGA' WHEN 3 THEN 'VITAMINA' WHEN 4 THEN 'INSUMO' END TIPO1,PRECIOCOMPRA,STOCK,DESCRIPCION FROM PRODUCTOS");

    					while($fila = mysqli_fetch_array($sql)){
    						$nombre = $fila['NOMBRE'];
    						$tipo = $fila['TIPO1'];
    						$preciocompra = number_format($fila['PRECIOCOMPRA'],2,",",".");
    						$stock = $fila['STOCK'];
    						$descripcion = $fila['DESCRIPCION'];
    				 ?>

    				<tr>
    					<td><?php echo $nombre; ?></td>
    					<td><?php echo $tipo; ?></td>
    					<td class="text-right"><?php echo $preciocompra; ?></td>
    					<td ><?php echo $stock; ?></td>
    					<td><?php echo $descripcion; ?></td>
    					<td class="align-middle"> <button class="btn btn-warning" data-toggle="modal" data-target="#actualizaProducto<?php echo $fila['IDPRODUCTOS']?>">Actualizar</button> </td>
    					<td class="align-middle"> <a onclick="javascript:return confirm('¿Está seguro de eliminar el registro?')"  class="btn btn-danger" 
          						   href="InventarioProductos.php?Eliminar=<?php echo $fila['IDPRODUCTOS'];?>">Eliminar</a></td>
          				<td><input type="checkbox" value="1" class="form-check-input Activo" checked=""></td>
    				</tr>
    				<?php 
    				include('ModalUpdateInventario.php');
    			} ?>
    			</tbody>
    		</table>
    	</div>
    </div>
</div>



<?php 
if(isset($_POST['btnInsertaProducto'])){
	$nombre = $_POST['txtNombre'];
	$tipo = $_POST['sltTipo'];
	$precio = $_POST['txtPrecioCompra'];
	$cantidad = $_POST['txtCantidad'];
	$descripcion = $_POST['txaDescripcion'];
	$sql = mysqli_query($conexion,"INSERT INTO PRODUCTOS(NOMBRE,TIPO,PRECIOCOMPRA,STOCK,DESCRIPCION) VALUE ('$nombre',$tipo,$precio,$cantidad,'$descripcion')");

		if($sql){
				echo '
				<script>  
					toastr.success("Registro insertado con éxito", "Correcto!");
		            window.setTimeout(function(){
	        			window.open("InventarioProductos.php","_self");
	    			}, 1000);
	      	    </script>';
	     	
	  	}else{
	      	echo '
				<script>  
					toastr.error("Valide los datos ingresados", "Error!");
		            window.setTimeout(function(){
	        			window.open("InventarioProductos.php","_self");
	    			}, 1000);
	      	    </script>';
	  	}
}
 // INICIO metodo ELIMINAR
if(isset($_GET['Eliminar'])){
	$sqlEliminar =mysqli_query($conexion,"DELETE FROM PRODUCTOS WHERE IDPRODUCTOS = ".$_GET['Eliminar']);

	if($sqlEliminar){
			echo '
				<script>  
					toastr.success("Registro eliminado con éxito", "Correcto!");
		            window.setTimeout(function(){
	        			window.open ("InventarioProductos.php","_self");
	    			}, 1500);
	      	    </script>';
		}else{ 
			$error = mysqli_error($conexion);
			echo '
				<script>  
					toastr.error("No se pudo eliminar el registro", "Error!");
		            window.setTimeout(function(){
	        			window.open ("InventarioProductos.php","_self");
	    			}, 1500);
	      	    </script>';

		}
}

if (isset($_POST['btnActualizaInventario'])) {
$idProductoU = $_POST['txtIdProducto'];
$nombreProductoU = $_POST['txtnombreU'];
$tipoU = $_POST['slttipoU'];
$precioU = $_POST['txtPrecioCompraU'];
$cantidadU = $_POST['txtCantidadU'];
$descripcionU = $_POST['txaDescripcion'];

$sqlUpdate = "UPDATE PRODUCTOS SET NOMBRE = '$nombreProductoU',TIPO = '$tipoU', PRECIOCOMPRA = $precioU ,STOCK = $cantidadU,DESCRIPCION = '$descripcionU' WHERE IDPRODUCTOS = $idProductoU";

$ejecutaSqlUpdate = mysqli_query($conexion,$sqlUpdate);

if($ejecutaSqlUpdate){
			echo '
				<script>  
					toastr.success("Registro actualizado con éxito", "Correcto!");
		            window.setTimeout(function(){
	        			window.open ("InventarioProductos.php","_self");
	    			}, 1500);
	      	    </script>';
		}else{ 
			$error = mysqli_error($conexion);
			echo '
				<script>  
					toastr.error("Error al eliminar el registros", "Error!");
		            window.setTimeout(function(){
	        			window.open ("InventarioProductos.php","_self");
	    			}, 1500);
	      	    </script>';

		}


}	 
 ?> 

 <script type="text/javascript">
 	$(function(){
 		$('.Activo').change(function(e){
 			const idactual = $(this).val();

 			alert('hola mundo' + idactual);
 		})
 	});


 	/*'
			<script>  
			toastr.success("Registro Actualizado", "Correcto!");
			window.setTimeout(function(){
				window.open("Animales.php","_self");
				}, 1000);
				*/

 </script>
 </body>
 </html>