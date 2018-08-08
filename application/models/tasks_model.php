<?php
class tasks_model extends CI_Model
{

	public function __construct(){
            parent::__construct();
           // $this->load->helper('url');
		   	$this->load->library('session');
		   $this->load->database();
    }

	public function fetch_data($limit,$start)
	{
		$sql ="SELECT * FROM tasks where 1=1";
		$name=($this->input->get("project",true)) ? $this->input->get("project",true) : 0;
		if(!empty($name))
		{
			$sql .=" AND `project` = '$name' ";
		}
		$user=($this->input->get("user",true)) ? $this->input->get("user",true) : 0;
		if(!empty($user))
		{
			$sql .=" AND `assignto` = '$user' ";
		}
		$status=($this->input->get("status",true)) ? $this->input->get("status",true) : "";
		
		if(!empty($status))
		{
			//echo $to;
			$sql .=" AND `status` = '$status' ";
		}   
	 
		$sql .=" ORDER BY `task_id` desc LIMIT $start,$limit";
      
			   
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
		$sql ="SELECT count(*) as count FROM tasks where 1=1 ";
					   
		$name=($this->input->get("project",true)) ? $this->input->get("name",true) : 0;
		if(!empty($name))
		{
			$sql .=" AND `project` = '$name' ";
		}
		$user=($this->input->get("user",true)) ? $this->input->get("name",true) : 0;
		if(!empty($user))
		{
			$sql .=" AND `assignto` = '$user' ";
		}
		$status=($this->input->get("status",true)) ? $this->input->get("type",true) : "";
		
		if(!empty($status))
		{
			//echo $to;
			$sql .=" AND `status` = '$status' ";
		}   
		$sql .=" ORDER BY `task_id` ";
      
		
		
		$query=$this->db->query($sql);
		return $query->result();
	}
	
	 public function doAddtask()
	{

			$project=$this->input->post('project');
			$title=$this->input->post('title');
			$assignto=$this->input->post('assignto');
			$duedate=$this->input->post('duedate');
			$priority=$this->input->post('priority');
			$tasktype=$this->input->post('tasktype');
			$description=$this->input->post('description');
			$estimated_hours=$this->input->post('estimated_hours');
			$hoursspent=$this->input->post('hours_spent');
			$notifyemail=$this->input->post('notifyemail');
			$created_by=$this->session->userdata('login_id');
			$created_date=date('Y-m-d H:i:s');
			$status=$this->input->post('status');
			if(!empty($notifyemail)){
			$n=implode(",",$notifyemail); } else {$n="";}
			
			$data = array(
				'project' => $project,
				'title' => $title,
				'assignto' => $assignto,
				'duedate' => $duedate,
				'priority' => $priority,
				'tasktype' => $tasktype,
				'description' => $description,
				'estimated_hours' => $estimated_hours,
				'hoursspent' => $hoursspent,
				'status' => $status,
				'created_by' => $created_by,
				'created_date' => $created_date,
				'notifyemail' => $n
			);

			$this->db->insert('tasks', $data);
		    $cid =$this->db->insert_id();
			
			
			$data = array(
				
				'task_id' => $cid,
				'assigned_to' => $assignto,
				'descriptions' => $description,
				'hr_spend' => $hoursspent,
				'status' => $status,
				'created_by' => $created_by,
				'created_date' => $created_date,
				'notifyemail' => $n
			);

			$this->db->insert('task_activity', $data);
		    $cid =$this->db->insert_id();

		return 1;
	} 


	public function Searchtask()
	{
		$id = $this->input->get_post('keyword', true);
		//$sql = "SELECT * FROM tasks Where task_id='$id'";
	//	$sql = "SELECT projects. * , tasks . *,tasktype.*  FROM projects INNER JOIN tasks ON projects.id = tasks.project INNER JOIN tasktype ON  tasks.tasktype=tasktype.id Where tasks.task_id='$id' order by created_date desc";
		$sql = "SELECT *,projects.name as projectname  FROM projects INNER JOIN tasks ON projects.id = tasks.project INNER JOIN tasktype ON  tasks.tasktype=tasktype.id Where tasks.task_id='$id' order by created_date desc";

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
	public function task_results()
	{
		$id = $this->input->get_post('keyword', true);
		$sql = "SELECT admin_login. * , task_activity . *  FROM admin_login INNER JOIN task_activity ON admin_login.id = task_activity.assigned_to Where task_activity.task_id='$id' order by created_date desc";

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
	public function fetchprojects()
	{
		$sql = "SELECT * FROM projects ";
		$query=$this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	public function fetchusers()
	{
		$sql = "SELECT * FROM admin_login ";
		$query=$this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	public function tasktype()
	{
		$sql = "SELECT * FROM tasktype ";
		$query=$this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	public function doupdatetask()
	{
			$task_id=$this->input->post('id'); 
			
		
			//$task_id=$this->input->post('project');
			$created_by=$this->session->userdata('login_id');
			$assignto=$this->input->post('assignto');
			$description=$this->input->post('description');
			$hoursspent=$this->input->post('hours_spent');
			$hr_spnd=$this->input->post('hr_spnd');
			$notifyemail=$this->input->post('notifyemail');
			$created_by=$this->session->userdata('login_id');
			$created_date=date('Y-m-d H:i:s');
			$status=$this->input->post('status');
			
			if(!empty($notifyemail)){
			$n=implode(",",$notifyemail); } else { $n=""; }
			
			$data = array(
				
				'task_id' => $task_id,
				'assigned_to' => $assignto,
				'descriptions' => $description,
				'hr_spend' => $hoursspent,
				'status' => $status,
				'created_date' => $created_date,
				'created_by' => $created_by,
				'notifyemail' => $n
			);

			$this->db->insert('task_activity', $data);
		    $cid =$this->db->insert_id();
			
			
			
			$hoursspent=$hoursspent+$hr_spnd;
		$data = array(
				'assignto' => $assignto,
				//'priority' => $priority,
				//'tasktype' => $tasktype,
				'status' => $status,
				'description' => $description,
				'created_date' => $created_date,
				'hoursspent' => $hoursspent
				
		);
		$this->db->where('task_id', $task_id);
		$this->db->update('tasks', $data); 

		return true;
	}
	public function doDelete()
	{

		$id=$this->input->post('task_id');
		echo $sql = "delete from task_activity where task_id='$id'";
		$query=$this->db->query($sql);
		$sql1 = "delete from tasks where task_id='$id'";
		$query=$this->db->query($sql1);
		return $this->db->affected_rows();
	}
	

}
?>
