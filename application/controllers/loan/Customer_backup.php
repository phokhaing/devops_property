<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
* 
*/
class Customer extends CI_Controller
{	
	/* fields*/
	/* table */
	private $table       			  = "customer";
	private $tblSector  			  = "sector";
	private $tblIndustry  			  = "industry";
	private $tblIdentificationType 	  = "identification_type";
	private $tblBusinessType  	      = "business_type";
	private $tblBusinessLocationStatus= "business_location_status";
	private $tblBusinessFormat  	  = "business_format";
	private $tblBusinessStatus  	  = "business_status";

	/* customer */
	private $tblContact		= "customer_contact";
	private $id          	= "customer_id";
	private $firstname_kh   = "firstname_kh";
	private $lastname_kh	= "lastname_kh";
	private $firstname_េន	= "firstname_en";
	private $lastname_en	= "lastname_en";
	private $salutation		= "salutation";
	private $gender	 		= "gender";
	private $dob 			= "dob";
	private $nationality	= "nationality";
	private $dob_country	= "dob_country";
	private $dob_province	= "dob_province";	 
	private $dob_district	= "dob_district";	
	private $dob_commune	= "dob_commune";
	private $dob_village	= "dob_village";
	private $marital_status	= "marital_status";
	private	$house_ownershi = "house_ownership";	
	private $family_member	= "family_member";
	private $active_member  = "active_member";
	private $resident		= "resident";
	private $guarantor		= "guarantor";
	private $officer		= "officer";

	/* contact */
	private $contact_id 	= "contact_id";
	private $customer_id 	= "customer_id";
	private $country_id 	= "country_id";
	private $province_id 	= "province_id";
	private $district_id 	= "district_id";
	private $commune_id 	= "commune_id";
	private $village_id 	= "village_id";
	private $city 			= "city";
	private $house_no 		= "house_no";
	private $street 		= "street";
	private $phone1 		= "phone1";
	private $phone2 		= "phone2";
	private $email 			= "email";
	private $primary 		= "primary";
	private $map_longitude 	= "map_longitude";
	private $map_latitude 	= "map_latitude";

	/* spouse */
	private $tblSpouse 			 = "spouse";
	private $spouse_id 			 = "spouse_id";
	private $spouse_firstname_kh = "spouse_firstname_kh";
	private $spouse_lastname_kh  = "spouse_lastname_kh";
	private $spouse_firstname_en = "spouse_firstname_en";
	private $spouse_lastname_en  = "spouse_lastname_en";
	private $spouse_gender 		 = "spouse_gender";
	private $spouse_dob 		 = "spouse_dob";
	private $spouse_nationality  = "spouse_nationality";
	private $spouse_occupation   = "spouse_occupation";
	private $spouse_id_type 	 = "spouse_id_type";
	private $spouse_id_code 	 = "spouse_id_code";
	private $spouse_issue_date 	 = "spouse_issue_date";

	/* identification document*/
	private $identification_id 			= "identification_id";
	private $identification_type 		= "identification_type";
	private $identification_code 		= "identification_code";
	private $identification_issue_place = "identification_issue_place";
	private $identification_issue_date  = "identification_issue_date";
	private $identification_expiry_date = "identification_expiry_date";

	/* employment detail */
	private $tblEmploymentDetail	= "employment_detail";
	private $employment_id 			= "employment_id";
	private $employment_type 		= "employment_type";
	private $self_employee 			= "self_employee";
	private $company_name 			= "company_name";
	private $empbusiness_type_id	= "empbusiness_type_id";
	private $employer_name 			= "employer_name";
	private $emp_occupation 		= "emp_occupation";
	private $length_of_service  	= "length_of_service";
	private $employer_id 			= "employer_id";
	private $employer_country 		= "employer_country";
	private $employer_province 		= "employer_province";
	private $employer_district 		= "employer_district";
	private $employer_commune 		= "employer_commune";
	private $employer_village 		= "employer_village";
	private $employer_houseno 		= "employer_houseno";
	private $employer_street 		= "employer_street";
	private $employed_year 			= "employed_year";
	private $employee_currency 		= "employee_currency";
	private $emplyee_salary 		= "emplyee_salary";

	/* business plan */
	private $tblBusinessPlan		= "business_plan";
	private $business_plan_id 		= "business_plan_id";
	private $business_name 			= "business_name";
	private $business_type 			= "business_type";
	private $business_status 		= "business_status";
	private $business_format 		= "business_format";
	private $business_start 		= "business_start";
	private $business_licence 		= "business_licence";
	private $employee_amount 		= "employee_amount";
	private $man_employee_amount 	= "man_employee_amount";
	private $business_country 		= "business_country";
	private $business_province 		= "business_province";
	private $business_district 		= "business_district";
	private $business_commune 		= "business_commune";
	private $business_village 		= "business_village";
	private $location_status 		= "location_status";

