<?php 
/**
* @author: khaing.pho1991@gmail.com
*/
class CustomerModel extends CI_Model
{	
	/* table */
	private $table       			  = "customer";
	private $tblSector  			  = "sector";
	private $tblIndustry  			  = "industry";
	private $tblIdentificationType 	  = "identification_type";
	private $tblBusinessType  	      = "business_type";
	private $tblBusinessLocationStatus= "business_location_status";
	private $tblBusinessFormat  	  = "business_format";
	private $tblBusinessStatus  	  = "business_status";
	private $tblIdentificationFiles  = "identification_files";

	/* customer */
	private $id          	= "id";
	private $customer_id    = "customer_id";
	private $firstname_kh   = "firstname_kh";
	private $lastname_kh	= "lastname_kh";
	private $firstname_en	= "firstname_en";
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
	private	$house_ownership= "house_ownership";	
	private $family_member	= "family_member";
	private $active_member  = "active_member";
	private $resident		= "resident";
	private $sector			= "sector";
	private $industry		= "industry";
	private $guarantor		= "guarantor";
	private $officer		= "officer";

	/* spouse */
	private $tblSpouse 			 = "spouse";
	private $spouse_id 			 = "spouse_id";
	private $spouse_firstname_kh = "spouse_firstname_kh";
	private $spouse_lastname_kh  = "spouse_lastname_kh";
	private $spouse_firstname_en = "spouse_firstname_en";
	private $spouse_lastname_en  = "spouse_lastname_en";
	private $spouse_dob 		 = "spouse_dob";
	private $spouse_nationality  = "spouse_nationality";
	private $spouse_occupation   = "spouse_occupation";
	private $spouse_id_type 	 = "spouse_id_type";
	private $spouse_id_code 	 = "spouse_id_code";
	private $spouse_issue_date 	 = "spouse_issue_date";

	/* contact */
	private $tblContact		= "customer_contact";
	private $contact_id 	= "contact_id";
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
	private $map_longitude 	= "map_longitude";
	private $map_latitude 	= "map_latitude";
	private $primary 		= "primary";

	/* identification document*/
	private $tblIdentification 			= 'identification';
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
	private $employer_address_type  = "employer_address_type";
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
	private $tblBusinessIncomeExpend = "business_income_expend";
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

