<?php
class user_model extends CI_Model
{

	public function __construct(){
            parent::__construct();
           // $this->load->helper('url');
		   $this->load->database();
    }

	public function fetch_data($limit,$start)
	{
		$sql ="SELECT admin_login.uname,user_groups.groupname,admin_login.id from `admin_login` INNER JOIN `user_groups` ON user_groups.groupid WHERE user_groups.groupid = admin_login.mode LIMIT $start,$limit";
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
		$sql ="SELECT count(*) as count FROM `admin_login`";
		$query=$this->db->query($sql); 
		return $query->result();
	}
	
	public function Fill_Mode()
	{
		$sql ="SELECT * FROM user_groups";
		$query=$this->db->query($sql); 
		return $query->result();
	}
	
	public function doAddUser()
	{
		$username =$this->input->post('txtusername');	
		$pwd =$this->input->post('txtpwd');	
		$mode =$this->input->post('selectmode');
		
		
		$data = array(
				'uname' =>$username,				
				'pass' =>$pwd,
				'mode'=>$mode 	
			);		
		
		
		$this->db->insert('admin_login', $data);
		return $this->db->insert_id();
	}
	
	public function doDeleteUser()
	{
		$this->load->database();
		$id=$this->input->post('id');	
		
		//second delete data from parent table
		$sql = "delete from admin_login where id =".$id;
		$query=$this->db->query($sql); 
		
		return $this->db->affected_rows();
	}
	
	public function search()
	{
		$id = $this->input->get_post('keyword', true);
		$sql = "SELECT * FROM `admin_login` WHERE id=".$id;
		
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
	
	public function doUserUpdate()
	{
		$this->load->database();
		$id=$this->input->post('uid');
		
		$username =$this->input->post('txtusername');	
		$pwd =$this->input->post('txtpwd');	
		$mode =$this->input->post('selectmode');
		
		
		$data = array(
				'uname' =>$username,				
				'pass' =>$pwd,
				'mode'=>$mode 	
			);	
			
		$this->db->where('id', $id);
		$this->db->update('admin_login', $data);
		return true;
	}
	 ///permission/11-02-2017/susanna/////////
   public function getpermissions(){ 

	   $query = $this->db->get("user_permissions");
	   return $query->result();
   }
   
   public function group_record_count() {
        return $this->db->count_all("user_groups");
   }
   
   
   public function fetch_group($limit, $start) {

		$sql = "SELECT `user_groups` . * FROM `user_groups` LIMIT $start , $limit";
		$query=$this->db->query($sql); 
 
        if ($query->num_rows() > 0) {

            return $query->result();
        }
        return false;
   }
   
   public function getGroupById($id){
   
		$sql = "SELECT user_groups.* FROM `user_groups`  WHERE groupid=?";
		$query=$this->db->query($sql,array($id)); 
		return $query->result();
   }
   
   public function haspermission2($permissionid){
		 //echo $permissionid."cccccccccccccccccccc";
		$p=$this->session->userdata('mode');
		$data=$this->getGroupById($p);
		$p=unserialize($data[0]->permissions);
		//print_r($data); echo"---------------"; echo $permissionid; echo"----------";
		//print_r($p);
		return array_search($permissionid,$p); 
		
		
		/* //echo $permissionid."cccccccccccccccccccc";
		$p=$this->session->userdata('permissions');
		//print_r($p);
		return array_search($permissionid,$p); */
		
		
	}	
}
?>


