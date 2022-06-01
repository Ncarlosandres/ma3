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
    $this->Cell(70,10,'REPORTE INASISTENCIAS',0,0,'C');
    // Salto de línea
    
    $this->Ln(20);
    $this->SetFont('Helvetica','B',9);
    $this->Cell(15, 10, utf8_decode('Legajo'), 1, 0, 'C', 0);
    $this->Cell(60, 10, utf8_decode('Apellido y Nombre'), 1, 0, 'C', 0);
    $this->Cell(30, 10, utf8_decode('Fecha'), 1, 0, 'C', 0);
    $this->Cell(27, 10, utf8_decode('Estado'), 1, 0, 'C', 0);
    $this->Cell(50, 10, utf8_decode('Observaciones'), 1, 1, 'C', 0);
    
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
$consulta="SELECT * FROM ausentes";
$resultado = mysqli_query($conexion, $consulta);
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
while ($fila = $resultado->fetch_assoc()){ 
    $pdf->Cell(15, 10, utf8_decode($fila['Legajo']), 1, 0, 'L',0 );
    $lega=$fila['Legajo'];
    $consulta2="SELECT nombre FROM personal WHERE legajo=".$lega." ";
    $resultado2 = mysqli_query($conexion, $consulta2);
    while ($fila2 = $resultado2->fetch_array()){
        $muestra=$fila2[0];
    }
    $pdf->Cell(60, 10, utf8_decode($muestra), 1, 0, 'L', 0);
    $pdf->Cell(30, 10, utf8_decode($fila['Fecha']), 1, 0, 'C',0 );
    $pdf->Cell(27, 10, utf8_decode($fila['Estado']), 1, 0, 'C',0 );
    $pdf->Cell(50, 10, $fila['Obsevaciones'], 1, 1, 'C', 0);        
}


$pdf->Output();
?>