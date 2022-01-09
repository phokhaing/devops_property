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
class GoodsReceivedNoteModel extends CI_Model
{	
	/* table */
	public $table           = "goods_received_note";	
	public $tblItems        = "goods_received_note_items";
	public $tblFiles        = "goods_received_note_files";
	private $tblHistory     = "goods_received_note_history";
	private $tblCompany     = "company";
	private $tblMeasurement = "unit_of_measurement";
	private $tblSupplier    = "supplier";

	/* fields */
	public $id 	           = 'id';
	private $received_from = "received_from";
	private $grn_no        = "grn_no";
	private $address       = "address";
	private $date		   = "date";
	private $phone 	       = "phone";
	private $ordered_no    = "ordered_no";
	private $total_amount  = "total_amount";
	private $reference     = "reference";

	/* items */
	private $goods_received_note_id = 'goods_received_note_id';
	private $description = 'description';
	private $item_no     = 'item_no';
	private $uom 		 = 'uom';
	private $ref_no 	 = 'ref_no';
	private $price 		 = 'price';
	private $remark 	 = 'remark';
	
	/* default */
	private $checked_by 	= "checked_by";
	private $checked_at		= "checked_at";
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
	private $moduleName		 = "goods_received_note";

    /* email */
    private $email_lang     = null;
    private $hook_request   = 'request_goods_received_note';
    private $hook_check   	= 'check_goods_received_note';
    private $hook_reject   	= 'reject_goods_received_note';

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
        $this->form_validation->set_rules($this->received_from, lang('received_from'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->grn_no, lang('grn_no'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->address, lang('address'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->date, lang('date'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->phone, lang('phone'), 'trim|required|min_length[1]');
        $this->form_validation->set_rules($this->ordered_no, lang('ordered_no'), 'trim|required|min_length[1]');

        for ($i=0; $i < count($_POST[$this->description]); $i++)
        { 
            $this->form_validation->set_rules($this->item_no.'['.$i.']', lang('item_no'), 'trim|required|min_length[1]');
            $this->form_validation->set_rules($this->description.'['.$i.']', lang('description'), 'trim|required|min_length[2]');
            $this->form_validation->set_rules($this->ref_no.'['.$i.']', lang('ref_no'), 'trim|required|min_length[1]');
			$this->form_validation->set_rules($this->uom.'['.$i.']', lang('uom'), 'trim|required|min_length[1]|numeric');
            $this->form_validation->set_rules($this->price.'['.$i.']', lang('price'), 'trim|required|min_length[1]|numeric');
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
		$grn_no_code = $this->generate_code();

		/**
		  * ------------------------------------------
		  * CREATE NEW LOAN APPLICATION INFO
		  * ------------------------------------------
		  */
		$this->db->insert($this->table, array(
			$this->grn_no        => $grn_no_code,
			$this->received_from => $this->input->post($this->received_from),
			$this->address 	     => $this->input->post($this->address),
			$this->date          => date('Y-m-d', strtotime($this->input->post($this->date))),
			$this->phone 	     => $this->input->post($this->phone),
			$this->ordered_no	 => $this->input->post($this->ordered_no),
			$this->total_amount  => $this->input->post($this->total_amount),
			$this->reference  	 => $this->input->post($this->reference),
			$this->status        => (int) 1,
			$this->createdBy     => (int) $this->user->info->ID,
			$this->createdAt     => date("Y-m-d H:i:s"),
			$this->checked_by    => (int) $this->input->post($this->checked_by),
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
					$this->goods_received_note_id => $id,
					$this->item_no             => $this->input->post($this->item_no)[$key],
					$this->description 	       => $description,
					$this->ref_no 	 	       => $this->input->post($this->ref_no)[$key],
					$this->uom 	 	           => $this->input->post($this->uom)[$key],
					$this->price 	 	       => $this->input->post($this->price)[$key],
					$this->remark 	 	 	   => $this->input->post($this->remark)[$key]));
				}
			}

			/**
			 * ------------------------------------------
			 * UPLOAD ATTACHMENT FILES
			 * ------------------------------------------
			 */
	        $filePath    = '/goods_received_note';
	        $inputFile   = 'attachment_files';
	        $fileRemoved = 'attachment_files_deleted';
	        $fileCatch   = 'attachment_files_catch';
	        $fileUpload  = $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved, $fileCatch);
	        if(!empty($fileUpload)){
	            foreach ($fileUpload as $file) {
	                $this->db->insert($this->tblFiles, array(
	                "goods_received_note_id"  => $id,
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
            $title = 'has requested a goods received note form and transfers for you to check.';
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
		$_GET['code'] = $this->input->post($this->grn_no);
		$grn_no_code = $this->generate_code();

		/* update float info */
		$this->db->where($this->id, $id)->update($this->table, array(
			$this->grn_no        => $grn_no_code,
			$this->received_from => $this->input->post($this->received_from),
			$this->address 	     => $this->input->post($this->address),
			$this->date          => date('Y-m-d', strtotime($this->input->post($this->date))),
			$this->phone 	     => $this->input->post($this->phone),
			$this->ordered_no	 => $this->input->post($this->ordered_no),
			$this->total_amount  => $this->input->post($this->total_amount),
			$this->reference     => $this->input->post($this->reference),
			$this->status        => (int) 1,
			$this->status        => (int) 1,
			$this->updatedBy     => (int) $this->user->info->ID,
			$this->updatedAt     => date("Y-m-d H:i:s"))
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
			foreach ($this->input->post($this->description) as $key => $description){
				if($this->input->post('item_id')[$key])
				{	// update existing item
					$this->db->where($this->id, $this->input->post('item_id')[$key])
					->update($this->tblItems, array(
					$this->goods_received_note_id => $id,
					$this->description 	       => $description,
					$this->item_no             => $this->input->post($this->item_no)[$key],
					$this->ref_no 	 	       => $this->input->post($this->ref_no)[$key],
					$this->uom 	 	           => $this->input->post($this->uom)[$key],
					$this->price 	 	       => $this->input->post($this->price)[$key],
					$this->remark 	 	 	   => $this->input->post($this->remark)[$key]));
				}else{
					// add new item
					$this->db->insert($this->tblItems, array(
					$this->goods_received_note_id => $id,
					$this->description 	       => $description,
					$this->item_no             => $this->input->post($this->item_no)[$key],
					$this->ref_no 	 	       => $this->input->post($this->ref_no)[$key],
					$this->uom 	 	           => $this->input->post($this->uom)[$key],
					$this->price 	 	       => $this->input->post($this->price)[$key],
					$this->remark 	 	 	   => $this->input->post($this->remark)[$key]));
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
        $filePath    = '/goods_received_note';
        $inputFile   = 'attachment_files';
        $fileRemoved = 'attachment_files_deleted';
        $fileCatch   = 'attachment_files_catch';
        $fileUpload  = $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved, $fileCatch);
        if(!empty($fileUpload)){
            foreach ($fileUpload as $file) {
                $this->db->insert($this->tblFiles, array(
                "goods_received_note_id"  => $id,
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
         
        /* update purchase request status  */
		$this->db->where($this->id, $recordID)->update($this->table, array(
			$this->authorize_status => $status,
			$status.'_by'   => (int) $this->user->info->ID,
			$status.'_at'   => date("Y-m-d H:i:s"))
		);

        /* alert notification and send email to user */ 
        if($status == 'checked'){
	        // set email template approve
	        $title = 'has checked your goods received note form.';
	        $email_template = getEmailTempalteByHook($this->hook_check, $this->email_lang);
	    }elseif($status == 'rejected'){
			$this->db
				 ->where($this->id, $recordID)
				 ->update($this->table, array('reject_comment' => $_GET['comment']));
	        // set email template
	        $title = 'has rejected your goods received note form.';
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
			}
			if($this->authorization->hasPermission($this->moduleName, "LIST_OWN_DEPARTMENT")){
				$user_in_dept = getUserIdByDepId($this->user->info->department_id);
                $where[] = array($this->table.'.'.$this->createdBy, $user_in_dept);
                $where[] = array($this->table.'.'.$this->checked_by, $user_in_dept);
			}
			if($this->authorization->hasPermission($this->moduleName, "LIST_OWN_RECORD")){
                $where[] = array($this->table.'.'.$this->createdBy, $this->user->info->ID);
                $where[] = array($this->table.'.'.$this->checked_by, $this->user->info->ID);
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
					->select('id, grn_no')
					->order_by('id', 'desc')
					->limit(1)
					->get($this->table)
					->row();
		if(!empty($output)){
			$year = substr($output->grn_no, 4, 2);
			$month = substr($output->grn_no, 7,2);
			$digit = substr($output->grn_no, 10);

			if(date('y') == $year && date('m') == $month)
			{
				$digit = str_pad((int) $digit+1, 4, "0", STR_PAD_LEFT);
			}else{
				$digit = '0001';
			}
			return 'GRN-'.date('y-m-').$digit;
		}
		return 'GRN-'.date('y-m-').'0001';

	}

    /** 
      *-------------------------------
      * ADD ON
      *-------------------------------
      */
	public function findFiles($id){
		return $this->db
					->where($this->goods_received_note_id, $id)
					->order_by($this->id, 'asc')
					->get($this->tblFiles)
					->result();
	}
	public function findItems($id){
		return $this->db
					->where($this->goods_received_note_id, $id)
					->order_by($this->id, 'asc')
					->get($this->tblItems)
					->result();
	}
	public function findCompanyActive(){
		return $this->db
					->where($this->status, 1)
					->get($this->tblCompany)
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
		$status = $_GET['filter'];
		$from_date   = $_GET['from_date'];
		$to_date     = $_GET['to_date'];
		$checked_by  = $_GET['checked_by'];

		$this->db->select('*');
		$this->db->from($this->table);

		if($status != 'all' && $status != ''){
			/* filter field */
			if($status == 'checked' || $status == 'checked_detail'){
				$this->db->where($this->authorize_status, 'checked');
			}else{
				$this->db->where($this->authorize_status.' !=', 'checked');
			}
			if($from_date != ""){
				$from_date = date('Y-m-d', strtotime($_GET['from_date']));
				$this->db->where($this->date.' >=', $from_date);
			}
			if($to_date != ""){
				$to_date = date('Y-m-d', strtotime($_GET['to_date']));
				$this->db->where($this->date.' <=', $to_date);
			}
			if($checked_by != ""){
				$this->db->where($this->checked_by, $checked_by);
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
		$prefix = 'GRN';
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
		$activeCode = $this->db->select("grn_no")
				 ->like('grn_no', $prefix.'-'.$year.'-'.$month, 'after')
				 ->order_by('grn_no', 'desc')
				 ->limit(1)
				 ->get($this->table)
				 ->row();

		$historyCode = $this->db->select("grn_no")
						->like('grn_no', $prefix.'-'.$year.'-'.$month, 'after')
						->order_by('grn_no', 'desc')
						->limit(1)
						->get($this->tblHistory)
						->row();

		if(!empty($activeCode)){
			$code = (int) str_replace($prefix.'-'.$year.'-'.$month.'-', '', $activeCode->grn_no);
		}

		if(!empty($historyCode)){
			$code_history = (int) str_replace($prefix.'-'.$year.'-'.$month.'-', '', $historyCode->grn_no);
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