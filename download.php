<?php
require('inc/db.php');
require('fpdf.php');

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

$search_query = "";
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
}

$query = "SELECT * FROM laporan INNER JOIN users ON laporan.user_id = users.id";

if (!empty($search_query)) {
    $query .= " WHERE tanggal LIKE '%$search_query%' OR alamat_awal LIKE '%$search_query%' OR alamat_tujuan LIKE '%$search_query%' OR username LIKE '%$search_query%'";
}

$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Nama file
    $filename = "laporan_perjalanan_" . date('Ymd') . ".pdf";

    // Set header untuk file PDF
    header("Content-type: application/pdf");
    header("Content-Disposition: attachment; filename=$filename");

    // Buat objek PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Tulis header
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'User');
    $pdf->Cell(40, 10, 'Tanggal');
    $pdf->Cell(40, 10, 'Alamat Awal');
    $pdf->Cell(40, 10, 'Alamat Tujuan');
    $pdf->Cell(40, 10, 'KM Awal');
    $pdf->Cell(40, 10, 'KM Akhir');
    $pdf->Cell(40, 10, 'Total KM');
    $pdf->Cell(40, 10, 'Foto');
    $pdf->Ln();

    // Tulis data dari database
    while ($row = $result->fetch_assoc()) {
        $total_km = $row['km_akhir'] - $row['km_awal'];
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(40, 10, $row['username']);
        $pdf->Cell(40, 10, $row['tanggal']);
        $pdf->Cell(40, 10, $row['alamat_awal']);
        $pdf->Cell(40, 10, $row['alamat_tujuan']);
        $pdf->Cell(40, 10, $row['km_awal']);
        $pdf->Cell(40, 10, $row['km_akhir']);
        $pdf->Cell(40, 10, $total_km);
        $pdf->Cell(40, 10, $row['foto']);
        $pdf->Ln();
    }

    // Output PDF
    $pdf->Output();
    exit;
} else {
    echo "<p>Tidak ada data yang dapat diunduh.</p>";
}
?>