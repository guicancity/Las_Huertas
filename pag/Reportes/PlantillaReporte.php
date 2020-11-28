<?php 
	require('../../fpdf/fpdf.php');
		class PDF extends FPDF{
			function Header(){
				require('../../metodos/conexion.php');
				$sql = "SELECT * FROM DATOSEMPRESA";
				$ejecuta = mysqli_query($conexion,$sql);
				$fila = mysqli_fetch_array($ejecuta);
				//'../imagenes/logoEmpresa.jpg'
				 $razonSocial = $fila['RAZONSOCIAL'];
				$imagen = $fila['LOGO'];
				$direccion = $fila['DIRECCION'];
				$telefono = $fila['TELEFONO'];
				date_default_timezone_set('UTC');
				
				$this->SetFont('Arial','B',10);
				$this->Cell(20,10,utf8_decode("Fecha de facturación:").date('d/M/Y'));
				$this->Ln(30);
				$this->Image('../imagenes/logoEmpresa.jpg', 5, 20, 30);
				$this->SetFont('Arial','B',25);
				$this->Cell(30);
				$this->Cell(120,10,utf8_decode($razonSocial),0,1,'C');
				$this->SetFont('Arial','B',15);
				$this-> SetFillColor(205, 205, 205);
				$this->Cell(30);
				$this->Cell(120,10, 'FACTURA DE VENTA',0,0,'C',);
				$this->Ln(20);

				$this->SetFont('Arial','B',12);
				$this->Cell(24,5,utf8_decode("Dirección: "),0,0,"R", true);
				$this->SetFont('Arial','',12);
				$this->Cell(40,5,utf8_decode($direccion),0,0,"R");

				$this->SetFont('Arial','B',12);
				$this->Cell(22,5,utf8_decode("Telefono: "),0,0,"R",true);
				$this->SetFont('Arial','',12);
				$this->Cell(40,5,utf8_decode($telefono),0,0);

				$this->Ln(5);


			}




			function Footer(){
				$this->SetY(-15);
				$this->SetFont('Arial','I',10);
				$this->Cell(0,10,utf8_decode('Pagína').$this->PageNo().'/{nb}',0,0,'C');
				$this->Ln(20);
				$this->Cell(170,20,utf8_decode('2020 Güicán de la sierra |'),0,0,'C');
				$this->SetFont('Arial','I', 8);
				
			}
			
		}
	
 ?>