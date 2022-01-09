<?php 
/**
* 
*/
class Menu extends CI_Controller
{	

	private $data = array();
	private $page = "menu/";
	private $title = "Menu";
	private $currentURl = null;	
	private $moduleName =  null;	

	
	function __construct()
	{
		parent::__construct();
		if (!$this->user->loggedin){
            redirect('login');
		}
		$this->load->model('MenuModel','menuModel');
		$this->load->model('ModuleModel','moduleModel');
		$this->data['title'] = $this->title;
		$this->data['menuOrderable'] = $this->menuModel->getAllMenuOrderable();
		$this->data['status'] = $this->menuModel->count();
		$this->currentURl = site_url('menu');
		$this->data['moduleName'] = strtolower(get_class());
		$this->moduleName = strtolower(get_class());
		$this->authorization->hasAccess($this->moduleName);

	}

	public function index(){
		if($this->authorization->hasPermission($this->moduleName, "list")){
			$this->data['data'] = $this->menuModel->getAll();
			$this->data['modules'] = $this->moduleModel->getAll();
			$this->data['menuOrderable'] = $this->menuModel->getAllMenuOrderable();
			$this->template->loadContent($this->page."list", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form create menu
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
      * @param: method for submit create menu
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
			$this->form_validation->set_rules('menu_name_en', 'Menu Name (EN)', 'trim|required|min_length[1]|max_length[100]|is_unique[menu.menu_name_en]');
			$this->form_validation->set_rules('menu_name_kh', 'Menu Name (EN)', 'trim|required|min_length[1]|max_length[100]|is_unique[menu.menu_name_kh]');
			$this->form_validation->set_rules('menu_url', 'Menu Link', 'trim|required|min_length[1]|max_length[100]|is_unique[menu.menu_url]');
			$this->form_validation->set_rules('menu_icon', 'Menu Icon', 'trim|required|min_length[1]|max_length[100]');
			$this->form_validation->set_rules('icon_color', 'Icon Color', 'trim|required');
			// $this->form_validation->set_rules('status', 'Active', 'required');

			if($this->form_validation->run() == false){
				$this->template->loadContent($this->page."list", $this->data);
			}else{

				/** 
		          *-------------------------------
		          * VALIDATION SUCCESS
		          * THEN UPDATE MENU
		          * THEN ADD TO MENU ORDERABLE
		          *-------------------------------
		          */
				$output = $this->menuModel->create();

				if($output)
				{
					// add to menu orderable
					$menuItems = $this->menuModel->findMenuOrderable();
		        	if(!empty($menuItems))
		        	{
		        		$addItems = json_decode('[{"id":'.$output.'}]');
						$MenuOrderable = array_merge($addItems, json_decode($menuItems->orderable));
		        		$result = $this->menuModel->updateMenuOrderable($menuItems->id, array('orderable'=> json_encode($MenuOrderable)));
		        		if($result){
		        			echo json_encode($result);
		        		}
		        	}

					$this->session->set_flashdata("success", "Congratulation, Record has been saved successfully!");
				}else{
					$this->session->set_flashdata("error", "Faile, something went wrong!");
	            	$this->template->loadContent($this->page."list", $this->data);
				}
	            redirect($this->currentURl);
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form edit menu
      *----------------------------------------------------------------
      */
	public function edit(){
		if($this->authorization->hasPermission($this->moduleName, "update")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
					$output = $this->menuModel->findOne($_GET['id']);
					echo json_encode($output);
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit update menu
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
					$this->form_validation->set_rules('menu_name_en', 'Menu Name (EN)', 'trim|required|min_length[1]|max_length[100]');
					$this->form_validation->set_rules('menu_name_kh', 'Menu Name (EN)', 'trim|required|min_length[1]|max_length[100]');
					$this->form_validation->set_rules('menu_url', 'Menu Link', 'trim|required|min_length[1]|max_length[100]');
					$this->form_validation->set_rules('menu_icon', 'Menu Icon', 'trim|required|min_length[1]|max_length[100]');
					$this->form_validation->set_rules('icon_color', 'Icon Color', 'trim|required');
					// $this->form_validation->set_rules('status', 'Active', 'required');

					if($this->form_validation->run() == false){
						$this->template->loadContent($this->page."list", $this->data);
					}else{

						/** 
				          *-------------------------------
				          * VALIDATION SUCCESS
				          * THEN UPDATE MENU
				          *-------------------------------
				          */
						$output = $this->menuModel->update($_GET['id']);

						if($output)
						{
							$this->session->set_flashdata("success", "Congratulation, Record has been updated successfully!");
						}else{
							$this->session->set_flashdata("error", "Faile, something went wrong!");
			            	$this->template->loadContent($this->page."list", $this->data);
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
      * @param: method for submit delete menu
      *----------------------------------------------------------------
      */
	public function delete()
	{
		if($this->authorization->hasPermission($this->moduleName, "delete")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !="")
	            {		
	            	$id = $_GET['id'];
					// $output = $this->menuModel->deleteById($_GET['id']);
					// if($output){
					// 	$this->session->set_flashdata("success", "Congratulation, Record has been deleted successfully!");
					// }else{
					// 	$this->session->set_flashdata("error", "Faile, something went wrong!");
					// }

					// add to menu orderable
					$menuItems = $this->menuModel->findMenuOrderable();
		        	if(!empty($menuItems))
		        	{	

		        		$addItems = json_decode('[{"id":'.$_GET['id'].'}]');
		        		$menu = json_decode($menuItems->orderable);

		        		// var_dump($menu);
		        		for ($a=0; $a < count($menu) ; $a++) 
		        		{ 
		        			if($id == $menu[$a]->id){
		        				unset($menu[$a]->id);
		        			}

		        			// sub1
		        			if(isset($menu[$a]->children)){
		        				$sub1 = $menu[$a]->children;
		        				for ($b=0; $b < count($sub1) ; $b++) 
		        				{ 
		        					if($id == $sub1[$b]->id){
				        				// unset($sub1[$b]);
				        				unset($sub1[$b]->id);
				        			}

				        			// sub2
				        			if(isset($sub1[$b]->children)){
				        				$sub2 = $sub1[$b]->children;
				        				for ($c=0; $c < count($sub2) ; $c++) 
				        				{ 
				        					if($id == $sub2[$c]->id){
						        				// unset($sub2[$c]);
						        				unset($sub2[$c]->id);
						        			}

						        			// sub3
						        			if(isset($sub2[$c]->children)){
						        				$sub3 = $sub2[$c]->children;

						        				for ($d=0; $d < count($sub3) ; $d++) 
						        				{ 
						        					if($id == $sub3[$d]->id){
								        				// unset($sub3[$d]);
								        				unset($sub3[$d]->id);
								        			}

								        			// sub4
								        			if(isset($sub3[$d]->children)){
								        				$sub4 = $sub3[$d]->children;
								        				for ($e=0; $e < count($sub4) ; $e++) { 
								        					if($id == $sub4[$e]->id){
										        				// unset($sub4[$e]);
										        				unset($sub4[$e]->id);
										        			}
										        			
								        				}
								        			}
						        				}
						        			}

				        				}
				        			}
		        				}
		        			}	
		        		}	

		        		$result = $this->menuModel->updateMenuOrderable($menuItems->id, array('orderable'=> json_encode($menu)));
		        		if($result){
		        			$this->menuModel->deleteById($id);
		        			$this->session->set_flashdata("success", "Congratulation, Record has been deleted successfully!");
		        			echo json_encode($result);
		        		}else{
		        			$this->session->set_flashdata("error", "Faile, something went wrong!");
		        			echo json_encode($result);
		        		}
		        	}
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for view menu
      *----------------------------------------------------------------
      */
	public function view(){
		if($this->authorization->hasPermission($this->moduleName, "view")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
					$output = $this->menuModel->findOne($_GET['id']);
					echo json_encode($output);
				}
			}
		}
	}

	public function orderMenuItem(){
		if($this->authorization->hasPermission($this->moduleName, "update")){
			if(isset($_GET['menuItems'])){
	            if($_GET['menuItems'] !="" && $_GET['menuItems'] !="")
	            {
	            	$output = $this->menuModel->findMenuOrderable();
	            	if(!empty($output)){
	            		$result = $this->menuModel->updateMenuOrderable($output->id, array('orderable'=> $_GET['menuItems']));
	            		if($result){
	            			echo json_encode($result);
	            		}
	            	}
	            }
	        }
        }
	}
}

 ?>