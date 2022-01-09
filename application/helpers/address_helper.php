<?php 
function findCountryActive(){
  	$ci=& get_instance();
    $ci->load->database();
    return $ci->db
    		  ->where('status', 1)
              ->get('loan_country')
              ->result();
}

function findNationalityActive(){
  	$ci=& get_instance();
    $ci->load->database();
    return $ci->db
    		  ->where('status', 1)
              ->get('loan_nationality')
              ->result();
}

function findOfficer(){
    $ci=& get_instance();
    $ci->load->database();
    return  $ci->db
              ->where('position_id', 46)
              ->get('users')
              ->result();
}

function findProvince($countryID=null){
	$ci=& get_instance();
    $ci->load->database();
    
    $output =  $ci->db
                  ->where('country_id', $countryID)
                  ->get('loan_province')
                  ->result();
    if(!empty($output)){
    	echo ("<option value=''> Select Province </option>");
    	foreach($output as $pro){
            echo ("<option value='".$pro->id."'>".$pro->name_en."</option>");
        }
    }else{
        echo ("<option value=''> No data </option>");
    }
}

function selectedProvince($countryID=null, $provinceID=null){
	$ci=& get_instance();
    $ci->load->database();
    
    $output =  $ci->db
                  ->where('country_id', $countryID)
                  ->get('loan_province')
                  ->result();
    if(!empty($output)){
    	echo ("<option value=''>--- Select Province ---</option>");
    	foreach($output as $pro){
    		$selected = '';
    		if($provinceID == $pro->id){
    			$selected = 'selected';
    		}
            echo ("<option value='".$pro->id."'". $selected.">".$pro->name_en."</option>");
        }
    }else{
        echo ("<option value=''>--- select country first --- </option>");
    }
}
function selectedDistrict($provinceID=null, $districtID=null){
	$ci=& get_instance();
    $ci->load->database();
    
    $output =  $ci->db
                  ->where('province_id', $provinceID)
                  ->get('loan_district')
                  ->result();
    if(!empty($output)){
    	echo ("<option value=''>--- Select District ---</option>");
    	foreach($output as $dis){
    		$selected = '';
    		if($districtID == $dis->id){
    			$selected = 'selected';
    		}
            echo ("<option value='".$dis->id."'". $selected.">".$dis->name_en."</option>");
        }
    }else{
        echo ("<option value=''>--- select province first --- </option>");
    }
}
function selectedCommune($districtID=null, $communeID=null){
	$ci=& get_instance();
    $ci->load->database();
    
    $output =  $ci->db
                  ->where('district_id', $districtID)
                  ->get('loan_commune')
                  ->result();
    if(!empty($output)){
    	echo ("<option value=''>--- Select Commune ---</option>");
    	foreach($output as $com){
    		$selected = '';
    		if($communeID == $com->id){
    			$selected = 'selected';
    		}
            echo ("<option value='".$com->id."'". $selected.">".$com->name_en."</option>");
        }
    }else{
        echo ("<option value=''>--- select district first --- </option>");
    }
}
function selectedVillage($communeID=null, $villageID=null){
	$ci=& get_instance();
    $ci->load->database();
    
    $output =  $ci->db
                  ->where('commune_id', $communeID)
                  ->get('loan_village')
                  ->result();
    if(!empty($output)){
    	echo ("<option value=''>--- Select Commune ---</option>");
    	foreach($output as $vil){
    		$selected = '';
    		if($villageID == $vil->id){
    			$selected = 'selected';
    		}
            echo ("<option value='".$vil->id."'". $selected.">".$vil->name_en."</option>");
        }
    }else{
        echo ("<option value=''>--- select district first --- </option>");
    }
}
function selectedIndustry($sectorID=null, $industryID=null){
	$ci=& get_instance();
    $ci->load->database();
    
    $output =  $ci->db
                  ->where('sector_id', $sectorID)
                  ->get('loan_industry')
                  ->result();
    if(!empty($output)){
    	echo ("<option value=''>--- Select Industry ---</option>");
    	foreach($output as $ind){
    		$selected = '';
    		if($industryID == $ind->id){
    			$selected = 'selected';
    		}
            echo ("<option value='".$ind->id."'". $selected.">".$ind->name_en."</option>");
        }
    }else{
        echo ("<option value=''>--- select sector first --- </option>");
    }
}

?>