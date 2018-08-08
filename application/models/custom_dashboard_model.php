<?php
class custom_dashboard_model extends CI_Model{

	public function __construct(){
            parent::__construct();
           // $this->load->helper('url');
		   $this->load->database();
    }


	/****************************** FOR HOUR ************** **********/
	public function Fetch_Total_InboundCall_Hour(){
		$caldate=($this->input->get("single_cal1",true)) ? $this->input->get("single_cal1",true) : 0;
		$sql ="SELECT COUNT( * ) inboundcall FROM  `inboundlog` WHERE DATE( `starttime` ) = '".$caldate."' ";
		$query=$this->db->query($sql);
		return $query->result();
	}
	
	public function Fetch_Total_OutboundCall_Hour(){
		$caldate=($this->input->get("single_cal1",true)) ? $this->input->get("single_cal1",true) : 0;
		$sql ="SELECT COUNT( * ) outboundcall FROM  `outbound_cdr_view3` WHERE   DATE(`calldate`)= '".$caldate."' ";
		$query=$this->db->query($sql);
		return $query->result();
	}
	/****************************** FOR HOUR END************** **********/

	/****************************** FOR WEEK ************** **********/
	public function Fetch_Total_InboundCall_Week(){				
		$caldate=($this->input->get("single_cal1",true)) ? $this->input->get("single_cal1",true) : 0;
		$sql ="SELECT count(*) inboundcall FROM  `inboundlog` WHERE WEEKOFYEAR(`starttime`) = WEEKOFYEAR('".$caldate."'); ";
		$query=$this->db->query($sql);
		return $query->result();
	}

	public function Fetch_Total_OutboundCall_Week(){				
		$caldate=($this->input->get("single_cal1",true)) ? $this->input->get("single_cal1",true) : 0;
		$sql ="SELECT count(*) outboundcall FROM  `outbound_cdr_view` WHERE WEEKOFYEAR(`calldate`) = WEEKOFYEAR('".$caldate."'); ";
		$query=$this->db->query($sql);
		return $query->result();
	}
	/****************************** FOR WEEK END ************** **********/


	/****************************** FOR MONTH ************** **********/
	public function Fetch_Total_InboundCall_Month(){				
		$caldate=($this->input->get("single_cal1",true)) ? $this->input->get("single_cal1",true) : 0;
		$sql ="SELECT COUNT( * )  inboundcall FROM  `inboundlog` WHERE  YEAR(`starttime`) = YEAR('".$caldate."') AND MONTH(`starttime`)=MONTH('".$caldate."')";
		$query=$this->db->query($sql);
		return $query->result();
	}

	public function Fetch_Total_OutboundCall_Month(){				
		$caldate=($this->input->get("single_cal1",true)) ? $this->input->get("single_cal1",true) : 0;
		$sql ="SELECT COUNT( * ) outboundcall FROM  `outbound_cdr_view` WHERE YEAR(`calldate`) = YEAR('".$caldate."') AND MONTH(`calldate`)=MONTH('".$caldate."')";
		$query=$this->db->query($sql);
		return $query->result();
	}



	public function MissedCallsStatus(){
		$caldate=($this->input->get("single_cal1",true)) ? $this->input->get("single_cal1",true) : 0;
		$sql ="SELECT count(*) as count,xdispo as disposition FROM `inboundlog` WHERE DATE( `starttime` ) = '".$caldate."' GROUP BY `xdispo`";
		$query=$this->db->query($sql);
		return $query->result();
	}
	//outbound calls dispo
	public function outboundCallsStatus(){
		$caldate=($this->input->get("single_cal1",true)) ? $this->input->get("single_cal1",true) : 0;
		$sql ="SELECT count(*) as count,disposition FROM `outbound_cdr_view3` WHERE  DATE(`calldate`)= '".$caldate."' GROUP BY `disposition`";
		$query=$this->db->query($sql);
		return $query->result();
	}


	public function chartdatainbound(){
		$caldate=($this->input->get("single_cal1",true)) ? $this->input->get("single_cal1",true) : 0;
		$sql ="SELECT HOUR(`starttime`) as hours,`starttime`,count(*) count FROM `inboundlog` WHERE DATE(`starttime`) = '".$caldate."'  GROUP BY HOUR(`starttime`)";
		$query=$this->db->query($sql);
		return $query->result();
	}

	public function chartdataoutbound(){
		$caldate=($this->input->get("single_cal1",true)) ? $this->input->get("single_cal1",true) : 0;
		$sql ="SELECT HOUR(calldate) as hours,calldate,count(*) count FROM `outbound_cdr_view3` WHERE DATE(`calldate`)= '".$caldate."' GROUP BY HOUR(`calldate`)";
		$query=$this->db->query($sql);
		return $query->result();
	}
	/****************************** FOR MONTH END ************** **********/
	
	
	public function agentstatus($g=""){

		//echo $caldate= $this->input->get("single_cal1",true);
	//echo $caldate= $_POST["cdate"];
	$caldate=$this->input->get_post("cdate");
		if(empty($g)){	
		$sql= "SELECT *,FROM_UNIXTIME(`lastupdate`, '%Y-%m-%d') as clm  FROM `agents` having clm ='".$caldate."'ORDER BY `agents`.`sincelast`  DESC";
		}else{
		 $sql ="SELECT *,FROM_UNIXTIME(`lastupdate`, '%Y-%m-%d') as clm  FROM `agents` having clm ='".$caldate."' and agid in(SELECT agent_id FROM `call_group_data` WHERE `groupid`=$g)ORDER BY `agents`.`sincelast`  DESC";
		}
		//echo $sql;
		$query=$this->db->query($sql);
		return $query->result();
	}
}
?>
