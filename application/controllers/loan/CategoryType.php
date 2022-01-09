<?php 
/**
* 
*/
class CategoryType extends CI_Controller
{	

	private $data = array();
	private $page = "loan/categoryType/";
	private $link = "loan/categoryType";
	private $title = "loan/categoryType";	
	private $moduleName = "loan/categorytype";	
	
	function __construct()
	{
		parent::__construct();
		if (!$this->user->loggedin){
            redirect('login');
		}
		$this->load->model('loan/CategoryTypeModel','categoryTypeModel');
		$this->data['title'] = $this->title;
		$this->data['link'] = $this->link;
		$this->data['status'] = $this->categoryTypeModel->count();
		$this->data['moduleName'] = $this->moduleName;
		$this->authorization->hasAccess($this->moduleName);
	}

	public function index(){
		if($this->authorization->hasPermission($this->moduleName, "list")){
			$this->data['data'] = $this->categoryTypeModel->findAll();
			$this->template->loadContent($this->page."list", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form create categoryType
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
      * @param: method for submit create categoryType
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
			$this->form_validation->set_rules('categorytype_code', 'Category Type Code', 'trim|required|is_unique[loan_category_type.categorytype_code]');
			$this->form_validation->set_rules('description', 'Description', 'trim|required|is_unique[loan_category_type.description]');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if($this->form_validation->run() == false){
				$this->template->loadContent($this->page."add", $this->data);
			}else{

				/** 
		          *-------------------------------
		          * VALIDATION SUCCESS
		          * INSERT categoryType
		          *-------------------------------
		          */
				$output = $this->categoryTypeModel->create();
				if($output){
					$this->session->set_flashdata("success", "Congratulation, Record has been saved successfully!");
				}else{
					$this->session->set_flashdata("error", "Faile, something went wrong!");
	            	$this->template->loadContent($this->page."add", $this->data);
				}
	            redirect(site_url($this->link));
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form edit categoryType
      *----------------------------------------------------------------
      */
	public function edit(){
		if($this->authorization->hasPermission($this->moduleName, "update")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
					$this->data['data'] = $this->categoryTypeModel->findOne($_GET['id']);
					$this->template->loadContent($this->page."edit", $this->data);
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit update categoryType
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
					$this->form_validation->set_rules('categorytype_code', 'Category Type Code', 'trim|required|callback_isValidAccountCode');
					$this->form_validation->set_rules('description', 'Description', 'trim|required|callback_isValidDescription');
					$this->form_validation->set_rules('status', 'Status', 'required');

					if($this->form_validation->run() == false){
						$this->data['data'] = $this->categoryTypeModel->findOne($_GET['id']);
						$this->template->loadContent($this->page."edit", $this->data);
					}else{

						/** 
				          *-------------------------------
				          * VALIDATION SUCCESS
				          * UPDATE categoryType BY ID
				          *-------------------------------
				          */
						$output = $this->categoryTypeModel->update($_GET['id']);
						if($output){
							$this->session->set_flashdata("success", "Congratulation, Record has been updated successfully!");
						}else{
							$this->session->set_flashdata("error", "Faile, something went wrong!");
			            	$this->template->loadContent($this->page."edit", $this->data);
						}
			            redirect(site_url($this->link));
					}
				}
			}
		}
	}

	function isValidAccountCode($accountCode){
        $isValid = $this->categoryTypeModel->checkValidCategorytypeCode($_GET['id'], $accountCode);
        if(empty($isValid)){
            $response = true;
        }else{
        	$this->form_validation->set_rules('categorytype_code', 'Category Type Code', 'trim|required|is_unique[loan_category_type.categorytype_code]');
            $this->form_validation->set_message('isValidAccountCode','The Category Type Code field must contain a unique value.');
            $response = false;
        }
        return $response;
    }

    function isValidDescription($description){
        $isValid = $this->categoryTypeModel->checkValidDescription($_GET['id'], $description);
        if(empty($isValid)){
            $response = true;
        }else{
        	$this->form_validation->set_rules('description', 'Description', 'trim|required|is_unique[loan_category_type.description]');
            $this->form_validation->set_message('isValidDescription','Description field must contain a unique value.');
            $response = false;
        }
        return $response;
    }

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit delete categoryType
      *----------------------------------------------------------------
      */
	public function delete()
	{
		if($this->authorization->hasPermission($this->moduleName, "delete")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !="")
	            {
					$output = $this->categoryTypeModel->deleteById($_GET['id']);
					if($output){
						$this->session->set_flashdata("success", "Congratulation, Record has been deleted successfully!");
					}else{
						$this->session->set_flashdata("error", "Faile, something went wrong!");
					}
					redirect(site_url($this->link));
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for view categoryType
      *----------------------------------------------------------------
      */
	public function view(){
		if($this->authorization->hasPermission($this->moduleName, "view")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
					$this->data['data'] = $this->categoryTypeModel->findOne($_GET['id']);
					$this->template->loadContent($this->page."view", $this->data);
				}
			}
		}
	}

	/** 
      *------------------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 12/March/2020
      * @param: method for filter status
      *------------------------------------------------------------------------
      */
    public function findFilter($filter = null){
      $this->authorization->hasAccess($this->moduleName);
      if($this->authorization->hasPermission($this->moduleName, "search")){
        if($filter != null){
            $this->data['data'] = $this->categoryTypeModel->findAllFilter($filter);
        }else{
            $this->data['data'] = $this->categoryTypeModel->findAll();
        }
        $this->load->view($this->page.'filter', $this->data);
      }
    }
}

 ?>