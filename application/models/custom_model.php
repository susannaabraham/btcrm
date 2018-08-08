<?php
class custom_model extends CI_Model
{

	public function __construct(){
            parent::__construct();
           // $this->load->helper('url');
		   $this->load->database();
    }

	public function fetch_data($limit,$start){
	
		$ast= $this->load->database('otherdb2',TRUE);
		/* $sql="SELECT * FROM custom_destinations LIMIT $start,$limit";
		$query=$ast->query($sql);  */
		$sql="SELECT val FROM `asterisk`.`kvstore` WHERE `id`='dests' LIMIT $start,$limit";
		$query=$ast->query($sql);
	    $ans = $query->result();
		for($i=0;$i<count($ans);$i++){
		$k1[] = json_decode($ans[$i]->val);
		}
		//print_r($k1);
		 return $k1;
    }
	public function record_count(){
	
		$ast= $this->load->database('otherdb2',TRUE);
		/* $sql ="SELECT count(*) as count FROM custom_destinations";
		$query=$ast->query($sql);  */
		$sql="SELECT count(*) as count FROM `asterisk`.`kvstore` WHERE `id`='dests'";
		$query=$ast->query($sql);
		
		return $query->result();
	}
	
	public function savecustom(){
		
		header('content-type: application/json; charset=utf-8');
	
	    $ast= $this->load->database('otherdb2',TRUE);
		$custom_dest=$this->input->post('custom_dest');
		
		////taking key value
		//$ast= $this->load->database('otherdb2',TRUE);
		$sql1="SELECT * FROM `asterisk`.`kvstore` WHERE `key`='currentid'";
		$query1=$ast->query($sql1);
        $ans=$query1->result();	
        $key_new = $ans[0]->val;	
		$key=$key_new+1;
		
		
		//if($custom_dest){
			
		//$name=$custom_dest.",1"
		$description=$this->input->post('description');
		$notes=$this->input->post('notes');
		$destret1=$this->input->post('destret');
		$des=$this->input->post('destination');
		
		if($destret1!='on'){
			$destret='';
		}else{
			$destret='on';
		}
		
		if($des=='null'){
		$destination1= 'null';
	 	}else{
			
			   $destination1=$this->input->post('destination1');
		     }
		
	$data=array(
	'custom_dest'=>$custom_dest,
	'description'=>$description,
	'notes'=>$notes
	
	);
	
	$first = $ast->insert('custom_destinations',$data);
	
	$postArray = array(
            "destid" => $key_new,
            "target" => $custom_dest,
            "description" => $description,
            "notes" => $notes,
            "destret" => $destret,
            "dest" => $destination1
                    
    );

            $json = json_encode( $postArray );
	
	//print_r($postArray);die;

	$data1=array(
	'module'=>'FreePBX\modules\Customappsreg',
	'key'=>$key_new,
	'val'=>$json,
	'type'=>'json-arr',
	'id'=>'dests'
	
	);
	
	$sec = $ast->insert('kvstore',$data1);
	
	$data2=array(
	
	'val'=>$key,
	
	);
	
	$ast->where('key', 'currentid');
	$third = $ast->update('kvstore',$data2);
	
	//return $first;
	//return $sec;
	//return $third;
	
		//}else{
			return 1;
		//}
	
  }

    public function dodeletecustom(){
	
        $ast= $this->load->database('otherdb2',TRUE);
		$id=$this->input->post('id');
		
		/* $sql = "delete from custom_destinations where custom_dest='$id'";
        $query=$ast->query($sql);
		
		$sql1="SELECT * FROM `kvstore` WHERE `val` like '%$id%'";
		$query1=$ast->query($sql1);
        $ans1=$query1->result();	
        $key_del = $ans1[0]->key; */
		
		$sql2 = "delete from `asterisk`.`kvstore` where `key`='$id' and `id`='dests'";
        $query2=$ast->query($sql2);
		
		return true;
	}
	
	
	
