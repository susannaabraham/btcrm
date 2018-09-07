<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class expensetype extends Domain_Controller {

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
			$this->load->model('expensetype_model');
			$this->load->library("pagination");
       }

	public function index()
	{ 
		//permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(38)){ 
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/expensetype',$data);
		} else {  
		//permission setting//
		$data['url']=base_url();
		$config = array();
		$config["base_url"] = base_url('admin/expensetype/index');
	    $config["per_page"] =10;
		$config["uri_segment"] =4;
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		
		$count = $this->expensetype_model->record_count(); 
		$config['total_rows'] = $count[0]->count;
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		if($page>$count[0]->count)		
		{
			$page=0;
		}
		
		$data["results"] = $this->expensetype_model->fetch_data($config["per_page"], $page); 
		$data["links"] = $this->pagination->create_links();
		$this->load->view('admin/expensetype',$data);
		}
	}

	public function addexpensetype()
	{
	  //permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(39)){
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/addexpensetype',$data);
		} else {
		//permission setting//
		$data['url']=base_url();
		$this->load->view('admin/addexpensetype',$data);
		}
		
	}
	public function saveexpensetype()
	{
		
		header('content-type: application/json; charset=utf-8');
		$result=$this->expensetype_model->doAddexpensetype();
		if($result>0){
			redirect('/admin/expensetype',301);
		}else{
			echo json_encode(array("success"=>false));
		}
	}
   	public function edit()
	{
		 //permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(40)){
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/editexpensetype',$data);
		} else {
		//permission setting//

		$data["expensetype"]=$this->expensetype_model->Searchexpense_type();
        $this->load->view('admin/editexpensetype',$data);
		}
	}
	public function editexpensetype()
	{
		
		header('content-type: application/json; charset=utf-8');
		$result=$this->expensetype_model->doupdateexpensetype();
		if($result>0){
			redirect('/admin/expensetype',301);
		}else{
			echo json_encode(array("success"=>false));
		}
	}
	public function deleteexpensetype()
	{	
		//permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(41)){
		echo json_encode(array("success"=>false));
		
		} else {
		//permission setting//
		header('content-type: application/json; charset=utf-8');
		$result=$this->expensetype_model->doDelete();
		if($result>0)
		{
			echo json_encode(array("success"=>true));
		}else{
			echo json_encode(array("success"=>false));
		}
		}
	}
	
	
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */