<?php 
    $page = (isset($_GET['admin']))?$_GET['admin'] : '';
    switch($page){                              
        case 'pelanggan':
            include './page/pelanggan.php';
            break;
        case 'riwayat':
            include './page/riwayat.php';
            break;
                
        case 'proses':
            include './controller/proses.php';
            break;
                
        case 'selesai':
            include './controller/selesai.php';
            break;
                
        default :
        include './page/home.php';
        break;    
        }
?>