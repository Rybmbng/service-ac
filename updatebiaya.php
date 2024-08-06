<?php
include_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $biaya = $_POST['biaya'];
    $harga = $_POST['harga'];

    $total = $biaya+$harga;
    $sql = "UPDATE dataService SET biaya='$total' WHERE idTelegram='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Biaya berhasil diperbarui!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);
    header("Location: indexteknisi.php");
}
?>
