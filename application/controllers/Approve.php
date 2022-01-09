<?php 
/**
* @author [Pho Khaing] <[<khaing.pho1991@gmail.com]>
* @date 23/June/2020
*/
class Approve extends CI_Controller
{	
	var $table           = "authorize_log";
    var $currentUser     = null;
    var $status          = "status";
    var $moduleID        = "module_id";
    var $recordID        = "record_id";
    var $fromUser        = "from_user";
    var $fromStatus      = "from_status";
    var $toUser        	 = "to_user";
    var $toStatus      	 = "to_status";
    var $comment         = "comment";
    var $date            = "date";
    var $url 			 = null;

	function __construct()
	{
		parent::__construct();
		if (!$this->user->loggedin){
            redirect('login');
		}
		if(isset($this->user->info->ID)){
            $this->currentUser = $this->user->info->ID;
        }
        $this->load->database();
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for approval
      *----------------------------------------------------------------
      */
	public function approve($moduleID = null, $recordID = null, $tableName = null, $tableID = null)
	{

        $this->url = getModuleNameByID($moduleID);
        if($moduleID!=null && $recordID !=null)
        {
        	/**
        	 * -----------------------------------------------------------------------
        	 * Method for insert authorize log
        	 * -----------------------------------------------------------------------
        	 */
        	$status = $this->input->post($this->status);
        	if($status == 'transfer'){
	          	$approval_log = array(
	              $this->status     => $this->input->post($this->status),
	              $this->moduleID   => $moduleID,
	              $this->recordID   => $recordID,
	              $this->fromUser 	=> $this->currentUser,
	              $this->fromStatus => $this->input->post($this->fromStatus),
	              $this->toUser     => implode(",", $this->input->post($this->toUser)),
	              $this->toStatus 	=> $this->input->post($this->toStatus),
	              $this->comment    => $this->input->post($this->comment),
	              $this->date 			=> date("Y-m-d H:i:s")
	          	);
	      	}else if($status == 'reject'){
	      		$approval_log = array(
	              $this->status     => $this->input->post($this->status),
	              $this->moduleID   => $moduleID,
	              $this->recordID   => $recordID,
	              $this->fromUser 	=> $this->currentUser,
	              $this->fromStatus => 5,
	              $this->comment    => $this->input->post($this->comment),
	              $this->date 			=> date("Y-m-d H:i:s")
	          	);
	      	}else{// aprove
	      		$approval_log = array(
	              $this->status     => $this->input->post($this->status),
	              $this->moduleID   => $moduleID,
	              $this->recordID   => $recordID,
	              $this->fromUser 	=> $this->currentUser,
	              $this->fromStatus => 4,
	              $this->comment    => $this->input->post($this->comment),
	              $this->date 			=> date("Y-m-d H:i:s")
	          	);
	      	}

          $this->db->insert($this->table, $approval_log);
          $log = $this->db->insert_id();

          if($log){
         		/**
          	 * -----------------------------------------------------------------------
          	 * Method for update authorize_id of tableName
          	 * -----------------------------------------------------------------------
          	 */
          	if($tableName!=null && $tableID !=null){
          	 	$this->db->where($tableID, $recordID)->update($tableName, array('authorize_id'=>$log));
          	} 

          	/**
          	 * -----------------------------------------------------------------------
          	 * METHOD FOR UPDATE USER MAIN APP AFTER APPROVED
          	 * -----------------------------------------------------------------------
          	 */
          	if($status == 'approve'){
          		/**
	          	 * -----------------------------------------------------------------------
	          	 * Method for add user main app after approved on module user move request
	          	 * -----------------------------------------------------------------------
	          	 */
          		if($tableName == 'move_user_request'){
	          		$main_app = $this->db
	          							       ->where("move_app_to.move_id", $recordID)
	          							       ->join($tableName, $tableName.'.move_id=move_app_to.move_id', 'inner')
	          							       ->get('move_app_to')
	          							       ->result();

	          		if(!empty($main_app)){
	          				$this->db->where('user_id', $main_app[0]->user_id)->update('users_main_app', array('current'=>0));
			          		// update user main app after approved
			          		foreach ($main_app as $app){
			          			$this->db->insert('users_main_app', array(
					                'user_id' 							=> $app->user_id,
					                'request_type_id' 	    => $app->request_type_id,
					                'staff_profile_type_id' => $app->staff_profile_type_id,
					                'functionalities' 		  => $app->functonalities,
					                'current' 		  			  => 1,
					                'created_by'     	  	  => $this->currentUser,
					                'created_at'     	  	  => date("Y-m-d H:i:s"))
			          			);
			          		}
			          		// update user branch, department, position
			          		$this->db->where('ID', $main_app[0]->user_id)->update('users', array(
					              'branch' 				=> $main_app[0]->to_branch,
					              'department_id' => $main_app[0]->to_department,
					              'position_id' 	=> $main_app[0]->to_position)
			          		);
	          		}
	          	}

	          	/**
	          	 * --------------------------------------------------------------------------
	          	 * Method for add user main app after approved on module access right request
	          	 * --------------------------------------------------------------------------
	          	 */
	          	if($tableName == 'ac_accessright_request'){
	          		$main_app = $this->db
	          										 ->select($tableName.'.user_id, ac_main_application_request.*')
	          							       ->where("ac_main_application_request.request_id", $recordID)
	          							       ->join($tableName, $tableName.'.id=ac_main_application_request.request_id', 'inner')
	          							       ->get('ac_main_application_request')
	          							       ->result();

	          		if(!empty($main_app)){
			          		// update user main app after approved
			          		foreach ($main_app as $app){
			          			$this->db->insert('users_main_app', array(
					                'user_id' 							=> $app->user_id,
					                'request_type_id' 	    => $app->request_type_id,
					                'staff_profile_type_id' => $app->request_type_profile_id,
					                'functionalities' 		  => $app->functionalities,
					                'current' 		  			  => 1,
					                'created_by'     	  	  => $this->currentUser,
					                'created_at'     	  	  => date("Y-m-d H:i:s"))
			          			);
			          		}
	          		}
	          	}
          	}


          	/**
          	 * -----------------------------------------------------------------------
          	 * ALERT NOTIFICATION & SEND EMAIL TO USERS TRANSFERS
          	 * -----------------------------------------------------------------------
          	 */   
          	if(!isset($_COOKIE['language'])){
							$lang = $this->config->item("language");
						}else{
							$lang = $this->common->nohtml($_COOKIE["language"]);
						}
          	$email_template = null;
          	$users = explode(",", implode(",", $this->input->post($this->toUser)));

          	if($status == 'transfer'){
 					/* get email template transfer user move */
 					if($tableName == 'move_user_request'){
						$email_template = getEmailTempalteByHook("transter_usermove", $lang);
					}
					/* get email template ac_accessright_request */
					if($tableName == 'ac_accessright_request'){
						$email_template = getEmailTempalteByHook("transfer_accessright", $lang);
					}

 					/* ALERT NOTIFICATION & SEND EMAIL TO USERS TRANSFERS */
	            foreach ($users as $user_id)
	            {		
	            	$add_notification = array(
		               "userid" 	=> $user_id,
		               "url" 		=> $this->url."/view?id=".$recordID,
		               "message" 	=> 'has '.findAuthStatusName($this->input->post($this->fromStatus)).'ed this form and transfers for you to '.findAuthStatusName($this->input->post($this->toStatus)),
		               "fromid" 	=> $this->currentUser,
		               "status" 	=> 0,
		               "timestamp" => time()
	              	);

						$user = getUserByID($user_id);
						$email_template->message = $this->common->replace_keywords(array(
							"[NAME]" => $user->first_name.' '.$user->last_name,
							"[SITE_URL]" => base_url().$this->url."/view?id=".$recordID,
							"[STATUS]" => findAuthStatusName($this->input->post($this->toStatus)),
							"[SITE_NAME]" =>  $this->settings->info->site_name),
							$email_template->message
						);
						$this->db->where("ID", $user_id)->set('noti_count', 'noti_count' . '+'. 1, FALSE)->update("users");
						$this->db->insert("user_notifications", $add_notification);
						$this->common->send_email($email_template->title, $email_template->message, $user->email);
					}
          	}
          	
          }

          $this->session->set_flashdata("success", "Congratulation, transaction successful!");
          redirect(base_url().$this->url);
        }
    }

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit create authorize
      *----------------------------------------------------------------
      */
	public function create()
	{	
		if($this->authorization->hasPermission($this->moduleName, "create")){
			/** 
	          *-------------------------------
	          * VALIDATION FORM
	          *-------------------------------
	          */
			$this->form_validation->set_rules('authorize_name', 'authorize Name', 'trim|required|min_length[2]|max_length[255]|is_unique[authorize.authorize_name]');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if($this->form_validation->run() == false){
				$this->template->loadContent($this->page."add", $this->data);
			}else{

				/** 
		          *-------------------------------
		          * VALIDATION SUCCESS
		          * INSERT authorize
		          *-------------------------------
		          */
				$output = $this->authorizeModel->create();
				if($output){
					$this->session->set_flashdata("success", "Congratulation, Record has been saved successfully!");
				}else{
					$this->session->set_flashdata("error", "Faile, something went wrong!");
	            	$this->template->loadContent($this->page."add", $this->data);
				}
	            redirect($this->currentURl);
			}
		}
	}
}

 ?>