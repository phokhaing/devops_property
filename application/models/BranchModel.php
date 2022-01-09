<?php 
/**
* @author: khaing.pho1991@gmail.com
*/
class branchModel extends CI_Model
{
	private $table       = "branch";
	private $id          = "id_branch";
	private $branchCode  = "branch_code";
	private $branchName  = "branch_name";
	private $branchNameKH= "branch_name_kh";
	private $managerName = "manager_name";
	private $email 		 = "email";

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
		$data = array(
			$this->branchCode  	 => ucwords($this->input->post($this->branchCode)),
			$this->branchName  	 => ucwords($this->input->post($this->branchName)),
			$this->branchNameKH  => ucwords($this->input->post($this->branchNameKH)),
			$this->managerName   => (int) $this->input->post($this->managerName),
			$this->email  		 => $this->input->post($this->email),
			$this->status    	 => (int) $this->input->post('status'),
			$this->createdBy 	 => $this->user->info->ID,
			$this->createdAt 	 => date("Y-m-d H:i:s")
		);

		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	function update($id)
	{
		$data = array(
			$this->branchCode  	 => ucwords($this->input->post($this->branchCode)),
			$this->branchName  	 => ucwords($this->input->post($this->branchName)),
			$this->branchNameKH  => ucwords($this->input->post($this->branchNameKH)),
			$this->managerName   => (int) $this->input->post($this->managerName),
			$this->email  		 => $this->input->post($this->email),
			$this->status    	 => (int) $this->input->post('status'),
			$this->updatedBy 	 => $this->user->info->ID,
			$this->updatedAt 	 => date("Y-m-d H:i:s")
		);
		$this->db
		     ->where($this->id, $id)
		     ->update($this->table, $data);
			 return $this->db->affected_rows();
	}

	function getAll(){
		$result = $this->db
					   ->order_by($this->id, 'DESC')
					   ->get($this->table);
		return $result->result_array();
	}
	
	function getAllParent(){
		return $this->db->select('*')
				 ->from($this->table)
				 ->where('parent_id', 0)
				 // ->order_by('parent_id', 'ASC')
		         ->get()
		         ->result();
	}

	function getDepById($parentID){
	 	return $this->db->select('*')
		          ->where('id_branch', $parentID)
		          ->get('ac_branch')
		          ->result();
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

	function checkValidBanchCode($id, $branchCode){
		return $this->db
				 ->where($this->id.' !=', $id)
				 ->where($this->branchCode, $branchCode)
				 ->get($this->table)
				 ->result();
	}

	function checkValidBanchName($id, $branchName){
		return $this->db
				 ->where($this->id.' !=', $id)
				 ->where($this->branchName, $branchName)
				 ->get($this->table)
				 ->result();
	}

	function checkValidBanchNameKH($id, $branchNameKH){
		return $this->db
				 ->where($this->id.' !=', $id)
				 ->where($this->branchNameKH, $branchNameKH)
				 ->get($this->table)
				 ->result();
	}
}

?>