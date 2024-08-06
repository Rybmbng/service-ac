<?php
include 'config.php';
$sql = "SELECT * FROM perpanjangan";
$result = $conn->query($sql);
header('Content-Type: text/plain');

if ($result->num_rows > 0) {
    $data = "";
    while ($row = $result->fetch_assoc()) {
        echo $data = "ID:" . $row['idTelegram']."\n";
        echo $data = "Nama: ".$row['nama']."\n";
        echo $data = "Nama: \n";
        echo $data = "Tanggal:".$row['tanggal']."."."\n";
    }
    $conn->close();
}

?>
