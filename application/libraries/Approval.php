<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once("User.php");
require_once("Common.php");
class Approval {

    var $table           = "authorize_log";
    var $id              = "log_id";
    var $currentUser     = null;
    var $status          = "status";
    var $moduleID        = "module_id";
    var $recordID        = "record_id";
    var $fromUser        = "from_user";
    var $fromStatus      = "from_status";
    var $toUser          = "to_user";
    var $toStatus        = "to_status";
    var $comment         = "comment";
    var $date            = "date";
    var $url             = null;

    public function __construct() {
        $ci = & get_instance();
        if(isset($ci->user->info->ID)){
            $this->currentUser = $ci->user->info->ID;
        }
    }

    public function hasApproval($log_id = null){
        $ci = & get_instance();
        $ci->load->database();
        if($log_id !=null){
              $output = $ci->db
                           ->select('authorize_status.authorize_name,'.$this->table.'.*')
                           ->join('authorize_status','authorize_status.authorize_id='.$this->table.'.to_status','inner')
                           ->where($this->table.'.'.$this->id, $log_id)
                           ->get($this->table)
                           ->row();
              if(!empty($output)) {
                if($output->status != 'approve'){
                  $users = explode(",", $output->to_user);
                  if(in_array($this->currentUser, $users)){
                    return $output;
                  }else{
                    return false;
                  }
                }else{
                  return false;
                }
            }else{
              return false;
            }
        }

        return false;
    }

    public function findApprovalStatus($moduleID=null, $recordID=null){
        $ci = & get_instance();
        $ci->load->database();
        if($moduleID!=null && $recordID !=null){
              return $ci->db
                        ->select('authorize_status.authorize_name,'.$this->table.'.*')
                        ->join('authorize_status','authorize_status.authorize_id='.$this->table.'.from_status','inner')
                        ->where($this->table.'.'.$this->moduleID, $moduleID)
                        ->where($this->table.'.'.$this->recordID, $recordID)
                        ->order_by($this->id, 'ASC')
                        ->get($this->table)
                        ->result();
        }
        return false;
    }

    public function findApprovalLog($moduleID=null, $recordID=null){
        $ci = & get_instance();
        $ci->load->database();
        if($moduleID!=null && $recordID !=null){ 
              return $ci->db
                        ->select('authorize_status.authorize_name,'.$this->table.'.*')
                        ->join('authorize_status','authorize_status.authorize_id='.$this->table.'.to_status','inner')
                        ->where($this->table.'.'.$this->moduleID, $moduleID)
                        ->where($this->table.'.'.$this->recordID, $recordID)
                        ->order_by($this->id, 'ASC')
                        ->get($this->table)
                        ->result();
        }
        return false;
    }

    public function findUserRequestApproval($moduleID=null, $recordID=null){
        $ci = & get_instance();
        $ci->load->database();
        if($moduleID!=null && $recordID !=null){ 
              $output = $ci->db
                        ->where($this->table.'.'.$this->moduleID, $moduleID)
                        ->where($this->table.'.'.$this->recordID, $recordID)
                        ->where($this->table.'.'.$this->fromStatus, 1)
                        ->order_by($this->id, 'ASC')
                        ->get($this->table)
                        ->row();
              if(!empty($output)){
                return array($output->from_user);
              }else{
                return false;
              }
        }
        return false;
    }

    function showApprovalStatus($id){
      if(!empty($id))
      { 
        $ci = & get_instance();
        $ci->load->database();
        $status = $ci->db
                     ->select('authorize_name')
                     ->where('authorize_id', $id)
                     ->get('authorize_status')
                     ->row();

        if($id == 1){
          return '<span class="label label-default">'.ucfirst(strtolower($status->authorize_name)).'</span>';
        }elseif($id == 2){
          return '<span class="label label-warning">'.ucfirst(strtolower($status->authorize_name)).'</span>';
        }elseif($id == 3){
          return '<span class="label label-warning">'.ucfirst(strtolower($status->authorize_name)).'</span>';
        }elseif($id == 4){
          return '<span class="label label-success">'.ucfirst(strtolower($status->authorize_name)).'</span>';
        }elseif($id == 5){
          return '<span class="label label-danger">'.ucfirst(strtolower($status->authorize_name)).'</span>';
        }
      }else{
        return null;
      }
  }

  /** 
    *----------------------------------------------------------------
    * @author: khaing.pho1991@gmail.com
    * @param: 21/March/2020
    * @param: method for approval
    *----------------------------------------------------------------
    */
  public function transfer($moduleID = null, $recordID = null, $table=null){
        $ci = & get_instance();
        $ci->load->database();
        $this->url = getModuleNameByID($moduleID);

        if($moduleID!=null && $recordID !=null){
            $approval_log = array(
              $this->status     => $ci->input->post($this->status),
              $this->moduleID   => $moduleID,
              $this->recordID   => $recordID,
              $this->fromUser   => $this->currentUser,
              $this->fromStatus => 1,
              $this->toUser     => implode(",", $ci->input->post($this->toUser)),
              $this->toStatus   => $ci->input->post($this->toStatus),
              $this->comment    => $ci->input->post($this->comment),
              $this->date       => date("Y-m-d H:i:s")
            );
            $ci->db->insert($this->table, $approval_log);
            return $ci->db->insert_id();
        } 
    }

