<?php 
/**
* 
*/
class Adminpanel extends CI_Controller
{	
	public function index(){
        $this->load->helper('dashboard');
		$this->template->loadContent('adminpanel_dashboard');
	}
}