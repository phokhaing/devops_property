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
class purchase_order extends CI_Controller
{
    /* GLOBAL VARAIBLE */
    private $data       = array();
    private $page       = "purchase_order/";
    private $link       = "purchase_order";
    private $title      = "purchase_order";
    private $moduleName = "purchase_order";

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

        $this->load->model('PurchaseOrderModel','purchaseOrderModel');
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
        $this->data['status']     = $this->purchaseOrderModel->count();
        $this->data['moduleName'] = $this->moduleName;
    }

    

    public function index()
    {
        if ($this->authorization->hasPermission($this->moduleName, "list")) {
            $this->data['data'] = $this->purchaseOrderModel->findAll();
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
            $this->data['measurements'] = $this->purchaseOrderModel->findMeasurementActive();
            $this->data['projects'] = $this->purchaseOrderModel->findProjectActive();
            $this->data['refno'] = $this->purchaseOrderModel->generate_code();
            $this->data['suppliers'] = $this->purchaseOrderModel->findSupplierActive();
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
		        if ($this->purchaseOrderModel->is_validated()) 
            {
                /* validation true and submit */
                $output = $this->purchaseOrderModel->create();
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
                    $filePath    = '/catch_file/purchase_order';
                    $fileRemoved = 'attachment_files_deleted';
                    $catchName   = 'attachment_files_catch';
                    $this->session->set_userdata($catchName, $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved));
                }
                /* validation false */
                $this->data['measurements'] = $this->purchaseOrderModel->findMeasurementActive();
                $this->data['projects'] = $this->purchaseOrderModel->findProjectActive();
                $this->data['refno'] = $this->purchaseOrderModel->generate_code();
                $this->data['suppliers'] = $this->purchaseOrderModel->findSupplierActive();
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
                    $this->data['items'] = $this->purchaseOrderModel->findItems($_GET['id']);
                    $this->data['data'] = $this->purchaseOrderModel->findOne($_GET['id']);
                    $this->data['measurements'] = $this->purchaseOrderModel->findMeasurementActive();
                    $this->data['attachments'] = $this->purchaseOrderModel->findFiles($_GET['id']); 
                    $this->data['projects'] = $this->purchaseOrderModel->findProjectActive();
                    $this->data['refno'] = $this->purchaseOrderModel->generate_code();
                    $this->data['suppliers'] = $this->purchaseOrderModel->findSupplierActive();
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
                    
                    if ($this->purchaseOrderModel->is_validated()) 
                    {
                        /* validation true and update application info */
                            $output = $this->purchaseOrderModel->update($_GET['id']);
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
                            $filePath    = '/catch_file/purchase_order';
                            $fileRemoved = 'attachment_files_deleted';
                            $catchName   = 'attachment_files_catch';
                            $this->session->set_userdata($catchName, $this->file->uploadLoanFiles($inputFile, $filePath, $fileRemoved));
                        }
                        /* validation false */
                        $this->data['measurements'] = $this->purchaseOrderModel->findMeasurementActive();
                        $this->data['items'] = $this->purchaseOrderModel->findItems($_GET['id']);
                        $this->data['data'] = $this->purchaseOrderModel->findOne($_GET['id']);
                        $this->data['attachments'] = $this->purchaseOrderModel->findFiles($_GET['id']);
                        $this->data['projects'] = $this->purchaseOrderModel->findProjectActive();
                        $this->data['refno'] = $this->purchaseOrderModel->generate_code();      
                        $this->data['suppliers'] = $this->purchaseOrderModel->findSupplierActive();             
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
                    $output = $this->purchaseOrderModel->deleteById($_GET['id']);
                    if ($output) {
                        /* update application history */
                        $this->purchaseOrderModel->updateHistory($_GET['id']);
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
                    $this->data['measurements'] = $this->purchaseOrderModel->findMeasurementActive();
                    $this->data['items'] = $this->purchaseOrderModel->findItems($_GET['id']);
                    $this->data['data'] = $this->purchaseOrderModel->findOne($_GET['id']);
                    $this->data['attachments'] = $this->purchaseOrderModel->findFiles($_GET['id']); 
                    $this->data['suppliers'] = $this->purchaseOrderModel->findSupplierActive();
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
        if($this->purchaseOrderModel->authorize($recordID, $status, $user))
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
              $this->data['measurements'] = $this->purchaseOrderModel->findMeasurementActive();
              $this->data['items'] = $this->purchaseOrderModel->findItems($_GET['id']);
              $this->data['data'] = $this->purchaseOrderModel->findOne($_GET['id']);
              $this->data['attachments'] = $this->purchaseOrderModel->findFiles($_GET['id']); 
              $this->template->loadContent($this->page . "template", $this->data);
          }  
      }
  }

  public function findProjectLocation($project){
    $this->load->database();
    $output = $this->db
          ->select('location')
          ->where('id', $project)
          ->get('project')
          ->row();

      if(!empty($output)){
        echo $output->location;
      }else{
        echo null;
      } 
  }
  public function findSupplierByID($supplier_id){
      $this->load->database();
      $output = $this->db
          ->where('id', $supplier_id)
          ->get('supplier')
          ->row();

      if(!empty($output)){
        echo json_encode($output);
      }
  }
  public function add_supplier(){
    $this->form_validation->set_rules('name', lang('name'), 'trim|required|is_unique[supplier.name]');
    $this->form_validation->set_rules('telephone', lang('telephone'), 'trim|required');
    $this->form_validation->set_rules('status', lang('status'), 'required');

    if($this->form_validation->run() == false){
        echo json_encode($this->form_validation->error_array());
    }else{
        $output = $this->supplierModel->create();
        if ($output){
            $suppliers = $this->purchaseOrderModel->findSupplierActive();
            $option = '<option value="">--- select supplier ---</option>';
            $address = '';
            $contact = '';
            foreach ($suppliers as $row){
                $selected = '';
                if($row->id == $output){
                    $selected = 'selected';
                    $address = $row->address;
                    $contact = $row->telephone;
                }
                $option .= '<option value="'.$row->id.'" '.$selected.'>'.$row->name.'</option>'; 
            }

            $_result = array('true');
            $_result[] = array($option);
            $_result['address'] = $address;
            $_result['contact'] = $contact;
            echo json_encode($_result);
        }else{
            echo json_encode('fail');
        }
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
        echo $this->purchaseOrderModel->generate_code();
    }
    

}
