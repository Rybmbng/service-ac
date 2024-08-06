<?php 
    $page = (isset($_GET['page']))?$_GET['page'] : '';
    switch($page){                              
        case 'riwayat':
                $title = "Riwayat";
                break;
                
        case 'users':
            $title = "Users";
            break;   
        case 'Masuk':
            $title = "Masuk";
            break;
                
        case 'selesai':
            $title = "Selesai";
            break;  
            case 'pelanggan':
                $title = "Pelanggan";
                break;
                
        default :
        $title = "Dashboard";

        break;    
        }
?>