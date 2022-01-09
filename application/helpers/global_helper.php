<?php 
function getUserFullName($userID){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('first_name, last_name')
              ->where('ID', $userID)
              ->get('users')
              ->row();
    
    if(!empty($output)){
        return $output->first_name.' '.$output->last_name;
    }else{
        return null;
    }
}
function getUserFullNameKH($userID){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('first_name_kh, last_name_kh')
              ->where('ID', $userID)
              ->get('users')
              ->row();
    
    if(!empty($output)){
        return $output->last_name_kh.' '.$output->first_name_kh;
    }else{
        return null;
    }
}
function getPositionNameKhByUserId($userID){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('position_name_kh')
              ->join('ac_position', 'ac_position.id=users.position_id','inner')
              ->where('users.ID', $userID)
              ->get('users')
              ->row();
    
    if(!empty($output)){
        return $output->position_name_kh;
    }else{
        return null;
    }
}
function getStaffID($userID){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('staff_id')
              ->where('ID', $userID)
              ->get('users')
              ->row();
    
    if(!empty($output)){
        return $output->staff_id;
    }else{
        return null;
    }
}
function getDepartmentNameENByID($depID){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('department_name')
              ->where('id_department', $depID)
              ->get('ac_department')
              ->row();
    
    if(!empty($output)){
        return $output->department_name;
    }else{
        return 'NULL';
    }
}
function getUserIdByBranchId($branch){
  $ci=& get_instance();
  $ci->load->database();
  $output = $ci->db->select('ID')
            ->where('branch', $branch)
            ->get('users')
            ->result();
            
  if(!empty($output)){
      $_array = array();
      foreach ($output as $key => $value) {
          $_array[] = $value->ID;
      }
      return $_array;
  }else{
      return null;
  }
}
function getUserIdByDepId($depId){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('ID')
              ->where('department_id', $depId)
              ->get('users')
              ->result();
    
    if(!empty($output)){
        $_array = array();
        foreach ($output as $key => $value) {
            $_array[] = $value->ID;
        }
        return $_array;
    }else{
        return null;
    }
}

/**
  *---------------------------------------------------------------
  * Menu Management
  *---------------------------------------------------------------
  */

function getAllMenuOrderable(){
    $ci=& get_instance();
    $ci->load->database();
    $result = $ci->db->select('orderable')
                     ->get('menu_orderable')
                     ->row();
    if(!empty($result)){
        return $result->orderable;
    }else{
        return null;
    }
}
function getMenuNameEN($menuId){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('menu_name_en')
              ->where('menu_id', $menuId)
              ->get('menu')
              ->row();
    
    if(!empty($output)){
        return $output->menu_name_en;
    }else{
        return null;
    }
}
function getMenuIdbyNameEn($menuNameEn){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('menu_id')
              ->where('menu_name_en', $menuNameEn)
              ->get('menu')
              ->row();
    
    if(!empty($output)){
        return (int) $output->menu_id;
    }else{
        return null;
    }
}
function getMenuIdbyUrl($menuUrl){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('menu_id')
              ->join('module','menu.menu_url=module.module_id', 'left')
              ->where('module_name', $menuUrl)
              ->get('menu')
              ->row();
    
    if(!empty($output)){
      return $output->menu_id;
    }else{
      return null;
    }
}
function getModuleId($menuId){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('menu_url')
              ->where('menu_id', $menuId)
              ->get('menu')
              ->row();
    if(!empty($output)){
       return $output->menu_url;
    }else{
      return null;
    }
          
}

function getMenuURL($menuId){
    $ci=& get_instance();
    $ci->load->database();
    $menu = $ci->db->select('menu_url')
              ->where('menu_id', $menuId)
              ->get('menu')
              ->row();
    
    if(!empty($menu)){
        $module = $ci->db->select('module_name')
              ->where('module_id', $menu->menu_url)
              ->get('module')
              ->row();

        if(!empty($module)){
           return $module->module_name;
        }else{
          return null;
        }
    }else{
        return null;
    }
}

