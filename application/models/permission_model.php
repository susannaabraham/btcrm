<?php
class permission_model extends CI_Model
{

	public function __construct(){
            parent::__construct();
           // $this->load->helper('url');
		   $this->load->database();
    }

	 public function fetch_data($limit,$start)
	{
		$sql ="SELECT * from user_permissions LIMIT $start,$limit";
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
	 public function getGroups(){ 

	   $query = $this->db->get("user_groups");
	   return $query->result();
   }
	public function record_count()
	{
		$sql ="SELECT count(*) as count FROM user_permissions";
		$query=$this->db->query($sql); 
		return $query->result();
	}
	
	public function Fill_call_group()
	{
		$sql ="SELECT * FROM user_groups";
		$query=$this->db->query($sql); 
		return $query->result();
	}
		public function Fill_call_group1()
	{
		$sql1 ="SELECT * from module_admin where enabled='1'";
		$query=$this->db->query($sql1); 
        if ($query->num_rows() > 0) 
		{
            foreach ($query->result() as $row) {
                $data1[] = $row;
            }
			//print_r($data1);
			/* $mdl=$data1;
			$module_id="";
			foreach($mdl as $mdl){

				 $moduleid=$mdl->module_id; 
					$module_id.= $moduleid.",";
					 }*/
			}
		
	//	$module_id=rtrim($module_id,", "); 
		
		/* $sql ="SELECT * from user_permissions WHERE module_id IN ($module_id)";
		$query=$this->db->query($sql);  */
		//return $query->result();
		return $data1;
	}


	public function Fill_channel_types()
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
		
		$sql ="SELECT * from user_permissions WHERE module_id IN ($module_id)";
		//$sql ="SELECT * FROM user_permissions";
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
		$sql = "SELECT * FROM user_groups WHERE groupid=".$id;
		
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
		$permission = $this->input->post('permissions');	
		$b=serialize($permission);
		
		$sql = "INSERT INTO `user_groups`(`groupid`, `groupname`, `permissions`) VALUES 
		('','$gname','$b')";
		$query=$this->db->query($sql); 
		
		//create file//
		/* $ext = ".txt";

		  $filename = $namef.$ext;

		  $file = fopen($filename,"w+");

		  fwrite($file, $privatekey);

		  fclose($file);

		  chmod($file,0777); */
		//create file//
		
		
		return $this->db->affected_rows();
	}
	
	public function doDeletePermission()
	{
		$this->load->database();
		$groupid=$this->input->post('groupid');
		
		$sql = "delete from `user_groups` where groupid='$groupid'";
		$query=$this->db->query($sql); 
		return $this->db->affected_rows();
	
	}
	
	public function doPermissionUpdate()
	{
		$groupid =$this->input->post('id');	
		$gname =$this->input->post('txtdid');	
		$permission = $this->input->post('permissions');	
		$b=serialize($permission);
		
		
		$update = "UPDATE `user_groups` SET `groupname`='$gname',`permissions`='$b' WHERE groupid='$groupid'";
		$query=$this->db->query($update); 
		
		return true;
	}
}
?>


