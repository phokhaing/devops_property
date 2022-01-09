<?php 
/**
* 
*/
class PurposeType extends CI_Controller
{	

	private $data = array();
	private $page = "loan/purposeType/";
	private $link = "loan/purposeType";
	private $title = "loan/purposeType";	
	private $moduleName = "loan/purposeType";	
	
	function __construct()
	{
		parent::__construct();
		if (!$this->user->loggedin){
            redirect('login');
		}
		$this->load->model('loan/PurposeTypeModel','purposeTypeModel');
		$this->load->helper('loan');
		$this->data['title'] = $this->title;
		$this->data['link'] = $this->link;
		$this->data['status'] = $this->purposeTypeModel->count();
		$this->data['moduleName'] = $this->moduleName;
		$this->authorization->hasAccess($this->moduleName);
	}

	public function index(){
		if($this->authorization->hasPermission($this->moduleName, "list")){
			$this->data['data'] = $this->purposeTypeModel->findAll();
			$this->template->loadContent($this->page."list", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form create purposeType
      *----------------------------------------------------------------
      */
	public function add(){
		if($this->authorization->hasPermission($this->moduleName, "create")){
			$this->data['category'] = $this->purposeTypeModel->findCategoryActive();
			$this->template->loadContent($this->page."add", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit create purposeType
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
			$this->form_validation->set_rules('purposetype_code', 'Purpose Type Code', 'trim|required|is_unique[loan_purpose_type.purposetype_code]');
			$this->form_validation->set_rules('name_en', 'Name (EN)', 'trim|required|is_unique[loan_purpose_type.name_en]');
			$this->form_validation->set_rules('name_kh', 'Name (KH)', 'trim|required|is_unique[loan_purpose_type.name_kh]');
			$this->form_validation->set_rules('category_id', 'Category Code', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if($this->form_validation->run() == false){
				$this->data['category'] = $this->purposeTypeModel->findCategoryActive();
				$this->template->loadContent($this->page."add", $this->data);
			}else{

				/** 
		          *-------------------------------
		          * VALIDATION SUCCESS
		          * INSERT purposeType
		          *-------------------------------
		          */
				$output = $this->purposeTypeModel->create();
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
      * @param: method for open form edit purposeType
      *----------------------------------------------------------------
      */
	public function edit(){
		if($this->authorization->hasPermission($this->moduleName, "update")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
	            	$this->data['category'] = $this->purposeTypeModel->findCategoryActive();
					$this->data['data'] = $this->purposeTypeModel->findOne($_GET['id']);
					$this->template->loadContent($this->page."edit", $this->data);
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit update purposeType
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
			        $this->form_validation->set_rules('purposetype_code', 'Purpose Type Code', 'trim|required|callback_isValidCode');
					$this->form_validation->set_rules('name_en', 'Name (EN)', 'trim|required|callback_isValidNameEN');
					$this->form_validation->set_rules('name_kh', 'Name (KH)', 'trim|required|callback_isValidNameKH');
					$this->form_validation->set_rules('category_id', 'Category Code', 'required');
					$this->form_validation->set_rules('status', 'Status', 'required');

					if($this->form_validation->run() == false){
						$this->data['category'] = $this->purposeTypeModel->findCategoryActive();
						$this->data['data'] = $this->purposeTypeModel->findOne($_GET['id']);
						$this->template->loadContent($this->page."edit", $this->data);
					}else{

						/** 
				          *-------------------------------
				          * VALIDATION SUCCESS
				          * UPDATE purposeType BY ID
				          *-------------------------------
				          */
						$output = $this->purposeTypeModel->update($_GET['id']);
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
	function isValidCode($code){
        $isValid = $this->purposeTypeModel->checkValidCode($_GET['id'], $code);
        if(empty($isValid)){
            $response = true;
        }else{
        	$this->form_validation->set_rules('purposetype_code', 'Purpose Type Code', 'trim|required|is_unique[loan_purpose_type.purposetype_code]');
            $this->form_validation->set_message('isValidCode','Code must contain a unique value.');
            $response = false;
        }
        return $response;
    }

    function isValidNameEN($nameEN){
        $isValid = $this->purposeTypeModel->checkValidNameEN($_GET['id'], $nameEN);
        if(empty($isValid)){
            $response = true;
        }else{
        	$this->form_validation->set_rules('name_en', 'Name (EN)', 'trim|required|is_unique[loan_purpose_type.name_en]');
            $this->form_validation->set_message('isValidNameEN','Name (EN) field must contain a unique value.');
            $response = false;
        }
        return $response;
    }

    function isValidNameKH($nameKH){
        $isValid = $this->purposeTypeModel->checkValidNameKH($_GET['id'], $nameKH);
        if(empty($isValid)){
            $response = true;
        }else{
        	$this->form_validation->set_rules('name_kh', 'Name (KH)', 'trim|required|is_unique[loan_purpose_type.name_kh]');
            $this->form_validation->set_message('isValidNameKH','Name (KH) field must contain a unique value.');
            $response = false;
        }
        return $response;
    }

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit delete purposeType
      *----------------------------------------------------------------
      */
	public function delete()
	{
		if($this->authorization->hasPermission($this->moduleName, "delete")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !="")
	            {
					$output = $this->purposeTypeModel->deleteById($_GET['id']);
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
      * @param: method for view purposeType
      *----------------------------------------------------------------
      */
	public function view(){
		if($this->authorization->hasPermission($this->moduleName, "view")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
	            	$this->data['category'] = $this->purposeTypeModel->findCategoryActive();
					$this->data['data'] = $this->purposeTypeModel->findOne($_GET['id']);
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
            $this->data['data'] = $this->purposeTypeModel->findAllFilter($filter);
        }else{
            $this->data['data'] = $this->purposeTypeModel->findAll();
        }
        $this->load->view($this->page.'filter', $this->data);
      }
    }
}

 ?>