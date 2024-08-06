<?php
require 'vendor/autoload.php';
use Fpdf\Fpdf;

// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rozi";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the filtered data from the form submission
$startDate = isset($_POST['startDate']) ? $_POST['startDate'] : '';
$endDate = isset($_POST['endDate']) ? $_POST['endDate'] : '';

// Perform the database query to fetch the filtered data
$sql = mysqli_query($conn, "SELECT * FROM riwayat WHERE tanggal BETWEEN '$startDate' AND '$endDate'");
if (!$sql) {
    die("Query failed: " . mysqli_error($conn));
}
$data = mysqli_fetch_all($sql, MYSQLI_ASSOC);

// Generate the PDF
$pdf = new Fpdf();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, 'Filtered Data');
$pdf->Ln(10);

// Output the data in the PDF
foreach ($data as $row) {
    $pdf->Cell(40, 10, $row['idTelegram']);
    $pdf->Cell(40, 10, $row['nama']);
    $pdf->Cell(40, 10, $row['jenis']);
    $pdf->Cell(40, 10, $row['jamMulai']);
    $pdf->Cell(40, 10, $row['jamSelesai']);
    $pdf->Cell(40, 10, $row['biaya']);
    $pdf->Cell(40, 10, $row['teknisi']);
    $pdf->Ln(10);
}

// Output the PDF to the browser
$pdf->Output();
?>