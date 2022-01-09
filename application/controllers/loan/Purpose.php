<?php 
/**
* 
*/
class Purpose extends CI_Controller
{	

	private $data = array();
	private $page = "loan/purpose/";
	private $link = "loan/purpose";
	private $title = "loan/purpose";	
	private $moduleName = "loan/purpose";	
	
	function __construct()
	{
		parent::__construct();
		if (!$this->user->loggedin){
            redirect('login');
		}
		$this->load->model('loan/PurposeModel','purposeModel');
		$this->load->helper('loan');
		$this->data['title'] = $this->title;
		$this->data['link'] = $this->link;
		$this->data['status'] = $this->purposeModel->count();
		$this->data['moduleName'] = $this->moduleName;
		$this->authorization->hasAccess($this->moduleName);
	}

	public function index(){
		if($this->authorization->hasPermission($this->moduleName, "list")){
			$this->data['data'] = $this->purposeModel->findAll();
			$this->template->loadContent($this->page."list", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form create purpose
      *----------------------------------------------------------------
      */
	public function add(){
		if($this->authorization->hasPermission($this->moduleName, "create")){
			$this->data['purposeType'] = $this->purposeModel->findPurposeTypeActive();
			$this->template->loadContent($this->page."add", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit create purpose
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
			$this->form_validation->set_rules('purpose_code', 'Purpose Code', 'trim|required|is_unique[loan_purpose.purpose_code]');
			$this->form_validation->set_rules('name_en', 'Name (EN)', 'trim|required|is_unique[loan_purpose.name_en]');
			$this->form_validation->set_rules('name_kh', 'Name (KH)', 'trim|required|is_unique[loan_purpose.name_kh]');
			$this->form_validation->set_rules('purposetype_id', 'Purpose Type Code', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if($this->form_validation->run() == false){
				$this->data['purposeType'] = $this->purposeModel->findPurposeTypeActive();
				$this->template->loadContent($this->page."add", $this->data);
			}else{

				/** 
		          *-------------------------------
		          * VALIDATION SUCCESS
		          * INSERT purpose
		          *-------------------------------
		          */
				$output = $this->purposeModel->create();
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
      * @param: method for open form edit purpose
      *----------------------------------------------------------------
      */
	public function edit(){
		if($this->authorization->hasPermission($this->moduleName, "update")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
	            	$this->data['purposeType'] = $this->purposeModel->findPurposeTypeActive();
					$this->data['data'] = $this->purposeModel->findOne($_GET['id']);
					$this->template->loadContent($this->page."edit", $this->data);
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit update purpose
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
			        $this->form_validation->set_rules('purpose_code', 'Purpose Type Code', 'trim|required|callback_isValidCode');
					$this->form_validation->set_rules('name_en', 'Name (EN)', 'trim|required|callback_isValidNameEN');
					$this->form_validation->set_rules('name_kh', 'Name (KH)', 'trim|required|callback_isValidNameKH');
					$this->form_validation->set_rules('purposetype_id', 'Purpose Type Code', 'required');
					$this->form_validation->set_rules('status', 'Status', 'required');

					if($this->form_validation->run() == false){
						$this->data['purposeType'] = $this->purposeModel->findPurposeTypeActive();
						$this->data['data'] = $this->purposeModel->findOne($_GET['id']);
						$this->template->loadContent($this->page."edit", $this->data);
					}else{

						/** 
				          *-------------------------------
				          * VALIDATION SUCCESS
				          * UPDATE purpose BY ID
				          *-------------------------------
				          */
						$output = $this->purposeModel->update($_GET['id']);
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
        $isValid = $this->purposeModel->checkValidCode($_GET['id'], $code);
        if(empty($isValid)){
            $response = true;
        }else{
        	$this->form_validation->set_rules('purpose_code', 'Purpose Type Code', 'trim|required|is_unique[loan_purpose.purpose_code]');
            $this->form_validation->set_message('isValidCode','Code must contain a unique value.');
            $response = false;
        }
        return $response;
    }

    function isValidNameEN($nameEN){
        $isValid = $this->purposeModel->checkValidNameEN($_GET['id'], $nameEN);
        if(empty($isValid)){
            $response = true;
        }else{
        	$this->form_validation->set_rules('name_en', 'Name (EN)', 'trim|required|is_unique[loan_purpose.name_en]');
            $this->form_validation->set_message('isValidNameEN','Name (EN) field must contain a unique value.');
            $response = false;
        }
        return $response;
    }

    function isValidNameKH($nameKH){
        $isValid = $this->purposeModel->checkValidNameKH($_GET['id'], $nameKH);
        if(empty($isValid)){
            $response = true;
        }else{
        	$this->form_validation->set_rules('name_kh', 'Name (KH)', 'trim|required|is_unique[loan_purpose.name_kh]');
            $this->form_validation->set_message('isValidNameKH','Name (KH) field must contain a unique value.');
            $response = false;
        }
        return $response;
    }

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit delete purpose
      *----------------------------------------------------------------
      */
	public function delete()
	{
		if($this->authorization->hasPermission($this->moduleName, "delete")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !="")
	            {
					$output = $this->purposeModel->deleteById($_GET['id']);
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
      * @param: method for view purpose
      *----------------------------------------------------------------
      */
	public function view(){
		if($this->authorization->hasPermission($this->moduleName, "view")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
	            	$this->data['purposeType'] = $this->purposeModel->findpurposeTypeActive();
					$this->data['data'] = $this->purposeModel->findOne($_GET['id']);
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
            $this->data['data'] = $this->purposeModel->findAllFilter($filter);
        }else{
            $this->data['data'] = $this->purposeModel->findAll();
        }
        $this->load->view($this->page.'filter', $this->data);
      }
    }
}

 ?>