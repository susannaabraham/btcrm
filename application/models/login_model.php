<?php
class login_model extends CI_Model{

	public function __construct()
    {
		parent::__construct();
	    $this->load->database();
	   	$this->load->library('session');
    }	
	   
	public function doLogin($user,$pass){
		$this->load->database();
		$this->db->select('*');
		$this->db->where('uname =',$user);
		$this->db->where('pass =',$pass);
		$this->db->limit(1);
		$this->db->from('agents');
		$query = $this->db->get();
		//print_r($pass);
		
		return $query->result();
	}
	
	public function adminLogin($user,$pass)
	{		
		
		$sql = "SELECT * FROM admin_login Where `uname`='".$user."' and `pass`=MD5('".$pass."')";
		$query=$this->db->query($sql);
		return $query->result();
	}
	
	public function doPwdUpdate()
	{
		$this->load->database();
		$cnfrmpwd=$this->input->post('txtconfrimpwd');
		$newpwd=$this->input->post('txtnewpwd');
		
		$id = $this->session->userdata('id');
		
		print_r($id);
		
		$data = array(
				'pass' =>$newpwd);

		$this->db->where('id', $id);
		$this->db->update('admin_login', $data);
		return true;			
	}
	
}
?>