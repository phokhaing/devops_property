<?php 
/**
* @author: khaing.pho1991@gmail.com
*/
class DivisionModel extends CI_Model
{	
	/* table */
	private $table        = "division";

	/* field */
	private $id           = "id";
	private $name_en 	  = "name_en";
	private $name_kh      = "name_kh";

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
			$this->name_en  => $this->input->post($this->name_en),
			$this->name_kh      => $this->input->post($this->name_kh),
			$this->status    	 => (int) $this->input->post($this->status),
			$this->createdBy 	 => $this->user->info->ID,
			$this->createdAt 	 => date("Y-m-d H:i:s")
		);

		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	function update($id)
	{
		$data = array(
			$this->name_en  => $this->input->post($this->name_en),
			$this->name_kh      => $this->input->post($this->name_kh),
			$this->status    	 => (int) $this->input->post($this->status),
			$this->updatedBy 	 => $this->user->info->ID,
			$this->updatedAt 	 => date("Y-m-d H:i:s")
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
    function findCurrencyActive(){
		return $this->db
					->where($this->status, 1)
					->get($this->tblCurrency)
					->result();
	}

	function checkValidNameEn($id, $name_en){
		return $this->db
				 ->where($this->id.' !=', $id)
				 ->where($this->name_en, $name_en)
				 ->get($this->table)
				 ->result();
	}
	function checkValidNameKh($id, $name_kh){
		return $this->db
				 ->where($this->id.' !=', $id)
				 ->where($this->name_kh, $name_kh)
				 ->get($this->table)
				 ->result();
	}

}

?>