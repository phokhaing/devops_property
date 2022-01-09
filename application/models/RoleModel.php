<?php 
/**
* @author: khaing.pho1991@gmail.com
*/
class RoleModel extends CI_Model
{	
	// tables
	private $tblModulePermission = "modules_permissions";
	private $tblRoleModule = "roles_modules";
	private $tblModule = "module";
	private $table     = "role";

	// fields
	private $id        = "role_id";
	private $moduleId  = "module_id";
	private $permissionId = 'permission_id';
	private $roleName  = "role_name";
	private $createdBy = "created_by";
	private $createdAt = "created_at";
	private $updatedBy = "updated_by";
	private $updatedAt = "updated_at";
	private $status    = 'status';

	function __construct()
	{
		parent::__construct();
	}

	function create()
	{
		$data = array(
			$this->roleName  => strtoupper($this->input->post('role_name')),
			$this->status    => (int) $this->input->post('status'),
			$this->createdBy => $this->user->info->ID,
			$this->createdAt => date("Y-m-d H:i:s")
		);

		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	function update($id)
	{
		$data = array(
			$this->roleName  => strtoupper($this->input->post('role_name')),
			$this->status    => (int) $this->input->post('status'),
			$this->updatedBy => $this->user->info->ID,
			$this->updatedAt => date("Y-m-d H:i:s")
		);
		$this->db
		     ->where($this->id, $id)
		     ->update($this->table, $data);
			 return $this->db->affected_rows();
	}

	function getAll(){
		return $this->db
					->order_by($this->id, 'desc')
					->get($this->table)
					->result_array();
	}

	function getAllModuelsExceptExisting($roleId){
		// GET EXISTING MODULE ID FROM TBL ROLES_MODULES
		$existModule =  $this->db
							 ->select('module_id')
		     				 ->where($this->id, $roleId)
		     				 ->get($this->tblRoleModule)
		     				 ->result_array();
		// CONVERT MODULE ID TO BE ARRAY INDEX
		$moduleids = array();
		if(!empty($existModule)){
			foreach ($existModule as $key => $value) {
				$moduleids[] = $value['module_id'];
			}
		}
		// GET ALL MODULE NOT IN EXISTING MODULE ID FROM TBL MODULE
		if(!empty($moduleids)){
			return $this->db
		     		->where_not_in($this->moduleId, $moduleids)
		     		->get($this->tblModule)
		     		->result_array();
		}else{
			return $this->db
		     		->get($this->tblModule)
		     		->result_array();
		}
	}

	function findAllByStatus($status){

		if($status == 'active'){
			$status = 1;
		}else{
			$status = 0;
		}

		$result = $this->db->get_where($this->table, array($this->status=>$status));
		return $result->result_array();
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

	function findOne($id){
		$result = $this->db->get_where($this->table, array($this->id => $id));
		return $result->row();
	}

	function changeStatus($id, $status){
		$data = array(
			$this->status => (int) ($status == 1 ? 0 : 1)
		);
		$this->db
		     ->where($this->id, $id)
		     ->update($this->table, $data);
			 return $this->db->affected_rows();
	}

	function checkExistingModulePermission($roleId, $moduleId){
		$data = $this->db->get_where($this->tblRoleModule, array($this->id=>$roleId, $this->moduleId=>$moduleId));
		return $data->row();

	}

	function createModule()
	{
		$moduleIds = $this->input->post('module_id');
		$data = array();
		foreach ($moduleIds as $key => $moduleid) 
		{
			$data[] = array(
				$this->id  		=> (int) $this->input->post('role_id'),
				$this->moduleId => (int) $moduleid
			);
		}
		$this->db->insert_batch($this->tblRoleModule, $data);
		return $this->db->insert_id();
	}

	function getAllRoleModule($roleId){
		return $this->db
		     ->select('id,'.$this->tblModule.'.module_id'.',module_name')
		     ->from($this->table)
		     ->join($this->tblRoleModule, $this->table.'.'.$this->id.'='.$this->tblRoleModule.'.'.$this->id, 'INNER')
		     ->join($this->tblModule, $this->tblRoleModule.'.'.$this->moduleId.'='.$this->tblModule.'.'.$this->moduleId, 'INNER')
		     ->where($this->tblRoleModule.'.'.$this->id, $roleId)
		     ->order_by($this->tblModule.'.'.$this->moduleId, 'desc')
		     ->get()
		     ->result_array();
	}

	function checkPermission($modulePermissionId, $moduleId, $permissionId, $roleId){
		$data = array(
					$this->id => (int) $roleId,
					$this->moduleId => (int) $moduleId,
					$this->permissionId => $permissionId
				);

		if($modulePermissionId == 0){
			$this->db
				 ->insert($this->tblModulePermission, $data);
				 return $this->db->insert_id();
		}else{ 
			$this->db
		 		 ->where('id', $modulePermissionId)
		 		 ->delete($this->tblModulePermission);
		 		 return $this->db->affected_rows();
		}
	}

	function deleteModulePermission($id, $moduleId, $roleId){
		$this->db
		 	 ->where('id', $id)
		 	 ->delete($this->tblRoleModule);
		$this->db
		 	 ->where($this->id, $roleId)
		 	 ->where($this->moduleId, $moduleId)
		 	 ->delete($this->tblModulePermission);
		return true;
	}
}

?>