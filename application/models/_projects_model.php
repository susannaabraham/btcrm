<?php
class projects_model extends CI_Model
{

	public function __construct(){
            parent::__construct();
           // $this->load->helper('url');
		   $this->load->database();
    }

	public function fetch_data($limit,$start)
	{
		$sql ="SELECT * FROM projects where 1=1";
		$name=($this->input->get("name",true)) ? $this->input->get("name",true) : 0;
		if(!empty($name))
		{
			$sql .=" AND `name` = '$name' ";
		}
		$type=($this->input->get("type",true)) ? $this->input->get("type",true) : "";
		
		if(!empty($type))
		{
			//echo $to;
			$sql .=" AND `type` = '$type' ";
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
		$sql ="SELECT count(*) as count FROM projects where 1=1 ";
					   
		$name=($this->input->get("name",true)) ? $this->input->get("name",true) : 0;
		if(!empty($name))
		{
			$sql .=" AND `name` = '$name' ";
		}
		$type=($this->input->get("type",true)) ? $this->input->get("type",true) : "";
		
		if(!empty($type))
		{
			//echo $to;
			$sql .=" AND `type` = '$type' ";
		}   
	 
		$sql .=" ORDER BY `id` ";
      
		
		
		$query=$this->db->query($sql);
		return $query->result();
	}
	public function doAddproject()
	{

			$name=$this->input->post('name');
			$description=$this->input->post('description');
			$type=$this->input->post('type');
			$startdate=$this->input->post('startdate');
			$contact_person=$this->input->post('contact_person');
			$contact_number=$this->input->post('contact_number');
			$email=$this->input->post('email');
			$status=$this->input->post('status');
			$data = array(
				'name' => $name,
				'description' => $description,
				'type' => $type,
				'startdate' => $startdate,
				'contact_person' => $contact_person,
				'phone' => $contact_number,
				'email' => $email,
				'status'=>$status
			);

			$this->db->insert('projects', $data);
		    $cid =$this->db->insert_id();


		return 1;
	}	
	public function doAddUser($id)
	{

			$id = $this->input->post('id', true);
			$users=$this->input->post('users');
			$user = implode (", ", $users);
			
			$data = array(
				'users'=>$user
			);

		$this->db->where('id', $id);
		$this->db->update('projects', $data);

		return 1;
	}
	
	public function SearchProject()
	{
		$id = $this->input->get_post('keyword', true);
		$sql = "SELECT * FROM projects Where id=".$id;

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
	public function doupdateproject()
	{
			$id=$this->input->post('id');
			$name=$this->input->post('name');
			$description=$this->input->post('description');
			$type=$this->input->post('type');
			$startdate=$this->input->post('startdate');
			$contact_person=$this->input->post('contact_person');
			$contact_number=$this->input->post('contact_number');
			$email=$this->input->post('email');
			$status=$this->input->post('status');
		$data = array(
				'name' => $name,
				'description' => $description,
				'type' => $type,
				'startdate' => $startdate,
				'contact_person' => $contact_person,
				'phone' => $contact_number,
				'email' => $email,
				'status'=>$status
		);
		$this->db->where('id', $id);
		$this->db->update('projects', $data);


		return true;
	}
	public function doDelete()
	{

		$id=$this->input->post('id');
		echo $sql = "delete from projects where id=".$id;
		$query=$this->db->query($sql);
		return $this->db->affected_rows();
	}
	

}
?>