	public function custom_dest(){
		
		$ast= $this->load->database('otherdb2',TRUE);
		
		$dest=$this->input->post('selection');
	    $name=$this->input->post('name');
		$destination_value=$this->input->post('destination_value'); 
		
		//////extension
		 if($dest=='Extensions'){
			$sql = "select * from `asterisk`.`devices`";
			$query=$ast->query($sql);
            $return="<select name=\"$name\" class=\"form-control\">";
			
		if ($query->num_rows() > 0){
                                

			foreach($query->result() as $row){
				
				 $s=($destination_value=="from-did-direct,".$row->user.",1")?"selected":"";
				 $return .='<option  value="from-did-direct,'.$row->user.',1"'.$s.'>'.$row->user.'</option>';
			}
		
			$return .='</select>';
            return $return;
        }
			
	 	} else if($dest=='Announcements'){       ///destination
			
			$sql = "select * from `asterisk`.`announcement`";
			$query=$ast->query($sql);
            $return="<select name=\"$name\" class=\"form-control\">";
			
		if ($query->num_rows() > 0){
                                

			foreach($query->result() as $row){
				
				//echo $a=$row["id"];
				
			$s=($destination_value=="app-announcement-".$row->announcement_id.",s,1")?"selected":"";	
			$return .='<option value="app-announcement-'.$row->announcement_id.',s,1"'.$s.'>'.$row->description.'</option>';
			}
		
			$return .='</select>';
            return $return;
        }
			
		} else if($dest=='IVR'){       ///destination
			
			$sql = "select * from `asterisk`.`ivr_details`";
			$query=$ast->query($sql);
            $return="<select name=\"$name\" class=\"form-control\">";
			
		if ($query->num_rows() > 0){
                                

			foreach($query->result() as $row){
				
				//echo $a=$row["id"];
				
				//$option = "<option value='".$row["id"]."' >".$row["id"]."</option>"; 
				
				 $s=($destination_value=="ivr-".$row->id.",s,1")?"selected":"";
			$return .='<option  value="ivr-'.$row->id.',s,1"'.$s.' >'.$row->name.'</option>';
			}
		
			$return .='</select>';
            return $return;
        }
			
		}else if($dest=='Terminate call'){       ///destination
			
			
			                    $d1=($destination_value=="app-blackhole,hangup,1")?"selected":"";
                                $d2=($destination_value=="app-blackhole,congestion,1")?"selected":"";
                                $d3=($destination_value=="app-blackhole,busy,1")?"selected":"";
                                $d4=($destination_value=="app-blackhole,zapateller,1")?"selected":"";
                                $d5=($destination_value=="app-blackhole,musiconhold,1")?"selected":"";
                                $d6=($destination_value=="app-blackhole,ring,1")?"selected":"";

			
	    $return="<select name=\"$name\" class=\"form-control\">";
        $return .='<option value="app-blackhole,hangup,1"'.$d1.'>Hang up</option>';
        $return .='<option value="app-blackhole,congestion,1"'.$d2.'>Congestion</option>';
        $return .='<option value="app-blackhole,busy,1"'.$d3.'>Busy</option>';
        $return .='<option value="app-blackhole,zapateller,1"'.$d4.'>Put SIT Tone(Zapateller)</option>';
        $return .='<option value="app-blackhole,musiconhold,1"'.$d5.'>Put caller on hold forever</option>';
        $return .='<option value="app-blackhole,ring,1"'.$d6.'>Play ringtones to caller until they hangup</option>';

			
			
			$return .='</select>';
            return $return;

			
		}else if($dest=='Custom Destination'){       ///destination
			
		$sql="SELECT val FROM `asterisk`.`kvstore` WHERE `id`='dests'";
			$query=$ast->query($sql);
			 $val = $query->result(); //print_r($val);
			$count=$query->num_rows();
			$return="<select name=\"$name\" class=\"form-control\">";
			 if ($query->num_rows() > 0) 
			{ 
				for($i=0;$i<$count;$i++){
					$res=$val[$i]->val;
					$value=json_decode($res, true); //print_r($value);
				
					$s=($destination_value=="customdests,dest-".$value[destid].",1")?"selected":"";
					$return .='<option value="customdests,dest-'.$value[destid].',1" '.$s.'>'.$value[description].'</option>';
					
			    }
			
			$return .='</select>';
            return $return;
			}
			
		}else if($dest=='RingGroups'){       ///Ring groups
			
			$sql = "select * from `asterisk`.`ringgroups`";
			$query=$ast->query($sql);
            $return="<select name=\"$name\" class=\"form-control\">";
			
		if ($query->num_rows() > 0){
                                

			foreach($query->result() as $row){
				
				//echo $a=$row["id"];
				
				//$option = "<option value='".$row["id"]."' >".$row["id"]."</option>"; 
				
				$s=($destination_value=="ext-group,".$row->grpnum.",1")?"selected":"";
		        $return .='<option value="ext-group,'.$row->grpnum.',1"'.$s.'>'.$row->description.'</option>';
				
				
			}
		
			$return .='</select>';
            return $return;
        }
			
		}            
		
	}
	
	
	
	
	

}
?>


