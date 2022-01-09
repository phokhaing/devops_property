<?php 
/**
* @author: khaing.pho1991@gmail.com
*/
class InterestRateModel extends CI_Model
{	
	/* table */
	private $table        	= "loan_interest_rate";
	private $tblInterest    = "loan_interest";
	private $tblCurrency 	= "loan_currency";

	/* field */
	private $id           		= "id";
	private $interestRateCode   = "interestrate_code";
	private $rateAmount   		= "rate_amount";
	private $description 		= "description";
	private $currency 			= "currency";
	private $interest_id   		= "interest_id";

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
			$this->interestRateCode  => $this->input->post($this->interestRateCode),
			$this->rateAmount  		 => $this->input->post($this->rateAmount),
			$this->description   	 => $this->input->post($this->description),
			$this->currency    	 	 => (int) $this->input->post($this->currency),
			$this->interest_id    	 => (int) $this->input->post($this->interest_id),
			$this->status    	 	 => (int) $this->input->post($this->status),
			$this->createdBy 	 	 => $this->user->info->ID,
			$this->createdAt 	 	 => date("Y-m-d H:i:s")
		);

		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	function update($id)
	{
		$data = array(
			$this->interestRateCode  => $this->input->post($this->interestRateCode),
			$this->rateAmount  		 => $this->input->post($this->rateAmount),
			$this->description   	 => $this->input->post($this->description),
			$this->currency    	 	 => (int) $this->input->post($this->currency),
			$this->interest_id    	 => (int) $this->input->post($this->interest_id),
			$this->status    	 	 => (int) $this->input->post($this->status),
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

	function findInterestActive(){
		return $this->db
					->where($this->status, 1)
					->get($this->tblInterest)
					->result();
	}

	function checkValidCode($id, $code){
		return $this->db
				 ->where($this->id.' !=', $id)
				 ->where($this->interestRateCode, $code)
				 ->get($this->table)
				 ->result();
	}

}

?>