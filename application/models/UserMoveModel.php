<?php

class UserMoveModel extends CI_Model {

    /* table */
    public $table         = "move_user_request";
    private $tblAppFrom    = 'move_app_from';
    private $tblAppTo      = 'move_app_to';
    private $tblFile       = 'move_user_files';
    /* fields */
    public $id            = "move_id";
    private $userId        = "user_id";
    private $managerId     = "manager_id";
    private $durationMove  = "duration_move";
    private $fromDate      = "from_date";
    private $toDate        = "to_date";
    private $fromBranch    = "from_branch";
    private $fromDepartment= "from_department";
    private $fromPosition  = "from_position";
    private $toBranch      = "to_branch";
    private $toDepartment  = "to_department";
    private $toPosition    = "to_position";
    private $moveId        = "move_id";
    private $requestTypeId = "request_type_id";
    private $staffProfile  = "staff_profile_type_id";
    private $functions     = "functonalities";
    private $description     = "description";
    /* default */
    private $createdBy     = "created_by";
    private $createdAt     = "created_at";
    private $updatedBy     = "updated_by";
    private $updatedAt     = "updated_at";
    private $status        = 'status';
    private $moduleID      = null;
    /* approval */
    private $tblAuthorizeLog = "authorize_log";
    private $authorize_id    = "authorize_id";
    private $log_id          = "log_id";
    public function tableInfo(){ 
        return array('name'=>$this->table, 'id'=>$this->id);
    }

    public function __construct()
    {
        parent::__construct();
        $this->moduleID = getModuleIDByName('UserMoveRequest');
    }

    function findAll() {
        if(!$this->authorization->hasPermission("usermoverequest", "list_all")){
            if($this->authorization->hasPermission("usermoverequest", "list_own_department")){
                $this->db->where_in('department', $this->user->info->department_id);
            }else{
                $this->db->where('created_by', $this->user->info->ID);
            }
        }
        return $this->db
                    ->join($this->tblAuthorizeLog, $this->tblAuthorizeLog.'.'.$this->log_id.'='.$this->table.'.'.$this->authorize_id,'inner')
                    ->order_by($this->id, 'DESC')
                    ->get($this->table)
                    ->result();
    }

    function findAllFilter($filter){
        if(!$this->authorization->hasPermission("usermoverequest", "list_all")){
            if($this->authorization->hasPermission("usermoverequest", "list_own_department")){
                $this->db->where_in('department', $this->user->info->department_id);
            }else{
                $this->db->where('created_by', $this->user->info->ID);
            }
        }
        return $this->db
                ->select('*')
                ->join($this->tblAuthorizeLog, $this->tblAuthorizeLog.'.'.$this->log_id.'='.$this->table.'.'.$this->authorize_id,'inner')
                ->where($this->tblAuthorizeLog.'.from_status', $filter)
                ->get($this->table)
                ->result();
    }

    function findAllUsers(){
        return $this->db->select('*')
                        ->where('active', 1)
                        ->get('users')
                        ->result();
    }

    function findAllBranchs(){
        return $this->db->get('branch')->result();
    }

    function findAllDepartments(){
        return $this->db->get('ac_department')->result();
    }

    function findAllRequestTo(){
        return $this->db->select('*')
                        ->where('status', 1)
                        ->get('ac_request_to')
                        ->result();
    }

    function findAllRequestType(){
        return $this->db->select('*')
                        ->where('status', 1)
                        ->get('ac_request_type')
                        ->result();
    }

    function getFunctions($idRequestType) {
        return $this->db->select('*')
                        ->where('id_requestType', $idRequestType)
                        ->order_by('FunctionName', 'asc')
                        ->get('ac_functions')
                        ->result();
    }

    function getStaffProfileType($AppID) {
        return $this->db->select('*')
                        ->where('ID_RequestType', $AppID)
                        ->where('Status', 1)
                        ->order_by('ProfileName', 'asc')
                        ->get('ac_profile_type')
                        ->result();
    }

    function alertEmail() {
        return $this->db->get('ac_managementauthorized')->result();
    }

    function bmInfo($idBranch) {
        return $this->db->select('manager_name,email')
                        ->where('branch_code', $idBranch)
                        ->get('branch')
                        ->result();
    }

    function findUserById($userID) {
        return $this->db->select('*')
                 ->from('users')
                 ->where('ID', $userID)
                 ->get()
                 ->row();
    }


    function findAllPositions(){
        return $this->db->select('*')
                        ->where('status', 1)
                        ->get('ac_position')
                        ->result();
    }

