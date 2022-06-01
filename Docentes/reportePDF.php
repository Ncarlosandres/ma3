<?php


require("../Includes/fpdf/fpdf.php");

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    $this->Image('Pics/Logo.png',20,5,20);
    // Helvetica bold 15
    $this->SetFont('Helvetica','B',20);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10,'REPORTE DOCENTES',0,0,'C');
    // Salto de línea
    
    $this->Ln(20);
    $this->SetFont('Helvetica','B',9);
    $this->Cell(15, 10, utf8_decode('Legajo'), 1, 0, 'C', 0);
    $this->Cell(50, 10, utf8_decode('Apellido'), 1, 0, 'C', 0);
    $this->Cell(27, 10, utf8_decode('Teléfono'), 1, 0, 'C', 0);
    $this->Cell(50, 10, utf8_decode('Domicilio'), 1, 0, 'C', 0);
    $this->Cell(18, 10, utf8_decode('H. Entrada'), 1, 0, 'C', 0);
    $this->Cell(18, 10, utf8_decode('H. Salida'), 1, 1, 'C', 0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Pagina ').$this->PageNo().'/{nb}',0,0,'C');
}
}
#Creamos el objeto pdf (con medidas en milímetros):
$pdf = new FPDF('P', 'mm', 'A4');

#Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetMargins(60, 45 , 30);

#Establecemos el margen inferior:
$pdf->SetAutoPageBreak(true,25);  

include('../Includes/conexion.php');
$consulta="SELECT * FROM personal WHERE legajo > '1098'";
$resultado = mysqli_query($conexion, $consulta);
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
while ($fila = $resultado->fetch_assoc()){ 
    $pdf->Cell(15, 10, utf8_decode($fila['legajo']), 1, 0, 'L',0 );
    $pdf->Cell(50, 10, utf8_decode($fila['nombre']), 1, 0, 'L',0 );
    $pdf->Cell(27, 10, utf8_decode($fila['Telefono']), 1, 0, 'C',0 );
    $pdf->Cell(50, 10, utf8_decode($fila['Direccion']), 1, 0, 'L',0 );
    $pdf->Cell(18, 10, $fila['horaentrada'], 1, 0, 'C', 0);
    $pdf->Cell(18, 10, $fila['horasalida'], 1, 1, 'C', 0);        
}


$pdf->Output();
?>