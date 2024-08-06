<?php 
    $page = (isset($_GET['page']))?$_GET['page'] : '';
    switch($page){                              
        case 'riwayat':
                include './page/riwayat.php';
                $title = "riwayat";
                break;
                
        case 'users':
            include './page/users.php';
            $title = "users";
            break;   
        case 'Masuk':
            include './controller/masuk.php';
            $title = "masuk";
            break;
                
        case 'selesai':
            include './controller/selesai.php';
            $title = "selesai";
            break;  
            case 'pelanggan':
                include './page/pelanggan.php';
                $title = "pelanggan";
                break;
                
        default :
        include './page/home.php';
        break;    
        }
?>