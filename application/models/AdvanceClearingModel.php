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
class AdvanceClearingModel extends CI_Model
{	
	/* table */
	public $table       = "advance_clearing";	
	public $tblItems    = "advance_clearing_items";
	public $tblFiles    = "advance_clearing_files";
	public $tblProject  = "project";
	public $tblAccount  = "account";
	private $tblHistory = "advance_clearing_history";

	/* fields */
	public $id 	        = 'id';
	private $name 		= "name";
	private $cell_phone = "cell_phone";
	private $ref_no		= "ref_no";
	private $div		= "div";
	private $r_date 	= "r_date";
	private $staff_id 	= "staff_id";
	private $branch 	= "branch";
	private $department = "department";
	private $position 	= "position";
	private $deadline 	= "deadline";
	private $project 	= "project";
	private $location 	= "location";
	private $purpose 	= "purpose";
	private $staff_request 	= "staff_request";
	private $bank_account 	= "bank_account";
	private $total_debit    = "total_debit";
	private $total_credit   = "total_credit";
	private $advance_amount = "advance_amount";
	private $spend_amount   = "spend_amount";
	private $reference      = "reference";

	/* items */
	private $advance_clearing_id = 'advance_clearing_id';
	private $description = 'description';
	private $debit 		 = 'debit';
	private $credit 	 = 'credit';
	private $account 	 = 'account';
	private $remark 	 = 'remark';
	
	/* default */
	private $settlement_by 	= "settlement_by";
	private $settlement_at 	= "settlement_at";
	private $verified_by 	= "verified_by";
	private $verified_at 	= "verified_at";
	private $checked_by 	= "checked_by";
	private $checked_at		= "checked_at";
	private $approved_by	= "approved_by";
	private $approved_at	= "approved_at";
	private $createdBy 	 	= "created_by";
	private $createdAt 	 	= "created_at";
	private $updatedBy 	 	= "updated_by";
	private $updatedAt 	 	= "updated_at";
	private $status    	 	= 'status';
	private $authorize_status = 'authorize_status';

	/* approval */
    private $tblAuthorizeLog = "authorize_log";
    private $authorize_id    = "authorize_id";
    private $log_id          = "log_id";
	private $moduleID 	     = null;
	private $moduleName      = "advance_clearing";

    /* email */
    private $email_lang     = null;
    private $hook_settlement= 'settlement_advance_clearing';
    private $hook_request   = 'request_advance_clearing';
    private $hook_check   	= 'check_advance_clearing';
    private $hook_verify   	= 'verify_advance_clearing';
    private $hook_approve   = 'approve_advance_clearing';
    private $hook_reject    = 'reject_advance_clearing';

