<?php 
function findFloatAdvanceActive(){
   $ci=& get_instance();
   $ci->load->database();
   $output = $ci->db
             ->where('created_by', $ci->user->info->ID)
             ->or_where('checked_by', $ci->user->info->ID)
             ->or_where('approved_by', $ci->user->info->ID)
             ->order_by('id', 'desc')
             ->get("float_advance")
             ->result();

    $response = array();
    if(!empty($output)){
        foreach ($output as $key => $row) {
            if(($row->authorize_status == 'requesting' && $row->checked_by == $ci->user->info->ID) || ($row->authorize_status == 'checked' && $row->approved_by == $ci->user->info->ID)){
                $response[] = $output[$key];
            }
        }
    }
    return $response;
}

function findAdvanceClearingActive(){
   $ci=& get_instance();
   $ci->load->database();
   $output = $ci->db
             ->where('created_by', $ci->user->info->ID)
             ->or_where('checked_by', $ci->user->info->ID)
             ->or_where('settlement_by', $ci->user->info->ID)
             ->or_where('verified_by', $ci->user->info->ID)
             ->or_where('approved_by', $ci->user->info->ID)
             ->order_by('id', 'desc')
             ->get("advance_clearing")
             ->result();

    $response = array();
    if(!empty($output)){
        foreach ($output as $key => $row) {
            if($row->authorize_status == 'requesting' && $row->settlement_by == $ci->user->info->ID){
                $response[] = $output[$key];
            }elseif($row->authorize_status == 'settlement' && $row->checked_by == $ci->user->info->ID){
                $response[] = $output[$key];
            }elseif($row->authorize_status == 'checked' && $row->verified_by == $ci->user->info->ID){
                $response[] = $output[$key];
            }elseif($row->authorize_status == 'verified' && $row->approved_by == $ci->user->info->ID){
                $response[] = $output[$key];
            }
        }
    }
    return $response;
}

function findPurchaseRequestActive(){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db
              ->where('created_by', $ci->user->info->ID)
              ->or_where('checked_by', $ci->user->info->ID)
              ->or_where('approved_by', $ci->user->info->ID)
              ->order_by('id', 'desc')
              ->get("purchase_request")
              ->result();
 
     $response = array();
     if(!empty($output)){
         foreach ($output as $key => $row) {
            if(($row->authorize_status == 'requesting' && $row->checked_by == $ci->user->info->ID) || ($row->authorize_status == 'checked' && $row->approved_by == $ci->user->info->ID)){
                $response[] = $output[$key];
            }
         }
     }
     return $response;
 }

function findPurchaseOrderActive(){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db
              ->where('created_by', $ci->user->info->ID)
              ->or_where('checked_by', $ci->user->info->ID)
              ->or_where('approved_by', $ci->user->info->ID)
              ->order_by('id', 'desc')
              ->get("purchase_order")
              ->result();
 
     $response = array();
     if(!empty($output)){
         foreach ($output as $key => $row) {
            if(($row->authorize_status == 'requesting' && $row->checked_by == $ci->user->info->ID) || ($row->authorize_status == 'checked' && $row->approved_by == $ci->user->info->ID)){
                $response[] = $output[$key];
            }
         }
     }
     return $response;
 }

function findPaymentVoucherActive(){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db
             ->where('created_by', $ci->user->info->ID)
             ->or_where('checked_by', $ci->user->info->ID)
             ->or_where('verified_by', $ci->user->info->ID)
             ->or_where('approved_by', $ci->user->info->ID)
             ->order_by('id', 'desc')
             ->get("payment_voucher")
             ->result();

    $response = array();
    if(!empty($output)){
        foreach ($output as $key => $row) {
            if($row->authorize_status == 'requesting' && $row->checked_by == $ci->user->info->ID){
                $response[] = $output[$key];
            }elseif($row->authorize_status == 'checked' && $row->verified_by == $ci->user->info->ID){
                $response[] = $output[$key];
            }elseif($row->authorize_status == 'verified' && $row->approved_by == $ci->user->info->ID){
                $response[] = $output[$key];
            }
        }
    }
    return $response;
}

function findGoodsReceivedNoteActive(){
    $ci=& get_instance();
    $ci->load->database();
    $output = $ci->db
             ->where('created_by', $ci->user->info->ID)
             ->or_where('checked_by', $ci->user->info->ID)
             ->order_by('id', 'desc')
             ->get("goods_received_note")
             ->result();

    $response = array();
    if(!empty($output)){
        foreach ($output as $key => $row) {
            if($row->authorize_status == 'requesting' && $row->checked_by == $ci->user->info->ID){
                $response[] = $output[$key];
            }
        }
    }
    return $response;
}

?>