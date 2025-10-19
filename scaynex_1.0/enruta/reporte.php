<?php

include '../data/conexion.php';
require '../data/conexion.php';

$us = $_GET['us'];

require('fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('./img/logo.png',10,8,20);
    // Arial bold 15
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,5,utf8_decode('ENTREGAS A RENDIR A LA FECHA '),0,0,'C');
   
   $current_date = date('Y-m-d');
    $this->Cell(0, 5, "Fecha: $current_date", 0, 1, 'R');





$this->Ln(5);
$this->Cell(30,10,utf8_decode('______________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________'),0,0,'C');
    // Salto de línea
    $this->Ln(15);

$this->SetFont('Arial','B',8);
$this->Cell(16,9,'FECHA',1,0,'C',0);
$this->Cell(15,9,'KM',1,0,'C',0);
$this->Cell(10,9,'COMP',1,0,'C',0);
$this->Cell(20,9,'# COMP ',1,0,'C',0);
$this->Cell(45,9,'CONCEPTO',1,0,'L',0);
$this->Cell(45,9,'OBERVACION',1,0,'C',0);
$this->Cell(20,9,'IMPORTE',1,0,'C',0);
$this->Cell(20,9,'SUELDO',1,1,'C',0);

}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'C');

}
}




$consulta="
SELECT gastosxuser.id_responsable, gastosxuser.*
FROM gastosxuser
WHERE (((gastosxuser.id_responsable)=$us));


";
$resultado = mysqli_query($conexion,$consulta);


// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',8);


 
while ($row = $resultado->fetch_assoc()) {
$pdf->Cell(16,7,$row['fecha_registro'],1,0,'C',0);
$pdf->Cell(15,7,$row['kilometraje'],1,0,'C',0);
$pdf->Cell(10,7,$row['abrev'],1,0,'C',0);
$pdf->Cell(20,7,$row['num_doc'],1,0,'L',0);
$pdf->Cell(45,7,$row['concepto'],1,0,'L',0);
$pdf->Cell(45,7,$row['observacion'],1,0,'L',0);
$pdf->Cell(20,7,$row['importe'],1,0,'R',0);
$pdf->Cell(20,7,$row['salario'],1,1,'R',0);
}

$pdf->Ln(10);
$pdf->SetFont('Times','',10);

$consultaUS="
SELECT usuarios.user_nombre, usuarios.id_user
FROM usuarios
WHERE (((usuarios.id_user)=$us))
";
$resultadoUS = mysqli_query($conexion,$consultaUS);
$rowUS = $resultadoUS->fetch_assoc();
$pdf->Cell(0, 7,$rowUS['user_nombre'], 1, 1, 'R');

$consulta5="
SELECT ledger.estado, ledger.id_responsable, Sum(ledger.salario) AS SumaDesalario
FROM ledger
GROUP BY ledger.estado, ledger.id_responsable
HAVING (((ledger.estado)='R') AND ((ledger.id_responsable)=$us))
";
$resultado5 = mysqli_query($conexion,$consulta5);
$row5 = $resultado5->fetch_assoc();
$pdf->Cell(150, 7,"TOTAL A CTA DE SUELDO:", 0, 0, 'R');
$pdf->Cell(0, 7,$row5['SumaDesalario'], 1, 1, 'R');


$consulta2="
SELECT usuarios.id_user, ingreso_xuser.SumaDeimporte AS INGRESOS
FROM usuarios LEFT JOIN ingreso_xuser ON usuarios.id_user = ingreso_xuser.id_responsable
WHERE (((usuarios.id_user)=$us))
";
$resultado2 = mysqli_query($conexion,$consulta2);
$row2 = $resultado2->fetch_assoc();
$pdf->Cell(150, 7,"TOTAL INGRESOS A RENDIR:", 0, 0, 'R');
$pdf->Cell(0, 7,$row2['INGRESOS'], 1, 1, 'R');



$consulta3="
SELECT usuarios.id_user, egreso_xuser.SumaDeimporte AS EGRESOS
FROM usuarios LEFT JOIN egreso_xuser ON usuarios.id_user = egreso_xuser.id_responsable
WHERE (((usuarios.id_user)=$us))
";
$resultado3 = mysqli_query($conexion,$consulta3);
$row3 = $resultado3->fetch_assoc();
$pdf->Cell(150, 7,"TOTAL EGRESOS REGISTRADOS:", 0, 0, 'R');
$pdf->Cell(0, 7,$row3['EGRESOS'], 1, 1, 'R');



$consulta4="
SELECT usuarios.id_user, saldo_xuser.SumaDeimporte AS SALDO
FROM usuarios LEFT JOIN saldo_xuser ON usuarios.id_user = saldo_xuser.id_responsable
WHERE (((usuarios.id_user)=$us))
";
$resultado4 = mysqli_query($conexion,$consulta4);
$row4 = $resultado4->fetch_assoc();
$pdf->Cell(150, 7,"TOTAL SALDO A LA FECHA:", 0, 0, 'R');
$pdf->Cell(0, 7,$row4['SALDO'], 1, 1, 'R');




$pdf->Output();

?>