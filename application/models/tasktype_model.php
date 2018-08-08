<?php
class tasktype_model extends CI_Model
{

	public function __construct(){
            parent::__construct();
           // $this->load->helper('url');
		   $this->load->database();
    }

	public function fetch_data($limit,$start)
	{
		$sql ="SELECT * FROM tasktype where 1=1";
		$name=($this->input->get("name",true)) ? $this->input->get("name",true) : 0;
		if(!empty($name))
		{
			$sql .=" AND `name` = '$name' ";
		}
		
		$sql .=" ORDER BY `id` desc LIMIT $start,$limit";
      
			   
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
		$sql ="SELECT count(*) as count FROM tasktype where 1=1 ";
					   
		$name=($this->input->get("name",true)) ? $this->input->get("name",true) : 0;
		if(!empty($name))
		{
			$sql .=" AND `name` = '$name' ";
		}
		  
	 
		$sql .=" ORDER BY `id` ";
      
		
		
		$query=$this->db->query($sql);
		return $query->result();
	}
	public function doAddtasktype()
	{

			$name=$this->input->post('name');

			$data = array(
				'name' => $name
			);

			$this->db->insert('tasktype', $data);
		    $cid =$this->db->insert_id();


		return 1;
	}
	
	public function Searchtasktype()
	{
		$id = $this->input->get_post('keyword', true);
		$sql = "SELECT * FROM tasktype Where id=".$id;

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
	public function doupdatetasktype()
	{
			$id=$this->input->post('id');
			$name=$this->input->post('name');

		$data = array(
				'name' => $name
		);
		$this->db->where('id', $id);
		$this->db->update('tasktype', $data);


		return true;
	}
	public function doDelete()
	{

		$id=$this->input->post('id');
		echo $sql = "delete from tasktype where id=".$id;
		$query=$this->db->query($sql);
		return $this->db->affected_rows();
	}
	

}
?>
