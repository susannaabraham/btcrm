<?php
class expense_model extends CI_Model
{

	public function __construct(){
            parent::__construct();
           // $this->load->helper('url');
		   $this->load->database();
    }

	
	public function dropdown()
	{
		$project_id=$this->input->post("project_id");
			$sql ="SELECT status FROM projects where id='$project_id'";
			$query=$this->db->query($sql); 
			$project=$query->result();
			$status=$project[0]->status;
	//	if($status=="1"){
		$sql1 ="SELECT * from expense_type where project_status='$status'";
		$query=$this->db->query($sql1);
		$row=$query->result();		
		$return="<select name=\"expense_type\" class=\"form-control\">";
        if ($query->num_rows() > 0) 
		{
			$short="";
          // $short=($db_val=="ivr-".$row->id.",s,1")?"selected":"";
				$return .='<option  value="'.$row[0]->exp_id.'" '.$short.' >'.$row[0]->exp_name.'</option>';
			
			$return .='</select>';
            return $return;
        }
		//}
		 return false;
	}	
	
	public function fetch_data($limit,$start)
	{
		
		$sql ="SELECT * FROM expense where 1=1";
		$project=($this->input->get("project",true)) ? $this->input->get("project",true) : 0;
		if(!empty($project))
		{
			$sql .=" AND `project_id` = '$project' ";
		}
		$expense_type=($this->input->get("expense_type",true)) ? $this->input->get("expense_type",true) : 0;
		if(!empty($expense_type))
		{
			$sql .=" AND `expense_type` = '$expense_type' ";
		}
		 $caldate=($this->input->get("single_cal1",true)) ? $this->input->get("single_cal1",true) : 0;
		if($caldate!=0){
		$arr = explode('-',$caldate, 2);
		$_from=$arr[0];
		$_to=$arr[1];
		}
		
		if(!empty($_from)&&!empty($_to))
		{
			$_from = str_replace('/', '-', $_from);
			$date = date_create($_from);
            $_from=date_format($date, 'Y-m-d H:i:s');
			$_to = str_replace('/', '-', $_to);
			$date2 = date_create($_to);
			$_to=date_format($date2, 'Y-m-d H:i:s');
			if($_from==$_to){
				
				$_to= $_to ." 23:59:59";
			}
			
			$sql .=" AND (posted_date BETWEEN '$_from' AND '$_to') "; 
		} 
		
		$sql .=" ORDER BY `expense_id` desc LIMIT $start,$limit";
      
			   
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
		$sql ="SELECT count(*) as count FROM expense where 1=1 ";
					   
		$name=($this->input->get("name",true)) ? $this->input->get("name",true) : 0;
		if(!empty($name))
		{
			$sql .=" AND `project_id` = '$name' ";
		}
		  
	 
		$sql .=" ORDER BY `expense_id` ";
      
		
		
		$query=$this->db->query($sql);
		return $query->result();
	}
	public function fetchprojects()
	{
		$current_user=$this->session->userdata('id');
		$sql = "SELECT * FROM projects";
		$query=$this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
			$users=	$row->users; 
				$user=(explode(",",$users)); 
				for($i=0;$i<count($user);$i++){ 
				if($user[$i]==$current_user){
                $data[] = $row; 
				//print_r($data);
				}
				}
            }
            return $data;
        } //die;
        return false;
	}
	public function users()
	{
		
		$sql = "SELECT * FROM `admin_login` ";
		$query=$this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
			
                $data[] = $row; 
				
            }
            return $data;
        } //die;
        return false;
	}public function expense_type()
	{
		
		$sql = "SELECT * FROM expense_type where active=1";
		$query=$this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
			
                $data[] = $row; 
				
            }
            return $data;
        } //die;
        return false;
	}
	public function expense_sub_type()
	{
		
		$sql = "SELECT * FROM expense_sub_type where active=1";
		$query=$this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
			
                $data[] = $row; 
				
            }
            return $data;
        } //die;
        return false;
	}
	public function doAddexpense()
	{

			$project_id=$this->input->post('project');
			$expense_type=$this->input->post('expense_type');
			$discription=$this->input->post('discription');
			$expense_sub_type=$this->input->post('expense_sub_type');
			$cost=$this->input->post('cost');
			$posted_by=$this->input->post('users');
			//$posted_by=$this->session->userdata('login_id');
			$create_date=$this->input->post('create_date');
			$create_date = str_replace('/', '-', $create_date);
			$date = date_create($create_date);
            $create_date=date_format($date, 'Y-m-d H:i:s');

			$data = array(
				'project_id' => $project_id,
				'expense_type' => $expense_type,
				'discription' => $discription,
				'expense_sub_type' => $expense_sub_type,
				'cost' => $cost,
				'posted_by' => $posted_by,
				'posted_date' => $create_date
			);

			$this->db->insert('expense', $data);
		    $cid =$this->db->insert_id();


		return 1;
	}
	
	public function Searchexpense()
	{
		$expense_id = $this->input->get_post('keyword', true);
		$sql = "SELECT * FROM expense Where expense_id=".$expense_id;

		$query=$this->db->query($sql);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
			//print_r($data);
            return $data;
        }
        return false;
	}
	public function doupdateexpense()
	{
			$expense_id=$this->input->post('expense_id');
			$project_id=$this->input->post('project');
			$expense_type=$this->input->post('expense_type');
			$discription=$this->input->post('discription');
			$expense_sub_type=$this->input->post('expense_sub_type');
			$cost=$this->input->post('cost');
			$posted_by=$this->input->post('users');
			//$posted_by=$this->session->userdata('login_id');
			$create_date=$this->input->post('create_date');
			$create_date = str_replace('/', '-', $create_date);
			$date = date_create($create_date);
            $create_date=date_format($date, 'Y-m-d H:i:s');

			$data = array(
				'project_id' => $project_id,
				'expense_type' => $expense_type,
				'discription' => $discription,
				'expense_sub_type' => $expense_sub_type,
				'cost' => $cost,
				'posted_date' => $create_date,
				'posted_by' => $posted_by
			);
		$this->db->where('expense_id', $expense_id);
		$this->db->update('expense', $data);


		return true;
	}
	public function doDelete()
	{

		$expense_id=$this->input->post('expense_id');
		 $sql = "delete from expense where expense_id='$expense_id'";
		$query=$this->db->query($sql);
		return $this->db->affected_rows();
	}
	

}
?>
