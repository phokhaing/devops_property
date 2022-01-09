<?php 
/**
* @author: khaing.pho1991@gmail.com
*/
class PurposeModel extends CI_Model
{	
	/* table */
	private $table        	= "loan_purpose";
	private $tblPurposeType = "loan_purpose_type";

	/* field */
	private $id           	= "id";
	private $purposeCode    = "purpose_code";
	private $nameEN			= "name_en";
	private $nameKH			= "name_kh";
	private $purposetypeID 	= "purposetype_id";

	/* default */
	private $createdBy 	  	= "created_by";
	private $createdAt 	  	= "created_at";
	private $updatedBy 	  	= "updated_by";
	private $updatedAt 	  	= "updated_at";
	private $status    	  	= 'status';

	function __construct()
	{
		parent::__construct();
	}

	function create()
	{
		$data = array(
			$this->purposeCode  => $this->input->post($this->purposeCode),
			$this->nameEN     		=> $this->input->post($this->nameEN),
			$this->nameKH     		=> $this->input->post($this->nameKH),
			$this->purposetypeID     	=> $this->input->post($this->purposetypeID),
			$this->status    	 	=> (int) $this->input->post('status'),
			$this->createdBy 	 	=> $this->user->info->ID,
			$this->createdAt 	 	=> date("Y-m-d H:i:s")
		);

		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	function update($id)
	{
		$data = array(
			$this->purposeCode  	=> $this->input->post($this->purposeCode),
			$this->nameEN     		=> $this->input->post($this->nameEN),
			$this->nameKH     		=> $this->input->post($this->nameKH),
			$this->purposetypeID    => $this->input->post($this->purposetypeID),
			$this->status    	 	=> (int) $this->input->post('status'),
			$this->updatedBy 	 	=> $this->user->info->ID,
			$this->updatedAt 	 	=> date("Y-m-d H:i:s")
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
    function findPurposeTypeActive(){
		$result = $this->db
					   ->where($this->status, 1)
					   ->get($this->tblPurposeType);
		return $result->result();
	}

	function checkValidCode($id, $code){
		return $this->db
				 ->where($this->id.' !=', $id)
				 ->where($this->purposeCode, $code)
				 ->get($this->table)
				 ->result();
	}

	function checkValidNameEN($id, $param){
		return $this->db
				 ->where($this->id.' !=', $id)
				 ->where($this->nameEN, $param)
				 ->get($this->table)
				 ->result();
	}

	function checkValidNameKH($id, $param){
		return $this->db
				 ->where($this->id.' !=', $id)
				 ->where($this->nameKH, $param)
				 ->get($this->table)
				 ->result();
	}

}

?>