<?php 
/**
* 
*/
class Position extends CI_Controller
{	

	private $data       = array();
    private $page       = "positions/";
    private $link       = "position";
    private $title      = "position";
    private $moduleName = "position";
	
	function __construct()
	{
		parent::__construct();
		if (!$this->user->loggedin){
            redirect('login');
		}
		$this->load->model('positionModel','positionModel');
		$this->data['title']  = $this->title;
		$this->data['link']   = $this->link;
		$this->data['status'] = $this->positionModel->count();
		$this->data['moduleName'] = strtolower(get_class());
		$this->moduleName = strtolower(get_class());
		$this->authorization->hasAccess($this->moduleName);

	}

	public function index(){
		if($this->authorization->hasPermission($this->moduleName, "list")){
			$this->data['data'] = $this->positionModel->getAll();
			$this->template->loadContent($this->page."list", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form create position
      *----------------------------------------------------------------
      */
	public function add(){
		if($this->authorization->hasPermission($this->moduleName, "create")){
			$this->data['data'] = $this->positionModel->getAll();
			$this->template->loadContent($this->page."add", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit create position
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
			$this->form_validation->set_rules('position_name', lang('position_name_en'), 'trim|required|is_unique[ac_position.position_name]');
			$this->form_validation->set_rules('position_name_kh', lang('position_name_kh'), 'trim|required|is_unique[ac_position.position_name_kh]');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if($this->form_validation->run() == false){
				$this->data['data'] = $this->positionModel->getAll();
				$this->template->loadContent($this->page."add", $this->data);
			}else{

				/** 
		          *-------------------------------
		          * VALIDATION SUCCESS
		          * INSERT DATA
		          *-------------------------------
		          */
				$output = $this->positionModel->create();
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
      * @param: method for open form edit position
      *----------------------------------------------------------------
      */
	public function edit(){
		if($this->authorization->hasPermission($this->moduleName, "update")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
					$this->data['data'] = $this->positionModel->findOne($_GET['id']);
					$this->template->loadContent($this->page."edit", $this->data);
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit update position
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
					$this->form_validation->set_rules('position_name', lang('position_name_en'), 'trim|required|callback_isValidNameEN');
					$this->form_validation->set_rules('position_name_kh', lang('position_name_kh'), 'trim|required|callback_isValidNameKH');
					$this->form_validation->set_rules('status', 'Status', 'required');

					if($this->form_validation->run() == false){
						$this->data['data'] = $this->positionModel->findOne($_GET['id']);
						$this->template->loadContent($this->page."edit", $this->data);
					}else{

						/** 
				          *-------------------------------
				          * VALIDATION SUCCESS
				          * UPDATE position BY ID
				          *-------------------------------
				          */
						$output = $this->positionModel->update($_GET['id']);
						if($output){
							$this->session->set_flashdata("success", "Congratulation, Record has been updated successfully!");
						}else{
							$this->session->set_flashdata("error", "Faile, something went wrong!");
			            	$this->template->loadContent($this->page."edit", $this->data);
						}
			            redirect(site_url("position"));
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
	function isValidNameEN($name){
        $isValid = $this->positionModel->checkValidNameEn($_GET['id'], $name);
        if(empty($isValid)){
            $response = true;
        }else{
        	$this->form_validation->set_rules('position_name', lang('position_name_en'), 'trim|required|is_unique[ac_position.position_name]');
            $this->form_validation->set_message('isValidNameEN',lang('position_name_en').' field must contain a unique value.');
            $response = false;
        }
        return $response;
    }
    function isValidNameKH($name){
        $isValid = $this->positionModel->checkValidNameKh($_GET['id'], $name);
        if(empty($isValid)){
            $response = true;
        }else{
        	$this->form_validation->set_rules('position_name_kh', lang('position_name_kh'), 'trim|required|is_unique[ac_position.position_name_kh]');
            $this->form_validation->set_message('isValidNameEN',lang('position_name_kh').' field must contain a unique value.');
            $response = false;
        }
        return $response;
    }

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit delete position
      *----------------------------------------------------------------
      */
	public function delete()
	{
		if($this->authorization->hasPermission($this->moduleName, "delete")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !="")
	            {
					$output = $this->positionModel->deleteById($_GET['id']);
					if($output){
						$this->session->set_flashdata("success", "Congratulation, Record has been deleted successfully!");
					}else{
						$this->session->set_flashdata("error", "Faile, something went wrong!");
					}
					redirect(site_url("position"));
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for view position
      *----------------------------------------------------------------
      */
	public function view(){
		if($this->authorization->hasPermission($this->moduleName, "view")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
					$this->data['data'] = $this->positionModel->findOne($_GET['id']);
					$this->template->loadContent($this->page."view", $this->data);
				}
			}
		}
	}
	public function chart(){
		if($this->authorization->hasPermission($this->moduleName, "view")){
			$this->template->loadContent($this->page."view-chart", $this->data);
		}
	}

}

 ?>