<?php
class dashboardgroup_model extends CI_Model{

	public function __construct(){
            parent::__construct();
           // $this->load->helper('url');
		   $this->load->database();
    }

	public function getLatestMailStat(){
		$this->load->database();
		$sql = "SELECT
	COUNT(tid) as mail_count,
    SUM(esize) as total_data,
    HOUR(FROM_UNIXTIME(etime)) as on_hour,DAY(FROM_UNIXTIME(etime)) as on_day,MONTH(FROM_UNIXTIME(etime)) as on_month,YEAR(FROM_UNIXTIME(etime)) as on_year
FROM mail_tracker Group BY on_hour,on_day ORDER BY etime DESC LIMIT 10";
		//$this->db->query($sql, array(3, 'live', 'Rick')); 
		$query=$this->db->query($sql); 
		//print_r($query->result());
		return $query->result();
	}

	
	public function getMailStatsticsAllDomain($islocal=0){
		//get all domain mail statstics by day
		$time=mktime (0,0,0,date("n"),date("j"),date("Y"));
		$this->load->database();
		$sql = "SELECT
		COUNT(tid) as mail_count,
		domain,
			SUM(esize) as total_data,
			DAY(FROM_UNIXTIME(etime)) as on_day
		FROM mail_tracker WHERE etime>$time AND islocal='$islocal' Group BY on_day,domain ORDER BY mail_count DESC LIMIT 10";
		$query=$this->db->query($sql); 
		return $query->result(); 

	}
	
	/****************************** ARchana 03-06-2016 ************** ************** ************** ************** **************/
	
	/****************************** FOR HOUR ************** **********/
	public function Fetch_Total_InboundCall_Hour($did)
	{ 
	
		//$sql ="SELECT COUNT( * ) inboundcall FROM  `inboundlog` WHERE starttime > CURDATE() AND `to`='".$did."'";
		$sql="SELECT  COUNT( * ) as count,`inboundlog`.*, `did`.`did`,`did`.`routedata` FROM `inboundlog` INNER JOIN `did`ON inboundlog.to=did.did where starttime > CURDATE() and `routedata`='".$did."'";
		$query=$this->db->query($sql); 
		$result=$query->result();
		return $result[0]->count;
	}
	/* public function ordercall2()
	{
			$from=date("Y-m-d H:i:s");
			$_from = str_replace('/', '-', $from);
			$date = date_create($_from);
            $_from=date_format($date, 'Y-m-d 00:00:00');
			$_to = str_replace('/', '-', $from);
			$date2 = date_create($_to);
			$_to=date_format($date2, 'Y-m-d 23:59:59');
			if($_from==$_to){
				
				$_to= $_to ." 23:59:59";
			}
			
		 $sql="SELECT count(*) as count FROM custom_data where type='Order call' and (cdate BETWEEN UNIX_TIMESTAMP(('$_from')) AND UNIX_TIMESTAMP(('$_to')))";

		$query=$this->db->query($sql); 
		return $query->result();
	} */
	
	
	public function Fetch_Total_OutboundCall_Hour()
	{
					$id = $this->input->get_post('keyword', true);	

		//$sql ="SELECT COUNT( * ) outboundcall FROM  `outbound_cdr_view3` WHERE   calldate > CURDATE() ";
		$sql ="SELECT COUNT( * ) AS count, call_group_data. * , agents. * , outbound_cdr_view3 . *
				FROM call_group_data
				INNER JOIN agents ON call_group_data.agent_id = agents.agid
				INNER JOIN outbound_cdr_view3 ON outbound_cdr_view3.xagent = agents.uname
				WHERE call_group_data.groupid = '".$id."'
				AND outbound_cdr_view3.calldate > CURDATE( )"; 
		$query=$this->db->query($sql); 
		$result=$query->result();
		return $result[0]->count;
	}
	/****************************** FOR HOUR END************** **********/
	
	/****************************** FOR WEEK ************** **********/
	public function Fetch_Total_InboundCall_Week($did)
	{
		$sql="SELECT COUNT( * ) AS count,  `inboundlog` . * ,  `did`.`did` ,  `did`.`routedata` 
			FROM  `inboundlog` 
			INNER JOIN  `did` ON inboundlog.to = did.did
			WHERE WEEKOFYEAR( inboundlog.starttime ) = WEEKOFYEAR( NOW( ) ) 
			AND  `did`.`routedata` = '".$did."'";
		//$sql="SELECT  COUNT( * ) as count,`inboundlog`.*, `did`.`did`,`did`.`routedata` FROM `inboundlog` INNER JOIN `did`ON inboundlog.to=did.did  WHERE WEEKOFYEAR(inboundlog.starttime) = WEEKOFYEAR(NOW()) and `did`.`routedata`='".$did."'";
		$query=$this->db->query($sql); 
		$result=$query->result();
		return $result[0]->count;	}
	
	public function Fetch_Total_OutboundCall_Week()
	{
					$id = $this->input->get_post('keyword', true);	

		$sql ="SELECT COUNT( *) AS count, call_group_data. * , agents. * , outbound_cdr_view3 . *
				FROM call_group_data
				INNER JOIN agents ON call_group_data.agent_id = agents.agid
				INNER JOIN outbound_cdr_view3 ON outbound_cdr_view3.xagent = agents.uname
				WHERE call_group_data.groupid = '".$id."'
				AND  WEEKOFYEAR(outbound_cdr_view3.calldate) = WEEKOFYEAR(NOW())";
		$query=$this->db->query($sql); 
				$result=$query->result();

		return $result[0]->count;
	}	
	/****************************** FOR WEEK END ************** **********/
	
	
	/****************************** FOR MONTH ************** **********/
	public function Fetch_Total_InboundCall_Month($did)
	{
		//$sql ="SELECT COUNT( * )  inboundcall FROM  `inboundlog` WHERE  YEAR(starttime) = YEAR(NOW()) AND MONTH(starttime)=MONTH(NOW()) AND `to`='".$did."'";
		$sql ="SELECT COUNT( * ) AS count,`inboundlog` . * ,`did`.`did` ,  `did`.`routedata` 
			FROM  `inboundlog` 
			INNER JOIN  `did` ON inboundlog.to = did.did
			WHERE YEAR(inboundlog.starttime) = YEAR(NOW()) AND MONTH(inboundlog.starttime)=MONTH(NOW())
			AND  `did`.`routedata` = '".$did."'";
		$query=$this->db->query($sql); 
		$result=$query->result();
		return $result[0]->count;	}
	
	public function Fetch_Total_OutboundCall_Month()
	{
					$id = $this->input->get_post('keyword', true);	
		$sql ="SELECT COUNT( *) AS count, call_group_data. * , agents. * , outbound_cdr_view3 . *
				FROM call_group_data
				INNER JOIN agents ON call_group_data.agent_id = agents.agid
				INNER JOIN outbound_cdr_view3 ON outbound_cdr_view3.xagent = agents.uname
				WHERE call_group_data.groupid = '".$id."' AND
		YEAR(outbound_cdr_view3.calldate) = YEAR(NOW()) AND MONTH(outbound_cdr_view3.calldate)=MONTH(NOW())";
			$query=$this->db->query($sql); 
				$result=$query->result();

		return $result[0]->count;
	}
	
	
	
	public function MissedCallsStatus($did){
		
		
		//$sql ="SELECT count(*) as count,xdispo as disposition FROM `inboundlog` WHERE starttime > CURDATE()  GROUP BY xdispo";
	 $sql="SELECT COUNT( * ) AS count,`inboundlog` .xdispo as disposition,`inboundlog` .`to` ,`inboundlog` .`xdispo`,`did`.`did` ,  `did`.`routedata` 
			FROM  `inboundlog` 
			INNER JOIN  `did` ON inboundlog.to = did.did WHERE `inboundlog`.`starttime` > CURDATE()
			AND  `did`.`routedata` = '".$did."'  GROUP BY xdispo"; 
		$query=$this->db->query($sql); 
		return $query->result();
	}
	//outbound calls dispo
	public function outboundCallsStatus(){
		$id = $this->input->get_post('keyword', true);	
		// $sql ="SELECT count(*) as count,disposition FROM `outbound_cdr_view3` WHERE calldate > CURDATE() GROUP BY disposition";
		$sql="SELECT COUNT( *) AS count, call_group_data.agent_id , agents.agid , outbound_cdr_view3 . disposition,outbound_cdr_view3.xagent
				FROM call_group_data
				INNER JOIN agents ON call_group_data.agent_id = agents.agid
				INNER JOIN outbound_cdr_view3 ON outbound_cdr_view3.xagent = agents.uname
				WHERE call_group_data.groupid =  '".$id."'
				AND  calldate > CURDATE() GROUP BY outbound_cdr_view3.disposition";
		$query=$this->db->query($sql); 
		return $query->result();
	}
	
	
	public function chartdatainbound($did){
		
		
		
		$sql="SELECT HOUR(inboundlog.starttime) as hours,count(inboundlog.starttime) as count,`inboundlog` . * ,`did`.`did` ,  `did`.`routedata` 
			FROM  `inboundlog` 
			INNER JOIN  `did` ON inboundlog.to = did.did where inboundlog.starttime >CURDATE() and `did`.`routedata` ='".$did."' GROUP BY HOUR(inboundlog.starttime) ";
		$query=$this->db->query($sql); 
		return $query->result();
	}
	
	public function chartdataoutbound(){
		
			/* 	 $sql="SELECT HOUR(outbound_cdr_view3.calldate) as hours,count(outbound_cdr_view3.starttime) as count,`outbound_cdr_view3` . * ,`did`.`did` ,  `did`.`routedata` 
			FROM  `inboundlog` 
			INNER JOIN  `did` ON inboundlog.to = did.did where inboundlog.starttime >CURDATE() and `did`.`routedata` ='".$did."' GROUP BY HOUR(inboundlog.starttime) ";
		
		 */
		 
		
		//$sql ="SELECT HOUR(calldate) as hours,count(*) count FROM `outbound_cdr_view3` WHERE calldate >CURDATE() GROUP BY HOUR(calldate)";
		
		
		$id = $this->input->get_post('keyword', true);	

		$sql="SELECT HOUR(outbound_cdr_view3.calldate) as hours,count(outbound_cdr_view3.calldate) as count,call_group_data. agent_id ,call_group_data. groupid, agents.uname ,agents.agid , outbound_cdr_view3 .calldate
				FROM call_group_data
				INNER JOIN agents ON call_group_data.agent_id = agents.agid
				INNER JOIN outbound_cdr_view3 ON outbound_cdr_view3.xagent = agents.uname
				WHERE call_group_data.groupid = '".$id."' and  outbound_cdr_view3.calldate >CURDATE() GROUP BY HOUR(outbound_cdr_view3.calldate)";
		$query=$this->db->query($sql); 
		return $query->result();
	}
	/****************************** FOR MONTH END ************** **********/

	public function agentstatus(){
		if($g==0){
		 $sql ="SELECT * FROM `agents` ORDER BY `agents`.`agent_status`  ASC";
		}else{	$sql ="SELECT * FROM `agents` WHERE agid in(SELECT agent_id FROM `call_group_data` WHERE `groupid`=$g)ORDER BY `agents`.`agent_status`  ASC";
		}
		$query=$this->db->query($sql); 
		return $query->result();
	}	
}
?>


