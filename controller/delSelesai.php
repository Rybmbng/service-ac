<?php
include_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
$sql = mysqli_query($conn,"DELETE FROM `selesai` WHERE 1");
if($sql){
    echo "Berhasil";
}else{
    echo"gagal";
}
}
$conn->close();
?>

