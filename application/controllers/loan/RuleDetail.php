<?php 
/**
* 
*/
class RuleDetail extends CI_Controller
{	

	private $data = array();
	private $page = "loan/ruleDetail/";
	private $link = "loan/ruleDetail";
	private $title = "loan/ruleDetail";	
	private $moduleName = "loan/ruleDetail";	
	
	function __construct()
	{
		parent::__construct();
		if (!$this->user->loggedin){
            redirect('login');
		}
		$this->load->model('loan/RuleDetailModel','ruleDetailModel');
		$this->load->helper('loan');
		$this->data['title'] = $this->title;
		$this->data['link'] = $this->link;
		$this->data['status'] = $this->ruleDetailModel->count();
		$this->data['moduleName'] = $this->moduleName;
		$this->authorization->hasAccess($this->moduleName);
	}

	public function index(){
		if($this->authorization->hasPermission($this->moduleName, "list")){
			$this->data['data'] = $this->ruleDetailModel->findAll();
			$this->template->loadContent($this->page."list", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form create ruleDetail
      *----------------------------------------------------------------
      */
	public function add(){
		if($this->authorization->hasPermission($this->moduleName, "create")){
			$this->data['rules'] = $this->ruleDetailModel->findLoanRuleActive();
			$this->data['currency'] = $this->ruleDetailModel->findCurrencyActive();
			$this->template->loadContent($this->page."add", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit create ruleDetail
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
			$this->form_validation->set_rules('ruledetail_code', 'Rule Detail Code', 'trim|required|is_unique[loan_rule_detail.ruledetail_code]');
			$this->form_validation->set_rules('rule_id', 'Rule Code', 'trim|required');
			$this->form_validation->set_rules('currency', 'Currency', 'trim|required');
			$this->form_validation->set_rules('name_en', 'Name (EN)', 'trim|required|is_unique[loan_rule_detail.name_en]');
			$this->form_validation->set_rules('name_kh', 'Name (KH)', 'trim|required|is_unique[loan_rule_detail.name_kh]');
			$this->form_validation->set_rules('min_amount', 'Min Amount', 'trim|required|callback_isValid');
			$this->form_validation->set_rules('max_amount', 'Max Amount', 'trim|required|callback_isValid');
			$this->form_validation->set_rules('min_term', 'Min Term', 'trim|required|callback_isValid');
			$this->form_validation->set_rules('max_term', 'Max Term', 'trim|required|callback_isValid');
			$this->form_validation->set_rules('min_fee', 'Min Fee', 'trim|required|callback_isValid');
			$this->form_validation->set_rules('max_fee', 'Max Fee', 'trim|required|callback_isValid');
			$this->form_validation->set_rules('reduce_amount', 'Reduce Amount', 'trim|required|callback_isValid');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if($this->form_validation->run() == false){
				$this->data['rules'] = $this->ruleDetailModel->findLoanRuleActive();
				$this->data['currency'] = $this->ruleDetailModel->findCurrencyActive();
				$this->template->loadContent($this->page."add", $this->data);
			}else{

				/** 
		          *-------------------------------
		          * VALIDATION SUCCESS
		          * INSERT ruleDetail
		          *-------------------------------
		          */
				$output = $this->ruleDetailModel->create();
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
      * @param: method for open form edit ruleDetail
      *----------------------------------------------------------------
      */
	public function edit(){
		if($this->authorization->hasPermission($this->moduleName, "update")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
	            	$this->data['rules'] = $this->ruleDetailModel->findLoanRuleActive();
					$this->data['currency'] = $this->ruleDetailModel->findCurrencyActive();
	            	$this->data['data'] = $this->ruleDetailModel->findOne($_GET['id']);
					$this->template->loadContent($this->page."edit", $this->data);
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit update ruleDetail
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
			         
			        $this->form_validation->set_rules('ruledetail_code', 'Rule Detail Code', 'trim|required|callback_isValidCode');
					$this->form_validation->set_rules('rule_id', 'Rule Code', 'trim|required');
					$this->form_validation->set_rules('currency', 'Currency', 'trim|required');
					$this->form_validation->set_rules('name_en', 'Name (EN)', 'trim|required|callback_isValidNameEN');
					$this->form_validation->set_rules('name_kh', 'Name (KH)', 'trim|required|callback_isValidNameKH');
					$this->form_validation->set_rules('min_amount', 'Min Amount', 'trim|required|callback_isValid');
					$this->form_validation->set_rules('max_amount', 'Max Amount', 'trim|required|callback_isValid');
					$this->form_validation->set_rules('min_term', 'Min Term', 'trim|required|callback_isValid');
					$this->form_validation->set_rules('max_term', 'Max Term', 'trim|required|callback_isValid');
					$this->form_validation->set_rules('min_fee', 'Min Fee', 'trim|required|callback_isValid');
					$this->form_validation->set_rules('max_fee', 'Max Fee', 'trim|required|callback_isValid');
					$this->form_validation->set_rules('reduce_amount', 'Reduce Amount', 'trim|required|callback_isValid');
					$this->form_validation->set_rules('status', 'Status', 'required');

					if($this->form_validation->run() == false){
						$this->data['rules'] = $this->ruleDetailModel->findLoanRuleActive();
						$this->data['currency'] = $this->ruleDetailModel->findCurrencyActive();
						$this->data['data'] = $this->ruleDetailModel->findOne($_GET['id']);
						$this->template->loadContent($this->page."edit", $this->data);
					}else{

						/** 
				          *-------------------------------
				          * VALIDATION SUCCESS
				          * UPDATE ruleDetail BY ID
				          *-------------------------------
				          */
						$output = $this->ruleDetailModel->update($_GET['id']);
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
        $isValid = $this->ruleDetailModel->checkValidCode($_GET['id'], $code);
        if(empty($isValid)){
            $response = true;
        }else{
        	$this->form_validation->set_rules('ruledetail_code', 'RuleDetail Code', 'trim|required|is_unique[loan_rule_detail.ruledetail_code]');
            $this->form_validation->set_message('isValidCode','Code must contain a unique value.');
            $response = false;
        }
        return $response;
    }

    function isValidNameEN($nameEN){
        $isValid = $this->ruleDetailModel->checkValidNameEN($_GET['id'], $nameEN);
        if(empty($isValid)){
            $response = true;
        }else{
        	$this->form_validation->set_rules('name_en', 'Name (EN)', 'trim|required|is_unique[loan_rule_detail.name_en]');
            $this->form_validation->set_message('isValidNameEN','Name (EN) field must contain a unique value.');
            $response = false;
        }
        return $response;
    }

    function isValidNameKH($nameKH){
        $isValid = $this->ruleDetailModel->checkValidNameKH($_GET['id'], $nameKH);
        if(empty($isValid)){
            $response = true;
        }else{
        	$this->form_validation->set_rules('name_kh', 'Name (KH)', 'trim|required|is_unique[loan_rule_detail.name_kh]');
            $this->form_validation->set_message('isValidNameKH','Name (KH) field must contain a unique value.');
            $response = false;
        }
        return $response;
    }

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit delete ruleDetail
      *----------------------------------------------------------------
      */
	public function delete()
	{
		if($this->authorization->hasPermission($this->moduleName, "delete")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !="")
	            {
					$output = $this->ruleDetailModel->deleteById($_GET['id']);
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
      * @param: method for view ruleDetail
      *----------------------------------------------------------------
      */
	public function view(){
		if($this->authorization->hasPermission($this->moduleName, "view")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
					$this->data['rules'] = $this->ruleDetailModel->findLoanRuleActive();
					$this->data['currency'] = $this->ruleDetailModel->findCurrencyActive();
	            	$this->data['data'] = $this->ruleDetailModel->findOne($_GET['id']);
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
            $this->data['data'] = $this->ruleDetailModel->findAllFilter($filter);
        }else{
            $this->data['data'] = $this->ruleDetailModel->findAll();
        }
        $this->load->view($this->page.'filter', $this->data);
      }
    }
}

 ?>