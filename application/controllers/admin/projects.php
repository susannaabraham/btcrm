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
	
	/* 	public function addusers()
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
		
	} */
	
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
	
	public function addusers(){
				$this->load->database();
				$id= $this->input->get_post('keyword', true);
				$sql1 ="SELECT * from projects where id='".$id."' ";
									$query1=$this->db->query($sql1); 
									$res1=$query1->result();
									$users=$res1[0]->users;
									$myArray = explode(',', $users);
									
									
									$sql2 ="SELECT `permission` from `permission` where project='".$id."' ";
									$query2=$this->db->query($sql2);
									//print_r($query2->num_rows());
									foreach ($query2->result() as $row2) {
									$permission[] = $row2; 
									} 
									 //print_r($query2->result());
									//print_r($permission[0]->permission);
									$prmsn=array('','1','2','3');
/* print_r($prmsn);
print_r($myArray); */
									$sql ="SELECT * from admin_login ";
									$query=$this->db->query($sql); 
									$res=$query->result();
									echo "<form id='addcontact' class='form-horizontal form-label-left' method='post'>";
									echo " <input type='hidden' class='id' name='cid' value='".$id."'>";
								 	for($j=0;$j<count($res);$j++){
									if(in_array($res[$j]->id, $myArray)){ $c="checked"; }else{ $c="";}
									if ($query2->num_rows()!=0){
									if($permission[$j]->permission=='1'){ $a="selected"; }else{ $a="";}
									if($permission[$j]->permission=='2'){ $b="selected"; }else{ $b="";}
									if($permission[$j]->permission=='3'){ $d="selected"; }else{ $d="";}
									}
									echo "<div class='item form-group'><div class='col-md-5 col-sm-5 col-xs-12'><label><input class='userid' type='checkbox' name='users' value='".$res[$j]->id."' ".$c."> ".$res[$j]->uname."</label></div><div class='col-md-5 col-sm-5 col-xs-12'><select name='permission' class='form-control permission'  ><option value='0' ".$y.">Select Permission".$permission[$j]->permission."</option><option ".$a." value='1'>Read</option><option ".$b." value='2'>Write</option><option ".$d." value='3'>Read & Write</option></select></div></div>";
					 	echo "</form>";
						}  
	} 
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */