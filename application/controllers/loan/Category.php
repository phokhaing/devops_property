<?php 
/**
* 
*/
class Category extends CI_Controller
{	

	private $data = array();
	private $page = "loan/category/";
	private $link = "loan/category";
	private $title = "loan/category";	
	private $moduleName = "loan/category";	
	
	function __construct()
	{
		parent::__construct();
		if (!$this->user->loggedin){
            redirect('login');
		}
		$this->load->model('loan/CategoryModel','categoryModel');
		$this->load->helper('loan');
		$this->data['title'] = $this->title;
		$this->data['link'] = $this->link;
		$this->data['status'] = $this->categoryModel->count();
		$this->data['moduleName'] = $this->moduleName;
		$this->authorization->hasAccess($this->moduleName);
	}

	public function index(){
		if($this->authorization->hasPermission($this->moduleName, "list")){
			$this->data['categoryTypes'] = $this->categoryModel->findCategoryTypeActive();
			$this->data['data'] = $this->categoryModel->findAll();
			$this->template->loadContent($this->page."list", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form create category
      *----------------------------------------------------------------
      */
	public function add(){
		if($this->authorization->hasPermission($this->moduleName, "create")){
			$this->data['categoryTypes'] = $this->categoryModel->findCategoryTypeActive();
			$this->data['currency'] = $this->categoryModel->findCurrencyActive();
			$this->template->loadContent($this->page."add", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit create category
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
			$this->form_validation->set_rules('category_code', 'Category Code', 'trim|required|is_unique[loan_category.category_code]');
			$this->form_validation->set_rules('description', 'Description', 'trim|required|is_unique[loan_category.description]');
			$this->form_validation->set_rules('categorytype_id', 'Category Type Code', 'required');
			$this->form_validation->set_rules('currency', 'Currency', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if($this->form_validation->run() == false){
				$this->template->loadContent($this->page."add", $this->data);
			}else{

				/** 
		          *-------------------------------
		          * VALIDATION SUCCESS
		          * INSERT category
		          *-------------------------------
		          */
				$output = $this->categoryModel->create();
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
      * @param: method for open form edit category
      *----------------------------------------------------------------
      */
	public function edit(){
		if($this->authorization->hasPermission($this->moduleName, "update")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
	            	$this->data['categoryTypes'] = $this->categoryModel->findCategoryTypeActive();
					$this->data['currency'] = $this->categoryModel->findCurrencyActive();
					$this->data['data'] = $this->categoryModel->findOne($_GET['id']);
					$this->template->loadContent($this->page."edit", $this->data);
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit update category
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
			        $this->form_validation->set_rules('category_code', 'Category Code', 'trim|required|callback_isValidCategoryCode');
					$this->form_validation->set_rules('description', 'Description', 'trim|required|callback_isValidDescription');
					$this->form_validation->set_rules('categorytype_id', 'Category Type Code', 'required');
					$this->form_validation->set_rules('currency', 'Currency', 'required');
					$this->form_validation->set_rules('status', 'Status', 'required');

					if($this->form_validation->run() == false){
						$this->data['categoryTypes'] = $this->categoryModel->findCategoryTypeActive();
						$this->data['currency'] = $this->categoryModel->findCurrencyActive();
						$this->data['data'] = $this->categoryModel->findOne($_GET['id']);
						$this->template->loadContent($this->page."edit", $this->data);
					}else{

						/** 
				          *-------------------------------
				          * VALIDATION SUCCESS
				          * UPDATE category BY ID
				          *-------------------------------
				          */
						$output = $this->categoryModel->update($_GET['id']);
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

	/** 
      *-------------------------------
      * CHECK VALIDATION
      *-------------------------------
      */
	function isValidCategoryCode($code){
        $isValid = $this->categoryModel->checkValidCode($_GET['id'], $code);
        if(empty($isValid)){
            $response = true;
        }else{
        	$this->form_validation->set_rules('category_code', 'Category Code', 'trim|required|is_unique[loan_category.category_code]');
            $this->form_validation->set_message('isValidCategoryCode','The Category Code field must contain a unique value.');
            $response = false;
        }
        return $response;
    }

    function isValidDescription($description){
        $isValid = $this->categoryModel->checkValidDescription($_GET['id'], $description);
        if(empty($isValid)){
            $response = true;
        }else{
        	$this->form_validation->set_rules('description', 'Description', 'trim|required|is_unique[loan_category.description]');
            $this->form_validation->set_message('isValidDescription','Description field must contain a unique value.');
            $response = false;
        }
        return $response;
    }

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit delete category
      *----------------------------------------------------------------
      */
	public function delete()
	{
		if($this->authorization->hasPermission($this->moduleName, "delete")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !="")
	            {
					$output = $this->categoryModel->deleteById($_GET['id']);
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
      * @param: method for view category
      *----------------------------------------------------------------
      */
	public function view(){
		if($this->authorization->hasPermission($this->moduleName, "view")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
	            	$this->data['categoryTypes'] = $this->categoryModel->findCategoryTypeActive();
					$this->data['currency'] = $this->categoryModel->findCurrencyActive();
					$this->data['data'] = $this->categoryModel->findOne($_GET['id']);
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
            $this->data['data'] = $this->categoryModel->findAllFilter($filter);
        }else{
            $this->data['data'] = $this->categoryModel->findAll();
        }
        $this->load->view($this->page.'filter', $this->data);
      }
    }
}

 ?>