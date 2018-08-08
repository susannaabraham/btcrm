<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends Domain_Controller {

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
			$this->load->model('admin_model');
			$this->load->library("pagination");
       }

	public function index()
	{	
		
	}	
	
	 public function adminValue(){
	
	//permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(13)){
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/addadmin',$data);
		} else {
		//permission setting//
		$data['url']=base_url();
		$config = array();
		$config["base_url"] = base_url('admin/admin/adminValue');
	    $config["per_page"] =10;
		$config["uri_segment"] =4;
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		
		$count = $this->admin_model->record_count(); 
		$config['total_rows'] = $count[0]->count;
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		if($page>$count[0]->count)		
		{
			$page=0;
		}
		
		$data["results"] = $this->admin_model->fetch_data($config["per_page"], $page); 
		$data["links"] = $this->pagination->create_links();
		$this->load->view('admin/addadmin',$data);
		}
	
	} 
	
	public function addadmin()
	{
		//permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(14)){
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/addadmin',$data);
		} else {
		//permission setting//
		
		$data['url']=base_url();
		
		$data["cgrp"] = $this->admin_model->Fill_call_group();

		$data['ctype']=$this->admin_model->Fill_channel_types();
		$this->load->view('admin/addadmin',$data);
		}
	}
	public function newadmin()
	{
		//permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(1)){
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/newadmin',$data);
		} else {
		//permission setting//
		$data['url']=base_url();
		
		$data["cgrp"] = $this->admin_model->Fill_call_group();
		$data['ctype']=$this->admin_model->Fill_channel_types();
	//	$data['ctype1']=$this->admin_model->groups();
		 
		$this->load->view('admin/newadmin',$data);
		}
	}

	public function chk_did()
	{
		if(isset($_POST))
		{
			$this->load->model('admin_model');
			$usr_name = $_POST['usr_name'];
			$this->admin_model->chkdid($usr_name ); 
		}
	}
   
	public function saveadmin()
	{
		header('content-type: application/json; charset=utf-8');
		$this->load->model('admin_model');		
		$result=$this->admin_model->doAddAdmin();
		if($result>0){
				redirect("/admin/admin/addadmin");
			//echo json_encode(array("success"=>true));
		}else{
			echo json_encode(array("success"=>false));
		}
	}
	
	public function deleteadmin()
	{	
	//permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(16)){
			
		echo json_encode(array("success"=>false));
		
		} else {
		//permission setting//
		header('content-type: application/json; charset=utf-8');
		$this->load->model('admin_model');	
		$result=$this->admin_model->doDeleteAdmin();
		
		if($result>0)
		{
			//redirect("/admin/inbound/did");
			echo json_encode(array("success"=>true));
		}
		else
		{
			echo json_encode(array("success"=>false));
		}
		}
	}
	
	public function editAdmin()
	{	
	//permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(15)){
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/editadmin',$data);
		} else {
		//permission setting//
		$data['url']=base_url();
		
		$data["cgrp"] = $this->admin_model->Fill_call_group();
		
		$data['ctype']=$this->admin_model->Fill_channel_types();
		$data['ctype1']=$this->admin_model->groups();
		$data['results']=$this->admin_model->search();
		$this->load->view('admin/editadmin',$data);
		}
	}
	
	public function updateAdmin()
	{
		header('content-type: application/json; charset=utf-8');			
		$result=$this->admin_model->doAdminUpdate();
		if($result>0){
			//echo json_encode(array("success"=>true));
			redirect("/admin/admin/addadmin");
		}else{
			echo json_encode(array("success"=>false));
		}
	}
   
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */