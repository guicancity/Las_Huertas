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
  <title>Las huertas || Facturas</title>
</head>
<body>

  <?php $sql = "
  SELECT 
  FACTURA.IDFACTURA, 
  FACTURA.IDPERSONAS, 
  FACTURA.CONSECUTIVOFACTURA, 
  FACTURA.CLIENTE, 
  FACTURA.VALORTOTAL, 
  DETALLEFACTURA.IDDETALLEFACTURA ,
  DETALLEFACTURA.IDANIMAL,
  DETALLEFACTURA.FECHAVENTA,
  DETALLEFACTURA.OBSERVACIONES,
  PERSONAS.IDPERSONAS,
  PERSONAS.NUMERODOCUMENTO,
  PERSONAS.NOMBRE1,
  PERSONAS.NOMBRE2,
  PERSONAS.APELLIDO1,
  PERSONAS.APELLIDO2,
  CONCAT(PERSONAS.NOMBRE1,' ',NULLIF(PERSONAS.NOMBRE2,''),' ',PERSONAS.APELLIDO1,' ',NULLIF(PERSONAS.APELLIDO2,'')) NOMBRECOMPLETO,
  PERSONAS.TELEFONO,
  ANIMAL2.IDANIMAL,
  ANIMAL2.IDPADRE,
  ANIMAL2.IDMADRE,
  (SELECT NUMEROCHAPA FROM ANIMAL WHERE IDANIMAL = ANIMAL2.IDPADRE) CHAPAPADRE,
  (SELECT NUMEROCHAPA FROM ANIMAL WHERE IDANIMAL = ANIMAL2.IDMADRE) CHAPAMADRE,
  ANIMAL2.NUMEROCHAPA,
  ANIMAL2.CATEGORIA,
  CASE WHEN ANIMAL2.CATEGORIA = 1 THEN 'VACA' ELSE 'OVEJA' END NOMBRECATEGORIA ,
  ANIMAL2.SEXO,
  ANIMAL2.FECHANACIMIENTO
  FROM ((FACTURA INNER JOIN DETALLEFACTURA ON FACTURA.IDFACTURA = DETALLEFACTURA.IDFACTURA) 
  INNER JOIN PERSONAS ON FACTURA.IDPERSONAS = PERSONAS.IDPERSONAS)
  INNER JOIN ANIMAL ANIMAL2 ON DETALLEFACTURA.IDANIMAL =ANIMAL2.IDANIMAL
  WHERE ANIMAL2.CATEGORIA =".$_SESSION['modulo'];    

  $ejecutaSql = mysqli_query($conexion,$sql); 
  ?>
  <div class="row">
    <div class="col mt-4 text-center">
      <h2>Facturas</h2>
    </div>
  </div>
  <div class="container-fluid mt-5">
    <table class="table table-striped table-bordered table-responsive-sm">
      <thead>
        <tr>
          <th>Factura No.</th>
          <th>Comprador</th>
          <th>vendedor</th>
          <th>Chapa/Nombre</th>
          <th>Sexo</th>
          <th>fecha Nacimiento</th>
          <th>fecha de venta</th>
          <th>valor total</th>
          <th>Actualizar</th>
          <th>Anular</th>
        </tr>
      </thead>

      <?php              
      while($fila = mysqli_fetch_array($ejecutaSql)){
        $facturaNumero = $fila['CONSECUTIVOFACTURA'];
        $comprador = $fila['CLIENTE'];
        $vendedor = strtoupper($fila['NOMBRECOMPLETO']);
        $chapaAnimal = $fila['NUMEROCHAPA'];
        $sexo = $fila['SEXO'];
        $fechaNacimiento = $fila['FECHANACIMIENTO'];
        $fechaVenta = $fila['FECHAVENTA'];
        $valorTotal = number_format($fila['VALORTOTAL'],0,",",".");
        $idAnimal = $fila['IDANIMAL'];

        ?>
        <tbody>
          <tr>
            <input type="hidden" value="<?php echo $idAnimal ?>" name="txtIdAnimal">
            <td><?php echo $facturaNumero ?></td>
            <td><?php echo $comprador ?></td>
            <td><?php echo $vendedor ?></td>
            <td><?php echo $chapaAnimal ?></td>
            <td><?php echo $sexo ?></td>
            <td><?php echo $fechaNacimiento ?></td>
            <td><?php echo $fechaVenta ?></td>
            <td>$ <?php echo $valorTotal ?></td>
            <td class="text-center"><a class="btn btn-outline-info" target="_blank" href="Reportes/FacturaVenta.php?idAnimal=<?php echo $fila['IDANIMAL'];?>"> <i class="fa fa-download fa-2x "></i></a></td>
            <td><button class="btn btn-outline-danger"> <i class="fa fa-ban fa-2x"></i></button></td>
          </tr>
        </tbody>

      <?php }



      ?>
    </table>

  </div>


</body>
</html>