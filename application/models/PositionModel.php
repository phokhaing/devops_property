<?php 
/**
* @author: khaing.pho1991@gmail.com
*/
class PositionModel extends CI_Model
{
	private $table            = "ac_position";
	private $id               = "id";
	private $position_name    = "position_name";
	private $position_name_kh = "position_name_kh";
	private $description      = "description";

	/* default */
	private $createdBy = "created_by";
	private $createdAt = "created_at";
	private $updatedBy = "updated_by";
	private $updatedAt = "updated_at";
	private $status    = 'status';
	

	function __construct()
	{
		parent::__construct();
	}

	function create()
	{
		$this->db->insert($this->table, array(
			$this->position_name  	 => ucwords($this->input->post($this->position_name)),
			$this->position_name_kh  => ucwords($this->input->post($this->position_name_kh)),
			$this->description       => $this->input->post($this->description),
			$this->status    		 => (int) $this->input->post('status'),
			$this->createdBy 		 => $this->user->info->ID,
			$this->createdAt 		 => date("Y-m-d H:i:s")
		));
		return $this->db->insert_id();
	}

	function update($id)
	{
		$data = array(
			$this->position_name  	 => ucwords($this->input->post($this->position_name)),
			$this->position_name_kh  => ucwords($this->input->post($this->position_name_kh)),
			$this->description       => $this->input->post($this->description),
			$this->status      	     => (int) $this->input->post('status'),
			$this->updatedBy 	     => $this->user->info->ID,
			$this->updatedAt 	     => date("Y-m-d H:i:s")
		);
		$this->db
		     ->where($this->id, $id)
		     ->update($this->table, $data);
			 return $this->db->affected_rows();
	}

	function getAll(){
		$result = $this->db
					   ->order_by($this->id, 'desc')
					   ->get($this->table);
		return $result->result();
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

	function checkValidNameEn($id, $position_name){
		return $this->db
				 ->where($this->id.' !=', $id)
				 ->where($this->position_name, $position_name)
				 ->get($this->table)
				 ->result();
	}
	function checkValidNameKh($id, $position_name_kh){
		return $this->db
				 ->where($this->id.' !=', $id)
				 ->where($this->position_name_kh, $position_name_kh)
				 ->get($this->table)
				 ->result();
	}
}

?>