function getMenuIcon($menuId){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('menu_icon')
              ->where('menu_id', $menuId)
              ->get('menu')
              ->row();
    
    if(!empty($output)){
        return $output->menu_icon;
    }else{
        return 'glyphicon-user';
    }
}
function getMenuIconColor($menuId){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('icon_color')
              ->where('menu_id', $menuId)
              ->get('menu')
              ->row();
    
    if(!empty($output)){
        return $output->icon_color;
    }else{
        return 'blue';
    }
}
function getCategories($catName, $catParent){
    $ci=& get_instance();
    $ci->load->database();
    $sub1 = $ci->db->select('*')
              ->where('ID', $catParent)
              ->get('ticket_categories')
              ->row();
    
    if(!empty($sub1)){
        // sub2
        $sub2 = $ci->db->select('*')
              ->where('ID', $sub1->cat_parent)
              ->get('ticket_categories')
              ->row();

              if(!empty($sub2)){
                //sub3
                $sub3 = $ci->db->select('*')
                    ->where('ID', $sub2->cat_parent)
                    ->get('ticket_categories')
                    ->row();
                    
                    if(!empty($sub3)){
                      return $sub3->name.'/'.$sub2->name.'/'.$sub1->name.'/'.$catName;
                    }else{
                      return $sub2->name.'/'.$sub1->name.'/'.$catName;
                    }
              }else{
                return $sub1->name.'/'.$catName;
              }
    }else{
        return $catName;
    }
}

function getSubCategoryByParent($parent_id){
  $ci=& get_instance();
    $ci->load->database();
    return $ci->db->select('*')
              ->where('cat_parent', $parent_id)
              ->get('ticket_categories')
              ->result();
}

function getCategoryNameByID($categoryID){
  $ci=& get_instance();
  $ci->load->database();
  $output = $ci->db
            ->select('*')
            ->where('ID', $categoryID)
            ->get('ticket_categories')
            ->row();
  if(!empty($output)){
      return $output->name;
  }else{
      return null;
  }
}

function getTicketSubCategoryByParent($parent_id){
  $ci=& get_instance();
    $ci->load->database();
    $catid = $ci->db->select('cat_parent')
              ->where('ID', $parent_id)
              ->get('ticket_categories')
              ->row();
    if(!empty($catid)){
        if($catid->cat_parent == 0){
            return $ci->db->select('*')
                ->where('cat_parent', $parent_id)
                ->get('ticket_categories')
                ->result();
        }else{
          return null;
        }
    }else{
      return null;
    }
}

function checkUserRole($userId){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('role_name')
              ->from('users')
              ->join('users_roles','users_roles.user_id = users.ID')
              ->join('role','role.role_id = users_roles.role_id')
              ->where('users_roles.user_id', $userId)
              ->get()
              ->result();
    
    if(!empty($output)){
        if(count($output)< 2){
          return $output[0]->role_name;
        }
    }
}

function viewDepartmentCatetories($parentID){
    $ci=& get_instance();
    $ci->load->database();
    $deps = array();

    if($parentID != 0){

      // for ($i=0; $i < ; $i++) { 
      //   # code...
      // }
      // parent1
      $parent1 = $ci->db->select('*')
              ->where('id_department', $parentID)
              ->get('ac_department')
              ->row();

              if(!empty($parent1)){
                $deps[] = $parent1->department_name;

                  // parent2
                  $parent2 = $ci->db->select('*')
                  ->where('id_department', $parent1->parent_id)
                  ->get('ac_department')
                  ->row();

                  if(!empty($parent2)){
                    $deps[] = $parent2->department_name;
                  }
              }
    }
    return $deps;
}

function getDepartmentParent($parentID){
    $ci=& get_instance();
    $ci->load->database();

    $result = array();
    $output = $ci->db->select('department_name as label, department_name as name, id_department as id')
              ->where('parent_id', $parentID)
              ->get('ac_department')
              ->result();
    
    return $output;
}

function getDepartmentByID($parentID){
    $ci=& get_instance();
    $ci->load->database();

    $result = array();
    $output = $ci->db->select('department_name as label, department_name as name, parent_id as id')
              ->where('id_department', $parentID)
              ->get('ac_department')
              ->result();
    
    return $output;
}

function getAllUsers(){
    $ci=& get_instance();
    $ci->load->database();

    $result = array();
    $output = $ci->db
              ->order_by('staff_id', 'asc')
              ->get('users')
              ->result();
    return $output;
}

function getAllUserGroup(){
    $ci=& get_instance();
    $ci->load->database();

    $result = array();
    $output = $ci->db
              ->get('user_groups')
              ->result();
    return $output;
}

function getUserByUserGroupID($groupID){
    $ci=& get_instance();
    $ci->load->database();

    $result = array();
    $output = $ci->db
              ->where('user_group_users.groupid', $groupID)
              ->join('user_group_users','user_group_users.userid=users.ID', 'inner')
              ->get('users')
              ->result();
    return $output;
}

function getEmailHook(){
    $ci=& get_instance();
    $ci->load->database();

    $output = $ci->db
              ->get('hook')
              ->result();
    return $output;
}

function getAlertEmail(){
  $ci=& get_instance();
  $ci->load->database();
    
  $output = $ci->db
              ->get('ac_managementauthorized')
              ->result();
  return $output;
}

function getEmailTempalteByHook($hook, $language){
  $ci=& get_instance();
  $ci->load->database();

  return $ci->db->where("hook", $hook)
          ->where("language", $language)
          ->get("email_templates")
          ->row();
}

function getUserByID($userID){
  $ci=& get_instance();
  $ci->load->database();

  return $ci->db
          ->where("ID", $userID)
          ->get("users")
          ->row();
}

function getUserByStaffID($staffID){
  $ci=& get_instance();
  $ci->load->database();

  return $ci->db
          ->where("staff_id", $staffID)
          ->get("users")
          ->row();
}

function getTicketCCByTicketID($ticketID){
    $ci=& get_instance();
    $ci->load->database();
    
    return $ci->db
              ->where('ticket_id', $ticketID)
              ->get('ticket_cc')
              ->result();
}

function findUserMainAppByUserID($userID){
    $ci=& get_instance();
    $ci->load->database();
    
    return $ci->db
              ->where('user_id', $userID) 
              ->where('current', 1) 
              ->get('users_main_app')
              ->result();
}

function findUserMoveRequestByUserID($userID){
    $ci=& get_instance();
    $ci->load->database();
    
    return $ci->db
              ->where('move_user_request.user_id', $userID)
              ->order_by('move_id', 'asc')
              ->get('move_user_request')
              ->result();
}

function findAppFromByMoveID($move_id){
    $ci=& get_instance();
    $ci->load->database();
    
    return $ci->db
              // ->join('move_app_to', 'move_app_to.move_id=move_user_request.move_id', 'inner')
              ->where('move_id', $move_id)
              ->order_by('id', 'asc')
              ->get('move_app_from')
              ->result();
}

function findAppToByMoveID($move_id){
    $ci=& get_instance();
    $ci->load->database();
    
    return $ci->db
              ->where('move_id', $move_id)
              ->order_by('id', 'asc')
              ->get('move_app_to')
              ->result();
}

function findRequestType($id){
    $ci=& get_instance();
    $ci->load->database();
    
    $output =  $ci->db
              ->select('request_type_name')
              ->where('id_request_type', $id) 
              ->get('ac_request_type')
              ->row();
    if(!empty($output)){
      return $output->request_type_name;
    }else{
      return null;
    }
} 
function findProfileType($id){
    $ci=& get_instance();
    $ci->load->database();
    
    $output =  $ci->db
              ->select('ProfileName')
              ->where('ID_Profile', $id) 
              ->get('ac_profile_type')
              ->row();
    if(!empty($output)){
      return $output->ProfileName;
    }else{
      return null;
    }
}

/**
 * send email on access right
 * @param  [request]
 * @param  [check]
 * @param  [review]
 * @param  [approve]
 * @param  [reject]
 * @return string email1,email2..
 */
function getEmailAuthorize($status){
  $ci=& get_instance();
  $ci->load->database();
    
  $output = $ci->db
            ->where('authorize_name', $status)
            ->get('authorize')
            ->row();
  if(!empty($output)){
    $_email = array();
    $_users = explode(",", $output->user_id);
    foreach ($_users as $userid) {
      $_email[] = getUserEmailByID($userid);
    }

    return implode(",", $_email);   
  }
  return null;
}
function getUserEmailByID($userID){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('email')
              ->where('ID', $userID)
              ->get('users')
              ->row();
              return $output->email;
}

