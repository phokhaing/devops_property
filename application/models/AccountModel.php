<?php 
/**
* @author: khaing.pho1991@gmail.com
*/
class AccountModel extends CI_Model
{	
	/* table */
	private $table        = "account";

	/* field */
	private $id           = "id";
	private $code 	      = "code";
	private $name         = "name";

	/* default */
	private $createdBy 	  = "created_by";
	private $createdAt 	  = "created_at";
	private $updatedBy 	  = "updated_by";
	private $updatedAt 	  = "updated_at";
	private $status    	  = 'status';

	function __construct()
	{
		parent::__construct();
	}

	function create()
	{
		$data = array(
			$this->code      => $this->input->post($this->code),
			$this->name      => $this->input->post($this->name),
			$this->status  	 => (int) $this->input->post($this->status),
			$this->createdBy => $this->user->info->ID,
			$this->createdAt => date("Y-m-d H:i:s")
		);

		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	function update($id)
	{
		$data = array(
			$this->code      => $this->input->post($this->code),
			$this->name      => $this->input->post($this->name),
			$this->status    => (int) $this->input->post($this->status),
			$this->updatedBy => $this->user->info->ID,
			$this->updatedAt => date("Y-m-d H:i:s")
		);
		$this->db
		     ->where($this->id, $id)
		     ->update($this->table, $data);
			 return $this->db->affected_rows();
	}

	function findAll(){
		$result = $this->db
					   ->order_by($this->id, 'DESC')
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

	function findAllFilter($filter){
        return $this->db->select('*')
                 ->where('status', $filter)
                 ->get($this->table)
                 ->result();
    }

    /** 
      *-------------------------------
      * ADD ON
      *-------------------------------
      */
	function checkValidCode($id, $code){
		return $this->db
				 ->where($this->id.' !=', $id)
				 ->where($this->code, $code)
				 ->get($this->table)
				 ->result();
	}
	function checkValidName($id, $name){
		return $this->db
				 ->where($this->id.' !=', $id)
				 ->where($this->name, $name)
				 ->get($this->table)
				 ->result();
	}

}

?>