<?php 
/**
* @author: khaing.pho1991@gmail.com
* @param   23/June/2020
*/
class AuthorizeModel extends CI_Model
{
	private $table         = "authorize_status";
	private $id            = "authorize_id";
	private $authorizeName = "authorize_name";
	private $userId        = "user_id";
	/*-------------- default fields --------------*/
	private $createdBy = "created_by";
	private $createdAt = "created_at";
	private $updatedBy = "updated_by";
	private $updatedAt = "updated_at";
	private $status    = 'status';

	function __construct()
	{
		parent::__construct();
	}

	function getAll(){
		$result = $this->db->get($this->table);
		return $result->result_array();
	}

	function create()
	{	
		$data = array(
			$this->authorizeName  => strtoupper($this->input->post($this->authorizeName)),
			$this->userId  	   => implode(",", $this->input->post($this->userId)),
			$this->status      => (int) $this->input->post($this->status),
			$this->createdBy   => $this->user->info->ID,
			$this->createdAt   => date("Y-m-d H:i:s")
		);

		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	function update($id)
	{
		$data = array(
			$this->authorizeName  => strtoupper($this->input->post($this->authorizeName)),
			$this->userId  	   => implode(",", $this->input->post($this->userId)),
			$this->status      => (int) $this->input->post('status'),
			$this->updatedBy   => $this->user->info->ID,
			$this->updatedAt   => date("Y-m-d H:i:s")
		);
		$this->db
		     ->where($this->id, $id)
		     ->update($this->table, $data);
			 return $this->db->affected_rows();
	}

	function findAllByStatus($status){

		if($status == 'active'){
			$status = 1;
		}else{
			$status = 0;
		}

		$result = $this->db->get_where($this->table, array($this->status=>$status));
		return $result->result_array();
	}

	function count(){
		$total = array();
		$total['all'] = $this->db->count_all($this->table);

		// count status active
		$total['active'] =  $this->db
								 ->where($this->status, 1)
								 ->from($this->table)
								 ->count_all_results();

		// count status in-active
		$total['inactive'] =  $this->db
								   ->where($this->status, 0)
								   ->from($this->table)
								   ->count_all_results();
		return $total;
	}

	function deleteById($id){
		$this->db
			 ->where($this->id, $id)
			 ->delete($this->table);
			 return $this->db->affected_rows();
	}

	function findOne($id){
		$result = $this->db->get_where($this->table, array($this->id => $id));
		return $result->row();
	}

	function changeStatus($id, $status){
		$data = array(
			$this->status => (int) ($status == 1 ? 0 : 1)
		);
		$this->db
		     ->where($this->id, $id)
		     ->update($this->table, $data);
			 return $this->db->affected_rows();
	}

}

?>