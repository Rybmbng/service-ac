<?php
include 'config.php';

$durasi = 90;
$result = mysqli_query($conn, "SELECT * FROM dataPelanggan WHERE DATEDIFF(CURDATE(), tanggal) > $durasi");

header('Content-Type: text/plain');

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo $row['idTelegram'] . "," . $row['nama'] . "," . $row['tanggal'] . "," . $row['notif'] . "\n";
    }
} else {
    echo "No data found";
}
?>
