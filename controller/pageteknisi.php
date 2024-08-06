<?php 
    $page = (isset($_GET['page']))?$_GET['page'] : '';
    switch($page){         
        case 'proses':
            include './controller/proses.php';
            break;        
        case 'selesai':
            include './controller/selesai.php';
            break;
                                         
        default :
        include './pageteknisi/home.php';
        break;    
        }
?>