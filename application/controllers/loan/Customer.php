<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/** 
 *------------------------------------------------------
 * @author: khaing.pho1991@gmail.com
 * @param: 10/July/2020
 * @param: controller for manager customer infomation 
 *------------------------------------------------------
 */
class Customer extends CI_Controller
{
    /* GLOBAL VARAIBLE */
    private $data = array();
    private $page = "loan/customer/";
    private $link = "loan/customer";
    private $title = "loan/customer";
    private $moduleName = "loan/customer";

    /** 
      *------------------------------------------
      * DEFAULT CONSTRUTOR OF CUSTOMER CONTROLLER
      *------------------------------------------
      */
    public function __construct()
    {
        parent::__construct();
        if (!$this->user->loggedin) redirect('login');
        $this->authorization->hasAccess($this->moduleName);

        $this->load->model('loan/CustomerModel', 'customerModel');
        $this->load->helper(array('loan', 'address'));

        /** 
         *----------------------------------------------------------------
         * SET VALUE TO GLOBAL VARAIBLE
         *----------------------------------------------------------------
         */
        $this->data['title']      = $this->title;
        $this->data['link']       = $this->link;
        $this->data['status']     = $this->customerModel->count();
        $this->data['moduleName'] = $this->moduleName;
    }

    public function index()
    {
        if ($this->authorization->hasPermission($this->moduleName, "list")) {
            $this->data['data'] = $this->customerModel->findAll();
            $this->template->loadContent($this->page . "list", $this->data);
        }
    }

