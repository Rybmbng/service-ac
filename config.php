<?php
$host = "localhost";
$username = "root";
$pass = "";
$db = "rozi";
$conn = new mysqli($host,$username,$pass,$db);
if(!$conn){
    echo "not connect";
}
?>