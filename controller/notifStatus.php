<?php
include 'config.php';
$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT *FROM dataService WHERE idTelegram='$id'");
if ($sql->num_rows > 0) {
    $data = "";
    while ($row = $sql->fetch_assoc()) {
        header('Content-Type: text/plain');
        echo $data = "status:".$row['status'];
        echo $data = "ID:".$row['idTelegram'];
        echo $data = "Nama:".$row['nama'];
        echo $data = "Teknisi:".$row['teknisi'];
        echo $data = "Tanggal:".$row['tanggal']."\n";
    }
    }else{        
        header('Content-Type: text/plain');
        echo $data = "status:";
        echo $data = "ID:";
        echo $data = "Nama: ";
        echo $data = "Tanggal:"."\n";
    }
$conn->close();
?>
