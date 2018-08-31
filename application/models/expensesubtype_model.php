<?php
class expensesubtype_model extends CI_Model
{

	public function __construct(){
            parent::__construct();
           // $this->load->helper('url');
		   $this->load->database();
    }

	public function fetch_data($limit,$start)
	{
		$sql ="SELECT * FROM expense_sub_type where `active`=1";
		$exp_subname=($this->input->get("exp_subname",true)) ? $this->input->get("exp_subname",true) : 0;
		if(!empty($exp_subname))
		{
			$sql .=" AND `exp_subname` = '$exp_subname' ";
		}
		
		$sql .=" ORDER BY `exp_subid` desc LIMIT $start,$limit";
      
			   
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
		$sql ="SELECT count(*) as count FROM expense_sub_type where `active`=1 ";
					   
		$exp_subname=($this->input->get("exp_subname",true)) ? $this->input->get("exp_subname",true) : 0;
		if(!empty($exp_subname))
		{
			$sql .=" AND `exp_subname` = '$exp_subname' ";
		}
		  
	 
		$sql .=" ORDER BY `exp_subid` ";
      
		
		
		$query=$this->db->query($sql);
		return $query->result();
	}
	public function doAddexpensesubtype()
	{

			$exp_subname=$this->input->post('exp_subname');

			$data = array(
				'exp_subname' => $exp_subname
			);

			$this->db->insert('expense_sub_type', $data);
		    $cexp_subid =$this->db->insert_id();


		return 1;
	}
	
	public function Searchexpense_sub_type()
	{
		$exp_subid = $this->input->get_post('keyword', true);
		$sql = "SELECT * FROM expense_sub_type Where exp_subid=".$exp_subid;

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
	public function doupdateexpensesubtype()
	{
		$exp_subid=$this->input->post('exp_subid');
		$exp_subname=$this->input->post('exp_subname');

		$data = array(
				'exp_subname' => $exp_subname
		);
		
		$this->db->where('exp_subid', $exp_subid);
		$this->db->update('expense_sub_type', $data);


		return true;
	}
	public function doDelete()
	{

		$exp_subid=$this->input->post('exp_subid');		
		$data = array(
				'active' =>'0'
		);
		$this->db->where('exp_subid', $exp_subid);
		$this->db->update('expense_sub_type', $data);
		return $this->db->affected_rows();
	}
	

}
?>