	/* business income expend */
	private $business_income_expend = "business_income_expend";
	private $business_income_id 	= "business_income_id";
	private $income_date 		    = "income_date";
	private $business_profit 		= "business_profit";
	private $transport_cost 		= "transport_cost";
	private $repair_cost 			= "repair_cost";
	private $profit_before_tax 		= "profit_before_tax";
	private $income_after_tax 		= "income_after_tax";
	private $business_cost 			= "business_cost";
	private $other_profit 			= "other_profit";
	private $total_profit 			= "total_profit";
	private $electric_water_expend 	= "electric_water_expend";
	private $salary_food_expend 	= "salary_food_expend";
	private $rent_house_expend 		= "rent_house_expend";
	private $insurance_expend 		= "insurance_expend";
	private $advertise_expend 		= "advertise_expend";
	private $loan_expend 			= "loan_expend";
	private $tax_expend 			= "tax_expend";
	private $others_expend 			= "others_expend";
	private $total_expend 			= "total_expend";

	/* personal_income_expend */
	private $tblPersonalIncomeExpend   = "personal_income_expend";
	private $personal_income_id 	   = "personal_income_id";
	private $personal_profit 		   = "personal_profit";
	private $personal_income_salary    = "personal_income_salary";
	private $personal_other_profit 	   = "personal_other_profit";
	private $total_income 			   = "total_income";
	private $personal_food_expend 	   = "personal_food_expend";
	private $personal_clothes_expend   = "personal_clothes_expend";
	private $personal_media_expend 	   = "personal_media_expend";
	private $personal_insurance_expend = "personal_insurance_expend";
	private $personal_electric_expend  = "personal_electric_expend";
	private $personal_repare_expend    = "personal_repare_expend";
	private $personal_other_expend 	   = "personal_other_expend";
	private $possibility_pay 		   = "possibility_pay";
	private $personal_total_expend 	   = "personal_total_expend";
	

	/* default */
	private $createdBy 	 	= "created_by";
	private $createdAt 	 	= "created_at";
	private $updatedBy 	 	= "updated_by";
	private $updatedAt 	 	= "updated_at";
	private $status    	 	= 'status';
	/* end fields*/

	private $data = array();
	private $page = "loan/customer/";
	private $link = "loan/customer";
	private $title = "loan/customer";	
	private $moduleName = "loan/customer";	
	
	function __construct()
	{
		parent::__construct();
		if (!$this->user->loggedin) redirect('login');
		$this->load->model('loan/CustomerModel','customerModel');
		$this->load->helper(array('loan','address'));
		$this->data['title'] = $this->title;
		$this->data['link'] = $this->link;
		$this->data['status'] = $this->customerModel->count();
		$this->data['moduleName'] = $this->moduleName;
		$this->authorization->hasAccess($this->moduleName);
	}

