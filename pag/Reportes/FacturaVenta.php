<?php
header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=documento.pdf");
readfile("Factura_Venta_Animal.pdf");
?>
