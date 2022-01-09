<?php 

function getCategoryTypeCode($categorytypeID){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('*')
              ->where('id', $categorytypeID)
              ->get('loan_category_type')
              ->row();
    if(!empty($output)){
       return $output->categorytype_code;
    }else{
      return null;
    }      
}

function getCategoryCode($id){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('*')
              ->where('id', $id)
              ->get('loan_category')
              ->row();
    if(!empty($output)){
       return $output->category_code;
    }else{
      return null;
    }      
}

function getPurposeTypeCode($id){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('*')
              ->where('id', $id)
              ->get('loan_purpose_type')
              ->row();
    if(!empty($output)){
       return $output->purposetype_code;
    }else{
      return null;
    }      
}

function getInterestCode($id){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('*')
              ->where('id', $id)
              ->get('loan_interest')
              ->row();
    if(!empty($output)){
       return $output->interest_code;
    }else{
      return null;
    }      
}

function getRuleCode($id){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('*')
              ->where('id', $id)
              ->get('loan_rule')
              ->row();
    if(!empty($output)){
       return $output->rule_code;
    }else{
      return null;
    }      
}

function getRuleDetailCode($id){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('*')
              ->where('id', $id)
              ->get('loan_rule_detail')
              ->row();
    if(!empty($output)){
       return $output->ruledetail_code;
    }else{
      return null;
    }      
}

function getCurrency($id){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('*')
              ->where('id', $id)
              ->get('loan_currency')
              ->row();
    if(!empty($output)){
       return $output->name_en.' ('.$output->currency_code.')';
    }else{
      return null;
    }      
}
function getCurrencyCode($id){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('*')
              ->where('id', $id)
              ->get('loan_currency')
              ->row();
    if(!empty($output)){
       return $output->currency_code;
    }else{
      return null;
    }      
}

function listCurrency(){
    $ci=& get_instance();
    $ci->load->database();
    return $ci->db->select('*')
              ->where('status', 1)
              ->get('loan_currency')
              ->result();   
}

function findCustomerActive(){
    $ci=& get_instance();
    $ci->load->database();
    return $ci->db->select('id, customer_id, firstname_en, lastname_en, firstname_kh, lastname_kh')
              ->where('status', 1)
              ->get('loan_customer')
              ->result();   
}

function findCustomerCode($customer_id){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('customer_id')
              ->where('id', $customer_id)
              ->get('loan_customer')
              ->row();
    if(!empty($output)){
       return $output->customer_id;
    }else{
      return null;
    }    
}

function findCustomerName($customer_id){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('firstname_en, lastname_en')
              ->where('id', $customer_id)
              ->get('loan_customer')
              ->row();
    if(!empty($output)){
       return $output->firstname_en.' '.$output->lastname_en;
    }else{
      return null;
    }    
}

function findLoanProductActive(){
    $ci=& get_instance();
    $ci->load->database();
    return $ci->db->select('*')
              ->where('status', 1)
              ->get('loan_product')
              ->result();   
}

function findLoanProductNameByID($product_id){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('name_en')
              ->where('id', $product_id)
              ->where('status', 1)
              ->get('loan_product')
              ->row();
    if(!empty($output)){
       return $output->name_en;
    }else{
      return null;
    }    
}

function findLoanProductCodeByID($product_id){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('product_code')
              ->where('id', $product_id)
              ->where('status', 1)
              ->get('loan_product')
              ->row();
    if(!empty($output)){
       return $output->product_code;
    }else{
      return null;
    }    
}

function findLoanPurposeTypeActive(){
    $ci=& get_instance();
    $ci->load->database();
    return $ci->db->select('*')
              ->where('status', 1)
              ->get('loan_purpose_type')
              ->result();   
}

function findLoanPurposeActive(){
    $ci=& get_instance();
    $ci->load->database();
    return $ci->db->select('*')
              ->where('status', 1)
              ->get('loan_purpose')
              ->result();   
}

function listBranchActive(){
    $ci=& get_instance();
    $ci->load->database();
    return $ci->db->select('*')
              ->where('status', 1)
              ->order_by('branch_code','asc')
              ->get('branch')
              ->result();   
}

function findBranchCodeByID($branch_id){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db->select('branch_code')
              ->where('status', 1)
              ->where('id_branch',$branch_id)
              ->get('branch')
              ->row(); 
    if(!empty($output)){
      return $output->branch_code;
    }else{
      return null;
    }  
}

function listCollateralByCustomerID($customer_id){
    $ci=& get_instance();
    $ci->load->database();
    return $ci->db
              ->where('status', 1)
              ->where('customer_id', $customer_id)
              ->get('loan_collateral')
              ->result();  
}

function getSpouseByCustomerID($customer_id){
    $ci=& get_instance();
    $ci->load->database();
    return $ci->db
            ->select('loan_spouse.*,loan_identification_type.name_kh as iden_name_kh,loan_nationality.name_kh as nation_name_kh')
            ->where('customer_id', $customer_id)
            ->join('loan_identification_type', 'loan_spouse.spouse_id_type=loan_identification_type.id','inner')
            ->join('loan_nationality', 'loan_spouse.spouse_nationality=loan_nationality.id','inner')
            ->get('loan_spouse')
            ->row();   
}

function getIdentificationByCustomerID($customer_id){
    $ci=& get_instance();
    $ci->load->database();
    return $ci->db
            ->select('loan_identification.*,loan_identification_type.name_kh as iden_name_kh')
            ->where('customer_id', $customer_id)
            ->join('loan_identification_type', 'loan_identification.identification_type=loan_identification_type.id','inner')
            ->get('loan_identification')
            ->result();   
}

function getContactByCustomerID($customer_id)
{
    $ci=& get_instance();
    $ci->load->database();
    return $ci->db
            ->select('loan_customer_contact.*,
                loan_country.name_kh as country_name_kh,
                loan_province.name_kh as province_name_kh,
                loan_district.name_kh as district_name_kh,
                loan_commune.name_kh as commune_name_kh,
                loan_village.name_kh as village_name_kh')
            ->where('customer_id', $customer_id)
            ->join('loan_country', 'loan_customer_contact.country_id=loan_country.id','inner')
            ->join('loan_province', 'loan_customer_contact.province_id=loan_province.id','inner')
            ->join('loan_district', 'loan_customer_contact.district_id=loan_district.id','inner')
            ->join('loan_commune', 'loan_customer_contact.commune_id=loan_commune.id','inner')
            ->join('loan_village', 'loan_customer_contact.village_id=loan_village.id','inner')
            ->get('loan_customer_contact')
            ->result(); 
}

function getEmploymentByCustomerID($customer_id)
{
        $ci=& get_instance();
        $ci->load->database();
        return $ci->db
                ->select('loan_employment_detail.*,
                    loan_country.name_kh as country_name_kh,
                    loan_province.name_kh as province_name_kh,
                    loan_district.name_kh as district_name_kh,
                    loan_commune.name_kh as commune_name_kh,
                    loan_village.name_kh as village_name_kh, 
                    loan_business_type.name_kh as business_type_name_kh,
                    loan_currency.name_kh as currency_name_kh,
                    loan_currency.currency_code as currency_code')
                ->where('customer_id', $customer_id)
                ->join('loan_country', 'loan_employment_detail.employer_country=loan_country.id','inner')
                ->join('loan_province', 'loan_employment_detail.employer_province=loan_province.id','inner')
                ->join('loan_district', 'loan_employment_detail.employer_district=loan_district.id','inner')
                ->join('loan_commune', 'loan_employment_detail.employer_commune=loan_commune.id','inner')
                ->join('loan_village', 'loan_employment_detail.employer_village=loan_village.id','inner')
                ->join('loan_business_type', 'loan_employment_detail.empbusiness_type_id=loan_business_type.id','inner')
                ->join('loan_currency', 'loan_employment_detail.employee_currency=loan_currency.id','inner')
                ->get('loan_employment_detail')
                ->result(); 
    }

 ?>