	public function index(){
		if($this->authorization->hasPermission($this->moduleName, "list")){
			$this->data['data'] = $this->customerModel->findAll();
			$this->template->loadContent($this->page."list", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form create customer
      *----------------------------------------------------------------
      */
	public function add(){
		if($this->authorization->hasPermission($this->moduleName, "create")){
			$this->data['country'] = findCountryActive();
			$this->data['nationality'] = findNationalityActive();
			$this->data['sector'] = $this->customerModel->findSectorActive();
			$this->data['identificationType'] = $this->customerModel->findIdentificationTypeActive();
			$this->data['businessType'] = $this->customerModel->findBusinessTypeActive();
			$this->data['businessLocationStatus'] = $this->customerModel->findBusinessLocationStatusActive();
			$this->data['businessFormat'] = $this->customerModel->findBusinessFormatActive();
			$this->data['businessStatus'] = $this->customerModel->findBusinessStatusActive();
			/* unset session catch_files */
            $this->session->unset_userdata('catch_files');
			$this->template->loadContent($this->page."add", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for create new customer info
      *----------------------------------------------------------------
      */
	public function create()
	{	
		if($this->authorization->hasPermission($this->moduleName, "create"))
		{	
			$is_valid = $this->customerModel->is_validated();
			if($is_valid == 'true')
			{	
				/* validation true & create new customer info */
				$output = $this->customerModel->create(); 
				if($output){
					$this->session->set_flashdata("success", "Congratulation, Record has been saved successfully!");
				}else{
					$this->session->set_flashdata("error", "Faile, something went wrong!");
	            	$this->template->loadContent($this->page."add", $this->data);
				}
	            redirect(site_url($this->link));
			}else{
				/* store file to catch while validation form error */
				$inputFile = 'identification_files';
				if(isset($_FILES[$inputFile]) && $_FILES[$inputFile]['name'][0] != ''){
					$filePath = '/catch_file/identification';			        
			        $fileRemoved = 'identification_files_deleted';	      
			        $catchName = 'identification_files_catch';
			        $this->session->set_userdata($catchName, $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved));			        
				}
				/* validation false */
				$this->data['class_active'] = $is_valid;
				$this->data['country'] = findCountryActive();
				$this->data['nationality'] = findNationalityActive();
				$this->data['sector'] = $this->customerModel->findSectorActive();
				$this->data['identificationType'] = $this->customerModel->findIdentificationTypeActive();
				$this->data['businessType'] = $this->customerModel->findBusinessTypeActive();
				$this->data['businessLocationStatus'] = $this->customerModel->findBusinessLocationStatusActive();
				$this->data['businessFormat'] = $this->customerModel->findBusinessFormatActive();
				$this->data['businessStatus'] = $this->customerModel->findBusinessStatusActive();
				$this->template->loadContent($this->page."add", $this->data);
			}
		}
	}

	public function is_number($param)
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
      * @param: method for open form edit customer
      *----------------------------------------------------------------
      */
	public function edit(){
		if($this->authorization->hasPermission($this->moduleName, "update")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
	            	$this->data['ruleDetail'] = $this->customerModel->findRuleDetailActive();
						$this->data['interest'] = $this->customerModel->findInterestActive();
					$this->data['currency'] = $this->customerModel->findCurrencyActive();
	            	$this->data['data'] = $this->customerModel->findOne($_GET['id']);
					$this->template->loadContent($this->page."edit", $this->data);
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit update customer
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
			        $this->form_validation->set_rules('customer_code', 'customer Code', 'trim|required|callback_isValidCode');
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
						$this->data['ruleDetail'] = $this->customerModel->findRuleDetailActive();
						$this->data['interest'] = $this->customerModel->findInterestActive();
						$this->data['currency'] = $this->customerModel->findCurrencyActive();
						$this->data['data'] = $this->customerModel->findOne($_GET['id']);
						$this->template->loadContent($this->page."edit", $this->data);
					}else{

						/** 
				          *-------------------------------
				          * VALIDATION SUCCESS
				          * UPDATE customer BY ID
				          *-------------------------------
				          */
						$output = $this->customerModel->update($_GET['id']);
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
        $isValid = $this->customerModel->checkValidCode($_GET['id'], $code);
        if(empty($isValid)){
            $response = true;
        }else{
            $this->form_validation->set_message('isValidCode', 'The {field} field must be a unique value.');
            return false;
        }
        return $response;
    }

    function isValidNameEN($nameEN){
        $isValid = $this->customerModel->checkValidNameEN($_GET['id'], $nameEN);
        if(empty($isValid)){
            $response = true;
        }else{
        	$this->form_validation->set_message('isValidNameEN', 'The {field} field must be a unique value.');
            return false;
        }
        return $response;
    }

    function isValidNameKH($nameKH){
        $isValid = $this->customerModel->checkValidNameKH($_GET['id'], $nameKH);
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
      * @param: method for submit delete customer
      *----------------------------------------------------------------
      */
	public function delete()
	{
		if($this->authorization->hasPermission($this->moduleName, "delete")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !="")
	            {
					$output = $this->customerModel->deleteById($_GET['id']);
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
      * @param: method for view customer
      *----------------------------------------------------------------
      */
	public function view(){
		if($this->authorization->hasPermission($this->moduleName, "view")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
					$this->data['ruleDetail'] = $this->customerModel->findRuleDetailActive();
						$this->data['interest'] = $this->customerModel->findInterestActive();
					$this->data['interest'] = $this->customerModel->findInterestActive();
					$this->data['currency'] = $this->customerModel->findCurrencyActive();
	            	$this->data['data'] = $this->customerModel->findOne($_GET['id']);
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
            $this->data['data'] = $this->customerModel->findAllFilter($filter);
        }else{
            $this->data['data'] = $this->customerModel->findAll();
        }
        $this->load->view($this->page.'filter', $this->data);
      }
    }

    /** 
      *------------------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 12/March/2020
      * @param: method for get industry by sector id
      *------------------------------------------------------------------------
      */
    public function findIndustry($sector = null){
        $output = $this->customerModel->findIndustryBySectorID($sector);	                   
	    if(!empty($output)){
	    	echo ("<option value=''> --- select industry --- </option>");
	    	foreach($output as $list){
	            echo ("<option value='".$list->id."'>".$list->name_en."</option>");
	        }
	    }else{
	        echo ("<option value=''> No data </option>");
	    }
    }
}

 ?>