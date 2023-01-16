<?php

    function getCurrentDate($timezone, $format, $additionalMinutes = 0){
        
        date_default_timezone_set($timezone);

        if($format == "Y-m-d"){
            $currentDate = date('Y-m-d');
        }else if($format == "Y-m-d H:i"){
            // ADD N° MINUTES TO DATE 
            $currentDate = date('Y-m-d H:i', (time() + 60 * $additionalMinutes));
        }else{
            $currentDate = date();
        }

    	return $currentDate;
    }
    
    function convertDate($string){
        
        $date = date("Y-m-d H:i", strtotime($string));
        return $date;
    }

?>