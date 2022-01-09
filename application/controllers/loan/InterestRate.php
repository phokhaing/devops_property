<?php 
/**
* 
*/
class interestRate extends CI_Controller
{	

	private $data = array();
	private $page = "loan/interestRate/";
	private $link = "loan/interestRate";
	private $title = "loan/interestRate";	
	private $moduleName = "loan/interestRate";	
	
	function __construct()
	{
		parent::__construct();
		if (!$this->user->loggedin){
            redirect('login');
		}
		$this->load->model('loan/InterestRateModel','interestRateModel');
		$this->load->helper('loan');
		$this->data['title'] = $this->title;
		$this->data['link'] = $this->link;
		$this->data['status'] = $this->interestRateModel->count();
		$this->data['moduleName'] = $this->moduleName;
		$this->authorization->hasAccess($this->moduleName);
	}

	public function index(){
		if($this->authorization->hasPermission($this->moduleName, "list")){
			$this->data['data'] = $this->interestRateModel->findAll();
			$this->template->loadContent($this->page."list", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form create interestRate
      *----------------------------------------------------------------
      */
	public function add(){
		if($this->authorization->hasPermission($this->moduleName, "create")){
			$this->data['interest'] = $this->interestRateModel->findInterestActive();
			$this->data['currency'] = $this->interestRateModel->findCurrencyActive();
			$this->template->loadContent($this->page."add", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit create interestRate
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
			$this->form_validation->set_rules('interestrate_code', 'InterestRate Code', 'trim|required|is_unique[loan_interest_rate.interestrate_code]');
			$this->form_validation->set_rules('interest_id', 'Interest Code', 'trim|required');
			$this->form_validation->set_rules('currency', 'Currency', 'required');
			$this->form_validation->set_rules('rate_amount', 'Rate Amount', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if($this->form_validation->run() == false){
				$this->data['interest'] = $this->interestRateModel->findInterestActive();
				$this->data['currency'] = $this->interestRateModel->findCurrencyActive();
				$this->template->loadContent($this->page."add", $this->data);
			}else{

				/** 
		          *-------------------------------
		          * VALIDATION SUCCESS
		          * INSERT interestRate
		          *-------------------------------
		          */
				$output = $this->interestRateModel->create();
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
      * @param: method for open form edit interestRate
      *----------------------------------------------------------------
      */
	public function edit(){
		if($this->authorization->hasPermission($this->moduleName, "update")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
	            	$this->data['interest'] = $this->interestRateModel->findInterestActive();
					$this->data['currency'] = $this->interestRateModel->findCurrencyActive();
					$this->data['data'] = $this->interestRateModel->findOne($_GET['id']);
					$this->template->loadContent($this->page."edit", $this->data);
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit update interestRate
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
			        $this->form_validation->set_rules('interestrate_code', 'InterestRate Code', 'trim|required|callback_isValidCode');
					$this->form_validation->set_rules('interest_id', 'Interest Code', 'trim|required');
					$this->form_validation->set_rules('currency', 'Currency', 'required');
					$this->form_validation->set_rules('rate_amount', 'Rate Amount', 'trim|required');
					$this->form_validation->set_rules('status', 'Status', 'required');

					if($this->form_validation->run() == false){
						$this->data['interest'] = $this->interestRateModel->findInterestActive();
						$this->data['currency'] = $this->interestRateModel->findCurrencyActive();
						$this->data['data'] = $this->interestRateModel->findOne($_GET['id']);
						$this->template->loadContent($this->page."edit", $this->data);
					}else{

						/** 
				          *-------------------------------
				          * VALIDATION SUCCESS
				          * UPDATE interestRate BY ID
				          *-------------------------------
				          */
						$output = $this->interestRateModel->update($_GET['id']);
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
        $isValid = $this->interestRateModel->checkValidCode($_GET['id'], $code);
        if(empty($isValid)){
            $response = true;
        }else{
        	$this->form_validation->set_rules('interestrate_code', 'Interest Rate Code', 'trim|required|is_unique[loan_interest_rate.interestrate_code]');
            $this->form_validation->set_message('isValidCode','Code must contain a unique value.');
            $response = false;
        }
        return $response;
    }

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit delete interestRate
      *----------------------------------------------------------------
      */
	public function delete()
	{
		if($this->authorization->hasPermission($this->moduleName, "delete")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !="")
	            {
					$output = $this->interestRateModel->deleteById($_GET['id']);
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
      * @param: method for view interestRate
      *----------------------------------------------------------------
      */
	public function view(){
		if($this->authorization->hasPermission($this->moduleName, "view")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
	            	$this->data['interest'] = $this->interestRateModel->findInterestActive();
			$this->data['currency'] = $this->interestRateModel->findCurrencyActive();
					$this->data['data'] = $this->interestRateModel->findOne($_GET['id']);
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
            $this->data['data'] = $this->interestRateModel->findAllFilter($filter);
        }else{
            $this->data['data'] = $this->interestRateModel->findAll();
        }
        $this->load->view($this->page.'filter', $this->data);
      }
    }
}

 ?>