    /** 
      *--------------------------------------------------
      * INSERT TO USER MOVE REQUEST
      *--------------------------------------------------
      */
    function save(){
        $data = array(
            $this->userId         => $this->input->post($this->userId),
            $this->managerId      => $this->input->post($this->managerId),
            $this->durationMove   => $this->input->post($this->durationMove),
            $this->fromDate       => $this->input->post($this->fromDate),
            $this->toDate         => $this->input->post($this->toDate),
            $this->fromBranch     => $this->input->post($this->fromBranch),
            $this->fromDepartment => $this->input->post($this->fromDepartment),
            $this->fromPosition   => $this->input->post($this->fromPosition),
            $this->toBranch       => $this->input->post($this->toBranch),
            $this->toDepartment   => $this->input->post($this->toDepartment),
            $this->toPosition     => $this->input->post($this->toPosition),
            $this->description     => $this->input->post($this->description),
            $this->createdBy      => $this->user->info->ID,
            $this->createdAt      => date("Y-m-d H:i:s")
        );
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /** 
      *--------------------------------------------------
      * INSERT TO MOVE APP FROM
      *--------------------------------------------------
      */
    function saveMoveAppFrom($moveId)
    {
        $mainapp = $this->input->post('from_main_app');
        for ($i=0; $i < sizeof($mainapp); $i++) 
        { 
            $funcs = $this->input->post('from_function');
            $functionalities = array();
            foreach ($funcs as $key => $fun) {
                if(isset($fun[$i])){
                    $functionalities[] = $fun[$i];
                }
            }

            $appFrom = array(
                $this->moveId        => $moveId,
                $this->requestTypeId => $this->input->post('from_main_app')[$i],
                $this->staffProfile  => $this->input->post('from_staff_profile_type')[$i],
                $this->functions     => implode(",", $functionalities),
                $this->createdBy     => $this->user->info->ID,
                $this->createdAt     => date("Y-m-d H:i:s")
            );
            $this->db->insert($this->tblAppFrom, $appFrom);
        }
        return $this->db->insert_id();        
    }

    /** 
      *--------------------------------------------------
      * INSERT TO MOVE APP TO
      *--------------------------------------------------
      */
    function saveMoveAppTo($moveId)
    {
        $mainapp = $this->input->post('to_main_app');
        for ($i=0; $i < sizeof($mainapp); $i++) 
        { 
            $funcs = $this->input->post('to_function');
            $functionalities = array();
            foreach ($funcs as $key => $fun) {
                if(isset($fun[$i])){
                    $functionalities[] = $fun[$i];
                }
            }

            $appTo = array(
                $this->moveId        => $moveId,
                $this->requestTypeId => $this->input->post('to_main_app')[$i],
                $this->staffProfile  => $this->input->post('to_staff_profile_type')[$i],
                $this->functions     => implode(",", $functionalities),
                $this->createdBy     => $this->user->info->ID,
                $this->createdAt     => date("Y-m-d H:i:s")
            );
            $this->db->insert($this->tblAppTo, $appTo);
        }     
        return $this->db->insert_id(); 
    }

    function saveMainRequest($data){
        $this->db->insert($this->tblMainRequest, $data);
        return $this->db->insert_id();
    }

    function saveFile($_file){
        $this->db->insert($this->tblFile, $_file);
        return $this->db->insert_id();
    }

    public function get_email_template_hook($hook, $language) 
    {
        return $this->db->where("hook", $hook)
            ->where("language", $language)->get("email_templates");
    }

    function findAllById($id){
        return $this->db->select('*')
                        ->join($this->tblAuthorizeLog, $this->tblAuthorizeLog.'.'.$this->log_id.'='.$this->table.'.'.$this->authorize_id,'inner')
                        ->where($this->id, $id)
                        ->get($this->table)
                        ->result();
    }

    function findAppFromById($id){
        return $this->db->select('*')
                        ->where($this->id, $id)
                        ->get($this->tblAppFrom)
                        ->result();
    }

    function findAppToById($id){
        return $this->db->select('*')
                        ->where($this->id, $id)
                        ->get($this->tblAppTo)
                        ->result();
    }
    function findAllFilesById($id){
        return $this->db->select('*')
                        ->where($this->id, $id)
                        ->get($this->tblFile)
                        ->result();
    }

    function findFileById($id){
        return $this->db->select('*')
                        ->where('id', $id)
                        ->get($this->tblFile)
                        ->row();
    }

    function findAllFileByMoveId($moveId){
        return $this->db->select('*')
                        ->where($this->id, $moveId)
                        ->get($this->tblFile)
                        ->result();
    }

    function update($id){
        $data = array(
            $this->userId         => $this->input->post($this->userId),
            $this->managerId      => $this->input->post($this->managerId),
            $this->durationMove   => $this->input->post($this->durationMove),
            $this->fromDate       => $this->input->post($this->fromDate),
            $this->toDate         => $this->input->post($this->toDate),
            $this->fromBranch     => $this->input->post($this->fromBranch),
            $this->fromDepartment => $this->input->post($this->fromDepartment),
            $this->fromPosition   => $this->input->post($this->fromPosition),
            $this->toBranch       => $this->input->post($this->toBranch),
            $this->toDepartment   => $this->input->post($this->toDepartment),
            $this->toPosition     => $this->input->post($this->toPosition),
            $this->description    => $this->input->post($this->description),
            $this->updatedBy      => $this->user->info->ID,
            $this->updatedAt      => date("Y-m-d H:i:s")
        );
        $this->db->where($this->id, $id)
                 ->update($this->table, $data);
        return $this->db->affected_rows();
    }

    function updateStatus($id, $authorize_id){
        $this->db->where($this->id, $id)
                 ->update($this->table, array($this->authorize_id => $authorize_id));
        return $this->db->affected_rows();
    }

    /** 
      *--------------------------------------------------
      * UPDATE EXISTING MAIN APP FROM
      * ADD MORE MAIN APP FROM IF EXIST
      *--------------------------------------------------
      */
    function updateMoveAppFrom($moveId)
    {
        $appid = $this->input->post('appfromid');
        $mainapp = $this->input->post('from_main_app');
        for ($i=0; $i < sizeof($mainapp); $i++) 
        { 
            $funcs = $this->input->post('from_function');
            $functionalities = array();
            foreach ($funcs as $key => $fun) {
                if(isset($fun[$i])){
                    $functionalities[] = $fun[$i];
                }
            }

            if($i < sizeof($appid)){ 
                // update existing data
                $this->db->where('id', $appid[$i])
                         ->update($this->tblAppFrom, array(
                            $this->moveId        => $moveId,
                            $this->requestTypeId => $this->input->post('from_main_app')[$i],
                            $this->staffProfile  => $this->input->post('from_staff_profile_type')[$i],
                            $this->functions     => implode(",", $functionalities),
                            $this->updatedAt     => $this->user->info->ID,
                            $this->updatedBy     => date("Y-m-d H:i:s")));
            }else{ 
                // add more data if exist
                $this->db->insert($this->tblAppFrom, array(
                            $this->moveId        => $moveId,
                            $this->requestTypeId => $this->input->post('from_main_app')[$i],
                            $this->staffProfile  => $this->input->post('from_staff_profile_type')[$i],
                            $this->functions     => implode(",", $functionalities),
                            $this->createdBy     => $this->user->info->ID,
                            $this->createdAt     => date("Y-m-d H:i:s")));
            }  
        }
        return true;        
    }

    /** 
      *--------------------------------------------------
      * UPDATE EXISTING MAIN APP TO
      * ADD MORE MAIN APP TO IF EXIST
      *--------------------------------------------------
      */
    function updateMoveAppTo($moveId)
    {
        $appid = $this->input->post('apptoid');
        $mainapp = $this->input->post('to_main_app');
        for ($i=0; $i < sizeof($mainapp); $i++) 
        { 
            $funcs = $this->input->post('to_function');
            $functionalities = array();
            foreach ($funcs as $key => $fun) {
                if(isset($fun[$i])){
                    $functionalities[] = $fun[$i];
                }
            }

            if($i < sizeof($appid)){ 
                // update existing data
                $this->db->where('id', $appid[$i])
                         ->update($this->tblAppTo, array(
                            $this->moveId        => $moveId,
                            $this->requestTypeId => $this->input->post('to_main_app')[$i],
                            $this->staffProfile  => $this->input->post('to_staff_profile_type')[$i],
                            $this->functions     => implode(",", $functionalities),
                            $this->updatedAt     => $this->user->info->ID,
                            $this->updatedBy     => date("Y-m-d H:i:s")));
            }else{ 
                // add more data if exist
                $this->db->insert($this->tblAppTo, array(
                            $this->moveId        => $moveId,
                            $this->requestTypeId => $this->input->post('to_main_app')[$i],
                            $this->staffProfile  => $this->input->post('to_staff_profile_type')[$i],
                            $this->functions     => implode(",", $functionalities),
                            $this->createdBy     => $this->user->info->ID,
                            $this->createdAt     => date("Y-m-d H:i:s")));
            }  
        }
        return true;        
    }

    function updateMainRequestById($appId, $data){
        $this->db->where('id', $appId)
                 ->update($this->tblMainRequest, $data);
        return $this->db->affected_rows();
    }

    function deleteAppFromById($appId){
        $this->db->where('id', $appId)
                 ->delete($this->tblAppFrom);
        return $this->db->affected_rows();
    }

    function deleteAppToById($appId){
        $this->db->where('id', $appId)
                 ->delete($this->tblAppTo);
        return $this->db->affected_rows();
    }

    function deleteFileById($fileId){
        $this->db->where('id', $fileId)
                 ->delete($this->tblFile);
        return $this->db->affected_rows();
    }

    function delete($id){
        $this->db->where($this->id, $id)
                 ->delete($this->table);
        return $this->db->affected_rows();
    }
}

?>