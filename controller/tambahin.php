<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');

$jam = date("Y-m-d H:i:s");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $idUser = $_GET['idTelegram'];
    $cek = mysqli_query($conn, "SELECT * FROM dataPelanggan WHERE idTelegram='$idUser'");
    if ($cek->num_rows > 0) {
        $datad = mysqli_fetch_array($cek);
        $nama = $datad['nama'];
        $cekAntrian = mysqli_query($conn, "SELECT no FROM dataService WHERE idTelegram='' ORDER BY no ASC LIMIT 1");
        if ($cekAntrian->num_rows > 0) {
            $cekDataPelanggan = mysqli_query($conn, "SELECT * FROM dataService WHERE idTelegram='$idUser'");
            if ($cekDataPelanggan->num_rows > 0) {
                echo "AC ANDA SEDANG DI SERVICE";
            } else {
                $data = mysqli_fetch_array($cekAntrian);                
                mysqli_query($conn, "UPDATE dataPelanggan SET notif='',tanggal='$jam' WHERE idTelegram='$idUser'");
                mysqli_query($conn, "UPDATE dataService SET idTelegram='$idUser', nama='$nama', tanggal='$jam', status='Menunggu' WHERE no='$data[no]'");

                echo "AC ANDA AKAN SEGERA DI SERVICE";
            }
        } else {
            echo "ANTRIAN SERVICE AC SEDANG PENUH";
        }
    } else {
        echo "ID Telegram tidak ditemukan dalam database pelanggan";
    }
}
?>
