<?php
include 'config.php';
$sql = "SELECT * FROM selesai";
$result = $conn->query($sql);
header('Content-Type: text/plain');

if ($result->num_rows > 0) {
    $data = "";
    while ($row = $result->fetch_assoc()) {
        echo $data = "ID:" . $row['idTelegram']."\n";
        echo $data = "Nama: ".$row['nama']."\n";
        echo $data = "Teknisi: ".$row['teknisi']."\n";  
        echo $data = "Biaya:".$row['biaya']."\n";  
        echo $data = "Jenis:".$row['jenis']."\n";   
        echo $data = "Tanggal:".$row['tanggal']."."."\n"; 
   }
    $conn->close();
}

?>
