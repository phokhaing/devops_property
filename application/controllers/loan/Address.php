<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address extends CI_Controller {

	var $tblCountry  = 'loan_country';
	var $tblProvince = 'loan_province';
	var $tblDistrict = 'loan_district';
	var $tblCommune  = 'loan_commune';
	var $tblVillage  = 'loan_village';

	public function index()
	{	
		if (!$this->user->loggedin) redirect('login');
		$this->load->database();
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 15/07/2020
      * @param: list province by country id
      *----------------------------------------------------------------
      */
	public function findProvince($countryID=null)
	{
	    $output = $this->db
	                   ->where('country_id', $countryID)
	                   ->get($this->tblProvince)
	                   ->result();

	    if(!empty($output)){
	    	echo ("<option value=''> --- Select Province --- </option>");
	    	foreach($output as $pro){
	            echo ("<option value='".$pro->id."'>".$pro->name_en."</option>");
	        }
	    }else{
	        echo ("<option value=''> No data </option>");
	    }
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 15/07/2020
      * @param: list district by province id
      *----------------------------------------------------------------
      */
	public function findDistrict($provinceID=null)
	{
	    $output = $this->db
	                   ->where('province_id', $provinceID)
	                   ->get($this->tblDistrict)
	                   ->result();
	                   
	    if(!empty($output)){
	    	echo ("<option value=''> --- select district --- </option>");
	    	foreach($output as $list){
	            echo ("<option value='".$list->id."'>".$list->name_en."</option>");
	        }
	    }else{
	        echo ("<option value=''> No data </option>");
	    }
	}

	/** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 15/07/2020
      * @param: list commune by district id
      *----------------------------------------------------------------
      */
	public function findCommune($districtID=null)
	{
	    $output = $this->db
	                   ->where('district_id', $districtID)
	                   ->get($this->tblCommune)
	                   ->result();
	                   
	    if(!empty($output)){
	    	echo ("<option value=''> --- select commune --- </option>");
	    	foreach($output as $list){
	            echo ("<option value='".$list->id."'>".$list->name_en."</option>");
	        }
	    }else{
	        echo ("<option value=''> No data </option>");
	    }
	}

	public function findvillage($communeID=null)
	{
	    $output = $this->db
	                   ->where('commune_id', $communeID)
	                   ->get($this->tblVillage)
	                   ->result();
	                   
	    if(!empty($output)){
	    	echo ("<option value=''> --- select village --- </option>");
	    	foreach($output as $list){
	            echo ("<option value='".$list->id."'>".$list->name_en."</option>");
	        }
	    }else{
	        echo ("<option value=''> No data </option>");
	    }
	}

}

/* End of file Address.php */
/* Location: ./application/controllers/loan/Address.php */

