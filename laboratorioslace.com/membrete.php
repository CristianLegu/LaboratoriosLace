<?php
   
    
    
    if(isset($_GET['c'])){


        $array = $_GET['c'];

	    foreach( $_GET['c'] as $color){
	        //array_push($array, $color);
        }
     //   print_r($array);

        include('includes/alert_memb.php');
    }   

    
    
?>