	function __construct(){
		parent::__construct();
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 05/July/2020
      * @param: method for validation form customer info
      *----------------------------------------------------------------
      */
	public function is_validated(){
		
		/**
		 * ------------------------------------------
		 * FORM CUSTOMER VALIDATION 
		 * ------------------------------------------
		 */
		/*$this->form_validation->set_rules($this->firstname_kh, lang('firstname_kh'), 'trim|required|min_length[2]|max_length[100]');
		$this->form_validation->set_rules($this->lastname_kh, lang('lastname_kh'), 'trim|required|min_length[2]|max_length[100]');
		$this->form_validation->set_rules($this->firstname_en, lang('firstname_en'), 'trim|required|min_length[2]|max_length[100]');
		$this->form_validation->set_rules($this->lastname_en, lang('lastname_en'), 'trim|required|min_length[2]|max_length[100]');
		$this->form_validation->set_rules($this->salutation, lang('salutation'), 'trim|required');
		$this->form_validation->set_rules($this->gender, lang('gender'), 'trim|required');
		$this->form_validation->set_rules($this->dob, lang('dob'), 'trim|required');
		$this->form_validation->set_rules($this->nationality, lang('nationality'), 'trim|required');
		$this->form_validation->set_rules($this->dob_country, lang('dob_country'), 'trim|required');
		$this->form_validation->set_rules($this->dob_province, lang('dob_province'), 'trim|required');
		$this->form_validation->set_rules($this->dob_district, lang('dob_district'), 'trim|required');
		$this->form_validation->set_rules($this->dob_commune, lang('dob_commune'), 'trim|required');
		$this->form_validation->set_rules($this->dob_village, lang('dob_village'), 'trim|required');
		$this->form_validation->set_rules($this->marital_status, lang('marital_status'), 'trim|required');
		$this->form_validation->set_rules($this->house_ownership, lang('house_ownership'), 'trim|required');
		$this->form_validation->set_rules($this->family_member, lang('family_member'), 'trim|required|numeric');
		$this->form_validation->set_rules($this->active_member, lang('active_member'), 'trim|required|numeric');
		$this->form_validation->set_rules($this->resident, lang('resident'), 'trim|required');
		$this->form_validation->set_rules($this->sector, lang('sector'), 'trim|required');
		$this->form_validation->set_rules($this->industry, lang('industry'), 'trim|required');
		$this->form_validation->set_rules($this->guarantor, lang('guarantor'), 'trim|required');
		$this->form_validation->set_rules($this->officer, lang('officer'), 'trim|required');*/

		/**
		 * ------------------------------------------
		 * FORM SPOUSE VALIDATION 
		 * ------------------------------------------
		 */
		/*if($this->input->post('spouse_firstname_kh'))
		{
			$this->form_validation->set_rules($this->spouse_firstname_kh, lang('spouse_firstname_kh'), 'trim|required|min_length[2]|max_length[100]');
			$this->form_validation->set_rules($this->spouse_lastname_kh, lang('spouse_lastname_kh'), 'trim|required|min_length[2]|max_length[100]');
			$this->form_validation->set_rules($this->spouse_firstname_en, lang('spouse_firstname_en'), 'trim|required|min_length[2]|max_length[100]');
			$this->form_validation->set_rules($this->spouse_lastname_en, lang('spouse_lastname_en'), 'trim|required|min_length[2]|max_length[100]');
			$this->form_validation->set_rules($this->spouse_dob, lang('spouse_dob'), 'trim|required');
			$this->form_validation->set_rules($this->spouse_nationality, lang('spouse_nationality'), 'trim|required');
			$this->form_validation->set_rules($this->spouse_occupation, lang('spouse_occupation'), 'trim|required');
			$this->form_validation->set_rules($this->spouse_id_type, lang('spouse_id_type'), 'trim|required');
			$this->form_validation->set_rules($this->spouse_id_code, lang('spouse_id_code'), 'trim|required');
			$this->form_validation->set_rules($this->spouse_issue_date, lang('spouse_issue_date'), 'trim|required');
		}*/

		// $this->form_validation->set_rules('min_reduce_amount', 'Min Reduce Amount', 'trim|required|callback_isValid');
		// $this->form_validation->set_rules('status', 'Status', 'required');
		//if($this->form_validation->run() == false){
			// return class name for set active tab-content
			/*return 'customer';
		}else{*/

			/**
			 * ------------------------------------------
			 * FORM CONTACT VALIDATION 
			 * ------------------------------------------
			 */
			/*for ($i=0; $i < count($_POST[$this->country_id]); $i++)
			{
				$this->form_validation->set_rules($this->country_id.'['.$i.']', lang('country_id'), 'trim|required');
				$this->form_validation->set_rules($this->province_id.'['.$i.']', lang('province_id'), 'trim|required');
				$this->form_validation->set_rules($this->district_id.'['.$i.']', lang('district_id'), 'trim|required');
				$this->form_validation->set_rules($this->commune_id.'['.$i.']', lang('commune_id'), 'trim|required');
				$this->form_validation->set_rules($this->house_no.'['.$i.']', lang('house_no'), 'trim|required');
				$this->form_validation->set_rules($this->street.'['.$i.']', lang('street'), 'trim|required');
				$this->form_validation->set_rules($this->phone1.'['.$i.']', lang('phone1'), 'trim|required|numeric|min_length[2]|max_length[10]');
				$this->form_validation->set_rules($this->phone2.'['.$i.']', lang('phone2'), 'trim|numeric');
				$this->form_validation->set_rules($this->email.'['.$i.']', lang('email'), 'trim|valid_email');
				$this->form_validation->set_rules($this->map_latitude.'['.$i.']', lang('map_latitude'), 'trim|numeric');
				$this->form_validation->set_rules($this->map_longitude.'['.$i.']', lang('map_longitude'), 'trim|numeric');
			}
			if($this->form_validation->run() == false){
				// return class name for set active tab-content
				return 'contact'; 
			}else{*/

				/**
				 * ------------------------------------------
				 * FORM IDENTIFICATION VALIDATION 
				 * ------------------------------------------
				 */
				
				for($i=0; $i < count($_POST[$this->identification_type]); $i++)
				{ 
					$this->form_validation->set_rules($this->identification_type.'['.$i.']', lang('identification_type'), 'trim|required');
					$this->form_validation->set_rules($this->identification_code.'['.$i.']', lang('identification_code'), 'trim|required|numeric|min_length[2]|max_length[50]');
					$this->form_validation->set_rules($this->identification_issue_place.'['.$i.']', lang('identification_issue_place'), 'trim|required');
					$this->form_validation->set_rules($this->identification_issue_date.'['.$i.']', lang('identification_issue_date'), 'trim|required|min_length[10]|max_length[10]');
					$this->form_validation->set_rules($this->identification_expiry_date.'['.$i.']', lang('identification_expiry_date'), 'trim|required|min_length[10]|max_length[10]');
				}
				if($this->form_validation->run() == false){
					// return class name for set active tab-content
					return 'identification'; 
				}else{

					/**
					 * ------------------------------------------
					 * FORM EMPLOYMENT VALIDATION 
					 * ------------------------------------------
					 */
					/*for ($i=0; $i < count($_POST[$this->employment_type]); $i++)
					{ 
						$this->form_validation->set_rules($this->employment_type.'['.$i.']', lang('employment_type'), 'trim|required');
						$this->form_validation->set_rules($this->self_employee.'['.$i.']', lang('self_employee'), 'trim|required');
						$this->form_validation->set_rules($this->company_name.'['.$i.']', lang('company_name'), 'trim|required|min_length[2]');
						$this->form_validation->set_rules($this->empbusiness_type_id.'['.$i.']', lang('empbusiness_type_id'), 'trim|required');
						$this->form_validation->set_rules($this->employer_name.'['.$i.']', lang('employer_name'), 'trim|required|min_length[2]');
						$this->form_validation->set_rules($this->emp_occupation.'['.$i.']', lang('emp_occupation'), 'trim|required|min_length[2]');
						$this->form_validation->set_rules($this->length_of_service.'['.$i.']', lang('length_of_service'), 'trim|required|min_length[2]');
						$this->form_validation->set_rules($this->employer_address_type.'['.$i.']', lang('employer_address_type'), 'trim|required');
						$this->form_validation->set_rules($this->employer_id.'['.$i.']', lang('employer_id'), 'trim|required|min_length[2]');
						$this->form_validation->set_rules($this->employer_country.'['.$i.']', lang('employer_country'), 'trim|required');
						$this->form_validation->set_rules($this->employer_province.'['.$i.']', lang('employer_province'), 'trim|required');
						$this->form_validation->set_rules($this->employer_district.'['.$i.']', lang('employer_district'), 'trim|required');
						$this->form_validation->set_rules($this->employer_commune.'['.$i.']', lang('employer_commune'), 'trim|required');
						$this->form_validation->set_rules($this->employer_village.'['.$i.']', lang('employer_village'), 'trim|required');
						$this->form_validation->set_rules($this->employer_houseno.'['.$i.']', lang('employer_houseno'), 'trim|required');
						$this->form_validation->set_rules($this->employer_street.'['.$i.']', lang('employer_street'), 'trim|required');
						$this->form_validation->set_rules($this->employed_year.'['.$i.']', lang('employed_year'), 'trim|required');
						$this->form_validation->set_rules($this->employee_currency.'['.$i.']', lang('employee_currency'), 'trim|required');
						$this->form_validation->set_rules($this->emplyee_salary.'['.$i.']', lang('emplyee_salary'), 'trim|required');
					}
					if($this->form_validation->run() == false){
						// return class name for set active tab-content
						return 'employment'; 
					}else{ 
						return 'true';
					}*/
					return 'true';
				}
			/*}
		}
		return 'true';*/
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 05/July/2020
      * @param: method for create new customer info
      *----------------------------------------------------------------
      */
	function create()
	{
		/* create new customer info */
		/*$this->db->insert($this->table, array(
			$this->firstname_kh   => $this->input->post($this->firstname_kh),
			$this->lastname_kh	  => $this->input->post($this->lastname_kh),
			$this->firstname_en   => $this->input->post($this->firstname_en),
			$this->lastname_en	  => $this->input->post($this->lastname_en),
			$this->salutation	  => $this->input->post($this->salutation),
			$this->gender	 	  => $this->input->post($this->gender),
			$this->dob 		   	  => date('Y-m-d', strtotime($this->input->post($this->dob))),
			$this->nationality	  => $this->input->post($this->nationality),
			$this->dob_country	  => (int)$this->input->post($this->dob_country),
			$this->dob_province   => (int)$this->input->post($this->dob_province),	 
			$this->dob_district   => (int)$this->input->post($this->dob_district),	
			$this->dob_commune	  => (int)$this->input->post($this->dob_commune),
			$this->dob_village	  => (int)$this->input->post($this->dob_village),
			$this->marital_status => $this->input->post($this->marital_status),
			$this->house_ownership=> $this->input->post($this->house_ownership),	
			$this->family_member  => (int)$this->input->post($this->family_member),
			$this->active_member  => (int)$this->input->post($this->active_member),
			$this->resident	   	  => $this->input->post($this->resident),
			$this->sector	   	  => (int)$this->input->post($this->sector),
			$this->industry	   	  => (int)$this->input->post($this->industry),
			$this->guarantor	  => $this->input->post($this->guarantor),
			$this->officer		  => (int)$this->input->post($this->officer),
			$this->status    	  => (int) 1,
			$this->createdBy 	  => (int) $this->user->info->ID,
			$this->createdAt 	  => date("Y-m-d H:i:s"))
		);
		$customer_id = $this->db->insert_id();

		if($customer_id){
			/* add customer id (10 lengths) */
			/*$this->db->where($this->id, $customer_id)
					 ->set($this->customer_id, 'CU'.str_pad($customer_id, 10, "0", STR_PAD_LEFT))
					 ->update($this->table);

			/* create new spouse info */
			/*if($this->input->post('spouse_firstname_kh')){
				$this->db->insert($this->tblSpouse, array(
				$this->customer_id 		   => $customer_id,
				$this->spouse_firstname_kh => $this->input->post($this->spouse_firstname_kh),
				$this->spouse_lastname_kh  => $this->input->post($this->spouse_lastname_kh),
				$this->spouse_firstname_en => $this->input->post($this->spouse_firstname_en),
				$this->spouse_lastname_en  => $this->input->post($this->spouse_lastname_en),
				$this->spouse_dob 		   => date('Y-m-d', strtotime($this->input->post($this->spouse_dob))),
				$this->spouse_nationality  => $this->input->post($this->spouse_nationality),
				$this->spouse_occupation   => $this->input->post($this->spouse_occupation),
				$this->spouse_id_type 	   => (int)$this->input->post($this->spouse_id_type),
				$this->spouse_id_code 	   => $this->input->post($this->spouse_id_code),
				$this->spouse_issue_date   => date('Y-m-d', strtotime($this->input->post($this->spouse_issue_date))),
				$this->status    	       => (int) 1,
				$this->createdBy 	       => (int) $this->user->info->ID,
				$this->createdAt 	       => date("Y-m-d H:i:s")));
			}

			/* create new contact address info */
			/*for($i=0; $i < count($this->input->post($this->country_id)); $i++){ 
				$this->db->insert($this->tblContact, array(
				$this->customer_id 	  => $customer_id,
				$this->country_id 	  => $this->input->post($this->country_id)[$i],
				$this->province_id    => $this->input->post($this->province_id)[$i],
				$this->district_id    => $this->input->post($this->district_id)[$i],
				$this->commune_id 	  => $this->input->post($this->commune_id)[$i],
				$this->village_id 	  => $this->input->post($this->village_id)[$i],
				$this->city 		  => $this->input->post($this->city)[$i],
				$this->house_no 	  => $this->input->post($this->house_no)[$i],
				$this->street 		  => $this->input->post($this->street)[$i],
				$this->phone1 		  => $this->input->post($this->phone1)[$i],
				$this->phone2 		  => $this->input->post($this->phone2)[$i],
				$this->email 		  => $this->input->post($this->email)[$i],
				$this->map_longitude  => $this->input->post($this->map_longitude)[$i],
				$this->map_latitude   => $this->input->post($this->map_latitude)[$i],
				$this->primary 	  	  => ($i==0 ? 1 : 0),
				$this->status    	  => (int) 1,
				$this->createdBy 	  => (int) $this->user->info->ID,
				$this->createdAt 	  => date("Y-m-d H:i:s")));
			}

			/* create new identification info */
			/*for($i=0; $i < count($this->input->post($this->identification_type)); $i++){ 
				$this->db->insert($this->tblIdentification, array(
				$this->customer_id 	  			  => $customer_id,
				$this->identification_type 	   	  => $this->input->post($this->identification_type)[$i],
				$this->identification_code 	      => $this->input->post($this->identification_code)[$i],
				$this->identification_issue_place => $this->input->post($this->identification_issue_place)[$i],
				$this->identification_issue_date  => date('Y-m-d', strtotime($this->input->post($this->identification_issue_date)[$i])),
				$this->identification_expiry_date => date('Y-m-d', strtotime($this->input->post($this->identification_expiry_date)[$i])),
				$this->primary 	  	  			  => ($i==0 ? 1 : 0),
				$this->status    	  			  => (int) 1,
				$this->createdBy 	  			  => (int) $this->user->info->ID,
				$this->createdAt 	  			  => date("Y-m-d H:i:s")));
			}

			/* create new employment detail */
			/*for($i=0; $i < count($this->input->post($this->employment_type)); $i++){ 
				$this->db->insert($this->tblEmploymentDetail, array(
				$this->customer_id 	  		 => $customer_id,
				$this->employment_type 		 => $this->input->post($this->employment_type)[$i],
				$this->self_employee 		 => $this->input->post($this->self_employee)[$i],
				$this->company_name 		 => $this->input->post($this->company_name)[$i],
				$this->empbusiness_type_id	 => $this->input->post($this->empbusiness_type_id)[$i],
				$this->employer_name 		 => $this->input->post($this->employer_name)[$i],
				$this->emp_occupation 		 => $this->input->post($this->emp_occupation)[$i],
				$this->length_of_service  	 => $this->input->post($this->length_of_service)[$i],
				$this->employer_address_type => $this->input->post($this->employer_address_type)[$i],
				$this->employer_id 			 => $this->input->post($this->employer_id)[$i],
				$this->employer_country 	 => $this->input->post($this->employer_country)[$i],
				$this->employer_province 	 => $this->input->post($this->employer_province)[$i],
				$this->employer_district 	 => $this->input->post($this->employer_district)[$i],
				$this->employer_commune 	 => $this->input->post($this->employer_commune)[$i],
				$this->employer_village 	 => $this->input->post($this->employer_village)[$i],
				$this->employer_houseno 	 => $this->input->post($this->employer_houseno)[$i],
				$this->employer_street 		 => $this->input->post($this->employer_street)[$i],
				$this->employed_year 		 => $this->input->post($this->employed_year)[$i],
				$this->employee_currency 	 => $this->input->post($this->employee_currency)[$i],
				$this->emplyee_salary 		 => (float) $this->input->post($this->emplyee_salary)[$i],
				$this->primary 	  	  	     => ($i==0 ? 1 : 0),
				$this->status    	  	     => (int) 1,
				$this->createdBy 	  	     => (int) $this->user->info->ID,
				$this->createdAt 	  	     => date("Y-m-d H:i:s")));
			}

			/* create new business info */
			/*if($this->input->post($this->business_name)){
				for($i=0; $i < count($this->input->post($this->business_name)); $i++){ 
					$this->db->insert($this->tblBusinessPlan, array(
					$this->customer_id 	  	   => $customer_id,
					$this->business_name 	   => $this->input->post($this->business_name)[$i],
					$this->business_type 	   => $this->input->post($this->business_type)[$i],
					$this->business_status 	   => $this->input->post($this->business_status)[$i],
					$this->business_format 	   => $this->input->post($this->business_format)[$i],
					$this->business_start 	   => date('Y-m-d', strtotime($this->input->post($this->business_start)[$i])),
					$this->business_licence    => $this->input->post($this->business_licence)[$i],
					$this->employee_amount 	   => $this->input->post($this->employee_amount)[$i],
					$this->man_employee_amount => $this->input->post($this->man_employee_amount)[$i],
					$this->business_country    => $this->input->post($this->business_country)[$i],
					$this->business_province   => $this->input->post($this->business_province)[$i],
					$this->business_district   => $this->input->post($this->business_district)[$i],
					$this->business_commune    => $this->input->post($this->business_commune)[$i],
					$this->business_village    => $this->input->post($this->business_village)[$i],
					$this->location_status 	   => $this->input->post($this->location_status)[$i],
					$this->primary 	  	  	   => ($i==0 ? 1 : 0),
					$this->status    	  	   => (int) 1,
					$this->createdBy 	  	   => (int) $this->user->info->ID,
					$this->createdAt 	  	   => date("Y-m-d H:i:s")));
					$business_plan_id = $this->db->insert_id();

					if($business_plan_id){
						$this->db->insert($this->tblBusinessIncomeExpend, array(
						$this->business_plan_id 	=> $business_plan_id,
						$this->income_date 		    => date('Y-m-d', strtotime($this->input->post($this->income_date)[$i])),
						$this->business_profit 		=> $this->input->post($this->business_profit)[$i],
						$this->transport_cost 		=> $this->input->post($this->transport_cost)[$i],
						$this->repair_cost 			=> $this->input->post($this->repair_cost)[$i],
						$this->profit_before_tax 	=> $this->input->post($this->profit_before_tax)[$i],
						$this->income_after_tax 	=> $this->input->post($this->income_after_tax)[$i],
						$this->business_cost 		=> $this->input->post($this->business_cost)[$i],
						$this->other_profit 		=> $this->input->post($this->other_profit)[$i],
						$this->total_profit 		=> $this->input->post($this->total_profit)[$i],
						$this->electric_water_expend=> $this->input->post($this->electric_water_expend)[$i],
						$this->salary_food_expend 	=> $this->input->post($this->salary_food_expend)[$i],
						$this->rent_house_expend 	=> $this->input->post($this->rent_house_expend)[$i],
						$this->insurance_expend 	=> $this->input->post($this->insurance_expend)[$i],
						$this->advertise_expend 	=> $this->input->post($this->advertise_expend)[$i],
						$this->loan_expend 			=> $this->input->post($this->loan_expend)[$i],
						$this->tax_expend 			=> $this->input->post($this->tax_expend)[$i],
						$this->others_expend 		=> $this->input->post($this->others_expend)[$i],
						$this->total_expend 		=> $this->input->post($this->total_expend)[$i],
						$this->status    	  	    => (int) 1,
						$this->createdBy 	  	    => (int) $this->user->info->ID,
						$this->createdAt 	  	    => date("Y-m-d H:i:s")));
					}
				}
			}

			/* create new personal income expend */
			/*$this->db->insert($this->tblPersonalIncomeExpend, array(
				$this->customer_id 	  		     => $customer_id,
				$this->personal_profit 		     => $this->input->post($this->personal_profit),
				$this->personal_income_salary    => $this->input->post($this->personal_income_salary),
				$this->personal_other_profit 	 => $this->input->post($this->personal_other_profit),
				$this->total_income 			 => $this->input->post($this->total_income),
				$this->personal_food_expend 	 => $this->input->post($this->personal_food_expend),
				$this->personal_clothes_expend   => $this->input->post($this->personal_clothes_expend),
				$this->personal_media_expend 	 => $this->input->post($this->personal_media_expend),
				$this->personal_insurance_expend => $this->input->post($this->personal_insurance_expend),
				$this->personal_electric_expend  => $this->input->post($this->personal_electric_expend),
				$this->personal_repare_expend    => $this->input->post($this->personal_repare_expend),
				$this->personal_other_expend 	 => $this->input->post($this->personal_other_expend),
				$this->possibility_pay 		     => $this->input->post($this->possibility_pay),
				$this->personal_total_expend 	 => $this->input->post($this->personal_total_expend),
				$this->status    	  	         => (int) 1,
				$this->createdBy 	  	         => (int) $this->user->info->ID,
				$this->createdAt 	  	         => date("Y-m-d H:i:s"))
			);

			/* upload identificatin files */
	        $filePath    = '/loan_files/customers/CU001/identification';
	        $inputFile   = 'identification_files';
	        $fileRemoved = 'identification_files_deleted';
	        $fileCatch   = 'identification_files_catch';
	        $fileUpload  = $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved, $fileCatch);
	        if(!empty($fileUpload)){
	            foreach ($fileUpload as $file) {
	                $this->db->insert($this->tblIdentificationFiles, array(
	                // "customer_id"     => $customer_id,
	                "customer_id"     => 1,
	                "upload_file_name"=> $file['upload_file_name'],
	                "original_name"   => $file['original_name'],
	                "file_type"       => $file['file_type'],
	                "extension"       => $file['extension'],
	                "file_size"       => $file['file_size'],
	                "file_path"       => $file['file_path'],
	                "timestamp"       => $file['timestamp'],
	                "status"          => (int) 1,
	                "created_by"      => (int) $this->user->info->ID,
	            	"created_at" 	  => date("Y-m-d H:i:s"),
	            	"description"     => $this->input->post('iden_file_description')));
	            }
	        }
		/*}
		return $customer_id;*/	
	}

	function update($id)
	{
		$data = array(
			$this->productCode     => $this->input->post($this->productCode),
			$this->nameEN     	   => $this->input->post($this->nameEN),
			$this->nameKH     	   => $this->input->post($this->nameKH),
			$this->interestID      => (int) $this->input->post($this->interestID),
			$this->ruleDetailID    => (int) $this->input->post($this->ruleDetailID),
			$this->currency        => (int) $this->input->post($this->currency),
			$this->minAge          => (int) $this->input->post($this->minAge),
			$this->maxAge          => (int) $this->input->post($this->maxAge),
			$this->minReduceAmount => (float) $this->input->post($this->minReduceAmount),
			$this->status    	   => (int) $this->input->post('status'),
			$this->updatedBy 	   => $this->user->info->ID,
			$this->updatedAt 	   => date("Y-m-d H:i:s")
		);
		$this->db
		     ->where($this->id, $id)
		     ->update($this->table, $data);
			 return $this->db->affected_rows();
	}

	function findAll(){
		$result = $this->db
					   ->order_by($this->id, 'DESC')
					   ->get($this->table);
		return $result->result();
	}

	function count(){
		$total = array();
		$total['all'] = $this->db->count_all($this->table);

		// count status active
		$total['active'] =  $this->db
								 ->where($this->status, 1)
								 ->from($this->table)
								 ->count_all_results();

		// count status in-active
		$total['inactive'] =  $this->db
								   ->where($this->status, 0)
								   ->from($this->table)
								   ->count_all_results();
		return $total;
	}

	function deleteById($id){
		$this->db
			 ->where($this->id, $id)
			 ->delete($this->table);
			 return $this->db->affected_rows();
	}

	function findOne($id){
		return $this->db
					->where($this->id, $id)
					->get($this->table)
					->row();
	}

	function findAllFilter($filter){
        return $this->db->select('*')
                 ->where('status', $filter)
                 ->get($this->table)
                 ->result();
    }

    /** 
      *-------------------------------
      * ADD ON
      *-------------------------------
      */
    function findSectorActive(){
		return $this->db
					->where($this->status, 1)
					->get($this->tblSector)
					->result();
	}
	function findIndustryActive(){
		return $this->db
					->where($this->status, 1)
					->get($this->tblIndustry)
					->result();
	}
	function findIndustryBySectorID($sector){
		return $this->db
					->where($this->status, 1)
					->where('sector_id', $sector)
					->get($this->tblIndustry)
					->result();
	}
	function findIdentificationTypeActive(){
		return $this->db
					->where($this->status, 1)
					->get($this->tblIdentificationType)
					->result();
	}
	function findBusinessTypeActive(){
		return $this->db
					->where($this->status, 1)
					->get($this->tblBusinessType)
					->result();
	}
	function findBusinessLocationStatusActive(){
		return $this->db
					->where($this->status, 1)
					->get($this->tblBusinessLocationStatus)
					->result();
	}
	function findBusinessFormatActive(){
		return $this->db
					->where($this->status, 1)
					->get($this->tblBusinessFormat)
					->result();
	}
	function findBusinessStatusActive(){
		return $this->db
					->where($this->status, 1)
					->get($this->tblBusinessStatus)
					->result();
	}

	function checkValidCode($id, $code){
		return $this->db
				 ->where($this->id.' !=', $id)
				 ->where($this->productCode, $code)
				 ->get($this->table)
				 ->result();
	}

	function checkValidNameEN($id, $param){
		return $this->db
				 ->where($this->id.' !=', $id)
				 ->where($this->nameEN, $param)
				 ->get($this->table)
				 ->result();
	}

	function checkValidNameKH($id, $param){
		return $this->db
				 ->where($this->id.' !=', $id)
				 ->where($this->nameKH, $param)
				 ->get($this->table)
				 ->result();
	}
}

?>