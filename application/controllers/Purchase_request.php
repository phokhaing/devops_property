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
class Purchase_request extends CI_Controller
{
    /* GLOBAL VARAIBLE */
    private $data       = array();
    private $page       = "purchase_request/";
    private $link       = "purchase_request";
    private $title      = "purchase_request";
    private $moduleName = "purchase_request";

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

        $this->load->model('PurchaseRequestModel','purchaseRequestModel');
        $this->load->helper('accessright');
        $this->load->helper('currency');

        /** 
         *------------------------------
         * SET VALUE TO GLOBAL VARAIBLE
         *------------------------------
         */
        
        $this->data['title']      = $this->title;
        $this->data['link']       = $this->link;
        $this->data['status']     = $this->purchaseRequestModel->count();
        $this->data['moduleName'] = $this->moduleName;
    }

    

    public function index()
    {
        if ($this->authorization->hasPermission($this->moduleName, "list")) {
            $this->data['data'] = $this->purchaseRequestModel->findAll();
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
            $this->data['measurements'] = $this->purchaseRequestModel->findMeasurementActive();
            $this->data['projects'] = $this->purchaseRequestModel->findProjectActive();
            $this->data['refno'] = $this->purchaseRequestModel->generate_code();
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
			      if ($this->purchaseRequestModel->is_validated()) 
            {
                /* validation true and submit */
                    $output = $this->purchaseRequestModel->create();
                    if ($output) {                       
                        $this->session->set_flashdata("success", "Congratulation, record has been saved successfully!");
                    }else{
                        $this->session->set_flashdata("error", "Faile, something went wrong!");
                    }
                redirect(site_url($this->link));
            } else {
                /* store catch attachemtn files while validation form error */
                $inputFile = 'attachment_files';
                if (isset($_FILES[$inputFile]) && $_FILES[$inputFile]['name'][0] != '') {
                    $filePath    = '/catch_file/purchase_request';
                    $fileRemoved = 'attachment_files_deleted';
                    $catchName   = 'attachment_files_catch';
                    $this->session->set_userdata($catchName, $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved));
                }
                /* validation false */
                $this->data['measurements'] = $this->purchaseRequestModel->findMeasurementActive();
                $this->data['projects'] = $this->purchaseRequestModel->findProjectActive();
                $this->data['refno'] = $this->purchaseRequestModel->generate_code();
                $this->template->loadContent($this->page . "add", $this->data);
            }
        }
    }


    /**
     *----------------------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: 21/March/2020
     * @param: method for open form edit flaot advance
     *----------------------------------------------------------------
     */
    public function edit()
    {
        if ($this->authorization->hasPermission($this->moduleName, "update")) {
            if (isset($_GET['id'])) {
                if ($_GET['id'] != "" && $_GET['id'] != "") {
                    $this->data['items'] = $this->purchaseRequestModel->findItems($_GET['id']);
                    $this->data['data'] = $this->purchaseRequestModel->findOne($_GET['id']);
                    $this->data['measurements'] = $this->purchaseRequestModel->findMeasurementActive();
                    $this->data['attachments'] = $this->purchaseRequestModel->findFiles($_GET['id']); 
                    $this->data['projects'] = $this->purchaseRequestModel->findProjectActive();
                    $this->data['refno'] = $this->purchaseRequestModel->generate_code();
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
     * @param: method for submit update float advance info
     *----------------------------------------------------------------
     */
    public function update()
    {
        if ($this->authorization->hasPermission($this->moduleName, "update")) {
            if (isset($_GET['id'])) {
                if ($_GET['id'] != "" && $_GET['id'] != "") {
                    
                    if ($this->purchaseRequestModel->is_validated()) 
                    {
                        /* validation true and update application info */
                            $output = $this->purchaseRequestModel->update($_GET['id']);
                            if ($output) {
                                $this->session->set_flashdata("success", "Congratulation, record has been updated successfully!");
                            } else {
                                $this->session->set_flashdata("error", "Faile, something went wrong!");
                                $this->template->loadContent($this->page . "edit", $this->data);
                            }
                        redirect(site_url($this->link));
                    }else {
                        /* store catch attachemtn files while validation form error */
                        $inputFile = 'attachment_files';
                        if (isset($_FILES[$inputFile]) && $_FILES[$inputFile]['name'][0] != '') {
                            $filePath    = '/catch_file/purchase_request';
                            $fileRemoved = 'attachment_files_deleted';
                            $catchName   = 'attachment_files_catch';
                            $this->session->set_userdata($catchName, $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved));
                        }
                        /* validation false */
                        $this->data['measurements'] = $this->purchaseRequestModel->findMeasurementActive();
                        $this->data['items'] = $this->purchaseRequestModel->findItems($_GET['id']);
                        $this->data['data'] = $this->purchaseRequestModel->findOne($_GET['id']);
                        $this->data['attachments'] = $this->purchaseRequestModel->findFiles($_GET['id']);
                        $this->data['projects'] = $this->purchaseRequestModel->findProjectActive();
                        $this->data['refno'] = $this->purchaseRequestModel->generate_code();                   
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
                    $output = $this->purchaseRequestModel->deleteById($_GET['id']);
                    if ($output) {
                        /* update application history */
                        $this->purchaseRequestModel->updateHistory($_GET['id']);
                        $this->session->set_flashdata("success", "Congratulation, record has been deleted successfully!");
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
                    $this->data['measurements'] = $this->purchaseRequestModel->findMeasurementActive();
                    $this->data['items'] = $this->purchaseRequestModel->findItems($_GET['id']);
                    $this->data['data'] = $this->purchaseRequestModel->findOne($_GET['id']);
                    $this->data['attachments'] = $this->purchaseRequestModel->findFiles($_GET['id']); 
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
    public function authorize($recordID = null, $status = null, $user = null)
    {   
        if($this->purchaseRequestModel->authorize($recordID, $status, $user))
        {         
            $this->session->set_flashdata("success", "Congratulation, transaction successful!");
            redirect(site_url($this->link));
        }else{
            $this->session->set_flashdata("error", "Fail, something was wrong. Please try again!");
            redirect(site_url($this->link).'/view?id='.$recordID);
        }
    }

    /** 
      *----------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 12/March/2020
      * @param: method for print access right request template
      *----------------------------------------------------
      */
    public function print()
    {
        if(isset($_GET['id'])){
            if($_GET['id'] !="" && $_GET['id'] !=""){
                $this->data['measurements'] = $this->purchaseRequestModel->findMeasurementActive();
                $this->data['items'] = $this->purchaseRequestModel->findItems($_GET['id']);
                $this->data['data'] = $this->purchaseRequestModel->findOne($_GET['id']);
                $this->data['attachments'] = $this->purchaseRequestModel->findFiles($_GET['id']); 
                $this->template->loadContent($this->page . "template", $this->data);
            }  
        }
    }

    public function findProjectLocation($project){
      $this->load->database();
      $output = $this->db->select('location')
                      ->where('id', $project)
                      ->get('project')
                      ->row();

      if(!empty($output)){
          echo $output->location;
      }else{
          echo null;
      }
  }

    /**
	 * ------------------------------------------
	 * GENERATE CODE (10 LENGTHS) 
	 * 2 digits of prefix
	 * 2 digits of year
	 * 2 digits of month
	 * 4 degits of sequence
	 * ------------------------------------------
	 */
    public function generateCode(){
        echo $this->purchaseRequestModel->generate_code();
    }
    
}
