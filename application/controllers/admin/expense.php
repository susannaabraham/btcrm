<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class expense extends Domain_Controller {

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
			$this->load->model('expense_model');
			$this->load->library("pagination");
       }

	public function index()
	{ 
		//permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(28)){ 
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/expense',$data);
		} else {  
		//permission setting//
		$data['url']=base_url();
		$config = array();
		$config["base_url"] = base_url('admin/expense/index');
	    $config["per_page"] =10;
		$config["uri_segment"] =4;
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		
		$count = $this->expense_model->record_count(); 
		$config['total_rows'] = $count[0]->count;
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		if($page>$count[0]->count)		
		{
			$page=0;
		}
		
		$data["results"] = $this->expense_model->fetch_data($config["per_page"], $page); 
		$data["links"] = $this->pagination->create_links();
		$data['projects']=$this->expense_model->fetchprojects(); 
		$data['expense_type']=$this->expense_model->expense_type();
		$this->load->view('admin/expense',$data);
		}
	}

	public function addexpense()
	{
	  //permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(29)){
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/addexpense',$data);
		} else {
		//permission setting//
		$data['url']=base_url();
		$data['projects']=$this->expense_model->fetchprojects(); //print_r($data['projects']);
		$data['users']=$this->expense_model->users(); //print_r($data['projects']);
		$data['expense_type']=$this->expense_model->expense_type(); //print_r($data['expense_type']);
		$data['expense_sub_type']=$this->expense_model->expense_sub_type(); //print_r($data['projects']);
		$this->load->view('admin/addexpense',$data);
		}
		
	}
	public function saveexpense()
	{
		
		header('content-type: application/json; charset=utf-8');
		$result=$this->expense_model->doAddexpense();
		if($result>0){
			redirect('/admin/expense',301);
		}else{
			echo json_encode(array("success"=>false));
		}
	}
   	public function edit()
	{
		 //permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(30)){
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/editexpense',$data);
		} else {
		//permission setting//

		$data["expense"]=$this->expense_model->Searchexpense();
		$data['projects']=$this->expense_model->fetchprojects(); 
		$data['users']=$this->expense_model->users();
		$data['expense_type']=$this->expense_model->expense_type(); //print_r($data['expense_type']);
		$data['expense_sub_type']=$this->expense_model->expense_sub_type(); //print_r($data['projects']);
		
        $this->load->view('admin/editexpense',$data);
		}
	}
	public function editexpense()
	{
		
		header('content-type: application/json; charset=utf-8');
		$result=$this->expense_model->doupdateexpense();
		if($result>0){
			redirect('/admin/expense',301);
		}else{
			echo json_encode(array("success"=>false));
		}
	}
	public function deleteexpense()
	{	
		//permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(31)){
		echo json_encode(array("success"=>false));
		
		} else {
		//permission setting//
		header('content-type: application/json; charset=utf-8');
		$result=$this->expense_model->doDelete();
		if($result>0)
		{
			echo json_encode(array("success"=>true));
		}else{
			echo json_encode(array("success"=>false));
		}
		}
	}
	
	
	public function drpdwn()
	{
		$data['url']=base_url();
		echo $this->expense_model->dropdown();
				
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */