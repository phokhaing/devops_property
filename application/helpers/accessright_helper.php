<?php 
function getRequestToName($requestToID){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('request_to_name');
    $ci->db->where('id_request_to', $requestToID);
    $row = $ci->db->get('ac_request_to')->row();
    $Manager_name = $row->request_to_name;
    return $Manager_name;
}

function getBranchName($branchCode){
	$ci=& get_instance();
    $ci->load->database();
	$result = $ci->db->select("branch_name")
		      ->where('id_branch', $branchCode)
		      ->get('branch')
		      ->row();

	if(!empty($result)){
		return $result->branch_name;
	}else{
		return null;
	}
}	


function getEmailAlert($userID){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('email')
              ->where('ID', $userID)
              ->get('users')
              ->row();
    
    if(!empty($output)){
        return $output->email;
    }else{
        return null;
    }
}

function getDepartmentName($depId){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('department_name')
              ->where('id_department', $depId)
              ->get('ac_department')
              ->row();
    
    if(!empty($output)){
        return $output->department_name;
    }else{
        return null;
    }
}
function getPositionName($posId){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('position_name')
              ->where('id', $posId)
              ->get('ac_position')
              ->row();
    
    if(!empty($output)){
        return $output->position_name;
    }else{
        return null;
    }
}
function getPositionNameKH($posId){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('position_name_kh')
              ->where('id', $posId)
              ->get('ac_position')
              ->row();
    
    if(!empty($output)){
        return $output->position_name_kh;
    }else{
        return null;
    }
}
function getDivisionName($divid){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('name_en')
              ->where('id', $divid)
              ->get('division')
              ->row();
    
    if(!empty($output)){
        return $output->name_en;
    }else{
        return null;
    }
}
function getDivisionNameKH($divid){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('name_kh')
              ->where('id', $divid)
              ->get('division')
              ->row();
    
    if(!empty($output)){
        return $output->name_kh;
    }else{
        return null;
    }
}
function getRequestTypeName($reqTypeId){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('request_type_name')
              ->where('id_request_type', $reqTypeId)
              ->get('ac_request_type')
              ->row();
    
    if(!empty($output)){
        return $output->request_type_name;
    }else{
        return null;
    }
}
function getRequestTypeProfileName($proId){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('ProfileName')
                     ->where('ID_Profile', $proId)
                     ->get('ac_profile_type')
                     ->row();

    if(!empty($output)){
        return $output->ProfileName;
    }else{
        return null;
    }
}

function getFunctionName($funcId){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('FunctionName')
                        ->where('id_functions', $funcId)
                        ->get('ac_functions')
                        ->row();

    if(!empty($output)){
        return $output->FunctionName;
    }else{
        return null;
    }
}
function findProjectName($project){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('project_name')
                        ->where('id', $project)
                        ->get('project')
                        ->row();

    if(!empty($output)){
        return $output->project_name;
    }else{
        return null;
    }
}
function findCompanyName($company_id){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('name')
                        ->where('id', $company_id)
                        ->get('company')
                        ->row();

    if(!empty($output)){
        return $output->name;
    }else{
        return null;
    }
}
function findSupplierName($supplier_id){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db
        ->select('name')
        ->where('id', $supplier_id)
        ->get('supplier')
        ->row();

    if(!empty($output)){
        return $output->name;
    }else{
        return null;
    }
}
function findAccountName($account){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('code,name')
                        ->where('id', $account)
                        ->get('account')
                        ->row();

    if(!empty($output)){
        return $output->code.' - '.$output->name;
    }else{
        return null;
    }
}
function findMeasurementName($uom_id){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('name,symbol')
                        ->where('id', $uom_id)
                        ->get('unit_of_measurement')
                        ->row();

    if(!empty($output)){
        return $output->name.' ('.$output->symbol.')';
    }else{
        return 'NULL';
    }
}


function getOptionOfProfileNameByID($requestTypeId, $profileId){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('*')
                     ->where('ID_RequestType', $requestTypeId)
                     ->where('Status', 1)
                     ->order_by('ProfileName', 'asc')
                     ->get('ac_profile_type')
                     ->result();

    $html = array();
    if(!empty($output)){
        $html[] = "<option value=''>--- Select Staff Profile Type ---</option>";
        foreach ($output as $list){
            if($list->ID_Profile == $profileId){
                $selected = 'selected';
            }else{
                $selected = '';
            }
            $html[] =  "<option value='" . $list->ID_Profile . "' ". $selected.">" . $list->ProfileName . "</option>";
        }
        return $html;

    }else{
        return null;
    }
}

function getOptionOfFunctionByID($requestTypeId, $functionalities){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('*')
                        ->where('id_requestType', $requestTypeId)
                        ->order_by('FunctionName', 'asc')
                        ->get('ac_functions')
                        ->result();

    $html = array();
    if(!empty($output)){
        $html[] = "<option value=''>--- Select Functionalites ---</option>";
        foreach ($output as $list)
        {
            if(in_array($list->id_functions, $functionalities)){
                $selected = 'selected';
            }else{
                $selected = '';
            }
            
            $html[] =  "<option value='" . $list->id_functions . "' ". $selected.">" . $list->FunctionName . "</option>";
        }
        return $html;

    }else{
        return null;
    }
}


?>