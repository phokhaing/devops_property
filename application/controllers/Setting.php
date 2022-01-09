<?php 
/**
* 
*/
class Setting extends CI_Controller
{	
	public function index(){
        $this->load->helper('dashboard');
		$this->template->loadContent('setting_dashboard');
	}
}