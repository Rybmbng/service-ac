<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');

$jam = date("Y-m-d H:i:s");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $idTelegram = isset($_GET['id']) ? trim($_GET['id']) : '';
    $longitude = isset($_GET['longitude']) ? trim($_GET['longitude']) : '';
    $latitude = isset($_GET['latitude']) ? trim($_GET['latitude']) : '';
    $jenis = isset($_GET['jenis']) ? trim($_GET['jenis']) : '';
    $ac = isset($_GET['ac']) ? trim($_GET['ac']) : '';
    if($jenis == 1){
        $harga = 75000 * $ac;
    }  
    if($jenis == 2){
        $harga = 350000 * $ac;
    } 
    if($jenis == 3){
        $harga = 250000 * $ac;
    }
    $fetchResult = mysqli_query($conn, "SELECT * FROM login WHERE idTelegram='$idTelegram'");
    $fetch = mysqli_fetch_assoc($fetchResult);

    if ($fetch) {
        $cekAntrian = mysqli_query($conn, "SELECT no FROM dataService WHERE idTelegram='' ORDER BY no ASC LIMIT 1");
        
        if ($cekAntrian->num_rows > 0) {
            $cekDataPelanggan = mysqli_query($conn, "SELECT * FROM dataService WHERE idTelegram='$idTelegram'");
            if ($cekDataPelanggan->num_rows > 0) {
                echo "AC ANDA SEDANG DI SERVICE";
            } else {
                $data = mysqli_fetch_array($cekAntrian);
                $no = $data['no'];
                $nama = $fetch['nama'];
                $updateQuery = "UPDATE `dataService` set  ac='$ac',idTelegram='$idTelegram', biaya='$harga',nama='$nama',longitude='$longitude',latitude='$latitude', tanggal='$jam',jenis='$jenis', status='Masuk' WHERE no='$data[no]'";
                mysqli_query($conn, $updateQuery);

                echo "AC ANDA AKAN SEGERA DI SERVICE";
            }
        } else {
            echo "ANTRIAN SERVICE AC SEDANG PENUH";
        }
    } else {
        echo "ID Telegram tidak ditemukan.";
    }

    echo $idTelegram;
    echo $nama;
    echo $diskonUser;
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
