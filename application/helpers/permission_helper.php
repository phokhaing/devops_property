<?php 

function checkedPermission($roleId, $moduleId, $permissionId){
    $ci=& get_instance();
    $ci->load->database();

    $result = $ci->db
                 ->where('role_id', $roleId)
                 ->where('module_id', $moduleId)
                 ->where('permission_id', $permissionId)
                 ->get('modules_permissions')
                 ->row();

    if(!empty($result)){
        return $result->id;
    }else{
        return 0;
    }
}

function getRoleName($roleId){
    $ci=& get_instance();
    $ci->load->database();

    $result = $ci->db
                 ->select('role_name')
                 ->where('role_id', $roleId)
                 ->get('role')
                 ->row();

    if(!empty($result)){
        return ucfirst($result->role_name);
    }else{
        return 0;
    }
}


?>