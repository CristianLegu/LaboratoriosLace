<?php
   
    $idpac = 0;
    
    if(isset($_GET['c'])){
        $array = $_GET['c'];
    }  
        if(isset($_GET['idpaciente'])){
            $idpac = $_GET['idpaciente'];
        }
    
    	if(isset($_GET['print'])){
            include('includes/alert_memb.php');
        }
	    if(isset($_GET['email'])){
            header("Location: recupera.php?array=".serialize($array)."&idpac=".$idpac);
           
        } 

    
    
?>