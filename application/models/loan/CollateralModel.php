<?php 
if (!defined('BASEPATH'))
exit('No direct script access allowed');

/** 
 *------------------------------------------------------
 * @author: khaing.pho1991@gmail.com
 * @param: 10/July/2020
 * @param: model for manager customer infomation 
 *------------------------------------------------------
 */
class CollateralModel extends CI_Model
{	
	/* table */
	private $table              = "loan_collateral";	
	private $tblHistory 	    = 'loan_collateral_history';
	private $tblRelation        = "loan_relation_indicator";
	private $tblCollateralType  = "loan_collateral_type";	
	private $tblCollateralFiles = "loan_collateral_files";	

	private $id 	          = 'id';
	private $customer_id 	  = 'customer_id';
	private $collateral_id    = 'collateral_id';
	private $asset_type       = 'asset_type';
	private $owner_name       = 'owner_name';
	private $owner_spouse_name= 'owner_spouse_name';	
	private $relation_id      = 'relation_id';
	private $represent_type   = 'represent_type';	
	private $representor      = 'representor';	
	private $document_type    = 'document_type';	
	private $size             = 'size';	
	private $collateral_type_id = 'collateral_type_id';		
	private $country_id       = 'country_id';	
	private $province_id      = 'province_id';
	private $district_id      = 'district_id';
	private $commune_id       = 'commune_id';
	private $village_id       = 'village_id';
	private $document_number  = 'document_number';
	private $issue_date       = 'issue_date';
	private $issue_place      = 'issue_place';
	private $issue_by         = 'issue_by';
	private $currency         = 'currency';
	private $purchased_price  = 'purchased_price';
	private $valuation_price  = 'valuation_price';
	private $valuer           = 'valuer';	
	private $officer          = 'officer';	
	private $recieved_by      = 'recieved_by';	
	private $recieved_date    = 'recieved_date';	
	private $withdrawal_date  = 'withdrawal_date';
	private $withdrawal_by    = 'withdrawal_by';
	private $map_longitude    = 'map_longitude';
	private $map_latitude     = 'map_latitude';

	
	/* default */
	private $createdBy 	 	= "created_by";
	private $createdAt 	 	= "created_at";
	private $updatedBy 	 	= "updated_by";
	private $updatedAt 	 	= "updated_at";
	private $status    	 	= 'status';

	function __construct(){
		parent::__construct();
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 05/July/2020
      * @param: method for validation form customer info
      *----------------------------------------------------------------
      */
	public function is_validated()
	{
		/**
		 * ------------------------------------------
		 * FORM CUSTOMER VALIDATION 
		 * ------------------------------------------
		 */
		$this->form_validation->set_rules($this->customer_id, lang('customer_id'), 'trim|required');
		$this->form_validation->set_rules($this->asset_type, lang('asset_type'), 'trim|required');
		$this->form_validation->set_rules($this->owner_name, lang('owner_name'), 'trim|required|min_length[2]|max_length[100]');
		$this->form_validation->set_rules($this->owner_spouse_name, lang('owner_spouse_name'), 'trim|required|min_length[2]|max_length[100]');
		$this->form_validation->set_rules($this->relation_id, lang('relation_indicator'), 'trim|required');
		$this->form_validation->set_rules($this->represent_type, lang('represent_type'), 'trim|required');
		$this->form_validation->set_rules($this->document_type, lang('document_type'), 'trim|required');
		$this->form_validation->set_rules($this->collateral_type_id, lang('collateral_type_id'), 'trim|required');
		$this->form_validation->set_rules($this->country_id, lang('country_id'), 'trim|required');
		$this->form_validation->set_rules($this->province_id, lang('province_id'), 'trim|required');
		$this->form_validation->set_rules($this->district_id, lang('district_id'), 'trim|required');
		$this->form_validation->set_rules($this->commune_id, lang('commune_id'), 'trim|required');
		$this->form_validation->set_rules($this->village_id, lang('village_id'), 'trim|required');
		$this->form_validation->set_rules($this->document_number, lang('document_number'), 'trim|required');
		$this->form_validation->set_rules($this->issue_date, lang('issue_date'), 'trim|required');
		$this->form_validation->set_rules($this->issue_by, lang('issue_by'), 'trim|required');
		$this->form_validation->set_rules($this->issue_place, lang('issue_place'), 'trim|required');
		$this->form_validation->set_rules($this->officer, lang('officer'), 'trim|required');
		$this->form_validation->set_rules($this->recieved_date, lang('recieved_date'), 'trim|required');
		$this->form_validation->set_rules($this->recieved_by, lang('recieved_by'), 'trim|required');
		$this->form_validation->set_rules($this->withdrawal_date, lang('withdrawal_date'), 'trim|required');
		$this->form_validation->set_rules($this->withdrawal_by, lang('withdrawal_by'), 'trim|required');

		if($this->input->post($this->valuation_price)){
			$this->form_validation->set_rules($this->valuation_price, lang('valuation_price'), 'trim|numeric');
		}
		if($this->input->post($this->purchased_price)){
			$this->form_validation->set_rules($this->purchased_price, lang('purchased_price'), 'trim|numeric');
		}

		if($this->form_validation->run() == false){
			// return class name for set active tab-content
			return false;
		}else{
			return true;
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 05/July/2020
      * @param: method for create new customer info
      *----------------------------------------------------------------
      */
	function create()
	{
		/**
		  * ------------------------------------------
		  * CREATE NEW COLLATERAL INFO
		  * ------------------------------------------
		  */
		$this->db->insert($this->table, array(
			$this->customer_id 	      => $this->input->post($this->customer_id),
			$this->asset_type         => $this->input->post($this->asset_type),
			$this->owner_name         => $this->input->post($this->owner_name),
			$this->owner_spouse_name  => $this->input->post($this->owner_spouse_name),	
			$this->relation_id        => $this->input->post($this->relation_id),
			$this->represent_type     => $this->input->post($this->represent_type),	
			$this->representor        => $this->input->post($this->representor),	
			$this->document_type      => $this->input->post($this->document_type),	
			$this->size               => $this->input->post($this->size),	
			$this->collateral_type_id => $this->input->post($this->collateral_type_id),		
			$this->country_id         => $this->input->post($this->country_id),	
			$this->province_id        => $this->input->post($this->province_id),
			$this->district_id        => $this->input->post($this->district_id),
			$this->commune_id         => $this->input->post($this->commune_id),
			$this->village_id         => $this->input->post($this->village_id),
			$this->document_number    => $this->input->post($this->document_number),
			$this->issue_date         => date('Y-m-d', strtotime($this->input->post($this->issue_date))),
			$this->issue_place        => $this->input->post($this->issue_place),
			$this->issue_by           => $this->input->post($this->issue_by),
			$this->currency           => $this->input->post($this->currency),
			$this->purchased_price    => $this->input->post($this->purchased_price),
			$this->valuation_price    => $this->input->post($this->valuation_price),
			$this->valuer             => $this->input->post($this->valuer),	
			$this->officer            => $this->input->post($this->officer),	
			$this->recieved_by        => (int) $this->input->post($this->recieved_by),	
			$this->recieved_date      => date('Y-m-d', strtotime($this->input->post($this->recieved_date))),	
			$this->withdrawal_date    => date('Y-m-d', strtotime($this->input->post($this->withdrawal_date))),
			$this->withdrawal_by      => (int) $this->input->post($this->withdrawal_by),
			$this->map_latitude       => $this->input->post($this->map_latitude),
			$this->map_longitude      => $this->input->post($this->map_longitude),
			$this->status    	      => (int) $this->input->post($this->status),
			$this->createdBy 	      => (int) $this->user->info->ID,
			$this->createdAt 	      => date("Y-m-d H:i:s"))
		);
		$collateral_id = $this->db->insert_id();

		if($collateral_id){
			/**
			 * ------------------------------------------
			 * CREATE COLLATERAL CODE (CU (10LENGTH) 
			 * ------------------------------------------
			 */
			$collateral_code = 'CT'.str_pad($collateral_id, 10, "0", STR_PAD_LEFT);
			$this->db->where($this->id, $collateral_id)
					 ->set($this->collateral_id, $collateral_code)
					 ->update($this->table);
			
			/**
			 * ------------------------------------------
			 * UPLOAD ATTACHMENT FILES
			 * ------------------------------------------
			 */
	        $filePath    = '/loan_files/collaterals/'.$collateral_code.'/attachment';
	        $inputFile   = 'attachment_files';
	        $fileRemoved = 'attachment_files_deleted';
	        $fileCatch   = 'attachment_files_catch';
	        $fileUpload  = $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved, $fileCatch);
	        if(!empty($fileUpload)){
	            foreach ($fileUpload as $file) {
	                $this->db->insert($this->tblCollateralFiles, array(
	                "collateral_id"   => $collateral_id,
	                "upload_file_name"=> $file['upload_file_name'],
	                "original_name"   => $file['original_name'],
	                "file_type"       => $file['file_type'],
	                "extension"       => $file['extension'],
	                "file_size"       => $file['file_size'],
	                "file_path"       => $file['file_path'],
	                "timestamp"       => $file['timestamp'],
	                "status"          => (int) 1,
	                "created_by"      => (int) $this->user->info->ID,
	            	"created_at" 	  => date("Y-m-d H:i:s"),
	            	"description"     => $this->input->post('attachment_files_description')));
	            }
	        }
	        return true;
		}
		return false;
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 13/August/2020
      * @param: method for update customer info by id
      *----------------------------------------------------------------
      */
	function update($collateral_id)
	{	
		$collateral_code = $this->input->post('collateral_id');
		/* update collateral info */
		$this->db->where($this->id, $collateral_id)->update($this->table, array(
			$this->customer_id 	      => $this->input->post($this->customer_id),
			$this->asset_type         => $this->input->post($this->asset_type),
			$this->owner_name         => $this->input->post($this->owner_name),
			$this->owner_spouse_name  => $this->input->post($this->owner_spouse_name),	
			$this->relation_id        => $this->input->post($this->relation_id),
			$this->represent_type     => $this->input->post($this->represent_type),	
			$this->representor        => $this->input->post($this->representor),	
			$this->document_type      => $this->input->post($this->document_type),	
			$this->size               => $this->input->post($this->size),	
			$this->collateral_type_id => $this->input->post($this->collateral_type_id),		
			$this->country_id         => $this->input->post($this->country_id),	
			$this->province_id        => $this->input->post($this->province_id),
			$this->district_id        => $this->input->post($this->district_id),
			$this->commune_id         => $this->input->post($this->commune_id),
			$this->village_id         => $this->input->post($this->village_id),
			$this->document_number    => $this->input->post($this->document_number),
			$this->issue_date         => date('Y-m-d', strtotime($this->input->post($this->issue_date))),
			$this->issue_place        => $this->input->post($this->issue_place),
			$this->issue_by           => $this->input->post($this->issue_by),
			$this->currency           => $this->input->post($this->currency),
			$this->purchased_price    => $this->input->post($this->purchased_price),
			$this->valuation_price    => $this->input->post($this->valuation_price),
			$this->valuer             => $this->input->post($this->valuer),	
			$this->officer            => $this->input->post($this->officer),	
			$this->recieved_by        => (int) $this->input->post($this->recieved_by),	
			$this->recieved_date      => date('Y-m-d', strtotime($this->input->post($this->recieved_date))),	
			$this->withdrawal_date    => date('Y-m-d', strtotime($this->input->post($this->withdrawal_date))),
			$this->withdrawal_by      => (int) $this->input->post($this->withdrawal_by),
			$this->map_latitude       => $this->input->post($this->map_latitude),
			$this->map_longitude      => $this->input->post($this->map_longitude),
			$this->status    	      => (int) $this->input->post($this->status),
			$this->updatedBy 	      => (int) $this->user->info->ID,
			$this->updatedAt 	      => date("Y-m-d H:i:s"))
		);
		
		/**
		 * ------------------------------------------
		 * UPLOAD ATTACHMENT FILES
		 * ------------------------------------------
		 */
		/* delete attachment files that removed at form */
		if($this->input->post('attachment_file_deleted')){
			$attachment_file_deleted = explode('___', $this->input->post('attachment_file_deleted'));
			$attachment_file_path = explode('___', $this->input->post('attachment_file_path'));
			foreach ($attachment_file_deleted as $key => $attach_id) {
				if($attach_id != null){
					$this->db->where($this->id,$attach_id)->delete($this->tblCollateralFiles);
					unlink('./'.$attachment_file_path[$key]);  
				}
			}
		}
		/* add more attachment files */
        $filePath    = '/loan_files/collaterals/'.$collateral_code.'/attachment';
        $inputFile   = 'attachment_files';
        $fileRemoved = 'attachment_files_deleted';
        $fileCatch   = 'attachment_files_catch';
        $fileUpload  = $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved, $fileCatch);
        if(!empty($fileUpload)){
            foreach ($fileUpload as $file) {
                $this->db->insert($this->tblCollateralFiles, array(
                "collateral_id"   => $collateral_id,
                "upload_file_name"=> $file['upload_file_name'],
                "original_name"   => $file['original_name'],
                "file_type"       => $file['file_type'],
                "extension"       => $file['extension'],
                "file_size"       => $file['file_size'],
                "file_path"       => $file['file_path'],
                "timestamp"       => $file['timestamp'],
                "status"          => (int) 1,
                "created_by"      => (int) $this->user->info->ID,
            	"created_at" 	  => date("Y-m-d H:i:s"),
            	"description"     => $this->input->post('attachment_files_description')));
            }
        }

		return true;
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
	function updateHistory($id){
		$this->db
			 ->where($this->id, $id)
			 ->update($this->tblHistory, array('deleted_by'=> $this->user->info->ID, 'deleted_at'=>date("Y-m-d H:i:s")));
			 return $this->db->affected_rows();
	}

	function findOne($id){
		return $this->db
					->where($this->id, $id)
					->get($this->table)
					->row();
	}

	function findAttachmentByCollateralID($id){
		return $this->db
					->where($this->collateral_id, $id)
					->order_by($this->id, 'asc')
					->get($this->tblCollateralFiles)
					->result();
	}

    /** 
      *-------------------------------
      * ADD ON
      *-------------------------------
      */
	public function findRelationIndecator(){
		return $this->db->get($this->tblRelation)->result();
	}
	public function findCollateralType(){
		return $this->db->get($this->tblCollateralType)->result();
	}
}

?>