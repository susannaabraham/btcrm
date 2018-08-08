<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends Domain_Controller {

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
			$this->load->model('user_model');
			$this->load->library("pagination");
       }

	public function index()
	{	
		
	}	
	
	public function listall(){
		
		$data['url']=base_url();
		$config = array();
		$config["base_url"] = base_url('admin/user/listall');
	    $config["per_page"] = 3;
		$config["uri_segment"] =4;
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		
		$count = $this->user_model->record_count(); 
		$config['total_rows'] = $count[0]->count;
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		if($page>$count[0]->count)		
		{
			$page=0;
		}
		//echo "dsdddd";
		$data["results"] = $this->user_model->fetch_data($config["per_page"], $page); 
		$data["links"] = $this->pagination->create_links();
		$this->load->view('admin/users',$data);
	
	}
	
	public function adduser()
	{
		$data['url']=base_url();
		
		$data["mode"] = $this->user_model->Fill_Mode();
		$this->load->view('admin/adduser',$data);
	}
	
	public function savenewuser()
	{
		header('content-type: application/json; charset=utf-8');
		$this->load->model('user_model');		
		$result=$this->user_model->doAddUser();
		if($result>0){
			redirect("/admin/user/listall");
			//echo json_encode(array("success"=>true));
		}else{
			echo json_encode(array("success"=>false));
		}
	}
	
	public function deleteuser()
	{
		header('content-type: application/json; charset=utf-8');
		$this->load->model('user_model');	
		$result=$this->user_model->doDeleteUser();
		
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
	
	public function edituser()
	{
		$data['url']=base_url();
		
		$data["mode"] = $this->user_model->Fill_Mode();
		$data['results']=$this->user_model->search();
		
		$this->load->view('admin/edituser',$data);
	}
	
	public function updateuser()
	{
		header('content-type: application/json; charset=utf-8');			
		$result=$this->user_model->doUserUpdate();
		if($result>0){
			//echo json_encode(array("success"=>true));
			redirect("admin/user/listall");
		}else{
			echo json_encode(array("success"=>false));
		}
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */