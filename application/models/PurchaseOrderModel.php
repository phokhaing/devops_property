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
class PurchaseOrderModel extends CI_Model
{	
	/* table */
	public $table       = "purchase_order";	
	public $tblItems    = "purchase_order_items";
	public $tblFiles    = "purchase_order_files";
	private $tblHistory = "purchase_order_history";
	private $tblProject = "project";
	private $tblAccount = "account";
	private $tblMeasurement = "unit_of_measurement";
	private $tblSupplier= "supplier";

	/* fields */
	public $id 	                    = 'id';
	private	$name_shop              = "name_shop";
	private	$po_no                  = "po_no";	
	private	$address                = "address";	
	private	$date                   = "date";
	private	$contact                = "contact";	
	private	$deadline               = "deadline";	
	private	$phone_number           = "phone_number";	
	private	$pr_no                  = "pr_no";	
	private	$cheque                 = "cheque";	
	private	$cheque_date            = "cheque_date";	
	private	$payment_term           = "payment_term";	
	private	$project                = "project";	
	private	$location               = "location";	
	private	$warranty               = "warranty";	
	private	$warranty_contact       = "warranty_contact";	
	private	$delivery               = "delivery";	
	private	$delivery_phone_number  = "delivery_phone_number";	
	private	$reciever               = "reciever";	
	private	$order_by               = "order_by";	
	private	$order_date             = "order_date";	
	private	$sub_total_amount       = "sub_total_amount";	
	private	$discount               = "discount";	
	private	$deposit                = "deposit";	
	private	$total_amount           = "total_amount";	
	private	$reference              = "reference";	

	/* items */
	private $purchase_order_id = 'purchase_order_id';
	private $description 	   = 'description';
	private $uom 		       = 'uom';
	private $quantity 	       = 'quantity';
	private $price 		       = 'price';
	private $total 		       = 'total';
	
	/* default */
	private $checked_by 	  = "checked_by";
	private $checked_at		  = "checked_at";
	private $approved_by	  = "approved_by";
	private $approved_at	  = "approved_at";
	private $createdBy 	 	  = "created_by";
	private $createdAt 	 	  = "created_at";
	private $updatedBy 	 	  = "updated_by";
	private $updatedAt 	 	  = "updated_at";
	private $status    	 	  = 'status';
	private $authorize_status = 'authorize_status';

	/* approval */
    private $tblAuthorizeLog = "authorize_log";
    private $authorize_id    = "authorize_id";
    private $log_id          = "log_id";
	private $moduleID 	     = null;
	private $moduleName      = "purchase_order";

    /* email */
    private $email_lang     = null;
    private $hook_request   = 'request_purchase_order';
    private $hook_check   	= 'check_purchase_order';
    private $hook_approve   = 'approve_purchase_order';
    private $hook_reject    = 'reject_purchase_order';

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
        $this->form_validation->set_rules($this->name_shop, lang('name_shop'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->po_no, lang('po_no'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->address, lang('address'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->date, lang('date'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->contact, lang('contact'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->deadline, lang('deadline'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->phone_number, lang('phone_number'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->pr_no, lang('pr_no'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->cheque, lang('cheque'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->cheque_date, lang('cheque_date'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->payment_term, lang('payment_term'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->project, lang('project'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->location, lang('location'), 'trim|required|min_length[1]');
		$this->form_validation->set_rules($this->warranty, lang('warranty'), 'trim|required|min_length[1]');
		$this->form_validation->set_rules($this->warranty_contact, lang('warranty_contact'), 'trim|required|min_length[1]');
		$this->form_validation->set_rules($this->delivery, lang('delivery'), 'trim|required|min_length[1]');
		$this->form_validation->set_rules($this->delivery_phone_number, lang('delivery_phone_number'), 'trim|required|min_length[1]');
		$this->form_validation->set_rules($this->reciever, lang('reciever'), 'trim|required|min_length[1]');
		$this->form_validation->set_rules($this->order_by, lang('order_by'), 'trim|required|min_length[2]');
		$this->form_validation->set_rules($this->order_date, lang('order_date'), 'trim|required|min_length[1]');

        for ($i=0; $i < count($_POST[$this->description]); $i++)
        { 
            $this->form_validation->set_rules($this->description.'['.$i.']', lang('description'), 'trim|required|min_length[2]');
			$this->form_validation->set_rules($this->uom.'['.$i.']', lang('uom'), 'trim|required|min_length[1]|numeric');
            $this->form_validation->set_rules($this->quantity.'['.$i.']', lang('quantity'), 'trim|required|min_length[1]|numeric');
            $this->form_validation->set_rules($this->price.'['.$i.']', lang('price'), 'trim|required|min_length[1]|numeric');
            $this->form_validation->set_rules($this->total.'['.$i.']', lang('total'), 'trim|required|min_length[1]|numeric');
			
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
		$_GET['date'] = date('d-m-Y', strtotime($this->input->post($this->date)));
		$po_no_code = $this->generate_code();

		/**
		  * ------------------------------------------
		  * CREATE NEW LOAN APPLICATION INFO
		  * ------------------------------------------
		  */
		$this->db->insert($this->table, array(
			$this->po_no                  => $po_no_code,	
			$this->name_shop              => $this->input->post($this->name_shop),
			$this->address                => $this->input->post($this->address),	
			$this->date                   => date('Y-m-d', strtotime($this->input->post($this->date))),
			$this->contact                => $this->input->post($this->contact),	
			$this->deadline               => date('Y-m-d', strtotime($this->input->post($this->deadline))),	
			$this->phone_number           => $this->input->post($this->phone_number),	
			$this->pr_no                  => $this->input->post($this->pr_no),	
			$this->cheque                 => $this->input->post($this->cheque),	
			$this->cheque_date            => date('Y-m-d', strtotime($this->input->post($this->cheque_date))),	
			$this->payment_term           => $this->input->post($this->payment_term),	
			$this->project                => $this->input->post($this->project),	
			$this->location               => $this->input->post($this->location),	
			$this->warranty               => $this->input->post($this->warranty),	
			$this->warranty_contact       => $this->input->post($this->warranty_contact),	
			$this->delivery               => $this->input->post($this->delivery),	
			$this->delivery_phone_number  => $this->input->post($this->delivery_phone_number),	
			$this->reciever               => $this->input->post($this->reciever),	
			$this->order_by               => $this->input->post($this->order_by),	
			$this->order_date             => date('Y-m-d', strtotime($this->input->post($this->order_date))),	
			$this->sub_total_amount       => $this->input->post($this->sub_total_amount),	
			$this->discount               => $this->input->post($this->discount),	
			$this->deposit                => $this->input->post($this->deposit),	
			$this->total_amount           => $this->input->post($this->total_amount),
			$this->reference              => $this->input->post($this->reference),
			$this->status      			   => (int) 1,
			$this->createdBy   			   => (int) $this->user->info->ID,
			$this->createdAt   			   => date("Y-m-d H:i:s"),
			$this->checked_by  			   => (int) $this->input->post($this->checked_by),
			$this->approved_by 			   => (int) $this->input->post($this->approved_by),
			$this->authorize_status 	   => "requesting")
		);
		$id = $this->db->insert_id();

		if($id){

			/**
			  * ------------------------------------------
			  * INSERT ITEM INFO
			  * ------------------------------------------
			  */
			if ($this->input->post('description')) {
				foreach ($this->input->post($this->description) as $key => $description){
					$this->db->insert($this->tblItems, array(
					$this->purchase_order_id => $id,
					$this->description 	     => $description,
					$this->uom 	 	         => $this->input->post($this->uom)[$key],
					$this->quantity          => $this->input->post($this->quantity)[$key],
					$this->price 	 	     => $this->input->post($this->price)[$key],
					$this->total 	 	     => $this->input->post($this->total)[$key]));
				}
			}

			/**
			 * ------------------------------------------
			 * UPLOAD ATTACHMENT FILES
			 * ------------------------------------------
			 */
	        $filePath    = '/purchase_order';
	        $inputFile   = 'attachment_files';
	        $fileRemoved = 'attachment_files_deleted';
	        $fileCatch   = 'attachment_files_catch';
	        $fileUpload  = $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved, $fileCatch);
	        if(!empty($fileUpload)){
	            foreach ($fileUpload as $file) {
	                $this->db->insert($this->tblFiles, array(
	                "purchase_order_id"  => $id,
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
            $title = 'has requested a purchase order form and transfers for you to check.';
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
		$_GET['date'] = date('d-m-Y', strtotime($this->input->post($this->date)));
		$_GET['code'] = $this->input->post($this->po_no);
		$po_no_code = $this->generate_code();

		/* update float info */
		$this->db->where($this->id, $id)->update($this->table, array(
			$this->po_no                  => $po_no_code,	
			$this->name_shop              => $this->input->post($this->name_shop),
			$this->address                => $this->input->post($this->address),	
			$this->date                   => date('Y-m-d', strtotime($this->input->post($this->date))),
			$this->contact                => $this->input->post($this->contact),	
			$this->deadline               => date('Y-m-d', strtotime($this->input->post($this->deadline))),	
			$this->phone_number           => $this->input->post($this->phone_number),	
			$this->pr_no                  => $this->input->post($this->pr_no),	
			$this->cheque                 => $this->input->post($this->cheque),	
			$this->cheque_date            => date('Y-m-d', strtotime($this->input->post($this->cheque_date))),	
			$this->payment_term           => $this->input->post($this->payment_term),	
			$this->project                => $this->input->post($this->project),	
			$this->location               => $this->input->post($this->location),	
			$this->warranty               => $this->input->post($this->warranty),	
			$this->warranty_contact       => $this->input->post($this->warranty_contact),	
			$this->delivery               => $this->input->post($this->delivery),	
			$this->delivery_phone_number  => $this->input->post($this->delivery_phone_number),	
			$this->reciever               => $this->input->post($this->reciever),	
			$this->order_by               => $this->input->post($this->order_by),	
			$this->order_date             => date('Y-m-d', strtotime($this->input->post($this->order_date))),	
			$this->sub_total_amount       => $this->input->post($this->sub_total_amount),	
			$this->discount               => $this->input->post($this->discount),	
			$this->deposit                => $this->input->post($this->deposit),	
			$this->total_amount           => $this->input->post($this->total_amount),
			$this->reference              => $this->input->post($this->reference),
			$this->status      			  => (int) 1,
			$this->updatedBy   			  => (int) $this->user->info->ID,
			$this->updatedAt   			  => date("Y-m-d H:i:s"))
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
					$this->purchase_order_id => $id,
					$this->description 	    => $description,
					$this->uom 	 	        => $this->input->post($this->uom)[$key],
					$this->quantity         => $this->input->post($this->quantity)[$key],
					$this->price 	 	    => $this->input->post($this->price)[$key],
					$this->total 	 	    => $this->input->post($this->total)[$key]));
				}else{
					// add new item
					$this->db->insert($this->tblItems, array(
					$this->purchase_order_id => $id,
					$this->description 	    => $description,
					$this->uom 	 	        => $this->input->post($this->uom)[$key],
					$this->quantity         => $this->input->post($this->quantity)[$key],
					$this->price 	 	    => $this->input->post($this->price)[$key],
					$this->total 	 	    => $this->input->post($this->total)[$key]));
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
        $filePath    = '/purchase_order';
        $inputFile   = 'attachment_files';
        $fileRemoved = 'attachment_files_deleted';
        $fileCatch   = 'attachment_files_catch';
        $fileUpload  = $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved, $fileCatch);
        if(!empty($fileUpload)){
            foreach ($fileUpload as $file) {
                $this->db->insert($this->tblFiles, array(
                "purchase_order_id"  => $id,
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
         
        /* update purchase order status  */
		$this->db->where($this->id, $recordID)->update($this->table, array(
			$this->authorize_status => $status,
			$status.'_by'   => (int) $this->user->info->ID,
			$status.'_at'   => date("Y-m-d H:i:s"))
		);

        /* alert notification and send email to user */ 
        if($status == 'approved'){
	        // set email template approve
	        $title = 'has approved your purchase order form.';
	        $email_template = getEmailTempalteByHook($this->hook_approve, $this->email_lang);
	    }elseif($status == 'checked'){
	        // set email template transfer
	        $title = 'has checked a purchase order form and transfers for you to approve.';
	        $email_template = getEmailTempalteByHook($this->hook_check, $this->email_lang);
	    }elseif($status == 'rejected'){
			$this->db
				 ->where($this->id, $recordID)
				 ->update($this->table, array('reject_comment' => $this->input->post('comment')));
	        // set email template
	        $title = 'has rejected your purchase order form.';
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
                $where[] = array($this->table.'.'.$this->checked_by, $user_in_branch);
                $where[] = array($this->table.'.'.$this->approved_by, $user_in_branch);
			}
			if($this->authorization->hasPermission($this->moduleName, "LIST_OWN_DEPARTMENT")){
				$user_in_dept = getUserIdByDepId($this->user->info->department_id);
                $where[] = array($this->table.'.'.$this->createdBy, $user_in_dept);
                $where[] = array($this->table.'.'.$this->checked_by, $user_in_dept);
                $where[] = array($this->table.'.'.$this->approved_by, $user_in_dept);
			}
			if($this->authorization->hasPermission($this->moduleName, "LIST_OWN_RECORD")){
                $where[] = array($this->table.'.'.$this->createdBy, $this->user->info->ID);
                $where[] = array($this->table.'.'.$this->checked_by, $this->user->info->ID);
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
					->select('id, po_no')
					->order_by('id', 'desc')
					->limit(1)
					->get($this->table)
					->row();
		if(!empty($output)){
			$year = substr($output->po_no, 3, 2);
			$month = substr($output->po_no, 6,2);
			$digit = substr($output->po_no, 9);

			if(date('y') == $year && date('m') == $month)
			{
				$digit = str_pad((int) $digit+1, 4, "0", STR_PAD_LEFT);
			}else{
				$digit = '0001';
			}
			return 'PO-'.date('y-m-').$digit;
		}
		return 'PO-'.date('y-m-').'0001';
	}

    /** 
      *-------------------------------
      * ADD ON
      *-------------------------------
      */
	public function findFiles($id){
		return $this->db
					->where($this->purchase_order_id, $id)
					->order_by($this->id, 'asc')
					->get($this->tblFiles)
					->result();
	}
	public function findItems($id){
		return $this->db
					->where($this->purchase_order_id, $id)
					->order_by($this->id, 'asc')
					->get($this->tblItems)
					->result();
	}
	public function findProjectActive(){
		return $this->db
					->where($this->status, 1)
					->get($this->tblProject)
					->result();
	}public function findAccountActive(){
		return $this->db
					->where($this->status, 1)
					->get($this->tblAccount)
					->result();
	}public function findMeasurementActive(){
		return $this->db
					->where($this->status, 1)
					->get($this->tblMeasurement)
					->result();
	}
	public function findSupplierActive(){
		return $this->db
					->where('status', 1)
					->get($this->tblSupplier)
					->result();
	}
	function filter(){
		$status 	 = $_GET['filter'];
		$from_date   = $_GET['from_date'];
		$to_date     = $_GET['to_date'];
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
				$this->db->where($this->date.' >=', $from_date);
			}
			if($to_date != ""){
				$to_date = date('Y-m-d', strtotime($_GET['to_date']));
				$this->db->where($this->date.' <=', $to_date);
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
	 * GENERATE CODE (10 LENGTHS) 
	 * 2 digits of prefix
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
		$prefix = 'PO';
		$code = null;

		// if year, month not change keep old code
		if(isset($_GET['code']) && $_GET['code'] != ""){
			$current_code = $_GET['code'];
			$current_year = substr($current_code, 3, 2);
			$current_month = substr($current_code, 6,2);
			$current_digit = substr($current_code, 9);

			if($year == $current_year && $month == $current_month){	
				return $current_code;
			}
		}
		
		// generate new code if year, month changed
		$activeCode = $this->db->select("po_no")
				 ->like('po_no', $prefix.'-'.$year.'-'.$month, 'after')
				 ->order_by('po_no', 'desc')
				 ->limit(1)
				 ->get($this->table)
				 ->row();

		$historyCode = $this->db->select("po_no")
						->like('po_no', $prefix.'-'.$year.'-'.$month, 'after')
						->order_by('po_no', 'desc')
						->limit(1)
						->get($this->tblHistory)
						->row();

		if(!empty($activeCode)){
			$code = (int) str_replace($prefix.'-'.$year.'-'.$month.'-', '', $activeCode->po_no);
		}

		if(!empty($historyCode)){
			$code_history = (int) str_replace($prefix.'-'.$year.'-'.$month.'-', '', $historyCode->po_no);
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