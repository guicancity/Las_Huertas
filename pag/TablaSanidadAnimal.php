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
		<h4><b>Historial sanidad animal</b></h4>
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
					<th>Producto</th>
					<th>Tipo de producto</th>
					<th>Fecha de aplicación</th>
					<th>Dosis aplicada</th>
					<th>Sintomas</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$sql= mysqli_query($conexion,"SELECT P.NOMBRE, CASE P.TIPO WHEN 1 THEN 'VACUNA' WHEN 2 THEN 'PURGA' WHEN 3 THEN 'VITAMINA' WHEN 4 THEN 'INSUMO' END TIPO1, SA.FECHA,SA.DOSISAPLICADA, SA.SINTOMAS FROM SANIDADANIMAL SA INNER JOIN PRODUCTOS P ON SA.IDPRODUCTOS = P.IDPRODUCTOS WHERE SA.IDANIMAL =".$_GET['HistorialAnimal']." ORDER BY SA.FECHA DESC LIMIT $empieza, $porPagina ");
				while ($fila = mysqli_fetch_array($sql)){ ?>	
					<tr>
						<td><?php echo  $fila['NOMBRE'] ?></td>
						<td><?php echo  $fila['TIPO1'] ?></td>
						<td><?php echo  $fila['FECHA'] ?></td>
						<td><?php echo  $fila['DOSISAPLICADA'] ?></td>
						<td><?php echo  $fila['SINTOMAS'] ?></td>
					</tr>
					<?php } ?>

			</tbody>
		</table>
		<div class="row">
			<div class="col ">
  				<ul class="pagination justify-content-center">
   				<?php 
						$query = mysqli_query($conexion,"SELECT * FROM SANIDADANIMAL WHERE IDANIMAL =".$_GET['HistorialAnimal']);
						$totalRegistros = mysqli_num_rows($query);
						$totalPagina = ceil($totalRegistros / $porPagina);
						 ?>
					<li class="page-item"> <a class="page-link" href="Historial.php?pagina=1&HistorialAnimal=<?php echo $_GET['HistorialAnimal'] ?>">Primera</a></li>
						 <?php 
						

						 for ($i=1; $i <= $totalPagina ; $i++) { 

						 	?>
					<li class="page-item"><a class="page-link active>" href="Historial.php?pagina=<?php echo $i ?>&HistorialAnimal=<?php echo $_GET['HistorialAnimal'] ?>"><?php echo $i ?></a></li>
				
					<li class="page-item"><a class="page-link >" href="Historial.php?pagina=<?php echo $i ?>&HistorialAnimal=<?php echo $_GET['HistorialAnimal'] ?>"><?php echo $i ?></a></li>
							<?php
						
						} ?>
					<li class="page-item "> <a class="page-link" href="Historial.php?pagina=<?php echo $totalPagina ?>&HistorialAnimal=<?php echo $_GET['HistorialAnimal'] ?>">Última</a></li>
				</ul>
				<h6>Página <b><?php echo $pagina ?></b> de <b><?php echo $totalPagina ?></b></h6>
			</div>
		</div>
					
	</div>
</div>
<hr>

