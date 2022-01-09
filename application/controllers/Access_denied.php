<?php 
/**
* 
*/
class Access_denied extends CI_Controller
{	

	public function index(){
		$this->template->loadContent('error/no_access_module');
	}
}