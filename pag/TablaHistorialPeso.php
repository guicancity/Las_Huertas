<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
require('../metodos/conexion.php');
$idAnimal = $_GET['HistorialAnimal'];
 ?>

<div class="row">
	<div class="col mt-5 mb-4">
		<h4><b>Historial de peso</b></h4>
		<a class="btn btn-outline-success" href="Reportes/E_RPesoPorAnimal.php?HistorialAnimal=<?php echo $idAnimal ?>"> <i class="fa fa-file-excel fa-2x"></i></a>
	</div>
</div>
<?php 
$porPagina = 6;

if(isset($_GET['pagina'])){
	$pagina =  $_GET['pagina'];

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
					<th>Fecha de pesado</th>
					<th>peso en Kilogramos</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$sql= mysqli_query($conexion,"SELECT IDPESOANIMAL, IDANIMAL, FECHACONTROL,PESOKG  FROM PESOANIMAL WHERE IDANIMAL =".$_GET['HistorialAnimal']." ORDER BY FECHACONTROL DESC LIMIT $empieza, $porPagina ");
				while ($fila = mysqli_fetch_array($sql)){ ?>	
					<tr>
						<td><?php echo  $fila['FECHACONTROL'] ?></td>
						<td><?php echo  $fila['PESOKG'] ?></td>
					</tr>
					<?php } ?>

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
					<li class="page-item"> <a class="page-link" href="Historial.php?pagina=1&HistorialAnimal=<?php echo $_GET['HistorialAnimal'] ?>">Primera</a></li>
						 <?php 
						

						 for ($i=1; $i <= $totalPagina ; $i++) { 
						 	
						 	?>
					<li class="page-item"><a class="page-link >" href="Historial.php?pagina=<?php echo $i ?>&HistorialAnimal=<?php echo $_GET['HistorialAnimal'] ?>"><?php echo $i ?></a></li>
						<?php } ?>
					<li class="page-item "> <a class="page-link" href="Historial.php?pagina=<?php echo $totalPagina ?>&HistorialAnimal=<?php echo $_GET['HistorialAnimal'] ?>">Última</a></li>
				</ul>
				<h6>Página <b><?php echo $pagina ?></b> de <b><?php echo $totalPagina ?></b></h6>
			</div>
		</div>
					
	</div>
</div>
<hr>