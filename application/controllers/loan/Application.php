<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/** 
 *------------------------------------------------------
 * @author: khaing.pho1991@gmail.com
 * @param: 10/July/2020
 * @param: controller for manager application infomation 
 *------------------------------------------------------
 */
class Application extends CI_Controller
{
    /* GLOBAL VARAIBLE */
    private $data       = array();
    private $page       = "loan/application/";
    private $link       = "loan/application";
    private $title      = "Loan Application";
    private $moduleName = "loan/application";

    /** 
      *------------------------------------------
      * DEFAULT CONSTRUTOR OF application CONTROLLER
      *------------------------------------------
      */
    public function __construct()
    {
        parent::__construct();
        if (!$this->user->loggedin) redirect('login');
        $this->authorization->hasAccess($this->moduleName);

        $this->load->model('loan/ApplicationModel', 'applicationModel');
        $this->load->helper(array('loan', 'address', 'currency'));

        /** 
         *------------------------------
         * SET VALUE TO GLOBAL VARAIBLE
         *------------------------------
         */
        
        $this->data['title']      = $this->title;
        $this->data['link']       = $this->link;
        $this->data['status']     = $this->applicationModel->count();
        $this->data['moduleName'] = $this->moduleName;
    }

    /** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 05/July/2020
      * @param: method for validation form
      *----------------------------------------------------------------
      */
    public function is_validated()
    {
        $this->form_validation->set_rules('customer_id', lang('customer_id'), 'trim|required');
        $this->form_validation->set_rules('application_date', lang('application_date'), 'trim|required');
        $this->form_validation->set_rules('currency', lang('currency'), 'trim|required|callback_checkCurrency');
        $this->form_validation->set_rules('applied_amount', lang('applied_amount'), 'trim|required|min_length[1]|numeric|callback_checkAppliedAmount');
        $this->form_validation->set_rules('loan_amount', lang('loan_amount'), 'trim|required|min_length[1]|numeric|callback_checkLoanAmount');
        $this->form_validation->set_rules('term', lang('term'), 'trim|required|min_length[1]|numeric|callback_checkTerm');
        $this->form_validation->set_rules('installment', lang('installment'), 'trim|required|min_length[1]|numeric');
        $this->form_validation->set_rules('cycle', lang('cycle'), 'trim|required|min_length[1]|numeric');
        $this->form_validation->set_rules('loan_product', lang('loan_product'), 'trim|required');
        $this->form_validation->set_rules('frequency_type', lang('frequency_type'), 'trim|required');
        $this->form_validation->set_rules('interest_rate', lang('interest_rate'), 'trim|required|min_length[1]|numeric|callback_checkInterestRate');
        $this->form_validation->set_rules('loan_purpose', lang('loan_purpose'), 'trim|required');
        $this->form_validation->set_rules('loan_purpose_type', lang('loan_purpose_type'), 'trim|required');
        $this->form_validation->set_rules('frequency', lang('frequency'), 'trim|required|min_length[1]|numeric');
        $this->form_validation->set_rules('officer', lang('officer'), 'trim|required');
        $this->form_validation->set_rules('branch', lang('branch'), 'trim|required');

        if($this->form_validation->run() == false){
            return false;
        }else{
            return true;
        }
    }

