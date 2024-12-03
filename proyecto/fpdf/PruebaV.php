<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root";
$pass = "";
$db   = "tienda_basica";

$conexion = mysqli_connect($host, $user, $pass, $db);
if (!$conexion) 
    die("Connection failed: " . mysqli_connect_error());

require('./fpdf.php');

class PDF extends FPDF
{
   // Cabecera de página
   function Header()
   {
      $this->Image('logo.png', 185, 5, 20); //logo de la empresa
      $this->SetFont('Arial', 'B', 19);
      $this->Cell(45); // Mover a la derecha
      $this->SetTextColor(0, 0, 0);
      $this->Cell(110, 15, utf8_decode('DECORANDO'), 1, 1, 'C', 0);
      $this->Ln(3); 
      $this->SetTextColor(103); 
      $this->SetTextColor(228, 100, 0);
      $this->Cell(50); 
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE CORTINAS "), 0, 1, 'C', 0);
      $this->Ln(7);

      // Campos de la tabla
      $this->SetFillColor(228, 100, 0);
      $this->SetTextColor(255, 255, 255);
      $this->SetDrawColor(163, 163, 163);
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(18, 10, utf8_decode('id'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('descripcion'), 1, 0, 'C', 1); 
      $this->Cell(25, 10, utf8_decode('stock'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('precioVenta'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('status'), 1, 0, 'C', 1); 
      $this->Cell(30, 10, utf8_decode('id_cat'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15);
      $this->SetFont('Arial', 'I', 8);
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
      $this->SetY(-15);
      $this->SetFont('Arial', 'I', 8);
      $hoy = date('d/m/Y');
      $this->Cell(0, 10, utf8_decode($hoy), 0, 0, 'C');
   }
}

// Crear una nueva instancia del PDF
$pdf = new PDF('P', 'mm', 'A4');
$pdf->SetMargins(10, 10, 10); // Márgenes
$pdf->AddPage();
$pdf->AliasNbPages();

// Consulta para obtener los datos de la tabla cortinas
$sql = "SELECT * FROM inventario";
$consulta_reporte_cortinas = $conexion->query($sql);

if ($consulta_reporte_cortinas) {
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetDrawColor(163, 163, 163);
    $pdf->Ln(20); // Salto de línea después de la cabecera
    
    while ($fila = $consulta_reporte_cortinas->fetch_assoc()) {
      $pdf->Cell(18, 10, utf8_decode($fila['id']), 1, 0, 'C', 0);
      $pdf->Cell(40, 10, utf8_decode($fila['descripcion']), 1, 0, 'C', 0); 
      $pdf->Cell(25, 10, utf8_decode($fila['stock']), 1, 0, 'C', 0);
      $pdf->Cell(30, 10, utf8_decode($fila['precioVenta']), 1, 0, 'C', 0);
      $pdf->Cell(40, 10, utf8_decode($fila['status']), 1, 0, 'C', 0);
      $pdf->Cell(30, 10, utf8_decode($fila['id_cat']), 1, 1, 'C', 0);  // Corregido
  }
  
      }
   else {
      echo "Error en la consulta: " . mysqli_error($conexion);
  }
  
  // Generar el archivo PDF
  $pdf->Output('Prueba.pdf', 'I'); // nombreDescarga, Visor(I->visualizar - D->descargar)
  
  mysqli_close($conexion); // Cerrar la conexión
  ?>