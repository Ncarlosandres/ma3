<?php
require("../Includes/fpdf/fpdf.php");
class PDF extends FPDF
{
// Cabecera de página
    function Header()
    {
        $this->Image('Pics/Logo.png',20,5,15);
        // Helvetica bold 15
        $this->SetFont('Helvetica','B',20);
        // Movernos a la derecha
        $this->Cell(50);
        // Título
        $this->Cell(70,10,'REPORTE USUARIOS SISTEMA',0,0,'C');
        // Salto de línea
        $this->Ln(20);
        $this->SetFont('Helvetica','B',10);
        $this->Cell(50, 10, utf8_decode('Apellido y Nombre'), 1, 0, 'C', 0);
        $this->Cell(30, 10, utf8_decode('Usuario'), 1, 0, 'C', 0);
        $this->Cell(25, 10, utf8_decode('Direccion'), 1, 0, 'C', 0);
        $this->Cell(35, 10, utf8_decode('Email'), 1, 0, 'C', 0);
        $this->Cell(25, 10, utf8_decode('Credenciales'), 1, 1, 'C', 0);
    }
// Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',11);
        // Número de página
        $this->Cell(0,20,utf8_decode('Pagina ').$this->PageNo().'/{nb}',0,0,'C');
    }
}
include('../Includes/conexion.php');
$consulta="SELECT * FROM usu_pass ORDER BY nombre";
$resultado = $conexion->query($consulta);
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
while ($fila = $resultado->fetch_assoc()){ 
    $pdf->Cell(50, 10, utf8_decode($fila['apellidoynombre']), 1, 0, 'L',0 );
    $pdf->Cell(30, 10, utf8_decode($fila['nombre']), 1, 0, 'C',0 );
    $pdf->Cell(25, 10, utf8_decode($fila['direccion']), 1, 0, 'C', 0);
    $pdf->Cell(35, 10, utf8_decode($fila['email']), 1, 0, 'C', 0);
    if ($fila['rol']==TRUE) {
            $mostrar='Administrador';}
    else    { $mostrar='Usuario';}
    $pdf->Cell(25, 10, $mostrar, 1, 1, 'C', 0);
}


$pdf->Output();
?>