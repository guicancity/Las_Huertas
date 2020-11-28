<!DOCTYPE html>
<?php
require('../metodos/conexion.php');
require_once('../metodos/sesionIniciada.php');
if($_SESSION['modulo'] == 1){
  $sql = mysqli_query($conexion,'SELECT * FROM MENU WHERE MODULO = 1 AND ACTIVO = 1 ORDER BY IDMENU');
  $colorMenu = 'bg-primary';
}elseif ($_SESSION['modulo'] == 2) {
  $sql = mysqli_query($conexion,'SELECT * FROM MENU WHERE MODULO = 2 AND ACTIVO = 1 ORDER BY IDMENU');
  $colorMenu = 'bg-info';
}else{
  $sql = mysqli_query($conexion,'SELECT * FROM MENU WHERE MODULO = 1 AND ACTIVO = 1 ORDER BY IDMENU');
  $colorMenu = 'bg-primary';
}
?>
<html>
<head>
  <?php 
  include_once("../metodos/links.php");
  ?>  
</head>
<body>

  <nav class="navbar navbar-expand-lg p-0">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  	<?php
      echo '<div id="navbarNavDropdown" class="collapse navbar-collapse '. ' '.$colorMenu.'">';
  	?>
      <ul class="navbar-nav ">
       <?php
          while ($fila = mysqli_fetch_array($sql)){
          $nombre = $fila['NOMBRE'];
          $url = $fila['DIRECCION'];
          echo '<li class="nav-item "> <a class="nav-link text-white p-4"  href="'.$url.'">'.$nombre.'</a> </li>';	
          }
      ?>
      <li class="nav-item "> <a class="nav-link text-white p-4"  href="InventarioProductos.php">INVENTARIO</a> </li>

      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white p-4" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            INFORMES y FACTURA</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a href="Reportes/V_RGeneralAnimales.php" class=" dropdown-item"> <i class="fa fa-file-excel"></i> GENERAL DE ANIMALES</a>
           <!-- <a href="Reportes.php" class=" dropdown-item">OTROS REPORTES</a> -->
           <div class="dropdown-divider"></div>
           <div class="dropdown-divider"></div>
           <a href="FacturasGeneradas.php" class=" dropdown-item">FACTURAS GENERADAS</a>
            <a href="#modalFactura" data-toggle="modal"  class=" dropdown-item modal-trigger pt-2 pb-2 bg-warning">GENERAR FACTURA</a>
           
        </div>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white p-4" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo strtoupper($_SESSION['nombre1']).' '.strtoupper($_SESSION['apellido1']) ?></a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a href="#modal1" data-toggle="modal"  class=" dropdown-item modal-trigger "><i class="fa fa-building"></i> Datos de la empresa</a>
            <a href="Modulo.php" class="dropdown-item"><i class="fa fa-list"></i> Selecciona módulo</a>
            <a href="Animales2.php" class="dropdown-item">Animales</a>
            <a href="Configuracion.php" class="dropdown-item"><i class="fa fa-cog"></i>
              Configuración</a>
            <div class="dropdown-divider"></div>
            <a class="bg-danger text-white dropdown-item pt-2 pb-3" href="../metodos/cerrarSesion.php"><i class="fa fa-sign-out-alt"></i> Cerrar sesión</a>
        </div>
      </li>

      </ul>
    </div>
  </nav>

<?php
$sqlEmpresa = mysqli_query($conexion,'SELECT * FROM DATOSEMPRESA');

$fila = mysqli_fetch_assoc($sqlEmpresa);
  $idDatosEmpresa = $fila['IDDATOSEMPRESA'];
  $razonSocial = $fila['RAZONSOCIAL'];
  $direccion = $fila['DIRECCION'];
  $telefono = $fila['TELEFONO'];
  $nit = $fila['NIT'];
  $logo = $fila['LOGO'];
?>

<!--INICIO modal actualización datos empresa -->

  <div id="modal1" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 >Datos de la empresa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
              </div>
            <div class="modal-body">
                <form class="col-md-11 ml-1" method="POST" action="menu.php" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col">
                      <input type="hidden" name="txtidempresa" value="<?php echo $idDatosEmpresa ?>">
                         <label for="txtRazonSocial">Nombre finca</label>
                        <input type="text" class="form-control" name="txtRazonSocial" value="<?php echo $razonSocial ?>">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <label for="txtDireccion">Dirección</label>
                        <input type="text" class="form-control" name="txtDireccion" value="<?php echo $direccion ?>">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <label for="txtTelefono">Teléfono</label>
                        <input type="number" class="form-control" name="txtTelefono" value="<?php echo $telefono ?>">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <label for="txtNit">Nit</label>
                        <input type="text" class="form-control" name="txtNit" value="<?php echo $nit ?>">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col pt-3 pb-3">
                        <label>seleccionar imagen</label>
                          <input type="file" name="imagen"  id="imagen">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col text-center mb-4 mt-3">
                        <input type="submit" name="btnActualizar" class="btn btn-success btn-lg" value="Actualizar">
                      </div>
                    </div>
                </form>
            </div>
        <div class="modal-footer">
          <p>Nota: Los datos digitados en esta ventana, se verán reflejados en la factura, por favor mantengalos actualizados</p>
        </div>
      </div>
      </div>
  </div>


