<?php 

	/** FILE UPLOAD
     *--------------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @param: upload file type doc, excel, pdf, photo..
     *--------------------------------------------------
     */
    function uploadFile() 
    {
    	$ci=& get_instance();
    	$output = array();
        $files = $_FILES['files']['name']; 
        $dir = '\access_right\user-id-'.$ci->input->post('user_id');

        for ($i = 0; $i < count($files); $i++)
        {
            if($files[$i] != null || $files[$i] != '')
            {
                $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                $config['upload_path'] = $ci->settings->info->upload_path.$dir;
                $config["overwrite"] = FALSE;
                $config["max_filename"] =300;
                $config["encrypt_name"] = TRUE;
                $config["remove_spaces"] = TRUE;
                $config["allowed_types"] = $ci->settings->info->file_types;
                $config["max_size"] = $ci->settings->info->file_size;

                $ci->load->library('upload', $config);
                $ci->upload->initialize($config);

                if (!is_dir($config['upload_path'])) { // make directory
                    mkdir($config['upload_path'], 0755, TRUE);
                }

                $uploaded = $ci->upload->do_upload('file');
                if ($uploaded) {
                    $output[] = $ci->upload->data();
                }else{
                    $output[] = null;
                }
            }
        }

        return $output;
    }

?>