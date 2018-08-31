<?php
class admin_model extends CI_Model
{

	public function __construct(){
            parent::__construct();
           // $this->load->helper('url');
		   $this->load->database();
    }

	 public function fetch_data($limit,$start)
	{
		$sql ="SELECT * from admin_login LIMIT $start,$limit";
		$query=$this->db->query($sql); 
        if ($query->num_rows() > 0) 
		{
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
			
            return $data;
        }
        return false;
    } 
	public function record_count()
	{
		$sql ="SELECT count(*) as count FROM admin_login";
		$query=$this->db->query($sql); 
		return $query->result();
	}
	
	public function Fill_call_group()
	{
		$sql ="SELECT * FROM admin_login";
		$query=$this->db->query($sql); 
		return $query->result();
	}
	

	public function Fill_channel_types()
	{
		$sql ="SELECT * FROM user_groups";
		$query=$this->db->query($sql); 
		return $query->result();
	}
	
	/* public function chkdid($usr) {
        $qry = "SELECT count(*) as cnt from user_permissions where did= ?";
        $res = $this->db->query($qry,array($usr))->result();
        if ($res[0]->cnt > 0) {
            echo '1';
        } else {
            echo '0';
        }
    } */
	
	public function search()
	{
		$id = $this->input->get_post('keyword', true);
		$sql = "SELECT * FROM admin_login WHERE id=".$id;
		
		$query=$this->db->query($sql); 
		
        if ($query->num_rows() > 0) 
		{
            foreach ($query->result() as $row) 
			{
                $data[] = $row;
            }
			//print_r($data);
            return $data;
        }
        return false;
	}
	
	public function doAddAdmin()
	{
		$username =$this->input->post('username');	
		$password =$this->input->post('password');	
		$pass =md5($password);
		$dashboard =$this->input->post('dashboard');	
		$email =$this->input->post('email');	
		$mode = $this->input->post('mode');	
		$gid = $this->input->post('gid');
		 $first=$gid[0]; 
		if($first=="0")
		{ $gid=array("0"); } 
		$gid=implode(",", $gid);
		
		
		$sql = "INSERT INTO `admin_login`(`id`, `uname`, `pass`, `mode`,`groups`,`dashboard`,`email`) VALUES 
		('','$username','$pass','$mode','$gid','$dashboard','$email')";
		$query=$this->db->query($sql); 
		return $this->db->affected_rows();
	}
	
	public function doDeleteAdmin()
	{
		$this->load->database();
		$id=$this->input->post('id');
		
		$sql = "delete from `admin_login` where id='$id'";
		$query=$this->db->query($sql); 
		return $this->db->affected_rows();
	
	}
	
	public function doAdminUpdate()
	{
		$id =$this->input->post('id');	
		$username =$this->input->post('username');	
		$password =$this->input->post('password');	
		$pass =md5($password);

		$dashboard =$this->input->post('dashboard');	
		$mode = $this->input->post('mode');
		$gid = $this->input->post('gid'); 
		 $first=$gid[0]; 
		if($first=="0")
		{ $gid=array("0"); } 
		$gid=implode(",", $gid);
		//print_r($gid); die;
		
		$update = "UPDATE `admin_login` SET `uname`='$username',`pass`='$pass',`mode`='$mode',`groups`='$gid',`dashboard`='$dashboard' WHERE id='$id'";
		$query=$this->db->query($update); 
		
		return true;
	}
}
?>