<!--FIN modal actualización datos empresa -->
<?php //INICIO modal factura ?>
<div id="modalFactura" class="modal fade">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
              <div class="modal-header">
                <h4 >Facturar animal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
              </div>
            <div class="modal-body">
              <form  method="POST" >
                <div class="row">
                  <div class="col">
                    <label>Animal a vender</label>
                    <select name="sltIdAnimal" class="custom-select" >
                      <?php 
                      $sql = "SELECT IDANIMAL, NUMEROCHAPA FROM ANIMAL WHERE ESTADODESCARTE <> 1 AND CATEGORIA = ".$_SESSION['modulo'];
                      $ejecutar = mysqli_query($conexion,$sql );
                      while ($fila = mysqli_fetch_array($ejecutar)) {
                        $idAnimal = $fila['IDANIMAL'];
                        $chapaAnimal = $fila['NUMEROCHAPA']; ?>
                        <option value=" <?php echo $idAnimal ?> "><?php echo $chapaAnimal ?></option>
                      <?php }?>
                   </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <label>Nombre completo comprador</label>
                    <input type="text" class="form-control" name="txtComprador" required="">
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <label>Valor de venta</label>
                    <input type="number" class="form-control" name="txtvalor" required="">
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <label>Descripcion de la venta</label>
                    <textarea class="form-control" name="txtDescripcionF"></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col text-center">
                    <button class="btn mt-5 btn-success" name="btnGeneraFactura">GENERAR FACTURA</button>
                  </div>
                </div>
              </form>
            </div>
      </div>
      </div>
  </div>
  <?php //FIN modal factura ?>

<?php
if (isset($_POST['btnActualizar'])) { 
  $idempresaA = $_POST['txtidempresa'];
  $razonSocial = $_POST['txtRazonSocial'];
  $direccion = $_POST['txtDireccion'];
  $telefono = $_POST['txtTelefono'];
  $nit = $_POST['txtNit'];
  $nombreImagen = $_FILES['imagen']['name'];
  $extensionArchivo = explode ( "." , $nombreImagen);
  $dest = "imagenes/logoEmpresa.". $extensionArchivo[1];
  $archivo = $_FILES['imagen']['tmp_name'];
  copy($archivo, $dest);
  $sqlActualiza = "UPDATE DATOSEMPRESA SET RAZONSOCIAL = '$razonSocial', DIRECCION = '$direccion',TELEFONO = '$telefono',NIT = '$nit',LOGO = '$dest' WHERE IDDATOSEMPRESA = $idempresaA";
  $algo = 'vainilla';
  $ejecutar = mysqli_query($conexion, $sqlActualiza);
  
if ($ejecutar) {

 echo "
        <script> alert('¡¡Registro actualizado exitosamente!!');
                 window.open('../pag/Animales.php','_self');
        </script>";

}else{
  echo "
        <script> alert('¡¡ERROR al actualizar!!');
                 window.open('../pag/Animales.php','_self');
        </script>";

}
  
}


if(isset($_POST['btnGeneraFactura'])){
  $idanimalFactura = $_POST['sltIdAnimal'];
  $valorVenta = $_POST['txtvalor'];
  $descripcionFactura = $_POST['txtDescripcionF'];
  $fechaActual =   date("Y"). "/" . date("m") . "/" . date("d");
  $sqlconsecutivoFactura = "SELECT MAX(CONSECUTIVOFACTURA)CONSECUTIVO FROM FACTURA ";
  $fila = mysqli_fetch_assoc(mysqli_query($conexion,$sqlconsecutivoFactura));
  $consecutivoInsert = $fila['CONSECUTIVO'] + 1;
  $sessionId = $_SESSION['idUsuario'];
  $clienteNombre = strtoupper($_POST['txtComprador']);
  
  $sqlFactura = "INSERT INTO FACTURA(IDPERSONAS,CONSECUTIVOFACTURA,CLIENTE,VALORTOTAL) 
                        VALUES($sessionId,$consecutivoInsert,'$clienteNombre',0)";
  $ejecutaFactura = mysqli_query($conexion,$sqlFactura);

  $sqlidFactura = "SELECT IDFACTURA 
                   FROM FACTURA 
                   WHERE CLIENTE = '$clienteNombre' 
                      AND CONSECUTIVOFACTURA = $consecutivoInsert";
  $fila2 = mysqli_fetch_assoc(mysqli_query($conexion,$sqlidFactura));
  $idFactura = $fila2['IDFACTURA'];
  $sqlDetalleFactura = "INSERT INTO DETALLEFACTURA(IDFACTURA,IDANIMAL,VALOR,FECHAVENTA,OBSERVACIONES) 
                        VALUES ($idFactura,$idanimalFactura,$valorVenta,'$fechaActual','$descripcionFactura');";
  $ejecutaDetalleFactura = mysqli_query($conexion,$sqlDetalleFactura);
  $sqlUpdateValor = "UPDATE FACTURA SET VALORTOTAL = $valorVenta 
                     WHERE IDFACTURA = $idFactura";
  $ejecutaUpdateValor = mysqli_query($conexion,$sqlUpdateValor);

  $sqlActEstadoDescarte = mysqli_query($conexion,"UPDATE ANIMAL SET DESCRIPCIONMUERTE = 'Animal descartado por venta', ESTADODESCARTE = 1 WHERE IDANIMAL = $idanimalFactura" );
  
  echo "<script>window.open('./FacturasGeneradas.php','_self');</script>";
}


?>
</body>
</html