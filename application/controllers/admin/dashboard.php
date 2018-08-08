<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends Domain_Controller {

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
			$this->load->model('dashboard_model');
			$this->load->model('custom_dashboard_model');
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
		$data['url']=base_url();

		$data["incallhr"] = $this->dashboard_model->Fetch_Total_InboundCall_Hour();
		$data['outcallhr']=$this->dashboard_model->Fetch_Total_OutboundCall_Hour();

		$data['incallwk']=$this->dashboard_model->Fetch_Total_InboundCall_Week();
		$data['outcallwk']=$this->dashboard_model->Fetch_Total_OutboundCall_Week();


		$data['incallmonth']=$this->dashboard_model->Fetch_Total_InboundCall_Month();
		$data['outcallmonth']=$this->dashboard_model->Fetch_Total_OutboundCall_Month();
		$data['calldispo']=$this->dashboard_model->MissedCallsStatus(); //calls by dispo
		$data['chartin']=$this->dashboard_model->chartdatainbound();
		$data['chartout']=$this->dashboard_model->chartdataoutbound();
		//$data["ordercall2"] = $this->dashboard_model->ordercall2();

		$data['outboundcalldispo']=$this->dashboard_model->outboundCallsStatus(); //outboundcalls by dispo


		$this->load->view('admin/dashboardview',$data);
		}
	}

	public function poll(){
		$g=$this->session->userdata('groups');

		//echo $g;
		$data['agentsstatus']=$this->dashboard_model->agentstatus($g);
		echo json_encode($data);
	}
	public function poll_custom(){
		$g=$this->session->userdata('groups');

		//echo $g;
		$data['agentsstatus']=$this->custom_dashboard_model->agentstatus($g);
		//print_r($data);
		echo json_encode($data);
	}

///new dashboard
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

 public function custom_dashboard()
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
		$data['url']=base_url();

		$data["incallhr"] = $this->custom_dashboard_model->Fetch_Total_InboundCall_Hour();
		$data['outcallhr']=$this->custom_dashboard_model->Fetch_Total_OutboundCall_Hour();

		$data['incallwk']=$this->custom_dashboard_model->Fetch_Total_InboundCall_Week();
		$data['outcallwk']=$this->custom_dashboard_model->Fetch_Total_OutboundCall_Week();


		$data['incallmonth']=$this->custom_dashboard_model->Fetch_Total_InboundCall_Month();
		$data['outcallmonth']=$this->custom_dashboard_model->Fetch_Total_OutboundCall_Month(); 
		$data['calldispo']=$this->custom_dashboard_model->MissedCallsStatus(); //calls by dispo
		$data['chartin']=$this->custom_dashboard_model->chartdatainbound();
		//print_r($data['chartin']);
		$data['chartout']=$this->custom_dashboard_model->chartdataoutbound();

		$data['outboundcalldispo']=$this->custom_dashboard_model->outboundCallsStatus(); //outboundcalls by dispo

		$this->load->view('admin/customdashboardview',$data);
		//}
	} 
	
	
	
	


}}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
