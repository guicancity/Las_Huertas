<?php 
require('../metodos/conexion.php');
require_once('../metodos/sesionIniciada.php');
require_once('menu.php');
$idAnimal = $_GET['HistorialAnimal'];
 ?>

<div class="row">
	<div class="col mt-5 mb-4">
		<h4><b>Historial de leche</b></h4>
		<a class="btn btn-outline-success" href="Reportes/E_RLechePorAnimal.php?HistorialAnimal=<?php echo $idAnimal ?>"> <i class="fa fa-file-excel fa-2x"></i></a>
	</div>
</div>
<?php 
$porPagina = 7;

if(isset($_GET['pagina2'])){
	$pagina =  $_GET['pagina2'];

}else{
	$pagina = 1;
}

$empieza = ($pagina - 1) * $porPagina;

 ?>


<div class="row">
	<div class="col">	
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Cantidad</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$sql1 = "SELECT IDPRODUCCIONLECHE, IDANIMAL, FECHA,CANTIDAD  FROM PRODUCCIONLECHE WHERE IDANIMAL =". $_GET['HistorialAnimal'] ." ORDER BY FECHA";
				$sql= mysqli_query($conexion,"SELECT IDPRODUCCIONLECHE, IDANIMAL, FECHA,CANTIDAD  FROM PRODUCCIONLECHE WHERE IDANIMAL =".$_GET['HistorialAnimal']." ORDER BY FECHA DESC LIMIT $empieza, $porPagina ");
				$i = 1;
				while ($fila = mysqli_fetch_array($sql)){ ?>	
					<tr>
						<td><?php echo  $fila['FECHA'] ?></td>
						<td><?php echo  $fila['CANTIDAD'] ?></td>
					</tr>
					<?php $i = $i +1; } ?>

			</tbody>
		</table>
		<div class="row">
			<div class="col ">
  				<ul class="pagination justify-content-center">
   				<?php 
						$query = mysqli_query($conexion,"SELECT * FROM PESOANIMAL WHERE IDANIMAL =".$_GET['HistorialAnimal']);
						$totalRegistros = mysqli_num_rows($query);
						$totalPagina = ceil($totalRegistros / $porPagina);
						 ?>
					<li class="page-item"> <a class="page-link" href="Historial.php?pagina2=1&HistorialAnimal=<?php echo $_GET['HistorialAnimal'] ?>">Primera</a></li>
						 <?php 
						

						 for ($i=1; $i <= $totalPagina ; $i++) { 
						 	
						 	?>
					<li class="page-item"><a class="page-link >" href="Historial.php?pagina2=<?php echo $i ?>&HistorialAnimal=<?php echo $_GET['HistorialAnimal'] ?>"><?php echo $i ?></a></li>
						<?php } ?>
					<li class="page-item "> <a class="page-link" href="Historial.php?pagina2=<?php echo $totalPagina ?>&HistorialAnimal=<?php echo $_GET['HistorialAnimal'] ?>">Última</a></li>
				</ul>
				<h6>Página <b><?php echo $pagina ?></b> de <b><?php echo $totalPagina ?></b></h6>
			</div>
		</div>
	</div>
</div>