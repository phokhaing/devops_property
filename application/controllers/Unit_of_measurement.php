<?php 
/**
* 
*/
class Unit_of_measurement extends CI_Controller
{	
	
	private $data = array();
	private $page = "unit_of_measurement/";
	private $link = "unit_of_measurement";
	private $title = "unit_of_measurement";	
	private $moduleName = "unit_of_measurement";	
	
	function __construct()
	{
		parent::__construct();
		if (!$this->user->loggedin){
            redirect('login');
		}
		$this->load->model('UnitOfMeasurementModel','unitOfMeasurementModel');
		$this->data['title'] = $this->title;
		$this->data['link'] = $this->link;
		$this->data['status'] = $this->unitOfMeasurementModel->count();
		$this->data['moduleName'] = $this->moduleName;
		$this->authorization->hasAccess($this->moduleName);
	}

	public function index(){
		if($this->authorization->hasPermission($this->moduleName, "list")){
			$this->data['data'] = $this->unitOfMeasurementModel->findAll();
			$this->template->loadContent($this->page."list", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form create interest
      *----------------------------------------------------------------
      */
	public function add(){
		if($this->authorization->hasPermission($this->moduleName, "create")){
			$this->template->loadContent($this->page."add", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit create interest
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
			$this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[unit_of_measurement.name]');
			$this->form_validation->set_rules('symbol', 'Symbol', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if($this->form_validation->run() == false){
				$this->template->loadContent($this->page."add", $this->data);
			}else{

				/** 
		          *-------------------------------
		          * VALIDATION SUCCESS
		          * INSERT interest
		          *-------------------------------
		          */
				$output = $this->unitOfMeasurementModel->create();
				if($output){
					$this->session->set_flashdata("success", "Congratulation, record has been saved successfully!");
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
      * @param: method for open form edit interest
      *----------------------------------------------------------------
      */
	public function edit(){
		if($this->authorization->hasPermission($this->moduleName, "update")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
					$this->data['data'] = $this->unitOfMeasurementModel->findOne($_GET['id']);
					$this->template->loadContent($this->page."edit", $this->data);
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit update interest
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
					$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_isValidName');
					$this->form_validation->set_rules('symbol', 'Symbol', 'trim|required');
					$this->form_validation->set_rules('status', 'Status', 'required');

					if($this->form_validation->run() == false){
						$this->data['data'] = $this->unitOfMeasurementModel->findOne($_GET['id']);
						$this->template->loadContent($this->page."edit", $this->data);
					}else{

						/** 
				          *-------------------------------
				          * VALIDATION SUCCESS
				          * UPDATE interest BY ID
				          *-------------------------------
				          */
						$output = $this->unitOfMeasurementModel->update($_GET['id']);
						if($output){
							$this->session->set_flashdata("success", "Congratulation, record has been updated successfully!");
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
    function isValidName($project){
        $isValid = $this->unitOfMeasurementModel->checkValidName($_GET['id'], $project);
        if(empty($isValid)){
            $response = true;
        }else{
        	$this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[unit_of_measurement.name]');
            $this->form_validation->set_message('isValidName','Name field must contain a unique value.');
            $response = false;
        }
        return $response;
    }

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit delete interest
      *----------------------------------------------------------------
      */
	public function delete()
	{
		if($this->authorization->hasPermission($this->moduleName, "delete")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !="")
	            {
					$output = $this->unitOfMeasurementModel->deleteById($_GET['id']);
					if($output){
						$this->session->set_flashdata("success", "Congratulation, record has been deleted successfully!");
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
      * @param: method for view interest
      *----------------------------------------------------------------
      */
	public function view(){
		if($this->authorization->hasPermission($this->moduleName, "view")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
					$this->data['data'] = $this->unitOfMeasurementModel->findOne($_GET['id']);
					$this->template->loadContent($this->page."view", $this->data);
				}
			}
		}
	}
}

 ?>