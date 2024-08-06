<?php
include 'config.php';
$id = $_GET['id'];
$state = "tidak_terdaftar"; 
$sql = mysqli_query($conn, "SELECT * FROM dataService WHERE idTelegram='$id'");
$sqlNomor = "SELECT no FROM dataService WHERE idTelegram='' ORDER BY no ASC LIMIT 1";
$datas = mysqli_query($conn, "SELECT * FROM login WHERE idTelegram='$id'");
if ($datas->num_rows > 0) {
    $state = "terdaftar";
}

if ($sql->num_rows > 0) {
    echo "Slot:sudah\n";
    echo "status:" . $state . "\n";
} else {
    $cekAntrian = mysqli_query($conn, $sqlNomor);
    if ($cekAntrian->num_rows > 0) {
        echo "Slot:kosong\n";
        echo "status:" . $state . "\n";
    } else {
        echo "Slot:penuh\n";
        echo "status:" . $state . "\n";
    }
}

$conn->close();
?>
