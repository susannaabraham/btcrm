<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tasks extends Domain_Controller {

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
			$this->load->model('tasks_model');
			$this->load->library("pagination");
       }

	public function index()
	{ 
		//permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(2)){ 
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/tasks',$data);
		} else {  
		//permission setting//
		$data['url']=base_url();
		$config = array();
		$config["base_url"] = base_url('admin/tasks/index');
	    $config["per_page"] =10;
		$config["uri_segment"] =4;
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		
		$count = $this->tasks_model->record_count(); 
		$config['total_rows'] = $count[0]->count;
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		if($page>$count[0]->count)		
		{
			$page=0;
		}
		$data['users']=$this->tasks_model->fetchusers();
		$data['status']=$this->tasks_model->status(); //print_r($data['status']);
		$data['tasktype']=$this->tasks_model->tasktype();
		$data['projects']=$this->tasks_model->fetchprojects();
		$data["results"] = $this->tasks_model->fetch_data($config["per_page"], $page); 
		$data["links"] = $this->pagination->create_links();
		
		$this->load->view('admin/tasks',$data);
		}
	}

	public function addtasks()
	{
	  //permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(3)){
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/addtasks',$data);
		} else {
		//permission setting//
		$data['url']=base_url();
		$data['projects']=$this->tasks_model->fetchprojects();
		$data['status']=$this->tasks_model->status();
		$data['users']=$this->tasks_model->fetchusers();
		$data['tasktype']=$this->tasks_model->tasktype();
		$this->load->view('admin/addtasks',$data);
		}
		
	}
	public function savetask()
	{
		
		header('content-type: application/json; charset=utf-8');
		$result=$this->tasks_model->doAddtask();
		if($result>0){
			redirect('/admin/tasks',301);
		}else{
			echo json_encode(array("success"=>false));
		}
	}
   	public function edit()
	{ 
		 //permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(4)){
			$message='<div class="alert alert-dismissible alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Error!</strong> You don\'t have permission to access this page.</div>'; 
			$data['message']=$message;
		$this->load->view('admin/edittasks',$data);
		} else {
		//permission setting//
		$data['users']=$this->tasks_model->fetchusers();
		$data['status1']=$this->tasks_model->status();
		$data["results"]=$this->tasks_model->Searchtask();
		$data["task_results"]=$this->tasks_model->task_results();
		$data['tasktype']=$this->tasks_model->tasktype();
        $this->load->view('admin/edittask',$data);
		}
	}
	public function updatetasks()
	{
		$id=$this->input->post('id'); 
		header('content-type: application/json; charset=utf-8');
		$result=$this->tasks_model->doupdatetask();
		if($result>0){
			redirect('/admin/tasks/edit?keyword='.$id,301);
		}else{
			echo json_encode(array("success"=>false));
		}
	}
	public function deltask()
	{	
		/* //permission setting//
		$this->load->model('user_model');
		if(false===$this->user_model->haspermission2(5)){
		echo json_encode(array("success"=>false));
		
		} else {
		//permission setting// */
		header('content-type: application/json; charset=utf-8');
		$result=$this->tasks_model->doDelete();
		if($result>0)
		{
			echo json_encode(array("success"=>true));
		}else{
			echo json_encode(array("success"=>false));
		}
		// }
	}
	
	
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */