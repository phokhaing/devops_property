<?php 
/** 
  *----------------------------------------------------------------
  * @author: khaing.pho1991@gmail.com
  * @param: 23/March/2020
  * @param: role controller
  *----------------------------------------------------------------
  */
class Role extends CI_Controller
{	

	private $data = array();
	private $page = "roles/";
	private $title = "role";
	private $currentURl = null;	
	private $moduleName = null;	

	
	function __construct()
	{
		parent::__construct();
		if (!$this->user->loggedin){
            redirect('login');
		}
		$this->load->model('RoleModel','roleModel');
		$this->load->model('ModuleModel','moduleModel');
		$this->load->model('PermissionModel','permissionModel');
		$this->load->helper('permission');
		$this->data['title'] = $this->title;
		$this->data['status'] = $this->roleModel->count();
		$this->currentURl = site_url('role');
		$this->data['moduleName'] = strtolower(get_class());
		$this->moduleName = strtolower(get_class());
		$this->authorization->hasAccess($this->moduleName);
	}

	public function index(){
		if($this->authorization->hasPermission($this->moduleName, "list")){
			$this->data['data'] = $this->roleModel->getAll();
			$this->template->loadContent($this->page."list", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form create role
      *----------------------------------------------------------------
      */
	public function add(){
		if($this->authorization->hasPermission($this->moduleName, "create")){
			$this->template->loadContent($this->page."add", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit create role
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
			$this->form_validation->set_rules('role_name', 'Role Name', 'trim|required|min_length[2]|max_length[20]|is_unique[role.role_name]');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if($this->form_validation->run() == false){
				$this->template->loadContent($this->page."add", $this->data);
			}else{

				/** 
		          *-------------------------------
		          * VALIDATION SUCCESS
		          * INSERT role
		          *-------------------------------
		          */
				$output = $this->roleModel->create();
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

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form edit role
      *----------------------------------------------------------------
      */
	public function edit(){
		if($this->authorization->hasPermission($this->moduleName, "update")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
					$this->data['data'] = $this->roleModel->findOne($_GET['id']);
					$this->template->loadContent($this->page."edit", $this->data);
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit update role
      *----------------------------------------------------------------
      */
	public function update()
	{	
		if($this->authorization->hasPermission($this->moduleName, "update")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !="")
	            {
					/** 
			          *-------------------------------
			          * VALIDATION FORM
			          *-------------------------------
			          */
					$this->form_validation->set_rules('role_name', 'Role Name', 'trim|required|min_length[2]|max_length[20]');
					$this->form_validation->set_rules('status', 'Status', 'required');

					if($this->form_validation->run() == false){
						$this->template->loadContent($this->page."edit", $this->data);
					}else{

						/** 
				          *-------------------------------
				          * VALIDATION SUCCESS
				          * UPDATE role BY ID
				          *-------------------------------
				          */
						$output = $this->roleModel->update($_GET['id']);
						if($output){
							$this->session->set_flashdata("success", "Congratulation, Record has been updated successfully!");
						}else{
							$this->session->set_flashdata("error", "Faile, something went wrong!");
			            	$this->template->loadContent($this->page."edit", $this->data);
						}
			            redirect($this->currentURl);
					}
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit delete role
      *----------------------------------------------------------------
      */
	public function delete()
	{
		if($this->authorization->hasPermission($this->moduleName, "delete")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !="")
	            {
					$output = $this->roleModel->deleteById($_GET['id']);
					if($output){
						$this->session->set_flashdata("success", "Congratulation, Record has been deleted successfully!");
					}else{
						$this->session->set_flashdata("error", "Faile, something went wrong!");
					}
					redirect($this->currentURl);
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for view role
      *----------------------------------------------------------------
      */
	public function view(){
		if($this->authorization->hasPermission($this->moduleName, "view")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
					$this->data['data'] = $this->roleModel->findOne($_GET['id']);
					$this->template->loadContent($this->page."view", $this->data);
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for set permission for role
      *----------------------------------------------------------------
      */
	public function setPermission(){
		if($this->authorization->hasPermission($this->moduleName, "view")){
			$this->data['roleId'] = $_GET['role'];
			$this->data['data'] = $this->roleModel->getAllRoleModule($_GET['role']);
			$this->data['modules'] = $this->moduleModel->getAll();
			$this->data['permissions'] = $this->permissionModel->getAll();
			$this->template->loadContent($this->page."permission", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for set permission for role
      *----------------------------------------------------------------
      */
	public function setModule(){
		if($this->authorization->hasPermission($this->moduleName, "view")){
			$this->data['roleId'] = $_GET['role'];
			$this->data['modules'] = $this->roleModel->getAllModuelsExceptExisting($_GET['role']);
			$this->template->loadContent($this->page."permission-add", $this->data);
		}
	}

	public function createModule()
	{	
		if($this->authorization->hasPermission($this->moduleName, "create")){
			$roleId = $this->input->post('role_id');
			$this->form_validation->set_rules('module_id[]', 'Module Name', 'required|trim');
			if($this->form_validation->run() == false)
			{
				$this->data['roleId'] = $roleId;
				$this->data['modules'] = $this->roleModel->getAllModuelsExceptExisting($roleId);
				$this->template->loadContent($this->page."permission-add", $this->data);
			}else{
				$output = $this->roleModel->createModule();
				if($output){
					$this->session->set_flashdata("success", "Congratulation, Record has been created successfully!");
					redirect(site_url('role/setPermission?role='.$roleId));
				}else{
					$this->session->set_flashdata("error", "Faile, something went wrong!");
	            	$this->data['roleId'] = $roleId;
					$this->data['modules'] = $this->roleModel->getAllModuelsExceptExisting($roleId);
					$this->template->loadContent($this->page."permission-add", $this->data);
				}
			}
		}
	}

	public function deleteRoleModule(){
		if($this->authorization->hasPermission($this->moduleName, "delete")){
			if(isset($_GET['id']) && isset($_GET['module_id']) && isset($_GET['role_id'])){
				if($_GET['id'] != '' || $_GET['id'] != null || $_GET['module_id'] != '' || $_GET['module_id'] != null || $_GET['role_id'] != '' || $_GET['role_id'] != null){
					$output = $this->roleModel->deleteModulePermission($_GET['id'], $_GET['module_id'], $_GET['role_id']);
					if($output){
						redirect(site_url('role/setPermission?role='.$_GET['role_id']));
					}
				}
			}
		}
	}

	/*function checkExistingModulePermission($moduleId){
        $roleId = $this->input->post('role_id');
        $output = $this->roleModel->checkExistingModulePermission($roleId, $moduleId);
        if($output == null){
        	return true;
        }else{
        	$this->form_validation->set_message('checkExistingModulePermission', 'This record already exists.');
            return false;
        }
    }*/

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for check permission for role
      *----------------------------------------------------------------
      */
	function checkPermission(){
		if($this->authorization->hasPermission($this->moduleName, "view")){
			if(isset($_GET['roleId'])){
				if($_GET['roleId'] != '' || $_GET['roleId'] != null){
					if(isset($_GET['modulePermissionId']) && isset($_GET['moduleId']) && isset($_GET['permissionId'])){
			    		$output = $this->roleModel->checkPermission($_GET['modulePermissionId'], $_GET['moduleId'], $_GET['permissionId'],$_GET['roleId']);
			    		echo json_encode($output);
					}
				}
			}
		}
    }

    function ischeckedPermission($roleId, $moduleId, $permissionId){
    	if($this->authorization->hasPermission($this->moduleName, "view")){
		    $this->load->database();
		    $result = $this->db
		                 ->where('role_id', $roleId)
		                 ->where('module_id', $moduleId)
		                 ->where('permission_id', $permissionId)
		                 ->get('modules_permissions')
		                 ->row();

		    if(!empty($result)){
		        echo $result->id;
		    }else{
		        echo 0;
		    }
		}
	}

}

 ?>