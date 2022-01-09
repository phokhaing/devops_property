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
class ApplicationModel extends CI_Model
{	
	/* table */
	public $table             = "loan_application";	
	public $tblHistory	      = "loan_application_history";
	private $tblRelation      = "loan_relation_indicator";
	private $tblCollateral    = "loan_collateral";	
	private $tblCustomer	  = "loan_customer";	
	private $tblGuarantor	  = "loan_guarantor";	
	private $tblCoborrower	  = "loan_coborrower";	
	private $tblFee	  		  = "loan_fee";	
	private $tblCharge	  	  = "loan_charge";	
	private $tblSecurity  	  = "loan_security";	
	private $tblApplicationFile = "loan_application_files";	

	public $id 	              = 'id';
	public $application_id 	  = 'application_id';
	private $application_code = 'application_code';
	private $customer_id      = 'customer_id';
	private $application_date = 'application_date';
	private $currency         = 'currency';
	private $applied_amount   = 'applied_amount';
	private $loan_amount      = 'loan_amount';
	private $term             = 'term';
	private $installment      = 'installment';
	private $cycle            = 'cycle';
	private $loan_product     = 'loan_product';
	private $frequency_type   = 'frequency_type';
	private $interest_rate    = 'interest_rate';
	private $category         = 'category';
	private $loan_purpose     = 'loan_purpose';
	private $loan_purpose_type= 'loan_purpose_type';
	private $frequency        = 'frequency';
	private $loan_fee         = 'loan_fee';
	private $officer          = 'officer';
	private $branch           = 'branch';
	
	/* default */
	private $createdBy 	 	= "created_by";
	private $createdAt 	 	= "created_at";
	private $updatedBy 	 	= "updated_by";
	private $updatedAt 	 	= "updated_at";
	private $status    	 	= 'status';

	/* approval */
    private $tblAuthorizeLog = "authorize_log";
    private $authorize_id    = "authorize_id";
    private $log_id          = "log_id";
    private $moduleID 	     = null;

    /* email */
    private $email_lang      = null;
    private $hook_transfer   = 'transfer_loan_application';
    private $hook_approve    = "approve_loan_application";
    private $hook_reject     = "reject_loan_application";

	function __construct(){
		parent::__construct();
		if(!isset($_COOKIE['language'])){
           $this->email_lang = $this->config->item("language");
        }else{
           $this->email_lang = $this->common->nohtml($_COOKIE["language"]);
        }
		$this->moduleID = getModuleIDByName('loan/application');
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
		 * CREATE APPLICATION CODE (13 LENGTHS) 
		 * 4 digits of branch code
		 * 3 digits of year
		 * 6 degits of sequence
		 * ------------------------------------------
		 */
		$branch = substr(findBranchCodeByID($this->input->post('branch')), -4);
		$year = substr(date('Y'), -3);
		$code = null;
		
		$lastCode = $this->db->select("application_code")
				 ->like('application_code', $branch.'_'.$year, 'after')
				 ->order_by('id', 'desc')
				 ->limit(1)
				 ->get('loan_application')
				 ->row();

		$historyCode = $this->db->select('application_code')
				 ->like('application_code', $branch.'_'.$year, 'after')
				 ->order_by('id', 'desc')
				 ->limit(1)
				 ->get('loan_application_history')
				 ->row();

		if(!empty($lastCode)){
			$code = (int) str_replace($branch.'_'.$year.'_', '', $lastCode->application_code);
		}

		if(!empty($historyCode)){
			$code_history = (int) str_replace($branch.'_'.$year.'_', '', $historyCode->application_code);
			if($code_history > $code){
				$code = $code_history;
			}
		}
		
		if($code != null){
			$application_code = $branch.'_'.$year.'_'.str_pad($code+1, 6, "0", STR_PAD_LEFT);
		}else{
			$application_code = $branch.'_'.$year.'_'.str_pad(1, 6, "0", STR_PAD_LEFT);
		}

		/**
		  * ------------------------------------------
		  * CREATE NEW LOAN APPLICATION INFO
		  * ------------------------------------------
		  */
		$this->db->insert($this->table, array(
			$this->application_code => $application_code,
			$this->customer_id 	    => $this->input->post($this->customer_id),
			$this->application_date => date('Y-m-d', strtotime($this->input->post($this->application_date))),
			$this->currency         => $this->input->post($this->currency),
			$this->applied_amount   => (float) $this->input->post($this->applied_amount),
			$this->loan_amount      => (float) $this->input->post($this->loan_amount),
			$this->term             => $this->input->post($this->term),
			$this->installment      => $this->input->post($this->installment),
			$this->cycle            => $this->input->post($this->cycle),
			$this->loan_product     => $this->input->post($this->loan_product),
			$this->frequency_type   => $this->input->post($this->frequency_type),
			$this->interest_rate    => (float) $this->input->post($this->interest_rate),
			$this->loan_purpose     => $this->input->post($this->loan_purpose),
			$this->loan_purpose_type=> $this->input->post($this->loan_purpose_type),
			$this->frequency        => $this->input->post($this->frequency),
			$this->officer          => $this->input->post($this->officer),
			$this->branch           => $this->input->post($this->branch),
			$this->status    	    => (int) 1,
			$this->createdBy 	    => (int) $this->user->info->ID,
			$this->createdAt 	    => date("Y-m-d H:i:s"))
		);
		$application_id = $this->db->insert_id();

		if($application_id){
			/**
			  * ------------------------------------------
			  * INSERT LOAN COLLATERAL INFO
			  * ------------------------------------------
			  */
			if($this->input->post('collateral_id')){
				foreach ($this->input->post('collateral_id') as $collateral_id){
					$this->db->insert($this->tblSecurity, array(
						'application_id' => $application_id,
						'collateral_id'  => $collateral_id,
						$this->createdBy => (int) $this->user->info->ID,
						$this->createdAt => date("Y-m-d H:i:s"))
					);
				}
			}

			/**
			  * ------------------------------------------
			  * INSERT LOAN GUARANTOR INFO
			  * ------------------------------------------
			  */
			if($this->input->post('guarantor')){
				foreach ($this->input->post('guarantor') as $key => $guarantor){
					$this->db->insert($this->tblGuarantor, array(
					'application_id' => $application_id,
					'customer_id' 	 => $guarantor,
					'relation_id' 	 => $this->input->post('guarantor_relation')[$key],
					$this->createdBy => (int) $this->user->info->ID,
					$this->createdAt => date("Y-m-d H:i:s")));
				}
			}

			/**
			  * ------------------------------------------
			  * INSERT LOAN CO-BORROWER INFO
			  * ------------------------------------------
			  */
			if($this->input->post('co_borrower')){
				foreach ($this->input->post('co_borrower') as $key => $co_borrower){
					$this->db->insert($this->tblCoborrower, array(
					'application_id' => $application_id,
					'customer_id' 	 => $co_borrower,
					'relation_id' 	 => $this->input->post('co_borrower_relation')[$key],
					$this->createdBy => (int) $this->user->info->ID,
					$this->createdAt => date("Y-m-d H:i:s")));
				}
			}

			/**
			  * ------------------------------------------
			  * INSERT LAON FEE CHARGE INFO
			  * ------------------------------------------
			  */
			if($this->input->post('fee_id')){
				foreach ($this->input->post('fee_id') as $key => $fee_id){
					if($this->input->post('fee_option')[$key] == 'YES'){
						$this->db->insert($this->tblCharge, array(
							'application_id' => $application_id,
							'fee_id' 		 => $fee_id,
							'amount' 		 => $this->input->post('fee_amount')[$key],
							'currency' 		 => $this->input->post($this->currency),
							'description' 	 => $this->input->post('fee_description')[$key],
							$this->createdBy => (int) $this->user->info->ID,
							$this->createdAt => date("Y-m-d H:i:s"))
						);
					}
				}
			}

			/**
			 * ------------------------------------------
			 * UPLOAD ATTACHMENT FILES
			 * ------------------------------------------
			 */
	        $filePath    = '/loan_files/loan_applications/'.$application_code.'/attachment';
	        $inputFile   = 'attachment_files';
	        $fileRemoved = 'attachment_files_deleted';
	        $fileCatch   = 'attachment_files_catch';
	        $fileUpload  = $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved, $fileCatch);
	        if(!empty($fileUpload)){
	            foreach ($fileUpload as $file) {
	                $this->db->insert($this->tblApplicationFile, array(
	                "application_id"  => $application_id,
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

			/** 
             *----------------------------------------------
             * APPROVAL TRANSACTION|ALERT NOTIFICATION|SEND EMAIL TO USERS TRANSFERS
             *-----------------------------------------------
             */
            $primary_key = $application_id;
            $approval = $this->approval->transfer($this->moduleID, $primary_key, $this->table);
            if($approval){
               $this->approval->updateStatus($this->table, $this->id, $primary_key, $approval);
               $title = 'has '.findAuthStatusName(1).'ed loan application form and transfers for you to '.findAuthStatusName($this->input->post('to_status'));
               $email_template = getEmailTempalteByHook($this->hook_transfer, $this->email_lang);
               $this->approval->alertNotification($title, $email_template, $this->moduleID, $primary_key); 
            }
            
			return $application_id;
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
	function update($id)
	{	
		$application_code = $this->input->post('application_code');
		/* update collateral info */
		$this->db->where($this->id, $id)->update($this->table, array(
			$this->customer_id 	    => $this->input->post($this->customer_id),
			$this->application_date => date('Y-m-d', strtotime($this->input->post($this->application_date))),
			$this->currency         => $this->input->post($this->currency),
			$this->applied_amount   => (float) $this->input->post($this->applied_amount),
			$this->loan_amount      => (float) $this->input->post($this->loan_amount),
			$this->term             => $this->input->post($this->term),
			$this->installment      => $this->input->post($this->installment),
			$this->cycle            => $this->input->post($this->cycle),
			$this->loan_product     => $this->input->post($this->loan_product),
			$this->frequency_type   => $this->input->post($this->frequency_type),
			$this->interest_rate    => (float) $this->input->post($this->interest_rate),
			$this->loan_purpose     => $this->input->post($this->loan_purpose),
			$this->loan_purpose_type=> $this->input->post($this->loan_purpose_type),
			$this->frequency        => $this->input->post($this->frequency),
			$this->officer          => $this->input->post($this->officer),
			$this->branch           => $this->input->post($this->branch),
			$this->status    	      => (int) 1,
			$this->updatedBy 	      => (int) $this->user->info->ID,
			$this->updatedAt 	      => date("Y-m-d H:i:s"))
		);
		
		/**
		  * ------------------------------------------
		  * INSERT LOAN COLLATERAL INFO
		  * ------------------------------------------
		  */
		$this->db->where($this->application_id, $id)->delete($this->tblSecurity);
		if($this->input->post('collateral_id')){
			foreach ($this->input->post('collateral_id') as $collateral_id){
				$this->db->insert($this->tblSecurity, array(
					'application_id' => $id,
					'collateral_id'  => $collateral_id,
					$this->createdBy => (int) $this->user->info->ID,
					$this->createdAt => date("Y-m-d H:i:s"))
				);
			}
		}

		/**
		  * ------------------------------------------
		  * INSERT LOAN GUARANTOR INFO
		  * ------------------------------------------
		  */
		 /* delete guarantor that deleted at form */
		if($this->input->post('guarantor_deleted')){
			$guarantor_deleted = explode('___', $this->input->post('guarantor_deleted'));
			foreach ($guarantor_deleted as $key => $con_id) {
				if($con_id != null){
					$this->db->where($this->id,$con_id)->delete($this->tblGuarantor);
				}
			}
		}
		if($this->input->post('guarantor')){
			foreach ($this->input->post('guarantor') as $key => $guarantor){
				if($this->input->post('guarantor_id')[$key])
				{	
					$this->db->where($this->id, $this->input->post('guarantor_id')[$key])
					->update($this->tblGuarantor, array(
					'application_id' => $id,
					'customer_id' 	 => $guarantor,
					'relation_id' 	 => $this->input->post('guarantor_relation')[$key],
					$this->createdBy => (int) $this->user->info->ID,
					$this->createdAt => date("Y-m-d H:i:s")));
				}else{
					$this->db->insert($this->tblGuarantor, array(
					'application_id' => $id,
					'customer_id' 	 => $guarantor,
					'relation_id' 	 => $this->input->post('guarantor_relation')[$key],
					$this->createdBy => (int) $this->user->info->ID,
					$this->createdAt => date("Y-m-d H:i:s")));
				}
			}
		}

		/**
		  * ------------------------------------------
		  * INSERT LOAN CO-BORROWER INFO
		  * ------------------------------------------
		  */
		  /* delete contact that deleted at form */
		if($this->input->post('coborrower_deleted')){
			$coborrower_deleted = explode('___', $this->input->post('coborrower_deleted'));
			foreach ($coborrower_deleted as $key => $con_id) {
				if($con_id != null){
					$this->db->where($this->id,$con_id)->delete($this->tblCoborrower);
				}
			}
		}
		if($this->input->post('co_borrower')){
			foreach ($this->input->post('co_borrower') as $key => $co_borrower){
				if($this->input->post('coborrower_id')[$key])
				{	
					$this->db->where($this->id, $this->input->post('coborrower_id')[$key])
					->update($this->tblCoborrower, array(
					'application_id' => $id,
					'customer_id' 	 => $co_borrower,
					'relation_id' 	 => $this->input->post('co_borrower_relation')[$key],
					$this->createdBy => (int) $this->user->info->ID,
					$this->createdAt => date("Y-m-d H:i:s")));
				}else{
					$this->db->insert($this->tblCoborrower, array(
					'application_id' => $id,
					'customer_id' 	 => $co_borrower,
					'relation_id' 	 => $this->input->post('co_borrower_relation')[$key],
					$this->createdBy => (int) $this->user->info->ID,
					$this->createdAt => date("Y-m-d H:i:s")));
				}
			}
		}

		/**
		  * ------------------------------------------
		  * INSERT LAON FEE CHARGE INFO
		  * ------------------------------------------
		  */
		$this->db->where($this->application_id, $id)->delete($this->tblCharge);
		if($this->input->post('fee_id')){
			foreach ($this->input->post('fee_id') as $key => $fee_id){
				if($this->input->post('fee_option')[$key] == 'YES'){
					$this->db->insert($this->tblCharge, array(
						'application_id' => $id,
						'fee_id' 		 => $fee_id,
						'amount' 		 => $this->input->post('fee_amount')[$key],
						'currency' 		 => $this->input->post($this->currency),
						'description' 	 => $this->input->post('fee_description')[$key],
						$this->createdBy => (int) $this->user->info->ID,
						$this->createdAt => date("Y-m-d H:i:s"))
					);
				}
			}
		}

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
					$this->db->where($this->id,$attach_id)->delete($this->tblApplicationFile);
					// unlink('./'.$attachment_file_path[$key]);  
				}
			}
		}
		/* add more attachment files */
        $filePath    = '/loan_files/loan_applications/'.$application_code.'/attachment';
        $inputFile   = 'attachment_files';
        $fileRemoved = 'attachment_files_deleted';
        $fileCatch   = 'attachment_files_catch';
        $fileUpload  = $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved, $fileCatch);
        if(!empty($fileUpload)){
            foreach ($fileUpload as $file) {
                $this->db->insert($this->tblApplicationFile, array(
                "application_id"  => $id,
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

	/** 
      *----------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 12/March/2020
      * @param: method for authorize form
      *----------------------------------------------------
      */
   	public function authorize($recordID = null)
   	{   
      $status = $this->input->post('status');
      $fromStatus = $this->input->post('from_status');
      $toStatus = $this->input->post('to_status');

      $email_template = null;
      $title = null;
      
      // if($this->approval->approve($this->table, $this->id, $this->moduleID, $recordID))
      // {         
         /**
          * -----------------------------------------------------------------------
          * Method for add user main app after approved on module user move request
          * -----------------------------------------------------------------------
          */
         if($status == 'approve'){
            // set email template approve
            $title = 'has approved your loan application form.';
            $email_template = getEmailTempalteByHook($this->hook_approve, $this->email_lang);
         }elseif($status == 'transfer'){
            // set email template transfer
            $title = 'has '.findAuthStatusName($fromStatus).'ed a loan application form and transfers for you to '.findAuthStatusName($toStatus);
            $email_template = getEmailTempalteByHook($this->hook_transfer, $this->email_lang);
         }else{
            // set email template
            $title = 'has rejected your loan application form.';
            $email_template = getEmailTempalteByHook($this->hook_reject, $this->email_lang);
         }
         

         /**
           * -----------------------------------------------------------------------
           * ALERT NOTIFICATION & SEND EMAIL TO USERS TRANSFERS
           * -----------------------------------------------------------------------
           */      
          $this->approval->alertNotification($title, $email_template, $this->moduleID, $recordID); 

      //   return true;
      // }else{
      // 	return false;
      // }
    }

	function findAll(){
		$result = $this->db
					   ->join($this->tblAuthorizeLog, $this->tblAuthorizeLog.'.'.$this->log_id.'='.$this->table.'.'.$this->authorize_id,'inner')
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
	public function findGuarantor(){
		return $this->db->where('guarantor','YES')->get($this->tblCustomer)->result();
	}
	public function findLoanFeeActive(){
		return $this->db->where('status',1)->get($this->tblFee)->result();
	}
	public function findCoborrowerByAppID($id){
		return $this->db
					->where($this->application_id,$id)
					->get($this->tblCoborrower)
					->result();
	}
	public function findGuarantorByAppID($id){
		return $this->db
					->where($this->application_id,$id)
					->get($this->tblGuarantor)
					->result();
	}
	public function findChargeByAppID($id){
		return $this->db
					->where($this->application_id,$id)
					->get($this->tblCharge)
					->result();
	}
	public function findSecurityByAppID($id){
		return $this->db
					->where($this->application_id,$id)
					->get($this->tblSecurity)
					->result();
	}
	public function findLoanAppFilesByAppID($id){
		return $this->db
					->where($this->application_id,$id)
					->get($this->tblApplicationFile)
					->result();
	}
}

?>