<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/** 
 *------------------------------------------------------
 * @author: khaing.pho1991@gmail.com
 * @param: 10/July/2020
 * @param: controller for manager collateral infomation 
 *------------------------------------------------------
 */
class Collateral extends CI_Controller
{
    /* GLOBAL VARAIBLE */
    private $data = array();
    private $page = "loan/collateral/";
    private $link = "loan/collateral";
    private $title = "Loan Collateral";
    private $moduleName = "loan/collateral";

    /** 
      *------------------------------------------
      * DEFAULT CONSTRUTOR OF collateral CONTROLLER
      *------------------------------------------
      */
    public function __construct()
    {
        parent::__construct();
        if (!$this->user->loggedin) redirect('login');
        $this->authorization->hasAccess($this->moduleName);

        $this->load->model('loan/CollateralModel', 'collateralModel');
        $this->load->helper(array('loan', 'address'));

        /** 
         *----------------------------------------------------------------
         * SET VALUE TO GLOBAL VARAIBLE
         *----------------------------------------------------------------
         */
        $this->data['title']      = $this->title;
        $this->data['link']       = $this->link;
        $this->data['status']     = $this->collateralModel->count();
        $this->data['moduleName'] = $this->moduleName;
    }

    public function index()
    {
        if ($this->authorization->hasPermission($this->moduleName, "list")) {
            $this->data['data'] = $this->collateralModel->findAll();
            $this->template->loadContent($this->page . "list", $this->data);
        }
    }

    /**
     *----------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 21/March/2020
     * @param: method for open form create collateral
     *----------------------------------------------------------------
     */
    public function add()
    {
        if ($this->authorization->hasPermission($this->moduleName, "create")){
            $this->data['country'] = findCountryActive();
            $this->data['customers'] = findCustomerActive();
            $this->data['relations'] = $this->collateralModel->findRelationIndecator();
            $this->data['collateralTypes'] = $this->collateralModel->findCollateralType();
            /* unset session catch_files */
            $this->session->unset_userdata('attachment_files_catch');
            $this->template->loadContent($this->page . "add", $this->data);
        }
    }

    /**
     *----------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 21/March/2020
     * @param: method for create new collateral info
     *----------------------------------------------------------------
     */
    public function create()
    {
        if ($this->authorization->hasPermission($this->moduleName, "create")) {
			if ($this->collateralModel->is_validated()) 
			{
                /* validation true and create new collateral info */
                    $output = $this->collateralModel->create();
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
                    $filePath    = '/catch_file/attachment';
                    $fileRemoved = 'attachment_files_deleted';
                    $catchName   = 'attachment_files_catch';
                    $this->session->set_userdata($catchName, $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved));
				}
                /* validation false */
                $this->data['country'] = findCountryActive();
                $this->data['customers'] = findCustomerActive();
                $this->data['relations'] = $this->collateralModel->findRelationIndecator();
                $this->data['collateralTypes'] = $this->collateralModel->findCollateralType();
                $this->template->loadContent($this->page . "add", $this->data);
            }
        }
    }


    /**
     *----------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 21/March/2020
     * @param: method for open form edit collateral
     *----------------------------------------------------------------
     */
    public function edit()
    {
        if ($this->authorization->hasPermission($this->moduleName, "update")) {
            if (isset($_GET['id'])) {
                if ($_GET['id'] != "" && $_GET['id'] != "") {
                    $this->data['attachments'] = $this->collateralModel->findAttachmentByCollateralID($_GET['id']);
                    $this->data['country'] = findCountryActive();
                    $this->data['customers'] = findCustomerActive();
                    $this->data['relations'] = $this->collateralModel->findRelationIndecator();
                    $this->data['collateralTypes'] = $this->collateralModel->findCollateralType();
                    $this->data['data'] = $this->collateralModel->findOne($_GET['id']);
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
     * @param: method for submit update collateral info
     *----------------------------------------------------------------
     */
    public function update()
    {
        if ($this->authorization->hasPermission($this->moduleName, "update")) {
            if (isset($_GET['id'])) {
                if ($_GET['id'] != "" && $_GET['id'] != "") {
                    
                    if ($this->collateralModel->is_validated()) 
                    {
                        /* validation true and update collateral info */
                            $output = $this->collateralModel->update($_GET['id']);
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
                            $filePath    = '/catch_file/attachment';
                            $fileRemoved = 'attachment_files_deleted';
                            $catchName   = 'attachment_files_catch';
                            $this->session->set_userdata($catchName, $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved));
                        }
                        /* validation false */
                        $this->data['country'] = findCountryActive();
                        $this->data['customers'] = findCustomerActive();
                        $this->data['relations'] = $this->collateralModel->findRelationIndecator();
                        $this->data['collateralTypes'] = $this->collateralModel->findCollateralType();
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
     * @param: method for submit delete collateral
     *----------------------------------------------------------------
     */
    public function delete()
    {
        if ($this->authorization->hasPermission($this->moduleName, "delete")) {
            if (isset($_GET['id'])) {
                if ($_GET['id'] != "" && $_GET['id'] != "") {
                    $output = $this->collateralModel->deleteById($_GET['id']);
                    if ($output) {
                        /* update collateral history */
                        $this->collateralModel->updateHistory($_GET['id']);
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
     * @param: method for view collateral
     *----------------------------------------------------------------
     */
    public function view()
    {
        if ($this->authorization->hasPermission($this->moduleName, "view")) {
            if (isset($_GET['id'])) {
                if ($_GET['id'] != "" && $_GET['id'] != "") {
                    $this->data['attachments'] = $this->collateralModel->findAttachmentByCollateralID($_GET['id']);
                    $this->data['country'] = findCountryActive();
                    $this->data['customers'] = findCustomerActive();
                    $this->data['relations'] = $this->collateralModel->findRelationIndecator();
                    $this->data['collateralTypes'] = $this->collateralModel->findCollateralType();
                    $this->data['data'] = $this->collateralModel->findOne($_GET['id']);
                    $this->template->loadContent($this->page . "view", $this->data);
                }
            }
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
        $output = $ci->db->select('*')
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
