<?php
class expense_model extends CI_Model
{

	public function __construct(){
            parent::__construct();
           // $this->load->helper('url');
		   $this->load->database();
    }

	public function fetch_data($limit,$start)
	{
		$sql ="SELECT * FROM expense where 1=1";
		$name=($this->input->get("name",true)) ? $this->input->get("name",true) : 0;
		if(!empty($name))
		{
			$sql .=" AND `project_id` = '$name' ";
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
	public function doAddexpense()
	{

			$project_id=$this->input->post('project');
			$expense_type=$this->input->post('expense_type');
			$discription=$this->input->post('discription');
			$transport_cost=$this->input->post('transport_cost');
			$travel_cost=$this->input->post('travel_cost');
			$stay_cost=$this->input->post('stay_cost');
			$posted_by=$this->session->userdata('login_id');
			$posted_date=date("Y-m-d H:i:s");

			$data = array(
				'project_id' => $project_id,
				'expense_type' => $expense_type,
				'discription' => $discription,
				'transport_cost' => $transport_cost,
				'travel_cost' => $travel_cost,
				'stay_cost' => $stay_cost,
				'posted_by' => $posted_by,
				'posted_date' => $posted_date
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
			$expense_type=$this->input->post('expense_type');
			$discription=$this->input->post('discription');
			$transport_cost=$this->input->post('transport_cost');
			$travel_cost=$this->input->post('travel_cost');
			$stay_cost=$this->input->post('stay_cost');
			$posted_by=$this->session->userdata('login_id');
			$posted_date=date("Y-m-d H:i:s");

			$data = array(
				//'project_id' => $project_id,
				'expense_type' => $expense_type,
				'discription' => $discription,
				'transport_cost' => $transport_cost,
				'travel_cost' => $travel_cost,
				'stay_cost' => $stay_cost
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
