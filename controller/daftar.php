<?php
include_once 'config.php';

$id = $_GET['id'];
$nama = $_GET['nama'];
$sql = mysqli_query($conn, "INSERT INTO login set nama='$nama',idTelegram='$id'");

?>