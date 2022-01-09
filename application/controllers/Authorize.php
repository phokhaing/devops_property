<?php 
/**
* @author [Pho Khaing] <[<khaing.pho1991@gmail.com]>
* @date 23/June/2020
*/
class authorize extends CI_Controller
{	

	private $data = array();
	private $page = "authorizes/";
	private $title = "authorize";
	private $currentURl = null;	
	private $authorizeName = null;	
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('AuthorizeModel','authorizeModel');
		$this->data['title'] = $this->title;
		$this->data['status'] = $this->authorizeModel->count();
		if (!$this->user->loggedin){
            redirect('login');
		}
		$this->currentURl = site_url('authorize');
		$this->data['moduleName'] = strtolower(get_class());
		$this->moduleName = strtolower(get_class());
		$this->authorization->hasAccess($this->moduleName);
	}

	public function index(){
		if($this->authorization->hasPermission($this->moduleName, "list")){
			$this->data['data'] = $this->authorizeModel->getAll();
			$this->template->loadContent($this->page."list", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form create authorize
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
      * @param: method for submit create authorize
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
			$this->form_validation->set_rules('authorize_name', 'authorize Name', 'trim|required|min_length[2]|max_length[255]|is_unique[authorize.authorize_name]');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if($this->form_validation->run() == false){
				$this->template->loadContent($this->page."add", $this->data);
			}else{

				/** 
		          *-------------------------------
		          * VALIDATION SUCCESS
		          * INSERT authorize
		          *-------------------------------
		          */
				$output = $this->authorizeModel->create();
				if($output){
					$this->session->set_flashdata("success", "Congratulation, Record has been saved successfully!");
				}else{
					$this->session->set_flashdata("error", "Faile, something went wrong!");
	            	$this->template->loadContent($this->page."add", $this->data);
				}
	            redirect($this->currentURl);
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form edit authorize
      *----------------------------------------------------------------
      */
	public function edit(){
		if($this->authorization->hasPermission($this->moduleName, 'update')){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
					$this->data['data'] = $this->authorizeModel->findOne($_GET['id']);
					$this->template->loadContent($this->page."edit", $this->data);
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit update authorize
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
					$this->form_validation->set_rules('authorize_name', 'authorize Name', 'trim|required|min_length[2]|max_length[255]');
					$this->form_validation->set_rules('status', 'Status', 'required');

					if($this->form_validation->run() == false){
						$this->template->loadContent($this->page."edit", $this->data);
					}else{

						/** 
				          *-------------------------------
				          * VALIDATION SUCCESS
				          * UPDATE authorize BY ID
				          *-------------------------------
				          */
						$output = $this->authorizeModel->update($_GET['id']);
						if($output){
							$this->session->set_flashdata("success", "Congratulation, Record has been updated successfully!");
						}else{
							$this->session->set_flashdata("error", "Faile, something went wrong!");
			            	$this->template->loadContent($this->page."edit", $this->data);
						}
			            redirect($this->currentURl);
					}
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit delete authorize
      *----------------------------------------------------------------
      */
	public function delete()
	{
		if($this->authorization->hasPermission($this->moduleName, 'delete')){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !="")
	            {
					$output = $this->authorizeModel->deleteById($_GET['id']);
					if($output){
						$this->session->set_flashdata("success", "Congratulation, Record has been deleted successfully!");
					}else{
						$this->session->set_flashdata("error", "Faile, something went wrong!");
					}
					redirect($this->currentURl);
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for view authorize
      *----------------------------------------------------------------
      */
	public function view(){
		if($this->authorization->hasPermission($this->moduleName, "view")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
					$this->data['data'] = $this->authorizeModel->findOne($_GET['id']);
					$this->template->loadContent($this->page."view", $this->data);
				}
			}
		}
	}
}

 ?>