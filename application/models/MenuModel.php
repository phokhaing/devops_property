<?php 
/**
* @author: khaing.pho1991@gmail.com
*/
class MenuModel extends CI_Model
{
	private $table     = "menu";
	private $tblOrderMenu = 'menu_orderable';
	private $id        = "menu_id";
	private $menuNameEN= "menu_name_en";
	private $menuNameKH= "menu_name_kh";
	private $menuUrl   = "menu_url";
	private $menuIcon  = "menu_icon";
	private $iconColor = "icon_color";
 
	// default
	private $createdBy = "created_by";
	private $createdAt = "created_at";
	private $updatedBy = "updated_by";
	private $updatedAt = "updated_at";
	private $status    = 'status';

	function __construct()
	{
		parent::__construct();
	}

	function create()
	{
		$data = array(
			$this->menuNameEN  => ucwords($this->input->post('menu_name_en')),
			$this->menuNameKH  => ucwords($this->input->post('menu_name_kh')),
			$this->menuUrl     => ucwords($this->input->post('menu_url')),
			$this->menuIcon    => strtolower($this->input->post('menu_icon')),
			$this->iconColor   => $this->input->post('icon_color'),
			$this->status      => (int) $this->input->post('status'),
			$this->createdBy   => $this->user->info->ID,
			$this->createdAt   => date("Y-m-d H:i:s")
		);

		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	function update($id)
	{
		$data = array(
			$this->menuNameEN  => ucwords($this->input->post('menu_name_en')),
			$this->menuNameKH  => ucwords($this->input->post('menu_name_kh')),
			$this->menuUrl     => ucwords($this->input->post('menu_url')),
			$this->menuIcon    => strtolower($this->input->post('menu_icon')),
			$this->iconColor   => $this->input->post('icon_color'),
			$this->status      => (int) $this->input->post('status'),
			$this->updatedBy   => $this->user->info->ID,
			$this->updatedAt   => date("Y-m-d H:i:s")
		);
		$this->db
		     ->where($this->id, $id)
		     ->update($this->table, $data);
			 return $this->db->affected_rows();
	}

	function getAll(){
		$result = $this->db->get($this->table);
		return $result->result_array();
	}
	function getAllMenuOrderable(){
		$result = $this->db->get('menu_orderable');
		return $result->result_array();
	}

	function findAllByStatus($status){

		if($status == 'active'){
			$status = 1;
		}else{
			$status = 0;
		}

		$result = $this->db->get_where($this->table, array($this->status=>$status));
		return $result->result_array();
	}

	function count(){
		$total = array();
		$total['all'] = $this->db->count_all($this->table);

		// count status active
		$total['active'] =  $this->db
								 ->where($this->status, 1)
								 ->from($this->table)
								 ->count_all_results();

		// count status in-active
		$total['inactive'] =  $this->db
								   ->where($this->status, 0)
								   ->from($this->table)
								   ->count_all_results();
		return $total;
	}

	function deleteById($id){
		$this->db
			 ->where($this->id, $id)
			 ->delete($this->table);
			 return $this->db->affected_rows();
	}

	function findOne($id){
		$result = $this->db->get_where($this->table, array($this->id => $id));
		return $result->row();
	}

	function changeStatus($id, $status){
		$data = array(
			$this->status => (int) ($status == 1 ? 0 : 1)
		);
		$this->db
		     ->where($this->id, $id)
		     ->update($this->table, $data);
			 return $this->db->affected_rows();
	}

	function findMenuOrderable(){
		$result = $this->db->get($this->tblOrderMenu);
		return $result->row();
	}
	function updateMenuOrderable($id, $data){
		$this->db
		     ->where('id', $id)
		     ->update($this->tblOrderMenu, $data);
			 return $this->db->affected_rows();
	}

}

?>