function getAuthorizeStatus(){
    $ci=& get_instance();
    $ci->load->database();
    
    return $ci->db
              ->where('authorize_id !=', 1)// 1 is request
              ->where('authorize_id !=', 5)// 5 is reject
              ->get('authorize_status')
              ->result();
}

function getAllAuthorizeStatus(){
    $ci=& get_instance();
    $ci->load->database();
    
    return $ci->db
              ->get('authorize_status')
              ->result();
}

function getModuleIDByName($moduleName){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('module_id')
              ->where('module_name', $moduleName)
              ->get('module')
              ->row();
    if(!empty($output)){
      return $output->module_id;
    }else{
      return null;
    }
              
}

function getModuleNameByID($moduleID){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('module_name')
              ->where('module_id', $moduleID)
              ->get('module')
              ->row();
    if(!empty($output)){
      return ucfirst(strtolower($output->module_name));
    }else{
      return null;
    }            
}

function findAuthStatusName($status_id){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('authorize_name')
              ->where('authorize_id', $status_id)
              ->get('authorize_status')
              ->row();
    if(!empty($output)){
      return strtolower($output->authorize_name);
    }else{
      return null;
    }            
}

function findRoleActive(){
    $ci=& get_instance();
    $ci->load->database();
    return $ci->db->where('status', 1)->get('role')->result();
}

function findStatus($status){
    if(!empty($status))
    {
      if($status == 'requesting'){
        return '<span class="label label-default">'.ucfirst($status).'</span>';
      }elseif($status == 'settlement'){
        return '<span class="label label-primary">'.ucfirst($status).'</span>';
      }elseif($status == 'checked'){
        return '<span class="label label-warning">'.ucfirst($status).'</span>';
      }elseif($status == 'reviewed'){
          return '<span class="label label-warning">'.ucfirst($status).'</span>';
      }elseif($status == 'verified'){
        return '<span class="label label-info">'.ucfirst($status).'</span>';
      }elseif($status == 'approved'){
        return '<span class="label label-success">'.ucfirst($status).'</span>';
      }elseif($status == 'rejected'){
        return '<span class="label label-danger">'.ucfirst($status).'</span>';
      }
    }else{
      return null;
    }
}

function listBranchActive() 
{
  $ci=& get_instance();
  $ci->load->database();
  return $ci->db->where('status', 1)->get("branch")->result();
}

function listDepartmentActive() 
{
  $ci=& get_instance();
  $ci->load->database();
  return $ci->db->where('status', 1)->get("ac_department")->result();
}

function listPositionActive() 
{
  $ci=& get_instance();
  $ci->load->database();
  return $ci->db->where('status', 1)->get("ac_position")->result();
}

function findFloatAdvanceItemByID($id){
   $ci=& get_instance();
   $ci->load->database();
   return $ci->db->where('float_advance_id', $id)
             ->order_by('id', 'asc')
             ->get("float_advance_items")
             ->result();
}
function findAdvanceClearingItemByID($id){
   $ci=& get_instance();
   $ci->load->database();
   return $ci->db->where('advance_clearing_id', $id)
             ->order_by('id', 'asc')
             ->get("advance_clearing_items")
             ->result();
}
function findPurchaseRequestItemByID($id){
   $ci=& get_instance();
   $ci->load->database();
   return $ci->db->where('purchase_request_id', $id)
             ->order_by('id', 'asc')
             ->get("purchase_request_items")
             ->result();
}
function findPaymentVoucherItemByID($id){
   $ci=& get_instance();
   $ci->load->database();
   return $ci->db->where('payment_voucher_id', $id)
             ->order_by('id', 'asc')
             ->get("payment_voucher_items")
             ->result();
}
function findGoodsReceivedNoteItemByID($id){
   $ci=& get_instance();
   $ci->load->database();
   return $ci->db->where('goods_received_note_id', $id)
             ->order_by('id', 'asc')
             ->get("goods_received_note_items")
             ->result();
}
function findPurchaseOrderItemByID($id){
   $ci=& get_instance();
   $ci->load->database();
   return $ci->db->where('purchase_order_id', $id)
             ->order_by('id', 'asc')
             ->get("purchase_order_items")
             ->result();
}

 ?>