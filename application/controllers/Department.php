<?php 
/**
* 
*/
class Department extends CI_Controller
{	

	private $data = array();
	private $page = "departments/";
	private $title = "department";	
	private $moduleName = null;	
	
	function __construct()
	{
		parent::__construct();
		if (!$this->user->loggedin){
            redirect('login');
		}
		$this->load->model('DepartmentModel','departmentModel');
		$this->data['title'] = $this->title;
		$this->data['status'] = $this->departmentModel->count();
		$this->data['moduleName'] = strtolower(get_class());
		$this->moduleName = strtolower(get_class());
		$this->authorization->hasAccess($this->moduleName);

	}

	public function index(){
		if($this->authorization->hasPermission($this->moduleName, "list")){
			$this->data['data'] = $this->departmentModel->getAll();
			$this->template->loadContent($this->page."list", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form create department
      *----------------------------------------------------------------
      */
	public function add(){
		if($this->authorization->hasPermission($this->moduleName, "create")){
			$this->data['data'] = $this->departmentModel->getAll();
			$this->template->loadContent($this->page."add", $this->data);
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit create department
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
			$this->form_validation->set_rules('department_name', 'department Name', 'trim|required|is_unique[ac_department.department_name]');
			$this->form_validation->set_rules('department_name_kh', 'department Name (KH)', 'trim|required|is_unique[ac_department.department_name_kh]');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if($this->form_validation->run() == false){
				$this->data['data'] = $this->departmentModel->getAll();
				$this->template->loadContent($this->page."add", $this->data);
			}else{

				/** 
		          *-------------------------------
		          * VALIDATION SUCCESS
		          * INSERT department
		          *-------------------------------
		          */
				$output = $this->departmentModel->create();
				if($output){
					$this->session->set_flashdata("success", "Congratulation, Record has been saved successfully!");
				}else{
					$this->session->set_flashdata("error", "Faile, something went wrong!");
	            	$this->template->loadContent($this->page."add", $this->data);
				}
	            redirect(site_url("department"));
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for open form edit department
      *----------------------------------------------------------------
      */
	public function edit(){
		if($this->authorization->hasPermission($this->moduleName, "update")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
					$this->data['list'] = $this->departmentModel->getAll();
					$this->data['data'] = $this->departmentModel->findOne($_GET['id']);
					$this->template->loadContent($this->page."edit", $this->data);
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit update department
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
					$this->form_validation->set_rules('department_name', 'department Name', 'trim|required');
					$this->form_validation->set_rules('department_name_kh', 'department Name (KH)', 'trim|required');
					$this->form_validation->set_rules('status', 'Status', 'required');

					if($this->form_validation->run() == false){
						$this->data['list'] = $this->departmentModel->getAll();
						$this->data['data'] = $this->departmentModel->findOne($_GET['id']);
						$this->template->loadContent($this->page."edit", $this->data);
					}else{

						/** 
				          *-------------------------------
				          * VALIDATION SUCCESS
				          * UPDATE department BY ID
				          *-------------------------------
				          */
						$output = $this->departmentModel->update($_GET['id']);
						if($output){
							$this->session->set_flashdata("success", "Congratulation, Record has been updated successfully!");
						}else{
							$this->session->set_flashdata("error", "Faile, something went wrong!");
			            	$this->template->loadContent($this->page."edit", $this->data);
						}
			            redirect(site_url("department"));
					}
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for submit delete department
      *----------------------------------------------------------------
      */
	public function delete()
	{
		if($this->authorization->hasPermission($this->moduleName, "delete")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !="")
	            {
					$output = $this->departmentModel->deleteById($_GET['id']);
					if($output){
						$this->session->set_flashdata("success", "Congratulation, Record has been deleted successfully!");
					}else{
						$this->session->set_flashdata("error", "Faile, something went wrong!");
					}
					redirect(site_url("department"));
				}
			}
		}
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for view department
      *----------------------------------------------------------------
      */
	public function view(){
		if($this->authorization->hasPermission($this->moduleName, "view")){
			if(isset($_GET['id'])){
	            if($_GET['id'] !="" && $_GET['id'] !=""){
					$this->data['data'] = $this->departmentModel->findOne($_GET['id']);
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

	public function listChart(){
		$_data = array();
		$_array = array();
		$list = $this->departmentModel->getAllParent();

		foreach ($list as $value){
			$_data['name'] = $value->department_name;
			$_data['label'] = $value->department_name;

			$children = getDepartmentParent($value->id_department);

			if(!empty($children))
			{
				// child1
				$_data['children'] = $children;
				foreach ($_data['children'] as $key1 => $sub1){
					$child = getDepartmentParent($sub1->id);
					if(!empty($child)){
						$_data['children'][$key1]->children = $child;

						// child2
						foreach ($child as $key2 => $sub2) {
							$child2 = getDepartmentParent($sub2->id);
							if(!empty($child2)){
								$_data['children'][$key1]->children[$key2]->children = $child2;

								// child3
								foreach ($child2 as $key3 => $sub3) {
									$child3 = getDepartmentParent($sub3->id);
									if(!empty($child3)){
										$_data['children'][$key1]->children[$key2]->children[$key3]->children = $child3;

										// child4
										foreach ($child3 as $key4 => $sub4) {
											$child4 = getDepartmentParent($sub4->id);
											if(!empty($child4)){
												$_data['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children = $child4;

												// child5
												foreach ($child4 as $key5 => $sub5) {
													$child5 = getDepartmentParent($sub5->id);
													if(!empty($child5)){
														$_data['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children[$key5]->children = $child5;

														// child6
														foreach ($child5 as $key6 => $sub6) {
															$child6 = getDepartmentParent($sub6->id);
															if(!empty($child6)){
																$_data['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children[$key5]->children[$key6]->children = $child6;

																// child7
																foreach ($child6 as $key7 => $sub7) {
																	$child7 = getDepartmentParent($sub7->id);
																	if(!empty($child7)){
																		$_data['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children[$key5]->children[$key6]->children[$key7]->children = $child7;

																		// child8
																		foreach ($child7 as $key8 => $sub8) {
																			$child8 = getDepartmentParent($sub8->id);
																			if(!empty($child8)){
																				$_data['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children[$key5]->children[$key6]->children[$key7]->children[$key8]->children = $child8;

																				// child9
																				foreach ($child8 as $key9 => $sub9) {
																					$child9 = getDepartmentParent($sub9->id);
																					if(!empty($child9)){
																						$_data['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children[$key5]->children[$key6]->children[$key7]->children[$key8]->children[$key9]->children = $child9;

																							// child10
																							foreach ($child9 as $key10 => $sub10) {
																								$child10 = getDepartmentParent($sub10->id);
																								if(!empty($child10)){
																									$_data['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children[$key5]->children[$key6]->children[$key7]->children[$key8]->children[$key9]->children[$key10]->children = $child10;
																								}
																							}//end child10
																					}
																				}//end child9
																			}
																		}//end child8
																	}
																}//end child7
															}
														}//end child6
													}
												}//end child5
											}
										}//end child4
									}
								}//end child3
							}
						}//end child2
					}
				}//end child1
			}

			$_array[] = $_data;
		}

		// var_dump(json_encode($_array));die();
		echo json_encode($_array);
	}

	public function listOwnChart($id){
		//------------------ array from a-z
		$_data = array();
		$_count = array();
		$_array = array();
		$list = $this->departmentModel->getDepById($id);

		foreach ($list as $value){
			$_data['name'] = $value->department_name;
			$_data['label'] = $value->department_name;
			$count[] = $value->id_department;

			$children = getDepartmentByID($value->parent_id);
			$count[] = $value->parent_id;

			if(!empty($children))
			{
				// child1
				$_data['children'] = $children;
				foreach ($_data['children'] as $key1 => $sub1){
					$child = getDepartmentByID($sub1->id);
					$count[] = $sub1->id;

					if(!empty($child)){
						$_data['children'][$key1]->children = $child;

						// child2
						foreach ($child as $key2 => $sub2) {
							$child2 = getDepartmentByID($sub2->id);
							$count[] = $sub2->id;

							if(!empty($child2)){
								$_data['children'][$key1]->children[$key2]->children = $child2;

								// child3
								foreach ($child2 as $key3 => $sub3) {
									$child3 = getDepartmentByID($sub3->id);
									$count[] = $sub3->id;

									if(!empty($child3)){
										$_data['children'][$key1]->children[$key2]->children[$key3]->children = $child3;

										// child4
										foreach ($child3 as $key4 => $sub4) {
											$child4 = getDepartmentByID($sub4->id);
											$count[] = $sub4->id;

											if(!empty($child4)){
												$_data['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children = $child4;

												// child5
												foreach ($child4 as $key5 => $sub5) {
													$child5 = getDepartmentByID($sub5->id);
													$count[] = $sub5->id;

													if(!empty($child5)){
														$_data['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children[$key5]->children = $child5;

														// child6
														foreach ($child5 as $key6 => $sub6) {
															$child6 = getDepartmentByID($sub6->id);
															$count[] = $sub6->id;

															if(!empty($child6)){
																$_data['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children[$key5]->children[$key6]->children = $child6;

																// child7
																foreach ($child6 as $key7 => $sub7) {
																	$child7 = getDepartmentByID($sub7->id);
																	$count[] = $sub7->id;

																	if(!empty($child7)){
																		$_data['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children[$key5]->children[$key6]->children[$key7]->children = $child7;

																		// child8
																		foreach ($child7 as $key8 => $sub8) {
																			$child8 = getDepartmentByID($sub8->id);
																			$count[] = $sub8->id;

																			if(!empty($child8)){
																				$_data['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children[$key5]->children[$key6]->children[$key7]->children[$key8]->children = $child8;

																				// child9
																				foreach ($child8 as $key9 => $sub9) {
																					$child9 = getDepartmentByID($sub9->id);
																					$count[] = $sub9->id;

																					if(!empty($child9)){
																						$_data['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children[$key5]->children[$key6]->children[$key7]->children[$key8]->children[$key9]->children = $child9;

																							// child10
																							foreach ($child9 as $key10 => $sub10) {
																								$child10 = getDepartmentByID($sub10->id);
																								$count[] = $sub10->id;

																								if(!empty($child10)){
																									$_data['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children[$key5]->children[$key6]->children[$key7]->children[$key8]->children[$key9]->children[$key10]->children = $child10;
																								}
																							}//end child10
																					}
																				}//end child9
																			}
																		}//end child8
																	}
																}//end child7
															}
														}//end child6
													}
												}//end child5
											}
										}//end child4
									}
								}//end child3
							}
						}//end child2
					}
				}//end child1
			}

			$_array[] = $_data;
		}
		
		//------------------ reverse array from z-a
		$_result = array();
		$_output = array();

		$lists_result = array_reverse($count);
		$_repeat = null;
		
		$list = getDepartmentByID($lists_result[1]);
		foreach ($list as $value){
			$_result['name'] = $value->name;
			$_result['label'] = $value->label;

			$children = getDepartmentByID($lists_result[2]);

			if(!empty($children))
			{
				// child1
				$_result['children'] = $children;
				foreach ($_result['children'] as $key1 => $sub1){
					$index=null;
					if(isset($lists_result[1+2])){
						$index = $lists_result[1+2];
					}
					$child = getDepartmentByID($index);

					if(!empty($child)){
						$_result['children'][$key1]->children = $child;

						// child2
						foreach ($child as $key2 => $sub2) {
							$index=null;
							if(isset($lists_result[2+2])){
								$index = $lists_result[2+2];
							}
							$child2 = getDepartmentByID($index);

							if(!empty($child2)){
								$_result['children'][$key1]->children[$key2]->children = $child2;

								// child3
								foreach ($child2 as $key3 => $sub3) {
									$index=null;
									if(isset($lists_result[3+2])){
										$index = $lists_result[3+2];
									}
									$child3 = getDepartmentByID($index);

									if(!empty($child3)){
										$_result['children'][$key1]->children[$key2]->children[$key3]->children = $child3;

										// child4
										foreach ($child3 as $key4 => $sub4) {
											$index=null;
											if(isset($lists_result[4+2])){
												$index = $lists_result[4+2];
											}
											$child4 = getDepartmentByID($index);

											if(!empty($child4)){
												$_result['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children = $child4;

												// child5
												foreach ($child4 as $key5 => $sub5) {
													$index=null;
													if(isset($lists_result[5+2])){
														$index = $lists_result[5+2];
													}
													$child5 = getDepartmentByID($index);

													if(!empty($child5)){
														$_result['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children[$key5]->children = $child5;

														// child6
														foreach ($child5 as $key6 => $sub6) {
															$index=null;
															if(isset($lists_result[6+2])){
																$index = $lists_result[6+2];
															}
															$child6 = getDepartmentByID($index);

															if(!empty($child6)){
																$_result['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children[$key5]->children[$key6]->children = $child6;

																// child7
																foreach ($child6 as $key7 => $sub7) {
																	$index=null;
																	if(isset($lists_result[7+2])){
																		$index = $lists_result[7+2];
																	}
																	$child7 = getDepartmentByID($index);

																	if(!empty($child7)){
																		$_result['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children[$key5]->children[$key6]->children[$key7]->children = $child7;

																		// child8
																		foreach ($child7 as $key8 => $sub8) {
																			$index=null;
																			if(isset($lists_result[8+2])){
																				$index = $lists_result[8+2];
																			}
																			$child8 = getDepartmentByID($index);

																			if(!empty($child8)){
																				$_result['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children[$key5]->children[$key6]->children[$key7]->children[$key8]->children = $child8;

																				// child9
																				foreach ($child8 as $key9 => $sub9) {
																					$index=null;
																					if(isset($lists_result[9+2])){
																						$index = $lists_result[9+2];
																					}
																					$child9 = getDepartmentByID($index);

																					if(!empty($child9)){
																						$_result['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children[$key5]->children[$key6]->children[$key7]->children[$key8]->children[$key9]->children = $child9;

																							// child10
																							foreach ($child9 as $key10 => $sub10) {
																								$index=null;
																								if(isset($lists_result[10+2])){
																									$index = $lists_result[10+2];
																								}
																								$child10 = getDepartmentByID($index);

																								if(!empty($child10)){
																									$_result['children'][$key1]->children[$key2]->children[$key3]->children[$key4]->children[$key5]->children[$key6]->children[$key7]->children[$key8]->children[$key9]->children[$key10]->children = $child10;
																								}
																							}//end child10
																					}
																				}//end child9
																			}
																		}//end child8
																	}
																}//end child7
															}
														}//end child6
													}
												}//end child5
											}
										}//end child4
									}
								}//end child3
							}
						}//end child2
					}
				}//end child1
			}

			$_output[] = $_result;
		}

		echo json_encode($_output);
	}
}

 ?>