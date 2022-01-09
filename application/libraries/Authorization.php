<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once("User.php");
require_once("Template.php");
class Authorization {

    var $ci = null;
    var $userId = null;
    var $roles = null;
    var $modules =null;

    public function __construct() {
        $ci = & get_instance();
        if(isset($ci->user->info->ID)){
            $this->userId = $ci->user->info->ID;

            if(!empty($this->userId)){
                $this->roles = $ci->db->select('role_id')
                       ->where("user_id", $this->userId)
                       ->get("users_roles")->result();
            }
        }
    }

    public function hasRole($roleId, $moduleId){
       $ci = & get_instance();
       $CI->db->select($select)
            ->where("users.email", $this->u)->where("users.token", $this->p)
            ->join("user_roles", "user_roles.ID = users.user_role", "left outer")
            ->get("users");
    }

    public function hasModule($moduleId){
        $ci = & get_instance();
        if(!empty($this->roles)){
            foreach ($this->roles as $key => $role){
                $this->modules = $ci->db->select('m.module_name, rm.role_id, rm.module_id')
                           ->from('module m')
                           ->join('roles_modules rm','m.module_id = rm.module_id','inner')
                           ->where("rm.role_id", $role->role_id)
                           ->where("rm.module_id", $moduleId)
                           ->get()->result();
                if(!empty($this->modules)){
                    return true;
                    break;
                }
            }
        }

        return false;
    }

    public function hasAccess($moduleName){
        $ci = & get_instance();
        if(!empty($this->roles)){
            foreach ($this->roles as $key => $role){
                $output = $ci->db->select('m.module_name, rm.role_id, rm.module_id')
                           ->from('module m')
                           ->join('roles_modules rm','m.module_id = rm.module_id','inner')
                           ->where("rm.role_id", $role->role_id)
                           ->where("m.module_name", $moduleName)
                           ->get()->result();
                if(!empty($output)){
                    return true;
                    break;
                }
            }
        }
        redirect(base_url('Access_denied?module='.$moduleName));
        return false;
    }

    public function hasPermission($moduleName, $permissionName)
    {
        $ci = & get_instance();
        if(!empty($this->roles)){
            foreach ($this->roles as $key => $role)
            {
                $result=$ci->db->select('m.module_name, p.permission_name, mp.role_id, mp.module_id, mp.permission_id')
                               ->from('module m')
                               ->join('modules_permissions mp','m.module_id=mp.module_id','inner')
                               ->join('permission p','mp.permission_id=p.permission_id')
                               ->where('mp.role_id', $role->role_id)
                               ->where('m.module_name', $moduleName)
                               ->where('p.permission_name', $permissionName)
                               ->get()->result();
                if(!empty($result)){
                    return true;
                    break;
                }
            }
        }
        // $ci->template->loadContent("error/no_permission");
        return false;
    }

}

?>