	function __construct(){
		parent::__construct();
		if(!isset($_COOKIE['language'])){
           $this->email_lang = $this->config->item("language");
        }else{
           $this->email_lang = $this->common->nohtml($_COOKIE["language"]);
        }
		$this->moduleID = getModuleIDByName($this->moduleName);
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 05/July/2020
      * @param: method for validation form
      *----------------------------------------------------------------
      */
    public function is_validated()
    {   
        $this->form_validation->set_rules($this->name, lang('name'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->cell_phone, lang('cell_phone'), 'trim|required|min_length[1]|max_length[10]|numeric');
        $this->form_validation->set_rules($this->ref_no, lang('ref_no'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->position, lang('position'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->div, lang('div'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->r_date, lang('r_date'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->staff_id, lang('staff_id'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->branch, lang('branch'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->deadline, lang('deadline'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->department, lang('department'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->project, lang('project'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->location, lang('location'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->purpose, lang('purpose'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->staff_request, lang('staff_request'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->bank_account, lang('bank_account'), 'trim|required|min_length[1]');

        for ($i=0; $i < count($_POST[$this->description]); $i++)
        { 
        	$this->form_validation->set_rules($this->account.'['.$i.']', lang('account'), 'trim|required|min_length[1]');
            $this->form_validation->set_rules($this->description.'['.$i.']', lang('description'), 'trim|required|min_length[2]');
            $this->form_validation->set_rules($this->debit.'['.$i.']', lang('debit'), 'trim|required|min_length[1]|numeric');
            // $this->form_validation->set_rules($this->credit.'['.$i.']', lang('credit'), 'trim|required|min_length[1]|numeric');
        }

        if($this->form_validation->run() == false){
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
		$_GET['date'] = date('d-m-Y', strtotime($this->input->post($this->r_date)));
		$ref_code = $this->generate_code();
		/**
		  * ------------------------------------------
		  * CREATE NEW LOAN APPLICATION INFO
		  * ------------------------------------------
		  */
		$this->db->insert($this->table, array(
			$this->ref_no 	     => $ref_code,
			$this->name 	     => $this->input->post($this->name),
			$this->cell_phone    => $this->input->post($this->cell_phone),
			$this->position      => $this->input->post($this->position),
			$this->div 	         => $this->input->post($this->div),
			$this->staff_id	     => $this->input->post($this->staff_id),
			$this->branch 	     => $this->input->post($this->branch),
			$this->deadline      => date('Y-m-d', strtotime($this->input->post($this->deadline))),
			$this->department    => $this->input->post($this->department),
			$this->project 	     => $this->input->post($this->project),
			$this->location      => $this->input->post($this->location),
			$this->purpose       => $this->input->post($this->purpose),
			$this->staff_request  => (int) $this->input->post($this->staff_request),
			$this->bank_account   => $this->input->post($this->bank_account),
			$this->total_debit    => $this->input->post($this->total_debit),
			$this->total_credit   => $this->input->post($this->total_credit),
			$this->advance_amount => $this->input->post($this->advance_amount),
			$this->spend_amount   => $this->input->post($this->spend_amount),
			$this->reference      => $this->input->post($this->reference),
			$this->r_date      	  => date('Y-m-d', strtotime($this->input->post($this->r_date))),
			$this->status      	  => (int) 1,
			$this->createdBy      => (int) $this->user->info->ID,
			$this->createdAt      => date("Y-m-d H:i:s"),
			$this->settlement_by  => (int) $this->input->post($this->settlement_by),
			$this->checked_by     => (int) $this->input->post($this->checked_by),
			$this->verified_by    => (int) $this->input->post($this->verified_by),
			$this->approved_by    => (int) $this->input->post($this->approved_by),
			$this->authorize_status => "requesting")
		);
		$id = $this->db->insert_id();

		if($id){

			/**
			  * ------------------------------------------
			  * INSERT ITEM INFO
			  * ------------------------------------------
			  */
			if($this->input->post('description')){
				foreach ($this->input->post($this->description) as $key => $description){
					$this->db->insert($this->tblItems, array(
					$this->advance_clearing_id => $id,
					$this->account 	    => $this->input->post($this->account)[$key],
					$this->description  => $description,
					$this->debit        => $this->input->post($this->debit)[$key],
					$this->credit 	    => $this->input->post($this->credit)[$key],
					$this->remark 	    => $this->input->post($this->remark)[$key]));
				}
			}

			/**
			 * ------------------------------------------
			 * UPLOAD ATTACHMENT FILES
			 * ------------------------------------------
			 */
	        $filePath    = '/advance_clearing';
	        $inputFile   = 'attachment_files';
	        $fileRemoved = 'attachment_files_deleted';
	        $fileCatch   = 'attachment_files_catch';
	        $fileUpload  = $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved, $fileCatch);
	        if(!empty($fileUpload)){
	            foreach ($fileUpload as $file) {
	                $this->db->insert($this->tblFiles, array(
	                "advance_clearing_id"  => $id,
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
             *----------------------------------------------------------------------
             * REQUEST TRANSACTION|ALERT NOTIFICATION|SEND EMAIL TO USERS TRANSFERS
             *----------------------------------------------------------------------
             */
            $primary_key = $id;
            $title = 'has requested an advance clearing form and transfers for you to do settlement.';
            $email_template = getEmailTempalteByHook($this->hook_request, $this->email_lang);
            $users = $this->input->post($this->checked_by);
            $this->approval->alertNotification($users, $title, $email_template, $this->moduleID, $primary_key); 
            
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
	function update($id)
	{	
		$_GET['date'] = date('d-m-Y', strtotime($this->input->post($this->r_date)));
		$_GET['code'] = $this->input->post($this->ref_no);
		$ref_code = $this->generate_code();
		
		/* update float info */
		$this->db->where($this->id, $id)->update($this->table, array(
			$this->ref_no 	   => $ref_code,
			$this->name 	   => $this->input->post($this->name),
			$this->cell_phone  => $this->input->post($this->cell_phone),
			$this->position    => $this->input->post($this->position),
			$this->div 	       => $this->input->post($this->div),
			$this->staff_id	   => $this->input->post($this->staff_id),
			$this->branch 	   => $this->input->post($this->branch),
			$this->deadline    => date('Y-m-d', strtotime($this->input->post($this->deadline))),
			$this->department  => $this->input->post($this->department),
			$this->project 	   => $this->input->post($this->project),
			$this->location    => $this->input->post($this->location),
			$this->purpose     => $this->input->post($this->purpose),
			$this->staff_request  => (int) $this->input->post($this->staff_request),
			$this->bank_account   => $this->input->post($this->bank_account),
			$this->total_debit    => $this->input->post($this->total_debit),
			$this->total_credit   => $this->input->post($this->total_credit),
			$this->advance_amount => $this->input->post($this->advance_amount),
			$this->spend_amount   => $this->input->post($this->spend_amount),
			$this->reference   	  => $this->input->post($this->reference),
			$this->r_date      => date('Y-m-d', strtotime($this->input->post($this->r_date))),
			$this->status      => (int) 1,
			$this->updatedBy   => (int) $this->user->info->ID,
			$this->updatedAt   => date("Y-m-d H:i:s"))
		);
		 
		 /**
		  * ------------------------------------------
		  * INSERT ITEM INFO
		  * ------------------------------------------
		  */
		  /* delete item that deleted at form */
		if($this->input->post('item_deleted')){
			$item_deleted = explode('___', $this->input->post('item_deleted'));
			foreach ($item_deleted as $key => $item_id) {
				if($item_id != null){
					$this->db->where($this->id,$item_id)->delete($this->tblItems);
				}
			}
		}
		if($this->input->post('description')){
			foreach ($this->input->post('description') as $key => $description){
				if($this->input->post('item_id')[$key])
				{	// update existing item
					$this->db->where($this->id, $this->input->post('item_id')[$key])
					->update($this->tblItems, array(
					$this->advance_clearing_id => $id,
					$this->description  => $description,
					$this->debit 	    => $this->input->post($this->debit)[$key],
					$this->credit 	    => $this->input->post($this->credit)[$key],
					$this->account 	    => $this->input->post($this->account)[$key],
					$this->remark 	    => $this->input->post($this->remark)[$key]));
				}else{
					// add new item
					$this->db->insert($this->tblItems, array(
					$this->advance_clearing_id => $id,
					$this->description  => $description,
					$this->debit  	    => $this->input->post($this->debit)[$key],
					$this->credit 	    => $this->input->post($this->credit)[$key],
					$this->account 	    => $this->input->post($this->account)[$key],
					$this->remark 	    => $this->input->post($this->remark)[$key]));
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
					$this->db->where($this->id,$attach_id)->delete($this->tblFiles);
					// unlink('./'.$attachment_file_path[$key]);  
				}
			}
		}
		/* add more attachment files */
        $filePath    = '/advance_clearing';
        $inputFile   = 'attachment_files';
        $fileRemoved = 'attachment_files_deleted';
        $fileCatch   = 'attachment_files_catch';
		$fileUpload  = $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved, $fileCatch);
        if(!empty($fileUpload)){
            foreach ($fileUpload as $file) {
                $this->db->insert($this->tblFiles, array(
                "advance_clearing_id"  => $id,
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
   	public function authorize($recordID = null, $status = null, $user = null)
   	{   
      	$email_template = null;
		$title = null;
         
        /* update advance clearing status  */
		$this->db->where($this->id, $recordID)->update($this->table, array(
			$this->authorize_status => $status,
			$status.'_by'   => (int) $this->user->info->ID,
			$status.'_at'   => date("Y-m-d H:i:s"))
		);

        /* alert notification and send email to user */ 
        if($status == 'approved'){
	        // set email template approve
	        $title = 'has approved your advance clearing form.';
	        $email_template = getEmailTempalteByHook($this->hook_approve, $this->email_lang);
		}
		elseif($status == 'settlement'){
	        // set email template transfer
	        $title = 'has settled an advance clearing form and transfers for you to check.';
	        $email_template = getEmailTempalteByHook($this->hook_settlement, $this->email_lang);
		}
		elseif($status == 'checked'){
	        // set email template transfer
	        $title = 'has checked an advance clearing form and transfers for you to verify.';
	        $email_template = getEmailTempalteByHook($this->hook_check, $this->email_lang);
		}
		elseif($status == 'verified'){
	        // set email template transfer
	        $title = 'has verified an advance clearing form and transfers for you to approve.';
	        $email_template = getEmailTempalteByHook($this->hook_verify, $this->email_lang);
		}
		elseif($status == 'rejected'){
			// set email template
			$this->db
				 ->where($this->id, $recordID)
				 ->update($this->table, array('reject_comment' => $_GET['comment']));
	        $title = 'has rejected your advance clearing form.';
	        $email_template = getEmailTempalteByHook($this->hook_reject, $this->email_lang);
	    }  
        $this->approval->alertNotification($user, $title, $email_template, $this->moduleID, $recordID); 
        return true;
    }

	function findAll(){
		/*
         * -------------------------------------------------------
         * if user has permission list_all, so user can view all tickets.
         * but if user has only permission list_own_department, 
         * user can view the records that related to own department only.
         * -------------------------------------------------------
         */    
		$where = array();     
        if(!$this->authorization->hasPermission($this->moduleName, "LIST_ALL")){
            if($this->authorization->hasPermission($this->moduleName, "LIST_OWN_BRANCH")){
				$user_in_branch = getUserIdByBranchId($this->user->info->branch);
				$where[] = array($this->table.'.'.$this->createdBy, $user_in_branch);
				$where[] = array($this->table.'.'.$this->settlement_by, $user_in_branch);
                $where[] = array($this->table.'.'.$this->checked_by, $user_in_branch);
                $where[] = array($this->table.'.'.$this->verified_by, $user_in_branch);
                $where[] = array($this->table.'.'.$this->approved_by, $user_in_branch);
			}
			if($this->authorization->hasPermission($this->moduleName, "LIST_OWN_DEPARTMENT")){
				$user_in_dept = getUserIdByDepId($this->user->info->department_id);
                $where[] = array($this->table.'.'.$this->createdBy, $user_in_dept);
				$where[] = array($this->table.'.'.$this->settlement_by, $user_in_dept);
                $where[] = array($this->table.'.'.$this->checked_by, $user_in_dept);
                $where[] = array($this->table.'.'.$this->verified_by, $user_in_dept);
                $where[] = array($this->table.'.'.$this->approved_by, $user_in_dept);
			}
			if($this->authorization->hasPermission($this->moduleName, "LIST_OWN_RECORD")){
                $where[] = array($this->table.'.'.$this->createdBy, $this->user->info->ID);
				$where[] = array($this->table.'.'.$this->settlement_by, $this->user->info->ID);
                $where[] = array($this->table.'.'.$this->checked_by, $this->user->info->ID);
                $where[] = array($this->table.'.'.$this->verified_by, $this->user->info->ID);
                $where[] = array($this->table.'.'.$this->approved_by, $this->user->info->ID);
            }
		}
		if(!empty($where)){
			foreach($where as $label => $user){
				$this->db->or_where_in($user[0], $user[1]);
			}
		}
		return $this->db
			->order_by($this->id, 'DESC')
			->get($this->table)
			->result();
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
	function findLastID(){
		$output= $this->db
					->select('id, ref_no')
					->order_by('id', 'desc')
					->limit(1)
					->get($this->table)
					->row();
		if(!empty($output)){
			$year = substr($output->ref_no, 4, 2);
			$month = substr($output->ref_no, 7,2);
			$digit = substr($output->ref_no, 10);

			if(date('y') == $year && date('m') == $month)
			{
				$digit = str_pad((int) $digit+1, 4, "0", STR_PAD_LEFT);
			}else{
				$digit = '0001';
			}
			return 'CLR-'.date('y-m-').$digit;
		}
		return 'CLR-'.date('y-m-').'0001';
	}

    /** 
      *-------------------------------
      * ADD ON
      *-------------------------------
      */
	public function findFiles($id){
		return $this->db
					->where($this->advance_clearing_id, $id)
					->order_by($this->id, 'asc')
					->get($this->tblFiles)
					->result();
	}
	public function findItems($id){
		return $this->db
					->where($this->advance_clearing_id, $id)
					->order_by($this->id, 'asc')
					->get($this->tblItems)
					->result();
	}
	public function findProjectActive(){
		return $this->db
					->where('status', 1)
					->get($this->tblProject)
					->result();
	}public function findAccountActive(){
		return $this->db
					->where('status', 1)
					->get($this->tblAccount)
					->result();
	}

	function filter(){
		$status      = $_GET['filter'];
		$from_date   = $_GET['from_date'];
		$to_date     = $_GET['to_date'];
		$department  = $_GET['department'];
		$branch  	 = $_GET['branch'];
		$project     = $_GET['project'];
		$checked_by  = $_GET['checked_by'];
		$approved_by = $_GET['approved_by'];

		$this->db->select('*');
		$this->db->from($this->table);

		if($status != 'all' && $status != ''){
			/* filter field */
			if($status == 'approved' || $status == 'approved_detail'){
				$this->db->where($this->authorize_status, 'approved');
			}else{
				$this->db->where($this->authorize_status.' !=', 'approved');
			}
			if($from_date != ""){
				$from_date = date('Y-m-d', strtotime($_GET['from_date']));
				$this->db->where($this->r_date.' >=', $from_date);
			}
			if($to_date != ""){
				$to_date = date('Y-m-d', strtotime($_GET['to_date']));
				$this->db->where($this->r_date.' <=', $to_date);
			}
			if($department != ""){
				$this->db->where($this->department, $department);
			} 
			if($branch != ""){
			 	$this->db->where($this->branch, $branch);
			}
			if($project != ""){
				$this->db->where($this->project, $project);
			} 
			if($checked_by != ""){
				$this->db->where($this->checked_by, $checked_by);
			} 
			if($approved_by != ""){
				$this->db->where($this->approved_by, $approved_by);
			} 
		}
		/* end filter field */

		$this->db->order_by($this->id, 'asc');
		return $this->db->get()->result();
	}

	/**
	 * ------------------------------------------
	 * GENERATE CODE (13 LENGTHS) 
	 * 3 digits of prefix
	 * 2 digits of year
	 * 2 digits of month
	 * 4 degits of sequence
	 * ------------------------------------------
	 */
	function generate_code(){
		$date = date('d-m-Y');
		if(isset($_GET['date']) && $_GET['date'] != ""){
            if($_GET['date'] !=""){
				$date = $_GET['date'];
			}
		}

		$year = substr(date('Y', strtotime($date)), -2);
		$month = date('m', strtotime($date));
		$prefix = 'CLR';
		$code = null;
		
		// if year, month not change keep old code
		if(isset($_GET['code']) && $_GET['code'] != ""){
			$current_code = $_GET['code'];
			$current_year = substr($current_code, 4, 2);
			$current_month = substr($current_code, 7,2);
			$current_digit = substr($current_code, 10);

			if($year == $current_year && $month == $current_month){	
				return $current_code;
			}
		}
		
		// generate new code if year, month changed
		$activeCode = $this->db->select("ref_no")
				 ->like('ref_no', $prefix.'-'.$year.'-'.$month, 'after')
				 ->order_by('ref_no', 'desc')
				 ->limit(1)
				 ->get($this->table)
				 ->row();

		$historyCode = $this->db->select("ref_no")
						->like('ref_no', $prefix.'-'.$year.'-'.$month, 'after')
						->order_by('ref_no', 'desc')
						->limit(1)
						->get($this->tblHistory)
						->row();

		if(!empty($activeCode)){
			$code = (int) str_replace($prefix.'-'.$year.'-'.$month.'-', '', $activeCode->ref_no);
		}

		if(!empty($historyCode)){
			$code_history = (int) str_replace($prefix.'-'.$year.'-'.$month.'-', '', $historyCode->ref_no);
			if($code_history > $code){
				$code = $code_history;
			}
		}
		
		if($code != null){
			$generate_code = $prefix.'-'.$year.'-'.$month.'-'.str_pad($code+1, 4, "0", STR_PAD_LEFT);
		}else{
			$generate_code = $prefix.'-'.$year.'-'.$month.'-'.str_pad(1, 4, "0", STR_PAD_LEFT);
		}

		return $generate_code;
	}
}

?>