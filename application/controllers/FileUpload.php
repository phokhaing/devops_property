<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class FileUpload extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model("documentation_model");

        if (!$this->user->loggedin){
            redirect('login');
        }

//        $this->template->loadData("activeLink", array("documentation" => array("general" => 1)));
    }

    public function Upload() {

        $config['upload_path'] = $this->settings->info->upload_path;
        $config["overwrite"] = FALSE;
        $config["max_filename"] =300;
        $config["encrypt_name"] = TRUE;
        $config["remove_spaces"] = TRUE;
        $config["allowed_types"] = $this->settings->info->file_types;
        $config["max_size"] = $this->settings->info->file_size;
        $this->load->library('upload',$config);
        
        if(!$this->upload->do_upload('upload')){
            echo json_encode(array('error' => $this->upload->display_errors()));
        } else {
            $upload_data = $this->upload->data();
            echo json_encode(array('file_name' => $upload_data['file_name']));
        }
    }

    /*
     * Brow image from folder in CKeditor
     * By Youlay HANG
     */

    function file_browser() {
        $data['fileList'] = glob('./uploads/*');
        $this->load->view('file_uploads/file_browser', $data);
    }

}
