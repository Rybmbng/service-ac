<?php
include_once 'config.php';

$id = $_GET['id'];

$sql = mysqli_query($conn, "SELECT *FROM dataservice WHERE idTelegram='$id'");
$data = mysqli_fetch_array($sql);

mysqli_query($conn, "UPDATE `dataService` SET status='Menunggu' WHERE idTelegram='$id'");
echo"success";
$_SESSION["proses"] = 'AC Sedang Di Perbaiki';	 

?>