    /** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for approval
      *----------------------------------------------------------------
      */
  public function approve($tableName = null, $tableID = null, $moduleID = null, $recordID = null)
  {
      $ci = & get_instance();
      $ci->load->database();
      $this->url = getModuleNameByID($moduleID);
      $status = $ci->input->post($this->status);

      if($moduleID!=null && $recordID !=null)
      {
        /**
         * -----------------------------------------------------------------------
         * Method for insert authorize log
         * -----------------------------------------------------------------------
         */
        if($status == 'transfer'){
            $approval_log = array(
              $this->status     => $ci->input->post($this->status),
              $this->moduleID   => $moduleID,
              $this->recordID   => $recordID,
              $this->fromUser   => $this->currentUser,
              $this->fromStatus => $ci->input->post($this->fromStatus),
              $this->toUser     => implode(",", $ci->input->post($this->toUser)),
              $this->toStatus   => $ci->input->post($this->toStatus),
              $this->comment    => $ci->input->post($this->comment),
              $this->date       => date("Y-m-d H:i:s")
            );
        }else if($status == 'reject'){
          $approval_log = array(
              $this->status     => $ci->input->post($this->status),
              $this->moduleID   => $moduleID,
              $this->recordID   => $recordID,
              $this->fromUser   => $this->currentUser,
              $this->fromStatus => 5,
              $this->comment    => $ci->input->post($this->comment),
              $this->date       => date("Y-m-d H:i:s")
            );
        }else{// aprove
          $approval_log = array(
              $this->status     => $ci->input->post($this->status),
              $this->moduleID   => $moduleID,
              $this->recordID   => $recordID,
              $this->fromUser   => $this->currentUser,
              $this->fromStatus => 4,
              $this->comment    => $ci->input->post($this->comment),
              $this->date       => date("Y-m-d H:i:s")
            );
        }

        $ci->db->insert($this->table, $approval_log);
        $log = $ci->db->insert_id();

        if($log){
          /**
           * -----------------------------------------------------------------------
           * Method for update authorize_id of tableName
           * -----------------------------------------------------------------------
           */
          if($tableName!=null && $tableID !=null){
            $ci->db->where($tableID, $recordID)->update($tableName, array('authorize_id'=>$log));
            return $ci->db->affected_rows();
          } 
        }
      }

      return false;
  }

    /**
     * -----------------------------------------------------------------------
     * ALERT NOTIFICATION & SEND EMAIL TO USERS TRANSFERS
     * -----------------------------------------------------------------------
     */ 
    public function alertNotification($user_id=null, $title=null, $email_template=null, $moduleID=null, $recordID=null){
        $ci = & get_instance();
        $ci->load->database();
       /**
        * -----------------------------------------------------------------------
        * ALERT NOTIFICATION & SEND EMAIL TO USERS TRANSFERS
        * -----------------------------------------------------------------------
        */       

        // $users = explode(",", implode(",", $users)); 
        // foreach ($users as $user_id){  
          $add_notification = array(
             "userid"   => $user_id,
             "url"      => getModuleNameByID($moduleID)."/view?id=".$recordID,
             "message"  => $title,
             "fromid"   => $this->currentUser,
             "status"   => 0,
             "timestamp" => time()
             );

          $user = getUserByID($user_id);
          $email_template->message = $ci->common->replace_keywords(array(
            "[NAME]" => $user->first_name.' '.$user->last_name,
            "[FIRST_NAME]" => $ci->user->info->first_name,
            "[LAST_NAME]" => $ci->user->info->last_name,
            "[SITE_URL]" => base_url().getModuleNameByID($moduleID)."/view?id=".$recordID,
            "[SITE_NAME]" =>  $ci->settings->info->site_name),
            $email_template->message
          );

          $ci->db->where("ID", $user_id)->set('noti_count', 'noti_count' . '+'. 1, FALSE)->update("users");
          $ci->db->insert("user_notifications", $add_notification);
          $ci->common->send_email($email_template->title, $email_template->message, $user->email);
        // }
    }

    public function updateStatus($tableName=null, $field, $record_id, $auth_id){
        $ci = & get_instance();
        $ci->load->database();
        $ci->db->where($field, $record_id)
               ->update($tableName, array('authorize_id' => $auth_id));
        return $ci->db->affected_rows();
    }

}

?>
