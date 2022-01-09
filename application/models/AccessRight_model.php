<?php

class AccessRight_Model extends CI_Model {

    public $table = "ac_accessright_request";
    private $tblMainRequest = 'ac_main_application_request';
    private $tblFile = 'ac_accessright_attached';
    public $id = 'id';
    /* approval */
    private $tblAuthorizeLog = "authorize_log";
    private $authorize_id    = "authorize_id";
    private $log_id          = "log_id";
    public function tableInfo(){ 
        return array('name'=>$this->table, 'id'=>$this->id);
    }

    function findAll() {
        if(!$this->authorization->hasPermission("accessright", "list_all")){
            if($this->authorization->hasPermission("accessright", "list_own_department")){
                $this->db->where_in('department', $this->user->info->department_id);
            }else{
                $this->db->where('created_by', $this->user->info->ID);
            }
        }
        return $this->db
                    ->join($this->tblAuthorizeLog, $this->tblAuthorizeLog.'.'.$this->log_id.'='.$this->table.'.'.$this->authorize_id,'inner')
                    ->get($this->table)
                    ->result();
    }

    function findAllFilter($filter){
        if(!$this->authorization->hasPermission("accessright", "list_all")){
            if($this->authorization->hasPermission("accessright", "list_own_department")){
                $this->db->where_in('department', $this->user->info->department_id);
            }else{
                $this->db->where('created_by', $this->user->info->ID);
            }
        }
        return $this->db->select('*')
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

    function save($data){
        $this->db->insert($this->table, $data);
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
                        ->where('id', $id)
                        ->get($this->table)
                        ->result();
    }

    function findMainAppById($id){
        return $this->db->select('*')
                        ->where('request_id', $id)
                        ->get($this->tblMainRequest)
                        ->result();
    }
    function findAllFilesById($id){
        return $this->db->select('*')
                        ->where('id_application_request', $id)
                        ->get($this->tblFile)
                        ->result();
    }

    function findFileById($id){
        return $this->db->select('*')
                        ->where('id_attached', $id)
                        ->get($this->tblFile)
                        ->result();
    }

    function findAllFileByAccessRightId($id){
        return $this->db->select('*')
                        ->where('id_application_request', $id)
                        ->get($this->tblFile)
                        ->result();
    }

    function updateAccessRightByID($id, $data){
        $this->db->where('id', $id)
                 ->update($this->table, $data);
        return $this->db->affected_rows();
    }

    function updateMainRequestById($appId, $data){
        $this->db->where('id', $appId)
                 ->update($this->tblMainRequest, $data);
        return $this->db->affected_rows();
    }

    function deleteAppRequestById($appId){
        $this->db->where('id', $appId)
                 ->delete($this->tblMainRequest);
        return $this->db->affected_rows();
    }

    function deleteFileById($fileId){
        $this->db->where('id_attached', $fileId)
                 ->delete($this->tblFile);
        return $this->db->affected_rows();
    }

    function deleteAccessRightById($acId){
        $this->db->where('id', $acId)
                 ->delete($this->table);
        return $this->db->affected_rows();
    }

    function deleteMainAppByAccesRightId($acId){
        $this->db->where('request_id', $acId)
                 ->delete($this->tblMainRequest);
        return $this->db->affected_rows();
    }

    function updateStatus($id, $authorize_id){
        $this->db->where($this->id, $id)
                 ->update($this->table, array($this->authorize_id => $authorize_id));
        return $this->db->affected_rows();
    }
}

?>