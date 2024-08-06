<?php
include_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idTelegram'])) {
    $id = $_GET['idTelegram'];
    date_default_timezone_set('Asia/Jakarta');
    $jam = date("Y-m-d H:i:s");

    $sql = "UPDATE dataPelanggan SET Notif='', tanggal='$jam' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_affected_rows($conn) > 0) {
        echo "SUCCESS";
    } else {
        echo "FAIL";
    }
}
?>