    /**
     *----------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 21/March/2020
     * @param: method for open form create customer
     *----------------------------------------------------------------
     */
    public function add()
    {
        if ($this->authorization->hasPermission($this->moduleName, "create")) {
            $this->data['country'] = findCountryActive();
            $this->data['nationality'] = findNationalityActive();
            $this->data['sector'] = $this->customerModel->findSectorActive();
            $this->data['identificationType'] = $this->customerModel->findIdentificationTypeActive();
            $this->data['businessType'] = $this->customerModel->findBusinessTypeActive();
            $this->data['businessLocationStatus'] = $this->customerModel->findBusinessLocationStatusActive();
            $this->data['businessFormat'] = $this->customerModel->findBusinessFormatActive();
            $this->data['businessStatus'] = $this->customerModel->findBusinessStatusActive();
            /* unset session catch_files */
            $this->session->unset_userdata('identification_files_catch');
            $this->session->unset_userdata('attachment_files_catch');
            $this->template->loadContent($this->page . "add", $this->data);
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
        if ($this->authorization->hasPermission($this->moduleName, "create")) {
            $is_valid = $this->customerModel->is_validated();
			if ($is_valid == 'true') 
			{
                /* validation true and create new customer info */
                if(!$this->customerModel->is_existed()){
                    $output = $this->customerModel->create();
                    if ($output) {
                        $this->session->set_flashdata("success", "Congratulation, Record has been saved successfully!");
                    }else{
                        $this->session->set_flashdata("error", "Faile, something went wrong!");
                    }
                }else{
                    $this->session->set_flashdata("error", "Sorry, this customer already existed!");
                }
                redirect(site_url($this->link));
            } else {
                /* store catch identification files while validation form error */
                $inputFile = 'identification_files';
                if (isset($_FILES[$inputFile]) && $_FILES[$inputFile]['name'][0] != '') {
                    $filePath    = '/catch_file/identification';
                    $fileRemoved = 'identification_files_deleted';
                    $catchName   = 'identification_files_catch';
                    $this->session->set_userdata($catchName, $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved));
				}
                /* store catch attachemtn files while validation form error */
                $inputFile = 'attachment_files';
                if (isset($_FILES[$inputFile]) && $_FILES[$inputFile]['name'][0] != '') {
                    $filePath    = '/catch_file/attachment';
                    $fileRemoved = 'attachment_files_deleted';
                    $catchName   = 'attachment_files_catch';
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
                $this->template->loadContent($this->page . "add", $this->data);
            }
        }
    }

    /**
     *----------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 21/March/2020
     * @param: method for open form edit customer
     *----------------------------------------------------------------
     */
    public function edit()
    {
        if ($this->authorization->hasPermission($this->moduleName, "update")) {
            if (isset($_GET['id'])) {
                if ($_GET['id'] != "" && $_GET['id'] != "") {
                    $this->data['country'] = findCountryActive();
                    $this->data['nationality'] = findNationalityActive();
                    $this->data['sector'] = $this->customerModel->findSectorActive();
                    $this->data['identificationType'] = $this->customerModel->findIdentificationTypeActive();
                    $this->data['businessType'] = $this->customerModel->findBusinessTypeActive();
                    $this->data['businessLocationStatus'] = $this->customerModel->findBusinessLocationStatusActive();
                    $this->data['businessFormat'] = $this->customerModel->findBusinessFormatActive();
                    $this->data['businessStatus'] = $this->customerModel->findBusinessStatusActive();

                    $this->data['customer'] = $this->customerModel->findOne($_GET['id']);
                    $this->data['spouse'] = $this->customerModel->findSouseByCustomerID($_GET['id']);
                    $this->data['contacts'] = $this->customerModel->findContactByCustomerID($_GET['id']);
                    $this->data['identifications'] = $this->customerModel->findIdentificationByCustomerID($_GET['id']);
                    $this->data['identificationFiles'] = $this->customerModel->findIdentificationFilesByCustomerID($_GET['id']);
                    $this->data['employments'] = $this->customerModel->findEmploymentByCustomerID($_GET['id']);
                    $this->data['businessPlans'] = $this->customerModel->findBusinessPlanByCustomerID($_GET['id']);
                    $this->data['personalInExs'] = $this->customerModel->findPersonalInExByCustomerID($_GET['id']);
                    $this->data['attachments'] = $this->customerModel->findAttachmentByCustomerID($_GET['id']);

                    /* unset session catch_files */
                    $this->session->unset_userdata('identification_files_catch');
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
     * @param: method for submit update customer info
     *----------------------------------------------------------------
     */
    public function update()
    {
        if ($this->authorization->hasPermission($this->moduleName, "update")) {
            if (isset($_GET['id'])) {
                if ($_GET['id'] != "" && $_GET['id'] != "") {
                    
                    $is_valid = $this->customerModel->is_validated();
                    if ($is_valid == 'true'){
                        /**
                         *-------------------------------
                         * VALIDATION SUCCESS
                         * UPDATE customer BY ID
                         *-------------------------------
                         */
                        $output = $this->customerModel->update($_GET['id']);
                        if ($output) {
                            $this->session->set_flashdata("success", "Congratulation, Record has been updated successfully!");
                        } else {
                            $this->session->set_flashdata("error", "Faile, something went wrong!");
                            $this->template->loadContent($this->page . "edit", $this->data);
                        }
                        redirect(site_url($this->link));
                    }else {

                        /* store catch identification files while validation form error */
                        $inputFile = 'identification_files';
                        if (isset($_FILES[$inputFile]) && $_FILES[$inputFile]['name'][0] != '') {
                            $filePath    = '/catch_file/identification';
                            $fileRemoved = 'identification_files_deleted';
                            $catchName   = 'identification_files_catch';
                            $this->session->set_userdata($catchName, $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved));
                        }
                        /* store catch attachemtn files while validation form error */
                        $inputFile = 'attachment_files';
                        if (isset($_FILES[$inputFile]) && $_FILES[$inputFile]['name'][0] != '') {
                            $filePath    = '/catch_file/attachment';
                            $fileRemoved = 'attachment_files_deleted';
                            $catchName   = 'attachment_files_catch';
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

                        $this->data['customer'] = $this->customerModel->findOne($_GET['id']);
                        $this->data['spouse'] = $this->customerModel->findSouseByCustomerID($_GET['id']);
                        $this->data['contacts'] = $this->customerModel->findContactByCustomerID($_GET['id']);
                        $this->data['identifications'] = $this->customerModel->findIdentificationByCustomerID($_GET['id']);
                        $this->data['employments'] = $this->customerModel->findEmploymentByCustomerID($_GET['id']);
                        $this->data['businessPlans'] = $this->customerModel->findBusinessPlanByCustomerID($_GET['id']);
                        $this->data['personalInExs'] = $this->customerModel->findPersonalInExByCustomerID($_GET['id']);
                        $this->data['attachments'] = $this->customerModel->findAttachmentByCustomerID($_GET['id']);
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
     * @param: method for submit delete customer
     *----------------------------------------------------------------
     */
    public function delete()
    {
        if ($this->authorization->hasPermission($this->moduleName, "delete")) {
            if (isset($_GET['id'])) {
                if ($_GET['id'] != "" && $_GET['id'] != "") {
                    $output = $this->customerModel->deleteById($_GET['id']);
                    if ($output) {
                        /* update customer history */
                        $this->customerModel->updateCustomerHistory($_GET['id']);
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
     * @param: method for view customer
     *----------------------------------------------------------------
     */
    public function view()
    {
        if ($this->authorization->hasPermission($this->moduleName, "view")) {
            if (isset($_GET['id'])) {
                if ($_GET['id'] != "" && $_GET['id'] != "") {
                    $this->data['country'] = findCountryActive();
                    $this->data['nationality'] = findNationalityActive();
                    $this->data['sector'] = $this->customerModel->findSectorActive();
                    $this->data['identificationType'] = $this->customerModel->findIdentificationTypeActive();
                    $this->data['businessType'] = $this->customerModel->findBusinessTypeActive();
                    $this->data['businessLocationStatus'] = $this->customerModel->findBusinessLocationStatusActive();
                    $this->data['businessFormat'] = $this->customerModel->findBusinessFormatActive();
                    $this->data['businessStatus'] = $this->customerModel->findBusinessStatusActive();

                    $this->data['customer'] = $this->customerModel->findOne($_GET['id']);
                    $this->data['spouse'] = $this->customerModel->findSouseByCustomerID($_GET['id']);
                    $this->data['contacts'] = $this->customerModel->findContactByCustomerID($_GET['id']);
                    $this->data['identifications'] = $this->customerModel->findIdentificationByCustomerID($_GET['id']);
                    $this->data['identificationFiles'] = $this->customerModel->findIdentificationFilesByCustomerID($_GET['id']);
                    $this->data['employments'] = $this->customerModel->findEmploymentByCustomerID($_GET['id']);
                    $this->data['businessPlans'] = $this->customerModel->findBusinessPlanByCustomerID($_GET['id']);
                    $this->data['personalInExs'] = $this->customerModel->findPersonalInExByCustomerID($_GET['id']);
                    $this->data['attachments'] = $this->customerModel->findAttachmentByCustomerID($_GET['id']);
                    $this->template->loadContent($this->page . "view", $this->data);
                }
            }
        }
    }

    /**
     *------------------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 12/March/2020
     * @param: method for get industry by sector id
     *------------------------------------------------------------------------
     */
    public function findIndustry($sector = null)
    {
        $output = $this->customerModel->findIndustryBySectorID($sector);
        if (!empty($output)) {
            echo ("<option value=''> --- select industry --- </option>");
            foreach ($output as $list) {
                echo ("<option value='" . $list->id . "'>" . $list->name_en . "</option>");
            }
        } else {
            echo ("<option value=''> No data </option>");
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
}
