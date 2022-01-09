<?php

/**
 * This helper contains a list of functions used throughout the application
 * 
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

    /*
 * get Organization name
 */

function get_org_name($id) {
    $ci = & get_instance();
    $ci->load->database();
    $ci->db->select('*');
    $ci->db->where('id_branch', $id);
    $query = $ci->db->get('branch')->row();
    if(!empty($query)) {
        return $query->branch_name;
    } else {
        return "N/A";
    }
}
function get_department_name($id) {
    $ci = & get_instance();
    $ci->load->database();
    $ci->db->select('*');
    $ci->db->where('id_department', $id);
    $query = $ci->db->get('ac_department')->row();
    if(!empty($query)) {
        return $query->department_name;
    } else {
        return "N/A";
    }
}