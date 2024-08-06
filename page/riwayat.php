<?php
require 'vendor/autoload.php';

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Type;

// Make sure the database connection is established here
$conn = mysqli_connect('localhost', 'root', '', 'rozi');
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

function exportXLS($conn, $filterQuery) {
    $writer = WriterEntityFactory::createXLSXWriter();
    $writer->openToBrowser('riwayat_' . date('Y-m-d') . '.xlsx');

    $header = [
        WriterEntityFactory::createCell('ID Telegram'),
        WriterEntityFactory::createCell('Nama'),
        WriterEntityFactory::createCell('Layanan'),
        WriterEntityFactory::createCell('Jam Mulai'),
        WriterEntityFactory::createCell('Jam Selesai'),
        WriterEntityFactory::createCell('Biaya'),
        WriterEntityFactory::createCell('Teknisi')
    ];
    $headerRow = WriterEntityFactory::createRow($header);
    $writer->addRow($headerRow);

    $sql = mysqli_query($conn, "SELECT * FROM riwayat $filterQuery");
    if (!$sql) {
        die('Error executing query: ' . mysqli_error($conn));
    }

    while ($data = mysqli_fetch_array($sql)) {
        $row = [
            WriterEntityFactory::createCell($data['idTelegram']),
            WriterEntityFactory::createCell($data['nama']),
            WriterEntityFactory::createCell(getLayanan($data['jenis'])),
            WriterEntityFactory::createCell($data['jamMulai']),
            WriterEntityFactory::createCell($data['jamSelesai']),
            WriterEntityFactory::createCell('Rp.' . $data['biaya']),
            WriterEntityFactory::createCell(ucwords($data['teknisi']))
        ];
        $writer->addRow(WriterEntityFactory::createRow($row));
    }

    $writer->close();
    exit();
}

function getLayanan($jenis) {
    switch ($jenis) {
        case 1: return 'Cuci AC';
        case 2: return 'Bongkar Pasang';
        case 3: return 'Ganti Kapasitor, Jasa AC dan Freon AC';
        default: return 'Unknown';
    }
}

$filterQuery = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['filter'])) {
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $filterQuery = "WHERE DATE(jamMulai) BETWEEN '$startDate' AND '$endDate'";
    } elseif (isset($_POST['export_xls'])) {
        exportXLS($conn, $filterQuery);
    }
}
?>


<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?admin=home">Home</a></li>
            <li class="breadcrumb-item active">Riwayat</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">
    <div class="row">
        <div class="card-body">
            <form method="post" action="">
                <div class="row">
                    <div class="col-md-4">
                        <label for="startDate">Mulai Tanggal:</label>
                        <input type="date" id="startDate" name="startDate" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="endDate">Sampai Tanggal:</label>
                        <input type="date" id="endDate" name="endDate" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <button type="submit" name="filter" class="btn btn-primary form-control">Filter</button>
                    </div>
                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <button type="submit" name="export_xls" class="btn btn-success form-control">Export XLS</button>
                    </div>
                </div>
            </form>
            <br>
            <table class="table table-borderless datatable">
                <thead>
                    <tr>
                        <th scope="col">ID Telegram</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Layanan</th>
                        <th scope="col">Jam Mulai</th>
                        <th scope="col">Jam Selesai</th>
                        <th scope="col">Biaya</th>
                        <th scope="col">Teknisi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = mysqli_query($conn, "SELECT * FROM riwayat $filterQuery");
                if (!$sql) {
                    echo '<tr><td colspan="7">No data found</td></tr>';
                } else {
                    while ($data = mysqli_fetch_array($sql)) {
                ?>
                    <tr>
                        <th scope="row"><?php echo htmlspecialchars($data['idTelegram']); ?></th>
                        <th scope="row"><?php echo htmlspecialchars($data['nama']); ?></th>
                        <?php 
                        if ($data['jenis'] == 1) {
                            echo "<th scope='row'>Cuci AC</th>";
                        }
                        if ($data['jenis'] == 2) {
                            echo "<th scope='row'>Bongkar Pasang</th>";
                        }
                        if ($data['jenis'] == 3) {
                            echo "<th scope='row'>Ganti Kapasitor, Jasa AC dan Freon AC</th>";
                        }
                        ?>
                        <th scope="row"><?php echo htmlspecialchars($data['jamMulai']); ?></th>
                        <th scope="row"><?php echo htmlspecialchars($data['jamSelesai']); ?></th>
                        <th scope="row">Rp.<?php echo htmlspecialchars($data['biaya']); ?></th>
                        <th scope="row"><?php echo htmlspecialchars(ucwords($data['teknisi'])); ?></th>
                    </tr>
                <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
