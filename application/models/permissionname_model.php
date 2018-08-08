<?php
class permissionname_model extends CI_Model
{

	public function __construct(){
            parent::__construct();
           // $this->load->helper('url');
		   $this->load->database();
    }

	 public function fetch_data($limit,$start)
	{
		$sql1 ="SELECT module_id from module_admin where enabled='1'";
		$query=$this->db->query($sql1); 
        if ($query->num_rows() > 0) 
		{
            foreach ($query->result() as $row) {
                $data1[] = $row;
            }
			//print_r($data1);
			$mdl=$data1;
			$module_id="";
			foreach($mdl as $mdl){

				 $moduleid=$mdl->module_id; 
					$module_id.= $moduleid.",";
					 }
			}
		
		$module_id=rtrim($module_id,", ");
		
		$sql ="SELECT * from user_permissions WHERE module_id IN ($module_id) LIMIT $start,$limit";
	//echo	$sql ="SELECT * from user_permissions WHERE module_id IN ('1','2','3') LIMIT $start,$limit";
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
	$sql1 ="SELECT module_id from module_admin where enabled='1'";
		$query=$this->db->query($sql1); 
        if ($query->num_rows() > 0) 
		{
            foreach ($query->result() as $row) {
                $data1[] = $row;
            }
			//print_r($data1);
			$mdl=$data1;
			$module_id="";
			foreach($mdl as $mdl){

				 $moduleid=$mdl->module_id; 
					$module_id.= $moduleid.",";
					 }
			}
		
		$module_id=rtrim($module_id,", ");
		$sql ="SELECT count(*) as count FROM user_permissions WHERE module_id IN ($module_id)"; //die;
		$query=$this->db->query($sql); 
		return $query->result();
	}
	
	public function Fill_call_group()
	{
		$sql ="SELECT * FROM user_permissions";
		$query=$this->db->query($sql); 
		return $query->result();
	}
		public function Fill_call_group1()
	{
		$sql ="SELECT * FROM user_permissions";
		$query=$this->db->query($sql); 
		return $query->result();
	}


	public function Fill_channel_types()
	{
		$sql ="SELECT * FROM user_permissions";
		$query=$this->db->query($sql); 
		return $query->result();
	}
	public function module()
	{
		$sql ="SELECT * FROM module_admin where enabled=1";
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
		$sql = "SELECT * FROM user_permissions WHERE permission=".$id;
		
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
	
	public function doAddPermission()
	{
		$gname =$this->input->post('txtdid');	
		$module =$this->input->post('module');	
		 $sql1 ="SELECT * FROM `module_admin` where module_id='$module'";
		 $query1=$this->db->query($sql1); 
		 $name = $query1->result();// print_r($name);
		 $name = $name[0]->modulename;
		
		$sql = "INSERT INTO `user_permissions`(`permission`, `value`,`module_id`,`modulename`) VALUES 
		('','$gname','$module','$name')";
		$query=$this->db->query($sql); 
		return $this->db->affected_rows();
	}
	
	public function doDeletePermission()
	{
		$this->load->database();
		$permission=$this->input->post('groupid');
		
		$sql = "delete from `user_permissions` where permission='$permission'";
		$query=$this->db->query($sql); 
		return $this->db->affected_rows();
	
	}
	
	public function doPermissionUpdate()
	{
		$groupid =$this->input->post('id');	
		$gname =$this->input->post('txtdid');	
		$module =$this->input->post('module');
		 $sql1 ="SELECT * FROM `module_admin` where module_id='$module'";
		 $query1=$this->db->query($sql1); 
		 $name = $query1->result();// print_r($name);
		 $name = $name[0]->modulename;
		
		
		$update = "UPDATE `user_permissions` SET `value`='$gname' , `module_id`='$module',`modulename`='$name' WHERE permission='$groupid'";
		$query=$this->db->query($update); 
		//die;
		return true;
	}
}
?>


