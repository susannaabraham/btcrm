<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class permission extends Domain_Controller {

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
            //$this->load->helper('url');
			$this->load->helper(array('form', 'url'));
			$this->load->model('permission_model');
			$this->load->library("pagination");
			$this->load->model('user_model');
       }

	public function index()
	{	
		
	}	
	
	 public function permissionValue(){
	
		
		$data['url']=base_url();
		$config = array();
		$config["base_url"] = base_url('admin/permission/permissionValue');
	    $config["per_page"] =10;
		$config["uri_segment"] =4;
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		
		$count = $this->permission_model->record_count(); 
		$config['total_rows'] = $count[0]->count;
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		if($page>$count[0]->count)		
		{
			$page=0;
		}
		
		$data["results"] = $this->permission_model->fetch_data($config["per_page"], $page); 
		$data["links"] = $this->pagination->create_links();
		$this->load->view('admin/addpermission',$data);
	
	} 
	
	public function addpermission()
	{
		
		$data['url']=base_url();
		$data["cgrp1"] = $this->permission_model->Fill_call_group();
		$data['ctype']=$this->permission_model->Fill_channel_types();
		$this->load->view('admin/addpermission',$data);
		
	}
	public function newpermission()
	{
		 
		$data['url']=base_url();
		$data['groups']=$this->permission_model->getGroups();
		$data["cgrp1"] = $this->permission_model->Fill_call_group1();
		$data['ctype']=$this->permission_model->Fill_channel_types();
		$this->load->view('admin/newpermission',$data);
	}

	public function chk_did()
	{
		if(isset($_POST))
		{
			$this->load->model('permission_model');
			$usr_name = $_POST['usr_name'];
			$this->permission_model->chkdid($usr_name ); 
		}
	}
   
	public function savepermission()
	{
		header('content-type: application/json; charset=utf-8');
		$this->load->model('permission_model');		
		$result=$this->permission_model->doAddPermission();
		if($result>0){
				redirect("/admin/permission/addpermission");
			//echo json_encode(array("success"=>true));
		}else{
			echo json_encode(array("success"=>false));
		}
	}
	
	public function deletepermission()
	{	
	//permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(35)){
			
		echo json_encode(array("success"=>false));
		
		} else {
		//permission setting//
		header('content-type: application/json; charset=utf-8');
		$this->load->model('permission_model');	
		$result=$this->permission_model->doDeletePermission();
		
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
	
	public function editPermission()
	{	
	
		$data['url']=base_url();
		$data["cgrp"] = $this->permission_model->Fill_call_group();
		$data["cgrp1"] = $this->permission_model->Fill_call_group1();
		$data['ctype']=$this->permission_model->Fill_channel_types();
		$data['results']=$this->permission_model->search();
		$this->load->view('admin/editPermission',$data);
		
	}
	
	public function updatePermission()
	{
		header('content-type: application/json; charset=utf-8');			
		$result=$this->permission_model->doPermissionUpdate();
		if($result>0){
			//echo json_encode(array("success"=>true));
			redirect("/admin/permission/addPermission");
		}else{
			echo json_encode(array("success"=>false));
		}
	}
   
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */