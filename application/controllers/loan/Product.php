<?php 
/**
* 
*/
class Product extends CI_Controller
{	

	private $data = array();
	private $page = "loan/product/";
	private $link = "loan/product";
	private $title = "loan/product";	
	private $moduleName = "loan/product";	
	
	function __construct()
	{
		parent::__construct();
		if (!$this->user->loggedin) redirect('login');
		$this->load->model('loan/ProductModel','productModel');
		$this->load->helper('loan');
		$this->data['title'] = $this->title;
		$this->data['link'] = $this->link;
		$this->data['status'] = $this->productModel->count();
		$this->data['moduleName'] = $this->moduleName;
		$this->authorization->hasAccess($this->moduleName);
	}

	public function index(){
		if($this->authorization->hasPermission($this->moduleName, "list")){
			$this->data['data'] = $this->productModel->findAll();
			$this->template->loadContent($this->page."list", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form create product
      *----------------------------------------------------------------
      */
	public function add(){
		if($this->authorization->hasPermission($this->moduleName, "create")){
			$this->data['ruleDetail'] = $this->productModel->findRuleDetailActive();
			$this->data['interest'] = $this->productModel->findInterestActive();
			$this->data['currency'] = $this->productModel->findCurrencyActive();
			$this->template->loadContent($this->page."add", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit create product
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
			$this->form_validation->set_rules('product_code', 'Product Code', 'trim|required|is_unique[loan_product.product_code]');
			$this->form_validation->set_rules('name_en', 'Name (EN)', 'trim|required|is_unique[loan_product.name_en]');
			$this->form_validation->set_rules('name_kh', 'Name (KH)', 'trim|required|is_unique[loan_product.name_kh]');
			$this->form_validation->set_rules('interest_id', 'Interest Code', 'trim|required');
			$this->form_validation->set_rules('ruledetail_id', 'Loan Detail Code', 'trim|required');
			$this->form_validation->set_rules('currency', 'Currency', 'trim|required');
			$this->form_validation->set_rules('min_age', 'Min Age', 'trim|required');
			$this->form_validation->set_rules('max_age', 'Max Age', 'trim|required');
			$this->form_validation->set_rules('min_reduce_amount', 'Min Reduce Amount', 'trim|required|callback_isValid');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if($this->form_validation->run() == false){
				$this->data['ruleDetail'] = $this->productModel->findRuleDetailActive();
				$this->data['interest'] = $this->productModel->findInterestActive();
				$this->data['currency'] = $this->productModel->findCurrencyActive();
				$this->template->loadContent($this->page."add", $this->data);
			}else{

				/** 
		          *-------------------------------
		          * VALIDATION SUCCESS
		          * INSERT product
		          *-------------------------------
		          */
				$output = $this->productModel->create();
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

	public function isValid($param)
    {
        if (!is_numeric($param) ) {
            $this->form_validation->set_message('isValid', 'The {field} field must be number or decimal.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form edit product
      *----------------------------------------------------------------
      */
	public function edit(){
		if($this->authorization->hasPermission($this->moduleName, "update")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
	            	$this->data['ruleDetail'] = $this->productModel->findRuleDetailActive();
						$this->data['interest'] = $this->productModel->findInterestActive();
					$this->data['currency'] = $this->productModel->findCurrencyActive();
	            	$this->data['data'] = $this->productModel->findOne($_GET['id']);
					$this->template->loadContent($this->page."edit", $this->data);
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit update product
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
			        $this->form_validation->set_rules('product_code', 'Product Code', 'trim|required|callback_isValidCode');
					$this->form_validation->set_rules('name_en', 'Name (EN)', 'trim|required|callback_isValidNameEN');
					$this->form_validation->set_rules('name_kh', 'Name (KH)', 'trim|required|callback_isValidNameEN');
					$this->form_validation->set_rules('interest_id', 'Interest Code', 'trim|required');
					$this->form_validation->set_rules('ruledetail_id', 'Loan Detail Code', 'trim|required');
					$this->form_validation->set_rules('currency', 'Currency', 'trim|required');
					$this->form_validation->set_rules('min_age', 'Min Age', 'trim|required');
					$this->form_validation->set_rules('max_age', 'Max Age', 'trim|required');
					$this->form_validation->set_rules('min_reduce_amount', 'Min Reduce Amount', 'trim|required|callback_isValid');
					$this->form_validation->set_rules('status', 'Status', 'required');

					if($this->form_validation->run() == false){
						$this->data['ruleDetail'] = $this->productModel->findRuleDetailActive();
						$this->data['interest'] = $this->productModel->findInterestActive();
						$this->data['currency'] = $this->productModel->findCurrencyActive();
						$this->data['data'] = $this->productModel->findOne($_GET['id']);
						$this->template->loadContent($this->page."edit", $this->data);
					}else{

						/** 
				          *-------------------------------
				          * VALIDATION SUCCESS
				          * UPDATE product BY ID
				          *-------------------------------
				          */
						$output = $this->productModel->update($_GET['id']);
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
        $isValid = $this->productModel->checkValidCode($_GET['id'], $code);
        if(empty($isValid)){
            $response = true;
        }else{
            $this->form_validation->set_message('isValidCode', 'The {field} field must be a unique value.');
            return false;
        }
        return $response;
    }

    function isValidNameEN($nameEN){
        $isValid = $this->productModel->checkValidNameEN($_GET['id'], $nameEN);
        if(empty($isValid)){
            $response = true;
        }else{
        	$this->form_validation->set_message('isValidNameEN', 'The {field} field must be a unique value.');
            return false;
        }
        return $response;
    }

    function isValidNameKH($nameKH){
        $isValid = $this->productModel->checkValidNameKH($_GET['id'], $nameKH);
        if(empty($isValid)){
            $response = true;
        }else{
        	$this->form_validation->set_message('isValidNameKH', 'The {field} field must be a unique value.');
            return false;
        }
        return $response;
    }

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit delete product
      *----------------------------------------------------------------
      */
	public function delete()
	{
		if($this->authorization->hasPermission($this->moduleName, "delete")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !="")
	            {
					$output = $this->productModel->deleteById($_GET['id']);
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
      * @param: method for view product
      *----------------------------------------------------------------
      */
	public function view(){
		if($this->authorization->hasPermission($this->moduleName, "view")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
					$this->data['ruleDetail'] = $this->productModel->findRuleDetailActive();
						$this->data['interest'] = $this->productModel->findInterestActive();
					$this->data['interest'] = $this->productModel->findInterestActive();
					$this->data['currency'] = $this->productModel->findCurrencyActive();
	            	$this->data['data'] = $this->productModel->findOne($_GET['id']);
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
            $this->data['data'] = $this->productModel->findAllFilter($filter);
        }else{
            $this->data['data'] = $this->productModel->findAll();
        }
        $this->load->view($this->page.'filter', $this->data);
      }
    }
}

 ?>