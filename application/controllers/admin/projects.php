<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class projects extends Domain_Controller {

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
			$this->load->model('projects_model');
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
		$this->load->view('admin/projects',$data);
		} else {  
		//permission setting//
		$data['url']=base_url();
		$config = array();
		$config["base_url"] = base_url('admin/projects/index');
	    $config["per_page"] =10;
		$config["uri_segment"] =4;
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		
		$count = $this->projects_model->record_count(); 
		$config['total_rows'] = $count[0]->count;
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		if($page>$count[0]->count)		
		{
			$page=0;
		}
		
		$data["results"] = $this->projects_model->fetch_data($config["per_page"], $page); 
		$data["links"] = $this->pagination->create_links();
		$this->load->view('admin/projects',$data);
		}
	}

	public function addprojects()
	{
	  //permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(22)){
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/addprojects',$data);
		} else {
		//permission setting//
		$data['url']=base_url();
		$this->load->view('admin/addprojects',$data);
		}
		
	}
	public function saveproject()
	{
		
		header('content-type: application/json; charset=utf-8');
		$result=$this->projects_model->doAddproject();
		if($result>0){
			redirect('/admin/projects',301);
		}else{
			echo json_encode(array("success"=>false));
		}
	}	
	
   	public function edit()
	{
		 //permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(3)){
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/editprojects',$data);
		} else {
		//permission setting//

		$data["project"]=$this->projects_model->SearchProject();
        $this->load->view('admin/editprojects',$data);
		}
	}
	public function editproject()
	{
		
		header('content-type: application/json; charset=utf-8');
		$result=$this->projects_model->doupdateproject();
		if($result>0){
			redirect('/admin/projects',301);
		}else{
			echo json_encode(array("success"=>false));
		}
	}
	public function deleteproject()
	{	
		//permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(5)){
		echo json_encode(array("success"=>false));
		
		} else {
		//permission setting//
		header('content-type: application/json; charset=utf-8');
		$result=$this->projects_model->doDelete();
		if($result>0)
		{
			echo json_encode(array("success"=>true));
		}else{
			echo json_encode(array("success"=>false));
		}
		}
	}
	
		public function addusers()
	{
	  //permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(22)){
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/addusers',$data);
		} else {
		//permission setting//
		$data['url']=base_url();
		$data['id'] = $this->input->get_post('keyword', true);
		$this->load->view('admin/addusers',$data);
		}
		
	}
	
	public function saveusers()
	{
		
		header('content-type: application/json; charset=utf-8');
		$result=$this->projects_model->doAddUser($id);
		if($result>0){
			redirect('/admin/projects',301);
		}else{
			echo json_encode(array("success"=>false));
		}
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */