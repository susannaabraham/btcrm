<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('login_model');
	}

	public function index()
	{		
		$data['url']=base_url();
	    $this->load->view('admin/login',$data);	
	}
	public function login1()
	{
		$user=$this->input->post('username');
		$pass=$this->input->post('password');
		//print_r($pass);
		$duser=$this->login_model->adminLogin($user,$pass);
		print_r(count($duser));
		if(count($duser)>0)
		{
		
			$this->load->model('user_model');
			$this->session->set_userdata('user_login',true);
			$this->session->set_userdata('login_id',$duser[0]->uname);
			$this->session->set_userdata('id',$duser[0]->id);
			$this->session->set_userdata('mode',$duser[0]->mode);
				echo $duser[0]->groups;
			/// dashboard,inbound report, outbound report //Anchu
			$data['groups'] =$this->session->set_userdata('groups',$duser[0]->groups);
//die;
			// set user permission/11-02-2017/susanna////////
			
			$group=$this->user_model->getGroupById($duser[0]->mode);
			$this->session->set_userdata('permissions',unserialize($group[0]->permissions));
			//print_r(unserialize($group[0]->permissions));
			//print_r($this->session->userdata('permissions'));
			//die();
			// set user permission/11-02-2017/susanna////////
			//	print_r($this->session->userdata('login_id'));

			//if(!empty($duser[0]->groups)){
			if(!empty($duser[0]->dashboard)){
				
				redirect($duser[0]->dashboard,301);
				
			}else{
				
					if(($duser[0]->groups)!=0){

						redirect('/admin/tasks',301);

					}else{

						redirect('/admin/tasks',301);
					}
			}
		}
		else
		{
			redirect('/admin/login',301);
		}
	}
	
	//02-06-2016 Profile Menu to Change Password By Archana
	/*************************************************************************/
	public function profile()
	{	
		$data['url']=base_url();
	    $this->load->view('admin/profile',$data);		
	}
	
	public function changepwd()
	{
		header('content-type: application/json; charset=utf-8');			
		$result=$this->login_model->doPwdUpdate();
		if($result>0){
			//echo json_encode(array("success"=>true));
			redirect("/admin/logout");
		}else{
			echo json_encode(array("success"=>false));
		}
	
	}
	
}