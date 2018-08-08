<?php
class dashboard_model extends CI_Model{

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
	public function Fetch_Total_InboundCall_Hour()
	{
		$sql ="SELECT COUNT( * ) inboundcall FROM  `inboundlog` WHERE starttime > CURDATE() ";
		$query=$this->db->query($sql);
		return $query->result();
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
		$sql ="SELECT COUNT( * ) outboundcall FROM  `outbound_cdr_view3` WHERE   calldate > CURDATE() ";
		$query=$this->db->query($sql);
		return $query->result();
	}
	/****************************** FOR HOUR END************** **********/

	/****************************** FOR WEEK ************** **********/
	public function Fetch_Total_InboundCall_Week()
	{
		$sql ="SELECT count(*) inboundcall FROM  `inboundlog` WHERE WEEKOFYEAR(starttime) = WEEKOFYEAR(NOW()); ";
		$query=$this->db->query($sql);
		return $query->result();
	}

	public function Fetch_Total_OutboundCall_Week()
	{
		$sql ="SELECT count(*) outboundcall FROM  `outbound_cdr_view` WHERE WEEKOFYEAR(calldate) = WEEKOFYEAR(NOW()); ";
		$query=$this->db->query($sql);
		return $query->result();
	}
	/****************************** FOR WEEK END ************** **********/


	/****************************** FOR MONTH ************** **********/
	public function Fetch_Total_InboundCall_Month()
	{
		$sql ="SELECT COUNT( * )  inboundcall FROM  `inboundlog` WHERE  YEAR(starttime) = YEAR(NOW()) AND MONTH(starttime)=MONTH(NOW())";
		$query=$this->db->query($sql);
		return $query->result();
	}

	public function Fetch_Total_OutboundCall_Month()
	{
		$sql ="SELECT COUNT( * ) outboundcall FROM  `outbound_cdr_view` WHERE YEAR(calldate) = YEAR(NOW()) AND MONTH(calldate)=MONTH(NOW())";
		$query=$this->db->query($sql);
		return $query->result();
	}



	public function MissedCallsStatus(){


		$sql ="SELECT count(*) as count,xdispo as disposition FROM `inboundlog` WHERE starttime > CURDATE() GROUP BY xdispo";
		$query=$this->db->query($sql);
		return $query->result();
	}
	//outbound calls dispo
	public function outboundCallsStatus(){


		$sql ="SELECT count(*) as count,disposition FROM `outbound_cdr_view3` WHERE calldate > CURDATE() GROUP BY disposition";
		$query=$this->db->query($sql);
		return $query->result();
	}


	public function chartdatainbound(){

		$sql ="SELECT HOUR(starttime) as hours,count(*) count FROM `inboundlog` WHERE starttime > CURDATE() GROUP BY HOUR(starttime)";
		$query=$this->db->query($sql);
		return $query->result();
	}

	public function chartdataoutbound(){

		$sql ="SELECT HOUR(calldate) as hours,count(*) count FROM `outbound_cdr_view3` WHERE calldate > CURDATE() GROUP BY HOUR(calldate)";
		$query=$this->db->query($sql);
		return $query->result();
	}
	/****************************** FOR MONTH END ************** **********/

	public function agentstatus($g=""){

		//echo $g;
		//$sql ="SELECT * FROM `agents` ORDER BY `agents`.`agent_status`  ASC";
		if(empty($g)){
		$sql ="SELECT *,SEC_TO_TIME(UNIX_TIMESTAMP()-sincelast) as clm FROM `agents` ORDER BY `agents`.`sincelast`  DESC";
		}else{
		$sql ="SELECT *,SEC_TO_TIME(UNIX_TIMESTAMP()-sincelast) as clm FROM `agents` WHERE agid in(SELECT agent_id FROM `call_group_data` WHERE `groupid`=$g)ORDER BY `agents`.`sincelast`  DESC";
		}
		$query=$this->db->query($sql);
		return $query->result();
	}
}
?>
