<?php
include_once 'config.php';

$id = $_GET['id'];

$sql = mysqli_query($conn, "SELECT *FROM dataservice WHERE idTelegram='$id'");
$data = mysqli_fetch_array($sql);
$nama = $_SESSION['username'];
$sqld = mysqli_query($conn,"SELECT *FROM login WHERE username='$nama'");
$datas = mysqli_fetch_array($sqld);
$namas = $datas['nama'];  
mysqli_query($conn, "UPDATE `dataService` SET teknisi = '$namas',status='Proses' WHERE idTelegram='$id'");


mysqli_query($conn, "INSERT INTO proses SET idTelegram='$id',nama='$data[nama]',teknisi='$namas',tanggal='$data[tanggal]'");
echo("Nama : ".$data['nama']." | ID : ".$data['idTelegram']." | Status : ". $data['status']);

echo"success";
$_SESSION["proses"] = 'AC Sedang Di Perbaiki';	 

?>