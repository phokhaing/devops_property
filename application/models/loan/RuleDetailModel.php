<?php 
/**
* @author: khaing.pho1991@gmail.com
*/
class RuleDetailModel extends CI_Model
{	
	/* table */
	private $table       	= "loan_rule_detail";
	private $tblRule     	= "loan_rule";
	private $tblCurrency  	= "loan_currency";

	/* field */
	private $id          	= "id";
	private $ruleDetailCode = "ruledetail_code";
	private $ruleID 		= "rule_id";
	private $nameEN		 	= "name_en";
	private $nameKH		 	= "name_kh";
	private $currency		= "currency";
	private $minAmount		= "min_amount";
	private $maxAmount		= "max_amount";
	private $minTerm		= "min_term";
	private $maxTerm		= "max_term";
	private $minFee			= "min_fee";
	private $maxFee			= "max_fee";
	private $reduceAmount	= "reduce_amount";
	
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
			$this->ruleID 		   => $this->input->post($this->ruleID),
			$this->ruleDetailCode  => $this->input->post($this->ruleDetailCode),
			$this->nameEN     	   => $this->input->post($this->nameEN),
			$this->nameKH     	   => $this->input->post($this->nameKH),
			$this->currency        => $this->input->post($this->currency),
			$this->minAmount       => $this->input->post($this->minAmount),
			$this->maxAmount       => $this->input->post($this->maxAmount),
			$this->minTerm     	   => $this->input->post($this->minTerm),
			$this->maxTerm     	   => $this->input->post($this->maxTerm),
			$this->minFee     	   => $this->input->post($this->minFee),
			$this->maxFee     	   => $this->input->post($this->maxFee),
			$this->reduceAmount    => $this->input->post($this->reduceAmount),
			$this->status    	   => (int) $this->input->post('status'),
			$this->createdBy 	   => $this->user->info->ID,
			$this->createdAt 	   => date("Y-m-d H:i:s")
		);

		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	function update($id)
	{
		$data = array(
			$this->ruleID 		   => $this->input->post($this->ruleID),
			$this->ruleDetailCode  => $this->input->post($this->ruleDetailCode),
			$this->nameEN     	   => $this->input->post($this->nameEN),
			$this->nameKH     	   => $this->input->post($this->nameKH),
			$this->currency        => $this->input->post($this->currency),
			$this->minAmount       => $this->input->post($this->minAmount),
			$this->maxAmount       => $this->input->post($this->maxAmount),
			$this->minTerm     	   => $this->input->post($this->minTerm),
			$this->maxTerm     	   => $this->input->post($this->maxTerm),
			$this->minFee     	   => $this->input->post($this->minFee),
			$this->maxFee     	   => $this->input->post($this->maxFee),
			$this->reduceAmount    => $this->input->post($this->reduceAmount),
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
    function findLoanRuleActive(){
		return $this->db
					->where($this->status, 1)
					->get($this->tblRule)
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
				 ->where($this->ruleDetailCode, $code)
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