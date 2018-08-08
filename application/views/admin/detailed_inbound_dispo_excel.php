<?php 
//print_r($user_details);
 echo "Sl.No.,Call Count,Disposition\r\n";
        for($i=0;$i<count($user_details);$i++){ 
$j=$i+1;		
			//echo $phpdate = strtotime($user_details[$i]->calldate);
			echo '"'.$j ."\",";

			echo '"'.$user_details[$i]->count."\",";
			echo '"'.$user_details[$i]->xdispo."\",\r\n";

			//echo '"'.date("d/M/Y H:m:s",$user_details[$i]->cdate)."\",";
			
						

        }
    ?>	
	
