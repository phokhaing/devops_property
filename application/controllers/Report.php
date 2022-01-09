<?php 
/**
* 
*/
class Report extends CI_Controller
{	
	public function index(){
        $this->load->helper('dashboard');
        $this->load->database();
        $output = array();
        $output['count_float_advance'] = $this->db->count_all_results('float_advance');
        $output['count_advance_clearing'] = $this->db->count_all_results('advance_clearing');
        $output['count_purchase_request'] = $this->db->count_all_results('purchase_request');
        $output['count_purchase_order'] = $this->db->count_all_results('purchase_order');
        $output['count_payment_voucher'] = $this->db->count_all_results('payment_voucher');
        $output['count_goods_received_note'] = $this->db->count_all_results('goods_received_note');
		$this->template->loadContent('reports/report_dashboard', $output);
	}
}