    /**
     *----------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 21/March/2020
     * @param: method for find loan product
     *----------------------------------------------------------------
     */
    private function loanProducts($product_id=null){
        $ci=& get_instance();
        $ci->load->database();
        $product_id = $ci->input->post('loan_product');

        return $ci->db->select('loan_rule_detail.min_amount, 
            loan_rule_detail.max_amount, 
            loan_rule_detail.min_term, 
            loan_rule_detail.max_term, 
            loan_rule_detail.min_fee, 
            loan_rule_detail.max_fee, 
            loan_rule_detail.currency, 
            loan_product.min_age, 
            loan_product.max_age,
            loan_interest_rate.rate_amount')
            // loan_product.FWDBWDKey
            ->join('loan_rule_detail', 'loan_rule_detail.id = loan_product.ruledetail_id', 'left')
            ->join('loan_interest_rate', 'loan_interest_rate.id = loan_product.interest_id', 'left')
            ->where('loan_product.id', $product_id)
            ->get('loan_product')
            ->row();
    }

    /**
     *----------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 26/August/2020
     * @param: method for check currency with loan product
     *----------------------------------------------------------------
     */
    public function checkCurrency($currency){
        $product = $this->loanProducts();
        if ($product) {
            if($currency != $product->currency){
                $this->form_validation->set_message("checkCurrency", "This {field} can not use with below loan product.");
                return false;
            }else{
                return true;
            }          
        } else {
            return true;
        }
    }

    /**
     *----------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 26/August/2020
     * @param: method for check applied amount with loan product
     *----------------------------------------------------------------
     */
    public function checkAppliedAmount($applied_amount){
        $product = $this->loanProducts();
        if ($product) {
            if($applied_amount < $product->min_amount || $applied_amount > $product->max_amount)
            {
                $this->form_validation->set_message('checkAppliedAmount', 'The {field} must be min '.currency_format($product->currency, $product->min_amount).' and max '.currency_format($product->currency, $product->max_amount).'!');
                return false;
            }else{
                return true;
            }          
        } else {
            return true;
        }
    }

    /**
     *----------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 26/August/2020
     * @param: method for check loan amount with loan product
     *----------------------------------------------------------------
     */
    public function checkLoanAmount($amount){
        $product = $this->loanProducts();
        if ($product) {
            if($amount < $product->min_amount || $amount > $product->max_amount)
            {
                $this->form_validation->set_message('checkLoanAmount', 'The {field} must be min '.currency_format($product->currency, $product->min_amount).' and max '.currency_format($product->currency, $product->max_amount).'!');
                return false;
            }else{
                return true;
            }          
        } else {
            return true;
        }
    }

    /**
     *----------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 26/August/2020
     * @param: method for check term with loan product
     *----------------------------------------------------------------
     */
    public function checkTerm($term){
        $product = $this->loanProducts();
        if ($product) {
            if($term < $product->min_term || $term > $product->max_term)
            {
                $this->form_validation->set_message('checkTerm', 'The {field} must be min '.$product->min_term.' months and max '.$product->max_term.' months!');
                return false;
            }else{
                return true;
            }          
        } else {
            return true;
        }
    }

    /**
     *----------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 26/August/2020
     * @param: method for check interest rate with loan product
     *----------------------------------------------------------------
     */
    public function checkInterestRate($rate){
        $product = $this->loanProducts();
        if ($product) {
            if($rate > $product->rate_amount){
                $this->form_validation->set_message('checkInterestRate', 'This {field} can not bigger than '.$product->rate_amount.'% a year.');
                return false;
            }else{
                return true;
            }          
        } else {
            return true;
        }
    }

    public function index()
    {
        if ($this->authorization->hasPermission($this->moduleName, "list")) {
            $this->data['data'] = $this->applicationModel->findAll();
            $this->template->loadContent($this->page . "list", $this->data);
        }
    }

    /**
     *----------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 21/March/2020
     * @param: method for open form create application
     *----------------------------------------------------------------
     */
    public function add()
    {
        if ($this->authorization->hasPermission($this->moduleName, "create")){
            $this->data['customers'] = findCustomerActive();
            $this->data['guarantors'] = $this->applicationModel->findGuarantor();
            $this->data['loanProducts'] = findLoanProductActive();
            $this->data['loanProducts'] = findLoanProductActive();
            $this->data['loanPurposeType'] = findLoanPurposeTypeActive();
            $this->data['loanPurpose'] = findLoanPurposeActive();
            $this->data['relations'] = $this->applicationModel->findRelationIndecator();
            $this->data['loanFee'] = $this->applicationModel->findLoanFeeActive();
            /* unset session catch_files */
            $this->session->unset_userdata('attachment_files_catch');
            $this->template->loadContent($this->page . "add", $this->data);
        }
    }

    /**
     *----------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 21/March/2020
     * @param: method for create new application info
     *----------------------------------------------------------------
     */
    public function create()
    {
        if ($this->authorization->hasPermission($this->moduleName, "create")) {
			if ($this->is_validated()) 
            {
                /* validation true and create new application info */
                    $output = $this->applicationModel->create();
                    if ($output) {                       
                        $this->session->set_flashdata("success", "Congratulation, Record has been saved successfully!");
                    }else{
                        $this->session->set_flashdata("error", "Faile, something went wrong!");
                    }
                redirect(site_url($this->link));
            } else {
                /* store catch attachemtn files while validation form error */
                $inputFile = 'attachment_files';
                if (isset($_FILES[$inputFile]) && $_FILES[$inputFile]['name'][0] != '') {
                    $filePath    = '/catch_file/loan_applications';
                    $fileRemoved = 'attachment_files_deleted';
                    $catchName   = 'attachment_files_catch';
                    $this->session->set_userdata($catchName, $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved));
                }
                /* validation false */
                $this->data['customers'] = findCustomerActive();
                $this->data['guarantors'] = $this->applicationModel->findGuarantor();
                $this->data['loanProducts'] = findLoanProductActive();
                $this->data['loanProducts'] = findLoanProductActive();
                $this->data['loanPurposeType'] = findLoanPurposeTypeActive();
                $this->data['loanPurpose'] = findLoanPurposeActive();
                $this->data['relations'] = $this->applicationModel->findRelationIndecator();
                $this->data['loanFee'] = $this->applicationModel->findLoanFeeActive();
                $this->template->loadContent($this->page . "add", $this->data);
            }
        }
    }


    /**
     *----------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 21/March/2020
     * @param: method for open form edit application
     *----------------------------------------------------------------
     */
    public function edit()
    {
        if ($this->authorization->hasPermission($this->moduleName, "update")) {
            if (isset($_GET['id'])) {
                if ($_GET['id'] != "" && $_GET['id'] != "") {
                    $this->data['customers'] = findCustomerActive();
                    $this->data['guarantors'] = $this->applicationModel->findGuarantor();
                    $this->data['loanProducts'] = findLoanProductActive();
                    $this->data['loanPurposeType'] = findLoanPurposeTypeActive();
                    $this->data['loanPurpose'] = findLoanPurposeActive();
                    $this->data['relations'] = $this->applicationModel->findRelationIndecator();
                    $this->data['loanFee'] = $this->applicationModel->findLoanFeeActive();
                    $this->data['data'] = $this->applicationModel->findOne($_GET['id']);
                    $this->data['coborrowers'] = $this->applicationModel->findCoborrowerByAppID($_GET['id']);
                    $this->data['loanGuarantors'] = $this->applicationModel->findGuarantorByAppID($_GET['id']);
                    $this->data['loanCharges'] = $this->applicationModel->findChargeByAppID($_GET['id']); 
                    $this->data['loanSecurity'] = $this->applicationModel->findSecurityByAppID($_GET['id']); 
                    $this->data['attachments'] = $this->applicationModel->findLoanAppFilesByAppID($_GET['id']); 
                    /* unset session catch_files */
                    $this->session->unset_userdata('attachment_files_catch');
                    $this->template->loadContent($this->page . "edit", $this->data);
                }
            }
        }
    }

    /**
     *----------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 21/March/2020
     * @param: method for submit update application info
     *----------------------------------------------------------------
     */
    public function update()
    {
        if ($this->authorization->hasPermission($this->moduleName, "update")) {
            if (isset($_GET['id'])) {
                if ($_GET['id'] != "" && $_GET['id'] != "") {
                    
                    if ($this->is_validated()) 
                    {
                        /* validation true and update application info */
                            $output = $this->applicationModel->update($_GET['id']);
                            if ($output) {
                                $this->session->set_flashdata("success", "Congratulation, Record has been updated successfully!");
                            } else {
                                $this->session->set_flashdata("error", "Faile, something went wrong!");
                                $this->template->loadContent($this->page . "edit", $this->data);
                            }
                        redirect(site_url($this->link));
                    }else {
                        /* store catch attachemtn files while validation form error */
                        $inputFile = 'attachment_files';
                        if (isset($_FILES[$inputFile]) && $_FILES[$inputFile]['name'][0] != '') {
                            $filePath    = '/catch_file/loan_applications';
                            $fileRemoved = 'attachment_files_deleted';
                            $catchName   = 'attachment_files_catch';
                            $this->session->set_userdata($catchName, $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved));
                        }
                        /* validation false */
                        $this->data['customers'] = findCustomerActive();
                        $this->data['guarantors'] = $this->applicationModel->findGuarantor();
                        $this->data['loanProducts'] = findLoanProductActive();
                        $this->data['loanPurposeType'] = findLoanPurposeTypeActive();
                        $this->data['loanPurpose'] = findLoanPurposeActive();
                        $this->data['relations'] = $this->applicationModel->findRelationIndecator();
                        $this->data['loanFee'] = $this->applicationModel->findLoanFeeActive();
                        $this->data['data'] = $this->applicationModel->findOne($_GET['id']);
                        $this->data['coborrowers'] = $this->applicationModel->findCoborrowerByAppID($_GET['id']);         
                        $this->data['loanGuarantors'] = $this->applicationModel->findGuarantorByAppID($_GET['id']);                  
                        $this->data['loanCharges'] = $this->applicationModel->findChargeByAppID($_GET['id']); 
                        $this->data['loanSecurity'] = $this->applicationModel->findSecurityByAppID($_GET['id']);                  
                        $this->template->loadContent($this->page . "edit", $this->data);
                    }
                }
            }
        }
    }

    /**
     *----------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 21/March/2020
     * @param: method for submit delete application
     *----------------------------------------------------------------
     */
    public function delete()
    {
        if ($this->authorization->hasPermission($this->moduleName, "delete")) {
            if (isset($_GET['id'])) {
                if ($_GET['id'] != "" && $_GET['id'] != "") {
                    $output = $this->applicationModel->deleteById($_GET['id']);
                    if ($output) {
                        /* update application history */
                        $this->applicationModel->updateHistory($_GET['id']);
                        $this->session->set_flashdata("success", "Congratulation, Record has been deleted successfully!");
                    } else {
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
     * @param: method for view application
     *----------------------------------------------------------------
     */
    public function view()
    {
        if ($this->authorization->hasPermission($this->moduleName, "view")) {
            if (isset($_GET['id'])) {
                if ($_GET['id'] != "" && $_GET['id'] != "") {
                    $this->data['customers'] = findCustomerActive();
                    $this->data['guarantors'] = $this->applicationModel->findGuarantor();
                    $this->data['loanProducts'] = findLoanProductActive();
                    $this->data['loanPurposeType'] = findLoanPurposeTypeActive();
                    $this->data['loanPurpose'] = findLoanPurposeActive();
                    $this->data['relations'] = $this->applicationModel->findRelationIndecator();
                    $this->data['loanFee'] = $this->applicationModel->findLoanFeeActive();
                    $this->data['data'] = $this->applicationModel->findOne($_GET['id']);
                    $this->data['coborrowers'] = $this->applicationModel->findCoborrowerByAppID($_GET['id']);
                    $this->data['loanGuarantors'] = $this->applicationModel->findGuarantorByAppID($_GET['id']);
                    $this->data['loanCharges'] = $this->applicationModel->findChargeByAppID($_GET['id']); 
                    $this->data['loanSecurity'] = $this->applicationModel->findSecurityByAppID($_GET['id']); 
                    $this->data['attachments'] = $this->applicationModel->findLoanAppFilesByAppID($_GET['id']); 
                    $this->template->loadContent($this->page . "view", $this->data);
                }
            }
        }
    }

    /** 
      *----------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 12/March/2020
      * @param: method for authorize form
      *----------------------------------------------------
      */
    public function authorize($recordID = null)
    {   
        if($this->applicationModel->authorize($recordID))
        {         
            $this->session->set_flashdata("success", "Congratulation, transaction successful!");
            redirect(site_url($this->link));
        }else{
            $this->session->set_flashdata("error", "Fail, something was wrong. Please try again!");
            redirect(site_url($this->link).'/view?id='.$recordID);
        }
    }

    /**
     *------------------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 12/March/2020
     * @param: method for get currency sign
     *------------------------------------------------------------------------
     */
    public function getCurrnecySign($id)
    {
        $ci=& get_instance();
        $ci->load->database();
        $output = $ci->db->select('currency_code')
              ->where('id', $id)
              ->get('loan_currency')
              ->row();
        if(!empty($output)){
           echo $output->currency_code;
        }else{
          echo null;
        } 
    }

    /**
     *------------------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 12/March/2020
     * @param: method for get get collateral by customer id
     *------------------------------------------------------------------------
     */
    public function getCollateralByCustomerID($customer_id)
    {
        $ci=& get_instance();
        $ci->load->database();
        $output = $ci->db->select('id, collateral_id, owner_name')
              ->where('customer_id', $customer_id)
              ->get('loan_collateral')
              ->result();    
        if(!empty($output)){
            foreach ($output as $key => $value) {
                echo '<option value="'.$value->id.'">'.$value->collateral_id.' - '.$value->owner_name.'</option>';
            }
        }else{
            echo false;
        }    
    }

    /**
     *------------------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 12/March/2020
     * @param: method for find spouse by customer id
     *------------------------------------------------------------------------
     */
    public function findSpouseByCustomerID($customer_id)
    {
        $ci=& get_instance();
        $ci->load->database();
        $output = $ci->db
                ->select('loan_spouse.*,loan_identification_type.name_kh as iden_name_kh,loan_nationality.name_kh as nation_name_kh')
                ->where('customer_id', $customer_id)
                ->join('loan_identification_type', 'loan_spouse.spouse_id_type=loan_identification_type.id','inner')
                ->join('loan_nationality', 'loan_spouse.spouse_nationality=loan_nationality.id','inner')
                ->get('loan_spouse')
                ->row();    
        echo json_encode($output);   
    }

    /**
     *------------------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 12/March/2020
     * @param: method for find identification by customer id
     *------------------------------------------------------------------------
     */
    public function findIdentificationByCustomerID($customer_id)
    {
        $ci=& get_instance();
        $ci->load->database();
        $output = $ci->db
                ->select('loan_identification.*,loan_identification_type.name_kh as iden_name_kh')
                ->where('customer_id', $customer_id)
                ->join('loan_identification_type', 'loan_identification.identification_type=loan_identification_type.id','inner')
                ->get('loan_identification')
                ->result();    
        echo json_encode($output);   
    }

    /**
     *------------------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 12/March/2020
     * @param: method for find contact address by customer id
     *------------------------------------------------------------------------
     */
    public function findContactByCustomerID($customer_id)
    {
        $ci=& get_instance();
        $ci->load->database();
        $output = $ci->db
                ->select('loan_customer_contact.*,
                    loan_country.name_kh as country_name_kh,
                    loan_province.name_kh as province_name_kh,
                    loan_district.name_kh as district_name_kh,
                    loan_commune.name_kh as commune_name_kh,
                    loan_village.name_kh as village_name_kh')
                ->where('customer_id', $customer_id)
                ->join('loan_country', 'loan_customer_contact.country_id=loan_country.id','inner')
                ->join('loan_province', 'loan_customer_contact.province_id=loan_province.id','inner')
                ->join('loan_district', 'loan_customer_contact.district_id=loan_district.id','inner')
                ->join('loan_commune', 'loan_customer_contact.commune_id=loan_commune.id','inner')
                ->join('loan_village', 'loan_customer_contact.village_id=loan_village.id','inner')
                ->get('loan_customer_contact')
                ->result();    
        echo json_encode($output);   
    }

    /**
     *------------------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 12/March/2020
     * @param: method for find contact address by customer id
     *------------------------------------------------------------------------
     */
    public function findEmploymentByCustomerID($customer_id)
    {
        $ci=& get_instance();
        $ci->load->database();
        $output = $ci->db
                ->select('loan_employment_detail.*,
                    loan_country.name_kh as country_name_kh,
                    loan_province.name_kh as province_name_kh,
                    loan_district.name_kh as district_name_kh,
                    loan_commune.name_kh as commune_name_kh,
                    loan_village.name_kh as village_name_kh,
                    loan_business_type.name_kh as business_type_name_kh,
                    loan_currency.name_kh as currency_name_kh,
                    loan_currency.currency_code as currency_code')
                ->where('customer_id', $customer_id)
                ->join('loan_country', 'loan_employment_detail.employer_country=loan_country.id','inner')
                ->join('loan_province', 'loan_employment_detail.employer_province=loan_province.id','inner')
                ->join('loan_district', 'loan_employment_detail.employer_district=loan_district.id','inner')
                ->join('loan_commune', 'loan_employment_detail.employer_commune=loan_commune.id','inner')
                ->join('loan_village', 'loan_employment_detail.employer_village=loan_village.id','inner')
                ->join('loan_business_type', 'loan_employment_detail.empbusiness_type_id=loan_business_type.id','inner')
                ->join('loan_currency', 'loan_employment_detail.employee_currency=loan_currency.id','inner')
                ->get('loan_employment_detail')
                ->result();    
        echo json_encode($output);   
    }
}
