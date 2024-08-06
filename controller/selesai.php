<?php
include_once 'config.php';
$id = $_GET['id'];
date_default_timezone_set('asia/jakarta');
$jam =  date("Y-m-d H:i:s");

$sqld = mysqli_query($conn,"SELECT *FROM login WHERE username='$_SESSION[username]'");
$datas = mysqli_fetch_array($sqld);
$namas = $datas['nama'];

$sql = mysqli_query($conn, "SELECT *FROM dataservice WHERE idTelegram='$id'");
$data = mysqli_fetch_array($sql);
mysqli_query($conn, "INSERT INTO riwayat SET jenis='$data[jenis]',biaya='$data[biaya]',idTelegram='$id', nama='$data[nama]', jamMulai='$data[tanggal]',teknisi='$namas', jamSelesai='$jam',diskon='$data[diskon]'");
mysqli_query($conn, "UPDATE `dataService` set  idTelegram='', nama='', tanggal='', status='' WHERE no='$data[no]'");
mysqli_query($conn, "INSERT INTO selesai SET  jenis='$data[jenis]',biaya='$data[biaya]',idTelegram = '$id',nama='$data[nama]',teknisi='$namas',tanggal='$jam'");

$cekData = mysqli_query($conn, "SELECT tanggal FROM dataPelanggan WHERE idTelegram='$id'");
if($cekData->num_rows > 0){
mysqli_query($conn, "UPDATE dataPelanggan SET tanggal='$jam', notif='' WHERE idTelegram='$id'");
echo "UPDATE";
}else{
mysqli_query($conn, "INSERT INTO dataPelanggan SET idTelegram = '$data[idTelegram]',tanggal='$jam',nama='$data[nama]', notif='yes'");
echo "INSERT";
}

$_SESSION["proses"] = 'AC Selesai Di Perbaiki';	 

?>