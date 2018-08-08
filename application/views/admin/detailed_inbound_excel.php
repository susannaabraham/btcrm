<?php 
//print_r($user_details);
 echo "Sl.No.,From,To,Agent,Call Date,Call Count,Disposition,Agent Duration,Call Duration,\r\n";
        for($i=0;$i<count($user_details);$i++){ 
$j=$i+1;		
			//echo $phpdate = strtotime($user_details[$i]->calldate);
			echo '"'.$j ."\",";
            echo '"'.$user_details[$i]->from ."\",";
            echo '"'.$user_details[$i]->to."\",";
		    echo '"'.$user_details[$i]->xagent."\",";
			echo '"'.$user_details[$i]->starttime."\",";
			echo '"'.$user_details[$i]->count."\",";
			echo '"'.$user_details[$i]->xdispo."\",";
			echo '"'.gmdate("H:i:s",$user_details[$i]->xduration)."\",";
			echo '"'.gmdate("H:i:s",$user_details[$i]->duration)."\",\r\n";
			//echo '"'.date("d/M/Y H:m:s",$user_details[$i]->cdate)."\",";
			
						

        }
    ?>	
	
