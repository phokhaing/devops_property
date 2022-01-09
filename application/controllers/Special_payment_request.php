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
class Special_payment_request extends CI_Controller
{
    /* GLOBAL VARAIBLE */
    private $data       = array();
    private $page       = "special_payment_request/";
    private $link       = "special_payment_request";
    private $title      = "special_payment_request";
    private $moduleName = "special_payment_request";

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

        $this->load->model('SpecialPaymentRequestModel','specialPaymentRequestModel');
        $this->load->model('SupplierModel','supplierModel');
        $this->load->helper('accessright');
        $this->load->helper('currency');

        /** 
         *------------------------------
         * SET VALUE TO GLOBAL VARAIBLE
         *------------------------------
         */
        
        $this->data['title']      = $this->title;
        $this->data['link']       = $this->link;
        $this->data['status']     = $this->specialPaymentRequestModel->count();
        $this->data['moduleName'] = $this->moduleName;
    }

    

    public function index()
    {
        if ($this->authorization->hasPermission($this->moduleName, "list")) {
            $this->data['data'] = $this->specialPaymentRequestModel->findAll();
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
            /* unset session catch_files */
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
			      if ($this->specialPaymentRequestModel->is_validated()) 
            {
                /* validation true and submit */
                    $output = $this->specialPaymentRequestModel->create();
                    if ($output) {                       
                        $this->session->set_flashdata("success", "Congratulation, record has been saved successfully!");
                    }else{
                        $this->session->set_flashdata("error", "Faile, something went wrong!");
                    }
                redirect(site_url($this->link));
            } else {
                /* validation false */
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
                    $this->data['data'] = $this->specialPaymentRequestModel->findOne($_GET['id']);
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
                    
                    if ($this->specialPaymentRequestModel->is_validated()) 
                    {
                        /* validation true and update application info */
                            $output = $this->specialPaymentRequestModel->update($_GET['id']);
                            if ($output) {
                                $this->session->set_flashdata("success", "Congratulation, record has been updated successfully!");
                            } else {
                                $this->session->set_flashdata("error", "Faile, something went wrong!");
                                $this->template->loadContent($this->page . "edit", $this->data);
                            }
                        redirect(site_url($this->link));
                    }else {     
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
                    $output = $this->specialPaymentRequestModel->deleteById($_GET['id']);
                    if ($output) {
                        /* update application history */
                        $this->specialPaymentRequestModel->updateHistory($_GET['id']);
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
                    $this->data['data'] = $this->specialPaymentRequestModel->findOne($_GET['id']);
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
        if($this->specialPaymentRequestModel->authorize($recordID, $status, $user))
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
                $this->data['data'] = $this->specialPaymentRequestModel->findOne($_GET['id']);
                $this->template->loadContent($this->page . "template", $this->data);
            }  
        }
    }
    
}
