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
              ->get('users')
              ->result();
    return $output;
}


 ?>