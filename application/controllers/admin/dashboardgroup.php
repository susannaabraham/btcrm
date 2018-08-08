<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboardgroup extends Domain_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
       {
            parent::__construct();
			$this->load->library('session');
            $this->load->helper('url');
			$this->load->model('dashboardgroup_model');
			$this->load->library("pagination");
       }

	public function index()
	{	
	//permission setting// 
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(1)){
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
			$title="Dashboard";
			$data['title']=$title;
			//$data['heading']=$heading;
		$this->load->view('admin/permission_not_allowed',$data);
		} else {
		//permission setting//
	//echo $id = $this->input->get_post('keyword', true);
		$data['url']=base_url();
		    $did = $this->input->get_post('keyword', true);
		   /*  $sql ="SELECT * FROM `did` where `routedata`='".$id."'";
			$query=$this->db->query($sql); 
			foreach ($query->result() as $row) {
			$did = $row->did; 
		 } */
		$data["incallhr"] = $this->dashboardgroup_model->Fetch_Total_InboundCall_Hour($did);
		//print_r($data['incallhr']);
		$data['outcallhr']=$this->dashboardgroup_model->Fetch_Total_OutboundCall_Hour();
		//print_r($data['outcallhr']);
		$data['incallwk']=$this->dashboardgroup_model->Fetch_Total_InboundCall_Week($did);
		$data['outcallwk']=$this->dashboardgroup_model->Fetch_Total_OutboundCall_Week();
		
		
		$data['incallmonth']=$this->dashboardgroup_model->Fetch_Total_InboundCall_Month($did);
		$data['outcallmonth']=$this->dashboardgroup_model->Fetch_Total_OutboundCall_Month();
		
		$data['calldispo']=$this->dashboardgroup_model->MissedCallsStatus($did); //calls by dispo
		
		$data['chartin']=$this->dashboardgroup_model->chartdatainbound($did);
		$data['chartout']=$this->dashboardgroup_model->chartdataoutbound();
		
		//$data["ordercall2"] = $this->dashboardgroup_model->ordercall2($did); 

		$data['outboundcalldispo']=$this->dashboardgroup_model->outboundCallsStatus(); //outboundcalls by dispo
		
		
		///GROUP 
	
		//$data['group']= $this->session->userdata('mode',$duser[0]->group);
		
		$this->load->view('admin/dashboardgroupview',$data);
	}
	}

	public function poll(){
		$g=$this->input->get_post('keyword', true);
	
		//echo $g;
		$data['agentsstatus']=$this->dashboardgroup_model->agentstatus($g);
	
		echo json_encode($data);
	}

	public function amBarge(){

		echo $u=$this->input->get_post("u");
		echo $a=$this->input->get_post("a");
		echo $m=$this->input->get_post("m");
		$sql= "SELECT * FROM agents WHERE `uname`='$u';";
		$query=$this->db->query($sql);
		$rs2=$query->result();
		echo $tech=$rs2[0]->tech;
		echo $ext=$rs2[0]->ext;
		$mode="ambarge";
		if($m==1){
			$mode="amwisper";
		}


		set_include_path(get_include_path() . PATH_SEPARATOR .$this->config->item("phpagi_path"));
		require_once('phpagi-asmanager.php');

		$asm = new AGI_AsteriskManager();
			if($asm->connect()){
				/*
				$call = $asm->send_request('Originate',
					array('Channel'=>"SIP/851",
							'Context'=>'ambarge',
							'Priority'=>1,
							'exten'=>"851",
							//'variable'=>"bargecall=yes,ext=$ext,tech=$tech,agent=$a",
							//'Async'=>"yes",
						 'Callerid'=>"$agent_did"));
						 echo json_encode(array($call));
						 */



						 $call = $asm->send_request('Originate',
											 array('Channel'=>"SIP/$a",
														 'Context'=>"$mode",
														 'Priority'=>1,
									 'exten'=>"$ext",
									 'variable'=>"bargecall=yes,ext=$ext,tech=$tech,agent=$u",
														'Callerid'=>"1233"));
									echo json_encode(array($call));


			}


	}


	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */