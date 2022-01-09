<?php 
/**
* 
*/
class Branch extends CI_Controller
{	

	private $data = array();
	private $page = "branch/";
	private $title = "branch";	
	private $moduleName = null;	
	
	function __construct()
	{
		parent::__construct();
		if (!$this->user->loggedin){
            redirect('login');
		}
		$this->load->model('BranchModel','branchModel');
		$this->data['title'] = $this->title;
		$this->data['status'] = $this->branchModel->count();
		$this->data['moduleName'] = strtolower(get_class());
		$this->moduleName = strtolower(get_class());
		$this->authorization->hasAccess($this->moduleName);

	}

	public function index(){
		if($this->authorization->hasPermission($this->moduleName, "list")){
			$this->data['data'] = $this->branchModel->getAll();
			$this->template->loadContent($this->page."list", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form create branch
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
      * @param: method for submit create branch
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
			$this->form_validation->set_rules('branch_code', 'Branch Code', 'trim|required|is_unique[branch.branch_code]');
			$this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required|is_unique[branch.branch_name]');
			$this->form_validation->set_rules('branch_name_kh', 'Branch Name (KH)', 'trim|required|is_unique[branch.branch_name_kh]');
			$this->form_validation->set_rules('manager_name', 'Manager Name', 'trim');
			$this->form_validation->set_rules('email', 'email', 'trim|valid_email');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if($this->form_validation->run() == false){
				$this->template->loadContent($this->page."add", $this->data);
			}else{

				/** 
		          *-------------------------------
		          * VALIDATION SUCCESS
		          * INSERT BRANCH
		          *-------------------------------
		          */
				$output = $this->branchModel->create();
				if($output){
					$this->session->set_flashdata("success", "Congratulation, Record has been saved successfully!");
				}else{
					$this->session->set_flashdata("error", "Faile, something went wrong!");
	            	$this->template->loadContent($this->page."add", $this->data);
				}
	            redirect(site_url("branch"));
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form edit branch
      *----------------------------------------------------------------
      */
	public function edit(){
		if($this->authorization->hasPermission($this->moduleName, "update")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
					$this->data['data'] = $this->branchModel->findOne($_GET['id']);
					$this->template->loadContent($this->page."edit", $this->data);
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit update branch
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
					$this->form_validation->set_rules('branch_code', 'Branch Code', 'trim|required|callback_isValidBanchCode');
					$this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required|callback_isValidBanchName');
					$this->form_validation->set_rules('branch_name_kh', 'Branch Name (KH)', 'trim|required|callback_isValidBanchNameKH');
					$this->form_validation->set_rules('manager_name', 'Manager Name', 'trim');
					$this->form_validation->set_rules('email', 'email', 'trim|valid_email');
					$this->form_validation->set_rules('status', 'Status', 'required');

					if($this->form_validation->run() == false){
						$this->data['data'] = $this->branchModel->findOne($_GET['id']);
						$this->template->loadContent($this->page."edit", $this->data);
					}else{

						/** 
				          *-------------------------------
				          * VALIDATION SUCCESS
				          * UPDATE branch BY ID
				          *-------------------------------
				          */
						$output = $this->branchModel->update($_GET['id']);
						if($output){
							$this->session->set_flashdata("success", "Congratulation, Record has been updated successfully!");
						}else{
							$this->session->set_flashdata("error", "Faile, something went wrong!");
			            	$this->template->loadContent($this->page."edit", $this->data);
						}
			            redirect(site_url("branch"));
					}
				}
			}
		}
	}

	function isValidBanchCode($branchCode){
        $getCode = $this->branchModel->checkValidBanchCode($_GET['id'], $branchCode);
        if(empty($getCode)){
            $response = true;
        }else{
        	$this->form_validation->set_rules('branch_code', 'Branch Code', 'trim|required|is_unique[branch.branch_code]');
            $this->form_validation->set_message('isValidBanchCode','The Branch Code field must contain a unique value.');
            $response = false;
        }
        return $response;
    }

    function isValidBanchName($branchName){
        $getCode = $this->branchModel->checkValidBanchName($_GET['id'], $branchName);
        if(empty($getCode)){
            $response = true;
        }else{
        	$this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required|is_unique[branch.branch_name]');
            $this->form_validation->set_message('isValidBanchName','Branch Name field must contain a unique value.');
            $response = false;
        }
        return $response;
    }

    function isValidBanchNameKH($branchNameKH){
        $getCode = $this->branchModel->checkValidBanchNameKH($_GET['id'], $branchNameKH);
        if(empty($getCode)){
            $response = true;
        }else{
			$this->form_validation->set_rules('branch_name_kh', 'Branch Name (KH)', 'trim|required|is_unique[branch.branch_name_kh]');
            $this->form_validation->set_message('isValidBanchNameKH','Branch Name (KH) field must contain a unique value.');
            $response = false;
        }
        return $response;
    }

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit delete branch
      *----------------------------------------------------------------
      */
	public function delete()
	{
		if($this->authorization->hasPermission($this->moduleName, "delete")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !="")
	            {
					$output = $this->branchModel->deleteById($_GET['id']);
					if($output){
						$this->session->set_flashdata("success", "Congratulation, Record has been deleted successfully!");
					}else{
						$this->session->set_flashdata("error", "Faile, something went wrong!");
					}
					redirect(site_url("branch"));
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for view branch
      *----------------------------------------------------------------
      */
	public function view(){
		if($this->authorization->hasPermission($this->moduleName, "view")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
					$this->data['data'] = $this->branchModel->findOne($_GET['id']);
					$this->template->loadContent($this->page."view", $this->data);
				}
			}
		}
	}
}

 ?>