<?php 
/**
* @author: khaing.pho1991@gmail.com
*/
class ProductModel extends CI_Model
{	
	/* table */
	private $table       	= "loan_product";
	private $tblRuleDetail  = "loan_rule_detail";
	private $tblInterest  	= "loan_interest";
	private $tblCurrency  	= "loan_currency";

	/* field */
	private $id          	= "id";
	private $productCode 	= "product_code";
	private $nameEN		 	= "name_en";
	private $nameKH		 	= "name_kh";
	private $ruleDetailID 	= "ruledetail_id";
	private $interestID 	= "interest_id";
	private $currency		= "currency";
	private $minAge			= "min_age";
	private $maxAge			= "max_age";
	private $minReduceAmount= "min_reduce_amount";
	
	/* default */
	private $createdBy 	 	= "created_by";
	private $createdAt 	 	= "created_at";
	private $updatedBy 	 	= "updated_by";
	private $updatedAt 	 	= "updated_at";
	private $status    	 	= 'status';

	function __construct()
	{
		parent::__construct();
	}

	function create()
	{
		$data = array(
			$this->productCode     => $this->input->post($this->productCode),
			$this->nameEN     	   => $this->input->post($this->nameEN),
			$this->nameKH     	   => $this->input->post($this->nameKH),
			$this->interestID      => (int) $this->input->post($this->interestID),
			$this->ruleDetailID    => (int) $this->input->post($this->ruleDetailID),
			$this->currency        => (int) $this->input->post($this->currency),
			$this->minAge          => (int) $this->input->post($this->minAge),
			$this->maxAge          => (int) $this->input->post($this->maxAge),
			$this->minReduceAmount => (float) $this->input->post($this->minReduceAmount),
			$this->status    	   => (int) $this->input->post('status'),
			$this->createdBy 	   => (int) $this->user->info->ID,
			$this->createdAt 	   => date("Y-m-d H:i:s")
		);

		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	function update($id)
	{
		$data = array(
			$this->productCode     => $this->input->post($this->productCode),
			$this->nameEN     	   => $this->input->post($this->nameEN),
			$this->nameKH     	   => $this->input->post($this->nameKH),
			$this->interestID      => (int) $this->input->post($this->interestID),
			$this->ruleDetailID    => (int) $this->input->post($this->ruleDetailID),
			$this->currency        => (int) $this->input->post($this->currency),
			$this->minAge          => (int) $this->input->post($this->minAge),
			$this->maxAge          => (int) $this->input->post($this->maxAge),
			$this->minReduceAmount => (float) $this->input->post($this->minReduceAmount),
			$this->status    	   => (int) $this->input->post('status'),
			$this->updatedBy 	   => $this->user->info->ID,
			$this->updatedAt 	   => date("Y-m-d H:i:s")
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
		return $this->db
					->where($this->id, $id)
					->get($this->table)
					->row();
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
    function findRuleDetailActive(){
		return $this->db
					->where($this->status, 1)
					->get($this->tblRuleDetail)
					->result();
	}
	function findInterestActive(){
		return $this->db
					->where($this->status, 1)
					->get($this->tblInterest)
					->result();
	}
	function findCurrencyActive(){
		return $this->db
					->where($this->status, 1)
					->get($this->tblCurrency)
					->result();
	}

	function checkValidCode($id, $code){
		return $this->db
				 ->where($this->id.' !=', $id)
				 ->where($this->productCode, $code)
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