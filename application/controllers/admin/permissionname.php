<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class permissionname extends Domain_Controller {

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
			$this->load->model('permissionname_model');
			$this->load->library("pagination");
       }

	public function index()
	{	
		
	}	
	
	 public function permissionnameValue(){
		//echo"hi"; die;
		//permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(1)){
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/addpermissionname',$data);
		} else {
		//permission setting//
		$data['url']=base_url();
		$config = array();
		$config["base_url"] = base_url('admin/permissionname/permissionnameValue');
	    $config["per_page"] =10;
		$config["uri_segment"] =4;
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		
		$count = $this->permissionname_model->record_count(); 
		$config['total_rows'] = $count[0]->count;
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		if($page>$count[0]->count)		
		{
			$page=0;
		}
		
		$data["results"] = $this->permissionname_model->fetch_data($config["per_page"], $page);  //print_r($data["results"]); die;
		$data["links"] = $this->pagination->create_links();
		$this->load->view('admin/addpermissionname',$data);
		}
	
	} 
	
	/* public function addpermissionname()
	{
			//permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(28)){
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/addpermissionname',$data);
		} else {
		//permission setting//
		$data['url']=base_url();
		
		$data["cgrp1"] = $this->permissionname_model->Fill_call_group();
		$data['ctype']=$this->permissionname_model->Fill_channel_types();
		$this->load->view('admin/addpermissionname',$data);
		}
	} */
	public function addpermissionname()
	{ 
			//permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(1)){
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/addpermissionname',$data);
		} else { 
		//permission setting//
		$data['url']=base_url();
		$config = array();
		$config["base_url"] = base_url('admin/permissionname/addpermissionname');
	    $config["per_page"] =10;
		$config["uri_segment"] =4;
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		
		$count = $this->permissionname_model->record_count(); 
		$config['total_rows'] = $count[0]->count;
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		if($page>$count[0]->count)		
		{
			$page=0;
		}
		// echo"hii"; die;
		$data["results"] = $this->permissionname_model->fetch_data($config["per_page"], $page); 
		//$data["results"] = $this->permissionname_model->fetch_data($config["per_page"], $page);  print_r($data["results"]); die;
		$data["links"] = $this->pagination->create_links();
		$this->load->view('admin/addpermissionname',$data);
		}
	}
	public function newpermissionname()
	{
			//permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(1)){
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/newpermissionname',$data);
		} else {
		//permission setting//
		$data['url']=base_url();
		
		$data["cgrp1"] = $this->permissionname_model->Fill_call_group1();
		$data['ctype']=$this->permissionname_model->Fill_channel_types();
		$data['module']=$this->permissionname_model->module();
		$this->load->view('admin/newpermissionname',$data);
		}
	}

	public function chk_did()
	{
		if(isset($_POST))
		{
			$this->load->model('permissionname_model');
			$usr_name = $_POST['usr_name'];
			$this->permissionname_model->chkdid($usr_name ); 
		}
	}
   
	public function savepermissionname()
	{
		header('content-type: application/json; charset=utf-8');
		$this->load->model('permissionname_model');		
		$result=$this->permissionname_model->doAddPermission();
		if($result>0){
				redirect("/admin/permissionname/addpermissionname");
			//echo json_encode(array("success"=>true));
		}else{
			echo json_encode(array("success"=>false));
		}
	}
	
	public function deletepermissionname()
	{	
	//permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(1)){
			
		echo json_encode(array("success"=>false));
		
		} else {
		//permission setting//
		header('content-type: application/json; charset=utf-8');
		$this->load->model('permissionname_model');	
		$result=$this->permissionname_model->doDeletePermission();
		
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
	
	public function editPermissionname()
	{	
	//permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(30)){
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/editPermissionname',$data);
		} else {
		//permission setting//
		$data['url']=base_url();
		
		$data["cgrp"] = $this->permissionname_model->Fill_call_group();
		$data["cgrp1"] = $this->permissionname_model->Fill_call_group1();
		$data['ctype']=$this->permissionname_model->Fill_channel_types();
		$data['module']=$this->permissionname_model->module();
		$data['results']=$this->permissionname_model->search();
		$this->load->view('admin/editPermissionname',$data);
		}
	}
	
	public function updatePermission()
	{
		header('content-type: application/json; charset=utf-8');			
		$result=$this->permissionname_model->doPermissionUpdate();
		if($result>0){
			//echo json_encode(array("success"=>true));
			redirect("/admin/permissionname/addPermissionname");
		}else{
			echo json_encode(array("success"=>false));
		}
	}
   
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */