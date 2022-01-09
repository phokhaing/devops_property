<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once("Settings.php");

class File {

    /** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 21/March/2020
      * @param: method for upload multiple ticket files
      *----------------------------------------------------------------
      */
    public function uploadMulitpleFiles($files, $filePath){
        $CI = & get_instance();
        $CI->load->library("upload");

        $countFiles = count($_FILES[$files]['name']);
        $file_data = array();

        if(isset($_FILES[$files]) && $_FILES[$files]['name'][0] != ''){
            $path = $CI->settings->info->upload_path_relative.$filePath;
            if(!is_dir($path)) //check the folder if not exists
            {
              mkdir($path,0755,TRUE);// create directory
              fopen($path.'/index.php', 'w'); // create index.php 
            }

            if ($CI->settings->info->enable_ticket_uploads){
                for ($i=0; $i < $countFiles; $i++) {
                    if (isset($_FILES[$files]) && $_FILES[$files]['size'] > 0)
                    {
                          $_FILES['file']['name'] = $_FILES[$files]['name'][$i];
                          $_FILES['file']['type'] = $_FILES[$files]['type'][$i];
                          $_FILES['file']['tmp_name'] = $_FILES[$files]['tmp_name'][$i];
                          $_FILES['file']['error'] = $_FILES[$files]['error'][$i];
                          $_FILES['file']['size'] = $_FILES[$files]['size'][$i];

                        $CI->upload->initialize(array(
                            "upload_path" => $path,
                            "overwrite" => FALSE,
                            "max_filename" => 300,
                            "encrypt_name" => TRUE,
                            "remove_spaces" => TRUE,
                            "allowed_types" => $CI->settings->info->file_types,
                            "max_size" => $CI->settings->info->file_size)
                        );

                        // if (!$CI->upload->do_upload('file')){
                        //     $error = array('error' => $CI->upload->display_errors());
                        //     $CI->template->error(lang("error_98") . "<br /><br />" .
                        //             $CI->upload->display_errors());
                        // }

                        if ($CI->upload->do_upload('file')){
                            $data = $CI->upload->data();
                            $file_data[] = array(
                                "upload_file_name" => $data['file_name'],
                                "original_name" => $data['orig_name'],
                                "file_type" => $data['file_type'],
                                "extension" => $data['file_ext'],
                                "file_size" => $data['file_size'],
                                "file_path" => $path,
                                "timestamp" => time()
                            );
                        }
                    }
                }
            }
        }
        return $file_data;
    }

    /** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param : 21/March/2020
      * @param : $files is array list files upload
      * @param : $fileRemoved is array list file removed 
      * @param : method for upload multiple loan files
      *----------------------------------------------------------------
      */
    public function uploadLoanFiles($files=null, $filePath=null, $fileRemoved=null, $fileCatch=null){
        $CI = & get_instance();
        $CI->load->library("session");
        $CI->load->library("upload");
        $file_data = array();

        if(isset($_FILES[$files]) && $_FILES[$files]['name'][0]!='')
        {
            /* unset file that removed from $files */
            if($CI->input->post($fileRemoved)){
               $file_removed = explode('___', $CI->input->post($fileRemoved));
               foreach ($file_removed as $key => $removed) {
                    if (($index = array_search(str_replace("%20", " ", $removed), $_FILES[$files]['name'])) !== false) {
                        unset($_FILES[$files]['name'][$index]);
                        unset($_FILES[$files]['type'][$index]);
                        unset($_FILES[$files]['tmp_name'][$index]);
                        unset($_FILES[$files]['error'][$index]);
                        unset($_FILES[$files]['size'][$index]);
                    }
               }
            }

            /* create new dir if not exists */
            $path = $CI->settings->info->upload_path_relative.$filePath;
            if(!is_dir($path)){
              mkdir($path,0755,TRUE);// create directory
              fopen($path.'/index.php', 'w'); // create index.php 
            }

            /* upload file to dir */
            foreach ($_FILES[$files]['name'] as $key => $file_name){
                if($_FILES[$files]['size'][$key] > 0)
                {
                    $_FILES['file']['name']    = $file_name;
                    $_FILES['file']['type']    = $_FILES[$files]['type'][$key];
                    $_FILES['file']['tmp_name']= $_FILES[$files]['tmp_name'][$key];
                    $_FILES['file']['error']   = $_FILES[$files]['error'][$key];
                    $_FILES['file']['size']    = $_FILES[$files]['size'][$key];

                    $CI->upload->initialize(array(
                    "upload_path"   => $path,
                    "overwrite"     => FALSE,
                    "max_filename"  => 300,
                    "encrypt_name"  => TRUE,
                    "remove_spaces" => TRUE,
                    "allowed_types" => $CI->settings->info->file_types,
                    "max_size"      => $CI->settings->info->file_size));

                    if ($CI->upload->do_upload('file')){
                        $data = $CI->upload->data();
                        $file_data[] = array(
                        "upload_file_name" => $data['file_name'],
                        "original_name"    => $data['orig_name'],
                        "file_type"        => $data['file_type'],
                        "extension"        => $data['file_ext'],
                        "file_size"        => $data['file_size'],
                        "file_path"        => $path,
                        "timestamp"        => time());
                    }
                }
            }            
        }

        /* upload catch files if exist */
        $catchFiles = $this->storeCatchFiles($_FILES[$files]['name'], $filePath, $fileRemoved, $fileCatch);
        
        if($catchFiles){        
            foreach ($catchFiles as $key => $catchFile) {
                $catchFile['file_path'] = $CI->settings->info->upload_path_relative.$filePath;
                $file_data[] = $catchFile;
            }
        }        
        
        return $file_data;
    }

    /** 
      *----------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param : 21/March/2020
      * @param : $files is array list files upload
      * @param : $fileRemoved is array list file removed 
      * @param : method for store catch file while validation form error. 
      * @param : when resubmit form, will upload this catch file
      *----------------------------------------------------------------
      */
    public function storeCatchFiles($files=null, $filePath=null, $fileRemoved=null, $fileCatch=null){
        $CI = & get_instance();
        $CI->load->library("session");

        /* if isset session catch files */
        if($CI->session->has_userdata($fileCatch))
        {
            /**-------------------------------------------------------------------------------------
             * if not exist $path dir, so create new $path dir and create index.php inside dir $path
             * -------------------------------------------------------------------------------------
             */
            $path = $CI->settings->info->upload_path_relative.$filePath;
            if(!is_dir($path)){
              mkdir($path,0755,TRUE);// create directory
              fopen($path.'/index.php', 'w'); // create index.php 
            }

            /* files that removed at form */
            $file_removed = array();
            if($CI->input->post($fileRemoved)){
                $file_removed = explode('___', $CI->input->post($fileRemoved));
            }

            $catch_files = $CI->session->userdata($fileCatch);
            foreach ($catch_files as $key => $catch){
                if($files[0]!=''){
                    /**--------------------------------------------------------------------------------------------------
                     * if $catch['original_name'] not in $files and not in $file_removed, so move file to dir
                     * else $catch['original_name'] match in $files or match in $file_removed, so unset $catch_files[$key]
                     * ---------------------------------------------------------------------------------------------------
                     */
                    if((!in_array(str_replace("%20", " ", $catch['original_name']), $files)) && (!in_array(str_replace("%20", " ", $catch['original_name']), $file_removed))){                        
                        copy('./'.$catch['file_path'].'/'.$catch['upload_file_name'], $path.'/'.$catch['upload_file_name']);                        
                    }else{                        
                        unset($catch_files[$key]);
                    }
                }else{ 
                    /**-------------------------------------------------------------------------------------
                     * if $catch['original_name'] not in $file_removed, so move file to dir
                     * else $catch['original_name'] match in $file_removed, so unset $catch_files[$key]
                     * -------------------------------------------------------------------------------------
                     */
                    if(!in_array(str_replace("%20", " ", $catch['original_name']), $file_removed)){
                        copy('./'.$catch['file_path'].'/'.$catch['upload_file_name'], $path.'/'.$catch['upload_file_name']);
                    }else{
                        unset($catch_files[$key]);
                    }                   
                }
                /* delete catch file in dir */
                unlink('./'.$catch['file_path'].'/'.$catch['upload_file_name']);              
                $dir = './'.$catch['file_path'];
            }

            /* delete dir */
            unlink($dir.'/index.php');  
            rmdir($dir);

            /* unset session catch_files */
            $CI->session->unset_userdata($fileCatch);
            return $catch_files;
        }
        return false;
    }
}

?>
