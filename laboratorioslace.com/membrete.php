<?php
    $idpac="";
    $idprop="";
    $idm = "";
    
    if(isset($_GET['idpac']) && isset($_GET['idpr']) && isset($_GET['idm'])){
        $idpac  = $_GET['idpac'];
        $idprop = $_GET['idpr'];
        $idm = $_GET['idm'];
        include('includes/alert_memb.php');
    }
    

    
?>