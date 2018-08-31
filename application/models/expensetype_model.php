<?php
class expensetype_model extends CI_Model
{

	public function __construct(){
            parent::__construct();
           // $this->load->helper('url');
		   $this->load->database();
    }

	public function fetch_data($limit,$start)
	{
		$sql ="SELECT * FROM expense_type where `active`=1";
		$exp_name=($this->input->get("exp_name",true)) ? $this->input->get("exp_name",true) : 0;
		if(!empty($exp_name))
		{
			$sql .=" AND `exp_name` = '$exp_name' ";
		}
		
		$sql .=" ORDER BY `exp_id` desc LIMIT $start,$limit";
      
			   
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
		$sql ="SELECT count(*) as count FROM expense_type where `active`=1 ";
					   
		$exp_name=($this->input->get("exp_name",true)) ? $this->input->get("exp_name",true) : 0;
		if(!empty($exp_name))
		{
			$sql .=" AND `exp_name` = '$exp_name' ";
		}
		  
	 
		$sql .=" ORDER BY `exp_id` ";
      
		
		
		$query=$this->db->query($sql);
		return $query->result();
	}
	public function doAddexpensetype()
	{

			$exp_name=$this->input->post('exp_name');

			$data = array(
				'exp_name' => $exp_name
			);

			$this->db->insert('expense_type', $data);
		    $cexp_id =$this->db->insert_id();


		return 1;
	}
	
	public function Searchexpense_type()
	{
		$exp_id = $this->input->get_post('keyword', true);
		$sql = "SELECT * FROM expense_type Where exp_id=".$exp_id;

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
	public function doupdateexpensetype()
	{
		$exp_id=$this->input->post('exp_id');
		$exp_name=$this->input->post('exp_name');

		$data = array(
				'exp_name' => $exp_name
		);
		
		$this->db->where('exp_id', $exp_id);
		$this->db->update('expense_type', $data);


		return true;
	}
	public function doDelete()
	{

		$exp_id=$this->input->post('exp_id');		
		$data = array(
				'active' =>'0'
		);
		$this->db->where('exp_id', $exp_id);
		$this->db->update('expense_type', $data);
		return $this->db->affected_rows();
	}
	

}
?>
